<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyakitGejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * CF Pakar values dari docs/sistem.md - Tabel Bobot Nilai CF Pakar
     */
    public function run(): void
    {
        $gemapKodToId = [];
        $gejalas = Gejala::all();
        foreach ($gejalas as $g) {
            $gemapKodToId[$g->kode] = $g->id;
        }

        $penyakitGejala = [
            // P01 - R1: G12 AND G18 AND G06 AND G07
            ['penyakit_id' => 1, 'gejala_kode' => 'G12', 'cf_pakar' => 1.0],
            ['penyakit_id' => 1, 'gejala_kode' => 'G18', 'cf_pakar' => 0.8],
            ['penyakit_id' => 1, 'gejala_kode' => 'G06', 'cf_pakar' => 0.6],
            ['penyakit_id' => 1, 'gejala_kode' => 'G07', 'cf_pakar' => 0.8],

            // P02 - R2: G13 AND G06 AND G07
            ['penyakit_id' => 2, 'gejala_kode' => 'G13', 'cf_pakar' => 1.0],
            ['penyakit_id' => 2, 'gejala_kode' => 'G06', 'cf_pakar' => 0.6],
            ['penyakit_id' => 2, 'gejala_kode' => 'G07', 'cf_pakar' => 0.8],

            // P03 - R3: G11 AND G06 AND G07
            ['penyakit_id' => 3, 'gejala_kode' => 'G11', 'cf_pakar' => 1.0],
            ['penyakit_id' => 3, 'gejala_kode' => 'G06', 'cf_pakar' => 0.6],
            ['penyakit_id' => 3, 'gejala_kode' => 'G07', 'cf_pakar' => 0.8],

            // P04 - R4: G12 AND G23 AND G06
            ['penyakit_id' => 4, 'gejala_kode' => 'G12', 'cf_pakar' => 1.0],
            ['penyakit_id' => 4, 'gejala_kode' => 'G23', 'cf_pakar' => 0.8],
            ['penyakit_id' => 4, 'gejala_kode' => 'G06', 'cf_pakar' => 0.6],

            // P05 - R5: G01 AND G10 AND G14 AND G22
            ['penyakit_id' => 5, 'gejala_kode' => 'G01', 'cf_pakar' => 1.0],
            ['penyakit_id' => 5, 'gejala_kode' => 'G10', 'cf_pakar' => 0.8],
            ['penyakit_id' => 5, 'gejala_kode' => 'G14', 'cf_pakar' => 0.8],
            ['penyakit_id' => 5, 'gejala_kode' => 'G22', 'cf_pakar' => 0.8],

            // P06 - R6: G23 AND G06 AND G09
            ['penyakit_id' => 6, 'gejala_kode' => 'G23', 'cf_pakar' => 1.0],
            ['penyakit_id' => 6, 'gejala_kode' => 'G06', 'cf_pakar' => 0.6],
            ['penyakit_id' => 6, 'gejala_kode' => 'G09', 'cf_pakar' => 0.6],

            // P07 - R7: G15 AND G24 AND G20
            ['penyakit_id' => 7, 'gejala_kode' => 'G15', 'cf_pakar' => 1.0],
            ['penyakit_id' => 7, 'gejala_kode' => 'G24', 'cf_pakar' => 0.8],
            ['penyakit_id' => 7, 'gejala_kode' => 'G20', 'cf_pakar' => 0.6],

            // P08 - R8: G09 AND G24 AND G20
            ['penyakit_id' => 8, 'gejala_kode' => 'G09', 'cf_pakar' => 1.0],
            ['penyakit_id' => 8, 'gejala_kode' => 'G24', 'cf_pakar' => 0.8],
            ['penyakit_id' => 8, 'gejala_kode' => 'G20', 'cf_pakar' => 0.6],

            // P09 - R9: G01 AND G02 AND G25
            ['penyakit_id' => 9, 'gejala_kode' => 'G01', 'cf_pakar' => 1.0],
            ['penyakit_id' => 9, 'gejala_kode' => 'G02', 'cf_pakar' => 0.8],
            ['penyakit_id' => 9, 'gejala_kode' => 'G25', 'cf_pakar' => 0.8],

            // P10 - R10: G05 AND G19 AND G25
            ['penyakit_id' => 10, 'gejala_kode' => 'G05', 'cf_pakar' => 1.0],
            ['penyakit_id' => 10, 'gejala_kode' => 'G19', 'cf_pakar' => 0.8],
            ['penyakit_id' => 10, 'gejala_kode' => 'G25', 'cf_pakar' => 0.8],
        ];

        foreach ($penyakitGejala as $pg) {
            $gejalaId = $gemapKodToId[$pg['gejala_kode']];
            DB::table('penyakit_gejala')->insert([
                'penyakit_id' => $pg['penyakit_id'],
                'gejala_id' => $gejalaId,
                'cf_pakar' => $pg['cf_pakar'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
