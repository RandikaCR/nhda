<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProjectImages;
use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    private $screenPrefix = 'projects';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $projects = Projects::select(
            'projects.*',
            'project_images.image AS primary_image',
        )
            ->leftJoin('project_images', 'projects.id', 'project_images.project_id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('projects.en_title', 'like', "%$keyword%")
                    ->orWhere('projects.si_title', 'like', "%$keyword%")
                    ->orWhere('projects.ta_title', 'like', "%$keyword%")
                    ->orWhere('projects.en_content', 'like', "%$keyword%")
                    ->orWhere('projects.si_content', 'like', "%$keyword%")
                    ->orWhere('projects.ta_content', 'like', "%$keyword%");
            })
            //->where('project_images.is_primary', 1)
            ->orderBy('projects.id', 'DESC')
            ->groupBy('projects.id')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.projects.index', [
            'projects' => $projects,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $tempId = $this->getTempProjectId($request);
        $images = ProjectImages::where('project_id', $tempId)->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.projects.create',[
            'temp_id' => $tempId,
            'images' => $images,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){
        $this->clearTempProjectId($request);

        $project = Projects::where('uuid', $uuId)->first();
        $tempId = $project->id;
        $images = ProjectImages::where('project_id', $tempId)->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.projects.create',[
            'temp_id' => $tempId,
            'project' => $project,
            'images' => $images,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'slug' => 'required',
            'en_title' => 'required',
        ]);

        if(!empty($request->id)){
            $save = Projects::find($request->id);

            $msg = 'Project has been Updated Successfully!';
        }
        else{

            $req = ['screen' =>  $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new Projects();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'Project has been Created Successfully!';
        }

        $save->slug = !empty($request->slug) ? $request->slug : null;
        $save->en_title = !empty($request->en_title) ? $request->en_title : null;
        $save->si_title = !empty($request->si_title) ? $request->si_title : null;
        $save->ta_title = !empty($request->ta_title) ? $request->ta_title : null;
        $save->en_content = !empty($request->en_content) ? $request->en_content : null;
        $save->si_content = !empty($request->si_content) ? $request->si_content : null;
        $save->ta_content = !empty($request->ta_content) ? $request->ta_content : null;
        $save->save();

        if (!empty(session('temp_project_id'))){
            $sessionId = session('temp_project_id');
            $this->clearTempProjectId($request);
            $images = ProjectImages::where('project_id', $sessionId)->get();

            $primaryImageId = 0;
            foreach ($images as $img){

                if (!empty($img->is_primary)){
                    $primaryImageId = $img->id;
                }

                $image = ProjectImages::find($img->id);
                $image->project_id = $save->id;
                $image->save();
            }

            //Set Primary Image if not has been set
            if (empty($primaryImageId)){
                $image = ProjectImages::where('project_id', $sessionId)->first();
                $image = ProjectImages::find($img->id);
                $image->is_primary = 1;
                $image->save();
            }
        }

        session()->flash('success', $msg);
        return redirect( route('backend.projects.index') );

    }

    public function delete(Request $request){

        $item = Projects::find($request->id);
        $item->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function getTempProjectId(Request $request){
        $rand = rand(10000000,99999999) . time();
        $tempId = !empty(session('temp_project_id')) ? session('temp_project_id') : null;
        if (empty($tempId)){
            $request->session()->put('temp_project_id', $rand);
            $request->session()->save();

            $tempId = $rand;
        }

        return $tempId;
    }

    public function clearTempProjectId(Request $request){

        $tempId = !empty(session('temp_project_id')) ? session('temp_project_id') : null;
        if (!empty($tempId)){
            $request->session()->forget('temp_project_id');
            $request->session()->save();
        }

        return true;
    }

    public function imageUpload(Request $request){

        $status = 'error';
        $file_name = '';

        if($request->ajax()){

            $img = $this->commonImageUpload($request);
            $file_name = $img['file_name'];
            $status = $img['status'];

            $imgCount = ProjectImages::where('project_id', $request->id)->where('is_primary', 1)->count();
            $isPrimary = empty($imgCount) ? 1 : 0;

            $imgId = 0;
            if (!empty($file_name)){
                $img = new ProjectImages();
                $img->project_id = $request->id;
                $img->image = $file_name;
                $img->is_primary = $isPrimary;
                $img->status = 1;
                $img->save();

                $imgId = $img->id;
                $isPrimary = $img->is_primary;
            }

            return response()->json([
                'status' =>  $status,
                'filename' =>  $file_name,
                'id' =>  $imgId,
                'is_primary' =>  $isPrimary,
            ]);

        }
    }

    public function slugGenerator(Request $request){

        $status = 'success';
        $isExist = 0;
        $id = $request->id;
        $slug = $this->generateSeoURL($request->title);

        $getCount = Projects::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = Projects::where('id', $id)->first();
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

    public function deleteImage(Request $request){

        $img = ProjectImages::find($request->id);
        $img->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function setPrimaryImage(Request $request){

        $img = ProjectImages::find($request->id);

        $images = ProjectImages::where('project_id', $img->project_id)->get();
        if (!empty($images)){
            foreach ($images as $image){
                $i = ProjectImages::find($image->id);
                $i->is_primary = 0;
                $i->save();
            }
        }

        $img->is_primary = 1;
        $img->save();

        $images = [];
        $getImages = ProjectImages::where('project_id', $img->project_id)->get();
        foreach ($getImages as $image){

            $isPrimary = !empty($image->is_primary) ? 1 : 0;

            $images[] = [
                'filename' =>  $image->image,
                'id' =>  $image->id,
                'is_primary' =>  $isPrimary,
            ];
        }

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
            'images' =>  $images,
        ]);
    }
}
