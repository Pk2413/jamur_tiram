<?php

namespace App\Services;

use App\Models\Penyakit;
use App\Models\DiagnosisHistory;

class DiagnosisService
{
    protected $forwardChaining;
    protected $certaintyFactor;

    public function __construct(
        ForwardChainingService $forwardChaining,
        CertaintyFactorService $certaintyFactor
    ) {
        $this->forwardChaining = $forwardChaining;
        $this->certaintyFactor = $certaintyFactor;
    }

    /**
     * Orchestrate the diagnosis process.
     * 
     * @param array $selectedGejalaIds Array of IDs
     * @param array $cfUserMap Optional map of ID => CF User
     * @return array Resulting diagnosis data
     */
    public function diagnose(array $selectedGejalaIds, array $cfUserMap = []): array
    {
        // Step 1: Forward Chaining matching
        $matchingDiseases = $this->forwardChaining->findMatchingDiseases($selectedGejalaIds);

        $results = [];

        // Step 2: Certainty Factor calculation for each matching disease
        foreach ($matchingDiseases as $penyakit) {
            $cfValue = $this->certaintyFactor->calculateCF($penyakit->id, $selectedGejalaIds, $cfUserMap);
            $percentage = $this->certaintyFactor->toPercentage($cfValue);

            $results[] = [
                'penyakit' => $penyakit,
                'cf_value' => $cfValue,
                'percentage' => $percentage,
                'status' => $this->getConfidenceStatus($cfValue),
                'solusi' => $penyakit->solusi
            ];
        }

        // Step 3: Sort by percentage descending
        usort($results, function ($a, $b) {
            return $b['percentage'] <=> $a['percentage'];
        });

        return $results;
    }

    /**
     * Get confidence status string based on CF value.
     */
    public function getConfidenceStatus(float $cf): string
    {
        if ($cf >= 0.9) return "Sangat Yakin";
        if ($cf >= 0.8) return "Yakin";
        if ($cf >= 0.6) return "Cukup Yakin";
        if ($cf >= 0.4) return "Sedikit Yakin";
        return "Tidak Yakin";
    }

    /**
     * Save diagnosis history.
     */
    public function saveHistory(array $selectedGejalaIds, ?int $penyakitId, float $cfValue): DiagnosisHistory
    {
        return DiagnosisHistory::create([
            'gejala_terpilih' => $selectedGejalaIds,
            'hasil_penyakit_id' => $penyakitId,
            'confidence_level' => $cfValue
        ]);
    }
}
