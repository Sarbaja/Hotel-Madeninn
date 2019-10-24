<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
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
        return view('admin.gallery.index', [
            'title'=>"Gallery Controller"
        ]);
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
        $count=count($request->file('image_name'));
        $image=$request->file('image_name');
        $album_id=$request->input('album_id');

        $destination = base_path() . '/public/uploads/gallery/';
        
        for($i=0; $i < $count; $i++){
            $imageName=$image[$i]->getClientOriginalName();
            $moved = Image::make($image[$i])->save($destination . $imageName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/gallery/thumbs";
                $resized = $this->resize_crop_images(320, 240, $image[$i] , $destinationPath . '/thumb_' . $imageName);
            }

            if($resized){
                $gallery=new Gallery();
                $gallery->album_id=$album_id;
                $gallery->image_name=$imageName;
                $gallery->slug=str_slug($gallery->image_name);
                $gallery->save();
            }
        }

        return redirect('admin/gallery/'. $request->input('album_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $albumId=$gallery->album_id;
        $gallery->caption=$request->input('caption');
        $update=$gallery->save();
        if($update){
            return redirect('admin/gallery/'.$albumId);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, Request $request)
    {
        $delete=$gallery->forceDelete();
        
        $id=$request->input('album_id');
        $file=$gallery->image_name;
        $destinationPath=base_path() . "/public/uploads/gallery";

        if($delete){
            File::delete($destinationPath . '/' . $file);
            File::delete($destinationPath . '/thumbs/thumb_' . $file);
        }
        return redirect('admin/gallery/'.$id);
    }

     /**
     * Displays Image Gallery of the Album
     */
    public function albumGallery($id)
    {
        return view('admin.gallery.index', [
            'albumId'=>$id,
            'allImages'=>Gallery::all()->where('album_id', $id)
        ]);
    }
}
