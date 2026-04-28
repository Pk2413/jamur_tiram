<?php

namespace App\Services;

use App\Models\Penyakit;

class ForwardChainingService
{
    /**
     * Data rules untuk forward chaining
     */
    private $rules = [
        ['id' => 1, 'penyakit_id' => 1, 'kode' => 'R1', 'gejala_ids' => [11, 17, 5, 6]],
        ['id' => 2, 'penyakit_id' => 2, 'kode' => 'R2', 'gejala_ids' => [12, 5, 6]],
        ['id' => 3, 'penyakit_id' => 3, 'kode' => 'R3', 'gejala_ids' => [10, 5, 6]],
        ['id' => 4, 'penyakit_id' => 4, 'kode' => 'R4', 'gejala_ids' => [11, 22, 5]],
        ['id' => 5, 'penyakit_id' => 5, 'kode' => 'R5', 'gejala_ids' => [1, 9, 13, 21]],
        ['id' => 6, 'penyakit_id' => 6, 'kode' => 'R6', 'gejala_ids' => [22, 5, 8]],
        ['id' => 7, 'penyakit_id' => 7, 'kode' => 'R7', 'gejala_ids' => [14, 23, 19]],
        ['id' => 8, 'penyakit_id' => 8, 'kode' => 'R8', 'gejala_ids' => [8, 23, 19]],
        ['id' => 9, 'penyakit_id' => 9, 'kode' => 'R9', 'gejala_ids' => [1, 2, 24]],
        ['id' => 10, 'penyakit_id' => 10, 'kode' => 'R10', 'gejala_ids' => [4, 18, 24]],
    ];

    /**
     * Data relasi penyakit-gejala dengan CF pakar
     */
    private $penyakitGejala = [
        ['penyakit_id' => 1, 'gejala_id' => 11, 'cf_pakar' => 1],
        ['penyakit_id' => 1, 'gejala_id' => 17, 'cf_pakar' => 0.8],
        ['penyakit_id' => 1, 'gejala_id' => 5, 'cf_pakar' => 0.6],
        ['penyakit_id' => 1, 'gejala_id' => 6, 'cf_pakar' => 0.8],
        ['penyakit_id' => 2, 'gejala_id' => 12, 'cf_pakar' => 1],
        ['penyakit_id' => 2, 'gejala_id' => 5, 'cf_pakar' => 0.6],
        ['penyakit_id' => 2, 'gejala_id' => 6, 'cf_pakar' => 0.8],
        ['penyakit_id' => 3, 'gejala_id' => 10, 'cf_pakar' => 1],
        ['penyakit_id' => 3, 'gejala_id' => 5, 'cf_pakar' => 0.6],
        ['penyakit_id' => 3, 'gejala_id' => 6, 'cf_pakar' => 0.8],
        ['penyakit_id' => 4, 'gejala_id' => 11, 'cf_pakar' => 1],
        ['penyakit_id' => 4, 'gejala_id' => 5, 'cf_pakar' => 0.6],
        ['penyakit_id' => 4, 'gejala_id' => 22, 'cf_pakar' => 0.8],
        ['penyakit_id' => 5, 'gejala_id' => 1, 'cf_pakar' => 1],
        ['penyakit_id' => 5, 'gejala_id' => 9, 'cf_pakar' => 0.8],
        ['penyakit_id' => 5, 'gejala_id' => 13, 'cf_pakar' => 0.8],
        ['penyakit_id' => 5, 'gejala_id' => 15, 'cf_pakar' => 0.4],
        ['penyakit_id' => 5, 'gejala_id' => 16, 'cf_pakar' => 0.6],
        ['penyakit_id' => 5, 'gejala_id' => 21, 'cf_pakar' => 0.8],
        ['penyakit_id' => 6, 'gejala_id' => 22, 'cf_pakar' => 1],
        ['penyakit_id' => 6, 'gejala_id' => 5, 'cf_pakar' => 0.6],
        ['penyakit_id' => 6, 'gejala_id' => 8, 'cf_pakar' => 0.6],
        ['penyakit_id' => 7, 'gejala_id' => 14, 'cf_pakar' => 1],
        ['penyakit_id' => 7, 'gejala_id' => 23, 'cf_pakar' => 0.6],
        ['penyakit_id' => 7, 'gejala_id' => 19, 'cf_pakar' => 0.6],
        ['penyakit_id' => 8, 'gejala_id' => 8, 'cf_pakar' => 0.8],
        ['penyakit_id' => 8, 'gejala_id' => 23, 'cf_pakar' => 0.8],
        ['penyakit_id' => 8, 'gejala_id' => 19, 'cf_pakar' => 0.6],
        ['penyakit_id' => 9, 'gejala_id' => 1, 'cf_pakar' => 0.6],
        ['penyakit_id' => 9, 'gejala_id' => 2, 'cf_pakar' => 0.6],
        ['penyakit_id' => 9, 'gejala_id' => 24, 'cf_pakar' => 0.8],
        ['penyakit_id' => 10, 'gejala_id' => 4, 'cf_pakar' => 0.8],
        ['penyakit_id' => 10, 'gejala_id' => 18, 'cf_pakar' => 0.8],
        ['penyakit_id' => 10, 'gejala_id' => 24, 'cf_pakar' => 0.6],
    ];

