<?php

namespace App\Http\Controllers\admin;

use App\BreakfastImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BreakfastImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('other_images')){

            $breakfastId = $request->input['breakfast_id'];
            $count=count($request->file('other_images'));
            $image=$request->file('other_images');

            $destination = base_path() . '/public/uploads/breakfastImages/';
            
            for($i=0; $i < $count; $i++){
                $imageName=$image[$i]->getClientOriginalName();
                $moved = Image::make($image[$i])->save($destination . $imageName);
                
                if($moved){
                    $destinationPath=base_path() . "/public/uploads/breakfastImages/thumbs";
                    $resized = $this->resize_crop_images(320, 240, $image[$i] , $destinationPath . '/thumb_' . $imageName);
                }

                if($resized){
                    $breakfastImg=new BreakfastImages();
                    $breakfastImg->breakfast_id=$breakfastId;
                    $breakfastImg->image_name=$imageName;
                    $breakfastImg->slug=str_slug($breakfastImg->image_name);
                    $breakfastImg->save();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BreakfastImage  $breakfastImage
     * @return \Illuminate\Http\Response
     */
    public function show(BreakfastImage $breakfastImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BreakfastImage  $breakfastImage
     * @return \Illuminate\Http\Response
     */
    public function edit(BreakfastImage $breakfastImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BreakfastImage  $breakfastImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BreakfastImage $breakfastImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BreakfastImage  $breakfastImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(BreakfastImage $breakfastImage)
    {
        //
    }
}
