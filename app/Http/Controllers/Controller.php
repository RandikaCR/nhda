<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

abstract class Controller
{
    public $userId = null;
    public $locale = null;

    public function __construct(Request $request){
        if ( !empty(Session::get('locale')) ){
            $this->locale = Session::get('locale');
        }else{
            $this->locale = App::currentLocale();
        }

        // $this->locale = App::currentLocale();

        if (!empty(Auth::user()) && !empty(Auth::user()->id)){
            $this->userId = Auth::user()->id;
        }

    }


    public function generateSeoURL($string, $wordLimit = 0){
        $separator = '-';

        if($wordLimit != 0){
            $wordArr = explode(' ', $string);
            $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
        }

        $quoteSeparator = preg_quote($separator, '#');

        $trans = array(
            '&.+?;'                 => '',
            '[^\w\d _-]'            => '',
            '\s+'                   => $separator,
            '('.$quoteSeparator.')+'=> $separator
        );

        $string = strip_tags($string);
        foreach ($trans as $key => $val){
            $string = preg_replace('#'.$key.'#iu', $val, $string);
        }

        $string = strtolower($string);
        $slug = trim(trim($string, $separator)) . '-' . time();

        return $slug;
    }



    public function dbInsertTime($dateTime = null){
        if (!empty($dateTime)){
            $now = date('Y-m-d H:i:s', strtotime($dateTime));
        }else{
            $now = date('Y-m-d H:i:s', time());
        }

        return $now;
    }


    public function generateUUId($res = [])
    {
        if (!empty($res)){
            $screen = !empty($res['screen']) ? $res['screen'] : 'temp';
            $id = !empty($res['id']) ? $res['id'] : rand(0,99999999);
            $uuId = sha1( $screen . $id . time());
        }
        else{
            $uuId = sha1(rand(0,99999999) . rand(0,99999999) . rand(0,99999999) );
        }

        return $uuId;
    }


    public function commonImageUpload($req){

        $status = 'error';
        $file_name = '';

        $image_data = $req->image;
        $image_array_1 = explode(";", $image_data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = time() . '_temp.png';
        $upload_path = public_path('assets/common/images/uploads/' . $image_name);
        file_put_contents($upload_path, $data);

        if ( file_exists($upload_path)) {

            $file_name = time() . '.jpg';
            $file_name_with_path = public_path('assets/common/images/uploads/' . $file_name);
            $image = imagecreatefrompng($upload_path);
            imagejpeg($image, $file_name_with_path, 90);
            imagedestroy($image);

            unlink($upload_path);
            $status = 'Image Uploaded!';
        }

        $out = [
            'status' => $status,
            'file_name' => $file_name,
        ];
        return $out;
    }
}
