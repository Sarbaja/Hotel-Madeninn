<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
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
        $blogs = DB::table('tbl_blogs')->orderBy('order_item')->get();
        return view('admin.blogs.index', [
            'blogs'=> $blogs 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
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
        $destination = base_path() . '/public/uploads/blogs/';
        $image = $request->file('image');
        $moved = Image::make($image)->save($destination . $fileName);
        
        if($moved){
            $destinationPath=base_path() . "/public/uploads/blogs/thumbs";
            $resized = $this->resize_crop_images(350, 230, $image , $destinationPath . '/thumb_' . $fileName);
            $resized = $this->resize_crop_images(1140, 740, $image , $destinationPath . '/large_' . $fileName);
        }
        
        if($resized){
            $blogs=new Blog();
            $blogs->title=$request->input('title');
            $blogs->slug=str_slug($blogs->title);
            $blogs->description=$request->input('description');
            $blogs->image=$fileName;
            $blogs->display=$request->has('display');
            $blogs->featured=$request->has('featured');
            $blogs->order_item=Blog::max('order_item')+1;
            $save=$blogs->save();
        }
        
        if($save){
            return redirect('admin/blogs')->with('status', 'Blog Created Successfully!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blogs=Blog::all();
        return view('blogs', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog=Blog::find($id);
        if(is_null($blog)){
            return redirect('admin/blogs')->with('errStatus', "Something Went Wrong");
        }

        return view('admin.blogs.edit', [
            'blog'=>$blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName   = time() . '.' . $extension;
            $destination = base_path() . '/public/uploads/blogs/';
            $image = $request->file('image');
            $moved = Image::make($image)->save($destination . $fileName);
            
            if($moved){
                $destinationPath=base_path() . "/public/uploads/blogs/thumbs";
                $resized = $this->resize_crop_images(350, 230, $image , $destinationPath . '/thumb_' . $fileName);
                $resized = $this->resize_crop_images(1140, 740, $image , $destinationPath . '/large_' . $fileName);

            }
            
            if($resized){
                $oldFile=$blog->image;
                File::delete($destination . '/' . $oldFile);
                File::delete($destination . '/thumbs/thumb_' . $oldFile);
                File::delete($destination . '/thumbs/large_' . $oldFile);
    
                $blog->image=$fileName;
            }
        }
        
        $blog->title=$request->input('title');
        $blog->slug=str_slug($blog->title);
        $blog->description=$request->input('description');
        $blog->display=$request->has('display');
        $blog->featured=$request->has('featured');
        $save=$blog->save();
        
        if($save){
            return redirect('admin/blogs')->with('status', 'Blog Updated Successfully!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $delete=$blog->forceDelete();

        if($delete){
            $destination=base_path() . '/public/uploads/blogs';
            File::delete($destination . '/' . $blog->image);
            File::delete($destination . '/thumbs/thumb_' . $blog->image);
            File::delete($destination . '/thumbs/large_' . $blog->image);
            return redirect('admin/blogs')->with('status', 'Blog Deleted Successfully!!');
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
            Blog::where('id', $id)->update($updateData);
            $i++ ;
        }

        $data = array('status'=> 'success');
        echo json_encode($data);
    }

    public function showSingleBlog($id)
    {
        $blog=Blog::find($id);
        $otherBlog = Blog::where("id", "!=", $id)->where("display", 1)->get();
        // dd($blog);
        return view('blog', [
            'blog' => $blog,
            'otherBlog' => $otherBlog
        ]);
    }

}
