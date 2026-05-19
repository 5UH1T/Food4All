<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{

    public function attributes()
    {
        return view('admin.attributes.manage');
    }

    public function categories(Request $request)
    {
        $search = $request->query('search');

        $categories = Category::query()
            ->when($search, function ($query) use ($search) {
                $query->where('category_name', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('admin.categories.manage', compact('categories'));
    }

    public function orders()
    {
        return view('admin.orders.manage');
    }

    public function payments()
    {
        return view('admin.payments.manage');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function users()
    {
        return view('admin.users.manage');
    }

    public function vendors()
    {
        return view('admin.vendors.manage');
    }


}
