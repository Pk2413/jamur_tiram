<?php

namespace App\Services;

use App\Models\Rule;
use App\Models\Penyakit;
use Illuminate\Support\Facades\DB;

class ForwardChainingService
{
    /**
     * Mencari penyakit berdasarkan gejala.
     * Jika tidak ada rule yang cocok persis (100% gejala terpenuhi),
     * kita fallback untuk mengambil semua penyakit yang memiliki SETIDAKNYA SATU gejala yang dipilih
     * agar Certainty Factor bisa menghitung probabilitasnya.
     * 
     * @param array $selectedGejalaIds Array ID gejala yang dipilih user
     * @return array Array of Penyakit models
     */
    public function findMatchingDiseases(array $selectedGejalaIds): array
    {
        $matchingPenyakitIds = [];

        // 1. Coba cari yang MATCH PERSIS dengan Rule (Forward Chaining)
        $rules = Rule::all();
        foreach ($rules as $rule) {
            if ($rule->matches($selectedGejalaIds)) {
                $matchingPenyakitIds[] = $rule->penyakit_id;
            }
        }

        // 2. Jika tidak ada rule yang match persis, ambil semua penyakit yang berhubungan 
        // dengan salah satu gejala yang diinput (agar CF bisa bekerja)
        if (empty($matchingPenyakitIds)) {
            $matchingPenyakitIds = DB::table('penyakit_gejala')
                ->whereIn('gejala_id', $selectedGejalaIds)
                ->pluck('penyakit_id')
                ->toArray();
        }

        return Penyakit::whereIn('id', array_unique($matchingPenyakitIds))->get()->all();
    }
}
