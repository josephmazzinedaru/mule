<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProfileController extends Controller
{
    public function index(){
        return view ('dashboard.profile.index');

    }

    public function name_update(Request $request){
        $oldname = auth()->user()->name;
        $request->validate([
            'name'=>'required',
        ]);

        User::find(auth()->id())->update([
            'name'=>$request->name,
            'updated_at' => now(),

        ]);
        return back()->with('name_update',"Name Update Successful $oldname to $request->name");
    }
    public function email_update(Request $request){
        $oldemail = auth()->user()->email;
        $request->validate([
            'email'=>'required',
        ]);

        User::find(auth()->id())->update([
            'email'=>$request->email,
            'updated_at' => now(),

        ]);
        return back()->with('email_update',"Email Update Successful $oldemail to $request->email");
    }

    public function password_update(Request $request){

        $request->validate([
            'c_pass' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);
        if(Hash::check($request->c_pass,auth()->user()->password)){
           User:: find(auth()->user()->id)->update([
            'password' => $request->password,
            'updated_at' => now(),
           ]);
           return back()-> with('password_update','password update successfull');
        }else {
            return back()->withErrors(['password'=>'current password not match with our record'])->withInput();
        }

    }

    public function image_update(Request $request){

        $manager = new ImageManager(new Driver());

        if($request->hasFile('image')){
            $newname= auth()->user()->id .'-'. now()->format("M d ,Y ").'-'. rand(0,99999) .'.'.   $request-> file('image')->getClientOriginalExtension();
            $image = $manager->read($request-> file('image'));
            $image->toPng()->save(base_path('public/uploads/profile/'.$newname));

            User::find(auth()->user()->id)->update([
                'image' => $newname,
                'updated_at' => now(),
            ]);
            return back()->with('image update','image update successfull');
        }else{
            return back()->withErrors(['email'=>"Please insert image first"])->withInput();
        }

    }
}

