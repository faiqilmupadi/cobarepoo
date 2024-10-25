<?php

namespace Database\Seeders;

use App\Models\Dekan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DekanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dekan::factory()->count(1)->create();
        // DB::table('dekan')->insert([
        //     'nidn_dekan' => '198101020000000418',
        //     'nama_dekan' => 'Dr. Aris Puji Widodo, S.Si, M.T', // Nama dekan mengikuti nama di user
        //     'email' => 'aris.widodo@lecturer.undip.ac.id', // Email mengikuti email di user
        //     'id_fakultas' => 1,
        // ]);
    }
}
