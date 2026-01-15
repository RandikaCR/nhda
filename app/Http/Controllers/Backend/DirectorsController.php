<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Directors;
use Illuminate\Http\Request;

class DirectorsController extends Controller
{
    private $screenPrefix = 'directors';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $members = Directors::select(
            'directors.*',
        )
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('directors.name', 'like', "%$keyword%")
                    ->orWhere('directors.designation', 'like', "%$keyword%")
                    ->orWhere('directors.phone', 'like', "%$keyword%")
                    ->orWhere('directors.mobile', 'like', "%$keyword%")
                    ->orWhere('directors.fax', 'like', "%$keyword%")
                    ->orWhere('directors.email', 'like', "%$keyword%")
                    ->orWhere('directors.qualifications', 'like', "%$keyword%");
            })
            ->orderBy('directors.name', 'ASC')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.directors.index', [
            'members' => $members,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.directors.create',[
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){


        $member = Directors::where('uuid', $uuId)->first();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.directors.create',[
            'member' => $member,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'slug' => 'required',
            'name' => 'required',
        ]);

        if(!empty($request->id)){
            $save = Directors::find($request->id);

            $msg = 'Director has been Updated Successfully!';
        }
        else{

            $req = ['screen' => $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new Directors();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'Director has been Created Successfully!';
        }

        $save->slug = !empty($request->slug) ? $request->slug : null;
        $save->name = !empty($request->name) ? $request->name : null;
        $save->designation = !empty($request->designation) ? $request->designation : null;
        $save->phone = !empty($request->phone) ? $request->phone : null;
        $save->mobile = !empty($request->mobile) ? $request->mobile : null;
        $save->fax = !empty($request->fax) ? $request->fax : null;
        $save->email = !empty($request->email) ? $request->email : null;
        $save->qualifications = !empty($request->qualifications) ? $request->qualifications : null;
        $save->image = !empty($request->image) ? $request->image : 'default-user.png';

        $save->save();


        session()->flash('success', $msg);
        return redirect( route('backend.directors.index') );

    }

    public function delete(Request $request){

        $news = Directors::find($request->id);
        $news->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function imageUpload(Request $request){

        $status = 'error';
        $file_name = '';

        if($request->ajax()){

            $img = $this->commonImageUpload($request);
            $file_name = $img['file_name'];
            $status = $img['status'];

            return response()->json([
                'status' =>  $status,
                'filename' =>  $file_name,
            ]);

        }
    }

    public function slugGenerator(Request $request){

        $status = 'success';
        $isExist = 0;
        $id = $request->id;
        $slug = $this->generateSeoURL($request->title);

        $getCount = Directors::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = Directors::where('id', $id)->first();
            if (!empty($item)){
                if ($item->slug != $slug){
                    $isExist = 1;
                }
            }else{
                $isExist = 1;
            }
        }

        return response()->json([
            'status' =>  $status,
            'is_exist' =>  $isExist,
            'slug' =>  $slug,
        ]);
    }
}
