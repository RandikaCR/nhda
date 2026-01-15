<?php
namespace App\Helpers;

use App\Models\DownloadCategories;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DownloadCategoriesHelper
{

    public function getDownloadCategoriesForNavigation(){
        $locale = App::currentLocale();
        if ( !empty(Session::get('locale')) ){
            $locale = Session::get('locale');
        }

        $categories = [];

        $getCategories = DownloadCategories::where('status', 1)->get();

        foreach ($getCategories as $cat) {
            $thisCat = [];
            $thisCat['slug'] = $cat->slug;
            if ($locale == 'si'){
                $thisCat['download_category'] = $cat->download_category_si;
            }elseif( $locale == 'ta'){
                $thisCat['download_category'] = $cat->download_category_ta;
            }else{
                $thisCat['download_category'] = $cat->download_category;
            }

            $categories[] = $thisCat;
        }

        return $categories;
    }

}

