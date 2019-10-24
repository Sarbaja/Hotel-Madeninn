<?php

namespace App\Http\Controllers\admin;

use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetings = DB::table('tbl_meetings')->orderBy('order_item')->get();
        return view('admin.meetings.index', compact('meetings'));
    }

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $meeting=new Meeting();
        if($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $destination = base_path() . '/public/uploads/meeting/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);

            if ($moved) {
                $destinationPath = base_path() . "/public/uploads/meeting/thumbs";
                $resized = $this->resize_crop_images(540, 360, $image, $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image, $destinationPath . '/large_' . $fileName);
            }

            $meeting->image = $fileName;
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        $meeting->title = $request->input('title');
        $meeting->slug = str_slug($meeting->title);
        $meeting->display = $request->has('display');
        $meeting->description = $request->input('description');
        $meeting->order_item = Meeting::max('order_item')+1;
        $meeting->save();
        return redirect('admin/meetings')->with('status', 'Meeting Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meeting=Meeting::find($id);
        if(is_null($meeting)){
            return redirect('admin/meetings')->with('errStatus', "Something Went Wrong");
        }
        return view('admin.meetings.edit', [
            'meetings'=>$meeting
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        if($request->file('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/meeting/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);

            if ($moved) {
                $destinationPath = base_path() . "/public/uploads/meeting/thumbs";
                $resized = $this->resize_crop_images(540, 360, $image, $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 410, $image, $destinationPath . '/large_' . $fileName);
            }
            $meeting->image=$fileName;
        }


        $meeting->title=$request->input('title');
        $meeting->slug=str_slug($meeting->title);
        $meeting->display=$request->has('display');
        $meeting->description=$request->input('description');
        $meeting->save();
        return redirect('admin/meetings')->with('status', 'Meeting Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        $delete=$meeting->forceDelete();
        if($delete){
            return redirect('admin/meetings')->with('status', 'Meeting Deleted Successfully');
        }else {
            return redirect('admin/meetings')->with('errStatus', 'Something Went Wrong');
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
            Meeting::where('id', $id)->update($updateData);
            $i++ ;
        }

        $data = array('status'=> 'success');
        echo json_encode($data);

    }
}
