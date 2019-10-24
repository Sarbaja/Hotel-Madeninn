<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    public function index()
    {
        $attractions = DB::table('tbl_attractions')->where('display', 1)->get();
        $meta_description = "In the hustle and bustle of Itahari, Sunsari, Eastern Part of Nepal we successfully provide the most sophisticated space. The features are thoughtfully chosen top-quality arrangement, just for you. Hotel maden inn isone of the best and one of the cheapest hotels in Itahari, Susari, Eastern Part of Nepal.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";

        return view('attract', compact('meta_description', 'meta_keywords', 'attractions'));
    }
}
