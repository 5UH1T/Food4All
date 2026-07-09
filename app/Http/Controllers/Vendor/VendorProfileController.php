<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VendorProfileController extends Controller
{
    /**
     * Show profile.
     */
    public function edit()
    {
        $user = Auth::user();
        $vendor = Auth::user()->vendorProfile;

        return view('vendor.settings', compact('vendor','user'));
    }

    /**
     * Update profile.
     */
public function update(Request $request)
    {
        $user = Auth::user();
        $vendor = $user->vendorProfile;
        $avatar = $request->avatar;

        // Convert full URL into storage path
        if ($avatar) {
            $avatar = Str::after($avatar, '/storage/');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:vendor_profiles,phone,' . $vendor->id,
            'pan' => 'required|digits:9|unique:vendor_profiles,pan,' . $vendor->id,
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|string',
            'description' => 'nullable|string',
            'map' => 'nullable|string',
        ]);

        // Update users table
        $user->update([
            'name' => $request->name,
        ]);

        // Update vendor_profiles table
        $vendor->update([
            'phone' => $request->phone,
            'pan' => $request->pan,
            'address' => $request->address,
            'avatar' => $avatar,
            'description' => $request->description,
            'map' => $request->map,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully.');
    }
}