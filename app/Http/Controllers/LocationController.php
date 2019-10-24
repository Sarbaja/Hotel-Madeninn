<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index($slug)
    {

        $location = DB::table('tbl_locations')->where('slug', $slug)->first();
        $otherSlides = DB::table('sliders')->where('status', '=', '1')->get();
        $meta_description = "Plan a birthday celebration at The Terrace Garden, or host a conference in Banquet Hall. Along with Wi-Fi and on-site catering options, our flexible meeting rooms can turn any occasion into a memorable moment.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";
        $gallery = DB::table('tbl_gallery')->where('album_id', 2)->limit(9)->get();

        return view('location', compact('meta_description', 'meta_keywords', 'location','otherSlides', 'gallery'));
    }
}
