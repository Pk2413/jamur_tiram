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
     * Menghitung CF dengan detail perhitungan untuk keperluan logging/debugging.
     * 
     * @param int $penyakitId
     * @param array $selectedGejalaIds
     * @param array $cfUserMap
     * @return array Berisi cf_value, cf_percentage, dan calculation_details
     */
    public function calculateCFWithDetails(int $penyakitId, array $selectedGejalaIds, array $cfUserMap = []): array
    {
        // Ambil mapping CF Pakar dari pivot table penyakit_gejala
        $mappings = DB::table('penyakit_gejala')
            ->where('penyakit_id', $penyakitId)
            ->whereIn('gejala_id', $selectedGejalaIds)
            ->join('gejala', 'penyakit_gejala.gejala_id', '=', 'gejala.id')
            ->select('penyakit_gejala.*', 'gejala.kode as gejala_kode', 'gejala.nama as gejala_nama')
            ->get();

        if ($mappings->isEmpty()) {
            return [
                'cf_value' => 0.0,
                'cf_percentage' => 0,
                'has_matching_symptoms' => false,
                'calculation_details' => 'Tidak terdapat gejala yang sesuai, sehingga tidak dilakukan perhitungan Certainty Factor.'
            ];
        }

        $cfHeList = [];
        $cfHeDetails = [];

        foreach ($mappings as $mapping) {
            $cfUser = $cfUserMap[$mapping->gejala_id] ?? 0.8;
            $cfHe = $mapping->cf_pakar * $cfUser;
            $cfHeList[] = $cfHe;
            
            $cfHeDetails[] = [
                'gejala_kode' => $mapping->gejala_kode,
                'gejala_nama' => $mapping->gejala_nama,
                'cf_pakar' => $mapping->cf_pakar,
                'cf_user' => $cfUser,
                'cf_he' => $cfHe
            ];
        }

        if (empty($cfHeList)) {
            return [
                'cf_value' => 0.0,
                'cf_percentage' => 0,
                'has_matching_symptoms' => false,
                'calculation_details' => 'Tidak terdapat gejala yang sesuai, sehingga tidak dilakukan perhitungan Certainty Factor.'
            ];
        }

        // CF Combine process
        $cfCombine = $cfHeList[0];
        $combineSteps = [];

        if (count($cfHeList) === 1) {
            // Single symptom - no combination needed
            $combineSteps[] = [
                'step' => 1,
                'formula' => sprintf("CF(H,E) × 100%% = %.2f × 100%% = %.1f%%", $cfHeList[0], $cfHeList[0] * 100),
                'result' => $cfHeList[0]
            ];
        } else {
            // Multiple symptoms - combine them
            $combineSteps[] = [
                'step' => 1,
                'formula' => sprintf("CF_1 = %.2f", $cfHeList[0]),
                'result' => $cfHeList[0]
            ];

            for ($i = 1; $i < count($cfHeList); $i++) {
                $cfNext = $cfHeList[$i];
                $previousCf = $cfCombine;
                $cfCombine = $cfCombine + $cfNext * (1 - $cfCombine);
                
                $combineSteps[] = [
                    'step' => $i + 1,
                    'formula' => sprintf(
                        "CF_combine = %.2f + %.2f × (1 - %.2f) = %.2f + %.2f × %.2f = %.2f + %.5f = %.5f",
                        $previousCf,
                        $cfNext,
                        $previousCf,
                        $previousCf,
                        $cfNext,
                        (1 - $previousCf),
                        $previousCf,
                        $cfNext * (1 - $previousCf),
                        $cfCombine
                    ),
                    'result' => $cfCombine
                ];
            }
        }

        return [
            'cf_value' => $cfCombine,
            'cf_percentage' => $this->toPercentageInt($cfCombine),
            'cf_percentage_float' => round($cfCombine * 100, 2),
            'has_matching_symptoms' => true,
            'matching_symptoms_count' => count($cfHeList),
            'symptoms_detail' => $cfHeDetails,
            'combine_steps' => $combineSteps
        ];
    }

    /**
     * Konversi nilai CF ke persentase (0-100) dengan desimal 2 tempat.
     */
    public function toPercentage(float $cf): float
    {
        return round($cf * 100, 2);
    }

    /**
     * Konversi nilai CF ke persentase integer (rounded ke bilangan bulat terdekat).
     * Contoh: 87.2 → 87, 93.344 → 93
     */
    public function toPercentageInt(float $cf): int
    {
        return (int) round($cf * 100);
    }
}
