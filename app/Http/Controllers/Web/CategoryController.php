<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($category)
    {
        $data['category'] = Category::active()->findOrFail($category);
        $data['categories'] = Category::select('id', 'name')->active()->get();
        $data['skills'] = $data['category']->skills()->active()->paginate(6);

        return view('web.categories.show')->with($data);
    }
}
