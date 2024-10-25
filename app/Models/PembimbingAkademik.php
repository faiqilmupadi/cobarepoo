<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembimbingAkademik extends Model
{
    use HasFactory;
    
    protected $table = 'pembimbingakademik';

    protected $primaryKey = 'nidn_pembimbingakademik'; // Primary key adalah NIDN Pembimbing Akademik

    public $incrementing = false;

    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable = [
        'nidn_pembimbingakademik', 
        'nama_pembimbingakademik', 
        'email', 
        'id_programstudi', 
        'id_fakultas'
    ];

    /**
     * Relasi belongs-to dengan User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    /**
     * Relasi belongs-to dengan Fakultas.
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id_fakultas');
    }

    /**
     * Relasi belongs-to dengan ProgramStudi.
     */
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_programstudi', 'id_programstudi');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nidn_pembimbingakademik', 'nidn_pembimbingakademik');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn_pembimbingakademik', 'nidn');
    }
}
