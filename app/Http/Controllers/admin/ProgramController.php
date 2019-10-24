<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Program;
use Image;

class ProgramController extends Controller
{

	public function index(){
		$programs = $this->getFullListFromDB();
		// $programs =  DB::table('programs')->where('parent_id', $parent_id)->orderBy('order_item')->get();
		return view('admin.programs', compact('programs'));
	}

	public function getFullListFromDB($parent_id = 0)
	{
		$programs =  DB::table('programs')->where('parent_id', $parent_id)->orderBy('order_item')->get();
	    
	    foreach ($programs as &$value) {
	        $subresult = $this->getFullListFromDB($value->id);

	        if (count($subresult) > 0) {
	            $value->children = $subresult;
	        }
	    }

	    unset($value);

	    return $programs;
	}


	public function create(){
		return view('admin.add-program');
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
        return Program::select('slug')->where('slug', 'like', $slug.'%')
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

	        $cover = storage_path('app/public/admin/categories/thumbs/'.$filename);
	        Image::make($image)->crop($width, $height_new, 0, $h_point)->resize($max_width, $max_height)->save($cover);
	    } else {
	        //cut point by width
	        $w_point = round(($width - $width_new) / 2);
	        $cover = storage_path('app/public/admin/categories/thumbs/'.$filename);
	        Image::make($image)->crop($width_new, $height, $w_point, 0)->resize($max_width, $max_height)->save($cover);
	    }

    }

    // Slug check and create ends

	public function store(Request $request){
		$max_order = DB::table('programs')->max('order_item');
		$program = new Program;

		$program->title = $request['title'];
		$program->slug = $this->createSlug($request['title']);

		if ($request->hasFile('image')) {
            //Add the new photo
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/admin/categories', new File($image), $filename);

            $this->resize_crop_images(1349, 589, $image, "cover_".$filename);
            $this->resize_crop_images(957, 400, $image, "large_".$filename);
            $this->resize_crop_images(480, 360, $image, "thumb_".$filename);
            
            $OldFilename = $program->image;

            //Update the database
            $program->image = $filename;
         
            //Delete the old photo
            Storage::delete("public/admin/categories/".$OldFilename);
            Storage::delete("public/admin/categories/thumbs/cover_".$OldFilename);
            Storage::delete("public/admin/categories/thumbs/large_".$OldFilename);
            Storage::delete("public/admin/categories/thumbs/thumb_".$OldFilename);


        }
		$program->image = isset($filename) ? $filename : '';
		if (!$request['category']) {
			$request['category'] = 0;
		}
		if (!$request['display']) {
			$request['display'] = 0;
		}
		$program->category = $request['category'];
		$program->display = $request['display'];
		$program->description = $request['description'];
		$program->long_content = $request['long_content'];
		$program->parent_id = 0;
		$program->child = 0;
		$program->order_item = $max_order + 1;
		$program->created_by = "admin";
		$program->updated_by = "admin";

		$program->save();
		return redirect('admin/programs');
	}

	public function set_order(Request $request){
		
		$program = new Program;
		$list_order = $request['list_order'];

	    $this->saveList($list_order);
	    $data = array('status' => 'success');
	    echo json_encode($data);
	    exit;
	}

	function saveList($list, $parent_id = 0, $child = 0, &$m_order = 0)
	{

	    foreach ($list as $item) {
	        $m_order++;
	        $updateData = array("parent_id" => $parent_id, "child" => $child, "order_item" => $m_order);
	        Program::where('id', $item['id'])->update($updateData);

	        if (array_key_exists("children", $item)) {
	            $updateData = array("child" => 1);
				Program::where('id', $item['id'])->update($updateData);
	            $this->saveList($item["children"], $item['id'], 0, $m_order);
	        }
	    }
	}

	public function edit($id){
		$program = Program::find(base64_decode($id));
		return view('admin.edit-program',compact('program'));
	}

	public function update(Request $request){

		$program = Program::find($request['id']);
		if (!$request['category']) {
			$request['category'] = 0;
		}
		if (!$request['display']) {
			$request['display'] = 0;
		}

		$updateData = array("title" => $request['title'], "category" => $request['category'], "display" => $request['display'], "description" => $request['description'], "long_content" => $request['long_content'], "updated_by" => "admin", "updated_at" => date('Y-m-d H:i:s'));
		
    	
    	// $program->title = $request['title'];
    	$slug = str_slug($request['title'], '-');

    	if ($program->slug != $slug) {
			// $program->slug = $this->createSlug($slug, $request['id']);
			$updateData['slug'] = $this->createSlug($slug, $request['id']);
		}

    	if ($request->hasFile('image')) {
            //Add the new photo
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $data = getimagesize($image);
            Storage::putFileAs('public/admin/categories', new File($image), $filename);

            $this->resize_crop_images(1349, 589, $image, "cover_".$filename);
            $this->resize_crop_images(957, 400, $image, "large_".$filename);
            $this->resize_crop_images(480, 360, $image, "thumb_".$filename);
            
            $OldFilename = $program->image;

            //Update the database
            // $program->image = $filename;
            $updateData['image'] = $filename;
         
            //Delete the old photo
            Storage::delete("public/admin/categories/".$OldFilename);
            Storage::delete("public/admin/categories/thumbs/cover_".$OldFilename);
            Storage::delete("public/admin/categories/thumbs/large_".$OldFilename);
            Storage::delete("public/admin/categories/thumbs/thumb_".$OldFilename);
        }

  //   	$program->category = $request['category'];
		// $program->display = $request['display'];
		// $program->description = $request['description'];
		// $program->long_content = $request['long_content'];
		// $program->updated_by = "admin";
		// $program->updated_at = date('Y-m-d H:i:s');

  //   	$program->save();
        // echo "<pre>";
        // var_dump($updateData);
        // echo "</pre>";
        // exit();
        Program::where('id', $request['id'])->update($updateData);
    	return redirect('admin/programs');
	}

	public function delete($id){

    	$program = Program::find(base64_decode($id));

    	if ($program && $program->child == 0) {

    		Storage::delete("public/admin/categories/".$program->image);
            Storage::delete("public/admin/categories/thumbs/cover_".$program->image);
            Storage::delete("public/admin/categories/thumbs/large_".$program->image);
            Storage::delete("public/admin/categories/thumbs/thumb_".$program->image);
    		
    		$program->delete();

    		$checkProgram = DB::table('programs')
    								->where('parent_id', $program->parent_id)
    								->where('parent_id', '<>',0)
    								->get();

    		if (count($checkProgram) == 0) {
    			$updateData = array("child" => 0);
				Program::where('id', $program->parent_id)->update($updateData);
    		}

    		return redirect('admin/programs')->with('status','Program Deleted Successfully!!');

    	}else{

    		return redirect('admin/programs')->with('status','Program has Child!!');
    	}
    }

}
