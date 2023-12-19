<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user', compact('users'));
    }

    public function create()
    {
        return view('add-data');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'alamat' => 'required|string|max:255',
        ], [
            'nim.unique' => 'NIM sudah terpakai. Gunakan NIM lain.',
            'email.unique' => 'Email sudah terpakai. Gunakan Email lain.',
        ]);

        $existingUserEmail = User::where('email', $request->email)->first();
        $existingUserNim = User::where('nim', $request->nim)->first();

        if ($existingUserEmail) {
            return redirect()->route('add-data')->with('error', 'Email sudah terpakai. Gunakan Email lain.');
        }

        if ($existingUserNim) {
            return redirect()->route('add-data')->with('error', 'NIM sudah terpakai. Gunakan Nim lain.');
        }

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('users.index')->with('success', 'User Berhasil di Buat');
    }


    public function edit(User $user)
    {
        return view('user-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:users,nim,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'alamat' => 'required|string|max:255',
        ], [
            'nim.unique' => 'NIM sudah terpakai. Gunakan NIM lain.',
            'email.unique' => 'Email sudah terpakai. Gunakan Email lain.',
        ]);

        $user->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('users.index')->with('success', 'User Berhasil di Edit');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Berhasil di Hapus');
    }
}
