<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralAboutDetails;
use Illuminate\Http\Request;

class GeneralAboutDetailsController extends Controller
{
    private $screenPrefix = 'general_about_details';

    public function index()
    {
        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        $about = GeneralAboutDetails::where('id', '1')->first();
        return view('backend.general.about-us',[
            'about' => $about,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        $msg = 'Services could not be saved. Please, try again.!';

        if(!empty($request->id)){

            $save = GeneralAboutDetails::find($request->id);
            $save->en_title = !empty($request->en_title) ? $request->en_title : null;
            $save->si_title = !empty($request->si_title) ? $request->si_title : null;
            $save->ta_title = !empty($request->ta_title) ? $request->ta_title : null;
            $save->en_content = !empty($request->en_content) ? $request->en_content : null;
            $save->si_content = !empty($request->si_content) ? $request->si_content : null;
            $save->ta_content = !empty($request->ta_content) ? $request->ta_content : null;

            $save->en_objective_title = !empty($request->en_objective_title) ? $request->en_objective_title : null;
            $save->si_objective_title = !empty($request->si_objective_title) ? $request->si_objective_title : null;
            $save->ta_objective_title = !empty($request->ta_objective_title) ? $request->ta_objective_title : null;
            $save->en_objective_content = !empty($request->en_objective_content) ? $request->en_objective_content : null;
            $save->si_objective_content = !empty($request->si_objective_content) ? $request->si_objective_content : null;
            $save->ta_objective_content = !empty($request->ta_objective_content) ? $request->ta_objective_content : null;

            $save->en_vision_title = !empty($request->en_vision_title) ? $request->en_vision_title : null;
            $save->si_vision_title = !empty($request->si_vision_title) ? $request->si_vision_title : null;
            $save->ta_vision_title = !empty($request->ta_vision_title) ? $request->ta_vision_title : null;
            $save->en_vision_content = !empty($request->en_vision_content) ? $request->en_vision_content : null;
            $save->si_vision_content = !empty($request->si_vision_content) ? $request->si_vision_content : null;
            $save->ta_vision_content = !empty($request->ta_vision_content) ? $request->ta_vision_content : null;

            $save->en_mission_title = !empty($request->en_mission_title) ? $request->en_mission_title : null;
            $save->si_mission_title = !empty($request->si_mission_title) ? $request->si_mission_title : null;
            $save->ta_mission_title = !empty($request->ta_mission_title) ? $request->ta_mission_title : null;
            $save->en_mission_content = !empty($request->en_mission_content) ? $request->en_mission_content : null;
            $save->si_mission_content = !empty($request->si_mission_content) ? $request->si_mission_content : null;
            $save->ta_mission_content = !empty($request->ta_mission_content) ? $request->ta_mission_content : null;
            $save->save();

            $msg = 'About Details has been Created Successfully!';
        }

        session()->flash('success', $msg);
        return redirect( route('backend.generalAboutDetails.index') );

    }
}