    /**
     * Decision Tree - Struktur hierarki untuk diagnosis
     * Mengorganisasi gejala dan rules dalam bentuk pohon keputusan
     */
    private $decisionTree = [
        'root' => [
            'name' => 'Diagnosis Jamur Tiram',
            'primary_symptoms' => [1, 5, 8, 11, 12, 14],  // Gejala utama untuk initial split
            'branches' => [
                // Branch 1: Gejala 11 (Tubuh Buah Pucat)
                [
                    'symptom_id' => 11,
                    'name' => 'Tubuh Buah Pucat',
                    'children' => [
                        [
                            'symptom_id' => 17,
                            'name' => 'Ada Lendir',
                            'penyakit_ids' => [1]  // R1: Penyakit 1
                        ],
                        [
                            'symptom_id' => 22,
                            'name' => 'Bau Menyengat',
                            'penyakit_ids' => [4]  // R4: Penyakit 4
                        ]
                    ]
                ],
                // Branch 2: Gejala 12 (Umbi Membusuk)
                [
                    'symptom_id' => 12,
                    'name' => 'Umbi Membusuk',
                    'children' => [
                        [
                            'symptom_id' => 5,
                            'name' => 'Substrat Basah',
                            'penyakit_ids' => [2]  // R2: Penyakit 2
                        ]
                    ]
                ],
                // Branch 3: Gejala 10 (Kepala Susu Coklat)
                [
                    'symptom_id' => 10,
                    'name' => 'Kepala Susu Coklat',
                    'children' => [
                        [
                            'symptom_id' => 5,
                            'name' => 'Substrat Basah',
                            'penyakit_ids' => [3]  // R3: Penyakit 3
                        ]
                    ]
                ],
                // Branch 4: Gejala 1 (Jamur Putih pada Kepala Susu)
                [
                    'symptom_id' => 1,
                    'name' => 'Jamur Putih pada Kepala Susu',
                    'children' => [
                        [
                            'symptom_id' => 9,
                            'name' => 'Busuk Pangkal',
                            'penyakit_ids' => [5]  // R5: Penyakit 5
                        ],
                        [
                            'symptom_id' => 2,
                            'name' => 'Berbau Asam',
                            'penyakit_ids' => [9]  // R9: Penyakit 9
                        ]
                    ]
                ],
                // Branch 5: Gejala 22 (Bau Menyengat)
                [
                    'symptom_id' => 22,
                    'name' => 'Bau Menyengat',
                    'children' => [
                        [
                            'symptom_id' => 8,
                            'name' => 'Kepala Susu Berlendir',
                            'penyakit_ids' => [6]  // R6: Penyakit 6
                        ]
                    ]
                ],
                // Branch 6: Gejala 14 (Kepala Susu Kerdil)
                [
                    'symptom_id' => 14,
                    'name' => 'Kepala Susu Kerdil',
                    'children' => [
                        [
                            'symptom_id' => 23,
                            'name' => 'Warna Tidak Seragam',
                            'penyakit_ids' => [7]  // R7: Penyakit 7
                        ]
                    ]
                ],
                // Branch 7: Gejala 8 dan 23 (Non-primary)
                [
                    'symptom_id' => 8,
                    'name' => 'Kepala Susu Berlendir',
                    'children' => [
                        [
                            'symptom_id' => 19,
                            'name' => 'Miselium Tidak Berkembang',
                            'penyakit_ids' => [8]  // R8: Penyakit 8
                        ]
                    ]
                ],
                // Branch 8: Gejala 4 (Pertumbuhan Terganggu)
                [
                    'symptom_id' => 4,
                    'name' => 'Pertumbuhan Terganggu',
                    'children' => [
                        [
                            'symptom_id' => 18,
                            'name' => 'Kontaminan Terlihat',
                            'penyakit_ids' => [10]  // R10: Penyakit 10
                        ]
                    ]
                ]
            ]
        ]
    ];

