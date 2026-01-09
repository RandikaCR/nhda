<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PressReleaseImages;
use App\Models\PressReleases;
use Illuminate\Http\Request;

class PressReleasesController extends Controller
{
    private $screenPrefix = 'press_releases';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $pressReleases = PressReleases::select(
            'press_releases.*',
            'press_release_images.image AS primary_image',
        )
            ->join('press_release_images', 'press_releases.id', 'press_release_images.press_release_id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('press_releases.en_title', 'like', "%$keyword%")
                    ->orWhere('press_releases.si_title', 'like', "%$keyword%")
                    ->orWhere('press_releases.ta_title', 'like', "%$keyword%")
                    ->orWhere('press_releases.en_content', 'like', "%$keyword%")
                    ->orWhere('press_releases.si_content', 'like', "%$keyword%")
                    ->orWhere('press_releases.ta_content', 'like', "%$keyword%");
            })
            ->where('press_release_images.is_primary', 1)
            ->orderBy('press_releases.id', 'DESC')
            ->groupBy('press_releases.id')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.press-releases.index', [
            'press_releases' => $pressReleases,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $tempId = $this->getTempPressReleaseId($request);
        $images = PressReleaseImages::where('press_release_id', $tempId)->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.press-releases.create',[
            'temp_id' => $tempId,
            'images' => $images,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){
        $this->clearTempPressReleaseId($request);

        $pressRelease = PressReleases::where('uuid', $uuId)->first();
        $tempId = $pressRelease->id;
        $images = PressReleaseImages::where('press_release_id', $tempId)->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.press-releases.create',[
            'temp_id' => $tempId,
            'press' => $pressRelease,
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
            $save = PressReleases::find($request->id);

            $msg = 'Press Release has been Updated Successfully!';
        }
        else{

            $req = ['screen' =>  $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new PressReleases();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'Press Release has been Created Successfully!';
        }

        $save->slug = !empty($request->slug) ? $request->slug : null;
        $save->en_title = !empty($request->en_title) ? $request->en_title : null;
        $save->si_title = !empty($request->si_title) ? $request->si_title : null;
        $save->ta_title = !empty($request->ta_title) ? $request->ta_title : null;
        $save->en_content = !empty($request->en_content) ? $request->en_content : null;
        $save->si_content = !empty($request->si_content) ? $request->si_content : null;
        $save->ta_content = !empty($request->ta_content) ? $request->ta_content : null;
        $save->save();

        if (!empty(session('temp_press_release_id'))){
            $sessionId = session('temp_press_release_id');
            $this->clearTempPressReleaseId($request);
            $images = PressReleaseImages::where('press_release_id', $sessionId)->get();

            $primaryImageId = 0;
            foreach ($images as $img){

                if (!empty($img->is_primary)){
                    $primaryImageId = $img->id;
                }

                $image = PressReleaseImages::find($img->id);
                $image->press_release_id = $save->id;
                $image->save();
            }

            //Set Primary Image if not has been set
            if (empty($primaryImageId)){
                $image = PressReleaseImages::where('press_release_id', $sessionId)->first();
                $image = PressReleaseImages::find($img->id);
                $image->is_primary = 1;
                $image->save();
            }
        }

        session()->flash('success', $msg);
        return redirect( route('backend.pressReleases.index') );

    }

    public function delete(Request $request){

        $press = PressReleases::find($request->id);
        $press->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function getTempPressReleaseId(Request $request){
        $rand = rand(10000000,99999999) . time();
        $tempId = !empty(session('temp_press_release_id')) ? session('temp_press_release_id') : null;
        if (empty($tempId)){
            $request->session()->put('temp_press_release_id', $rand);
            $request->session()->save();

            $tempId = $rand;
        }

        return $tempId;
    }

    public function clearTempPressReleaseId(Request $request){

        $tempId = !empty(session('temp_press_release_id')) ? session('temp_press_release_id') : null;
        if (!empty($tempId)){
            $request->session()->forget('temp_press_release_id');
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

            $imgCount = PressReleaseImages::where('press_release_id', $request->id)->where('is_primary', 1)->count();
            $isPrimary = empty($imgCount) ? 1 : 0;

            $imgId = 0;
            if (!empty($file_name)){
                $img = new PressReleaseImages();
                $img->press_release_id = $request->id;
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

        $getCount = PressReleases::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = PressReleases::where('id', $id)->first();
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

        $img = PressReleaseImages::find($request->id);
        $img->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function setPrimaryImage(Request $request){

        $img = PressReleaseImages::find($request->id);

        $images = PressReleaseImages::where('press_release_id', $img->press_release_id)->get();
        if (!empty($images)){
            foreach ($images as $image){
                $i = PressReleaseImages::find($image->id);
                $i->is_primary = 0;
                $i->save();
            }
        }

        $img->is_primary = 1;
        $img->save();

        $images = [];
        $getImages = PressReleaseImages::where('press_release_id', $img->press_release_id)->get();
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
