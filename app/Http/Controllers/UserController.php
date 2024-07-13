<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    // Your methods will go here

    public function updateProfile(Request $request)
    {
        // Retrieve the user ID from the authenticated user
        $userId = auth()->id();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);
        // Update the user profile with the new data
        User::where('id', $userId)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender_option'),
        ]);

        // Redirect back to the form with a success message
        return redirect()->back()->with('message', 'Profile updated successfully');
    }
    public function updateAddress(Request $request)
    {
        $userId = auth()->id();

        // Validate the incoming request data
        $request->validate([
            'full_address' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
        ]);

        // Update the user's address fields
        User::where('id', $userId)->update([
            'address' => $request->input('full_address'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'zip' => $request->input('zip'),
        ]);

        // Redirect back to the profile page or wherever you want
        return redirect()->back()->with('success', 'Address updated successfully!');
    }
}
