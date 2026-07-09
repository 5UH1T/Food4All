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

    <section class="fp-dishes-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <span class="text-uppercase small text-success fw-bold tracking-wider">Hot & Ready</span>
                    <h2 class="fw-bold m-0 mt-1">Recently Added Plates</h2>
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
                    <div class="swiper-slide">
                        <div class="card fp-dish-card">
                            <div class="fp-dish-img-wrapper">
                                <span class="fp-dish-badge">Top Rated</span>
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600"
                                    alt="Dish 1">
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold fs-5 text-truncate mb-2">Organic Salmon Avocado Bowl</h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fp-dish-price">$18.50</span>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle"><i
                                            class="bi bi-plus-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card fp-dish-card">
                            <div class="fp-dish-img-wrapper">
                                <span class="fp-dish-badge bg-warning text-dark">New</span>
                                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600"
                                    alt="Dish 2">
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold fs-5 text-truncate mb-2">Spicy Basil Pepperoni Pizza</h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fp-dish-price">$16.00</span>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle"><i
                                            class="bi bi-plus-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card fp-dish-card">
                            <div class="fp-dish-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1482049016688-2d3e1b311543?w=600"
                                    alt="Dish 3">
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold fs-5 text-truncate mb-2">Berry Infused French Toast</h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fp-dish-price">$12.25</span>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle"><i
                                            class="bi bi-plus-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card fp-dish-card">
                            <div class="fp-dish-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600"
                                    alt="Dish 4">
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold fs-5 text-truncate mb-2">Superfood Mediterranean Salad</h5>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fp-dish-price">$14.00</span>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle"><i
                                            class="bi bi-plus-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <section class="fp-categories-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-uppercase small text-success fw-bold tracking-wider">Popular</span>
                <h2 class="fw-bold">Explore By Store</h2>
            </div>

            <div class="swiper fp-categories-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="fp-circle-item">
                            <div class="fp-circle-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1551024601-bec78aea704b?w=400"
                                    alt="Bakery">
                            </div>
                            <h6 class="fw-bold mb-0">Artisan Bakery</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fp-circle-item">
                            <div class="fp-circle-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?w=400"
                                    alt="Salads">
                            </div>
                            <h6 class="fw-bold mb-0">Green Bowls</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fp-circle-item">
                            <div class="fp-circle-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?w=400"
                                    alt="Desserts">
                            </div>
                            <h6 class="fw-bold mb-0">Sweet Desserts</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fp-circle-item">
                            <div class="fp-circle-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=400"
                                    alt="Drinks">
                            </div>
                            <h6 class="fw-bold mb-0">Cold Press Juices</h6>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="fp-circle-item">
                            <div class="fp-circle-img-wrapper">
                                <img src="https://images.unsplash.com/photo-1532336414038-cf19250c5757?w=400"
                                    alt="Pasta">
                            </div>
                            <h6 class="fw-bold mb-0">Handmade Pasta</h6>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination position-relative mt-5"></div>
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
