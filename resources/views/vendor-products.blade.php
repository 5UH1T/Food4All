<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fresh Harvest Kitchen - Food For All</title>

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
    @include('components.scroll-to-top')


    {{-- =========================================================
        NOTIFICATIONS
    ========================================================== --}}

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

    <section class="h-[420px] bg-gradient-to-r from-gray-900 to-gray-800 text-white">
        <div class="container-fluid h-full px-4">
            <div class="row h-full grid-cols-1 md:grid-cols-2">

                <!-- Left -->
                <div class="flex flex-col justify-center items-center border-r border-white/10 p-6 col-lg-3">

                    <!-- Logo -->
                    <div class="mb-4 h-36 w-36 overflow-hidden rounded-xl border-white border-3">
                        @if ($vendor->vendorProfile->avatar)
                            <img src="{{ asset(Storage::url($vendor->vendorProfile->avatar)) }}"
                                alt="{{ $vendor->name }}" class="h-full w-full object-contain">
                        @else
                            <div class="flex h-full items-center justify-center text-3xl text-gray-400">
                                <i class="fa-solid fa-shop"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Store name -->
                    <h1 class="mb-4 text-3xl font-bold">
                        {{ $vendor->name }}
                    </h1>

                    <!-- Store info -->
                    <div class="flex flex-wrap gap-3 text-sm text-white/70">

                        <div>
                            <i class="bi bi-box-seam mr-1 text-orange-500"></i>
                            {{ $products->count() }} products
                        </div>

                        <a href="tel:+{{ $vendor->vendorProfile->phone }}" target="_blank"
                            class="block truncate text-white/70 no-underline hover:text-white">
                            <i class="bi bi-telephone mr-1 text-orange-500"></i>
                            {{ $vendor->vendorProfile->phone }}
                        </a>

                        <a href="{{ $vendor->vendorProfile->map }}" target="_blank"
                            class="block truncate text-white/70 no-underline hover:text-white">
                            <i class="bi bi-geo-alt mr-1 text-orange-500"></i>
                            {{ $vendor->vendorProfile->address }}
                        </a>

                    </div>
                </div>

                <!-- Right -->
                <div class="flex flex-col justify-center p-6 md:p-10 col-lg-9">

                    <h2 class="mb-4 text-lg font-semibold">
                        About the Store
                    </h2>

                    <div class="h-56 overflow-y-auto pr-4 text-sm leading-6 text-white/70">
                        {!! filled($vendor->vendorProfile->description)
                            ? $vendor->vendorProfile->description
                            : 'No description available' !!}
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="vendor-products-section py-5 py-lg-6">

        <div class="container-fluid px-3 px-lg-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
                <div>

                    <h2 class="vendor-products-heading mb-1">
                        Products
                    </h2>

                    <p class="vendor-products-subtitle mb-0">
                        Explore products from
                        <strong>
                            {{ $vendor->name }}
                        </strong>
                    </p>

                </div>


                <form method="GET" action="{{ url()->current() }}" id="sortForm">

                    <select name="sort" id="sort" class="form-select rounded-full text-sm w-auto"
                        onchange="document.getElementById('sortForm').submit()">

                        <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>
                            Newest
                        </option>

                        <option value="price_low" {{ $sort === 'price_low' ? 'selected' : '' }}>
                            Price: Low to High
                        </option>

                        <option value="price_high" {{ $sort === 'price_high' ? 'selected' : '' }}>
                            Price: High to Low
                        </option>

                        <option value="name_asc" {{ $sort === 'name_asc' ? 'selected' : '' }}>
                            Name: A to Z
                        </option>

                        <option value="name_desc" {{ $sort === 'name_desc' ? 'selected' : '' }}>
                            Name: Z to A
                        </option>

                    </select>

                </form>

            </div>
            {{-- Grid --}}
            <div class="row g-4">

                @forelse ($products as $product)
                    <div class="col-sm-6 col-lg-3">

                        <div class="fp-dish-card p-0 h-100">

                            {{-- Image --}}
                            <div class="fp-dish-img-wrapper w-100 bg-gray-100 flex items-center justify-center">

                                @php
                                    $mainImage = $product->productImage->first();
                                @endphp


                                @if ($mainImage && $mainImage->image_path)
                                    <img src="{{ asset($mainImage->image_path) }}" alt="{{ $product->title }}">
                                @else
                                    <div
                                        class="w-20 h-20 rounded-xl bg-gray-200 flex items-center justify-center text-gray-400">

                                        <i class="bi bi-image text-3xl"></i>

                                    </div>
                                @endif

                            </div>

                            {{-- Product Details --}}
                            <div class="p-3">

                                <a href="/{{ $product->id }}" class="no-underline">

                                    <h5 class="font-bold text-gray-800 mb-1">

                                        {{ $product->title ?? '' }}

                                    </h5>

                                </a>

                                {{-- Categories --}}
                                @if ($product->categories)
                                    <span @class([
                                        'text-xs py-1 px-2 rounded',
                                        'text-green-600 bg-green-100' =>
                                            $product->categories->category_name === 'Vegetarian',
                                        'text-orange-600 bg-orange-100' =>
                                            $product->categories->category_name !== 'Vegetarian',
                                    ])>

                                        {{ $product->categories->category_name }}

                                    </span>
                                @endif

                                {{-- Stock --}}
                                <span @class([
                                    'text-xs py-1 px-2 rounded ml-2',
                                    'text-green-600 bg-green-100' => $product->stock > 0,
                                    'text-red-600 bg-red-100' => $product->stock === 0,
                                ])>

                                    {{ $product->stock }} available
                                </span>


                                <div class="flex items-center justify-between mt-2">

                                    <span class="fp-dish-price">

                                        Rs {{ number_format($product->price, 2) }}


                                        {{-- Original price --}}
                                        @if ($product->initial_price && $product->initial_price > $product->price)
                                            <span class="fp-dish-price-cut">

                                                Rs {{ number_format($product->initial_price, 2) }}

                                            </span>
                                        @endif

                                    </span>


                                    {{-- Add to cart --}}
                                    @if ($product->stock > 0)
                                        <button type="button" class="btn btn-dark rounded-circle !w-10 !h-10 !p-0"
                                            onclick="addToCart({{ $product->id }})">

                                            <i class="bi bi-plus-lg"></i>

                                        </button>
                                    @else
                                        <button type="button" class="btn btn-dark rounded-circle !w-10 !h-10 !p-0"
                                            disabled>

                                            <i class="bi bi-plus-lg"></i>

                                        </button>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- 0 Products --}}
                @empty
                    <div class="col-12">

                        <div class="text-center py-16">

                            <div
                                class="w-20 h-20 rounded-full bg-gray-100 mx-auto mb-4 flex items-center justify-center">
                                <i class="bi bi-search text-3xl text-gray-400"></i>
                            </div>

                            <h4 class="font-bold text-gray-700 mb-2">
                                No products found
                            </h4>

                            <p class="text-sm text-gray-500 mb-5">
                                Try changing your search or filters.
                            </p>

                            <a href="{{ url()->current() }}" class="fp-btn-accent no-underline inline-block">
                                Clear Filters
                            </a>

                        </div>

                    </div>
                @endforelse
            </div>

            @if ($products->hasPages())
                <div class="mt-8">

                    {{ $products->links() }}

                </div>
            @endif

        </div>

    </section>


    {{-- =========================================================
        ADD TO CART
    ========================================================== --}}

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

                        const cartBadge =
                            document.getElementById('cartCountBadge');

                        if (cartBadge) {

                            cartBadge.innerText = data.cartCount;

                        }

                    } else {

                        window.notyf.error(
                            data.message || 'Something went wrong.'
                        );

                    }

                })

                .catch(error => {

                    console.error(error);

                    window.notyf.error(
                        'Unable to add product to cart.'
                    );

                });

        }
    </script>

</body>

</html>
