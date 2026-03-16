@extends('layouts.app')

@section('content')
    <!-- Diagnosis Section -->
    <section class="min-h-screen bg-gradient-to-b from-green-50 via-white to-green-100 pb-16 pt-28">
        <div class="container mx-auto px-6 md:px-10">
            <!-- Judul -->
            <div class="mb-10 text-center">
                <h1 class="mb-3 text-4xl font-extrabold text-gray-900">Diagnosis Gejala Jamur Tiram</h1>
                <p class="mx-auto max-w-2xl text-gray-600">
                    Pilih gejala-gejala yang kamu lihat pada jamur tiram. Sistem akan membantu menganalisis kemungkinan
                    penyakit
                    dan memberikan hasil diagnosis yang akurat 🌱.
                </p>
            </div>

            @if (session('error'))
                <div class="mx-auto mb-6 max-w-4xl border-l-4 border-red-500 bg-red-100 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Gejala -->
            <form action="/diagnosis" method="POST" class="rounded-3xl border border-green-100 bg-white p-8 shadow-xl">
                @csrf

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($gejalas as $gejala)
                        <div
                            class="flex flex-col rounded-xl border border-green-200 bg-green-50 p-4 shadow-sm transition hover:bg-green-100">
                            <label class="flex cursor-pointer items-start space-x-3">
                                <input type="checkbox" name="gejala_ids[]" value="{{ $gejala->id }}"
                                    class="mt-1 h-5 w-5 rounded border-green-300 text-green-600 focus:ring-green-500">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-700">{{ $gejala->nama }}
                                        <span class="text-sm font-light text-gray-800">[{{ $gejala->kode }}]</span>
                                    </span>

                                </div>
                            </label>

                            <!-- Hidden CF User Selection (Default 0.8) -->
                            <input type="hidden" name="cf_user[{{ $gejala->id }}]" value="0.8">
                        </div>
                    @endforeach
                </div>

                <!-- Tombol Diagnosis -->
                <div class="mt-10 text-center">
                    <button type="submit"
                        class="transform rounded-xl bg-green-600 px-8 py-3 font-semibold text-white shadow-lg transition hover:-translate-y-1 hover:bg-green-700">
                        🔍 Proses Diagnosis
                    </button>
                </div>
            </form>

            <!-- Keterangan Metode -->
            <div
                class="mx-auto mt-14 max-w-3xl rounded-2xl border border-green-100 bg-green-50 px-6 py-8 text-center shadow-sm">
                <h3 class="mb-3 text-2xl font-bold text-gray-800">Metode yang Digunakan</h3>
                <p class="leading-relaxed text-gray-600">
                    Aplikasi ini menggunakan kombinasi metode <span class="font-semibold text-green-700">Forward
                        Chaining</span>
                    dan <span class="font-semibold text-green-700">Certainty Factor (CF)</span> untuk melakukan diagnosis.
                    <br>Metode ini bekerja dengan menelusuri gejala yang dipilih oleh pengguna secara berurutan,
                    kemudian menghitung tingkat keyakinan terhadap kemungkinan penyakit jamur tiram berdasarkan data
                    pengetahuan yang ada.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-green-100 bg-green-50 py-6 text-center text-gray-600">
        &copy; 2026 <span class="font-semibold text-green-700">Sistem Pakar Jamur Tiram</span> — Semua Hak Dilindungi.
    </footer>
@endsection
