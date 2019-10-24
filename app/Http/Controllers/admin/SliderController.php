<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

class SliderController extends Controller
{

    public function index()
    {
        $slider = Slider::all();
        return view('admin.slider', compact('slider'));
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

            $cover = storage_path('app/'.$filename);
            Image::make($image)->crop($width, $height_new, 0, $h_point)->resize($max_width, $max_height)->save($cover);
        } else {
            //cut point by width
            $w_point = round(($width - $width_new) / 2);
            $cover = storage_path('app/'.$filename);
            Image::make($image)->crop($width_new, $height, $w_point, 0)->resize($max_width, $max_height)->save($cover);
        }

    }

    public function addslide()
    {
        return view('admin.slider');
    }

    /*public function createslide(Request $request)
    {
        $slider = new Slider();

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:225',
            'subtitle' => 'required',
            'status' => 'required|int',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $folderPath = "public/slider";
            $thumbPath = "public/slider/thumbs";
            if(!file_exists($thumbPath)){
                Storage::makeDirectory($thumbPath,0777,true,true);
            }


            Storage::putFileAs($folderPath, new File($image), $filename);

            $this->resize_crop_images(1350, 840, $image, $thumbPath."/slide_".$filename);
            $this->resize_crop_images(128, 48, $image, $thumbPath."/small_".$filename);

            $slider->image = $filename;

        }
        $request['status'] = isset($request['status']) ? $request['status'] : '0';


        $slider->title = $request->input('title');
        $slider->subtitle = $request->input('subtitle');
        $slider->url = $request->input('url');
        $slider->status = $request->input('status');
        $slider->save();
        return redirect()->to('/admin/slider')->with('status', 'Slide added Successfully!');
    }*/
    
    public function createslide(Request $request)
    {
        $slider = new Slider();

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:225',
            'subtitle' => 'required',
            'status' => 'required|int',
            'image' => 'image|mimes:jpeg,png,jpg|max:1000',
        ]);

        if ($request->hasFile('image')) {

            $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                     
                     //$oldlogo = $logo->logo;
                     $extension = $image_tmp->getClientOriginalExtension();
 
                     //Get filename with the extension
                     $filenameWithExt = $request->file('image')->getClientOriginalName();
                     $filename= pathinfo($filenameWithExt, PATHINFO_FILENAME). '.' .$extension;
                     //$image_path = 'images/backend_img/uploads/' .$filename;
                     $image_path = 'public/slider/thumbs/';
                     
                     //Image::make($image_tmp)->save($image_path);
                     $path = $request->file('image')->storeAs($image_path, $filename);
 
                     //deleting exiting logo
                     //Storage::delete('public/images/'.$oldlogo);
                }
        }
        
        $request['status'] = isset($request['status']) ? $request['status'] : '0';


        $slider->title = $request->input('title');
        $slider->subtitle = $request->input('subtitle');
        $slider->url = $request->input('url');
        $slider->image = $filename;
        $slider->status = $request->input('status');
        $slider->save();
        return redirect()->to('/admin/slider')->with('status', 'Slide added Successfully!');
    }

    public function editslide($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider', compact('slider'));
    }

    public function updateslide(Request $request)
    {
        $slide = Slider::find($request->id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:225',
            'subtitle' => 'required',
            'status' => 'required|int',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            $oldslide = $slide->image;

            $filename = time().'.'.$image->getClientOriginalExtension();
            $folderPath = "public/slider";

            Storage::putFileAs($folderPath, new File($image), $filename);

            $this->resize_crop_images(1350, 840, $image, $folderPath."/thumbs/slide_".$filename);
            $this->resize_crop_images(128, 48, $image, $folderPath."/thumbs/small_".$filename);

            Storage::delete($folderPath .'/'. $oldslide);
            Storage::delete($folderPath .'/thumbs/slide_'. $oldslide);
            Storage::delete($folderPath .'/thumbs/small_'. $oldslide);

            $slide->image = $filename;
        }
        $slide->title = $request['title'];
        $slide->url = $request['url'];
        $slide->subtitle = $request['subtitle'];
        $slide->subtitle = $request['subtitle'];
        $slide->status = $request['status'];

        $slide->save();
        return redirect()->to('/admin/slider')->with('status', 'Slide Update Successfully!');

    }
    public function delete($id)
    {
        $slide = Slider::find($id);
        $oldslide = $slide->image;
        if ($slide) {
            $slide->delete();
            $folderPath = "public/slider";
            Storage::delete($folderPath .'/'. $oldslide);
            Storage::delete($folderPath .'/thumbs/slide_'. $oldslide);
            Storage::delete($folderPath .'/thumbs/small_'. $oldslide);

            return redirect()->to('/admin/slider')->with('status', 'Slide Delete Successfully!');
        }
        return redirect()->to('/admin/slider')->with('error', 'Something Went Wrong!');

    }
}
