<?php

namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function profile()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('admin.profile', compact('user'));
    }

    public function adduser()
    {
        return view('admin.adduser');
    }

    public function createuser(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:225|email',
            'role' => 'required|int',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $request['status'] = isset($request['status']) ? $request['status'] : '0';
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->to('/admin/users')->with('status', 'User added Successfully!');
    }

    public function update($id)
    {
        $user = User::find($id);
        return view('admin/updateuser', compact('user'));
    }

    public function updateuser(Request $request)
    {
        $user = User::find($request->id);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:225|email',
            'role' => 'required|int',
        ]);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        $user->status = isset($request['status']) ? $request['status'] : '0';

        $user->save();
        return redirect('admin/users')->with('status', 'User Update Successfully!');

    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->to('/admin/users')->with('status', 'User Delete Successfully!');
        }
        return redirect()->to('/admin/users')->with('status', 'Something Went Wrong!');

    }

}
