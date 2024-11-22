<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('project')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        return Category::create($validated);
    }

    public function show(Category $category)
    {
        return $category->load('project');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'string',
            'description' => 'string',
            'project_id' => 'exists:projects,id',
        ]);

        $category->update($validated);

        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
