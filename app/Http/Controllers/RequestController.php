<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RequestController extends Controller
{

    public function index(){
        $requests = ModelsRequest::latest()->get();
        return view('dashboard.request.index',compact('requests'));
    }
    public function accept($id){
        $request = ModelsRequest::where('id',$id)->first();


        User::find($request->user_id)->update([
            'role' => 'blogger',
            'updated_at' => now(),
        ]);

        ModelsRequest::find($id)->delete();

        return back();


    }


    public function cancel($id){
        $request = ModelsRequest::where('id',$id)->first();

        ModelsRequest::find($id)->delete();

        return back();


    }


    public function request_sent(Request $request, $id){
        ModelsRequest::create([
            'user_id' => $id,
            'feedback' => $request->feedback,
            'created_at' => now(),
        ]);

        return back();
    }
}
