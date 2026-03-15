@extends('layouts.app')

@section('content')

<!-- Halaman Penyakit -->
<div class="min-h-screen bg-[url('{{ asset('images/bg-jamur.jpg') }}')] bg-cover bg-center bg-fixed bg-opacity-10 pt-28 pb-16 px-6 backdrop-blur-sm">
    <div class="max-w-6xl mx-auto text-center bg-white/70 backdrop-blur-md rounded-3xl p-8 shadow-md">
        <h1 class="text-3xl font-bold text-green-700 mb-6">Daftar Penyakit Jamur Tiram</h1>
        <p class="text-gray-700 mb-12 max-w-2xl mx-auto">
            Berikut beberapa jenis penyakit yang sering menyerang jamur tiram, lengkap dengan gambar dan penjelasannya.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
            {{-- Penyakit 1 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/penyakit1.jpg') }}" alt="Penyakit Jamur Tiram 1" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Trichoderma (Jamur Hijau)</h2>
                    <p class="text-gray-700 text-sm">
                        Penyakit ini disebabkan oleh jamur <i>Trichoderma sp.</i> yang tumbuh pada baglog dan miselium jamur tiram. Ditandai dengan warna hijau pada permukaan baglog dan menyebabkan jamur gagal tumbuh.
                    </p>
                </div>
            </div>

            {{-- Penyakit 2 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/penyakit2.jpg') }}" alt="Penyakit Jamur Tiram 2" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Kontaminasi Bakteri</h2>
                    <p class="text-gray-700 text-sm">
                        Biasanya ditandai dengan lendir dan bau tidak sedap pada baglog. Penyebabnya adalah kebersihan alat dan ruangan yang kurang steril, atau kadar air berlebih dalam media tanam.
                    </p>
                </div>
            </div>

            {{-- Penyakit 3 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/penyakit3.jpg') }}" alt="Penyakit Jamur Tiram 3" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Spora Hitam</h2>
                    <p class="text-gray-700 text-sm">
                        Ditandai dengan munculnya bintik-bintik hitam pada tudung jamur. Penyebab utama adalah kelembapan tinggi dan ventilasi udara yang kurang baik.
                    </p>
                </div>
            </div>

            {{-- Penyakit 4 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/penyakit4.jpg') }}" alt="Penyakit Jamur Tiram 4" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Jamur Kuning</h2>
                    <p class="text-gray-700 text-sm">
                        Jamur kuning muncul sebagai bercak kuning pada baglog. Biasanya disebabkan oleh suhu ruangan terlalu panas dan kurangnya sirkulasi udara segar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center text-gray-500 py-6 border-t border-gray-100 bg-white/90 backdrop-blur-md">
    &copy; 2025 Sistem Pakar Jamur Tiram — Semua Hak Dilindungi.
</footer>
@endsection
