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
    </style>
</head>

<body>
    @include('components.guest.navbar')
    <section class="fp-checkout-section py-5">
        <div class="container">

            <div class="row g-5">

                <!-- Cart -->
                <div class="col-lg-8">

                    <h3 class="fw-bold mb-4">
                        Shopping Cart
                    </h3>

                    <!-- Product -->
                    <div class="fp-cart-card mb-4">

                        <div class="row align-items-center">

                            <div class="col-md-3">
                                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600"
                                    class="img-fluid rounded-4">
                            </div>

                            <div class="col-md-9">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h5 class="fw-bold mb-1">
                                            Margherita Pizza
                                        </h5>

                                        <small class="text-muted">
                                            Italian Cuisine
                                        </small>

                                    </div>

                                    <h5 class="fp-product-price">
                                        Rs 18.99
                                    </h5>

                                </div>

                                <p class="text-muted mt-3">
                                    Fresh mozzarella, basil, tomato sauce.
                                </p>

                                <!-- Quantity -->
                                <div class="d-flex align-items-center gap-3 mb-3">

                                    <label class="fw-semibold">
                                        Quantity
                                    </label>

                                    <input type="number" class="form-control fp-product-qty" value="2"
                                        min="1" style="width:90px;">

                                </div>

                                <!-- Donation -->
                                <div class="fp-donation-box">

                                    <div class="form-check">

                                        <input class="form-check-input fp-donation-toggle" type="checkbox">

                                        <label class="form-check-label fw-semibold">
                                            Donate part of this order
                                        </label>

                                    </div>

                                    <small class="text-muted d-block mb-3">
                                        The restaurant will donate these meals to people in need.
                                    </small>

                                    <div class="fp-donation-qty d-none">

                                        <label class="fw-semibold mb-2">
                                            Donation Quantity
                                        </label>

                                        <input type="number" class="form-control" value="1" min="1"
                                            style="width:120px;">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Another Product -->

                    <div class="fp-cart-card">

                        <div class="row align-items-center">

                            <div class="col-md-3">
                                <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?w=600"
                                    class="img-fluid rounded-4">
                            </div>

                            <div class="col-md-9">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h5 class="fw-bold">
                                            Cheese Burger
                                        </h5>

                                        <small class="text-muted">
                                            Fast Food
                                        </small>

                                    </div>

                                    <h5 class="fp-product-price">
                                        Rs 14.50
                                    </h5>

                                </div>

                                <p class="text-muted mt-3">
                                    Premium beef patty with cheddar cheese.
                                </p>

                                <div class="d-flex align-items-center gap-3 mb-3">

                                    <label>
                                        Quantity
                                    </label>

                                    <input type="number" class="form-control fp-product-qty" value="1"
                                        min="1" style="width:90px;">

                                </div>

                                <div class="fp-donation-box">

                                    <div class="form-check">

                                        <input class="form-check-input fp-donation-toggle" type="checkbox">

                                        <label class="form-check-label">
                                            Donate part of this order
                                        </label>

                                    </div>

                                    <div class="fp-donation-qty d-none mt-3">

                                        <input type="number" class="form-control" value="1" style="width:120px;">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Summary -->

                <div class="col-lg-4">

                    <div class="fp-summary-card sticky-top">

                        <h4 class="fw-bold mb-4">
                            Order Summary
                        </h4>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <strong>Rs 52.48</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Delivery</span>
                            <strong>Rs 4.99</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax</span>
                            <strong>Rs 3.20</strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">

                            <h5>Total</h5>

                            <h4 class="fp-product-price">
                                Rs 60.67
                            </h4>

                        </div>

                        <button class="fp-btn-accent w-100">
                            Place Order
                        </button>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <script>
        document.querySelectorAll(".fp-cart-card").forEach(card => {

            const toggle = card.querySelector(".fp-donation-toggle");
            const donateQty = card.querySelector(".fp-donation-qty");
            const productQty = card.querySelector(".fp-product-qty");

            toggle.addEventListener("change", function() {

                if (this.checked) {

                    donateQty.classList.remove("d-none");
                    productQty.disabled = true;

                } else {

                    donateQty.classList.add("d-none");
                    productQty.disabled = false;

                }

            });

        });
    </script>
