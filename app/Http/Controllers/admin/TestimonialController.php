<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = DB::table('testimonials')->orderBy('order_item')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $testimonial=new Testimonial();

        $validatedData = $request->validate([
            'user_name' => 'required|max:255',
            'post' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $testimonial->user_name = $request->input('user_name');
        $testimonial->post = $request->input('post');
        $testimonial->title = $request->input('title');
        $testimonial->slug = str_slug($testimonial->title);
        $testimonial->display = $request->has('display');
        $testimonial->description = $request->input('description');
        $testimonial->order_item = Testimonial::max('order_item')+1;
        $testimonial->save();
        return redirect('admin/testimonials')->with('status', 'Testimonial Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial=Testimonial::find($id);
        if(is_null($testimonial)){
            return redirect('admin/testimonials')->with('errStatus', "Something Went Wrong");
        }
        return view('admin.testimonials.edit', [
            'testimonials'=>$testimonial
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|max:255',
            'post' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        $testimonial->user_name=$request->input('user_name');
        $testimonial->post=$request->input('post');
        $testimonial->title=$request->input('title');
        $testimonial->slug=str_slug($testimonial->title);
        $testimonial->display=$request->has('display');
        $testimonial->description=$request->input('description');
        $testimonial->save();
        return redirect('admin/testimonials')->with('status', 'Testimonial Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $delete=$testimonial->forceDelete();
        if($deletes){
            return redirect('admin/testimonials')->with('status', 'Testimonial Deleted Successfully');
        }else {
            return redirect('admin/testimonials')->with('errStatus', 'Something Went Wrong');
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
            Testimonial::where('id', $id)->update($updateData);
            $i++ ;
        }

        $data = array('status'=> 'success');
        echo json_encode($data);

    }
}
