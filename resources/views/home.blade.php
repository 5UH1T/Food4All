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
    {{-- Hero --}}
    <section class="swiper fp-hero-section">
        <div class="swiper-wrapper">
            <div class="swiper-slide fp-hero-slide d-flex align-items-center"
                style="background-image: url('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=1600');">
                <div class="container position-relative text-white text-center">
                    <span class="text-warning text-uppercase fw-bold tracking-wider d-block mb-2">Every Order Saves
                        Food</span>
                    <h1 class="display-3 fw-bold mb-3">Delicious Meals, Less Food Waste</h1>
                    <p class="lead mb-4 text-light">Fresh meals, bakery treats, and groceries at great prices - helping
                        reduce food waste with every order.</p>
                    <a href="/products" class="btn btn-warning rounded-pill px-4 py-2 fw-bold text-dark">Shop & Save
                        Food</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Going Soon Section --}}
    <section class="fp-dishes-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <span class="text-uppercase small text-success fw-bold tracking-wider">Going Soon</span>
                    <h2 class="fw-bold m-0 mt-1">Last Chance Plates</h2>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-prev p-2 lh-1"><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-next p-2 lh-1"><i
                            class="fa-solid fa-chevron-right"></i></i></button>
                </div>
            </div>

            <div class="swiper fp-dishes-slider">
                <div class="swiper-wrapper p-2">
                    @foreach ($endProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Mission Statement --}}
    <section class="fp-kitchen-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-6">
                    <div class="fp-kitchen-img-frame">
                        <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800"
                            alt="Kitchen Crafting Process">
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="text-uppercase fw-bold text-success tracking-widest small">Our Mission</span>
                    <h2 class="display-5 fw-bold mb-3 mt-1">Good Food. Zero Waste.</h2>
                    <p class="text-gray-600 mb-4 lead fs-5">We partner with local stores, bakeries, and restaurants to
                        rescue fresh surplus food. Every purchase helps reduce food waste while making quality food more
                        affordable.</p>
                    <div class="d-flex gap-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-patch-check-fill text-success fs-3"></i>
                            <span class="fw-semibold">Best Value</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shield-fill-check text-success fs-3"></i>
                            <span class="fw-semibold">Zero-waste processes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Value For Money --}}
    <section class="fp-dishes-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <span class="text-uppercase small text-success fw-bold tracking-wider">Bang For Bucks</span>
                    <h2 class="fw-bold m-0 mt-1">Value For Money Items</h2>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle fp-value-prev p-2 lh-1"><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn btn-outline-dark rounded-circle fp-value-next p-2 lh-1"><i
                            class="fa-solid fa-chevron-right"></i></i></button>
                </div>
            </div>

            <div class="swiper fp-value-slider">
                <div class="swiper-wrapper p-2">
                    @foreach ($valueProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section class="py-5 fp-feature-section">
        <div class="container">

            <div class="text-center mb-5">
                <span class="text-uppercase small text-success fw-bold tracking-wider">
                    Simple Process
                </span>
                <h2 class="fw-bold">How Food For All Works</h2>
                <p class="text-muted">
                    Making quality food affordable while reducing unnecessary waste.
                </p>
            </div>


            <div class="row g-4">

                <div class="col-md-4">
                    <div class="fp-feature-card text-center p-4 h-100">

                        <div class="fp-feature-icon mb-4">
                            <i class="bi bi-shop"></i>
                        </div>

                        <h4 class="fw-bold">
                            Local Stores Join
                        </h4>

                        <p class="text-muted">
                            Restaurants, bakeries, and shops list fresh food available at better prices.
                        </p>

                    </div>
                </div>


                <div class="col-md-4">
                    <div class="fp-feature-card text-center p-4 h-100">

                        <div class="fp-feature-icon mb-4">
                            <i class="bi bi-basket"></i>
                        </div>

                        <h4 class="fw-bold">
                            Customers Save
                        </h4>

                        <p class="text-muted">
                            Discover delicious meals and groceries while enjoying special value deals.
                        </p>

                    </div>
                </div>


                <div class="col-md-4">
                    <div class="fp-feature-card text-center p-4 h-100">

                        <div class="fp-feature-icon mb-4">
                            <i class="bi bi-recycle"></i>
                        </div>

                        <h4 class="fw-bold">
                            Reduce Waste
                        </h4>

                        <p class="text-muted">
                            Every purchase helps prevent good food from being wasted.
                        </p>

                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- Explore By Store --}}
    <section class="fp-categories-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-uppercase small text-success fw-bold tracking-wider">Popular</span>
                <h2 class="fw-bold">Explore By Store</h2>
            </div>

            <div class="swiper fp-categories-slider">
                <div class="swiper-wrapper">

                    @foreach ($vendors as $vendor)
                        <div class="swiper-slide">
                            <div class="fp-circle-item">
                                <div class="fp-circle-img-wrapper">
                                    @if ($vendor->vendorProfile->avatar)
                                        <img src="{{ asset(Storage::url($vendor->vendorProfile->avatar)) }}"
                                            alt="{{ $vendor->name }}">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-6xl"><i
                                                class="fa-solid fa-shop"></i></div>
                                    @endif
                                </div>
                                <h6 class="fw-bold mb-0">{{ $vendor->name }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination position-relative mt-5"></div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="fp-impact-section py-5">

        <div class="container">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <span class="text-uppercase small text-warning fw-bold">
                        Our Impact
                    </span>

                    <h2 class="display-5 fw-bold text-white mt-2">
                        Small Actions Create A Bigger Change
                    </h2>

                    <p class="text-light fs-5">
                        By connecting customers with local stores, we create a smarter food system where everyone
                        benefits.
                    </p>

                </div>


                <div class="col-lg-6">

                    <div class="row g-3">

                        <div class="col-6">
                            <div class="fp-stat-card">
                                <i class="bi bi-people-fill"></i>
                                <h2>{{ $userCount }}+</h2>
                                <p>Happy Customers</p>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="fp-stat-card">
                                <i class="bi bi-shop-window"></i>
                                <h2>{{ $vendorCount }}+</h2>
                                <p>Partner Stores</p>
                            </div>
                        </div>


                        {{-- <div class="col-6">
                            <div class="fp-stat-card">
                                <i class="bi bi-bag-check-fill"></i>
                                <h2>1000+</h2>
                                <p>Meals Saved</p>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="fp-stat-card">
                                <i class="bi bi-globe2"></i>
                                <h2>24/7</h2>
                                <p>Food Access</p>
                            </div>
                        </div> --}}

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- Recently Added Slider --}}
    <section class="fp-dishes-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <span class="text-uppercase small text-success fw-bold tracking-wider">Hot & Fresh</span>
                    <h2 class="fw-bold m-0 mt-1">Recently Added Items</h2>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle fp-recent-prev p-2 lh-1"><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn btn-outline-dark rounded-circle fp-recent-next p-2 lh-1"><i
                            class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

            <div class="swiper fp-recent-slider">
                <div class="swiper-wrapper p-2">
                    @foreach ($latestProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

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
</body>

</html>
