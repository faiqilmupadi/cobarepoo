<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KetuaProgramStudiController;
use App\Http\Controllers\BagianAkademikController;
use App\Http\Controllers\DekanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('user.login', ['title' => 'Login']);
})->name('login');

// dashboard
Route::get('mahasiswa', function () {
    return view('mahasiswa.dashboard', ['title' => 'Mahasiswa']);
})->name('mahasiswa');

Route::get('ketuaprogramstudi', function () {
    return view('ketuaprogramstudi.dashboard', ['title' => 'ketuaprogramstudi']);
})->name('ketuaprogramstudi');

Route::get('dekan', function () {
    return view('dekan.dashboard', ['title' => 'dekan']);
})->name('dekan');

Route::get('bagianakademik', function () {
    return view('bagianakademik.dashboard', ['title' => 'bagianakademik']);
})->name('bagianakademik');

Route::get('pembimbingakademik', function () {
    return view('pembimbingakademik.dashboard', ['title' => 'pembimbingakademik']);
})->name('pembimbingakademik');

// pemilihan role
Route::get('pemilihanrole', function () {
    return view('user.pemilihanrole', ['title' => 'pemilihanrole']);
})->name('pemilihanrole');
Route::post('pemilihanrole', [UserController::class, 'handleRoleSelection'])->name('handleRoleSelection');

// bagian akademik penyusunan ruang
Route::get('bagianakademik/penyusunanruang', [BagianAkademikController::class, 'createPenyusunanRuang'])->name('penyusunanruang.create');
Route::post('penyusunanruang', [BagianAkademikController::class, 'storePenyusunanRuang'])->name('penyusunanruang.store');
// Route::get('lihatpenyusunanruang', function () {
//     return view('bagianakademik.lihatpenyusunanruang', ['title' => 'lihatpenyusunanruang']);
// })->name('lihatpenyusunanruang');
Route::get('penyusunanruang/index', [BagianAkademikController::class, 'indexPenyusunanRuang'])->name('penyusunanruang.index');
Route::get('penyusunanruang/{kode_ruang}/edit', [BagianAkademikController::class, 'editPenyusunanRuang'])->name('penyusunanruang.edit');
Route::put('penyusunanruang/{kode_ruang}', [BagianAkademikController::class, 'updatePenyusunanRuang'])->name('penyusunanruang.update');
Route::delete('penyusunanruang/{kode_ruang}', [BagianAkademikController::class, 'destroyPenyusunanRuang'])->name('penyusunanruang.destroy');

// bagian akademik pengalokasian ruang
Route::get('bagianakademik/pengalokasianruang', [BagianAkademikController::class, 'createPengalokasianRuang'])->name('pengalokasianruang.create');
Route::post('pengalokasianruang', [BagianAkademikController::class, 'storePengalokasianRuang'])->name('pengalokasianruang.store');
Route::get('bagianakademik/pengalokasianruang/lihat', [BagianAkademikController::class, 'indexPengalokasianRuang'])->name('pengalokasianruang.lihat');

// dekan menyetujui ruangan
Route::get('/dekan/approve-ruang', [DekanController::class, 'createPengajuanRuang'])->name('dekan.approveruang');
Route::patch('/pengajuan/update/{id}', [DekanController::class, 'updatePengajuanRuang'])->name('pengajuan.updateruang');

//dekan menyetujui jadwal
Route::get('/dekan/approve-jadwal', [DekanController::class, 'createPengajuanJadwal'])->name('dekan.approvejadwal');
Route::patch('/dekan/update-pengajuan/{id}', [DekanController::class, 'updatePengajuanJadwal'])->name('pengajuan.updatejadwal');

//kaprodi menyusun matakuliah
// Route::get('memilihmatakuliah', function () {
//     return view('ketuaprogramstudi.memilihmatakuliah', ['title' => 'memilihmatakuliah']);
// })->name('memilihmatakuliah');
Route::get('memilihmatakuliah/create', [KetuaProgramStudiController::class, 'createMemilihMataKuliah'])->name('memilihmatakuliah.create');
Route::post('memilihmatakuliah', [KetuaProgramStudiController::class, 'storeMemilihMataKuliah'])->name('memilihmatakuliah.store');
Route::get('/memilihmatakuliah', [KetuaProgramStudiController::class, 'indexMemilihMataKuliah'])->name('memilihmatakuliah.index');
Route::get('memilihmatakuliah/{kode_mk}/edit', [KetuaProgramStudiController::class, 'editMemilihMataKuliah'])->name('memilihmatakuliah.edit');
Route::put('memilihmatakuliah/{kode_mk}', [KetuaProgramStudiController::class, 'updateMemilihMataKuliah'])->name('memilihmatakuliah.update');
Route::delete('memilihmatakuliah/{kode_mk}', [KetuaProgramStudiController::class, 'destroyMemilihMataKuliah'])->name('memilihmatakuliah.destroy');

//kaprodi jadwal kuliah
Route::get('JadwalKuliah', [KetuaProgramStudiController::class, 'createJadwalKuliah'])->name('jadwalkuliah.create');
Route::post('JadwalKuliah', [KetuaProgramStudiController::class, 'storeJadwalKuliah'])->name('jadwalkuliah.store');
Route::get('Ketuaprogramstudi/jadwalkuliah/lihatjadwalkuliah', [KetuaProgramStudiController::class, 'indexjadwalKuliah'])->name('lihatjadwalkuliah.lihat');
// login
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');


