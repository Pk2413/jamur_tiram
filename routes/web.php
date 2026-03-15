<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Halaman Beranda
|--------------------------------------------------------------------------
| Halaman utama (/) menampilkan logo, deskripsi, dan tombol ke diagnosis.
*/
Route::get('/', function () {
    return view('layouts.home'); // ✅ file: resources/views/layouts/home.blade.php
});

/*
|--------------------------------------------------------------------------
| Halaman Diagnosis
|--------------------------------------------------------------------------
| Menampilkan form gejala untuk dipilih pengguna.
*/
Route::get('/diagnosis', function () {
    return view('layouts.diagnosis'); // ✅ file: resources/views/layouts/diagnosis.blade.php
});

/*
|--------------------------------------------------------------------------
| Halaman Penyakit
|--------------------------------------------------------------------------
| Menampilkan daftar penyakit jamur tiram dengan gambar dan deskripsi.
*/
Route::get('/penyakit', function () {
    return view('layouts.penyakit'); // ✅ file: resources/views/layouts/penyakit.blade.php
});

/*
|/*
|--------------------------------------------------------------------------
| Halaman Tentang Kami
|--------------------------------------------------------------------------
| Menampilkan informasi tentang aplikasi dan tim pengembang.
*/
Route::get('/tentang', function () {
    return view('layouts.tentang'); // ✅ file: resources/views/layouts/tentang.blade.php
});


/*
|--------------------------------------------------------------------------
| Proses Hasil Diagnosis
|--------------------------------------------------------------------------
| Setelah user memilih gejala, sistem akan memproses dan menampilkan hasil.
*/
Route::post('/hasil', function (Request $request) {
    $gejala = $request->input('gejala', []);

    // Nilai default
    $penyakit = 'Sehat';
    $persentase = '0%';
    $saran = ['Jamur terlihat sehat. Jaga kondisi lingkungan tetap ideal.'];

    // Logika diagnosis sederhana
    if (in_array('warna_tudung_pudar', $gejala) && in_array('tangkai_busuk', $gejala)) {
        $penyakit = 'Trichoderma (Jamur Hijau)';
        $persentase = '80%';
        $saran = [
            'Pisahkan baglog yang terinfeksi dari yang sehat.',
            'Gunakan fungisida alami seperti larutan tembaga.',
            'Jaga kelembapan di bawah 90%.',
            'Sterilkan alat panen secara rutin.',
        ];
    } elseif (in_array('pertumbuhan_lambat', $gejala)) {
        $penyakit = 'Bakteri Kontaminasi';
        $persentase = '60%';
        $saran = [
            'Periksa suhu dan kelembapan ruang tumbuh.',
            'Pastikan ventilasi udara cukup.',
            'Gunakan bibit yang steril.',
        ];
    } elseif (in_array('bintik_hitam', $gejala)) {
        $penyakit = 'Infeksi Spora Hitam';
        $persentase = '70%';
        $saran = [
            'Gunakan air bersih untuk penyiraman.',
            'Kurangi kelembapan berlebih.',
            'Hindari penggunaan baglog lama.',
        ];
    }

    return view('layouts.hasil', compact('penyakit', 'persentase', 'saran'));
});
