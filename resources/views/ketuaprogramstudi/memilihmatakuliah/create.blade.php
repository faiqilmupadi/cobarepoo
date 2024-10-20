<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATE - Sistem Akademik Terpadu dan Efisien</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 50px auto 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            border-radius: 8px;
        }

        header {
            display: flex;
            align-items: center;
            background-color: #5c6f3d;
            padding: 15px;
            border-radius: 8px 8px 0 0;
        }

        header img {
            height: 60px;
            margin-right: 20px;
        }

        header h1 {
            font-size: 28px;
            color: white;
            margin: 0;
            font-weight: 600;
        }

        header h2 {
            font-size: 16px;
            color: white;
            margin: 0;
        }

        main {
            margin-top: 30px;
            text-align: center;
        }

        h3 {
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: left;
            width: 100%;
            max-width: 500px;
        }

        input,
        select {
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 500px;
            font-size: 16px;
            color: #333;
        }

        button[type="submit"] {
            padding: 12px 25px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            color: white;
            width: 100%;
            max-width: 500px;
        }

        button[type="lihat"] {
            padding: 12px 25px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            color: white;
            width: 100%;
            max-width: 500px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-btn {
            position: fixed;
            bottom: 30px;
            left: 30px;
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
            <h3>PENYUSUNAN MATA KULIAH</h3>
            <form action="{{ route('memilihmatakuliah.store') }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label for="kode_mk">Kode Mata Kuliah</label>
                <input id="kode_mk" type="text" name="kode_mk" placeholder="Masukkan kode mata kuliah" required>

                <label for="nama_mk">Nama Mata Kuliah</label>
                <input id="nama_mk" type="text" name="nama_mk" placeholder="Masukkan nama mata kuliah" required>

                <label for="semester">Semester</label>
                <input id="semester" type="number" name="semester" placeholder="Masukkan semester" required>

                <label for="sks">Jumlah SKS</label>
                <input id="sks" type="number" name="sks" placeholder="Masukkan jumlah SKS" required>

                <label for="jenis">Jenis</label>
                <select class="form-control" id="jenis" name="jenis" required>
                    <option value="">Pilih jenis Mata kuliah</option>
                    <option value="Wajib">Wajib</option>
                    <option value="Pilihan">Pilihan</option>
                </select>

                <label for="nidn_dosenpengampu">Dosen Pengampu</label>
                <select id="nidn_dosenpengampu" name="nidn_dosenpengampu" required>
                    <option value="">Pilih Nama Dosen Pengampu</option>
                    @foreach ($dosenpengampu as $dosen)
                        <option value="{{ $dosen->nidn_dosenpengampu }}">{{ $dosen->nama_dosenpengampu }}</option>
                    @endforeach
                </select>

                <button type="submit">Simpan Mata Kuliah</button>
            </form>
            <button type="Lihat" onclick="window.location.href='{{ route('memilihmatakuliah.index') }}'">lihat Mata
                Kuliah </button>
        </main>
    </div>

    <button class="back-btn" onclick="window.location.href='{{ route('ketuaprogramstudi') }}'">←</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
