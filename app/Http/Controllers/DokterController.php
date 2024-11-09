<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataDokter = Dokter::All();

        return view('page.data-dokter.index', compact('dataDokter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.data-dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate = ([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Dokter::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->route('data.dokter')->with('success', 'Dokter berhasil ditambahkan!');
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
        $dokter = Dokter::findOrFail($id);

        return view('page.data-dokter.update', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $dokter = Dokter::findOrFail($id);

        $dokter->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('data.dokter')->with('success', 'Data dokter berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = Dokter::find($id);

        if (!$dokter) {
            // Jika pasien tidak ditemukan, tampilkan pesan error
            return redirect()->route('data.dokter')->with('error', 'Dokter tidak ditemukan!');
        }

        try {
            // Menghapus data pasien
            $dokter->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('data.dokter')->with('success', 'Data Dokter berhasil dihapus');
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan saat menghapus data
            Log::error('Error saat menghapus data pasien: ' . $e->getMessage());

            // Redirect dengan pesan error
            return redirect()->route('data.dokter')->with('error', 'Terjadi kesalahan saat menghapus data Dokter');
        }
    }
}
