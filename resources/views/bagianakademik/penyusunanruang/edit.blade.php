@extends('layout.template')
<!-- START FORM -->
@section('content')

    <div class="container">
        <br>
        <h4>Edit Ruang Perkuliahan</h4>

        <div class="form">
            <form action="{{ route('penyusunanruang.update', $ruangPerkuliahan->kode_ruang) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kode_ruang">Kode Ruang</label>
                    <div class="col-sm-10">
                        {{ $ruangPerkuliahan->kode_ruang }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="gedung">Gedung</label>
                    <input type="text" class="form-control" value="{{ $ruangPerkuliahan->gedung }}" id="gedung"
                        name="gedung" placeholder="Masukkan Nama Gedung">
                </div>
                <div class="form-group">
                    <label for="kapasitas">Kapasitas</label>
                    <input type="number" class="form-control" value="{{ $ruangPerkuliahan->kapasitas }}" id="kapasitas"
                        name="kapasitas" placeholder="Masukkan Kapasitas">
                </div>

                <div class="btn-container">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('penyusunanruang.index') }}'">←</button>
                    <div class="btn-right">
                        <button type="submit" class="btn btn-custom">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
