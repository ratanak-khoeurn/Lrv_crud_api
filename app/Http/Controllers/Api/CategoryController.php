<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ShowCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::list();
        $category = CategoryResource::collection($category);
        return response()->json(['success' => true, 'data' => $category], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::store($request);
        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'data' => false,
                'message' => 'category not found with id ' . $id
            ], 404);
        }
        $category = new ShowCategoryResource($category);
        return response()->json([
            'success' => true,
            'data' => $category,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'data' => false,
                'message' => 'Category not found with id ' . $id
            ], 404);
        }
        $category::store($request, $id);
        return response()->json([
            'success' => true,
            'data' => true,
            'message' => 'Category updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'data' => false,
                'message' => 'Category not found with id ' . $id
            ], 404);
        }
        $category::find($id)->delete();
        return response()->json([
            'success' => true,
            'data' => true,
            'message' => 'category deleted successfully'
        ], 200);
    }
}
