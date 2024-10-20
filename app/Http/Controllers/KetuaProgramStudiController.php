<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RuangPerkuliahan;
use Illuminate\Http\Request;
use App\Models\DosenPengampu;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;


class KetuaProgramStudiController extends Controller
{
    public function indexjadwalKuliah()
    {
        $jadwal = JadwalKuliah::with('matakuliah.dosenPengampu')->get();;
        // dd($jadwal[0]->toArray());
        // dd($jadwal->toArray());
        // foreach ($jadwal as $item) {
        //     echo '<pre>'; // Menambahkan <pre> agar output lebih rapi
        //     echo 'Mata Kuliah: ';
        //     print_r($item->mataKuliah ? $item->mataKuliah->toArray() : 'Mata Kuliah not available');

        //     echo 'Dosen Pengampu: ';
        //     print_r($item->mataKuliah && $item->mataKuliah->dosenPengampu ? $item->mataKuliah->dosenPengampu->toArray() : 'Dosen not available');
        //     echo '</pre>';
        // }
        return view('ketuaprogramstudi.lihatjadwalkuliah', compact('jadwal'));
    }
    public function createMemilihMataKuliah()
    {
        $dosenpengampu = DosenPengampu::all();
        return view('ketuaprogramstudi.memilihmatakuliah.create', compact('dosenpengampu'));
    }

