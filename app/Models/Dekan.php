<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dekan extends Model
{
    use HasFactory;

    protected $table = 'dekan';
    protected $primaryKey = 'nidn_dekan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nidn_dekan',
        'nama_dekan',
        'email',
        'id_fakultas',
    ];
    /*
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

   public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dekan', 'nidn');
    }
}