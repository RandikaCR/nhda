<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    private $screenPrefix = 'services';

    public function index()
    {
        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        $services = Services::where('id', '1')->first();
        return view('backend.services.index',[
            'services' => $services,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        $msg = 'Services could not be saved. Please, try again.!';

        if(!empty($request->id)){

            $save = Services::find($request->id);
            $save->en_title = !empty($request->en_title) ? $request->en_title : null;
            $save->si_title = !empty($request->si_title) ? $request->si_title : null;
            $save->ta_title = !empty($request->ta_title) ? $request->ta_title : null;
            $save->en_content = !empty($request->en_content) ? $request->en_content : null;
            $save->si_content = !empty($request->si_content) ? $request->si_content : null;
            $save->ta_content = !empty($request->ta_content) ? $request->ta_content : null;
            $save->save();

            $msg = 'Services has been Created Successfully!';
        }

        session()->flash('success', $msg);
        return redirect( route('backend.services.index') );

    }
}
