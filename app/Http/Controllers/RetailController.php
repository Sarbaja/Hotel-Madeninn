<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RetailController extends Controller
{
    public function index()
    {
        $retail = DB::table('tbl_retails')->where('display', 1)->get();

        return view('retail', compact('retail'));
    }
}
