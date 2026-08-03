<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EsewaController;

class CheckoutController extends Controller
{
    public function store()
    {   
        if(Auth::user()->role !== 2) {
            return back()->with('error', 'Order can only be placed by Users');
        }
        $cart = Auth::user()
            ->cart()
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        $order = DB::transaction(function () use ($cart) {

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_cost' => $cart->items->sum('total_price'),
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            foreach ($cart->items as $item) {

                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'total_price' => $item->total_price,

                    // snapshot the unit price
                    'price' => $item->product->price,

                    // if you keep donation data
                    'donation_quantity' => $item->donation_quantity ?? 0,
                ]);
            }

            return $order;
        });


        return redirect()->route('esewa.pay', $order);
    }
}