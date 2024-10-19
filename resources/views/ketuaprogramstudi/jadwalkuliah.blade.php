<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #5c6f3d;
            padding: 15px;
            display: flex;
            align-items: center;
        }

        header img {
            height: 50px;
            margin-right: 10px;
        }

        header h1 {
            font-size: 24px;
            color: white;
            margin: 0;
            font-weight: 600;
        }

        header h2 {
            font-size: 14px;
            color: white;
            margin: 0;
            font-weight: 400;
        }

        .container {
            width: 100%;
            max-width: 700px;
            background-color: white;
            margin: 50px auto;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h3 {
            font-size: 20px;
            text-align: left;
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        select {
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        button {
            padding: 12px 0;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            width: 48%;
        }

        /* Back Button */
        .back-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #4c4c4c;
            border: none;
            padding: 15px;
            border-radius: 50%;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <header>
        <img src="logo.png" alt="Logo SATE">
        <div>
            <h1>SATE</h1>
            <h2>SISTEM AKADEMIK TERPADU DAN EFISIEN</h2>
        </div>
    </header>

    <div class="container">
        <main>
            <h3>PENYUSUNAN JADWAL KULIAH</h3>
            <form action="{{ route('jadwalkuliah.store') }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <select id="kode_mk" name="kode_mk" required>
                    <option value="">Pilih Nama Mata kuliah</option>
                    @foreach ($matakuliah as $mk)
                        <option value="{{ $mk->kode_mk }}">{{ $mk->nama_mk }}</option>
                    @endforeach
                </select>

                <select id="kode_ruang" name="kode_ruang" required>
                    <option value="">Pilih Nama Ruang</option>
                    @foreach ($ruangperkuliahan as $rp)
                        <option value="{{ $rp->kode_ruang }}">{{ $rp->kode_ruang }}</option>
                    @endforeach
                </select>


                <select id="hari" name="hari" required>
                    <option value="">Daftar Hari</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                </select>

                <select id="jam" name="jam" required>
                    <option value="">Pilih Jam Mulai</option>
                    <option value="07:00">07:00</option>
                    <option value="09:00">09:00</option>
                    <option value="13:00">13:00</option>
                </select>



                <select id="nama_kelas" name="nama_kelas" required>
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $kelas)
                        <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>

                <div class="action-buttons">
                    <button type="submit">Simpan</button>
                    <button type="button">Lihat</button>
                </div>
            </form>
            <main>
    </div>

    <button class="back-btn" onclick="window.location.href='{{ route('ketuaprogramstudi') }}'">←</button>
</body>

</html>
