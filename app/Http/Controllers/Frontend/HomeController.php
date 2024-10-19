<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $features = Blog::where('feature',true)->latest()->take(3)->get();
        $blogs = Blog::latest()->take(5)->get();
        $categories = Category::where('status','active')->latest()->get();
        return view('frontend.home.index',compact('categories','blogs','features'));
    }
}