    public function createJadwalKuliah()
    {
        $matakuliah = MataKuliah::all();
        $ruangperkuliahan = RuangPerkuliahan::all();
        $kelas = Kelas::all();
        return view('ketuaprogramstudi.jadwalkuliah', compact('matakuliah', 'ruangperkuliahan', 'kelas'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeMemilihMataKuliah(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_mk' => 'required|string|max:8|unique:matakuliah,kode_mk',
            'nama_mk' => 'required|string|max:50',
            'semester' => 'required|integer|min:1|max:8',
            'sks' => 'required|integer|min:1|max:6',
            'jenis' => 'required|string|max:10',
            'nidn_dosenpengampu' => 'required|exists:dosenpengampu,nidn_dosenpengampu', // Hapus exists
        ]);

        $dosen = DosenPengampu::where('nidn_dosenpengampu', $request->nidn_dosenpengampu)->first();

        if (!$dosen) {
            return redirect()->back()->withErrors(['nidn_dosenpengampu' => 'Dosen pengampu tidak ditemukan.']);
        }
        // Simpan data ke dalam tabel matakuliah
        MataKuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'jenis' => $request->jenis,
            'nidn_dosenpengampu' => $request->nidn_dosenpengampu,  // Menyimpan dosen pengampu
        ]);
        // dd($dosenpengampu);
        // Redirect ke halaman daftar mata kuliah dengan pesan sukses
        return redirect()->route('memilihmatakuliah.create')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function storeJadwalKuliah(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_mk' => 'required|exists:matakuliah,kode_mk',
            'kode_ruang' => 'required|exists:ruangperkuliahan,kode_ruang',
            'hari' => 'required|string|min:1|max:10',
            'jam' => 'required|date_format:H:i',
            'nama_kelas' => 'required|exists:kelas,nama_kelas',
        ]);

        // Ambil data mata kuliah berdasarkan kode_mk
        $mataKuliah = MataKuliah::where('kode_mk', $request->kode_mk)->first();

        // Cek apakah mata kuliah ditemukan
        if (!$mataKuliah) {
            return redirect()->back()->withErrors(['kode_mk' => 'Mata kuliah tidak ditemukan.']);
        }

        // Ambil nidn_dosenpengampu dari data mata kuliah yang ditemukan
        $nidn_dosenpengampu = $mataKuliah->nidn_dosenpengampu;

        // Pastikan nidn_dosenpengampu tidak null
        if (!$nidn_dosenpengampu) {
            return redirect()->back()->withErrors(['nidn_dosenpengampu' => 'Dosen pengampu tidak ditemukan.']);
        }

        // Cek apakah sudah ada jadwal dengan hari dan jam yang sama, dengan status 'disetujui' atau 'menunggu konfirmasi'
        $existingJadwal = JadwalKuliah::where('hari', $request->hari)
            ->where('jam', $request->jam)
            ->whereIn('status', ['disetujui', 'menunggu konfirmasi']) // Cek jadwal yang sudah disetujui atau menunggu konfirmasi
            ->first();

        // Cek apakah ada ruangan yang sudah digunakan pada hari dan jam yang sama, dengan status 'disetujui' atau 'menunggu konfirmasi'
        $ruangTerpakai = JadwalKuliah::where('kode_ruang', $request->kode_ruang)
            ->where('hari', $request->hari)
            ->where('jam', $request->jam)
            ->whereIn('status', ['disetujui', 'menunggu konfirmasi']) // Cek ruangan yang terpakai
            ->first();

        // Jika ada jadwal dengan status 'disetujui' atau 'menunggu konfirmasi' pada hari dan jam yang sama
        if ($existingJadwal) {
            return redirect()->back()->withErrors([
                'jadwal_conflict' => 'Tidak bisa menambahkan jadwal pada hari dan jam yang sama, karena sudah ada jadwal dengan status ' . $existingJadwal->status . '.'
            ]);
        }

        // Jika ruangan sudah terpakai pada hari dan jam yang sama dengan status 'disetujui' atau 'menunggu konfirmasi'
        if ($ruangTerpakai) {
            return redirect()->back()->withErrors([
                'ruangan_conflict' => 'Ruangan sudah terpakai pada hari dan jam yang sama oleh mata kuliah ' . $ruangTerpakai->kode_mk . ' dengan status ' . $ruangTerpakai->status . '.'
            ]);
        }

        // Simpan data jadwal kuliah
        JadwalKuliah::create([
            'kode_mk' => $request->kode_mk,
            'kode_ruang' => $request->kode_ruang,
            'hari' => $request->hari,
            'jam' => $request->jam,
            'nama_kelas' => $request->nama_kelas,
            'nidn_dosenpengampu' => $nidn_dosenpengampu, // Simpan dosen pengampu
        ]);

        // Redirect ke halaman daftar mata kuliah dengan pesan sukses
        return redirect()->route('jadwalkuliah.create')->with('success', 'Jadwal kuliah berhasil ditambahkan.');
    }


    public function indexMemilihMataKuliah()
    {
        $matakuliah = MataKuliah::all();
        return view('ketuaprogramstudi.memilihmatakuliah.index', compact('matakuliah'));
    }

    public function editMemilihMataKuliah($kode_mk)
    {
        $matakuliah = MataKuliah::where('kode_mk', $kode_mk)->first();
        $dosenpengampu = DosenPengampu::all();

        if (!$matakuliah) {
            return redirect()->route('memilihmatakuliah.index')->withErrors('Mata kuliah tidak ditemukan.');
        }

        return view('ketuaprogramstudi.memilihmatakuliah.edit', compact('matakuliah', 'dosenpengampu'));
    }

    public function updateMemilihMataKuliah(Request $request, $kode_mk)
    {
        // Validasi input
        $request->validate([
            'nama_mk' => 'required|string|max:50',
            'semester' => 'required|integer|min:1|max:8',
            'sks' => 'required|integer|min:1|max:6',
            'jenis' => 'required|string|max:10',
            'nidn_dosenpengampu' => 'required|exists:dosenpengampu,nidn_dosenpengampu',
        ]);

        $matakuliah = MataKuliah::where('kode_mk', $kode_mk)->first();

        if (!$matakuliah) {
            return redirect()->route('memilihmatakuliah.index')->withErrors('Mata kuliah tidak ditemukan.');
        }

        // Update data
        $matakuliah->update([
            'nama_mk' => $request->nama_mk,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'jenis' => $request->jenis,
            'nidn_dosenpengampu' => $request->nidn_dosenpengampu,
        ]);

        return redirect()->route('memilihmatakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroyMemilihMataKuliah($kode_mk)
    {
        $matakuliah = MataKuliah::where('kode_mk', $kode_mk)->first();

        if (!$matakuliah) {
            return redirect()->route('memilihmatakuliah.index')->withErrors('Mata kuliah tidak ditemukan.');
        }

        $matakuliah->delete();

        return redirect()->route('memilihmatakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
