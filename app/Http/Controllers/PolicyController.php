<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Policy;

class PolicyController extends Controller
{
    public function index($slug)
    {
        $otherSlides = DB::table('sliders')->where('status', '=', '1')->get();

        $policy = Policy::where('slug', $slug)->first();
        if (!$policy) {
            return redirect('404');
        }
        
        $meta_description = "In the hustle and bustle of Itahari, Sunsari, Eastern Part of Nepal we successfully provide the most sophisticated space. The features are thoughtfully chosen top-quality arrangement, just for you. Hotel maden inn isone of the best and one of the cheapest hotels in Itahari, Susari, Eastern Part of Nepal.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";
        return view('policy',compact('meta_description', 'meta_keywords', 'policy','otherSlides'));



//        $policy = DB::table('tbl_policy')->first();
//        return view('policy', compact('policy'));
    }
}
