<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


   public function index(){
       return view('admin.index');
   }

    public function logout () {
        //logout user
        auth()->logout();
        return redirect('/');
    }


}
