<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approve Ruangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-color: #F0F0F0;
    }

    .header {
        background-color: #4CAF50;
        padding: 15px;
        color: white;
        text-align: left;
    }

    .search-box {
        margin-top: 20px;
        padding: 15px;
        background-color: white;
        border-radius: 5px;
    }

    .table-container {
        margin-top: 20px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #e9ecef;
    }
</style>

<body>
    <div class="header">
        <h4>SATE - Sistem Akademik Terpadu dan Efisien</h4>
    </div>

    <div class="container mt-4">
        <div class="search-box">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari Alokasi Ruang Perkuliahan"
                    aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i> <!-- Bootstrap Icons -->
                </button>
            </form>
        </div>
        <div class="table-container">
            <h4 class="mt-4">Daftar Alokasi Ruang Perkuliahan</h4>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Kode Ruang</th>
                        <th>ID Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach ($pengajuans_ruang as $pengajuanruang)
                        <tr>
                            <td>{{ $pengajuanruang->kode_ruang }}</td>
                            <td>{{ $pengajuanruang->programStudi->nama_programstudi }}</td>
                            <td>
                                @if ($pengajuanruang->status === 'disetujui')
                                    <span class="text-success">Disetujui</span>
                                @elseif ($pengajuanruang->status === 'ditolak')
                                    <span class="text-danger">Ditolak</span>
                                @else
                                    <form action="{{ route('pengajuan.updateruang', $pengajuanruang->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="action" value="setuju">
                                        <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                    </form>
                                    <form action="{{ route('pengajuan.updateruang', $pengajuanruang->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="action" value="tolak">
                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <!-- Menampilkan pengajuan yang ditolak dari session -->
                    @foreach (session('rejected_pengajuansruang', []) as $rejectedPengajuanruang)
                        <tr>
                            <td>{{ $rejectedPengajuanruang['kode_ruang'] }}</td>
                            <td>{{ $rejectedPengajuanruang['nama_programstudi'] }}</td>
                            <td><span class="text-danger">Ditolak</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
