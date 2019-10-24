<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = DB::table('tbl_blogs')->where('display', 1)->get();
        // dd($blogs);
        $meta_description = "Hotel Madeninn is a hotel in sunsari, Ithari";
        $meta_keywords = "hotel in ithari, ithari, sunsari";
        return view('blogs', compact('meta_description', 'meta_keywords', 'blogs'));
    }

    public function showSingleBlog($slug)
    {
        $blogSlug = $slug;
        return view('blog', compact('blogSlug'));
    }
}
