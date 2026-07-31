<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Order;

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

    public function orders(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $userId = Auth::id();

        $orders = Order::where('user_id', $userId)
            ->when($search, function ($query) use ($search) {
                $query->where('id', 'LIKE', "%{$search}%");
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->with([
                'user',
                'items.product'
            ])
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('customer.orders.manage', compact('orders'));
    }

public function donations(Request $request)
{
    $search = $request->query('search');
    $status = $request->query('status');
    $userId = Auth::id();

    $orders = Order::where('user_id', $userId)
        ->where('status', '!=', 'cancelled')
        ->whereHas('items', function ($query) {
            $query->where('donation_quantity', '>', 0);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('id', 'LIKE', "%{$search}%");
        })
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->with([
            'user',
            'items.product'
        ])
        ->orderByDesc('updated_at')
        ->paginate(10)
        ->withQueryString();

    return view('customer.donations.manage', compact('orders'));
}
}
