<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\RoomImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{

    public function resize_crop_images($max_width, $max_height, $image, $filename)
    {
    	$imgSize = getimagesize($image);
    	$width = $imgSize[0];
    	$height = $imgSize[1];

    	$width_new = round($height * $max_width / $max_height);
    	$height_new = round($width * $max_height / $max_width);

    	if ($width_new > $width) {
	        //cut point by height
	        $h_point = round(($height - $height_new) / 2);
	        
	        $cover = $filename;
	        Image::make($image)->crop($width, $height_new, 0, $h_point)->resize($max_width, $max_height)->save($cover);
	    } else {
	        //cut point by width
	        $w_point = round(($width - $width_new) / 2);
	        $cover = $filename;
	        Image::make($image)->crop($width_new, $height, $w_point, 0)->resize($max_width, $max_height)->save($cover);
        }
        
        return true;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = DB::table('tbl_rooms')->orderBy('order_item')->get();
        return view('admin.rooms.index', [
            'rooms'=> $rooms 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/rooms/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);

            if($moved){
                $destinationPath=base_path() . "/public/uploads/rooms/thumbs";
                $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(540, 360, $image , $destinationPath . '/medium_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);
            }
        }else{
            $fileName = '';
        }
        $room=new Room();
        $room->title=$request->input('title');
        $room->slug=str_slug($room->title);
        $room->priceSingle=$request->input('priceSingle');
        $room->priceDouble=$request->input('priceDouble');
        $room->description=$request->input('description');
        $room->RoomFacilities=$request->input('RoomFacilities');
        $room->featured_image=$fileName;
        $room->display=$request->has('display');
        $room->featured=$request->has('featured');
        $room->order_item=Room::max('order_item')+1;
        $save=$room->save();

        if($request->hasFile('other_images')){
            
            $lastInsertedId = $room->id;
            $count=count($request->file('other_images'));
            $image=$request->file('other_images');
            
            $destination = base_path() . '/public/uploads/roomImages/';
            
            for($i=0; $i < $count; $i++){
                $imageName=$image[$i]->getClientOriginalName();
                $moved = Image::make($image[$i])->save($destination . $imageName);
                
                if($moved){
                    $destinationPath=base_path() . "/public/uploads/roomImages/thumbs";
                    $resized = $this->resize_crop_images(320, 240, $image[$i] , $destinationPath . '/thumb_' . $imageName);
                }
                
                if($resized){
                    $roomImage=new RoomImages();
                    $roomImage->room_id=$lastInsertedId;
                    $roomImage->image_name=$imageName;
                    $roomImage->slug=str_slug($roomImage->image_name);
                    $roomImage->save();
                }
            }
        }
        
            return redirect('admin/rooms')->with('status', 'Room Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rooms=Room::find($id);
        if(is_null($rooms)){
            return redirect('admin/rooms')->with('errStatus', "Something Went Wrong");
        }

        return view('admin.rooms.edit', [
            'rooms'=>$rooms
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/rooms/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/rooms/thumbs";
                $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(540, 360, $image , $destinationPath . '/medium_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);

            }
            
            if($resized){
                $oldFile=$room->image;
                File::delete($destination . '/' . $oldFile);
                File::delete($destination . '/thumbs/thumb_' . $oldFile);
                File::delete($destination . '/thumbs/medium_' . $oldFile);
                File::delete($destination . '/thumbs/large_' . $oldFile);
    
                $room->featured_image=$fileName;
            }
        }


        
        $room->title=$request->input('title');
        $room->slug=str_slug($room->title);
        $room->priceSingle=$request->input('priceSingle');
        $room->priceDouble=$request->input('priceDouble');
        $room->description=$request->input('description');
        $room->RoomFacilities=$request->input('RoomFacilities');
        $room->display=$request->has('display');
        $room->featured=$request->has('featured');
        $save=$room->save();
        
        if($save){
            return redirect('admin/rooms')->with('status', 'Room Updated Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $id=$room->id;
        $delete = $room->forceDelete();
        $images = RoomImages::all()->where('room_id', $id);
        if($delete){
            $destination=base_path() . '/public/uploads/rooms';
            File::delete($destination . '/' . $room->featured_image);
            File::delete($destination . '/thumbs/thumb_' . $room->featured_image);
            File::delete($destination . '/thumbs/medium_' . $room->featured_image);
            File::delete($destination . '/thumbs/large_' . $room->featured_image);

            $imagesPath=base_path() . '/public/uploads/roomimages';
            foreach($images as $img){
                $img->forceDelete();
                File::delete($imagesPath . '/' . $img->image_name);
                File::delete($imagesPath . '/thumbs/thumb_' . $img->image_name);
            }
            return redirect('admin/rooms')->with('status', 'Room Deleted Successfully!!');
        }
    }

    public function showImages($id)
    {
        $rooms = DB::table('tbl_room_images')->where('room_id', $id)->get();

        if(is_null($rooms)){
            return redirect('admin/rooms')->with('status', "Something Went Wrong");
        }

        return view('admin.rooms.images', [
            'rooms' => $rooms,
            'roomId' => $id
        ]);
    }

    public function addImages(Request $request)
    {
        if($request->hasFile('other_images')){

            $roomId = $request->input('room_id');
            $count=count($request->file('other_images'));
            $image=$request->file('other_images');

            $destination = base_path() . '/public/uploads/roomImages/';
            
            for($i=0; $i < $count; $i++){
                $imageName=$image[$i]->getClientOriginalName();
                $moved = Image::make($image[$i])->save($destination . $imageName);
                
                if($moved){
                    $destinationPath=base_path() . "/public/uploads/roomImages/thumbs";
                    $resized = $this->resize_crop_images(320, 240, $image[$i] , $destinationPath . '/thumb_' . $imageName);
                }

                if($resized){
                    $roomImage=new RoomImages();
                    $roomImage->room_id=$roomId;
                    $roomImage->image_name=$imageName;
                    $roomImage->slug=str_slug($roomImage->image_name);
                    $save=$roomImage->save();

                }
            }

            return redirect('admin/rooms/images/'.$roomId);
        }
    }

    public function deleteImage($id, Request $request)
    {
        $image = RoomImages::find($id);
        $roomId = $request->input('room_id');

        if($image){
            $delete=$image->delete();
            $file=$image->image_name;
            $destinationPath=base_path() . "/public/uploads/roomImages";
    
            if($delete){
                File::delete($destinationPath . '/' . $file);
                File::delete($destinationPath . '/thumbs/thumb_' . $file);
            }
            return redirect('admin/rooms/images/'.$roomId)->with('status', 'Image deleted Successfully!!');
        }
    }

}
