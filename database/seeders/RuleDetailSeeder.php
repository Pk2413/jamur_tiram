<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gemapKodToId = [];
        $gejalas = Gejala::all();
        foreach ($gejalas as $g) {
            $gemapKodToId[$g->kode] = $g->id;
        }

        $ruleDetails = [
            // R1: G12 AND G18 AND G06 AND G07
            ['rule_id' => 1, 'gejala_kode' => 'G12', 'urutan' => 1],
            ['rule_id' => 1, 'gejala_kode' => 'G18', 'urutan' => 2],
            ['rule_id' => 1, 'gejala_kode' => 'G06', 'urutan' => 3],
            ['rule_id' => 1, 'gejala_kode' => 'G07', 'urutan' => 4],

            // R2: G13 AND G06 AND G07
            ['rule_id' => 2, 'gejala_kode' => 'G13', 'urutan' => 1],
            ['rule_id' => 2, 'gejala_kode' => 'G06', 'urutan' => 2],
            ['rule_id' => 2, 'gejala_kode' => 'G07', 'urutan' => 3],

            // R3: G11 AND G06 AND G07
            ['rule_id' => 3, 'gejala_kode' => 'G11', 'urutan' => 1],
            ['rule_id' => 3, 'gejala_kode' => 'G06', 'urutan' => 2],
            ['rule_id' => 3, 'gejala_kode' => 'G07', 'urutan' => 3],

            // R4: G12 AND G23 AND G06
            ['rule_id' => 4, 'gejala_kode' => 'G12', 'urutan' => 1],
            ['rule_id' => 4, 'gejala_kode' => 'G23', 'urutan' => 2],
            ['rule_id' => 4, 'gejala_kode' => 'G06', 'urutan' => 3],

            // R5: G01 AND G10 AND G14 AND G22
            ['rule_id' => 5, 'gejala_kode' => 'G01', 'urutan' => 1],
            ['rule_id' => 5, 'gejala_kode' => 'G10', 'urutan' => 2],
            ['rule_id' => 5, 'gejala_kode' => 'G14', 'urutan' => 3],
            ['rule_id' => 5, 'gejala_kode' => 'G22', 'urutan' => 4],

            // R6: G23 AND G06 AND G09
            ['rule_id' => 6, 'gejala_kode' => 'G23', 'urutan' => 1],
            ['rule_id' => 6, 'gejala_kode' => 'G06', 'urutan' => 2],
            ['rule_id' => 6, 'gejala_kode' => 'G09', 'urutan' => 3],

            // R7: G15 AND G24 AND G20
            ['rule_id' => 7, 'gejala_kode' => 'G15', 'urutan' => 1],
            ['rule_id' => 7, 'gejala_kode' => 'G24', 'urutan' => 2],
            ['rule_id' => 7, 'gejala_kode' => 'G20', 'urutan' => 3],

            // R8: G09 AND G24 AND G20
            ['rule_id' => 8, 'gejala_kode' => 'G09', 'urutan' => 1],
            ['rule_id' => 8, 'gejala_kode' => 'G24', 'urutan' => 2],
            ['rule_id' => 8, 'gejala_kode' => 'G20', 'urutan' => 3],

            // R9: G01 AND G02 AND G25
            ['rule_id' => 9, 'gejala_kode' => 'G01', 'urutan' => 1],
            ['rule_id' => 9, 'gejala_kode' => 'G02', 'urutan' => 2],
            ['rule_id' => 9, 'gejala_kode' => 'G25', 'urutan' => 3],

            // R10: G05 AND G19 AND G25
            ['rule_id' => 10, 'gejala_kode' => 'G05', 'urutan' => 1],
            ['rule_id' => 10, 'gejala_kode' => 'G19', 'urutan' => 2],
            ['rule_id' => 10, 'gejala_kode' => 'G25', 'urutan' => 3],
        ];

        foreach ($ruleDetails as $detail) {
            $gejalaId = $gemapKodToId[$detail['gejala_kode']];
            DB::table('rule_detail')->insert([
                'rule_id' => $detail['rule_id'],
                'gejala_id' => $gejalaId,
                'urutan' => $detail['urutan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
