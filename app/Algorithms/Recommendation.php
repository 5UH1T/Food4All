<?php

namespace App\Algorithms;

class Recommendation
{
    public function calculateScore($product): float
    {
        $salesScore = min(
            ($product->order_items_sum_quantity ?? 0) * 2,
            100
        );

        $discountScore = 0;

        if (
            $product->initial_price > 0 &&
            $product->initial_price > $product->price
        ) {
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

        return ($salesScore * 0.40)
            + ($discountScore * 0.30)
            + ($priceScore * 0.20)
            + ($stockScore * 0.10);
    }
}
