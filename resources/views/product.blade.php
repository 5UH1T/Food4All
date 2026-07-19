<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Food For All</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body,
        *:not(i) {
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
                        <img src="{{ asset($product->productImage->first()->image_path) }}" class="img-fluid rounded-4"
                            alt="Margherita Pizza">
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">

                    <span class="badge fp-category-badge mb-3">
                        {{ $product->categories->category_name }}
                    </span>

                    <h1 class="fw-bold mb-3">
                        {{ $product->title }}
                    </h1>


                    <!-- Price -->
                    <div class="mb-4">
                        <span class="fp-product-price">Rs {{ $product->price }}</span>

                        <del class="text-muted ms-3">
                            Rs {{ $product->initial_price }}
                        </del>
                    </div>

                    <!-- Store -->
                    <div class="mb-4">
                        <strong class="fs-5 text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $product->vendor->name }},
                            {{ $product->vendor->vendorProfile->address }}</strong>
                    </div>

                    <!-- Description -->
                    <p class="text-muted mb-4">
                        {!! $product->description !!}
                    </p>

                    <!-- Category -->
                    <div class="mb-3">
                        <strong>Category :</strong>
                        {{ $product->subCategories->sub_category_name }}
                    </div>

                    <div class="mb-4">
                        <strong>Availability :</strong>

                        <span class="text-success fw-semibold">
                            {{ $product->stock }} left
                        </span>
                    </div>

                    <!-- Quantity -->
                    <div class="d-flex align-items-center gap-3 mb-4">

                        <label class="fw-semibold">
                            Quantity
                        </label>

                        <div class="quantity-box d-flex align-items-center">
                            <button class="quantity-btn" type="button" id="decreaseQty">
                                <i class="bi bi-dash"></i>
                            </button>

                            <input type="number" id="quantity" class="quantity-input" value="1" min="1"
                                max="{{ $product->stock }}">

                            <button class="quantity-btn" type="button" id="increaseQty">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex flex-wrap gap-3 mb-5">

                        <button class="fp-btn-accent" onclick="addProductToCart({{ $product->id }})">
                            Add to Cart
                        </button>

                        <button class="btn btn-dark rounded-pill px-4" onclick="buyNow({{ $product->id }})">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const quantityInput = document.getElementById('quantity');
            const increaseBtn = document.getElementById('increaseQty');
            const decreaseBtn = document.getElementById('decreaseQty');

            const maxStock = parseInt(quantityInput.getAttribute('max'));

            increaseBtn.addEventListener('click', function() {

                let currentValue = parseInt(quantityInput.value);

                if (currentValue < maxStock) {
                    quantityInput.value = currentValue + 1;
                }

            });


            decreaseBtn.addEventListener('click', function() {

                let currentValue = parseInt(quantityInput.value);

                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }

            });


            // Prevent manual input exceeding stock
            quantityInput.addEventListener('input', function() {

                let value = parseInt(this.value);

                if (value > maxStock) {
                    this.value = maxStock;
                }

                if (value < 1 || isNaN(value)) {
                    this.value = 1;
                }

            });
        });

        function addProductToCart(productId) {

            let quantity = document.getElementById('quantity').value;

            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(async response => {

                    if (response.status === 401) {
                        window.location.href = '/login';
                        return;
                    }

                    const data = await response.json();

                    if (response.ok) {
                        window.notyf.success(data.message);

                        document.getElementById('cartCountBadge').innerText = data.cartCount;
                    } else {
                        window.notyf.error(data.message);
                    }

                });

        }

        function buyNow(productId) {

            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1
                    })
                })
                .then(async response => {

                    const data = await response.json();

                    if (response.ok) {
                        window.location.href = '/cart';
                    } else {
                        window.notyf.error(data.message);
                    }

                });

        }
    </script>
</body>

</html>
