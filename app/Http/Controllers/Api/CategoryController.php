<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    public function index(): JsonResource
    {
        return CategoryResource::collection(
            Category::active()
                ->with('skills')
                ->get());
    }

    public function show($id): JsonResource
    {
        $category = Category::active()
            ->with('skills')
            ->findOrFail($id);

        return CategoryResource::make($category);
    }
}
