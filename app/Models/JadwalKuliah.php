<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $table = 'jadwalkuliah';

    
    public $incrementing = true;

    protected $fillable = [
        'kode_mk',
        'kode_ruang',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'nama_mk',
        'jenis',
        'semester',
        'sks',
        'nama_kelas',
        'nidn_dosenpengampu',
        'status',
    ];

    // Relasi dengan Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'nama_kelas', 'nama_kelas');
    }

    // Relasi dengan Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }

    // Relasi dengan Ruang Perkuliahan
    public function ruangPerkuliahan()
    {
        return $this->belongsTo(RuangPerkuliahan::class, 'kode_ruang', 'kode_ruang');
    }
}