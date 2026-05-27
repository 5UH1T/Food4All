<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorPageController extends Controller
{

    public function categories()
    {
        return view('vendor.categories.manage');
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
        return view('vendor.products.manage');
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
