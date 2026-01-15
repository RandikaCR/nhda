<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DownloadCategories;
use App\Models\Downloads;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    private $screenPrefix = 'downloads';

    public function index(Request $request){

        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $downloads = Downloads::select(
            'downloads.*',
            'download_categories.download_category'
        )
            ->join('download_categories', 'download_categories.id', 'downloads.download_category_id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('downloads.en_title', 'like', "%$keyword%")
                    ->orWhere('downloads.si_title', 'like', "%$keyword%")
                    ->orWhere('downloads.ta_title', 'like', "%$keyword%");
            })
            ->orderBy('downloads.id', 'DESC')
            ->groupBy('downloads.id')
            ->paginate(20)
            ->withQueryString();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.downloads.index', [
            'downloads' => $downloads,
            'keyword' => $keyword,
            'is_screen_access' => $isScreenAccess
        ]);

    }

    public function create(Request $request){

        $downloadCategories = DownloadCategories::orderBy('download_category', 'ASC')->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.downloads.create',[
            'download_categories' => $downloadCategories,
            'is_screen_access' => $isScreenAccess,
        ]);
    }

    public function edit(Request $request, $uuId){

        $download = Downloads::where('uuid', $uuId)->first();
        $downloadCategories = DownloadCategories::orderBy('download_category', 'ASC')->get();

        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        return view('backend.downloads.create',[
            'download' => $download,
            'download_categories' => $downloadCategories,
            'is_screen_access' => $isScreenAccess
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'download_category_id' => 'required',
        ]);

        if(!empty($request->id)){
            $save = Downloads::find($request->id);

            $msg = 'Download has been Updated Successfully!';
        }
        else{

            $req = ['screen' =>  $this->screenPrefix, 'id' => ''];
            $uuId = $this->generateUUId($req);

            $save = new downloads();
            $save->uuid = $uuId;
            $save->status = 1;

            $msg = 'Download has been Created Successfully!';
        }

        $save->slug = !empty($request->slug) ? $request->slug : null;
        $save->download_category_id = !empty($request->download_category_id) ? $request->download_category_id : 0;
        $save->en_title = !empty($request->en_title) ? $request->en_title : null;
        $save->si_title = !empty($request->si_title) ? $request->si_title : null;
        $save->ta_title = !empty($request->ta_title) ? $request->ta_title : null;
        $save->en_file = !empty($request->en_file) ? $request->en_file : null;
        $save->si_file = !empty($request->si_file) ? $request->si_file : null;
        $save->ta_file = !empty($request->ta_file) ? $request->ta_file : null;
        $save->is_end_date_available = !empty($request->is_end_date_available) ? 1 : 0;
        $save->end_date = !empty($request->end_date) ? date('Y-m-d 23:59:59', strtotime($request->end_date)) : null;
        $save->save();

        session()->flash('success', $msg);
        return redirect( route('backend.downloads.index') );

    }

    public function delete(Request $request){

        $item = Downloads::find($request->id);
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

        $getCount = Downloads::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = Downloads::where('id', $id)->first();
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

    public function fileUpload(Request $request){

        $file = $request->file('file');

        $newName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newName = $this->generateSeoURL($newName);
        $fileName = $newName . '.' .$file->extension();
        $request->file->move(public_path('uploads/'), $fileName);

        return response()->json([
            'status' => 'success',
            'file_name' => $fileName,
        ]);
    }

}
