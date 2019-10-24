<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Pages;
use Intervention\Image\Facades\Image;

class PagesController extends Controller
{
    // Slug check and create starts
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Pages::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function index()
    {
        $page = Pages::all();
        return view('admin.pages', compact('page'));
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

    public function addpage()
    {
        return view('admin.pages');
    }

    public function createpage(Request $request)
    {
        $page = new Pages;
        $page->slug = $this->createSlug($request['title']);
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $page->title = $request->title;
        $page->subtitle = $request->subtitle;
        $page->description = $request->description;

        if (!$request->status) {
            $request->status = 0;
        }
        $page->status = $request->status;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:4000',
            ]);

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $folderPath = "public/pages";
            $thumbPath = "public/pages/thumbs";
            if(!file_exists($thumbPath)){
                Storage::makeDirectory($thumbPath,0777,true,true);
            }

            Storage::putFileAs($folderPath, new File($image), $filename);

            $this->resize_crop_images(1140, 400, $image, $thumbPath."/banner_".$filename);
            $this->resize_crop_images(128, 48, $image, $thumbPath."/small_".$filename);

            $page->image = $filename;

        }


        $page->save();
        return redirect()->to('/admin/pages')->with('status', 'Page added Successfully!');

    }

    public function editpages($id)
    {
        $page = Pages::find($id);
        return view('admin.pages', compact('page'));
    }

    public function updatepage(Request $request)
    {

        $page = Pages::find($request->id);
        $page->title = $request->title;

        $slug = str_slug($request->title, '-');

        if ($page->slug != $slug) {
            $page->slug = $slug;
        }

        $page->subtitle = $request->subtitle;
        $page->description = $request->description;
        if (!$request->status) {
            $request->status = 0;
        }
        $page->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:4000',
            ]);

            $oldimage = $page->image;

            $filename = time().'.'.$image->getClientOriginalExtension();
            $folderPath = "public/pages";

            Storage::putFileAs($folderPath, new File($image), $filename);

            $this->resize_crop_images(1140, 400, $image, $folderPath."/thumbs/banner_".$filename);
            $this->resize_crop_images(128, 48, $image, $folderPath."/thumbs/small_".$filename);

            Storage::delete($folderPath .'/'. $oldimage);
            Storage::delete($folderPath .'/thumbs/banner_'. $oldimage);
            Storage::delete($folderPath .'/thumbs/small_'. $oldimage);

            $page->image = $filename;
        }
        $page->save();
        return redirect()->to('/admin/pages')->with('status', 'Page Update Successfully!');
    }
    public function delete($id)
    {
        $page = Pages::find($id);
        $image = $page->image;
        if ($page) {
            $page->delete();
            $folderPath = "public/pages";
            Storage::delete($folderPath .'/'. $image);
            Storage::delete($folderPath .'/thumbs/banner_'. $image);
            Storage::delete($folderPath .'/thumbs/small_'. $image);

            return redirect()->to('/admin/pages')->with('status', 'Page Delete Successfully!');
        }
        return redirect()->to('/admin/pages')->with('error', 'Something Went Wrong!');

    }

}
