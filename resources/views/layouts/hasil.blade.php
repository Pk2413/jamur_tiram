@extends('layouts.app')

@section('content')
<!-- Background dengan overlay -->
<div class="relative min-h-screen flex items-center justify-center bg-gradient-to-b from-green-50 to-white overflow-hidden">
    <!-- Background gambar jamur samar -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/jamurdipegang.jpg') }}" 
             alt="Background Jamur Tiram"
             class="w-full h-full object-cover opacity-10 blur-sm">
    </div>

    <!-- Konten Utama -->
    <div class="relative bg-white/90 shadow-2xl rounded-3xl p-10 w-full max-w-3xl text-center border border-green-100 backdrop-blur-md">
        <!-- Judul -->
        <h1 class="text-3xl font-extrabold text-green-700 mb-6 tracking-tight">
            🌿 Hasil Diagnosis Jamur Tiram Anda
        </h1>

        <!-- Kotak Hasil -->
        <div class="bg-green-50 border border-green-300 rounded-xl p-6 mb-6">
            <p class="text-xl font-semibold text-green-800">Penyakit: {{ $penyakit }}</p>
            <p class="text-gray-700 mt-2">Tingkat kemungkinan: <span class="font-bold text-green-700">{{ $persentase }}</span></p>
        </div>

        <!-- Saran Perawatan -->
        <div class="text-left bg-white border border-green-100 rounded-xl shadow-sm p-6 mb-6">
            <h2 class="text-lg font-bold text-green-700 mb-3">💡 Saran Perawatan:</h2>
            <ul class="list-disc ml-6 text-gray-700 space-y-2">
                @foreach ($saran as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Catatan Tambahan -->
        <div class="text-sm text-gray-500 italic mb-6">
            *Hasil diagnosis ini berdasarkan metode <b>Forward Chaining</b> dan 
            <b>Certainty Factor</b> untuk menentukan tingkat keyakinan penyakit pada jamur tiram.
        </div>

        <!-- Tombol -->
        <div class="mt-4">
            <a href="/diagnosis"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition transform hover:scale-105">
               🔍 Lakukan Diagnosis Ulang
            </a>
        </div>
    </div>
</div>
@endsection
