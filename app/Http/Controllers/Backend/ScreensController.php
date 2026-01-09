<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Screens;
use App\Models\UserScreens;
use Illuminate\Http\Request;

class ScreensController extends Controller
{
    private $screenPrefix = 'screens';

    public function index()
    {
        $validateArr = ['screen_prefix' => $this->screenPrefix];
        $isScreenAccess = $this->validateScreenAccess($validateArr);

        $items = Screens::orderBy('screen', 'ASC')->get();
        return view('backend.screens.index',[
            'items' => $items,
            'is_screen_access' => $isScreenAccess
        ]);
    }


    public function get(Request $request){
        $req = $request->all();
        $id = !empty($req['id']) ? $req['id'] : 0;


        if (!empty($id)){
            $get = Screens::find($id);
            $status = 'success';

        }else{
            $status = 'error';
        }


        $out = [
            'status' => $status,
            'id' => $id,
            'screen' => $get->screen,
            'screen_prefix' => $get->screen_prefix,
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
                $save = Screens::find($id);
            }
            else{
                $treq = ['screen' => 'screens', 'id' => ''];
                $uuId = $this->generateUUId($treq);

                $save = New Screens();
                $save->uuid = $uuId;
                $save->status = 1;
            }

            $save->screen = $req['screen'];
            $save->screen_prefix = !empty($req['screen_prefix']) ? $req['screen_prefix'] : null;
            $save->save();
            $status = 'success';
            $messageTitle = 'Success';
            $messageText = 'Screen saved';
        }else{

            $status = 'error';
            $messageTitle = 'Error!';
            $messageText = 'Screen exist!';
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
            $get = Screens::find($id);

            if ($get->status == 1){
                $get->status = 0;
            }else {
                $get->status = 1;
            }
            $get->save();
            $status = 'success';
            $get = Screens::find($id);
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
        $slug = $this->generateSeoURL($request->title, 1);

        $getCount = Screens::where('slug', $slug)->count();
        if ($getCount > 0){
            $item = Screens::where('id', $id)->first();
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
