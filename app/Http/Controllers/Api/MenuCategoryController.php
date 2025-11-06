<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
// use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index()
    {
        // $categories = MenuCategory::where('is_active', true)
        //     ->orderBy('display_order')
        //     ->orderBy('category_name')
        //     // ->withCount('activeMenuItems')

        // xdebug_break();
        $categories = MenuCategory::with('activeMenuItems')
            ->orderBy('display_order')
            ->orderBy('category_name')
            ->get();

        return response()->json($categories);
    }

    public function show($id)
    {
        // $category = MenuCategory::with(['activeMenuItems' => function($query) {
        //     $query->orderBy('display_order')->orderBy('title');
        // }])->findOrFail($id);
        $category = MenuCategory::orderBy('display_order')
            ->orderBy('title')
            ->findOrFail();

        return response()->json($category);
    }

    //TODO: move to admin-protected controller.
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'category_name' => 'required|string|max:255',
    //         'display_order' => 'nullable|integer',
    //         'is_active' => 'boolean'
    //     ]);

    //     $category = MenuCategory::create($validated);

    //     return response()->json($category, 201);
    // }

    //TODO: move to admin-protected controller.
    // public function update(Request $request, $id)
    // {
    //     $category = MenuCategory::findOrFail($id);

    //     $validated = $request->validate([
    //         'category_name' => 'string|max:255',
    //         'display_order' => 'nullable|integer',
    //         'is_active' => 'boolean'
    //     ]);

    //     $category->update($validated);

    //     return response()->json($category);
    // }

    //TODO: move to admin-protected controller.
    // public function destroy($id)
    // {
    //     $category = MenuCategory::findOrFail($id);
    //     $category->delete();

    //     return response()->json(['message' => 'MenuCategory deleted successfully']);
    // }
}