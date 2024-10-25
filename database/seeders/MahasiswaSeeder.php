<?php

namespace Database\Seeders;
use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $mahasiswa = new Mahasiswa;
        // $mahasiswa -> nim = '24060122130076';
        // $mahasiswa -> nama = 'Azzam Saefudin Rosyidi';
        // $mahasiswa -> email = 'azzamsaefudinrosyidi@students.undip.ac.id';
        // $mahasiswa -> semester = 7;
        // $mahasiswa -> save();
        Mahasiswa::factory()->count(30)->create();
        DB::table('mahasiswa')->insert([
            'nim' => '24060122130076', 
            'nama_mahasiswa' => 'AZZAM SAEFUDIN ROSYIDI', 
            'semester' => 5, 
            'email' => 'azzam.saefudin@students.undip.ac.id', 
            'nidn_pembimbingakademik' => '198101020000000597',
            'id_programstudi' => 1, 
            'id_fakultas' => 1, 
        ]);
        
    }
}
