<?php

namespace Database\Seeders;
use App\Models\Ketuaprogramstudi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KetuaProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ketuaprogramstudi::factory()->count(2)->create();
        DB::table('ketuaprogramstudi')->insert([
            'nidn_ketuaprogramstudi' => '198101020000000800', 
            'nama_ketuaprogramstudi' => 'Dinar Mutiara K N, S.T., M.InfoTech.(Comp)., Ph.D.', 
            'id_programstudi' => 1, 
            'email' => 'aris.sugiharto@lecturer.undip.ac.id', 
            'id_fakultas' => 1, 
        ]);
    }
}
