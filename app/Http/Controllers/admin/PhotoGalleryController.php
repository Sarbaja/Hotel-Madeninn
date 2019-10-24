<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoGalleryController extends Controller
{
    public function index(){
    	// echo Request::segment(2);
    	$par = (request()->route()->parameters);
    	// var_dump($par);
    	$productTitle =  DB::table('tbl_locations')->select('title')->where('slug', $par['albumName'])->get();
    	// var_dump($productTitle);
    	return view('admin.photo-gallery', array("productTitle" => $productTitle));
    }

    public function delete_image(){
    	$par = (request()->route()->parameters);
    	// var_dump("public/admin/products/".$par['albumName']."/thumbs/cover_".$par['photoName']);
    	// exit();

    	Storage::delete("public/admin/products/".$par['albumName']."/".$par['photoName']);
        Storage::delete("public/admin/products/".$par['albumName']."/thumbs/cover_".$par['photoName']);
        Storage::delete("public/admin/products/".$par['albumName']."/thumbs/large_".$par['photoName']);
        Storage::delete("public/admin/products/".$par['albumName']."/thumbs/thumb_".$par['photoName']);

        return redirect('./admin/photo-gallery/'.$par['albumName']);
        // return redirect()->route('photo_gallery');

    }

    public function add_images(Request $request){
    	var_dump($request['other_images']);
    	echo "fuck you!";

    	$folderPath = 'public/admin/products/'. $request['albumName'];

    	if ($request->hasFile('other_images')) {
            //Add the new photo
            $otherImages = $request->file('other_images');
            foreach ($otherImages as $key => $other) {
	            
	            $filename = time().$key.'_.'.$other->getClientOriginalExtension();
	            Storage::putFileAs($folderPath, new File($other), $filename);

	            app('App\Http\Controllers\admin\ProductController')->resize_crop_images(900, 1200, $other, $folderPath."/thumbs/cover_".$filename);
	            app('App\Http\Controllers\admin\ProductController')->resize_crop_images(450, 600, $other, $folderPath."/thumbs/large_".$filename);
	            app('App\Http\Controllers\admin\ProductController')->resize_crop_images(90, 120, $other, $folderPath."/thumbs/thumb_".$filename);
	        }

        }

        return redirect('./admin/photo-gallery/'.$request['albumName']);
    }
}
