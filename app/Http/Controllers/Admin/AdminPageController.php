<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

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

    public function orders(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $orders = Order::when($search, function ($query) use ($search) {
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

        return view('admin.orders.manage', compact('orders'));
    }

    public function updateItemStatus(Request $request, Order $order)
    {

        $status = $request->status;
        $items = OrderItem::where('order_id', $order->id)->get();

        foreach ($items as $item) {
            $item->update([
                'item_status' => $status,
            ]);
        }

        $isTrue = OrderItem::where('order_id', $order->id)
        ->where('item_status', '!=', $status)
        ->doesntExist();

        if ($isTrue) {
            $order->update([
                'status' => $status,
            ]);
        }
        if($status === 'picked')
            return back()->with('success', 'Order marked as Picked');
        else if($status === 'delivered')
            return back()->with('success', 'Order marked as Delivered.');
        else
            return back()->with('error', 'Updating order status failed');
    }

    public function donations(Request $request)
    {
        $search = $request->search;
        $filterDate = $request->filterDate;

        $query = Order::where('status', '!=', 'cancelled')
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
                'items' => function ($query) {
                    $query->where('donation_quantity', '>', 0)->with('product');
                }
            ])
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.donations.manage', compact('orders'));
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

    public function users(Request $request)
    {
        $search = $request->query('search');

        $users = User::query()
            ->where('role',2)
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.users.manage', compact('users'));
    }

    public function vendors(Request $request)
    {
        $search = $request->query('search');

        $vendors = User::query()
            ->where('role',1)
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('vendorProfile', function ($q) use ($search) {
                        $q->where('address', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.vendors.manage',compact('vendors'));
    }


}
