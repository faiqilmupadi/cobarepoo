@extends('layout.template')
<!-- START FORM -->
@section('content')
    <div class="container">
        <br>
        <h4>Penyusunan Ruang Perkuliahan</h4>

        <h5>Pengisian Data Ruangan: </h5>
        <br>

        <div class="form">
            <form action="{{ route('penyusunanruang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_ruang">Kode Ruang</label>
                    <input type="text" class="form-control" value="{{ old('kode_ruang', Session::get('kode_ruang')) }}"
                        id="kode_ruang" name="kode_ruang" placeholder="Masukkan Kode Ruang">
                </div>
                <div class="form-group">
                    <label for="gedung">Gedung</label>
                    <input type="text" class="form-control" value="{{ old('gedung', Session::get('gedung')) }}"
                        id="gedung" name="gedung" placeholder="Masukkan Nama Gedung">
                </div>
                <div class="form-group">
                    <label for="kapasitas">Kapasitas</label>
                    <input type="number" class="form-control" value="{{ old('kapasitas', Session::get('kapasitas')) }}"
                        id="kapasitas" name="kapasitas" placeholder="Masukkan Kapasitas">
                </div>

                <div class="btn-container">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('bagianakademik') }}'">←</button>
                    <div class="btn-right">
                        <button type="submit" class="btn btn-custom">SIMPAN</button>
                        <button type="button" class="btn btn-custom-secondary"
                            onclick="window.location.href='{{ route('penyusunanruang.index') }}'">LIHAT</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
