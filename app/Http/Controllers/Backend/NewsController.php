<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsImages;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $screenPrefix = 'news';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $news = News::select(
            'news.*',
            'news_images.image AS primary_image',
        )
            ->leftJoin('news_images', 'news.id', 'news_images.news_id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('news.en_title', 'like', "%$keyword%")
                    ->orWhere('news.si_title', 'like', "%$keyword%")
                    ->orWhere('news.ta_title', 'like', "%$keyword%")
                    ->orWhere('news.en_content', 'like', "%$keyword%")
                    ->orWhere('news.si_content', 'like', "%$keyword%")
                    ->orWhere('news.ta_content', 'like', "%$keyword%");
            })
            //->where('news_images.is_primary', 1)
            ->orderBy('news.id', 'DESC')
            ->groupBy('news.id')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.news.index', [
            'all_news' => $news,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $tempId = $this->getTempNewsId($request);
        $images = NewsImages::where('news_id', $tempId)->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.news.create',[
            'temp_id' => $tempId,
            'images' => $images,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function edit(Request $request, $uuId){
        $this->clearTempNewsId($request);

        $news = News::where('uuid', $uuId)->first();
        $tempId = $news->id;
        $images = NewsImages::where('news_id', $tempId)->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.news.create',[
            'temp_id' => $tempId,
            'news' => $news,
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
            $save = News::find($request->id);

            $msg = 'News has been Updated Successfully!';
        }
        else{

            $req = ['screen' => $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new News();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'News has been Created Successfully!';
        }

        $save->slug = !empty($request->slug) ? $request->slug : null;
        $save->en_title = !empty($request->en_title) ? $request->en_title : null;
        $save->si_title = !empty($request->si_title) ? $request->si_title : null;
        $save->ta_title = !empty($request->ta_title) ? $request->ta_title : null;
        $save->en_content = !empty($request->en_content) ? $request->en_content : null;
        $save->si_content = !empty($request->si_content) ? $request->si_content : null;
        $save->ta_content = !empty($request->ta_content) ? $request->ta_content : null;
        $save->save();

        if (!empty(session('temp_news_id'))){
            $sessionId = session('temp_news_id');
            $this->clearTempNewsId($request);
            $images = NewsImages::where('news_id', $sessionId)->get();

            $primaryImageId = 0;
            foreach ($images as $img){

                if (!empty($img->is_primary)){
                    $primaryImageId = $img->id;
                }

                $image = NewsImages::find($img->id);
                $image->news_id = $save->id;
                $image->save();
            }

            //Set Primary Image if not has been set
            if (empty($primaryImageId)){
                $image = NewsImages::where('news_id', $sessionId)->first();
                $image = NewsImages::find($img->id);
                $image->is_primary = 1;
                $image->save();
            }
        }

        session()->flash('success', $msg);
        return redirect( route('backend.news.index') );

    }

    public function delete(Request $request){

        $news = News::find($request->id);
        $news->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function getTempNewsId(Request $request){
        $rand = rand(10000000,99999999) . time();
        $tempId = !empty(session('temp_news_id')) ? session('temp_news_id') : null;
        if (empty($tempId)){
            $request->session()->put('temp_news_id', $rand);
            $request->session()->save();

            $tempId = $rand;
        }

        return $tempId;
    }

    public function clearTempNewsId(Request $request){

        $tempId = !empty(session('temp_news_id')) ? session('temp_news_id') : null;
        if (!empty($tempId)){
            $request->session()->forget('temp_news_id');
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

            $imgCount = NewsImages::where('news_id', $request->id)->where('is_primary', 1)->count();
            $isPrimary = empty($imgCount) ? 1 : 0;

            $imgId = 0;
            if (!empty($file_name)){
                $img = new NewsImages();
                $img->news_id = $request->id;
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

        $getCount = News::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = News::where('id', $id)->first();
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

        $img = NewsImages::find($request->id);
        $img->delete();

        return response()->json([
            'status' => 'success',
            'id' =>  $request->id,
        ]);
    }

    public function setPrimaryImage(Request $request){

        $img = NewsImages::find($request->id);

        $images = NewsImages::where('news_id', $img->news_id)->get();
        if (!empty($images)){
            foreach ($images as $image){
                $i = NewsImages::find($image->id);
                $i->is_primary = 0;
                $i->save();
            }
        }

        $img->is_primary = 1;
        $img->save();

        $images = [];
        $getImages = NewsImages::where('news_id', $img->news_id)->get();
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
