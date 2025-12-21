<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->user()->update(
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
            ])
        );

        return back()->with('success', 'Profile updated');
    }
}
