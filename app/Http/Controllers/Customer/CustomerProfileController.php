<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerProfileController extends Controller
{
    /**
     * Show profile.
     */
    public function edit()
    {
        $user = Auth::user();
        $customer = Auth::user()->profile;

        return view('customer.profile', compact('customer','user'));
    }

    /**
     * Update profile.
     */
public function update(Request $request)
    {
        $user = Auth::user();
        $customer = $user->profile;
        $avatar = $request->avatar;

        // Convert full URL into storage path
        if ($avatar) {
            $avatar = Str::after($avatar, '/storage/');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:user_profiles,phone,' . $customer->id,
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|string',
        ]);

        // Update users table
        $user->update([
            'name' => $request->name,
        ]);

        // Update user_profiles table
        $customer->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatar,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully.');
    }
}