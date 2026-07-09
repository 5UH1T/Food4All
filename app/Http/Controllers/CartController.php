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
}