<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Album;

class LocationController extends Controller
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
        $locations = DB::table('tbl_locations')->orderBy('order_item')->get();
        return view('admin.locations.index', [
            'locations'=> $locations 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/locations/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);

            if ($moved) {
                $destinationPath = base_path() . "/public/uploads/locations/thumbs";
                $resized = $this->resize_crop_images(540, 360, $image, $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image, $destinationPath . '/large_' . $fileName);
            }
        }
        

            $locations=new Location();
            $locations->title=$request->input('title');
            $locations->slug=str_slug($locations->title);
            $locations->description=$request->input('description');
            $locations->image=$fileName;
            $locations->display=$request->has('display');
            $locations->order_item=Location::max('order_item')+1;
            $save=$locations->save();


        
        if($save){
            return redirect('admin/locations')->with('status', 'Amneties Created Successfully!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location=Location::find($id);
        if(is_null($location)){
            return redirect('admin/locations')->with('errStatus', "Something Went Wrong");
        }

        return view('admin.locations.edit', [
            'location'=>$location
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/locations/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/locations/thumbs";
                $resized = $this->resize_crop_images(540, 360, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);

            }
            
            if($resized){
                $oldFile=$location->image;
                File::delete($destination . '/' . $oldFile);
                File::delete($destination . '/thumbs/thumb_' . $oldFile);
                File::delete($destination . '/thumbs/large_' . $oldFile);
    
                $location->image=$fileName;
            }
        }
        
        $location->title=$request->input('title');
        $location->slug=str_slug($location->title);
        $location->description=$request->input('description');
        $location->display=$request->has('display');
        $save=$location->save();
        
        if($save){
            return redirect('admin/locations')->with('status', 'Amneties Updated Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $delete=$location->forceDelete();

        if($delete){
            $destination=base_path() . '/public/uploads/locations';
            File::delete($destination . '/' . $location->image);
            File::delete($destination . '/thumbs/thumb_' . $location->image);
            File::delete($destination . '/thumbs/large_' . $location->image);
            return redirect('admin/locations')->with('status', 'Amneties Deleted Successfully!!');
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
            Location::where('id', $id)->update($updateData);
            $i++ ;
        }

        $data = array('status'=> 'success');
        echo json_encode($data);
    }
}
