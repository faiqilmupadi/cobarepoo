@extends('layout.template')

@section('content')
    <div class="container">
        <h3>Daftar Mata Kuliah</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode MK</th>
                    <th>Nama MK</th>
                    <th>Semester</th>
                    <th>SKS</th>
                    <th>Jenis</th>
                    <th>Dosen Pengampu</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matakuliah as $mk)
                    <tr>
                        <td>{{ $mk->kode_mk }}</td>
                        <td>{{ $mk->nama_mk }}</td>
                        <td>{{ $mk->semester }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td>{{ $mk->jenis }}</td>
                        <td>{{ $mk->dosenpengampu->nama_dosenpengampu }}</td>
                        <td>
                            <a href="{{ route('memilihmatakuliah.edit', $mk->kode_mk) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('memilihmatakuliah.destroy', $mk->kode_mk) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="btn-container">
        <button type="button" class="btn btn-outline-secondary"
            onclick="window.location.href='{{ route('memilihmatakuliah.create') }}'">←</button>
    </div>
@endsection
