<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Image;

class ProductController extends Controller
{
    public function index(){
    	$categoryPrograms =  DB::table('programs')->select('id', 'title')->where('category', 1)->orderBy('order_item')->get();
    	$products =  DB::table('products')->orderBy('order_item')->get();
		return view('admin.products',array("products" => $products, "categoryPrograms" => $categoryPrograms));
		
		return view('admin.products', compact('products'));
	}

	public function create(){
		$categoryPrograms =  DB::table('programs')->where('category', 1)->orderBy('order_item')->get();
		return view('admin.add-product', compact('categoryPrograms'));
	}

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
        return Product::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
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

    // Slug check and create ends

	public function store(Request $request){
		$max_order = DB::table('products')->max('order_item');
		$product = new Product;

		if (!$request['featured']) {
			$request['featured'] = 0;
		}
		if (!$request['display']) {
			$request['display'] = 0;
		}

		$insertData = array("title" => $request['title'], "code" => $request['code'], "order_item" => $max_order + 1, "originalPrice" => $request['originalPrice'], "wholesellerPrice" => $request['wholesellerPrice'], "featured" => $request['featured'], "display" => $request['display'], "stockQty" => $request['stockQty'], "categories" => json_encode($request['categories']), "description" => $request['description'], "long_content" => $request['long_content'], "created_by" => "admin", "created_at" => date('Y-m-d H:i:s'), "updated_by" => "");

		$insertData['slug'] = $this->createSlug($request['title']);

		$path = public_path().'/storage/admin/products/'.$insertData['slug'];
		$folderPath = 'public/admin/products/'.$insertData['slug'];


		if (!file_exists($path)) {
			
			Storage::makeDirectory($folderPath,0777,true,true);

			if (!is_dir($path."/thumbs")) {
				Storage::makeDirectory($folderPath.'/thumbs',0777,true,true);
			}
			if (!is_dir($path."/titleImages")) {
				Storage::makeDirectory($folderPath.'/titleImages',0777,true,true);
			}
	    }

		if ($request->hasFile('image')) {
            //Add the new photo
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            Storage::putFileAs($folderPath, new File($image), $filename);

            $this->resize_crop_images(900, 1200, $image, $folderPath."/thumbs/cover_".$filename);
            $this->resize_crop_images(450, 600, $image, $folderPath."/thumbs/large_".$filename);
            $this->resize_crop_images(90, 120, $image, $folderPath."/thumbs/thumb_".$filename);

        }

        if ($request->hasFile('other_images')) {
            //Add the new photo
            $otherImages = $request->file('other_images');
            foreach ($otherImages as $key => $other) {
	            
	            $filename = time().$key.'_.'.$other->getClientOriginalExtension();
	            Storage::putFileAs($folderPath, new File($other), $filename);

	            $this->resize_crop_images(900, 1200, $other, $folderPath."/thumbs/cover_".$filename);
	            $this->resize_crop_images(450, 600, $other, $folderPath."/thumbs/large_".$filename);
	            $this->resize_crop_images(90, 120, $other, $folderPath."/thumbs/thumb_".$filename);
	        }

        }

		$insertData['image'] = isset($filename) ? $filename : '';
		$insertData['titleImage'] = '';
		Product::where('id', $request['id'])->insert($insertData);

		// echo "<pre>";
	    // var_dump($insertData);
	    // echo "</pre>";
	    // exit();

		// $product->save();
		return redirect('admin/products');
	}

	public function set_order(Request $request){
		
		$product = new Product;
		// get the list of items id separated by cama (,)
		$list_order = $request['list_order'];
		// $table = $request['table'];
		// convert the string list to an array
		$list = explode(',' , $list_order);
		$i = 1 ;
		foreach($list as $id) {
			$updateData = array("order_item" => $i);
			Product::where('id', $id)->update($updateData);
			// $mydb->where("id", $id);
		 	// $update = $mydb->update($table, $updateData);
			$i++ ;
		}
		$data = array('status'=> 'success');
				echo json_encode($data);
	}

	function saveList($list, $parent_id = 0, $child = 0, &$m_order = 0)
	{

	    foreach ($list as $item) {
	        $m_order++;
	        $updateData = array("parent_id" => $parent_id, "child" => $child, "order_item" => $m_order);
	        Product::where('id', $item['id'])->update($updateData);

	        if (array_key_exists("children", $item)) {
	            $updateData = array("child" => 1);
				Product::where('id', $item['id'])->update($updateData);
	            $this->saveList($item["children"], $item['id'], 0, $m_order);
	        }
	    }
	}

