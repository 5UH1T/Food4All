<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
public function add(Request $request)
    {
        // Check login
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Please login first'
            ], 401);
        }


        $user = auth()->user();


        // Get or create cart
        $cart = $user->cart()->firstOrCreate([]);


        // Get product
        $product = Product::findOrFail($request->product_id);


        // Check if product already in cart
        $cartItem = $cart->items()
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity >= $product->stock) {
                return response()->json([
                    'message' => 'Cannot add more items. Stock limit reached.'
                ], 422);
            }

            // Increase quantity
            $cartItem->increment('quantity');

            $cartItem->update([
                'total_price' => $cartItem->quantity * $product->price
            ]);

        } else {

            // Add new product
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'donation_quantity' => 0,
                'total_price' => $product->price
            ]);

        }


        return response()->json([
            'message' => 'Added to Cart Successfully!'
        ]);
    }
}
