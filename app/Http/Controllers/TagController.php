<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
 
use Illuminate\Support\Str;
class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('dashboards.webadmin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboards.webadmin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:tags']);
        $tag = Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        if ($request->ajax()) {
            return response()->json($tag); // Return the newly created category
        }

        return redirect()->route('webadmin.tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('dashboards.webadmin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate(['name' => 'required|unique:tags,name,' . $tag->id]);

        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('webadmin.tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('webadmin.tags.index')->with('success', 'Tag deleted successfully.');
    }
}
