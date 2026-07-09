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
                    <a href="#" class="btn btn-warning rounded-pill px-4 py-2 fw-bold text-dark">Shop & Save
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
                            class="bi bi-chevron-left"></i></button>
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-next p-2 lh-1"><i
                            class="bi bi-chevron-right"></i></button>
                </div>
            </div>

            <div class="swiper fp-dishes-slider">
                <div class="swiper-wrapper p-2">
                    @foreach ($latestProducts as $product)
                        <div class="swiper-slide">
                            <div class="card fp-dish-card">
                                <div class="fp-dish-img-wrapper">
                                    {{-- <span class="fp-dish-badge">Top Rated</span> --}}
                                    <img src="{{ asset($product->productImage->first()->image_path) }}"
                                        alt="{{ $product->title }}">
                                </div>
                                <div class="card-body p-4">
                                    <a href="/{{ $product->id }}">
                                        <h5 class="fw-bold fs-5 text-truncate mb-2">{{ $product->title ?? '' }}</h5>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <span class="fp-dish-price">Rs {{ $product->price }}</span>
                                            <span class="fp-dish-price-cut">Rs {{ $product->initial_price }}</span>
                                        </div>
                                        <button class="btn btn-sm btn-outline-success rounded-circle"><i
                                                class="bi bi-plus-lg"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-prev p-2 lh-1"><i
                            class="bi bi-chevron-left"></i></button>
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-next p-2 lh-1"><i
                            class="bi bi-chevron-right"></i></button>
                </div>
            </div>

            <div class="swiper fp-value-slider">
                <div class="swiper-wrapper p-2">
                    @foreach ($valueProducts as $product)
                        <div class="swiper-slide">
                            <div class="card fp-dish-card">
                                <div class="fp-dish-img-wrapper">
                                    {{-- <span class="fp-dish-badge">Top Rated</span> --}}
                                    <img src="{{ asset($product->productImage->first()->image_path) }}"
                                        alt="{{ $product->title }}">
                                </div>
                                <div class="card-body p-4">
                                    <a href="/{{ $product->id }}">
                                        <h5 class="fw-bold fs-5 text-truncate mb-2">{{ $product->title ?? '' }}</h5>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <span class="fp-dish-price">Rs {{ $product->price }}</span>
                                            <span class="fp-dish-price-cut">Rs {{ $product->initial_price }}</span>
                                        </div>
                                        <button class="btn btn-sm btn-outline-success rounded-circle"><i
                                                class="bi bi-plus-lg"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <img src="{{ asset('storage/' . $vendor->vendorProfile->avatar) }}"
                                        alt="{{ $vendor->name }}">
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

    {{-- Another Slider --}}
    <section class="fp-dishes-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <span class="text-uppercase small text-success fw-bold tracking-wider">Bang For Bucks</span>
                    <h2 class="fw-bold m-0 mt-1">Value For Money Items</h2>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-prev p-2 lh-1"><i
                            class="bi bi-chevron-left"></i></button>
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-next p-2 lh-1"><i
                            class="bi bi-chevron-right"></i></button>
                </div>
            </div>

            <div class="swiper fp-value-slider">
                <div class="swiper-wrapper p-2">
                    @foreach ($valueProducts as $product)
                        <div class="swiper-slide">
                            <div class="card fp-dish-card">
                                <div class="fp-dish-img-wrapper">
                                    {{-- <span class="fp-dish-badge">Top Rated</span> --}}
                                    <img src="{{ asset($product->productImage->first()->image_path) }}"
                                        alt="{{ $product->title }}">
                                </div>
                                <div class="card-body p-4">
                                    <a href="/{{ $product->id }}">
                                        <h5 class="fw-bold fs-5 text-truncate mb-2">{{ $product->title ?? '' }}</h5>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <span class="fp-dish-price">Rs {{ $product->price }}</span>
                                            <span class="fp-dish-price-cut">Rs {{ $product->initial_price }}</span>
                                        </div>
                                        <button class="btn btn-sm btn-outline-success rounded-circle"><i
                                                class="bi bi-plus-lg"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
                    <span class="text-uppercase small text-success fw-bold tracking-wider">Bang For Bucks</span>
                    <h2 class="fw-bold m-0 mt-1">Value For Money Items</h2>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-prev p-2 lh-1"><i
                            class="bi bi-chevron-left"></i></button>
                    <button class="btn btn-outline-dark rounded-circle fp-dishes-next p-2 lh-1"><i
                            class="bi bi-chevron-right"></i></button>
                </div>
            </div>

            <div class="swiper fp-value-slider">
                <div class="swiper-wrapper p-2">
                    @foreach ($valueProducts as $product)
                        <div class="swiper-slide">
                            <div class="card fp-dish-card">
                                <div class="fp-dish-img-wrapper">
                                    {{-- <span class="fp-dish-badge">Top Rated</span> --}}
                                    <img src="{{ asset($product->productImage->first()->image_path) }}"
                                        alt="{{ $product->title }}">
                                </div>
                                <div class="card-body p-4">
                                    <a href="/{{ $product->id }}">
                                        <h5 class="fw-bold fs-5 text-truncate mb-2">{{ $product->title ?? '' }}</h5>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <span class="fp-dish-price">Rs {{ $product->price }}</span>
                                            <span class="fp-dish-price-cut">Rs {{ $product->initial_price }}</span>
                                        </div>
                                        <button class="btn btn-sm btn-outline-success rounded-circle"><i
                                                class="bi bi-plus-lg"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hero Main Showcase
            const heroSlider = new Swiper('.fp-hero-section', {
                loop: true,
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
            });

            // Trending Plates Carousel
            const dishesSlider = new Swiper('.fp-dishes-slider', {
                slidesPerView: 1,
                spaceBetween: 24,
                navigation: {
                    nextEl: '.fp-dishes-next',
                    prevEl: '.fp-dishes-prev',
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 4
                    }
                }
            });

            // Trending Plates Carousel
            const valueSlider = new Swiper('.fp-value-slider', {
                slidesPerView: 1,
                spaceBetween: 24,
                navigation: {
                    nextEl: '.fp-value-next',
                    prevEl: '.fp-value-prev',
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 4
                    }
                }
            });

            // Round Showcase Categories Carousel
            const categoriesSlider = new Swiper('.fp-categories-slider', {
                slidesPerView: 2,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                breakpoints: {
                    480: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 4
                    },
                    992: {
                        slidesPerView: 5
                    }
                }
            });
        });
    </script>
</body>

</html>
