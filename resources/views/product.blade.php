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
    <!-- Product Details Section -->
    <section class="fp-product-section py-5">
        <div class="container">

            <div class="row g-5 align-items-center">

                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="fp-product-image">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=900"
                            class="img-fluid rounded-4" alt="Margherita Pizza">
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">

                    <span class="badge fp-category-badge mb-3">
                        Italian Cuisine
                    </span>

                    <h1 class="fw-bold mb-3">
                        Classic Margherita Pizza
                    </h1>


                    <!-- Price -->
                    <div class="mb-4">
                        <span class="fp-product-price">Rs 399</span>

                        <del class="text-muted ms-3">
                            Rs 499
                        </del>
                    </div>

                    <!-- Description -->
                    <p class="text-muted mb-4">
                        Freshly baked stone-oven pizza topped with premium mozzarella,
                        hand-picked basil leaves, rich tomato sauce, and extra virgin olive oil.
                        Prepared fresh every order for the perfect Italian taste.
                    </p>

                    <!-- Category -->
                    <div class="mb-3">
                        <strong>Category :</strong>
                        Pizza
                    </div>

                    <div class="mb-4">
                        <strong>Availability :</strong>

                        <span class="text-success fw-semibold">
                            In Stock
                        </span>
                    </div>

                    <!-- Quantity -->
                    <div class="d-flex align-items-center gap-3 mb-4">

                        <label class="fw-semibold">
                            Quantity
                        </label>

                        <input type="number" class="form-control" value="1" min="1" style="width:90px;">

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex flex-wrap gap-3 mb-5">

                        <button class="fp-btn-accent">
                            Add to Cart
                        </button>

                        <button class="btn btn-dark rounded-pill px-4">
                            Buy Now
                        </button>

                    </div>

                    <!-- Extra Info -->
                    <div class="row g-3">


                    </div>

                </div>

            </div>

        </div>
    </section>
</body>

</html>
