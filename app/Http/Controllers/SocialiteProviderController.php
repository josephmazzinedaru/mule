<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialiteProviderController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        $users = Socialite::driver($provider)->user();
        $old_user = User::where('email',$users->email)->first();

        if($users){
            Auth::login($old_user);
            return redirect()->route('dashboard');
        }else{

            $getUsers = User::create([
                'name' => $users->name,
                'email' => $users->email,
                // 'image' => $users->image,
                'password' => encrypt('the_muleBlog_password.@1234'),
                'role' => 'blogger',
                'email_verified_at' => now(),
                'created_at' => now(),

            ]);

            Auth::login($getUsers);
            return redirect()->route('dashboard');
        }
    }
}

