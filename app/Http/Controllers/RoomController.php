<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index($slug)
    {
        $room = DB::table('tbl_rooms')->where([ ['display', '=', 1],['slug' , '=' , $slug]])->first();
        $roomid = $room->id;
        $gallery = DB::table('tbl_room_images')->where([ ['room_id' , '=' , $roomid]])->get();
        
        $meta_description = "The doors to our cheapest rooms in Itahari, Sunsari Eastern Part of Nepal rooms are the doors to your heart. Open the doors to any of our rooms at Hotel Maden Inn, Itahari. You will be impressed with our comfortable and cozy yet classic furnishings that evoke the mystic air and peacefulness only found in a few 'great' hotels around the place. In the hustle and bustle of Itahari, Sunsari, Eastern Part of Nepal we successfully provide the most sophisticated space. The features are thoughtfully chosen top-quality arrangement, just for you. Hotel maden inn isone of the best and one of the cheapest hotels in Itahari, Susari, Eastern Part of Nepal.";
        $meta_keywords = "hotel in ithari, ithari, sunsari";
        return view('rooms', compact('meta_description', 'meta_keywords', 'room','gallery'));
    }
}