    /**
     * Get decision tree structure
     */
    public function getDecisionTree(): array
    {
        return $this->decisionTree;
    }

    /**
     * Get primary symptoms untuk starting diagnosis
     */
    public function getPrimarySymptoms(): array
    {
        return $this->decisionTree['root']['primary_symptoms'];
    }

    /**
     * Traverse decision tree berdasarkan selected gejala
     * Mengembalikan branch yang cocok dan possible penyakit
     */
    public function traverseDecisionTree(array $selectedGejalaIds): array
    {
        $matching = [];
        
        foreach ($this->decisionTree['root']['branches'] as $branch) {
            if (in_array($branch['symptom_id'], $selectedGejalaIds)) {
                $matching[] = [
                    'symptom_id' => $branch['symptom_id'],
                    'name' => $branch['name'],
                    'matched' => true,
                    'possible_penyakit_ids' => $this->extractPenyakitFromBranch($branch, $selectedGejalaIds)
                ];
            }
        }
        
        return $matching;
    }

    /**
     * Extract possible penyakit IDs dari branch
     */
    private function extractPenyakitFromBranch(array $branch, array $selectedGejalaIds): array
    {
        $penyakitIds = [];
        
        if (isset($branch['penyakit_ids'])) {
            $penyakitIds = array_merge($penyakitIds, $branch['penyakit_ids']);
        }
        
        if (isset($branch['children'])) {
            foreach ($branch['children'] as $child) {
                if (in_array($child['symptom_id'], $selectedGejalaIds)) {
                    if (isset($child['penyakit_ids'])) {
                        $penyakitIds = array_merge($penyakitIds, $child['penyakit_ids']);
                    }
                }
            }
        }
        
        return array_unique($penyakitIds);
    }

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
        foreach ($this->rules as $rule) {
            $ruleGejalaIds = $rule['gejala_ids'] ?? [];
            
            // Check if all gejala dalam rule cocok dengan selected gejala
            $match = true;
            foreach ($ruleGejalaIds as $gejalaId) {
                if (!in_array($gejalaId, $selectedGejalaIds)) {
                    $match = false;
                    break;
                }
            }
            
            if ($match) {
                $matchingPenyakitIds[] = $rule['penyakit_id'];
            }
        }

        // 2. Jika tidak ada rule yang match persis, ambil semua penyakit yang berhubungan 
        // dengan salah satu gejala yang diinput (agar CF bisa bekerja)
        if (empty($matchingPenyakitIds)) {
            $penyakitIds = [];
            foreach ($this->penyakitGejala as $pg) {
                if (in_array($pg['gejala_id'], $selectedGejalaIds)) {
                    $penyakitIds[] = $pg['penyakit_id'];
                }
            }
            $matchingPenyakitIds = $penyakitIds;
        }

        return Penyakit::whereIn('id', array_unique($matchingPenyakitIds))->get()->all();
    }
}
