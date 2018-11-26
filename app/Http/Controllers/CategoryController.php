<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Test response for now.
        return response()->json(Category::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $category = new Category;

        $category = $request->name;

        if($category->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Category added successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed to add category.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return response()->json($category);
    }

    /**
     * Returns all of the tasks by category.
     * @param Category $category 
     * @return type
     */
    public function tasks(Category $category)
    {
        return response()->json($category->tasks()->orderBy('order')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $category = $category->update($request->name);

        return response()->json([
            'status' => $category,
            'message' => $category ? 'Category updated.' : 'Failed to update category.'      
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $deleteCategory = $category->delete();

        return response()->json([
            'status' => $deleteCategory,
            'message' => $deleteCategory ? 'Category deleted.' : 'Failed to delete category.'
        ]);
    }
}
