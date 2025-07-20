<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('dashboards.webadmin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();  
        $tags = Tag::all();
        return view('dashboards.webadmin.blog.create', compact('categories', 'tags'));
        //return view('dashboards.webadmin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $post = new BlogPost();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->keywords = $request->keywords;       
        $post->user_id = Auth::id();
        $post->status = 'draft';

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('blog_images', 'public');
        }

        $post->save();

        // Now attach categories and tags
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('webadmin.blog.index')->with('success', 'Post created successfully!');
    }

    public function show(BlogPost $blog)
    {
        
        
        return view('dashboards.webadmin.blog.show', ['blogPost' => $blog]);
    }

    public function edit(BlogPost $blog)
    {
        //dd($blog);
        $categories = Category::all();  
        $tags = Tag::all();
        return view('dashboards.webadmin.blog.edit', ['blogPost' => $blog, 'categories' => $categories, 'tags' => $tags]);
    }

    public function update(Request $request, BlogPost $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->keywords = $request->keywords;

        if ($request->hasFile('image')) {
            $blog->image = $request->file('image')->store('blog_images', 'public');
        }

        $blog->save();

        return redirect()->route('webadmin.blog.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('webadmin.blog.index')->with('success', 'Post deleted successfully!');
    }
}
