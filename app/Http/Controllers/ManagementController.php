<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagementController extends Controller
{
    public function index(){
        $managers= User::where('role','manager')->get();
        return view('dashboard.management.auth.index',compact('managers'));
    }
    public function register_user(Request $request){
     $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'role'=> 'required|in:manager,blogger,user',
     ]);

     if(!$request->role==""){

         User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'role'=> $request->role,
         ]);
        return back()->with('success_insert','User Register Successfully');

     }else{
        return back()->withErrors(['role'=>"please select any role first"])->withInput();
     }

    }

    public function role_undo($id){
        $manager = User::where('id',$id)->first();
        if($manager->role == 'manager'){
            User::find($manager->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
        return back()->with('success_insert','Role Change Successfully');

        }
        return back()->with('success_insert','Role Change Successfully');

        }

        public function role_assign(){
            $users = User::where('role','user')->where('block',0)->latest()->get();
            $role_assign_blogger = User::where('role','blogger')->get();
            $role_assign_user = User::where('role','user')->where('block',0)->get();
            return view('dashboard.management.role.index',[
                'users' => $users,
                'role_assign_blogger' => $role_assign_blogger,
                'role_assign_user' => $role_assign_user,
            ]);
        }

        public function role_assign_post(Request $request){
            $request->validate([
                'role' => 'required|in:manager,blogger,user',
            ]);

            $user = User::where('id',$request->user_id)->first();

            User::find($user->id)->update([
                'role' => $request->role,
            ]);
            return back()->with('success_role','User Role Successfully Update');


        }

        public function role_undo_blogger($id){
            $blogger = User::where('id',$id)->first();

            if($blogger->role == 'blogger'){
                User::find($blogger->id)->update([
                    'role' => 'user',
                    'updated_at' => now(),
                ]);
            return back()->with('success_role','Role Change Successfully Update');

            }
            return back()->with('success_role','Role Change Successfully Update');
        }

        public function role_undo_user_block($id){
            $user = User::where('id',$id)->first();

            if($user->role == 'user'){
                User::find($user->id)->update([
                    'block' => true,
                    'updated_at' => now(),
                ]);
            return back()->with('success_role','Role Change Successfully Update');

            }
            return back()->with('success_role','Role Change Successfully Update');
        }


    }
