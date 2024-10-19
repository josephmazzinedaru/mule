<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->paginate(2);
        return view('frontend.blog.index',compact('blogs'));
    }
    public function single($slug){
        $blog = Blog::where('slug',$slug)->first();
        $comments = BlogComment::with('replies')->where('blog_id',$blog->id)->whereNull('parent_id')->get();
        return view('frontend.blog.single',compact('blog','comments'));
    }
    public function comment( Request $request , $id){
      BlogComment::create([
        'user_id' => Auth::user()->id,
        'blog_id' => $id,
        'parent_id' => $request->parent_id,
        'name' => $request->name,
        'email' => $request->email,
        'comment' => $request->comment,
        'created_at' => now(),
      ]);
      return back()->with('comment',"You Commented This Post");
    }
}
