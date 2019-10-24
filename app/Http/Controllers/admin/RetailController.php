<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Retail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RetailController extends Controller
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
        $retails = DB::table('tbl_retails')->orderBy('order_item')->get();
        return view('admin.retails.index', [
            'retails'=> $retails 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.retails.create');
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
        $destination = base_path() . '/public/uploads/retails/';
        $image = $request->file('image');
        $moved = Image::make($image)->save($destination . $fileName);
        
        if($moved){
            $destinationPath=base_path() . "/public/uploads/retails/thumbs";
            $resized = $this->resize_crop_images(540, 360, $image , $destinationPath . '/thumb_' . $fileName);
            $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);
        }
        
        if($resized){
            $retails=new Retail();
            $retails->title=$request->input('title');
            $retails->slug=str_slug($retails->title);
            $retails->description=$request->input('description');
            $retails->image=$fileName;
            $retails->display=$request->has('display');
            $retails->order_item=Retail::max('order_item')+1;
            $save=$retails->save();
        }
        
        if($save){
            return redirect('admin/retails')->with('status', 'Retail Created Successfully!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Retail  $retail
     * @return \Illuminate\Http\Response
     */
    public function show(Retail $retail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Retail  $retail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retail=Retail::find($id);
        if(is_null($retail)){
            return redirect('admin/retails')->with('errStatus', "Something Went Wrong");
        }

        return view('admin.retails.edit', [
            'retail'=>$retail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Retail  $retail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retail $retail)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/retails/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/retails/thumbs";
                $resized = $this->resize_crop_images(540, 360, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);

            }
            
            if($resized){
                $oldFile=$retail->image;
                File::delete($destination . '/' . $oldFile);
                File::delete($destination . '/thumbs/thumb_' . $oldFile);
                File::delete($destination . '/thumbs/large_' . $oldFile);
    
                $retail->image=$fileName;
            }
        }
        
        $retail->title=$request->input('title');
        $retail->slug=str_slug($retail->title);
        $retail->description=$request->input('description');
        $retail->display=$request->has('display');
        $save=$retail->save();
        
        if($save){
            return redirect('admin/retails')->with('status', 'Retail Updated Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Retail  $retail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retail $retail)
    {
        $delete=$retail->forceDelete();

        if($delete){
            $destination=base_path() . '/public/uploads/retails';
            File::delete($destination . '/' . $retail->image);
            File::delete($destination . '/thumbs/thumb_' . $retail->image);
            File::delete($destination . '/thumbs/large_' . $retail->image);
            return redirect('admin/retails')->with('status', 'Retail Deleted Successfully!!');
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
            Retail::where('id', $id)->update($updateData);
            $i++ ;
        }

        $data = array('status'=> 'success');
        echo json_encode($data);
    }
}