	public function edit($id){
		$categoryPrograms =  DB::table('programs')->select('id', 'title')->where('category', 1)->orderBy('order_item')->get();

		$product = Product::find(base64_decode($id));
		return view('admin.edit-product',array("product" => $product, "categoryPrograms" => $categoryPrograms));
	}

	public function update(Request $request){

		$product = Product::find($request['id']);

		if (!$request['featured']) {
			$request['featured'] = 0;
		}
		if (!$request['display']) {
			$request['display'] = 0;
		}

		$updateData = array("title" => $request['title'], "code" => $request['code'], "originalPrice" => $request['originalPrice'], "wholesellerPrice" => $request['wholesellerPrice'], "featured" => $request['featured'], "display" => $request['display'], "stockQty" => $request['stockQty'], "categories" => json_encode($request['categories']), "description" => $request['description'], "long_content" => $request['long_content'], "updated_by" => "admin", "updated_at" => date('Y-m-d H:i:s'));
		
    	
    	// $product->title = $request['title'];
    	$slug = str_slug($request['title'], '-');
    	$path = public_path().'/storage/admin/products/'.$product->slug;

    	if ($product->slug != $slug) {
			// $product->slug = $this->createSlug($slug, $request['id']);
			$slug = $updateData['slug'] = $this->createSlug($slug, $request['id']);
			if (file_exists($path)) {
				Storage::move('public/admin/products/'.$product->slug , 'public/admin/products/'.$updateData['slug']);
			}
		}

		$folderPath = 'public/admin/products/'. $slug;
		if (!file_exists($path)) {
			
			Storage::makeDirectory($folderPath,0777,true,true);

			if (!is_dir($path."/thumbs")) {
				Storage::makeDirectory($folderPath.'/thumbs',0777,true,true);
			}
			if (!is_dir($path."/titleImages")) {
				Storage::makeDirectory($folderPath.'/titleImages',0777,true,true);
			}
	    }

        if ($request->hasFile('image')) {
            //Add the new photo
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            Storage::putFileAs($folderPath, new File($image), $filename);

            $this->resize_crop_images(900, 1200, $image, $folderPath."/thumbs/cover_".$filename);
            $this->resize_crop_images(450, 600, $image, $folderPath."/thumbs/large_".$filename);
            $this->resize_crop_images(90, 120, $image, $folderPath."/thumbs/thumb_".$filename);

            $OldFilename = $product->image;

            //Update the database
            // $product->image = $filename;
            $updateData['image'] = $filename;
         
            //Delete the old photo
            Storage::delete("public/admin/products/".$product->slug."/".$OldFilename);
            Storage::delete("public/admin/products/".$product->slug."/thumbs/cover_".$OldFilename);
            Storage::delete("public/admin/products/".$product->slug."/thumbs/large_".$OldFilename);
            Storage::delete("public/admin/products/".$product->slug."/thumbs/thumb_".$OldFilename);

        }

        if ($request->hasFile('other_images')) {
            //Add the new photo
            $otherImages = $request->file('other_images');
            foreach ($otherImages as $key => $other) {
	            
	            $filename = time().$key.'_.'.$other->getClientOriginalExtension();
	            Storage::putFileAs($folderPath, new File($other), $filename);

	            $this->resize_crop_images(900, 1200, $other, $folderPath."/thumbs/cover_".$filename);
	            $this->resize_crop_images(450, 600, $other, $folderPath."/thumbs/large_".$filename);
	            $this->resize_crop_images(90, 120, $other, $folderPath."/thumbs/thumb_".$filename);
	        }

        }

		// echo "<pre>";
	    // var_dump($insertData);
	    // echo "</pre>";
	    // exit();

        Product::where('id', $request['id'])->update($updateData);
    	return redirect('admin/products');
	}

	public function delete($id){

    	$product = Product::find(base64_decode($id));

    	if ($product) {

    		$productFolder = 'public/admin/products/'.$product->slug;
    		Storage::deleteDirectory($productFolder);
    		
    		$product->delete();

    		return redirect('admin/products')->with('status','Product Deleted Successfully!!');

    	}else{

    		return redirect('admin/products')->with('status','Something went wrong!!');
    	}
    }
}
