<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roleFilter = $request->query('role', 'all');
        if (!in_array($roleFilter, ['all', 'admin', 'user'], true)) {
            $roleFilter = 'all';
        }

        $daftarUsers = User::when(
            $roleFilter !== 'all',
            fn ($query) => $query->where('role', $roleFilter)
        )->orderBy('id', 'asc')->get();

        $totalUsers = User::count();

        return view('dashboard_users', compact('daftarUsers', 'totalUsers', 'roleFilter'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        User::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'no_telepon' => trim((string) ($validated['no_telepon'] ?? '')) ?: null,
            'alamat' => trim((string) ($validated['alamat'] ?? '')) ?: null,
            'role' => $validated['role'],
            'email_verified_at' => now(),
        ]);

        return redirect()->route('dashboard.users')->with('success', 'Akun pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        $data = [
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'no_telepon' => trim((string) ($validated['no_telepon'] ?? '')) ?: null,
            'alamat' => trim((string) ($validated['alamat'] ?? '')) ?: null,
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('dashboard.users')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($request->user() && $request->user()->id === $user->id) {
            return redirect()->route('dashboard.users')->withErrors([
                'user' => 'Anda tidak dapat menghapus akun yang sedang digunakan.',
            ]);
        }

        $user->delete();

        return redirect()->route('dashboard.users')->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
