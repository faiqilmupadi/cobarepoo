<?php

namespace Database\Factories;

use App\Models\DosenPengampu;
use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DosenPengampu>
 */
class DosenPengampuFactory extends Factory
{

    protected $model = DosenPengampu::class;

    public function definition(): array
    {
        // Mengambil dosen yang belum memiliki relasi dengan PembimbingAkademik (berdasarkan nidn)
        $dosen = Dosen::whereDoesntHave('dosenpengampu') // Pastikan dosen belum ada di tabel PembimbingAkademik
            ->inRandomOrder()
            ->first();

        // Jika tidak ada dosen yang tersedia, bisa mengembalikan nilai default atau menangani null case
        if (!$dosen) {
            return [];
        }

        return [
            'nidn_dosenpengampu' => $dosen->nidn, // NIDN unik dari dosen
            'nama_dosenpengampu' => $dosen->nama_dosen, // Nama dosen yang diambil dari tabel Dosen
        ];
    }
}
