<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.categories.index')->with($data);
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);

        Category::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category added successfully.');
    }

    public function show(Category $category)
    {
        $data['category'] = $category;

        return view('dashboard.categories.show')->with($data);
    }

    public function edit(Category $category)
    {
        $data['category'] = $category;

        return view('dashboard.categories.edit')->with($data);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);

        $category->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }

    public function toggle(Category $category)
    {
        $category->update([
            'active' => !$category->active,
        ]);

        if ($category->active) {
            $status = 'activated';
        } else {
            $status = 'deactivated';
        }

        return back()->with('success', "Category {$status} successfully.");
    }
}
