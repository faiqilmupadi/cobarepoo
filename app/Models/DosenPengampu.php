<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPengampu extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dosenpengampu';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nidn_dosenpengampu';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nidn_dosenpengampu',
        'nama_dosenpengampu',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function matakuliah(){
        return $this->hasMany(MataKuliah::class, 'nidn_dosenpengampu', 'nidn_dosenpengampu');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn_dosenpengampu', 'nidn');
    }
}