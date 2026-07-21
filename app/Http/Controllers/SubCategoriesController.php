<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoriesController extends Controller
{
 
    // Create Category
    public function addCategory(Request $request) {
        $validator = Validator::make($request->all(), [
        'sub_category_name' => [
            'required',
            Rule::unique('sub_categories', 'sub_category_name')
                ->where(function ($query) {
                    return $query->where('vendor_id', Auth::id());
                }),
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
            'vendor_id' => Auth::id(),
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
        'sub_category_name' => [
            'required',
            Rule::unique('sub_categories', 'sub_category_name')
                ->where(function ($query) {
                    return $query->where('vendor_id', Auth::id());
                })
                ->ignore($id),
        ],
            'status' => ['required'],
            'category_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', implode(', ', $validator->errors()->all()));
        }

        $category->update([
            'sub_category_name' => $request->sub_category_name,
            'status' => $request->status,
            'category_id' => $request->category_id, 
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
