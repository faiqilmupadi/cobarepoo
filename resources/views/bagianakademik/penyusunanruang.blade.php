<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penyusunan Ruang Perkuliahan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;

        }

        .header {
            display: flex;
            background-color: #658345;
            color: black;
            padding: 30px;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .header img {
            height: 60px;
            margin-right: 20px;
        }

        h1 {
            margin: 0;
            font-size: 30px;
            margin-right: 70px;
            font-weight: bold;
        }

        h2 {
            margin: 0;
            font-size: 25px;
            font-weight: 600;
            margin-right: 70px;
        }

        .container {
            margin-top: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }

        h4 {
            text-align: center;
            font-size: 23px;
            font-weight: 600;
        }

        h5 {
            margin-top: 30px;
        }

        .btn-custom {
            background-color: #007bff;
            /* Warna biru */
            color: white;
            border-radius: 8px;
            /* Border radius untuk memperhalus tombol */
            margin-right: 10px;
            /* Jarak antara tombol SIMPAN dan LIHAT */
        }

        .btn-custom-secondary {
            background-color: #28a745;
            /* Warna hijau */
            color: white;
            border-radius: 8px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .btn-custom-secondary:hover {
            background-color: #218838;
        }

        .btn-outline-secondary {
            border-radius: 8px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            /* Tombol Back di kiri, SIMPAN dan LIHAT di kanan */
            margin-bottom: 20px;
            /* Jarak keseluruhan di bawah tombol */
        }

        .btn-right {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="sate_logo.png" alt="SATE Logo">
        <div>
            <h1>SATE</h1>
            <h2>Sistem Akademik Terpadu Efisien</h2>
        </div>
    </div>


    <div class="container">
        <br>
        <h4>Penyusunan Ruang Perkuliahan</h4>

        <h5>Pengisian Data Ruangan: </h5>
        <br>

        @if ($errors->any())
            <div class="pt-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="form">
            <form action="{{ route('penyusunanruang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_ruang">Kode Ruang</label>
                    <input type="text" class="form-control"
                        value="{{ old('kode_ruang', Session::get('kode_ruang')) }}" id="kode_ruang" name="kode_ruang"
                        placeholder="Masukkan Kode Ruang">
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
                        <button type="button" class="btn btn-custom-secondary" onclick="window.location.href='{{ route('penyusunanruang.lihat') }}'">LIHAT</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
