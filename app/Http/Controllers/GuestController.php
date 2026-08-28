<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Algorithms\Trie;
use App\Algorithms\Recommendation;
use App\Models\Category;

class GuestController extends Controller
{
    public function getHomeItems()
    {
        $recommendation = new Recommendation();
        $userCount = User::where('role', 2)->count();
        $vendorCount = User::where('role', 1)->count();

        $latestProducts = Product::with('productImage')
            ->where('status', 'published')
            ->latest('updated_at')
            ->take(10)
            ->get();


        $recommendedProducts = Product::with([
            'mainImage',
            'categories',
            'subCategories',
        ])
            ->withSum('orderItems', 'quantity')
            ->where('status', 'published')
            ->where('stock', '>', 0)
            ->get()
            ->map(function ($product) use ($recommendation) {

                $product->recommendation_score =
                    $recommendation->calculateScore($product);

                return $product;

            })
            ->sortByDesc('recommendation_score')
            ->take(10)
            ->values();


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

        return view('home', compact('latestProducts', 'recommendedProducts', 'vendors', 'valueProducts', 'userCount', 'vendorCount'));
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

    public function getProducts(Request $request)
    {
        $search = $request->input('search');
        $categories = $request->input('categories', []);
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $sort = $request->input('sort', 'latest');

        // Make sure categories is always an array
        if (!is_array($categories)) {
            $categories = [$categories];
        }

        // Only allow known sorting options
        $allowedSorts = [
            'latest',
            'price_low',
            'price_high',
            'name_asc',
            'name_desc',
        ];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'latest';
        }

        $query = Product::query()
            ->with([
                'productImage',
                'categories',
            ])
            ->where('status', 'published');

        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        if ($minPrice !== null && $minPrice !== '') {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null && $maxPrice !== '') {
            $query->where('price', '<=', $maxPrice);
        }

        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('price', 'desc');
                break;

            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;

            case 'name_desc':
                $query->orderBy('title', 'desc');
                break;

            case 'latest':
            default:
                $query->orderByDesc('updated_at');
                break;
        }

        $products = $query
            ->paginate(16)
            ->withQueryString();

        $categoryList = Category::where('status', 'published')
            ->orderBy('category_name')
            ->get(['id', 'category_name']);

        $count = $products->total();

        return view('all-products', compact(
            'products',
            'count',
            'categoryList',
            'search',
            'categories',
            'minPrice',
            'maxPrice',
            'sort'
        ));
    }
}
