<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $layanan = Layanan::query()
            ->withCount('riwayatLayanan')
            ->orderBy('nama_layanan')
            ->get();

        return view('dashboard_layanan', compact('layanan'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        if ($request->has('harga')) {
            $request->merge([
                'harga' => preg_replace('/[^\d]/', '', (string) $request->input('harga')),
            ]);
        }

        $validated = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'estimasi_durasi' => ['nullable', 'string', 'max:255'],
            'harga' => ['required', 'numeric', 'min:0'],
        ]);

        Layanan::create($validated);

        return redirect()->route('dashboard.layanan')->with('success', 'Layanan berhasil ditambahkan untuk form pelanggan.');
    }

    public function update(Request $request, Layanan $layanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        if ($request->has('harga')) {
            $request->merge([
                'harga' => preg_replace('/[^\d]/', '', (string) $request->input('harga')),
            ]);
        }

        $validated = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'estimasi_durasi' => ['nullable', 'string', 'max:255'],
            'harga' => ['required', 'numeric', 'min:0'],
        ]);

        $layanan->update($validated);

        return redirect()->route('dashboard.layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $layanan->delete();

        return redirect()->route('dashboard.layanan')->with('success', 'Layanan berhasil dihapus.');
    }
}

