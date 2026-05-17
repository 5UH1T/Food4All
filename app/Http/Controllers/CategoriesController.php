<?php

namespace App\Http\Controllers;

use App\Models\Category;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{

    public function addCategory(Request $request) {
        $validated_Data = $request->validate([
            'category_name' => [
                'required',
                'unique:categories,category_name',
                'max:100',
                'regex:/^[A-Za-z][A-Za-z0-9\s]*$/'
            ],
            'status' => ['required']
        ], [
            'category_name.required' => 'Category name is required.',
            'category_name.unique' => 'Category already exists.',
            'category_name.max' => 'Category name cannot exceed 100 characters.',
            'category_name.regex' => 'Category name must start with a letter.'
        ]);

        Category::create($validated_Data);

        return redirect()->back()->with('success','Category Added Successfully!');
    }

    public function showCategory(string $id)
    {
        $category_item = Category::findOrFail($id);
        return response()->json($category_item);
    }

    public function updateCategory(Request $request, string $id) {
        $category = Category::findOrFail($id);
        $validated_Data = $request->validate([
            'category_name' => [
                'required',
                'max:100',
                'regex:/^[A-Za-z][A-Za-z0-9\s]*$/',
                Rule::unique('categories', 'category_name')->ignore($id),
            ],
            'status' => [
                'required',
            ],
        ], [
            'category_name.required' => 'Category name is required.',
            'category_name.unique' => 'Category already exists.',
            'category_name.max' => 'Category name cannot exceed 100 characters.',
            'category_name.regex' => 'Category name must start with a letter and contain only letters, numbers, and spaces.',
        ]);

        $category->update($validated_Data);

        return redirect()->back()->with('success','Category Updated Successfully!');
    }

    public function deleteCategory(Request $request, string $id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success','Category Deleted Successfully!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
