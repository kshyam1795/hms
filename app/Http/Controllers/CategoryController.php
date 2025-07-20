<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $categories = Category::all();
        return view('dashboards.webadmin.categories.index', compact('categories'));
    }

    public function create() {
        return view('dashboards.webadmin.categories.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:categories']);
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

         // Check if the request expects JSON (AJAX call)
        if ($request->ajax()) {
            return response()->json($category); // Return the newly created category
        }
        return redirect()->route('webadmin.categories.index')->with('success', 'Category added.');
    }

    public function edit(Category $category) {
        return view('dashboards.webadmin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate(['name' => 'required']);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('webadmin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('webadmin.categories.index')->with('success', 'Deleted.');
    }
}
