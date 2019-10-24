<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $setting = Setting::find('1');
        return view('admin.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::find('1');


        $validatedData = $request->validate([
            'sitetitle' => 'required|max:255',
            'siteemail' => 'required|max:225|email',
        ]);

        $setting->sitetitle = $request['sitetitle'];
        $setting->siteemail = $request['siteemail'];
        $setting->sitekeyword = $request['sitekeyword'];
        $setting->facebookurl = $request['facebookurl'];
        $setting->twitterurl = $request['twitterurl'];
        $setting->googleplusurl = $request['googleplusurl'];
        $setting->linkedinurl = $request['linkedinurl'];
        $setting->phone = $request['phone'];
        $setting->mobile = $request['mobile'];
        $setting->instagramurl = $request['instagramurl'];
        $setting->fax = $request['fax'];
        $setting->address = $request['address'];
        $setting->youtubevideourl = $request['youtubevideourl'];


        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $oldlogo = $setting->logo;
            $validatedData = $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            Storage::putFileAs('public/setting', new File($logo), $logo->getClientOriginalName());
            $setting->logo = $logo->getClientOriginalName();

            //deleting exiting logo
            Storage::delete('public/setting/'.$oldlogo);
        }
        $setting->save();

        return redirect('admin/setting')->with('status', 'Profile updated!');

    }
}
