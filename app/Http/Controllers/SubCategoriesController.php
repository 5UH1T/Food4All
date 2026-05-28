<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoriesController extends Controller
{
 
    // Create Category
    public function addCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'sub_category_name' => [
                'required',
                Rule::unique('sub_categories', 'sub_category_name'),
            ],
            'status' => ['required'],
            'category_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        SubCategory::create([
            'sub_category_name' => $request->sub_category_name,
            'category_id' => $request->category_id, 
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success','Category Added Successfully!');
    }

    // Show Single Category
    public function showCategory(string $id)
    {
        $category_item = SubCategory::findOrFail($id);
        return response()->json($category_item);
    }

    // Edit Category
    public function updateCategory(Request $request, string $id) {
        $category = SubCategory::findOrFail($id);
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
        $category = SubCategory::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success','Category Deleted Successfully!');
    }

}
