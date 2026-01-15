<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DistrictOffices;
use Illuminate\Http\Request;

class DistrictOfficesController extends Controller
{
    private $screenPrefix = 'district_offices';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $districtOffices = DistrictOffices::select(
            'district_offices.*',
        )
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('district_offices.office', 'like', "%$keyword%")
                    ->orWhere('district_offices.manager_name', 'like', "%$keyword%")
                    ->orWhere('district_offices.phone', 'like', "%$keyword%")
                    ->orWhere('district_offices.mobile', 'like', "%$keyword%")
                    ->orWhere('district_offices.fax', 'like', "%$keyword%")
                    ->orWhere('district_offices.email', 'like', "%$keyword%")
                    ->orWhere('district_offices.address', 'like', "%$keyword%");
            })
            ->orderBy('district_offices.office', 'ASC')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.district-offices.index', [
            'district_offices' => $districtOffices,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.district-offices.create',[
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){

        $districtOffice = DistrictOffices::where('uuid', $uuId)->first();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.district-offices.create',[
            'office' => $districtOffice,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'slug' => 'required',
            'office' => 'required',
        ]);

        if(!empty($request->id)){
            $save = DistrictOffices::find($request->id);

            $msg = 'District Office has been Updated Successfully!';
        }
        else{

            $req = ['screen' =>  $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new DistrictOffices();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'District Office has been Created Successfully!';
        }

        $save->slug = !empty($request->slug) ? $request->slug : null;
        $save->office = !empty($request->office) ? $request->office : null;
        $save->manager_name = !empty($request->manager_name) ? $request->manager_name : null;
        $save->phone = !empty($request->phone) ? $request->phone : null;
        $save->mobile = !empty($request->mobile) ? $request->mobile : null;
        $save->fax = !empty($request->fax) ? $request->fax : null;
        $save->email = !empty($request->email) ? $request->email : null;
        $save->address = !empty($request->address) ? $request->address : null;
        $save->map = !empty($request->map) ? $request->map : null;
        $save->save();


        session()->flash('success', $msg);
        return redirect( route('backend.districtOffices.index') );

    }

    public function delete(Request $request){

        $item = DistrictOffices::find($request->id);
        $item->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function slugGenerator(Request $request){

        $status = 'success';
        $isExist = 0;
        $id = $request->id;
        $slug = $this->generateSeoURL($request->title, 1);

        $getCount = DistrictOffices::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = DistrictOffices::where('id', $id)->first();
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
