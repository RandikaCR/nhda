<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Videos;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    private $screenPrefix = 'videos';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $videos = Videos::select(
            'videos.*',
        )
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('videos.en_title', 'like', "%$keyword%")
                    ->orWhere('videos.si_title', 'like', "%$keyword%")
                    ->orWhere('videos.ta_title', 'like', "%$keyword%");
            })
            ->orderBy('videos.id', 'DESC')
            ->groupBy('videos.id')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.videos.index', [
            'videos' => $videos,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.videos.create',[
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){

        $video = Videos::where('uuid', $uuId)->first();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.videos.create',[
            'video' => $video,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'slug' => 'required',
            'en_title' => 'required',
            'video' => 'required',
        ]);

        if(!empty($request->id)){
            $save = Videos::find($request->id);

            $msg = 'Video has been Updated Successfully!';
        }
        else{

            $req = ['screen' =>  $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new Videos();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'Video has been Created Successfully!';
        }

        $save->slug = !empty($request->slug) ? $request->slug : null;
        $save->video = !empty($request->video) ? $request->video : null;
        $save->en_title = !empty($request->en_title) ? $request->en_title : null;
        $save->si_title = !empty($request->si_title) ? $request->si_title : null;
        $save->ta_title = !empty($request->ta_title) ? $request->ta_title : null;
        $save->save();

        session()->flash('success', $msg);
        return redirect( route('backend.videos.index') );

    }

    public function delete(Request $request){

        $item = Videos::find($request->id);
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
        $slug = $this->generateSeoURL($request->title);

        $getCount = Videos::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = Videos::where('id', $id)->first();
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
