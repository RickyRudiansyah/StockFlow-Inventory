<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // 1. Tampilkan Daftar User (Read)
    public function index()
    {
        $users = User::latest()->get();
        return vieww('users.index', compact('users'));
    }

    // 2. Tampilkan Form Tambah (Create)
    public function create()
    {
        return view('users.create');
    }

    // 3. Simpan Data Baru (Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,staff'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'User berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // 5. Update Data
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,staff'],
        ]);

        // Update data basic
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('users.index')
                         ->with('success', 'User berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy(User $user)
    {
        // Cegah user menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                             ->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('users.index')
                         ->with('success', 'User berhasil dihapus!');
    }
}