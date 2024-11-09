@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Daftar Periksa</h1>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Daftar Periksa -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Periksa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{ route('periksa.create') }}" class="btn btn-primary mb-3">Periksa</a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Nama Dokter</th>
                                <th>Tanggal Periksa</th>
                                <th>Catatan</th>
                                <th>Obat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periksas as $index => $periksa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $periksa->pasien->nama }}</td>
                                    <td>{{ $periksa->dokter->nama }}</td>
                                    <td>{{ $periksa->tgl_periksa }}</td>
                                    <td>{{ $periksa->catatan }}</td>
                                    <td>{{ $periksa->obat }}</td>
                                    <td>
                                        <a href="{{ route('periksa.edit', $periksa->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('periksa.destroy', $periksa->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
