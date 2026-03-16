@extends('layouts.app')

@section('content')
    @if (isset($history_id))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let history = JSON.parse(localStorage.getItem('diagnosis_history') || '[]');
                if (!history.includes({{ $history_id }})) {
                    history.unshift({{ $history_id }});
                    localStorage.setItem('diagnosis_history', JSON.stringify(history));
                }
            });
        </script>
    @endif
    <!-- Result Section -->
    <section class="min-h-screen bg-gradient-to-b from-green-50 via-white to-green-100 pb-16 pt-28">
        <div class="container mx-auto px-6 md:px-10">
            <!-- Judul -->
            <div class="mb-10 text-center text-gray-900">
                <h1 class="mb-3 text-4xl font-extrabold">Hasil Diagnosis Jamur Tiram</h1>
                <p class="mx-auto max-w-2xl text-gray-600">
                    Berdasarkan gejala-gejala yang Anda berikan, berikut adalah hasil analisis sistem menggunakan metode
                    <span class="font-semibold text-green-700">Certainty Factor</span>.
                </p>
            </div>

            <div class="mx-auto max-w-4xl">
                @foreach ($results as $index => $result)
                    <div
                        class="mb-10 overflow-hidden rounded-3xl border border-green-100 bg-white shadow-2xl transition duration-300 hover:shadow-green-100">
                        <!-- Header Penyakit -->
                        <div
                            class="{{ $index == 0 ? 'bg-green-600' : 'bg-gray-600' }} flex items-center justify-between px-8 py-6 text-white">
                            <div>
                                <span
                                    class="text-sm font-medium uppercase tracking-wider text-white decoration-white opacity-80">[{{ $result['penyakit']->kode }}]
                                    Kemungkinan Penyakit/Hama:</span>
                                <h2 class="mt-1 text-3xl font-extrabold text-white">{{ $result['penyakit']->nama }}</h2>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-medium leading-tight text-white opacity-80">Tingkat
                                    Keyakinan:</span>
                                <div class="text-4xl font-black leading-tight text-white">{{ $result['percentage'] }}%</div>
                            </div>
                        </div>

                        <div class="p-8">
                            <!-- Status Confidence -->
                            <div
                                class="mb-8 flex items-center rounded-2xl border border-green-200 bg-green-50 p-4 shadow-sm">
                                <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                    <span class="text-2xl text-green-600">🛡️</span>
                                </div>
                                <div>
                                    <span class="text-sm font-medium leading-tight text-gray-500">Status Diagnosis:</span>
                                    <div class="text-xl font-bold leading-tight text-green-800">Sangat Yakin <span
                                            class="ml-2 rounded bg-green-200 px-2 py-1 text-xs text-green-800">{{ $result['status'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Penyakit -->
                            <div class="grid gap-8 md:grid-cols-2">
                                <div>
                                    <h3
                                        class="mb-3 flex items-center border-b border-green-100 pb-2 text-lg font-bold text-gray-800">
                                        <span class="mr-2">📝</span> Deskripsi
                                    </h3>
                                    <p class="text-justify leading-relaxed text-gray-600">
                                        {{ $result['penyakit']->deskripsi }}
                                    </p>
                                </div>
                                <div>
                                    <h3
                                        class="mb-3 flex items-center border-b border-green-100 pb-2 text-lg font-bold text-gray-800">
                                        <span class="mr-2">💡</span> Solusi & Penanganan
                                    </h3>
                                    <ul class="space-y-3">
                                        @php
                                            $solusiData = $result['solusi'];
                                            if (is_string($solusiData)) {
                                                // Coba decode jika string JSON
                                                $decoded = json_decode($solusiData, true);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                    $solusiData = $decoded;
                                                }
                                            }
                                        @endphp

                                        @if (is_array($solusiData))
                                            @foreach ($solusiData as $solusi)
                                                <li class="flex items-center">
                                                    <span class="px-2 text-green-500">✅</span>
                                                    <span class="leading-tight text-gray-600">{{ $solusi }}</span>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="flex items-center">
                                                <span class="px-2 text-green-500">✅</span>
                                                <span class="leading-tight text-gray-600">{{ $solusiData }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($index == 0 && count($results) > 1)
                        <div class="relative my-10 text-center">
                            <hr class="border-gray-300">
                            <span
                                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-green-50 px-4 text-sm font-semibold uppercase tracking-widest text-gray-500">Alternatif
                                Diagnosis Lainnya</span>
                        </div>
                    @endif
                @endforeach

                <!-- Action Buttons -->
                <div class="mt-12 flex flex-col items-center justify-center gap-4 md:flex-row">
                    <a href="/diagnosis"
                        class="w-full transform rounded-2xl bg-green-600 px-10 py-4 text-center font-bold text-white shadow-xl transition hover:-translate-y-1 hover:bg-green-700 md:w-auto">
                        🔄 Diagnosis Ulang
                    </a>
                    <a href="/"
                        class="w-full transform rounded-2xl border-2 border-green-600 bg-white px-10 py-4 text-center font-bold text-green-600 shadow-lg transition hover:-translate-y-1 hover:bg-green-50 md:w-auto">
                        🏠 Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-green-100 bg-green-50 py-6 text-center text-gray-600">
        &copy; 2026 <span class="font-semibold text-green-700">Sistem Pakar Jamur Tiram</span> — Semua Hak Dilindungi.
    </footer>
@endsection
