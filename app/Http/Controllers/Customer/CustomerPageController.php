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
        $search = $request->search;
        $filterDate = $request->filterDate;
        $userId = Auth::id();

        $query = Order::where('user_id', $userId)
            ->where('status', '!=', 'cancelled')
            ->whereHas('items', function ($query) {
                $query->where('donation_quantity', '>', 0);
            });

        // Search by Order ID
        if ($search) {
            $query->where('id', 'LIKE', "%{$search}%");
        }

        // Filter by date
        if ($filterDate == 'today') {
            $query->whereDate('created_at', today());
        } elseif ($filterDate == 'week') {
            $query->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ]);
        } elseif ($filterDate == 'month') {
            $query->whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ]);
        } elseif ($filterDate == 'year') {
            $query->whereBetween('created_at', [
                now()->startOfYear(),
                now()->endOfYear(),
            ]);
        }

        $orders = $query->with([
                'user',
                'items.product'
            ])
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('customer.donations.manage', compact('orders'));
    }

    
    public function stats()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)
            ->with([
                'user',
                'items.product'
            ])
            ->get();        
            
            // Calculations
            $donation = $orders
                ->where('status', '!=', 'cancelled')
                ->pluck('items')
                ->flatten()
                ->where('donation_quantity', '>', 0)
                ->sum(function ($item) {
                    return (($item->total_price / $item->quantity) * $item->donation_quantity);
                });
                
            // Orders
            $order_month = 
                $orders->where('status', '!=', 'cancelled')
                ->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ])
                ->count();
            
            // Ordered Amount
            $amount_month = $orders
                ->where('status', '!=', 'cancelled')
                ->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ])
                ->sum('total_cost');
            
            $amount_prev = $orders
                ->where('status', '!=', 'cancelled')
                ->whereBetween('created_at', [
                    now()->subMonth()->startOfMonth(),
                    now()->subMonth()->endOfMonth(),
                ])
                ->sum('total_cost');

            $amount_var = $amount_prev > 0 ? (($amount_month - $amount_prev) * 100) / ($amount_prev) : null;

            // Donation Amount
            $donation_month = $orders
                ->where('status', '!=', 'cancelled')
                ->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ])
                ->pluck('items')
                ->flatten()
                ->where('donation_quantity', '>', 0)
                ->sum(function ($item) {
                    return (($item->total_price / $item->quantity) * $item->donation_quantity);
                });
            
            $donation_prev = $orders
                ->where('status', '!=', 'cancelled')
                ->whereBetween('created_at', [
                    now()->subMonth()->startOfMonth(),
                    now()->subMonth()->endOfMonth(),
                ])
                ->pluck('items')
                ->flatten()
                ->where('donation_quantity', '>', 0)
                ->sum(function ($item) {
                    return (($item->total_price / $item->quantity) * $item->donation_quantity);
                });

            $donation_var = $donation_prev > 0 ? (($donation_month - $donation_prev) * 100) / ($donation_prev) : null;


            // Stats
            $stats = [
                'orders' => $orders->where('status', '!=', 'cancelled')->count(),
                'order_amount' => $orders->where('status', '!=', 'cancelled')->sum('total_cost'),
                'stores' => $orders->where('status', '!=', 'cancelled')
                    ->pluck('items')
                    ->flatten()
                    ->pluck('product.vendor_id')
                    ->unique()
                    ->count(),
                'products' => $orders->where('status', '!=', 'cancelled')
                    ->pluck('items')
                    ->flatten()
                    ->pluck('product')
                    ->unique()
                    ->count(),
                'donation' => $donation,
            ];

            // Per Month Comparsion
            $analysis = [
                'orders' => $order_month,
                'donation' =>$donation_var,
                'amount' =>$amount_var,
            ];
        
        return view('customer.stats.manage', compact('stats', 'analysis'));
    }
}
