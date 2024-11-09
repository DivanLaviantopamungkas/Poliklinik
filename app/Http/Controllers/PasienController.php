<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\Log;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPasien = Pasien::all();
        return view('page.data-pasien.index', compact('dataPasien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.data-pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required'
        ]);

        Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('data.pasien')->with('success', 'Pasien berhasil ditambahkan!');
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
        // Mencari data pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);

        // Menampilkan form edit pasien
        return view('page.data-pasien.update', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:15',
        ]);

        // Mencari data pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);

        // Update data pasien
        $pasien->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('data.pasien')->with('success', 'Data pasien berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            // Jika pasien tidak ditemukan, tampilkan pesan error
            return redirect()->route('data.pasien')->with('error', 'Pasien tidak ditemukan!');
        }

        try {
            // Menghapus data pasien
            $pasien->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('data.pasien')->with('success', 'Data pasien berhasil dihapus');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat menghapus data
            Log::error('Error saat menghapus data pasien: ' . $e->getMessage());

            // Redirect dengan pesan error
            return redirect()->route('data.pasien')->with('error', 'Terjadi kesalahan saat menghapus data pasien');
        }
    }
}
