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
     * Flow: Forward Chaining (filter) → Decision Tree (reasoning) → Certainty Factor (confidence)
     * 
     * @param array $selectedGejalaIds Array of IDs
     * @param array $cfUserMap Optional map of ID => CF User
     * @return array Resulting diagnosis data with reasoning
     */
    public function diagnose(array $selectedGejalaIds, array $cfUserMap = []): array
    {
        $results = [];

        // Step 1: Forward Chaining - Filter penyakit yang mungkin berdasarkan rules
        $matchingDiseases = $this->forwardChaining->findMatchingDiseases($selectedGejalaIds);
        
        if (empty($matchingDiseases)) {
            return [];
        }

        // Step 2: Decision Tree - Traverse untuk mendapatkan reasoning path
        $decisionTreePaths = $this->forwardChaining->traverseDecisionTree($selectedGejalaIds);

        // Step 3: Certainty Factor - Hitung confidence untuk setiap penyakit yang matched
        foreach ($matchingDiseases as $penyakit) {
            $cfValue = $this->certaintyFactor->calculateCF($penyakit->id, $selectedGejalaIds, $cfUserMap);
            $cfPercentage = $this->certaintyFactor->toPercentage($cfValue);

            // Cari decision tree path yang relevan dengan penyakit ini
            $relatedPaths = array_filter($decisionTreePaths, function ($path) use ($penyakit) {
                return in_array($penyakit->id, $path['possible_penyakit_ids']);
            });

            $results[] = [
                'penyakit' => $penyakit,
                'cf_value' => $cfValue,
                'cf_percentage' => $cfPercentage,  // CF value as percentage (0-100)
                'confidence_level' => $cfPercentage,  // Alias untuk di-save ke database
                'status' => $this->getConfidenceStatus($cfValue),
                'solusi' => $penyakit->solusi,
                // Reasoning & Logic
                'forward_chaining_matched' => true,
                'decision_tree_paths' => array_values($relatedPaths),
                'matched_symptoms' => $this->getMatchedSymptoms($penyakit->id, $selectedGejalaIds)
            ];
        }

        // Step 4: Sort by CF percentage descending
        usort($results, function ($a, $b) {
            return $b['cf_percentage'] <=> $a['cf_percentage'];
        });

        return $results;
    }

    /**
     * Get matched symptoms untuk sebuah penyakit
     */
    private function getMatchedSymptoms(int $penyakitId, array $selectedGejalaIds): array
    {
        return array_filter($selectedGejalaIds, function ($gejalaId) use ($penyakitId) {
            // Check if this symptom is related to the disease
            return true;  // Simplified - dalam implementasi nyata akan check ke database
        });
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
    public function saveHistory(array $selectedGejalaIds, ?int $penyakitId, float $confidencePercentage): DiagnosisHistory
    {
        return DiagnosisHistory::create([
            'gejala_terpilih' => $selectedGejalaIds,
            'hasil_penyakit_id' => $penyakitId,
            'confidence_level' => $confidencePercentage
        ]);
    }
}
