<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'program_studi';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_programstudi';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_programstudi',
        'nama_programstudi',
        'id_fakultas',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Relationship with Fakultas model.
     */
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id_fakultas');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_programstudi', 'id_programstudi');
    }

    public function pengalokasianruang()
    {
        return $this->hasMany(PengalokasianRuang::class, 'id_programstudi', 'id_programstudi');
    }
}

// // Mengambil data program studi dan fakultas terkait
// $programStudi = ProgramStudi::find(1);

// if ($programStudi) {
//     echo 'Nama Program Studi: ' . $programStudi->nama_programstudi . PHP_EOL;
//     echo 'Nama Fakultas: ' . $programStudi->fakultas->nama_fakultas . PHP_EOL;
// } else {
//     echo 'Program studi tidak ditemukan.' . PHP_EOL;
// }