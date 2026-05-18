<?php

namespace App\Http\Controllers;

use App\Models\Category;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{

    // Create Category
    public function addCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_name' => [
                'required',
                Rule::unique('categories', 'category_name'),
            ],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        Category::create([
            'category_name' => $request->category_name,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success','Category Added Successfully!');
    }

    // Show Single Category
    public function showCategory(string $id)
    {
        $category_item = Category::findOrFail($id);
        return response()->json($category_item);
    }

    // Edit Category
    public function updateCategory(Request $request, string $id) {
        $category = Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'category_name' => [
                'required',
                Rule::unique('categories', 'category_name')->ignore($id),
            ],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $category->update([
            'category_name' => $request->category_name,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success','Category Updated Successfully!');
    }

    // Delete Category
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
