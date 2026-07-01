<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserProfileController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items.menu')->latest()->get();

        return view('profile.show', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    public function edit(): View
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui.');
    }

    public function password(): RedirectResponse
    {
        request()->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check(request('current_password'), Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        Auth::user()->update([
            'password' => Hash::make(request('password')),
        ]);

        return redirect()->route('profile')->with('success', 'Password berhasil diubah.');
    }
}
