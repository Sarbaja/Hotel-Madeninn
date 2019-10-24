<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index($slug)
    {
        $otherSlides = DB::table('sliders')->where('status', '=', '1')->get();

        $meeting1 = DB::table('tbl_meetings')->where('slug', $slug)->first();
        $meta_description = "Plan a birthday celebration at The Terrace Garden, or host a conference in Banquet Hall. Along with Wi-Fi and on-site catering options, our flexible meeting rooms can turn any occasion into a memorable moment. In the hustle and bustle of Itahari, Sunsari, Eastern Part of Nepal we successfully provide the most sophisticated space. The features are thoughtfully chosen top-quality arrangement, just for you. Hotel maden inn isone of the best and one of the cheapest hotels in Itahari, Susari, Eastern Part of Nepal.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";
        $gallery = DB::table('tbl_gallery')->where('album_id', 2)->limit(9)->get();

        return view('meeting', compact('meta_description', 'meta_keywords', 'meeting1', 'otherSlides', 'gallery'));
    }
}
