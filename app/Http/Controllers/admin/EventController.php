<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
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
        $events = DB::table('tbl_events')->orderBy('order_item')->get();
        return view('admin.events.index', [
            'events'=> $events 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
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
        $destination = base_path() . '/public/uploads/events/';
        $image = $request->file('image');
        $moved = Image::make($image)->save($destination . $fileName);
        
        if($moved){
            $destinationPath=base_path() . "/public/uploads/events/thumbs";
            $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
            $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);
        }
        
        if($resized){
            $events=new Event();
            $events->title=$request->input('title');
            $events->slug=str_slug($events->title);
            $events->description=$request->input('description');
            $events->image=$fileName;
            $events->display=$request->has('display');
            $events->featured=$request->has('featured');
            $events->order_item=Event::max('order_item')+1;
            $save=$events->save();
        }
        
        if($save){
            return redirect('admin/events')->with('status', 'Event Created Successfully!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::find($id);
        if(is_null($event)){
            return redirect('admin/events')->with('errStatus', "Something Went Wrong");
        }

        return view('admin.events.edit', [
            'event'=>$event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/events/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/events/thumbs";
                $resized = $this->resize_crop_images(265, 175, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image , $destinationPath . '/large_' . $fileName);

            }
            
            if($resized){
                $oldFile=$event->image;
                File::delete($destination . '/' . $oldFile);
                File::delete($destination . '/thumbs/thumb_' . $oldFile);
                File::delete($destination . '/thumbs/large_' . $oldFile);
    
                $event->image=$fileName;
            }
        }
        
        $event->title=$request->input('title');
        $event->slug=str_slug($event->title);
        $event->description=$request->input('description');
        $event->display=$request->has('display');
        $event->featured=$request->has('featured');
        $save=$event->save();
        
        if($save){
            return redirect('admin/events')->with('status', 'Event Updated Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $delete=$event->forceDelete();

        if($delete){
            $destination=base_path() . '/public/uploads/events';
            File::delete($destination . '/' . $event->image);
            File::delete($destination . '/thumbs/thumb_' . $event->image);
            File::delete($destination . '/thumbs/large_' . $event->image);
            return redirect('admin/events')->with('status', 'Event Deleted Successfully!!');
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
            Event::where('id', $id)->update($updateData);
            $i++ ;
        }

        $data = array('status'=> 'success');
        echo json_encode($data);
    }
}
