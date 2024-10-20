@extends('layout.template')
<!-- START FORM -->
@section('content')
    <!-- Header -->

    <!-- Container -->
    <div class="container mt-4">
        <!-- Search Box -->
        <div class="search-box d-flex justify-content-between align-items-center">
            <input type="text" class="form-control me-2" placeholder="CARI RUANG PERKULIAHAN" aria-label="Search">
            <button class="btn">
                <i class="bi bi-search"></i>
            </button>
            <button class="capacity-btn">
                <i class="bi bi-plus-minus"></i>
            </button>
        </div>

        <!-- Table -->
        <div class="table-container">
            <h4 class="mt-4">Daftar Ruang Perkuliahan</h4>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruang Kuliah</th>
                        <th>Letak Gedung</th>
                        <th>Kapasitas Ruangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ruangPerkuliahan as $index => $ruang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ruang->kode_ruang }}</td>
                            <td>{{ $ruang->gedung }}</td>
                            <td>{{ $ruang->kapasitas }} Mahasiswa</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('penyusunanruang.edit', $ruang->kode_ruang) }}"
                                    class="btn btn-warning">EDIT</a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('penyusunanruang.destroy', $ruang->kode_ruang) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('Yakin akan menghapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="btn-container">
            <button type="button" class="btn btn-outline-secondary"
                onclick="window.location.href='{{ route('penyusunanruang.create') }}'">←</button>
        </div>
    </div>
@endsection
