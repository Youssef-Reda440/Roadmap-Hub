<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories', [
            'categories' => Category::withCount('roadmaps')->orderBy('name')->paginate(15),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
        ]);

        $category = new Category;
        $category->name = $validated['name'];
        $category->description = $validated['description'] ?? null;
        $category->save();

        return back()->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories', [
            'categories' => Category::withCount('roadmaps')->orderBy('name')->paginate(15),
            'category' => $category->loadCount('roadmaps'),
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($category)],
            'description' => ['nullable', 'string'],
        ]);

        $category->name = $validated['name'];
        $category->description = $validated['description'] ?? null;
        $category->save();

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->roadmaps()->exists()) {
            return back()->with('error', 'A category with roadmaps cannot be deleted.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}
