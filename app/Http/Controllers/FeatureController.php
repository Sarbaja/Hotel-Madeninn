<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $breakfast = DB::table('tbl_breakfast')->where('featured', 1)->first();
        $breakfastId = $breakfast->id;
        $breakfastImages = DB::table('tbl_breakfast_images')->where('breakfast_id', $breakfastId)->limit(4)->get();
        $rooms = DB::table('tbl_rooms')->where('display', 1)->get();
        $roomImages = DB::table('tbl_room_images')->limit(4)->get();
         $meta_description = "Plan a birthday celebration at The Terrace Garden, or host a conference in Banquet Hall. Along with Wi-Fi and on-site catering options, our flexible meeting rooms can turn any occasion into a memorable moment.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";

        return view('feature', compact('meta_description', 'meta_keywords', 'breakfast', 'breakfastImages', 'rooms', 'roomImages'));
    }
}
