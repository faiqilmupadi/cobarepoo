<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Mengambil User yang belum memiliki relasi dengan Dosen, dengan email yang berakhiran @lecturer.undip.ac.id
        $user = User::where('email', 'like', '%@lecturer.undip.ac.id')
            ->whereDoesntHave('dosen') // Pastikan belum digunakan di tabel dosen
            ->inRandomOrder()
            ->first();

        return [
            'nidn' => $this->faker->unique()->numerify('198101020000000###'),
            'nama_dosen' => $user ? $user->name : $this->faker->name, // Menggunakan nama dari User, jika tidak ada, gunakan nama faker
            'email' => $user ? $user->email : null, // Menggunakan email dari User yang baru
            'id_programstudi' => 1,
            'id_fakultas' => 1,
        ];
    }
}
