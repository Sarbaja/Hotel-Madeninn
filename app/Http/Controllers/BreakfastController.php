<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BreakfastController extends Controller
{
    public function index()
    {
        $breakfast = DB::table('tbl_breakfast')->where('featured', 1)->first();
        $breakfastImages = DB::table('tbl_breakfast_images')->get();
        
        $meta_description = "We bet you'd never guess the fruits and vegetables growing in the home can be unbeatable. We keep it simple serve yummy for the belly, that guests will want to return to week after week.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";
        return view('breakfast', compact('meta_description', 'meta_keywords', 'breakfast', 'breakfastImages'));
    }
}
