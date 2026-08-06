<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with([
                'user',
                'items.product'
            ])
            ->get();

        // Calculations
        $monthlyRevenue = array_fill(1, 12, 0);
        $monthlyUnits = array_fill(1, 12, 0);

        // Monthly Revenue
        $orders
            ->where('status', '!=', 'cancelled')
            ->filter(fn($order) => $order->created_at->year == now()->year)
            ->each(function ($order) use (&$monthlyRevenue) {
                $month = $order->created_at->month;
                $monthlyRevenue[$month] += $order->items
                    ->sum('total_price');
            });

        // Monthly Units
        $orders
            ->where('status', '!=', 'cancelled')
            ->filter(fn($order) => $order->created_at->year == now()->year)
            ->each(function ($order) use (&$monthlyUnits) {
                $month = $order->created_at->month;
                $monthlyUnits[$month] += $order->items
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
        
        // $uniqueUsers =  $orders
        //                 ->pluck('user')
        //                 ->filter() // remove null users
        //                 ->filter(fn ($user) => $user->created_at->isCurrentMonth())
        //                 ->unique('id')
        //                 ->count();

        $chart_stats = [
            'revenue' => array_values($monthlyRevenue),
            'units' => array_values($monthlyUnits),
        ];

        $stats = [
            'orders' => $orders->filter(fn ($order) => $order->created_at->isSameMonth(now()))->count(),
            'salesF' => round($salesF,2),
            'revenueF' => round($revenueF,2),
            'customers' => User::where('role', 2)->count(),
            'uniqueUser' => User::where('role', 2)->get()->filter(fn ($item) => $item->created_at->isSameMonth(now()))->count(),
            'vendors' => User::where('role', 1)->count(),
            'uniqueVendors' => User::where('role', 1)->get()->filter(fn ($item) => $item->created_at->isSameMonth(now()))->count(),
            'revenue' => $orders
                        ->where('status','!=','cancelled')
                        ->sum(function ($order) {
                            return $order->items
                            ->sum('total_price');
                        }),
            'top' => $orders
                    ->where('status', "!=", 'cancelled')
                    ->pluck('items')
                    ->flatten()
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
        return view('admin.dashboard', compact('stats', 'chart_stats'));
    }
}
