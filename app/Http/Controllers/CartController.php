<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Please login first'
            ], 401);
        }

        $user = auth()->user();

        $cart = $user->cart()->firstOrCreate([]);

        $product = Product::findOrFail($request->product_id);

        $quantity = (int) ($request->quantity ?? 1);

        // Check requested quantity against stock
        if ($quantity > $product->stock) {
            return response()->json([
                'message' => 'Not enough stock available'
            ], 422);
        }


        $cartItem = $cart->items()
            ->where('product_id', $product->id)
            ->first();


        if ($cartItem) {

            $newQuantity = $cartItem->quantity + $quantity;

            // Check total cart quantity against stock
            if ($newQuantity > $product->stock) {
                return response()->json([
                    'message' => 'Cannot add more items. Stock limit reached.'
                ], 422);
            }


            $cartItem->update([
                'quantity' => $newQuantity,
                'total_price' => $newQuantity * $product->price
            ]);

        } else {

            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'donation_quantity' => 0,
                'total_price' => $quantity * $product->price
            ]);
        }


        return response()->json([
            'message' => 'Added to Cart Successfully!',
            'cartCount' => $cart->items()->sum('quantity')
        ]);
    }

    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $cart = auth()->user()
            ->cart()
            ->with('items.product')
            ->first();

        return view('cart', compact('cart'));
    }

    public function update(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }


        $request->validate([
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:cart_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.donation_quantity' => 'nullable|integer|min:0',
        ]);


        $cart = auth()->user()->cart()->first();


        if (!$cart) {
            return back()->with('error', 'Cart not found');
        }


        foreach ($request->items as $itemData) {

            $cartItem = $cart->items()
                ->with('product')
                ->where('id', $itemData['item_id'])
                ->first();


            if (!$cartItem) {
                continue;
            }


            $product = $cartItem->product;

            $quantity = (int) $itemData['quantity'];
            $donationQuantity = (int) ($itemData['donation_quantity'] ?? 0);



            // Stock check
            if ($quantity > $product->stock) {
                return back()->with(
                    'error',
                    "Not enough stock for {$product->title}"
                );
            }



            // Donation cannot exceed quantity
            if ($donationQuantity > $quantity) {
                return back()->with(
                    'error',
                    "Donation quantity cannot exceed purchased quantity"
                );
            }



            $cartItem->update([
                'quantity' => $quantity,
                'donation_quantity' => $donationQuantity,
                'total_price' => $quantity * $product->price
            ]);

        }


        return redirect()
            ->route('cart')
            ->with('success', 'Cart updated successfully');
    }
}