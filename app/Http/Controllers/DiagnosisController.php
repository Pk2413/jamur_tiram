<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Services\DiagnosisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiagnosisController extends Controller
{
    protected $diagnosisService;

    public function __construct(DiagnosisService $diagnosisService)
    {
        $this->diagnosisService = $diagnosisService;
    }

    /**
     * Menampilkan form diagnosis dengan daftar gejala.
     */
    public function showForm()
    {
        $gejalas = Gejala::orderBy('kode', 'asc')->get();
        return view('diagnosis.form', compact('gejalas'));
    }

    /**
     * Memproses data diagnosis dari form.
     */
    public function process(Request $request)
    {
        $request->validate([
            'gejala_ids' => 'required|array|min:1',
            'gejala_ids.*' => 'exists:gejala,id',
            'cf_user' => 'nullable|array',
        ]);

        try {
            $selectedGejalaIds = $request->gejala_ids;
            $cfUserMap = $request->input('cf_user', []);

            $results = $this->diagnosisService->diagnose($selectedGejalaIds, $cfUserMap);

            if (empty($results)) {
                return back()->with('error', 'Tidak ditemukan penyakit yang cocok dengan gejala yang dipilih. Silakan pilih gejala lain.');
            }

            // Simpan history (ambil hasil terbaik)
            $bestResult = $results[0];
            $history = $this->diagnosisService->saveHistory(
                $selectedGejalaIds,
                $bestResult['penyakit']->id,
                $bestResult['cf_value']
            );

            return view('diagnosis.hasil', [
                'results' => $results,
                'selectedGejalaIds' => $selectedGejalaIds,
                'history_id' => $history->id
            ]);
        } catch (\Exception $e) {
            Log::error('Diagnosis Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat melakukan diagnosis. Silakan coba lagi.');
        }
    }

    /**
     * API endpoint untuk diagnosis (JSON response).
     */
    public function apiProcess(Request $request)
    {
        // ... (existing code)
    }

    /**
     * Menampilkan halaman riwayat diagnosis.
     */
    public function showHistory()
    {
        return view('diagnosis.history');
    }

    /**
     * Mengambil data history berdasarkan IDs (untuk AJAX request dari LocalStorage).
     */
    public function getHistoryData(Request $request)
    {
        $ids = $request->input('ids', []);

        $histories = \App\Models\DiagnosisHistory::with('penyakit')
            ->whereIn('id', $ids)
            ->get()
            ->sortBy(function ($history) use ($ids) {
                return array_search($history->id, $ids);
            })
            ->values();

        return response()->json($histories);
    }

    /**
     * Menampilkan detail riwayat diagnosis berdasarkan ID.
     */
    public function detailHistory($id)
    {
        $history = \App\Models\DiagnosisHistory::with('penyakit')->findOrFail($id);

        // Ambil data gejala berdasarkan IDs yang tersimpan di JSON
        $selectedGejalaIds = $history->gejala_terpilih;
        $gejalas = \App\Models\Gejala::whereIn('id', $selectedGejalaIds)->get();

        // Rekonstruksi hasil untuk view yang sama dengan hasil diagnosis
        $results = [[
            'penyakit' => $history->penyakit,
            'cf_value' => $history->confidence_level,
            'percentage' => round($history->confidence_level * 100, 2),
            'status' => $this->diagnosisService->getConfidenceStatus($history->confidence_level),
            'solusi' => $history->penyakit->solusi
        ]];

        return view('diagnosis.hasil', compact('results', 'selectedGejalaIds'));
    }
}
