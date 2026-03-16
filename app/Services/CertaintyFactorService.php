<?php

namespace App\Services;

use App\Models\Penyakit;
use Illuminate\Support\Facades\DB;

class CertaintyFactorService
{
    /**
     * Menghitung nilai Certainty Factor untuk suatu penyakit berdasarkan gejala yang dipilih.
     * 
     * Formula:
     * CF[H,E] = CF[E] * CF[H,E] (CF user * CF pakar)
     * CF_combine(CF1, CF2) = CF1 + CF2 * (1 - CF1)
     * 
     * @param int $penyakitId
     * @param array $selectedGejalaIds Array IDs of gejala
     * @param array $cfUserMap Map of Gejala ID => CF User (defaulting to 0.8 if not provided)
     * @return float Hasil perhitungan CF (skala 0-1)
     */
    public function calculateCF(int $penyakitId, array $selectedGejalaIds, array $cfUserMap = []): float
    {
        // Ambil mapping CF Pakar dari pivot table penyakit_gejala
        $mappings = DB::table('penyakit_gejala')
            ->where('penyakit_id', $penyakitId)
            ->whereIn('gejala_id', $selectedGejalaIds)
            ->get();

        if ($mappings->isEmpty()) {
            return 0.0;
        }

        $cfHeList = [];

        foreach ($mappings as $mapping) {
            // CF User dari input atau default 0.8 per requirement IMPLEMENTATION_TIMELINE.md
            $cfUser = $cfUserMap[$mapping->gejala_id] ?? 0.8;

            // Formula 1: CF[H,E] = CF pakar * CF user
            $cfHe = $mapping->cf_pakar * $cfUser;
            $cfHeList[] = $cfHe;
        }

        if (empty($cfHeList)) {
            return 0.0;
        }

        // Formula 2: CF Combine
        $cfCombine = $cfHeList[0];

        for ($i = 1; $i < count($cfHeList); $i++) {
            $cfNext = $cfHeList[$i];
            $cfCombine = $cfCombine + $cfNext * (1 - $cfCombine);
        }

        return $cfCombine;
    }

    /**
     * Konversi nilai CF ke persentase (0-100).
     */
    public function toPercentage(float $cf): float
    {
        return round($cf * 100, 2);
    }
}
