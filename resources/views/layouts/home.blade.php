@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="min-h-screen flex items-center justify-center bg-gradient-to-b from-green-50 via-white to-green-100 pt-28 pb-12">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-6 md:px-10">
        
        <!-- Text -->
        <div class="md:w-1/2 mb-12 md:mb-0">
            <h1 class="text-4xl md:text-5fxl font-extrabold text-gray-900 leading-tight mb-6">
                Selamat Datang di <span class="text-green-600">Aplikasi Diagnosis Jamur Tiram</span>
            </h1>
            <p class="text-gray-700 text-lg mb-8">
                Aplikasi ini membantu petani dan pengusaha jamur tiram untuk mendeteksi gejala penyakit 
                atau masalah pertumbuhan dengan cepat dan akurat. 
                Dapatkan informasi, solusi, dan langkah pencegahan agar budidaya jamur tiram lebih sehat dan produktif.
            </p>
            <a href="/diagnosis"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold px-7 py-3 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                 Mulai Diagnosis
            </a>
        </div>

        <!-- Image -->
        <div class="md:w-1/2 flex justify-center">
            <div class="relative">
                <img src="{{ asset('images/jamurdipegang.jpg') }}" alt="Jamur Tiram"
                    class="rounded-3xl shadow-2xl w-full max-w-md object-cover border-4 border-green-200">
                <div class="absolute -bottom-4 -right-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow-md text-sm">
                    Budidaya Sehat 🌱
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Section -->
<section id="penyakit" class="bg-white py-16 border-t border-green-100">
    <div class="container mx-auto px-6 md:px-10 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Penting Diagnosis Jamur Tiram?</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Jamur tiram sangat sensitif terhadap perubahan lingkungan. Dengan sistem pakar ini, 
            Anda dapat mengetahui gejala penyakit sejak dini untuk mencegah kerugian besar dan menjaga kualitas hasil panen.
        </p>
    </div>
</section>

<!-- Footer -->
<footer class="text-center text-gray-600 py-6 border-t border-green-100 bg-green-50">
    &copy; 2025 <span class="text-green-700 font-semibold">Sistem Pakar Jamur Tiram</span> — Semua Hak Dilindungi tomihartanto.
</footer>
@endsection
