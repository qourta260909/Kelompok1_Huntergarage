<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $daftarProduk = Produk::orderBy('id', 'asc')->get();
        $totalProduk = $daftarProduk->count();

        return view('dashboard_produk', compact('daftarProduk', 'totalProduk'));
    }

    public function store(Request $request)
    {
        $this->normalizeRequestInputs($request);

        $validated = $request->validate([
            'kode_produk' => ['nullable', 'string', 'max:50'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif,svg', 'max:20480'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'in:aktif,nonaktif'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
        ]);

        $deskripsi = $validated['deskripsi'] ?? $validated['kategori'] ?? null;
        $validated['deskripsi'] = $deskripsi;
        $validated['kategori'] = $validated['kategori'] ?? $deskripsi;
        $validated['status'] = $validated['status'] ?? 'aktif';

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk = Produk::create($validated);

        return redirect()->route('dashboard.produk')->with('success', 'Data produk berhasil ditambahkan.');
    }

    public function update(Request $request, Produk $produk)
    {
        $this->normalizeRequestInputs($request);

        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif,svg', 'max:20480'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'in:aktif,nonaktif'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
        ]);

        $deskripsi = $validated['deskripsi'] ?? $validated['kategori'] ?? $produk->deskripsi;
        $validated['deskripsi'] = $deskripsi;
        $validated['kategori'] = $validated['kategori'] ?? $deskripsi ?? $produk->kategori;
        $validated['status'] = $validated['status'] ?? ($produk->status ?: 'aktif');

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && !str_starts_with($produk->gambar, 'images/') && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        } else {
            unset($validated['gambar']);
        }

        $produk->update($validated);

        return redirect()->route('dashboard.produk')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar && !str_starts_with($produk->gambar, 'images/') && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($produk) {
            \Illuminate\Support\Facades\DB::table('tb_pesanan')->where('produk_id', $produk->id)->update(['produk_id' => null]);
            \Illuminate\Support\Facades\DB::table('tb_datapesanan')->where('produk_id', $produk->id)->update(['produk_id' => null]);
            \Illuminate\Support\Facades\DB::table('tb_dataproduk')->where('produk_id', $produk->id)->delete();
            $produk->delete();
        });

        return redirect()->route('dashboard.produk')->with('success', 'Data produk berhasil dihapus.');
    }

    private function normalizeRequestInputs(Request $request): void
    {
        if (!$request->has('stok') && $request->has('jumlah_stok')) {
            $request->merge([
                'stok' => $request->input('jumlah_stok'),
            ]);
        }

        if (!$request->has('harga_jual') && $request->has('harga')) {
            $request->merge([
                'harga_jual' => $request->input('harga'),
            ]);
        }

        if ($request->has('harga_jual')) {
            $request->merge([
                'harga_jual' => preg_replace('/[^\d]/', '', (string) $request->input('harga_jual')),
            ]);
        }
    }
}
