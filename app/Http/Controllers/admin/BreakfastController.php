<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Breakfast;
use App\BreakfastImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BreakfastController extends Controller
{

    public function resize_crop_images($max_width, $max_height, $image, $filename){
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
        $breakfast = DB::table('tbl_breakfast')->orderBy('order_item')->get();
        return view('admin.breakfast.index', [
            'breakfast'=> $breakfast 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.breakfast.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName   = time() . '.' . $extension;
        $destination = base_path() . '/public/uploads/breakfast/';
        $image = $request->file('image');
        $moved = Image::make($image)->save($destination . $fileName);
        // $moved=$request->file('image')->move($destination, $fileName);
        
        if($moved){
            $destinationPath=base_path() . "/public/uploads/breakfast/thumbs";
            $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
            $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);
            
            // $img = Image::make(base_path() . "/public/uploads/breakfast/".$fileName);
            // $img->resize(320, 240);
            // $resized=$insert=$img->save(base_path() . "/public/uploads/breakfast/thumbs/thumb_".$fileName);
        }

        if($resized){
            $breakfast=new Breakfast();
            $breakfast->title=$request->input('title');
            $breakfast->slug=str_slug($breakfast->title);
            $breakfast->description=$request->input('description');
            $breakfast->image=$fileName;
            $breakfast->display=$request->has('display');
            $breakfast->featured=$request->has('featured');
            $breakfast->order_item=Breakfast::max('order_item')+1;
            $save=$breakfast->save();
        }

        if($request->hasFile('other_images')){

            $lastInsertedId = $breakfast->id;
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
                    $breakfastImg->breakfast_id=$lastInsertedId;
                    $breakfastImg->image_name=$imageName;
                    $breakfastImg->slug=str_slug($breakfastImg->image_name);
                    $breakfastImg->save();
                }
            }
        }
        
        if($save){
            return redirect('admin/breakfast')->with('status', 'Breakfast Created Successfully!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breakfast=Breakfast::find($id);
        if(is_null($breakfast)){
            return redirect('admin/breakfast')->with('errStatus', "Something Went Wrong");
        }

        return view('admin.breakfast.edit', [
            'breakfast'=>$breakfast
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Breakfast $breakfast)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/breakfast/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/breakfast/thumbs";
                $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);

            }
            
            if($resized){
                $oldFile=$breakfast->image;
                File::delete($destination . '/' . $oldFile);
                File::delete($destination . '/thumbs/thumb_' . $oldFile);
                File::delete($destination . '/thumbs/large_' . $oldFile);
    
                $breakfast->image=$fileName;
            }
        }
        
        $breakfast->title=$request->input('title');
        $breakfast->slug=str_slug($breakfast->title);
        $breakfast->description=$request->input('description');
        $breakfast->display=$request->has('display');
        $breakfast->featured=$request->has('featured');
        $save=$breakfast->save();
        
        if($save){
            return redirect('admin/breakfast')->with('status', 'Breakfast Updated Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Breakfast $breakfast)
    {
        $id=$breakfast->id;
        $delete = $breakfast->forceDelete();
        $images = BreakfastImages::all()->where('breakfast_id', $id);
        if($delete){
            $destination=base_path() . '/public/uploads/breakfast';
            File::delete($destination . '/' . $breakfast->image);
            File::delete($destination . '/thumbs/thumb_' . $breakfast->image);
            File::delete($destination . '/thumbs/large_' . $breakfast->image);

            $imagesPath=base_path() . '/public/uploads/breakfastimages';
            foreach($images as $img){
                $img->forceDelete();
                File::delete($imagesPath . '/' . $img->image_name);
                File::delete($imagesPath . '/thumbs/thumb_' . $img->image_name);
            }
            return redirect('admin/breakfast')->with('status', 'Breakfast Deleted Successfully!!');
        }
    }

    public function showImages($id)
    {
        $breakfast = DB::table('tbl_breakfast_images')->where('breakfast_id', $id)->get();

        if(is_null($breakfast)){
            return redirect('admin/breakfast')->with('status', "Something Went Wrong");
        }

        return view('admin.breakfast.images', [
            'breakfast' => $breakfast,
            'breakfastId' => $id
        ]);
    }

    public function addImages(Request $request)
    {
        if($request->hasFile('other_images')){

            $breakfastId = $request->input('breakfast_id');
            // dd($breakfastId);
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
                    $save=$breakfastImg->save();

                }
            }

            return redirect('admin/breakfast/images/'.$breakfastId);
        }
    }

    public function deleteImage($id, Request $request)
    {
        // $data = new BreakfastImages();
        $image = BreakfastImages::find($id);
        $breakfastId = $request->input('breakfast_id');

        if($image){
            $delete=$image->delete();
            $file=$image->image_name;
            $destinationPath=base_path() . "/public/uploads/breakfastimages";
    
            if($delete){
                File::delete($destinationPath . '/' . $file);
                File::delete($destinationPath . '/thumbs/thumb_' . $file);
            }
            return redirect('admin/breakfast/images/'.$breakfastId)->with('status', 'Image deleted Successfully!!');
        }
    }
}
