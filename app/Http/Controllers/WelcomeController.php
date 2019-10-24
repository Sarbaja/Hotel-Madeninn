<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Slider;

class WelcomeController extends Controller
{
    public function index()
    {
        // \Artisan::call('storage:link');
        // $slider = Slider::all();
        $firstSlide = DB::table('sliders')->first();
        $firstSlideId = $firstSlide->id;
        $otherSlides = DB::table('sliders')->where('status', '=', '1')->get();
        $breakfast = DB::table('tbl_breakfast')->where('featured', 1)->first();
        $breakfastId = $breakfast->id;
        $breakfastImages = DB::table('tbl_breakfast_images')->where('breakfast_id', $breakfastId)->limit(4)->get();
        $rooms = DB::table('tbl_rooms')->where('display', 1)->get();
        $roomImages = DB::table('tbl_room_images')->limit(4)->get();

//        Welcome Gallery
        $DiningGallery = DB::table('tbl_gallery')->where('album_id', 3)->get();
        $RoomGallery = DB::table('tbl_gallery')->where('album_id', 4)->get();
        $CateringGallery = DB::table('tbl_gallery')->where('album_id', 5)->get();
        $BarGallery = DB::table('tbl_gallery')->where('album_id', 6)->get();
        $gallery = DB::table('tbl_gallery')->where('album_id', 2)->limit(6)->get();

        return view('welcome', compact('gallery', 'otherSlides', 'breakfast', 'breakfastImages', 'rooms', 'roomImages','DiningGallery','RoomGallery','CateringGallery','BarGallery'));
    }
}
