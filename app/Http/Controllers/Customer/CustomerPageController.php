<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerPageController extends Controller
{
    public function profile()
    {
        return view('customer.profile');
    }

    public function payments()
    {
        return view('customer.payments.manage');
    }

    public function orders()
    {
        return view('customer.orders.manage');
    }

    public function donations()
    {
        return view('customer.donations.manage');
    }
}
