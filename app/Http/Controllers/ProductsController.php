<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SubCategory;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'initial_price' => 'nullable|numeric|min:0',

        'category_id' => 'required|integer|exists:categories,id',
        'sub_category_id' => 'required|integer|exists:sub_categories,id',

        'description' => 'required|string',

        // IMPORTANT: ensure it's a string
        'images' => 'required|string',

        'status' => 'required|in:published,draft',
    ]);

    // 1. Create product
    $product = Product::create([
        'vendor_id' => Auth::id(),
        'title' => $validated['title'],
        'slug' => Str::slug($validated['title']) . '-' . time(),

        'price' => $validated['price'],
        'stock' => $validated['stock'],
        'initial_price' => $validated['initial_price'] ?? null,

        'category_id' => $validated['category_id'],
        'sub_category_id' => $validated['sub_category_id'],

        'description' => $validated['description'],
        'status' => $validated['status'],
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
        ->with('success', 'Product created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSubCategories($categoryId)
    {
        return SubCategory::select('id,sub_category_name')->where('category_id', $categoryId)
            ->where('status', 'published')
            ->select('id', 'sub_category_name')
            ->get();
    }
}
