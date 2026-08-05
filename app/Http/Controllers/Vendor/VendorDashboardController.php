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

        // Calculations
        $monthlyRevenue = array_fill(1, 12, 0);
        $monthlyUnits = array_fill(1, 12, 0);

        // Monthly Revenue
        $orders
            ->where('status', '!=', 'cancelled')
            ->filter(fn($order) => $order->created_at->year == now()->year)
            ->each(function ($order) use (&$monthlyRevenue, $userId) {
                $month = $order->created_at->month;
                $monthlyRevenue[$month] += $order->items
                    ->filter(fn($item) => $item->product->vendor_id == $userId)
                    ->sum('total_price');
            });

        // Monthly Units
        $orders
            ->where('status', '!=', 'cancelled')
            ->filter(fn($order) => $order->created_at->year == now()->year)
            ->each(function ($order) use (&$monthlyUnits, $userId) {
                $month = $order->created_at->month;
                $monthlyUnits[$month] += $order->items
                    ->filter(fn($item) => $item->product->vendor_id == $userId)
                    ->sum('quantity');
            });

        // Fluctuation Calculation
            if(now()->month === 1) {
                $salesF = null;
                $revenueF = null;
            } else {
                $salesF = $monthlyUnits[now()->month - 1] === 0 ? null : (($monthlyUnits[now()->month] - $monthlyUnits[now()->month - 1]) * 100)/ $monthlyUnits[now()->month - 1];
                $revenueF = $monthlyRevenue[now()->month - 1] === 0 ? null : (($monthlyRevenue[now()->month] - $monthlyRevenue[now()->month - 1]) * 100)/ $monthlyRevenue[now()->month - 1]; 
            }
        
        $uniqueUsers =  $orders
                        ->pluck('user')
                        ->filter() // remove null users
                        ->filter(fn ($user) => $user->created_at->isCurrentMonth())
                        ->unique('id')
                        ->count();

        $chart_stats = [
            'revenue' => array_values($monthlyRevenue),
            'units' => array_values($monthlyUnits),
        ];

        $stats = [
            'orders' => $orders->count(),
            'salesF' => round($salesF,2),
            'revenueF' => round($revenueF,2),
            'uniqueUser' => $uniqueUsers,
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

        // DashboardTable
        $allOrders = Order::whereHas('items.product', function ($query) use ($userId) {
            $query->where('vendor_id', $userId);
        })
        ->with([
            'user',
            'items' => function ($query) use ($userId) {
                $query->whereHas('product', function ($q) use ($userId) {
                    $q->where('vendor_id', $userId);
                })->with('product');
            }
        ])
        ->orderByDesc('updated_at')
        ->get();

        return view('vendor.dashboard', compact('stats', 'chart_stats', 'allOrders'));
    }
}
