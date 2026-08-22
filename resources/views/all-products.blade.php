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
    <section class="py-8 bg-white min-h-screen">
        <div class="container-fluid px-3 px-lg-5">

            <!-- Mobile Filter -->
            <button class="lg:hidden w-full py-3 mb-5 rounded-xl
                   text-white font-semibold"
                style="background:var(--fp-primary)" data-bs-toggle="offcanvas" data-bs-target="#mobileFilters">
                <i class="bi bi-sliders me-1"></i>
                Filters
            </button>

            <div class="row g-4">
                <!-- Filters -->
                <aside class="col-lg-3 d-none d-lg-block">
                    <div class="sticky-top" style="top:90px">

                        <div class="bg-white rounded-4 border border-gray-100 shadow-sm p-4">

                            <div class="flex items-center justify-between mb-5">
                                <h5 class="font-bold mb-0">Filters</h5>

                                <button class="text-xs text-gray-400">
                                    Clear
                                </button>
                            </div>


                            <!-- Search -->
                            <div class="mb-5">
                                <label class="text-sm font-bold text-gray-700 mb-2 block">
                                    Search
                                </label>

                                <div class="relative">
                                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2  text-gray-400"></i>

                                    <input type="search" placeholder="Search food..."
                                        class="form-control ps-5 rounded-xl">
                                </div>
                            </div>


                            <!-- Category -->
                            <div class="mb-5">
                                <label class="text-sm font-bold text-gray-700 mb-3 block">
                                    Category
                                </label>

                                <div class="space-y-2">

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" class="form-check-input !m-0">
                                        <span class="text-sm text-gray-600">
                                            Main Course
                                        </span>
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" class="form-check-input !m-0">
                                        <span class="text-sm text-gray-600">
                                            Fast Food
                                        </span>
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" class="form-check-input !m-0">
                                        <span class="text-sm text-gray-600">
                                            Snacks
                                        </span>
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" class="form-check-input !m-0">
                                        <span class="text-sm text-gray-600">
                                            Desserts
                                        </span>
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" class="form-check-input !m-0">
                                        <span class="text-sm text-gray-600">
                                            Beverages
                                        </span>
                                    </label>

                                </div>
                            </div>


                            <!-- Price -->
                            <div class="mb-5">
                                <label
                                    class="text-sm font-bold
                                          text-gray-700 mb-3 block">
                                    Price Range
                                </label>

                                <div class="grid grid-cols-2 gap-2">
                                    <input type="number" placeholder="Min" class="form-control rounded-xl">

                                    <input type="number" placeholder="Max" class="form-control rounded-xl">
                                </div>
                            </div>

                            <button class="fp-btn-accent border-0 w-full">
                                Apply Filters
                            </button>

                        </div>
                    </div>
                </aside>


                <!-- Products -->
                <main class="col-lg-9">
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10    ">

                        <div class="flex flex-col items-center justify-center">

                            <h2 class="text-xl font-bold
                                   text-gray-800 mb-1">
                                All Products
                            </h2>

                            <p class="text-sm text-gray-500 mb-0">
                                {{ $count }} items available
                            </p>
                        </div>

                        <select class="form-select rounded-full text-sm w-auto">
                            <option>Most Popular</option>
                            <option>Newest</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                        </select>
                    </div>


                    <div class="row g-3">
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-lg-4 col-xxl-3">
                                <div class="fp-dish-card p-0">
                                    <div class="fp-dish-img-wrapper w-100 bg-gray-100 flex items-center justify-center">
                                        @if ($product->productImage->first()->image_path !== null)
                                            <img src="{{ asset($product->productImage->first()->image_path) }}"
                                                alt="{{ $product->title }}">
                                        @else
                                            <div
                                                class="w-20 h-20 rounded-xl  bg-gray-200 flex items-center justify-center text-gray-400">
                                                <i class="bi bi-image text-3xl"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="p-3">
                                        <a href="/{{ $product->id }}" class="no-underline">
                                            <h5 class="font-bold text-gray-800 mb-1 ">
                                                {{ $product->title ?? '' }}
                                            </h5>
                                        </a>

                                        <span @class([
                                            'text-xs py-1 px-2 rounded',
                                            'text-green-600 bg-green-100' =>
                                                $product->categories->category_name === 'Vegetarian',
                                            ' text-orange-600 bg-orange-100' =>
                                                $product->categories->category_name !== 'Vegetarian',
                                        ])>
                                            {{ $product->categories->category_name }}
                                        </span>

                                        <div class="flex items-center justify-between mt-2">
                                            <span class="fp-dish-price">
                                                Rs {{ $product->initial_price }}
                                                @if ($product->initial_price)
                                                    <span class="fp-dish-price-cut">Rs
                                                        {{ $product->initial_price }}</span>
                                                @endif
                                            </span>

                                            <button class="btn btn-dark  rounded-circle !w-10 !h-10 !p-0"
                                                onclick="addToCart({{ $product->id }})">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </main>

            </div>
        </div>
    </section>


    <!-- =============================================================
     MOBILE FILTER
============================================================= -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilters">

        <div class="offcanvas-header border-bottom">
            <h5 class="font-bold mb-0">
                Filters
            </h5>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas">
            </button>
        </div>

        <div class="offcanvas-body">

            <!-- Search -->
            <div class="mb-5">
                <label class="text-sm font-bold
                          text-gray-700 mb-2 block">
                    Search
                </label>

                <div class="relative">
                    <i
                        class="bi bi-search absolute left-3
                          top-1/2 -translate-y-1/2
                          text-gray-400"></i>

                    <input type="search" placeholder="Search food..." class="form-control ps-5 rounded-xl">
                </div>
            </div>


            <!-- Category -->
            <div class="mb-5">
                <label class="text-sm font-bold
                          text-gray-700 mb-3 block">
                    Category
                </label>

                <div class="space-y-2">

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-check-input !m-0">
                        <span class="text-sm">Main Course</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-check-input !m-0">
                        <span class="text-sm">Fast Food</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-check-input !m-0">
                        <span class="text-sm">Snacks</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-check-input !m-0">
                        <span class="text-sm">Desserts</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="form-check-input !m-0">
                        <span class="text-sm">Beverages</span>
                    </label>

                </div>
            </div>


            <!-- Price -->
            <div class="mb-5">
                <label class="text-sm font-bold
                          text-gray-700 mb-3 block">
                    Price Range
                </label>

                <div class="grid grid-cols-2 gap-2">
                    <input type="number" placeholder="Min" class="form-control rounded-xl">

                    <input type="number" placeholder="Max" class="form-control rounded-xl">
                </div>
            </div>


            <button class="fp-btn-accent border-0 w-full" data-bs-dismiss="offcanvas">
                Apply Filters
            </button>
        </div>
    </div>

    <script>
        function addToCart(productId) {
            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId
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
    </script>
