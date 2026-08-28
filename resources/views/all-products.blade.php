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
    @include('components.scroll-to-top')

    {{-- Notifications --}}
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

            <div class="row g-4">
                {{-- Filters --}}
                <aside class="col-lg-3 d-none d-lg-block">
                    <div class="sticky-top" style="top:120px">
                        <form method="GET" action="{{ url()->current() }}" id="desktopFilterForm">

                            <div class="bg-white rounded-4 border border-gray-100 shadow-sm p-4">

                                {{-- Filter Header --}}
                                <div class="flex items-center justify-between mb-5">

                                    <h5 class="font-bold mb-0">
                                        Filters
                                    </h5>

                                </div>

                                {{-- Category --}}
                                <div class="mb-5">

                                    <label class="text-sm font-bold text-gray-700 mb-2 block">
                                        Search
                                    </label>

                                    <div class="relative">

                                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        </i>

                                        <input type="search" name="search" value="{{ $search }}"
                                            placeholder="Search food..." class="form-control ps-5 rounded-xl">

                                    </div>

                                </div>

                                {{-- Category --}}
                                <div class="mb-5">

                                    <label class="text-sm font-bold text-gray-700 mb-3 block">
                                        Category
                                    </label>

                                    <div class="space-y-2">
                                        @forelse ($categoryList as $category)
                                            <label class="flex items-center gap-2">

                                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                                    class="form-check-input !m-0"
                                                    {{ in_array($category->id, $categories ?? []) ? 'checked' : '' }}>

                                                <span class="text-sm text-gray-600">
                                                    {{ $category->category_name }}
                                                </span>

                                            </label>

                                        @empty

                                            <p class="text-sm text-gray-400 mb-0">
                                                No categories available.
                                            </p>
                                        @endforelse
                                    </div>

                                </div>

                                {{-- Price Range --}}
                                <div class="mb-5">

                                    <label class="text-sm font-bold text-gray-700 mb-3 block">
                                        Price Range
                                    </label>

                                    <div class="grid grid-cols-2 gap-2">

                                        <input type="number" name="min_price" value="{{ $minPrice }}"
                                            min="0" placeholder="Min" class="form-control rounded-xl">

                                        <input type="number" name="max_price" value="{{ $maxPrice }}"
                                            min="0" placeholder="Max" class="form-control rounded-xl">

                                    </div>

                                </div>


                                {{-- Preserve current sorting --}}
                                <input type="hidden" name="sort" value="{{ $sort }}">


                                {{-- Apply --}}
                                <button type="submit" class="fp-btn-accent border-0 w-full">
                                    Apply Filters
                                </button>

                            </div>

                        </form>

                    </div>

                </aside>


                <main class="col-lg-9">
                    <div class="flex items-center justify-between  mb-10">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 w-[95%]">

                            <div class="flex flex-col items-center justify-center">

                                <h2 class="text-xl font-bold text-gray-800 mb-1">
                                    All Products
                                </h2>

                                <p class="text-sm text-gray-500 mb-0">
                                    {{ $count }} items available
                                </p>

                            </div>

                            <form method="GET" action="{{ url()->current() }}" id="sortForm">

                                {{-- search --}}
                                <input type="hidden" name="search" value="{{ $search }}">

                                {{--  categories --}}
                                @foreach ($categories ?? [] as $categoryId)
                                    <input type="hidden" name="categories[]" value="{{ $categoryId }}">
                                @endforeach

                                {{-- price --}}
                                <input type="hidden" name="min_price" value="{{ $minPrice }}">

                                <input type="hidden" name="max_price" value="{{ $maxPrice }}">


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

                        {{-- Mobile Filter Toggler --}}
                        <button type="button"
                            class="d-flex align-items-center justify-content-center d-lg-none w-[40px] h-[40px] rounded-xl bg-black text-white ms-1"
                            style="background:var(--fp-primary)" data-bs-toggle="offcanvas"
                            data-bs-target="#mobileFilters">
                            <i class="bi bi-sliders me-1"></i>
                        </button>
                    </div>


                    {{-- Filters --}}
                    @if (
                        $search ||
                            !empty($categories) ||
                            ($minPrice !== null && $minPrice !== '') ||
                            ($maxPrice !== null && $maxPrice !== ''))

                        <div class="mb-5 flex flex-wrap items-center gap-2">

                            <span class="text-sm font-semibold text-gray-600">
                                Active filters:
                            </span>


                            {{-- Search --}}
                            @if ($search)
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-sm text-gray-700">

                                    Search:
                                    <strong>{{ $search }}</strong>

                                </span>
                            @endif


                            {{-- Categories --}}
                            @if (!empty($categories))

                                @foreach ($categoryList as $category)
                                    @if (in_array($category->id, $categories))
                                        <span class="px-3 py-1 rounded-full bg-gray-100 text-sm text-gray-700">
                                            {{ $category->category_name }}
                                        </span>
                                    @endif
                                @endforeach

                            @endif


                            {{-- Min price --}}
                            @if ($minPrice !== null && $minPrice !== '')
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-sm text-gray-700">

                                    Min:
                                    <strong>Rs {{ $minPrice }}</strong>

                                </span>
                            @endif


                            {{-- Max price --}}
                            @if ($maxPrice !== null && $maxPrice !== '')
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-sm text-gray-700">

                                    Max:
                                    <strong>Rs {{ $maxPrice }}</strong>

                                </span>
                            @endif


                            {{-- Clear --}}
                            <a href="{{ url()->current() }}" class="text-sm text-red-500 no-underline ms-2">
                                Clear all
                            </a>

                        </div>

                    @endif

                    {{-- Grid --}}
                    <div class="row g-4">

                        @forelse ($products as $product)
                            <div class="col-sm-6 col-lg-4">

                                <div class="fp-dish-card p-0 h-100">

                                    {{-- Image --}}
                                    <div
                                        class="fp-dish-img-wrapper w-100 bg-gray-100 flex items-center justify-center">

                                        @php
                                            $mainImage = $product->productImage->first();
                                        @endphp


                                        @if ($mainImage && $mainImage->image_path)
                                            <img src="{{ asset($mainImage->image_path) }}"
                                                alt="{{ $product->title }}">
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
                                                <button type="button"
                                                    class="btn btn-dark rounded-circle !w-10 !h-10 !p-0"
                                                    onclick="addToCart({{ $product->id }})">

                                                    <i class="bi bi-plus-lg"></i>

                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-dark rounded-circle !w-10 !h-10 !p-0" disabled>

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

                </main>

            </div>

        </div>
    </section>

    {{-- Mobile Filter --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilters">

        <div class="offcanvas-header border-bottom">
            <h5 class="font-bold mb-0">
                Filters
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>


        <div class="offcanvas-body">
            <form method="GET" action="{{ url()->current() }}" id="mobileFilterForm">
                <div class="mb-5">

                    <label class="text-sm font-bold text-gray-700 mb-2 block">
                        Search
                    </label>

                    <div class="relative">
                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="search" name="search" value="{{ $search }}"
                            placeholder="Search food..." class="form-control ps-5 rounded-xl">

                    </div>
                </div>

                <div class="mb-5">

                    <label class="text-sm font-bold text-gray-700 mb-3 block">
                        Category
                    </label>

                    <div class="space-y-2">

                        @forelse ($categoryList as $category)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    class="form-check-input !m-0"
                                    {{ in_array($category->id, $categories ?? []) ? 'checked' : '' }}>

                                <span class="text-sm text-gray-600">
                                    {{ $category->category_name }}
                                </span>

                            </label>

                        @empty

                            <p class="text-sm text-gray-400">
                                No categories available.
                            </p>
                        @endforelse

                    </div>

                </div>

                <div class="mb-5">

                    <label class="text-sm font-bold text-gray-700 mb-3 block">
                        Price Range
                    </label>

                    <div class="grid grid-cols-2 gap-2">

                        <input type="number" name="min_price" value="{{ $minPrice }}" min="0"
                            placeholder="Min" class="form-control rounded-xl">

                        <input type="number" name="max_price" value="{{ $maxPrice }}" min="0"
                            placeholder="Max" class="form-control rounded-xl">

                    </div>

                </div>

                <input type="hidden" name="sort" value="{{ $sort }}">

                <button type="submit" class="fp-btn-accent border-0 w-full" data-bs-dismiss="offcanvas">
                    Apply Filters
                </button>

                <a href="{{ url()->current() }}" class="btn btn-light w-full mt-2 rounded-xl">
                    Clear Filters
                </a>

            </form>

        </div>

    </div>

    {{-- Add to Cart --}}
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
