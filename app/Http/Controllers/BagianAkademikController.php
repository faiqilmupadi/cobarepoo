<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\RuangPerkuliahan;
use App\Models\PengalokasianRuang;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class BagianAkademikController extends Controller
{
    public function indexPenyusunanRuang()
    {
        $ruangPerkuliahan = RuangPerkuliahan::all(); // Mengambil semua data ruang perkuliahan
        return view('bagianakademik.lihatpenyusunanruang', compact('ruangPerkuliahan'));
    }
    public function indexPengalokasianRuang()
    {
        $alokasiRuang = PengalokasianRuang::all(); 
        // $alokasiRuang = PengalokasianRuang::with('programStudi')->get(); 
        // $rejectedPengajuansruang = session('rejected_pengajuansruang', []); 

        return view('bagianakademik.lihatpengalokasianruang', compact('alokasiRuang'));
        // return view('bagianakademik.lihatpengalokasianruang', compact('alokasiRuang', 'rejectedPengajuansruang'));
    }
    public function createPenyusunanRuang()
    {
        return view('bagianakademik.penyusunanruang');
    }

    // Menampilkan form penyusunan ruang
    public function createPengalokasianRuang()
    {
        // Mengambil data dari tabel ruangperkuliahan dan program_studi
        $ruangPerkuliahan = RuangPerkuliahan::all();
        $programStudi = ProgramStudi::all();

        return view('bagianakademik.pengalokasianruang', compact('ruangPerkuliahan', 'programStudi'));
    }
    // Method untuk menyimpan data
    public function storePenyusunanRuang(Request $request)
    {

        Session::flash('kode_ruang', $request->kode_ruang);
        Session::flash('gedung', $request->gedung);
        Session::flash('kapasitas', $request->kapasitas);

        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'kode_ruang' => 'required|string|max:25|unique:ruangperkuliahan,kode_ruang',
                    'gedung' => 'required|string|max:50',
                    'kapasitas' => 'required|integer',
                ],
                [
                    'kode_ruang.required' => 'Kode ruang wajib diisi',
                    'kode_ruang.unique' => 'Kode ruang sudah ada di database',
                    'gedung.required' => 'Gedung wajib diisi',
                    'kapasitas.required' => 'Kapasitas wajib diisi',
                ]
            );
            // Simpan data ke tabel ruangperkuliahan
            RuangPerkuliahan::create([
                'kode_ruang' => $validatedData['kode_ruang'],
                'gedung' => $validatedData['gedung'],
                'kapasitas' => $validatedData['kapasitas'],
            ]);

            // Redirect setelah sukses
            return redirect()->route('penyusunanruang.create')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


    // Menyimpan data pengalokasian ruang ke tabel
    public function storePengalokasianRuang(Request $request)
    {
        Session::flash('kode_ruang', $request->kode_ruang);
        Session::flash('id_programstudi', $request->id_programstudi);

        try {
            $validatedData = $request->validate(
                [
                    'kode_ruang' => 'required|string|exists:ruangperkuliahan,kode_ruang',
                    'id_programstudi' => 'required|integer|exists:program_studi,id_programstudi',
                ],
                [
                    'kode_ruang.required' => 'Kode ruang wajib diisi',
                    'id_programstudi.required' => 'Program studi wajib diisi',
                ]
            );

            // Menyimpan data ke tabel pengalokasianruang
            PengalokasianRuang::create([
                'kode_ruang' => $validatedData['kode_ruang'],
                'id_programstudi' => $validatedData['id_programstudi'],
            ]);

            return redirect()->route('pengalokasianruang.create')->with('successAjukan', 'Pengalokasian ruang telah diajukan ke dekan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit(string $kode_ruang)
    {
        $ruangPerkuliahan = RuangPerkuliahan::findOrFail($kode_ruang);
        return view('bagianakademik.editpenyusunanruang', compact('ruangPerkuliahan'));
    }

    public function update(Request $request, string $kode_ruang)
    {

        $validatedData = $request->validate(
            [
                'gedung' => 'required|string|max:50',
                'kapasitas' => 'required|integer',
            ],
            [
                'gedung.required' => 'Gedung wajib diisi',
                'kapasitas.required' => 'Kapasitas wajib diisi',
            ]
        );
        // Simpan data ke tabel ruangperkuliahan
        $ruangPerkuliahan = ([
            'gedung' => $validatedData['gedung'],
            'kapasitas' => $validatedData['kapasitas'],
        ]);

        RuangPerkuliahan::where('kode_ruang', $kode_ruang)->update($ruangPerkuliahan);
        // Redirect setelah sukses
        return redirect()->route('penyusunanruang.lihat')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $kode_ruang)
    {
        RuangPerkuliahan::where('kode_ruang', $kode_ruang)->delete();
        return redirect()->route('penyusunanruang.lihat')->with('success', 'Data berhasil dihapus');
    }
}
