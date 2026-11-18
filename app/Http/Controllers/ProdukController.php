<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $daftarProduk = Produk::orderBy('id', 'asc')->get();

        return view('dashboard_produk', compact('daftarProduk'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        if ($request->has('harga_jual')) {
            $request->merge([
                'harga_jual' => preg_replace('/[^\d]/', '', (string) $request->input('harga_jual')),
            ]);
        }

        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'in:aktif,nonaktif'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['status'] = $validated['status'] ?? 'aktif';
        $validated['kategori'] = $validated['deskripsi'] ?? null;
        $produk = Produk::create($validated);

        $produk->update([
            'kode_produk' => 'HG-' . str_pad((string) $produk->id, 2, '0', STR_PAD_LEFT),
        ]);

        return redirect()->route('dashboard.produk')->with('success', 'Data produk berhasil ditambahkan.');
    }

    public function update(Request $request, Produk $produk)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        if ($request->has('harga_jual')) {
            $request->merge([
                'harga_jual' => preg_replace('/[^\d]/', '', (string) $request->input('harga_jual')),
            ]);
        }

        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'in:aktif,nonaktif'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['kode_produk'] = 'HG-' . str_pad((string) $produk->id, 2, '0', STR_PAD_LEFT);
        $validated['status'] = $validated['status'] ?? ($produk->status ?: 'aktif');
        $validated['kategori'] = $validated['deskripsi'] ?? $produk->kategori;

        $produk->update($validated);

        return redirect()->route('dashboard.produk')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $produk->delete();

        return redirect()->route('dashboard.produk')->with('success', 'Data produk berhasil dihapus.');
    }
}
