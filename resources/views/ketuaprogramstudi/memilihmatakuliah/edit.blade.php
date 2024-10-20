@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4" style="border-radius: 10px;">
        <h2 class="text-center mb-4">PENYUSUNAN MATA KULIAH</h2>
        <h4 class="mb-3">Edit Mata Kuliah</h4>

        <form action="{{ route('memilihmatakuliah.update', $matakuliah->kode_mk) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
                <input id="kode_mk" type="text" class="form-control" name="kode_mk" value="{{ $matakuliah->kode_mk }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
                <input id="nama_mk" type="text" class="form-control" name="nama_mk" value="{{ $matakuliah->nama_mk }}" required>
            </div>

            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <input id="semester" type="number" class="form-control" name="semester" value="{{ $matakuliah->semester }}" required>
            </div>

            <div class="mb-3">
                <label for="sks" class="form-label">Jumlah SKS</label>
                <input id="sks" type="number" class="form-control" name="sks" value="{{ $matakuliah->sks }}" required>
            </div>

            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <select id="jenis" class="form-control" name="jenis" required>
                    <option value="Wajib" {{ $matakuliah->jenis == 'Wajib' ? 'selected' : '' }}>Wajib</option>
                    <option value="Pilihan" {{ $matakuliah->jenis == 'Pilihan' ? 'selected' : '' }}>Pilihan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="nidn_dosenpengampu" class="form-label">Dosen Pengampu</label>
                <select id="nidn_dosenpengampu" class="form-control" name="nidn_dosenpengampu" required>
                    @foreach ($dosenpengampu as $dosen)
                        <option value="{{ $dosen->nidn_dosenpengampu }}" {{ $matakuliah->nidn_dosenpengampu == $dosen->nidn_dosenpengampu ? 'selected' : '' }}>
                            {{ $dosen->nama_dosenpengampu }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
            </div>
        </form>

        <div class="text-start mt-3">
            <a href="{{ route('memilihmatakuliah.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
