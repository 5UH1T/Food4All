<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('admin_title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<body class="bg-gray-100">

    <div x-cloak x-data="{ sidebarOpen: true, profileOpen: false, testModal: false }" class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="bg-slate-900 text-white transition-all duration-300 flex flex-col">

            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b border-slate-800">
                <span class="text-2xl font-bold tracking-wide" x-show="sidebarOpen">
                    ADMIN
                </span>

                <span class="text-2xl font-bold" x-show="!sidebarOpen">
                    A
                </span>
            </div>

            <!-- Nav -->
            <nav class="side-navbar flex-1 px-3 py-5 space-y-2 overflow-y-auto">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span x-show="sidebarOpen">Dashboard</span>
                </a>

                <a href="{{ route('admin.categories') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i>
                    <span x-show="sidebarOpen">Categories</span>
                </a>

                <a href="{{ route('admin.orders') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    <i class="fa-solid fa-box-archive"></i>
                    <span x-show="sidebarOpen">Orders</span>
                </a>

                <a href="{{ route('admin.vendors') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition {{ request()->routeIs('admin.vendors') ? 'active' : '' }}">
                    <i class="fa-solid fa-shop"></i>
                    <span x-show="sidebarOpen">Vendors</span>
                </a>

                <a href="{{ route('admin.users') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span x-show="sidebarOpen">Users</span>
                </a>

                <a href="{{ route('admin.payments') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition {{ request()->routeIs('admin.payments') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i>
                    <span x-show="sidebarOpen">Payments</span>
                </a>

                <a href="{{ route('admin.attributes') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition {{ request()->routeIs('admin.attributes') ? 'active' : '' }}">
                    <i class="fa-solid fa-lightbulb"></i>
                    <span x-show="sidebarOpen">Attributes</span>
                </a>

                <a href="{{ route('admin.settings') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i>
                    <span x-show="sidebarOpen">Settings</span>
                </a>


            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-slate-800">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="w-full bg-slate-800 hover:bg-slate-700 rounded-lg py-2 text-sm transition">
                    Toggle Sidebar
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- TOPBAR -->
            <header class="h-16 bg-white shadow-sm border-b border-gray-200 px-6 flex items-center justify-between">

                <!-- Left -->
                <div>
                    <h1 class="text-xl font-semibold text-gray-800">
                        {{ $header ?? 'Dashboard' }}
                    </h1>
                </div>

                <!-- Right -->
                <div class="relative" x-data="{ open: false }">

                    <!-- Profile Button -->
                    <button @mouseenter="open = true"
                        class="flex items-center gap-3 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-xl transition">

                        <img src="https://i.pravatar.cc/100" class="w-10 h-10 rounded-full object-cover" alt="profile">

                        <div class="text-left hidden md:block">
                            <p class="text-sm font-semibold text-gray-700">Admin User</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @mouseleave="open = false" x-transition
                        class="absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50">

                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 text-sm text-gray-700">
                            Profile
                        </a>

                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 text-sm text-gray-700">
                            Settings
                        </a>

                        <hr>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="block px-4 py-3 hover:bg-red-50 text-sm text-red-600" href="/logout"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto p-6">

                <!-- Dynamic Content -->
                @yield('admin_content')

            </main>
        </div>



    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</html>
