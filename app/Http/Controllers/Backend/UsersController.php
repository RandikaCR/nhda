<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Screens;
use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserScreens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    private $screenPrefix = 'users';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;
        $status = isset($request->status) ? $request->status : 'all';

        $users = User::select(
            'users.*',
            'user_roles.display_name as user_role',
        )
            ->join('user_roles', 'users.user_role_id', '=', 'user_roles.id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('users.first_name', 'like', "%$keyword%")
                    ->orWhere('users.last_name', 'like', "%$keyword%")
                    ->orWhere('users.email', 'like', "%$keyword%");
            })
            ->when(!in_array($this->userRoleId, $this->superAdminRoleIds), function ($query) use ($status) {
                $query->where('users.user_role_id', '!=', 1);
            })
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.users.index', [
            'users' => $users,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function create(Request $request){

        $tempId = $this->getTempUserId($request);

        $userRoles = UserRoles::where('status', 1)
            ->when(!in_array($this->userRoleId, $this->superAdminRoleIds), function ($query) {
                $query->where('id', '!=', 1);
            })
            ->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.users.create',[
            'temp_id' => $tempId,
            'user_roles' => $userRoles,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){
        $this->clearTempUserId($request);

        $user = User::where('uuid', $uuId)->first();
        $tempId = $user->id;

        $userRoles = UserRoles::where('status', 1)
            ->when(!in_array($this->userRoleId, $this->superAdminRoleIds), function ($query) {
                $query->where('id', '!=', 1);
            })
            ->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.users.create',[
            'temp_id' => $tempId,
            'user' => $user,
            'user_roles' => $userRoles,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function screens(Request $request, $uuId){

        $user = User::where('uuid', $uuId)->first();
        $tempId = $user->id;

        $validateArr = ['screen_prefix' => $this->screenPrefix, 'is_admin_only' => 1];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        $screens = Screens::orderBy('screen', 'ASC')->get();
        $getUserScreens = UserScreens::where('user_id', $user->id)->get();

        $userScreens = [];
        foreach ($getUserScreens as $getUserScreen) {
            $userScreens[] = $getUserScreen->screen_id;
        }


        return view('backend.users.screens',[
            'user' => $user,
            'screens' => $screens,
            'user_screens' => $userScreens,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        if(!empty($request->id)){
            $save = User::find($request->id);

            $request->validate([
                'user_role_id' => ['required', 'integer'],
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
            ]);

            $msg = 'User has been Updated Successfully!';
        }
        else{

            $request->validate([
                'user_role_id' => ['required', 'integer'],
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $req = ['screen' => $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new User();
            $save->uuid = $uuId;
            $save->image = 'default-user.png';
            $save->password = Hash::make($request->password);
            $save->status = 1;

            $msg = 'User has been Created Successfully!';
        }


        $save->user_role_id = !empty($request->user_role_id) ? $request->user_role_id : 4;
        $save->first_name = !empty($request->first_name) ? $request->first_name : null;
        $save->last_name = !empty($request->last_name) ? $request->last_name : null;
        $save->email = !empty($request->email) ? $request->email : null;
        $save->save();


        session()->flash('success', $msg);
        return redirect( route('backend.users.index') );

    }

    public function getTempUserId(Request $request){
        $rand = rand(10000000,99999999) . time();
        $tempId = !empty(session('temp_user_id')) ? session('temp_user_id') : null;
        if (empty($tempId)){
            $request->session()->put('temp_user_id', $rand);
            $request->session()->save();

            $tempId = $rand;
        }

        return $tempId;
    }

    public function clearTempUserId(Request $request){

        $tempId = !empty(session('temp_user_id')) ? session('temp_user_id') : null;
        if (!empty($tempId)){
            $request->session()->forget('temp_user_id');
            $request->session()->save();
        }

        return true;
    }

    public function delete(Request $request){

        $user = User::find($request->id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function setUserScreen(Request $request){
        $req = $request->all();
        $userId = !empty($req['user_id']) ? $req['user_id'] : 0;
        $screenId = !empty($req['screen_id']) ? $req['screen_id'] : 0;

        if (!empty($userId) && !empty($screenId)){
            $getUserScreen = UserScreens::where('user_id', $userId)->where('screen_id', $screenId)->first();

            if (!empty($getUserScreen)){
                $sc = UserScreens::find($getUserScreen->id);
                $sc->delete();
            }else{

                $treq = ['screen' => 'user_screens', 'id' => ''];
                $uuId = $this->generateUUId($treq);

                $s = new UserScreens();
                $s->uuid = $uuId;
                $s->user_id = $userId;
                $s->screen_id = $screenId;
                $s->is_view = 1;
                $s->is_create = 1;
                $s->is_edit = 1;
                $s->is_delete = 1;
                $s->status = 1;
                $s->save();
            }

            $status = 'success';
        }else{
            $status = 'error';
        }

        $out = [
            'status' => $status,
        ];
        return response()->json($out);

    }

}
