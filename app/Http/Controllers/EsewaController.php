<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EsewaController extends Controller
{
    public function pay(Order $order)
    {
        $transaction_uuid = uniqid();

        $order->update([
            'transaction_uuid' => $transaction_uuid,
            'payment_method' => 'esewa'
        ]);

        session(['esewa_transaction_uuid' => $transaction_uuid]);

        $secret = env('ESEWA_SECRET');

        $amount = number_format($order->total_cost, 2, '.', '');

        $message = "total_amount={$amount},transaction_uuid={$transaction_uuid},product_code=" . env('ESEWA_PRODUCT_CODE');

        $signature = base64_encode(
            hash_hmac(
                'sha256',
                $message,
                $secret,
                true
            )
        );

        return view('esewa.pay', compact(
            'order',
            'transaction_uuid',
            'signature'
        ));
    }


    public function success(Request $request)
    {
        if (!$request->has('data')) {
            return redirect('/')
                ->with('error', 'Invalid eSewa response.');
        }

        $data = json_decode(
            base64_decode($request->data),
            true
        );

        Log::info('eSewa Callback Data', $data);


        $order = Order::firstWhere(
            'transaction_uuid',
            $data['transaction_uuid']
        );



        if (!$order) {
            abort(404);
        }


        // eSewa verification API uses GET request
        $response = Http::get(
            env('ESEWA_VERIFY_URL'),
            [
                "product_code" => env('ESEWA_PRODUCT_CODE'),
                "total_amount" => number_format($order->total_cost, 2, '.', ''),
                "transaction_uuid" => $data['transaction_uuid'],
            ]
        );


        $verify = $response->json();


        Log::info('eSewa Verification Response', $verify);


        if (($verify['status'] ?? null) === "COMPLETE") {

            $order->update([
                'payment_status' => 'paid',
                'status' => 'confirmed',
                'esewa_ref_id' => $verify['ref_id'] ?? null
            ]);

            foreach ($order->items as $item) {

                $item->product->decrement('stock', $item->quantity);

                $item->update([
                    'item_status' => 'confirmed',
                ]);
            }


            if ($order->user && $order->user->cart) {

                $order->user
                    ->cart
                    ->items()
                    ->delete();

            }


            return redirect('/')
                ->with('success', 'Payment Successful');
        }


        return redirect('/')
            ->with('error', 'Payment Verification Failed');
    }


public function failure(Request $request)
{
    $transaction_uuid = session('esewa_transaction_uuid');

    if (!$transaction_uuid) {
        return redirect('/')
            ->with('error', 'Transaction not found.');
    }

    $order = Order::firstWhere('transaction_uuid', $transaction_uuid);

    if ($order) {
        $order->update([
            'payment_status' => 'failed',
            'status' => 'cancelled',
        ]);

        foreach ($order->items as $item) {
            
            $item->update([
                'item_status' => 'cancelled',
            ]);
        }
    }

    session()->forget('esewa_transaction_uuid');

    return redirect('/')
        ->with('error', 'Payment failed or cancelled.');
}
}