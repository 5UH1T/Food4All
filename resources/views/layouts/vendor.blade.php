@php
    $name = Str::ucfirst(Auth::user()->name);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>@yield('vendor_title')</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/custom.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('vendor.dashboard') }}">
                    <span class="align-middle">{{ $name }}</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('vendor.dashboard') }}"
                            class="sidebar-link rounded-lg d-flex align-items-center gap-1 px-4 py-3 {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header py-2">
                        Products
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('vendor.createProducts') }}"
                            class="sidebar-link rounded-lg d-flex align-items-center gap-1 px-4 py-3 {{ request()->routeIs('vendor.createProducts') ? 'active' : '' }}">
                            <i class="fa-solid fa-plus"></i>
                            <span>Create Product</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('vendor.products') }}"
                            class="sidebar-link rounded-lg d-flex align-items-center gap-1 px-4 py-3 {{ request()->routeIs('vendor.products') ? 'active' : '' }}">
                            <i class="fa-solid fa-utensils"></i>
                            <span>View Products</span>
                        </a>
                    </li>

                    <li class="sidebar-header py-2">
                        Other
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('vendor.categories') }}"
                            class="sidebar-link rounded-lg d-flex align-items-center gap-1 px-4 py-3 {{ request()->routeIs('vendor.categories') ? 'active' : '' }}">
                            <i class="fa-solid fa-layer-group"></i>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('vendor.orders') }}"
                            class="sidebar-link rounded-lg d-flex align-items-center gap-1 px-4 py-3 {{ request()->routeIs('vendor.orders') ? 'active' : '' }}">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <span>Orders</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('vendor.payments') }}"
                            class="sidebar-link rounded-lg d-flex align-items-center gap-1 px-4 py-3 {{ request()->routeIs('vendor.payments') ? 'active' : '' }}">
                            <i class="fa-solid fa-receipt"></i>
                            <span>Payments</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('vendor.settings') }}"
                            class="sidebar-link rounded-lg d-flex align-items-center gap-1 px-4 py-3 {{ request()->routeIs('vendor.settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <a href="/" title="Go to Website" target="_blank">
                    <i class="fa-solid fa-globe globe-icon"></i>
                </a>

                <div class="navbar-collapse">
                    <ul class="navbar-nav navbar-align flex items-center justify-center gap-2">
                        <li class="nav-item dropdown d-none">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="fa-regular fa-bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-notification dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            @php
                                $img = null;
                                if (auth()->check() && Auth::user()->role === 1) {
                                    if (Auth::user()->vendorProfile->avatar) {
                                        $img = Storage::url(Auth::user()->vendorProfile->avatar);
                                    }
                                }
                            @endphp
                            @if ($img)
                                <a class="dropdown-toggle nb-img-avatar" href="#" data-bs-toggle="dropdown"
                                    title="{{ Auth::user()->name }}">
                                    <img src="{{ asset($img) }}">
                                </a>
                            @else
                                <button
                                    class="btn dropdown-toggle d-flex align-items-center justify-content-center nb-avatar"
                                    href="#" data-bs-toggle="dropdown" title="{{ Auth::user()->name }}">
                                    {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                                </button>
                            @endif
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="/store/settings"
                                    class="d-flex justify-content-start align-items-center gap-2 py-3 dropdown-item hover:bg-gray-100 text-sm dropdown-item text-gray-700 active:text-gray-700">
                                    <i class="fa-solid fa-circle-user"></i> Profile
                                </a>
                                {{-- <div class="dropdown-divider"></div> --}}
                                {{-- <a class="dropdown-item" href="#">Log out</a> --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="d-flex justify-content-start align-items-center gap-2 py-3 dropdown-item text-danger hover:bg-gray-100"
                                        href="/logout"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    @yield('vendor_content')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="{{ route('vendor.dashboard') }}"
                                    target="_blank"><strong>&copy; 2026 Food4All</strong></a>
                                - All Rights Reserved
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('admin_assets/js/app.js') }}"></script>

</body>

</html>
