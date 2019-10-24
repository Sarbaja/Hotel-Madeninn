<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonGalleryController extends Controller
{
    public function index()
    {
        $slug = 'commongallery';
        return view('admin/commongallery',compact('slug'));
    }

    public function album($slug)
    {

        return view('admin/commongallery',compact('slug'));
    }
}
