<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $daftarLayanan = Layanan::orderBy('id', 'asc')->get();

        return view('dashboard_layanan', compact('daftarLayanan'));
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
            'deskripsi' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'harga' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['estimasi_durasi'] = $validated['deskripsi'];
        $layanan = Layanan::create($validated);

        $layanan->update([
            'kode_layanan' => 'HG-' . str_pad((string) $layanan->id, 2, '0', STR_PAD_LEFT),
        ]);

        return redirect()->route('dashboard.layanan')->with('success', 'Data layanan berhasil ditambahkan.');
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
            'deskripsi' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'harga' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['kode_layanan'] = 'HG-' . str_pad((string) $layanan->id, 2, '0', STR_PAD_LEFT);
        $validated['estimasi_durasi'] = $validated['deskripsi'];

        $layanan->update($validated);

        return redirect()->route('dashboard.layanan')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $layanan->delete();

        return redirect()->route('dashboard.layanan')->with('success', 'Data layanan berhasil dihapus.');
    }
}
