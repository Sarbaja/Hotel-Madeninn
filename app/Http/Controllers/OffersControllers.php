<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffersControllers extends Controller
{
    public function index()
    {
        $otherSlides = DB::table('sliders')->where('status', '=', '1')->get();
        $offers = DB::table('tbl_retails')->where('id', 2)->first();
         $meta_description = "In the hustle and bustle of Itahari, Sunsari, Eastern Part of Nepal we successfully provide the most sophisticated space. The features are thoughtfully chosen top-quality arrangement, just for you. Hotel maden inn isone of the best and one of the cheapest hotels in Itahari, Susari, Eastern Part of Nepal.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";
        $gallery = DB::table('tbl_gallery')->where('album_id', 2)->limit(9)->get();
        
        return view('offers', compact('meta_description', 'meta_keywords', 'offers','otherSlides', 'gallery'));
    }
}
