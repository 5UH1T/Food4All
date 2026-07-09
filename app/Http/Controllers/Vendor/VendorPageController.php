<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class VendorPageController extends Controller
{

    public function categories(Request $request)
    {
        $search = $request->query('search');
        $categories = Category::select('id','category_name')->where('status', 'published')->get();
        $subCategories = SubCategory::where('vendor_id', auth()->id())
            ->with('categories')
            ->when($search, function ($query) use ($search) {
                $query->where('sub_category_name', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('vendor.categories.manage', compact('categories', 'subCategories'));
    }

    public function orders()
    {
        return view('vendor.orders.manage');
    }

    public function payments()
    {
        return view('vendor.payments.manage');
    }

    public function createProducts()
    {
        $categories = Category::select('id','category_name')->where('status', 'published')->select('id', 'category_name')->get();

        $subCategories = SubCategory::select('id','sub_category_name')->where('status', 'published')->select('id', 'category_id', 'sub_category_name')->get();

        return view('vendor.products.manage' , compact('categories','subCategories'));
    }

    public function products()
    {
        return view('vendor.products.view');
    }

    public function index()
    {
        return view('vendor.dashboard');
    }

    public function settings()
    {
        return view('vendor.settings');
    }

}
