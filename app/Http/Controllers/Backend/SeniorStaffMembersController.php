<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SeniorStaffMembers;
use Illuminate\Http\Request;

class SeniorStaffMembersController extends Controller
{
    private $screenPrefix = 'senior_staff_members';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $members = SeniorStaffMembers::select(
            'senior_staff_members.*',
        )
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('senior_staff_members.name', 'like', "%$keyword%")
                    ->orWhere('senior_staff_members.designation', 'like', "%$keyword%")
                    ->orWhere('senior_staff_members.phone', 'like', "%$keyword%")
                    ->orWhere('senior_staff_members.mobile', 'like', "%$keyword%")
                    ->orWhere('senior_staff_members.fax', 'like', "%$keyword%")
                    ->orWhere('senior_staff_members.email', 'like', "%$keyword%")
                    ->orWhere('senior_staff_members.qualifications', 'like', "%$keyword%");
            })
            ->orderBy('senior_staff_members.name', 'ASC')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.senior-staff-members.index', [
            'members' => $members,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.senior-staff-members.create',[
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){


        $member = SeniorStaffMembers::where('uuid', $uuId)->first();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.senior-staff-members.create',[
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
            $save = SeniorStaffMembers::find($request->id);

            $msg = 'Senior Staff Member has been Updated Successfully!';
        }
        else{

            $req = ['screen' => $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new SeniorStaffMembers();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'Senior Staff Member has been Created Successfully!';
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
        return redirect( route('backend.seniorStaffMembers.index') );

    }

    public function delete(Request $request){

        $news = SeniorStaffMembers::find($request->id);
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

        $getCount = SeniorStaffMembers::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = SeniorStaffMembers::where('id', $id)->first();
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
