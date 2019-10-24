<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Setting;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        $setting = Setting::find('1');
        return view('admin.login', compact('setting'));
    }
}
