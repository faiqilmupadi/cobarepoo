<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengalokasian Ruang Perkuliahan</title>
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
        <h4>Penyusunan Alokasi Ruang Perkuliahan</h4>

        <h5>Pengisian Data Alokasi Ruangan: </h5>
        <br>
        @include('komponen.pesan')

        <div class="form">
            <form action="{{ route('pengalokasianruang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_ruang">Kode Ruang</label>
                    <select name="kode_ruang" class="form-control" id="kode_ruang">
                        <option value="">Pilih Kode Ruang</option>
                        @foreach ($ruangPerkuliahan as $ruang)
                            <option value="{{ $ruang->kode_ruang }}"
                                {{ old('kode_ruang', Session::get('kode_ruang')) == $ruang->kode_ruang ? 'selected' : '' }}>
                                {{ $ruang->kode_ruang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_programstudi">Program Studi</label>
                    <select name="id_programstudi" class="form-control" id="id_programstudi">
                        <option value="">Pilih Program Studi</option>
                        @foreach ($programStudi as $prodi)
                            <option value="{{ $prodi->id_programstudi }}"
                                {{ old('id_programstudi', Session::get('id_programstudi')) == $prodi->id_programstudi ? 'selected' : '' }}>
                                {{ $prodi->nama_programstudi }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Menggunakan div container untuk tombol -->
                <div class="btn-container">
                    <!-- Tombol back di sebelah kiri -->
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="window.location.href='{{ route('bagianakademik') }}'">←</button>

                    <!-- Tombol simpan dan lihat di sebelah kanan -->
                    <div class="btn-right">
                        <button type="submit" class="btn btn-custom">AJUKAN</button>
                        <button type="button" class="btn btn-custom-secondary"
                            onclick="window.location.href='{{ route('pengalokasianruang.lihat') }}'">LIHAT</button>

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
