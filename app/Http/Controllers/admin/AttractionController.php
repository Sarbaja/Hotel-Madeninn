<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Attraction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttractionController extends Controller
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
        $attractions = DB::table('tbl_attractions')->orderBy('order_item')->get();
        return view('admin.attractions.index', [
            'attractions'=> $attractions 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attractions.create');
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
        $destination = base_path() . '/public/uploads/attractions/';
        $image = $request->file('image');
        $moved = Image::make($image)->save($destination . $fileName);
        
        if($moved){
            $destinationPath=base_path() . "/public/uploads/attractions/thumbs";
            $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
            $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);
        }
        
        if($resized){
            $attractions=new Attraction();
            $attractions->title=$request->input('title');
            $attractions->slug=str_slug($attractions->title);
            $attractions->description=$request->input('description');
            $attractions->image=$fileName;
            $attractions->display=$request->has('display');
            $attractions->featured=$request->has('featured');
            $attractions->order_item=Attraction::max('order_item')+1;
            $save=$attractions->save();
        }
        
        if($save){
            return redirect('admin/attractions')->with('status', 'Attraction Created Successfully!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function show(Attraction $attraction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attraction=Attraction::find($id);
        if(is_null($attraction)){
            return redirect('admin/attractions')->with('errStatus', "Something Went Wrong");
        }

        return view('admin.attractions.edit', [
            'attraction'=>$attraction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attraction $attraction)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/attractions/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/attractions/thumbs";
                $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);

            }
            
            if($resized){
                $oldFile=$attraction->image;
                File::delete($destination . '/' . $oldFile);
                File::delete($destination . '/thumbs/thumb_' . $oldFile);
                File::delete($destination . '/thumbs/large_' . $oldFile);
    
                $attraction->image=$fileName;
            }
        }
        
        $attraction->title=$request->input('title');
        $attraction->slug=str_slug($attraction->title);
        $attraction->description=$request->input('description');
        $attraction->display=$request->has('display');
        $attraction->featured=$request->has('featured');
        $save=$attraction->save();
        
        if($save){
            return redirect('admin/attractions')->with('status', 'Attraction Updated Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attraction $attraction)
    {
        $delete=$attraction->forceDelete();

        if($delete){
            $destination=base_path() . '/public/uploads/attractions';
            File::delete($destination . '/' . $attraction->image);
            File::delete($destination . '/thumbs/thumb_' . $attraction->image);
            File::delete($destination . '/thumbs/large_' . $attraction->image);
            return redirect('admin/attractions')->with('status', 'Attraction Deleted Successfully!!');
        }
    }


    public function setOrder(Request $request)
    {
        // get the list of items id separated by cama (,)
        $list_order = $request['list_order'];

        // convert the string list to an array
        $list = explode(',' , $list_order);
        $i = 1 ;
        foreach($list as $id) {
            $updateData = array("order_item" => $i);
            Attraction::where('id', $id)->update($updateData);
            $i++ ;
        }

        $data = array('status'=> 'success');
        echo json_encode($data);
    }
}
