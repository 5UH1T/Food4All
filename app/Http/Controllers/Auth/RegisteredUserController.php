<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function createVendor(): View
    {
        return view('auth.vendor-register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|unique:user_profiles,phone',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->profile()->create([
            'phone' => $request->phone,
            'address' => $request->address,
            // 'avatar' => $request->avatar,
        ]);

        // $user->vendorProfile()->create([
        //     'phone' => $request->phone,
        //     'address' => $request->address,
        //     'pan' => $request->pan
        // ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('login', absolute: false))->with('success', 'Registration Completed Successfully!');
    }

    public function storeVendor(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|unique:vendor_profiles,phone',
            'pan' => 'required|digits:9|unique:vendor_profiles,pan',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 1,
            'password' => Hash::make($request->password),
        ]);

        $user->vendorProfile()->create([
            'phone' => $request->phone,
            'address' => $request->address,
            'pan' => $request->pan
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('login', absolute: false))->with('success', 'Store Registration Completed Successfully!');
    }
}
