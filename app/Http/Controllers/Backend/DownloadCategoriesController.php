<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DownloadCategories;
use Illuminate\Http\Request;

class DownloadCategoriesController extends Controller
{
    private $screenPrefix = 'download_categories';

    public function index()
    {
        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        $items = DownloadCategories::orderBy('id', 'ASC')->get();
        return view('backend.download-categories.index',[
            'items' => $items,
            'is_screen_access' => $isScreenAccess
        ]);
    }


    public function get(Request $request){
        $req = $request->all();
        $id = !empty($req['id']) ? $req['id'] : 0;


        if (!empty($id)){
            $get = DownloadCategories::find($id);
            $status = 'success';

        }else{
            $status = 'error';
        }


        $out = [
            'status' => $status,
            'id' => $id,
            'slug' => $get->slug,
            'download_category' => $get->download_category,
            'download_category_si' => $get->download_category_si,
            'download_category_ta' => $get->download_category_ta,
        ];
        return response()->json($out);

    }

    public function store(Request $request){
        $req = $request->all();
        $id = !empty($req['id']) ? $req['id'] : 0;

        /*$validator = $request->validate([
            'news_category' => ['required', 'string', 'unique:product_gender_categories'],
        ]);*/

        $validator = 1;

        if ($validator){

            if (!empty($id)){
                $save = DownloadCategories::find($id);
            }
            else{
                $treq = ['screen' => 'download_categories', 'id' => ''];
                $uuId = $this->generateUUId($treq);

                $save = New DownloadCategories();
                $save->uuid = $uuId;
                $save->status = 1;
            }


            $save->slug = !empty($req['slug']) ? $req['slug'] : null;
            $save->download_category = !empty($req['download_category']) ? $req['download_category'] : null;
            $save->download_category_si = !empty($req['download_category_si']) ? $req['download_category_si'] : null;
            $save->download_category_ta = !empty($req['download_category_ta']) ? $req['download_category_ta'] : null;
            $save->save();
            $status = 'success';
            $messageTitle = 'Success';
            $messageText = 'Download Category saved';
        }else{

            $status = 'error';
            $messageTitle = 'Error!';
            $messageText = 'Download Category exist!';
        }



        $out = [
            'status' => $status,
            'message_title' => $messageTitle,
            'message_text' => $messageText,
        ];
        return response()->json($out);

        /*if ($response->successful()) {
            $rdata = $response->json();
            if (!empty($rdata)) {
                return response()->json($rdata);
            }
        } else if ($response->status() == 400) {
            return response()->json($response->json(), 422);
        } else if ($response->status() == 401) {
            return response()->json($response->json(), 401);
        }*/
    }

    public function status(Request $request){
        $req = $request->all();
        $id = !empty($req['id']) ? $req['id'] : 0;

        $text = '';
        $class = '';

        if (!empty($id)){
            $get = DownloadCategories::find($id);

            if ($get->status == 1){
                $get->status = 0;
            }else {
                $get->status = 1;
            }
            $get->save();
            $status = 'success';
            $get = DownloadCategories::find($id);
            $getStatus = $this->categoryStatus($get->status);
            $text = $getStatus->text;
            $class = $getStatus->class;

        }else{
            $status = 'error';
        }


        $out = [
            'status' => $status,
            'text' => $text,
            'class' => $class,
        ];
        return response()->json($out);

    }

    public function slugGenerator(Request $request){

        $status = 'success';
        $isExist = 0;
        $id = $request->id;
        $slug = $this->generateSeoURL($request->category, 1);

        $getCount = DownloadCategories::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = DownloadCategories::where('id', $id)->first();
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
