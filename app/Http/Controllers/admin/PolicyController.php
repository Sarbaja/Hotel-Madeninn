<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
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
        $policy = DB::table('tbl_policy')->orderBy('order_item')->get();
        return view('admin.policy.index', [
            'policy'=> $policy 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.policy.create');
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
        $destination = base_path() . '/public/uploads/policy/';
        $image = $request->file('image');
        $moved = Image::make($image)->save($destination . $fileName);
        // $moved=$request->file('image')->move($destination, $fileName);
        
        if($moved){
            $destinationPath=base_path() . "/public/uploads/policy/thumbs";
            $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
            $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);
            
            // $img = Image::make(base_path() . "/public/uploads/policy/".$fileName);
            // $img->resize(320, 240);
            // $resized=$insert=$img->save(base_path() . "/public/uploads/policy/thumbs/thumb_".$fileName);
        }
        
        if($resized){
            $policy=new Policy();
            $policy->title=$request->input('title');
            $policy->slug=str_slug($policy->title);
            $policy->description=$request->input('description');
            $policy->image=$fileName;
            $policy->display=$request->has('display');
            $policy->order_item=Policy::max('order_item')+1;
            $save=$policy->save();
        }
        
        if($save){
            return redirect('admin/policy')->with('status', 'Policy Created Successfully!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $policy=Policy::find($id);
        if(is_null($policy)){
            return redirect('admin/policy')->with('errStatus', "Something Went Wrong");
        }

        return view('admin.policy.edit', [
            'policy'=>$policy
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/policy/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/policy/thumbs";
                $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);

            }
            
            if($resized){
                $oldFile=$policy->image;
                File::delete($destination . '/' . $oldFile);
                File::delete($destination . '/thumbs/thumb_' . $oldFile);
                File::delete($destination . '/thumbs/large_' . $oldFile);
    
                $policy->image=$fileName;
            }
        }
        
        $policy->title=$request->input('title');
        $policy->slug=str_slug($policy->title);
        $policy->description=$request->input('description');
        $policy->display=$request->has('display');
        $save=$policy->save();
        
        if($save){
            return redirect('admin/policy')->with('status', 'Policy Updated Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        $delete=$policy->forceDelete();

        if($delete){
            $destination=base_path() . '/public/uploads/policy';
            File::delete($destination . '/' . $policy->image);
            File::delete($destination . '/thumbs/thumb_' . $policy->image);
            File::delete($destination . '/thumbs/large_' . $policy->image);
            return redirect('admin/policy')->with('status', 'Policy Deleted Successfully!!');
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
            Policy::where('id', $id)->update($updateData);
            $i++ ;
        }

        $data = array('status'=> 'success');
        echo json_encode($data);
    }
}
