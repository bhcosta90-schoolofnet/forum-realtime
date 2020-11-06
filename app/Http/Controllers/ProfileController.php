<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profile.form', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id.",id"],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->photo = $request->file('photo');
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();
        return redirect('/');
    }
}
