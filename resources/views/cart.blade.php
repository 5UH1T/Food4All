<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food For All</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body,
        * {
            font-family: 'Poppins', sans-serif !important;

        }

        body {
            overflow: visible !important;
        }
    </style>
</head>

<body>
    @include('components.guest.navbar')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                window.notyf.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                window.notyf.error("{{ session('error') }}");
            @endif
        });
    </script>
    @if ($cart && $cart->items->count())
        <section class="fp-checkout-section py-5">
            <div class="container">

                <div class="row g-5">

                    <!-- Cart -->
                    <div class="col-lg-8">
                        <form id="cartUpdateForm" action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="flex justify-between mb-4">
                                <h3 class="fw-bold mb-4">
                                    Shopping Cart
                                </h3>
                                <button type="submit" form="cartUpdateForm" class="fp-btn-accent py-2">
                                    Update Cart
                                </button>
                            </div>


                            <!-- Product -->
                            @foreach ($cart->items as $item)
                                <input type="hidden" name="items[{{ $item->id }}][item_id]"
                                    value="{{ $item->id }}">
                                <div class="fp-cart-card mb-4">

                                    <div class="row align-items-center">

                                        <div class="col-md-3">
                                            <img src="{{ asset($item->product->productImage->first()->image_path) }}"
                                                class="w-32 h-32 rounded-4">
                                        </div>

                                        <div class="col-md-9">

                                            <div class="d-flex justify-content-between">

                                                <div>

                                                    <h5 class="fw-bold mb-1">
                                                        {{ $item->product->title }}
                                                    </h5>

                                                    <small class="text-success">
                                                        {{ $item->product->categories->category_name }}
                                                    </small>

                                                </div>

                                                <h5 class="fp-product-price">
                                                    Rs {{ $item->total_price }}
                                                </h5>

                                            </div>

                                            <p class="text-muted mt-3">
                                                {{ Str::limit(strip_tags($item->product->description), 100) }}
                                            </p>

                                            <!-- Quantity -->
                                            <div class="d-flex align-items-center gap-3 mb-4">

                                                <label class="fw-semibold">
                                                    Quantity
                                                </label>

                                                <div class="quantity-box d-flex align-items-center">
                                                    <button class="quantity-btn decreaseQty" type="button">
                                                        <i class="bi bi-dash"></i>
                                                    </button>

                                                    <input type="number" class="quantity-input fp-product-qty"
                                                        value="{{ $item->quantity }}" min="1" readonly
                                                        name="items[{{ $item->id }}][quantity]"
                                                        max="{{ $item->product->stock }}">

                                                    <button class="quantity-btn increaseQty" type="button">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>

                                                <div class="text-danger small quantity-error"></div>

                                            </div>

                                            <!-- Donation -->
                                            <div class="fp-donation-box">

                                                <div class="form-check">

                                                    <input class="form-check-input fp-donation-toggle" type="checkbox"
                                                        name="items[{{ $item->id }}][donate]" value="1"
                                                        max="{{ $item->quantity }}"
                                                        {{ $item->donation_quantity > 0 ? 'checked' : '' }}>

                                                    <label class="form-check-label fw-semibold">
                                                        Donate part of this order
                                                    </label>

                                                </div>

                                                <small class="text-muted d-block mb-3">
                                                    The restaurant will donate these meals to people in need.
                                                </small>

                                                <div
                                                    class="fp-donation-qty {{ $item->donation_quantity > 0 ? '' : 'd-none' }}">

                                                    <label class="fw-semibold mb-2">
                                                        Donation Quantity
                                                    </label>

                                                    <div class="quantity-box d-flex align-items-center">
                                                        <button class="quantity-btn decreaseQty" type="button">
                                                            <i class="bi bi-dash"></i>
                                                        </button>

                                                        <input type="number" class="quantity-input donation-input"
                                                            value="{{ $item->donation_quantity ?? 0 }}" min="0"
                                                            readonly
                                                            name="items[{{ $item->id }}][donation_quantity]"
                                                            max="{{ $item->quantity }}">

                                                        <button class="quantity-btn increaseQty" type="button">
                                                            <i class="bi bi-plus"></i>
                                                        </button>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="w-full flex justify-end mt-4">
                                        <button type="button" class="btn btn-danger btn-sm delete-btn"
                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                </div>
                            @endforeach
                        </form>
                    </div>

                    <!-- Summary -->

                    <div class="col-lg-4">

                        <div class="fp-summary-card sticky-top" style="z-index: 99 !important; top: 120px !important">

                            <h4 class="fw-bold mb-4">
                                Order Summary
                            </h4>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Subtotal</span>
                                <strong>Rs {{ number_format($cart->items->sum('total_price'), 2) }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Quantity</span>
                                <strong>{{ $cart->items->sum('quantity') }}</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Tax</span>
                                <strong>Rs 0.0</strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">

                                <h5>Total</h5>

                                <h4 class="fp-product-price">
                                    Rs {{ number_format($cart->items->sum('total_price'), 2) }}
                                </h4>

                            </div>

                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf

                                <button type="submit" class="fp-btn-accent w-100">
                                    Proceed to Checkout
                                </button>
                            </form>

                        </div>

                    </div>

                </div>
            @else
                <div class="h-[80vh] w-screen flex flex-col items-center justify-center">
                    <h3 class="fs-1 fw-bold">Your cart is empty</h3>
                    <a href="/" class="text-success text-xl">Go Home</a>
                </div>
    @endif
    </div>
    </section>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Remove Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to remove this item from your cart?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Remove
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll(".fp-cart-card").forEach(card => {

            const toggle = card.querySelector(".fp-donation-toggle");
            const donateQty = card.querySelector(".fp-donation-qty");
            const productQty = card.querySelector(".fp-product-qty");

            toggle.addEventListener("change", function() {

                const donationInput = card.querySelector('input[name*="[donation_quantity]"]');

                if (this.checked) {

                    donateQty.classList.remove("d-none");

                } else {

                    donateQty.classList.add("d-none");

                    donationInput.value = 0;

                }

            });

        });

        document.querySelectorAll(".fp-cart-card").forEach(card => {

            const toggle = card.querySelector(".fp-donation-toggle");
            const donateQty = card.querySelector(".fp-donation-qty");
            const donationInput = card.querySelector(".donation-input");

            toggle.addEventListener("change", function() {

                if (this.checked) {

                    donateQty.classList.remove("d-none");

                } else {

                    donateQty.classList.add("d-none");

                    donationInput.value = 0;

                }

            });


            // Quantity buttons
            card.querySelectorAll(".quantity-box").forEach(box => {

                const input = box.querySelector(".quantity-input");
                const increase = box.querySelector(".increaseQty");
                const decrease = box.querySelector(".decreaseQty");


                increase.addEventListener("click", function() {

                    let value = parseInt(input.value);
                    let max = parseInt(input.max);

                    if (value < max) {
                        input.value = value + 1;
                    }

                });


                decrease.addEventListener("click", function() {

                    let value = parseInt(input.value);
                    let min = parseInt(input.min);

                    if (value > min) {
                        input.value = value - 1;
                    }

                });


                // Prevent invalid typing
                input.addEventListener("change", function() {

                    let value = parseInt(this.value);
                    let min = parseInt(this.min);
                    let max = parseInt(this.max);

                    if (value < min) this.value = min;
                    if (value > max) this.value = max;

                });

            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let itemId = this.dataset.id;
                    document.getElementById('deleteForm').action = `/cart/${itemId}`;
                });
            });

        });
    </script>
