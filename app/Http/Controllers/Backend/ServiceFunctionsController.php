<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServicesFunctions;
use Illuminate\Http\Request;

class ServiceFunctionsController extends Controller
{
    private $screenPrefix = 'service_functions';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $servicesFunctions = ServicesFunctions::select(
            'services_functions.*',
        )
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('services_functions.en_title', 'like', "%$keyword%")
                    ->orWhere('services_functions.si_title', 'like', "%$keyword%")
                    ->orWhere('services_functions.ta_title', 'like', "%$keyword%")
                    ->orWhere('services_functions.en_content', 'like', "%$keyword%")
                    ->orWhere('services_functions.si_content', 'like', "%$keyword%")
                    ->orWhere('services_functions.ta_content', 'like', "%$keyword%");
            })
            ->orderBy('services_functions.id', 'DESC')
            ->groupBy('services_functions.id')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.service-functions.index', [
            'service_functions' => $servicesFunctions,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $tempId = $this->getTempServiceFunctionId($request);

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.service-functions.create',[
            'temp_id' => $tempId,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){
        $this->clearTempServiceFunctionId($request);

        $serviceFunction = ServicesFunctions::where('uuid', $uuId)->first();
        $tempId = $serviceFunction->id;

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.service-functions.create',[
            'temp_id' => $tempId,
            'sf' => $serviceFunction,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'slug' => 'required',
            'en_title' => 'required',
        ]);

        if(!empty($request->id)){
            $save = ServicesFunctions::find($request->id);

            $msg = 'Service Function has been Updated Successfully!';
        }
        else{

            $req = ['screen' =>  $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new ServicesFunctions();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'Service Function has been Created Successfully!';
        }

        $save->slug = !empty($request->slug) ? $request->slug : null;
        $save->en_title = !empty($request->en_title) ? $request->en_title : null;
        $save->si_title = !empty($request->si_title) ? $request->si_title : null;
        $save->ta_title = !empty($request->ta_title) ? $request->ta_title : null;
        $save->en_content = !empty($request->en_content) ? $request->en_content : null;
        $save->si_content = !empty($request->si_content) ? $request->si_content : null;
        $save->ta_content = !empty($request->ta_content) ? $request->ta_content : null;
        $save->save();

        if (!empty(session('temp_service_function_id'))){
            $sessionId = session('temp_service_function_id');
            $this->clearTempServiceFunctionId($request);
        }

        session()->flash('success', $msg);
        return redirect( route('backend.serviceFunctions.index') );

    }

    public function delete(Request $request){

        $item = ServicesFunctions::find($request->id);
        $item->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function getTempServiceFunctionId(Request $request){
        $rand = rand(10000000,99999999) . time();
        $tempId = !empty(session('temp_service_function_id')) ? session('temp_service_function_id') : null;
        if (empty($tempId)){
            $request->session()->put('temp_service_function_id', $rand);
            $request->session()->save();

            $tempId = $rand;
        }

        return $tempId;
    }

    public function clearTempServiceFunctionId(Request $request){

        $tempId = !empty(session('temp_service_function_id')) ? session('temp_service_function_id') : null;
        if (!empty($tempId)){
            $request->session()->forget('temp_service_function_id');
            $request->session()->save();
        }

        return true;
    }

    public function slugGenerator(Request $request){

        $status = 'success';
        $isExist = 0;
        $id = $request->id;
        $slug = $this->generateSeoURL($request->title);

        $getCount = ServicesFunctions::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = ServicesFunctions::where('id', $id)->first();
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
