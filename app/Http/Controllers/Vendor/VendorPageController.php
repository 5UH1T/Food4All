<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Order;

class VendorPageController extends Controller
{

    public function categories(Request $request)
    {
        $search = $request->query('search');
        $categories = Category::select('id','category_name')->where('status', 'published')->get();
        $subCategories = SubCategory::where('vendor_id', Auth::id())
            ->with('categories')
            ->when($search, function ($query) use ($search) {
                $query->where('sub_category_name', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('vendor.categories.manage', compact('categories', 'subCategories'));
    }


    public function orders(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $vendorId = Auth::id();

        $orders = Order::whereHas('items.product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('id', 'LIKE', "%{$search}%");
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->with([
                'user',
                'items' => function ($query) use ($vendorId) {
                    $query->whereHas('product', function ($q) use ($vendorId) {
                        $q->where('vendor_id', $vendorId);
                    })->with('product');
                }
            ])
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('vendor.orders.manage', compact('orders'));
    }

    public function updateItemStatus(Request $request, Order $order)
    {
        $vendorId = Auth::id();

        $items = OrderItem::where('order_id', $order->id)
            ->whereHas('product', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->get();

        foreach ($items as $item) {
            $item->update([
                'item_status' => 'prepared',
            ]);
        }

        $allPrepared = OrderItem::where('order_id', $order->id)
        ->where('item_status', '!=', 'prepared')
        ->doesntExist();

        if ($allPrepared) {
            $order->update([
                'status' => 'ready',
            ]);

            OrderItem::where('order_id', $order->id)
            ->update([
                'item_status' => 'ready',
            ]);
        }

        return back()->with('success', 'Order marked as Prepared.');
    }

    public function createProducts()
    {
        $categories = Category::select('id','category_name')->where('status', 'published')->select('id', 'category_name')->get();

        $subCategories = SubCategory::select('id','sub_category_name')->where('vendor_id', Auth::id())->where('status', 'published')->select('id', 'category_id', 'sub_category_name')->get();

        return view('vendor.products.manage' , compact('categories','subCategories'));
    }

    public function products(Request $request)
    {
        $search = $request->query('search');

        $products = Product::where('vendor_id', Auth::id())
            ->with(['mainImage','categories', 'subCategories'])
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('vendor.products.view', compact('products'));
    }

    public function editProduct(Product $product)
    {
        abort_if($product->vendor_id != Auth::id(), 403);

        $categories = Category::where('status', 'published')
            ->select('id', 'category_name')
            ->get();

        $subCategories = SubCategory::where('status', 'published')
            ->select('id', 'category_id', 'sub_category_name')
            ->get();

        $product->load('productImage');

        return view('vendor.products.edit', compact(
            'product',
            'categories',
            'subCategories'
        ));
    }

    public function updateProduct(Request $request, Product $product)
    {
        abort_if($product->vendor_id != Auth::id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'description' => 'nullable|string',
            'images' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $product->productImage()->where('product_id', $product->id)->delete();

        $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'stock' => $request->stock,
            'initial_price' => $request->initial_price,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // 2. Safely convert images string → array
        $images = collect(explode(',', $validated['images']))
            ->map(fn ($img) => parse_url(trim($img), PHP_URL_PATH))
            ->filter()
            ->values();

        // 3. Save images
        foreach ($images as $index => $image) {
            $product->productImage()->create([
                'image_path' => $image,
                'is_main' => $index === 0,
                'position' => $index,
            ]);
        }


        return redirect()
            ->route('vendor.products')
            ->with('success', 'Product updated successfully.');
    }
    
    public function deleteProduct(Product $product)
    {
        abort_if($product->vendor_id != Auth::id(), 403);

        $product->productImage()->delete();

        $product->delete();

        return redirect()
            ->back()
            ->with('success', 'Product deleted successfully.');
    }

    public function donations(Request $request)
    {
        $search = $request->search;
        $filterDate = $request->filterDate;
        $vendorId = Auth::id();

        $query = Order::where('status', '!=', 'cancelled')
            ->whereHas('items', function ($query) use ($vendorId) {
            $query->where('donation_quantity', '>', 0)
                ->whereHas('product', function ($q) use ($vendorId) {
                    $q->where('vendor_id', $vendorId);
                });
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
                'items' => function ($query) use ($vendorId) {
                    $query->where('donation_quantity', '>', 0)
                        ->whereHas('product', function ($q) use ($vendorId) {
                            $q->where('vendor_id', $vendorId);
                        })
                        ->with('product');
                }
            ])
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        return view('vendor.donations.manage', compact('orders'));
    }
}
