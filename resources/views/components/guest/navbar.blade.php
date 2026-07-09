@php
    $cartCount = 0;

    if (auth()->check()) {
        $cartCount = auth()->user()->cart?->items()->sum('quantity') ?? 0;
    }
@endphp

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<style>
    .nb-navbar {
        background: var(--fp-white);
        border-bottom: 1px solid #eee;
        position: sticky !important;
        top: 0;
        z-index: 100;
    }

    .nb-logo {
        color: var(--fp-primary);
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .nb-search {
        background: var(--fp-light-cream);
        border: 1px solid transparent;
    }

    .nb-search:focus {
        border-color: var(--fp-accent);
        box-shadow: 0 0 0 .2rem rgba(217, 4, 41, .15);
    }

    .nb-icon-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--fp-light-cream);
        color: var(--fp-primary);
    }

    .nb-avatar {
        width: 42px;
        height: 42px;
        background-color: var(--fp-primary);
        color: white;
        font-weight: 600;

        &:hover {
            background-color: var(--fp-primary);
            color: white;
        }
    }

    .nb-cart-badge {
        background: var(--fp-accent);
    }

    .nb-cart-drawer {
        width: 380px !important;
    }

    .nb-checkout-btn {
        background: var(--fp-accent);
        color: white;
    }

    .nb-checkout-btn:hover {
        background: #b90322;
        color: white;
    }

    .nb-suggestion-item {
        padding: 12px 20px;
        cursor: pointer;
        transition: .2s;
    }

    .nb-suggestion-item:hover {
        background: #f8f8f8;
        color: var(--fp-accent);
    }

    #suggestionBox {
        overflow: hidden;
    }
</style>


<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg py-3 px-4 nb-navbar" style="border-bottom: 1px solid #ccc">

    <div class="container-fluid d-flex align-items-center justify-between gap-4">


        <!-- LOGO -->
        <a href="/" class="navbar-brand nb-logo h-full">
            <img src="{{ asset('admin_assets/img/logo-flat.png') }}" alt="Logo" class="w-[100px]">
        </a>


        <!-- SEARCH -->
        <div class="flex-grow-1 max-w-3xl position-relative">

            <div class="input-group">

                <input id="searchInput" type="search" class="form-control rounded-start-pill py-2 px-4 nb-search"
                    placeholder="Search products, brands and categories..." autocomplete="off">

                <button class="btn rounded-end-pill px-4 text-white" style="background:var(--fp-accent)">
                    Search
                </button>

            </div>


            <div id="suggestionBox" class="position-absolute w-100 bg-white shadow rounded-4 mt-2 d-none"
                style="z-index:999">

            </div>

        </div>


        <!-- RIGHT ACTIONS -->
        <div class="flex items-center gap-3">


            <!-- CART -->
            <a href="/cart" class="btn nb-icon-btn position-relative flex items-center justify-center">
                {{-- data-bs-toggle="offcanvas" data-bs-target="#cartDrawer" --}}
                <i class="bi bi-cart4"></i>
                <span id="cartCountBadge"
                    class="position-absolute top-0 start-100 translate-middle 
                badge rounded-pill nb-cart-badge">
                    {{ $cartCount }}
                </span>

            </a>

            @auth
                <!-- PROFILE DROPDOWN -->
                <div class="dropdown">
                    <button class="btn nb-avatar rounded-circle flex items-center justify-center" data-bs-toggle="dropdown">
                        {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                    </button>


                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">

                        <li>
                            @php
                                $path = match (auth()->user()->role) {
                                    0 => 'admin',
                                    1 => 'store',
                                    default => 'customer',
                                };
                            @endphp

                            <a class="dropdown-item" href="/{{ $path }}">
                                My Account
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                Orders
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="d-flex justify-content-start align-items-center gap-2 py-3 dropdown-item text-danger hover:bg-gray-100"
                                    href="/logout"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Log Out
                                </a>
                            </form>
                        </li>

                    </ul>

                </div>

            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn btn-success">
                    Login / Register
                </a>
            @endguest
        </div>


    </div>

</nav>




<!-- CART DRAWER -->

{{-- <div class="offcanvas offcanvas-end nb-cart-drawer" tabindex="-1" id="cartDrawer">


    <div class="offcanvas-header border-bottom">

        <h5 class="fw-bold">
            Your Cart
        </h5>

        <button type="button" class="btn-close" data-bs-dismiss="offcanvas">
        </button>

    </div>



    <div class="offcanvas-body flex flex-col">


        <!-- CART ITEM -->

        <div class="flex gap-3 border-bottom pb-3 mb-3">

            <img src="https://via.placeholder.com/70" class="rounded">

            <div class="flex-grow-1">

                <h6 class="mb-1">
                    Premium Headphones
                </h6>

                <small class="text-muted">
                    Qty: 1
                </small>

                <div class="fw-bold mt-1">
                    $99
                </div>

            </div>


            <button class="btn btn-sm text-danger">
                ✕
            </button>

        </div>



        <div class="flex gap-3 border-bottom pb-3 mb-3">

            <img src="https://via.placeholder.com/70" class="rounded">

            <div class="flex-grow-1">

                <h6 class="mb-1">
                    Smart Watch
                </h6>

                <small class="text-muted">
                    Qty: 2
                </small>

                <div class="fw-bold mt-1">
                    $150
                </div>

            </div>


            <button class="btn btn-sm text-danger">
                ✕
            </button>

        </div>



        <!-- FOOTER -->

        <div class="mt-auto">

            <div class="flex justify-between mb-3">

                <span class="fw-semibold">
                    Total
                </span>

                <span class="fw-bold">
                    $249
                </span>

            </div>


            <button class="btn w-100 rounded-pill nb-checkout-btn py-2">
                Checkout
            </button>

        </div>


    </div>


</div> --}}
<script>
    const searchInput = document.getElementById('searchInput');
    const suggestionBox = document.getElementById('suggestionBox');


    searchInput.addEventListener('keyup', function() {

        let value = this.value;


        if (value.length < 2) {

            suggestionBox.classList.add('d-none');
            return;

        }


        fetch(`/autocomplete?search=${value}`)
            .then(response => response.json())
            .then(data => {


                suggestionBox.innerHTML = "";


                if (data.length === 0) {

                    suggestionBox.classList.add('d-none');
                    return;

                }


                data.forEach(product => {

                    let item = document.createElement('div');

                    item.className =
                        "nb-suggestion-item";

                    item.innerHTML =
                        `<i class="bi bi-search me-2"></i>${product.title}`;


                    item.onclick = function() {

                        // searchInput.value = product;
                        suggestionBox.classList.add('d-none');
                        window.location.href = `/${product.id}`;

                    };


                    suggestionBox.appendChild(item);

                });


                suggestionBox.classList.remove('d-none');


            });

    });

    document.addEventListener('click', function(e) {

        if (!searchInput.contains(e.target) &&
            !suggestionBox.contains(e.target)) {

            suggestionBox.classList.add('d-none');

        }

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
