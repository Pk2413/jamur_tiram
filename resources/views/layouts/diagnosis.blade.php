@extends('layouts.app')

@section('content')

<!-- Diagnosis Section -->
<section class="min-h-screen bg-gradient-to-b from-green-50 via-white to-green-100 pt-28 pb-16">
    <div class="container mx-auto px-6 md:px-10">
        <!-- Judul -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-3">Diagnosis Gejala Jamur Tiram</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Pilih gejala-gejala yang kamu lihat pada jamur tiram. Sistem akan membantu menganalisis kemungkinan penyakit
                dan memberikan hasil diagnosis yang akurat 🌱.
            </p>
        </div>

        <!-- Form Gejala -->
        <form action="/hasil" method="POST" class="bg-white shadow-xl rounded-3xl p-8 border border-green-100">
            @csrf

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $gejala_list = [
                        'warna_tudung_pudar' => 'Warna tudung jamur tampak pudar atau kusam',
                        'tangkai_busuk' => 'Tangkai jamur membusuk atau lembek',
                        'pertumbuhan_lambat' => 'Pertumbuhan jamur lambat',
                        'bintik_hitam' => 'Terdapat bintik hitam di permukaan jamur',
                        'jamur_hijau' => 'Muncul jamur hijau di baglog atau media tanam',
                        'bau_menyengat' => 'Bau tidak sedap keluar dari baglog',
                        'tudung_berkerut' => 'Tudung jamur mengerut atau tidak rata',
                        'tepi_tudung_coklat' => 'Tepi tudung berubah warna menjadi coklat',
                        'jamur_tidak_mekar' => 'Jamur tidak membuka sempurna saat tumbuh',
                        'bercak_putih' => 'Ada bercak putih pada permukaan atau tangkai jamur',
                    ];
                @endphp

                @foreach ($gejala_list as $key => $label)
                    <label class="flex items-center space-x-3 bg-green-50 hover:bg-green-100 p-4 rounded-xl border border-green-200 shadow-sm cursor-pointer transition">
                        <input type="checkbox" name="gejala[]" value="{{ $key }}" class="w-5 h-5 text-green-600 border-green-300 rounded focus:ring-green-500">
                        <span class="text-gray-800 font-medium">{{ $label }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Tombol Diagnosis -->
            <div class="text-center mt-10">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                    🔍 Proses Diagnosis
                </button>
            </div>
        </form>

        <!-- Keterangan Metode -->
        <div class="text-center mt-14 bg-green-50 border border-green-100 rounded-2xl shadow-sm py-8 px-6 max-w-3xl mx-auto">
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Metode yang Digunakan</h3>
            <p class="text-gray-600 leading-relaxed">
                Aplikasi ini menggunakan kombinasi metode <span class="text-green-700 font-semibold">Forward Chaining</span> 
                dan <span class="text-green-700 font-semibold">Certainty Factor (CF)</span> untuk melakukan diagnosis.
                <br>Metode ini bekerja dengan menelusuri gejala yang dipilih oleh pengguna secara berurutan,
                kemudian menghitung tingkat keyakinan terhadap kemungkinan penyakit jamur tiram berdasarkan data pengetahuan yang ada.
            </p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center text-gray-600 py-6 border-t border-green-100 bg-green-50">
    &copy; 2025 <span class="text-green-700 font-semibold">Sistem Pakar Jamur Tiram</span> — Semua Hak Dilindungi tomihartanto.
</footer>
@endsection
