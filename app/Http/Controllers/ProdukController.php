<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $daftarProduk = Produk::orderBy('id', 'asc')->get();
        $totalProduk = $daftarProduk->count();
        $daftarKategoriProduk = Schema::hasTable('tb_kategori_produk')
            ? KategoriProduk::orderBy('nama_kategori', 'asc')->get()
            : collect();

        return view('dashboard_produk', compact('daftarProduk', 'totalProduk', 'daftarKategoriProduk'));
    }

    public function storeKategori(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:120'],
        ]);

        $nama = trim($validated['nama_kategori']);
        if (Schema::hasTable('tb_kategori_produk')) {
            KategoriProduk::firstOrCreate(
                ['nama_kategori' => $nama],
                ['slug' => Str::slug($nama) ?: ('kat-' . Str::lower(Str::random(6)))]
            );
        }

        return redirect()->route('dashboard.produk')->with('success', "Kategori produk '{$nama}' berhasil ditambahkan.");
    }

    public function destroyKategori(KategoriProduk $kategori)
    {
        $nama = $kategori->nama_kategori;
        $kategori->delete();

        return redirect()->route('dashboard.produk')->with('success', "Kategori produk '{$nama}' berhasil dihapus.");
    }

    public function store(Request $request)
    {
        $this->normalizeRequestInputs($request);

        $validated = $request->validate([
            'kode_produk' => ['nullable', 'string', 'max:50'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif,svg', 'max:20480'],
            'kategori' => ['nullable', 'string', 'max:120'],
            'kategori_baru' => ['nullable', 'string', 'max:120'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'in:aktif,nonaktif'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
        ]);

        $kategoriDipilih = ($validated['kategori'] ?? '') === '__LAINNYA__'
            ? trim((string) ($validated['kategori_baru'] ?? ''))
            : trim((string) ($validated['kategori'] ?? ''));

        $deskripsi = trim((string) ($validated['deskripsi'] ?? '')) ?: ($kategoriDipilih ?: null);
        $kategoriFinal = $kategoriDipilih ?: $deskripsi;

        if ($kategoriFinal && Schema::hasTable('tb_kategori_produk')) {
            KategoriProduk::firstOrCreate(
                ['nama_kategori' => $kategoriFinal],
                ['slug' => Str::slug($kategoriFinal) ?: ('kat-' . Str::lower(Str::random(6)))]
            );
        }

        $validated['deskripsi'] = $deskripsi;
        $validated['kategori'] = $kategoriFinal;
        $validated['status'] = $validated['status'] ?? 'aktif';
        unset($validated['kategori_baru']);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($validated);

        return redirect()->route('dashboard.produk')->with('success', 'Data produk berhasil ditambahkan.');
    }

    public function update(Request $request, Produk $produk)
    {
        $this->normalizeRequestInputs($request);

        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,jfif,avif,gif,svg', 'max:20480'],
            'kategori' => ['nullable', 'string', 'max:120'],
            'kategori_baru' => ['nullable', 'string', 'max:120'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'in:aktif,nonaktif'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
        ]);

        $kategoriDipilih = ($validated['kategori'] ?? '') === '__LAINNYA__'
            ? trim((string) ($validated['kategori_baru'] ?? ''))
            : trim((string) ($validated['kategori'] ?? ''));

        $deskripsi = trim((string) ($validated['deskripsi'] ?? '')) ?: ($kategoriDipilih ?: $produk->deskripsi);
        $kategoriFinal = $kategoriDipilih ?: ($produk->kategori ?: $deskripsi);

        if ($kategoriFinal && Schema::hasTable('tb_kategori_produk')) {
            KategoriProduk::firstOrCreate(
                ['nama_kategori' => $kategoriFinal],
                ['slug' => Str::slug($kategoriFinal) ?: ('kat-' . Str::lower(Str::random(6)))]
            );
        }

        $validated['deskripsi'] = $deskripsi;
        $validated['kategori'] = $kategoriFinal;
        $validated['status'] = $validated['status'] ?? ($produk->status ?: 'aktif');
        unset($validated['kategori_baru']);

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
