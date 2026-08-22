<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Algorithms\Trie;

class GuestController extends Controller
{
    public function getHomeItems()
    {
        $userCount = User::where('role', 2)->count();
        $vendorCount = User::where('role', 1)->count();

        $latestProducts = Product::with('productImage')
            ->where('status', 'published')
            ->latest('updated_at')
            ->take(10)
            ->get();


        $endProducts = Product::with('productImage')
            ->where('status', 'published')
            ->oldest('updated_at')
            ->take(10)
            ->get();


        $vendors = User::with('vendorProfile')
            ->where('role', 1)
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get();

        $valueProducts = Product::with('mainImage')
            ->where('status', 'published')
            ->get()
            ->map(function ($product) {

                $discountScore = 0;

                if ($product->initial_price > 0 && $product->initial_price > $product->price) {
                    $discountScore =
                        (($product->initial_price - $product->price)
                        / $product->initial_price) * 100;
                }

                $priceScore = max(
                    100 - ($product->price / 20),
                    0
                );

                $stockScore = min(
                    $product->stock * 5,
                    100
                );

                $freshnessScore = max(
                    100 - (now()->diffInDays($product->updated_at) * 5),
                    0
                );

                // Greedy selection score: prioritize customer savings
                $product->value_score =
                    ($discountScore * 0.70)
                    + ($priceScore * 0.15)
                    + ($stockScore * 0.10)
                    + ($freshnessScore * 0.05);

                return $product;

            })
            ->sortByDesc('value_score')
            ->take(10);

        return view('home', compact('latestProducts', 'endProducts', 'vendors', 'valueProducts', 'userCount', 'vendorCount'));
    }

    public function productDetails($id)
    {
        $product = Product::with([
            'productImage',
            'vendor'
        ])->findOrFail($id);

        return view('product', compact('product'));
    }

    public function autocomplete(Request $request)
    {
        $query = strtolower($request->search);

        if(strlen($query) < 2){
            return response()->json([]);
        }


        $trie = new Trie();


        Product::where('status','published')
            ->get(['id','title'])
            ->each(function($product) use ($trie){

                $trie->insert(
                    $product->title,
                    $product->id
                );

            });


        return response()->json(
            array_slice(
                $trie->search($query),
                0,
                8
            )
        );
    }

    public function getProducts() {
        $products = Product::with('productImage')
            ->where('status', 'published')
            ->latest('updated_at')
            ->take(16)
            ->get();

        $count = Product::with('productImage')->where('status', 'published')->count();

        return view('all-products',compact('products','count'));
    }
}
