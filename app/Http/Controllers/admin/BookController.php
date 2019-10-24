<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $bookall = DB::table('tbl_booking')->get();
        return view('admin.bookmails', compact('bookall'));
    }

    public function viewbook($id)
    {
        $book = Booking::find($id);
        return view('admin.viewbookmail', compact('book'));
    }

    public function changestatus(Request $request)
    {
        $book = Booking::find($request->id);
        $book->status = $request->status;
        $book->save();
        return redirect('/admin/bookmails')->with('status','Status Changed Successfully');

    }
}
