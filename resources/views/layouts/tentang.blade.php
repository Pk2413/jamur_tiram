@extends('layouts.app')

@section('content')

<!-- Section Tentang Kami -->
<section class="min-h-screen flex items-center justify-center bg-gradient-to-b from-green-50 via-white to-green-100 pt-28 pb-20">
    <div class="container mx-auto px-6 md:px-10">
        <div class="bg-white/90 backdrop-blur-md shadow-xl rounded-3xl p-10 md:p-14 border border-green-100">
            <h1 class="text-4xl font-extrabold text-center text-green-700 mb-8">Tentang Kami</h1>
            <p class="text-gray-700 text-lg leading-relaxed mb-6 text-justify">
                Aplikasi <strong>Diagnosis Jamur Tiram</strong> dikembangkan untuk membantu petani dan pelaku usaha agribisnis
                dalam mendeteksi penyakit pada jamur tiram secara cepat dan akurat.
            </p>
            <p class="text-gray-700 text-lg leading-relaxed mb-6 text-justify">
                Dengan metode <strong>Forward Chaining</strong> yang dikolaborasikan dengan <strong>Certainty Factor</strong>, 
                aplikasi ini memberikan hasil diagnosis yang ilmiah disertai saran pencegahan dan penanganan berdasarkan 
                pengetahuan pakar dan data lapangan.
            </p>
            <p class="text-gray-700 text-lg leading-relaxed mb-6 text-justify">
                Kami berkomitmen menghadirkan solusi digital untuk pertanian modern, khususnya pada sektor budidaya jamur tiram,
                agar produksi menjadi lebih sehat, efisien, dan berkelanjutan.
            </p>
            <div class="text-center mt-10">
                <p class="text-green-700 italic text-lg font-medium">
                    “Menuju pertanian pintar berbasis teknologi untuk masa depan yang berkelanjutan.”
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center text-gray-600 py-6 border-t border-green-100 bg-green-50">
    &copy; 2025 <span class="text-green-700 font-semibold">Sistem Pakar Jamur Tiram</span> — Semua Hak Dilindungi tomihartanto.
</footer>
@endsection
