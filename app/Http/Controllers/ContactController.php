<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $otherSlides = DB::table('sliders')->where('status', '=', '1')->get();
        $setting = Setting::find('1');
        
        $meta_description = "In the hustle and bustle of Itahari, Sunsari, Eastern Part of Nepal we successfully provide the most sophisticated space. The features are thoughtfully chosen top-quality arrangement, just for you. Hotel maden inn isone of the best and one of the cheapest hotels in Itahari, Susari, Eastern Part of Nepal.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";
        return view('contact', compact('meta_description', 'meta_keywords', 'setting','otherSlides'));
    }
}
