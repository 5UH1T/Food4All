<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VendorDashboardController extends Controller
{
    
    public function index()
    {
        $userId = Auth::id();
        $orders = Order::with([
                'user',
                'items.product'
            ])
            ->whereHas('items.product', function ($query) use ($userId) {
                $query->where('vendor_id', $userId);
            })
            ->get();

        $stats = [
            'orders' => $orders->count(),
            'customers' => $orders->where('status', "!=", 'cancelled')->pluck('user_id')->unique()->count(),
            'revenue' => $orders
                        ->where('status','!=','cancelled')
                        ->sum(function ($order) use ($userId) {
                            return $order->items
                            ->filter(function ($item) use ($userId) {
                                return $item->product->vendor_id == $userId;
                            })
                            ->sum('total_price');
                        }),
            'top' => $orders
                    ->where('status', "!=", 'cancelled')
                    ->pluck('items')
                    ->flatten()
                    ->filter(function ($item) use ($userId) {
                        return $item->product->vendor_id == $userId;
                    })
                    ->groupBy('product_id')
                    ->map(function ($items) {
                        return [
                            'product' => $items->first()->product,
                            'sales' => $items->sum('quantity'),
                        ];
                    })
                    ->sortByDesc('sales')
                    ->take(3),

            'complete' => $orders->where('status', 'delivered')->count(),
            'cancel' => $orders->where('status', 'cancelled')->count(),
            'pending' => $orders->where('status', "!=", 'cancelled')->where('status', "!=", 'delivered')->count(),
        ];

        return view('vendor.dashboard', compact('stats'));
    }
}
