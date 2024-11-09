@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit periksa</h1>

        <!-- Form Edit periksa -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit periksa</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('periksa.update', $periksa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="pasien_id">Pasien</label>
                        <select class="form-control" id="pasien_id" name="pasien_id" required>
                            <option value="">Pilih Pasien</option>
                            @foreach ($pasien as $p)
                                <option value="{{ $p->id }}" {{ $p->id == $periksa->pasien_id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dokter_id">Dokter</label>
                        <select class="form-control" id="dokter_id" name="dokter_id" required>
                            <option value="">Pilih Dokter</option>
                            @foreach ($dokter as $d)
                                <option value="{{ $d->id }}" {{ $d->id == $periksa->dokter_id ? 'selected' : '' }}>
                                    {{ $d->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_periksa">Tanggal Periksa</label>
                        <input type="date" class="form-control" id="tanggal_periksa" name="tanggal_periksa"
                            value="{{ $periksa->tanggal_periksa }}" required>
                    </div>

                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $periksa->catatan }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="obat">Nama Obat</label>
                        <input type="text" class="form-control" id="obat" name="obat"
                            value="{{ $periksa->obat }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('periksa') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
