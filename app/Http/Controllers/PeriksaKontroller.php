<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;
use App\Models\Pasien;
use App\Models\Dokter;

class PeriksaKontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periksas = Periksa::with(['pasien', 'dokter'])->get();

        return view('page.periksa.index', compact('periksas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasien = Pasien::all();
        $dokter = Dokter::all();

        return view('page.periksa.create', compact('pasien', 'dokter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Menyimpan data periksa baru menggunakan query builder atau Eloquent
        $periksa = new Periksa;
        $periksa->pasien_id = $request->pasien_id;
        $periksa->dokter_id = $request->dokter_id;
        $periksa->tgl_periksa = $request->tanggal_periksa;
        $periksa->catatan = $request->catatan;
        $periksa->obat = $request->obat;
        $periksa->save();

        return redirect()->route('periksa')->with('success', 'Data Periksa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data pemeriksaan berdasarkan ID
        $periksa = Periksa::findOrFail($id);

        // Ambil data pasien dan dokter untuk ditampilkan di form
        $pasien = Pasien::all();
        $dokter = Dokter::all();

        // Tampilkan view edit dengan data yang ada
        return view('page.periksa.update', compact('periksa', 'pasien', 'dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'obat' => 'nullable|string',
        ]);

        // Cari data pemeriksaan berdasarkan ID
        $periksa = Periksa::findOrFail($id);

        // Update data pemeriksaan
        $periksa->update([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'tanggal_periksa' => $request->tanggal_periksa,
            'catatan' => $request->catatan,
            'obat' => $request->obat,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('periksa')->with('success', 'Data pemeriksaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $periksa = Periksa::find($id);

        if (!$periksa) {
            // Jika pasien tidak ditemukan, tampilkan pesan error
            return redirect()->route('periksa')->with('error', 'Data Periksa tidak ditemukan!');
        }

        try {
            // Menghapus data pasien
            $periksa->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('periksa')->with('success', 'Data periksa berhasil dihapus');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat menghapus data
            Log::error('Error saat menghapus data pasien: ' . $e->getMessage());

            // Redirect dengan pesan error
            return redirect()->route('periksa')->with('error', 'Terjadi kesalahan saat menghapus data periksa');
        }
    }
}
