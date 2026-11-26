<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LayananController extends Controller
{
    public function index()
    {
        $daftarLayanan = Layanan::orderBy('id', 'asc')->get();

        return view('dashboard_layanan', compact('daftarLayanan'));
    }

    public function storeKendaraan(Request $request)
    {
        $validated = $request->validate([
            'merek' => ['required', 'string', 'max:100'],
            'jenis_kendaraan' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:120'],
        ]);

        $merek = ucwords(trim($validated['merek']));
        $jenis = ucwords(trim($validated['jenis_kendaraan']));
        $model = trim($validated['model']);

        Kendaraan::updateOrCreate(
            ['merek' => $merek, 'model' => $model],
            ['jenis_kendaraan' => $jenis]
        );

        return redirect()->route('dashboard.layanan')->with('success', "Data kendaraan {$merek} {$model} ({$jenis}) berhasil disimpan.");
    }

    public function destroyKendaraan(Kendaraan $kendaraan)
    {
        $label = "{$kendaraan->merek} {$kendaraan->model}";
        $kendaraan->delete();

        return redirect()->route('dashboard.layanan')->with('success', "Data kendaraan {$label} berhasil dihapus.");
    }

    public function store(Request $request)
    {
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
            'kode_layanan' => (string) $layanan->id,
        ]);

        return redirect()->route('dashboard.layanan')->with('success', 'Data layanan berhasil ditambahkan.');
    }

    public function update(Request $request, Layanan $layanan)
    {
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

        $validated['kode_layanan'] = (string) $layanan->id;
        $validated['estimasi_durasi'] = $validated['deskripsi'];

        $layanan->update($validated);

        return redirect()->route('dashboard.layanan')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        \Illuminate\Support\Facades\DB::transaction(function () use ($layanan) {
            \Illuminate\Support\Facades\DB::table('tb_pesanan')->where('layanan_id', $layanan->id)->update(['layanan_id' => null]);
            \Illuminate\Support\Facades\DB::table('tb_datapesanan')->where('layanan_id', $layanan->id)->update(['layanan_id' => null]);
            \Illuminate\Support\Facades\DB::table('tb_jadwalservice')->where('layanan_id', $layanan->id)->update(['layanan_id' => null]);
            $layanan->delete();
        });

        return redirect()->route('dashboard.layanan')->with('success', 'Data layanan berhasil dihapus.');
    }
}
