<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            ['kode' => 'R1', 'penyakit_id' => 1, 'kondisi_format' => 'G12 AND G18 AND G06 AND G07', 'jumlah_gejala' => 4],
            ['kode' => 'R2', 'penyakit_id' => 2, 'kondisi_format' => 'G13 AND G06 AND G07', 'jumlah_gejala' => 3],
            ['kode' => 'R3', 'penyakit_id' => 3, 'kondisi_format' => 'G11 AND G06 AND G07', 'jumlah_gejala' => 3],
            ['kode' => 'R4', 'penyakit_id' => 4, 'kondisi_format' => 'G12 AND G23 AND G06', 'jumlah_gejala' => 3],
            ['kode' => 'R5', 'penyakit_id' => 5, 'kondisi_format' => 'G01 AND G10 AND G14 AND G22', 'jumlah_gejala' => 4],
            ['kode' => 'R6', 'penyakit_id' => 6, 'kondisi_format' => 'G23 AND G06 AND G09', 'jumlah_gejala' => 3],
            ['kode' => 'R7', 'penyakit_id' => 7, 'kondisi_format' => 'G15 AND G24 AND G20', 'jumlah_gejala' => 3],
            ['kode' => 'R8', 'penyakit_id' => 8, 'kondisi_format' => 'G09 AND G24 AND G20', 'jumlah_gejala' => 3],
            ['kode' => 'R9', 'penyakit_id' => 9, 'kondisi_format' => 'G01 AND G02 AND G25', 'jumlah_gejala' => 3],
            ['kode' => 'R10', 'penyakit_id' => 10, 'kondisi_format' => 'G05 AND G19 AND G25', 'jumlah_gejala' => 3],
        ];

        foreach ($rules as $rule) {
            Rule::create($rule);
        }
    }
}
