<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;


class SettingsController extends Controller
{
    public function show()
    {
        return Inertia::render('Settings');
    }

    public function updateDetails(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        ]);

        $user->update($data);

        return Inertia::render('Settings')->with('success.details', 'Profile successfully edited !');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'actual_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        if (Hash::check($data['actual_password'], $user->password)) {
            $user->update(['password' => Hash::make($data['new_password'])]);
            return Inertia::render('Settings')->with('success.password', 'Password successfully edited !');
        } else {
            return redirect()->back()->withErrors(['actual_password' => 'The actual password is incorrect.']);
        }
    }
}
