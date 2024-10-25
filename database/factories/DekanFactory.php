<?php

namespace Database\Factories;

use App\Models\Dekan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dekan>
 */
class DekanFactory extends Factory
{

    protected $model = Dekan::class;

    public function definition(): array
    {
        // Ambil user secara acak dari tabel User
        // $user = User::inRandomOrder()->first();
        $user = User::where('email', 'like', '%kurniawan@lecturer.undip.ac.id')->inRandomOrder()->first();

        return [
            'nidn_dekan' => $this->faker->unique()->numerify('198101020000000597'), // NIDN dekan unik
            'nama_dekan' => $user->name, // Nama dekan mengikuti nama di user
            'email' => $user->email, // Email mengikuti email di user
            'id_fakultas' => 1, // Set fakultas ke ID 1
        ];
    }
}
