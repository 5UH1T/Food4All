<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Please login first'
            ], 401);
        }

        $user = Auth::user();

        $cart = $user->cart()->firstOrCreate([]);
        $this->clearExpiredCart();
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
            $cart->touch();
        }


        return response()->json([
            'message' => 'Added to Cart Successfully!',
            'cartCount' => $cart->items()->sum('quantity')
        ]);
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $this->clearExpiredCart();
        $cart = Auth::user()
            ->cart()
            ->with('items.product')
            ->first();

        return view('cart', compact('cart'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }


        $request->validate([
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:cart_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.donation_quantity' => 'nullable|integer|min:0',
        ]);


        $cart = Auth::user()->cart()->first();


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

            $cart->touch();

        }


        return redirect()
            ->route('cart')
            ->with('success', 'Cart updated successfully');
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $cart = Auth::user()->cart()->first();

        if (!$cart) {
            return back()->with('error', 'Cart not found');
        }

        $cartItem = $cart->items()->where('id', $id)->first();

        if (!$cartItem) {
            return back()->with('error', 'Cart item not found');
        }

        $cartItem->delete();
        
        $cart->touch();

        return redirect()
            ->route('cart')
            ->with('success', 'Item removed from cart successfully.');
    }

    private function clearExpiredCart()
    {
        $cart = Auth::user()->cart()->first();

        if (!$cart) {
            return;
        }

        if ($cart->updated_at->lt(now()->subMinutes(10))) {
            $cart->items()->delete();
            $cart->touch();
        }
    }

}