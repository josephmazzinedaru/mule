<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(2);
        return view('dashboard.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('dashboard.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
        ]);


        if ($request->hasFile('thumbnail')) {
            $newname = Auth::user()->id . '-' . Str::random(4) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/uploads/blog/' . $newname));

            if ($request->slug) {
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' =>strip_tags( $request->title),
                    'slug' => Str::slug($request->slug, '-'),
                    'short_description' => strip_tags($request->short_description),
                    'description' => strip_tags($request->description),
                    'thumbnail' => $newname,
                    'created_at' => now(),
                ]);
                return redirect()->route('blog.index')->with('success_insert', 'Blog Created Successfull');
            } else {
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title, '-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'thumbnail' => $newname,
                    'created_at' => now(),
                ]);
                return redirect()->route('blog.index')->with('success_insert', 'Blog Created Successfull');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('dashboard.blog.edit',compact('categories','blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);


        if($request->hasFile('thumbnail')){
            $newname = Auth::user()->id .'-'.Str::random(4).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/uploads/blog/1-0onL.jpg'));

            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'thumbnail' => $newname,
                    'updated_at' => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Successfull');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'thumbnail' => $newname,
                    'updated_at' => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Successfull');
            }
        }else{
            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'updated_at' => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Successfull');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'updated_at' => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Successfull');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Blog::find($blog->id)->delete();
        return redirect()->route('blog.index')->with('success','Blog Updated Successfull');
    }

    public function feature($id)
    {
        $blog = Blog::where('id',$id)->first();

        if($blog->feature == false){
            Blog::find($blog->id)->update([
                'feature' => true,
                'updated_at' => now(),
            ]);
            return redirect()->route('blog.index')->with('success','This Blog is Feature Now');
        }else{
            Blog::find($blog->id)->update([
                'feature' => false,
                'updated_at' => now(),
            ]);
            return redirect()->route('blog.index')->with('success','This Blog is Not Feature Now');
        }
    }
}
