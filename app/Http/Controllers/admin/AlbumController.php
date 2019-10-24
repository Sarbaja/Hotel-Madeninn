<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Album;
use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
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
        return view('admin.albums.index', [
            'albums'=>Album::all()
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
        $imageName = $request->input('album_name');
        $slug=str_slug($imageName);
        $extension = $request->file('album_image')->getClientOriginalExtension();
        $fileName   = time() . '.' . $slug . '.' . $extension;
        $destination = base_path() . '/public/uploads/albums/';
        $image = $request->file('album_image');
        $moved = Image::make($image)->save($destination . $fileName);
        if($moved){
            $destinationPath=base_path() . "/public/uploads/albums/thumbs";
            $resized = $this->resize_crop_images(320, 240, $image , $destinationPath . '/thumb_' . $fileName);
        }
        
        if($resized){
            $album=new Album();
            $album->album_name=$request->input('album_name');
            $album->slug=str_slug($album->album_name);
            $album->album_image=$fileName;
            $save=$album->save();
        }
        return view('admin.albums.index', [
            'albums'=>Album::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        if($request->file('album_image')){
            $imageName = $request->input('album_name');
            $slug=str_slug($imageName);
            $extension = $request->file('album_image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $slug . '.' . $extension;
            $destination = base_path() . '/public/uploads/albums/';
            $image = $request->file('album_image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/albums/thumbs";
                $resized = $this->resize_crop_images(320, 240, $image , $destinationPath . '/thumb_' . $fileName);
            }
            
            if($resized){
                $oldFile=$album->album_image;
                File::delete($destination . '/' .$oldFile);
                File::delete($destination . '/thumbs/thumb_' .$oldFile);

                $album->album_name=$request->input('album_name');
                $album->slug=str_slug($album->album_name);
                $album->album_image=$fileName;
                $save=$album->save();
            }
        }else{
            $album->album_name=$request->input('album_name');
            $album->slug=str_slug($album->album_name);
            $save=$album->save();
        }
        
        if($save){
            return redirect('admin/albums');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $id=$album->id;
        $gallery=Gallery::all()->where('album_id', $id);
        $destination=base_path() . "/public/uploads/albums";
        $destinationPath=base_path() . "/public/uploads/gallery";

        $deleted=$album->forceDelete();

        if($deleted){
            File::delete($destination . '/' . $album->album_image);
            File::delete($destination . '/thumbs/thumb_' . $album->album_image);
            foreach($gallery as $g){
                $g->forceDelete();

                File::delete($destinationPath . '/'. $g->image_name);
                File::delete($destinationPath . '/thumbs/thumb_'. $g->image_name);
            }
        }
        
        return redirect('admin/albums');
    }
}
