<x-guest-layout>

    <div class="auth-card">
        <a href="/" class="flex justify-center items-center mb-4">
            <img src="{{ asset('admin_assets/img/logo-flat.png') }}" alt="Logo" class="w-[250px]">
        </a>

        <h2>Create Account</h2>

        <form id="userRegisterForm" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <x-input-label for="name" :value="__('Full Name')" />

                <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')"
                    placeholder="Your Name" required autofocus autocomplete="name" />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email Address')" />

                <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')"
                    placeholder="you@mail.com" required autocomplete="username" />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Create Password')" />

                <x-text-input id="password" class="block w-full" type="password" name="password"
                    placeholder="Enter your password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block w-full" type="password"
                    name="password_confirmation" placeholder="Confirm your password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <x-input-label for="phone" :value="__('Phone Number')" />

                <x-text-input id="phone" class="block w-full" type="text" name="phone" :value="old('phone')"
                    placeholder="Phone Number" required />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="form-group">
                <x-input-label for="name" :value="__('Your Address')" />


                <x-text-input id="address" class="block w-full" type="text" name="address" :value="old('address')"
                    placeholder="Your Address" required />

                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <button type="submit" class="btn-submit mt-3">
                Register Now
            </button>

            <div class="switch-prompt">
                Already have an account?
                <a href="{{ route('login') }}">
                    Log In here
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
