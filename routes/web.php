<?php

use App\Http\Controllers\DiagnosisController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/diagnosis', [DiagnosisController::class, 'showForm']);

/*
|--------------------------------------------------------------------------
| Proses Hasil Diagnosis
|--------------------------------------------------------------------------
*/
Route::post('/diagnosis', [DiagnosisController::class, 'process']);
Route::post('/api/diagnosis', [DiagnosisController::class, 'apiProcess']);

/*
|--------------------------------------------------------------------------
| Halaman Riwayat Diagnosis
|--------------------------------------------------------------------------
*/
Route::get('/riwayat', [DiagnosisController::class, 'showHistory']);
Route::get('/riwayat/{id}', [DiagnosisController::class, 'detailHistory']);
Route::post('/api/history-data', [DiagnosisController::class, 'getHistoryData']);

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
