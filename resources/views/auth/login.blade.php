<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="auth-card">

        <a href="/" class="flex justify-center items-center mb-4">
            <img src="{{ asset('admin_assets/img/logo-flat.png') }}" alt="Logo" class="w-[200px]">
        </a>

        <div class="title">Welcome Back</div>

        <form method="POST" id="loginForm" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email Address')" />

                <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" placeholder="you@mail.com" />

                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="w-full" type="password" placeholder="Enter your password"
                    name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Remember + Forgot -->
            <div class="options d-none">

                <label class="flex items-center gap-2">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-orange-500 focus:ring-orange-500">

                    <span class="text-sm text-gray-600">
                        Remember Me
                    </span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot">
                        Forgot Password?
                    </a>
                @endif

            </div>

            <!-- Login Button -->
            <button type="submit" class="login-btn mt-3">
                Sign In
            </button>

            @if (Route::has('register'))
                <div class="register-text">
                    Don't Have an Account?
                    <a href="{{ route('register') }}">
                        Create an account
                    </a>
                </div>
            @endif

        </form>

    </div>

</x-guest-layout>
