<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gejala = [
            ['kode' => 'G01', 'nama' => 'Jamur tiram terlihat membusuk', 'kategori' => 'Warna & Kondisi'],
            ['kode' => 'G02', 'nama' => 'Jamur tiram terlihat keriput', 'kategori' => 'Warna & Kondisi'],
            ['kode' => 'G04', 'nama' => 'Batang jamur tiram terlihat berlubang', 'kategori' => 'Kerusakan'],
            ['kode' => 'G05', 'nama' => 'Jamur tiram hanya tumbuh kecil', 'kategori' => 'Pertumbuhan'],
            ['kode' => 'G06', 'nama' => 'Pertumbuhan jamur tiram lambat', 'kategori' => 'Pertumbuhan'],
            ['kode' => 'G07', 'nama' => 'Jamur tiram tidak tumbuh', 'kategori' => 'Pertumbuhan'],
            ['kode' => 'G08', 'nama' => 'Plastik baglog terlihat berlubang', 'kategori' => 'Kerusakan Baglog'],
            ['kode' => 'G09', 'nama' => 'Baglog/media jamur tiram rusak', 'kategori' => 'Kerusakan Baglog'],
            ['kode' => 'G10', 'nama' => 'Bau jamur tiram menyengat', 'kategori' => 'Aroma'],
            ['kode' => 'G11', 'nama' => 'Pada media baglog terdapat noda warna hitam', 'kategori' => 'Kondisi Baglog'],
            ['kode' => 'G12', 'nama' => 'Pada media baglog terdapat bintik-bintik noda hijau', 'kategori' => 'Kondisi Baglog'],
            ['kode' => 'G13', 'nama' => 'Pada permukaan baglog terdapat tepung warna orange', 'kategori' => 'Kondisi Baglog'],
            ['kode' => 'G14', 'nama' => 'Terdapat bintik-bintik kuning coklat pada jamur tiram', 'kategori' => 'Warna & Kondisi'],
            ['kode' => 'G15', 'nama' => 'Terdapat warna biru pada ujung jamur tiram', 'kategori' => 'Warna & Kondisi'],
            ['kode' => 'G16', 'nama' => 'Jamur tiram terdapat bekas luka', 'kategori' => 'Kerusakan'],
            ['kode' => 'G17', 'nama' => 'Perubahan aroma dan rasa', 'kategori' => 'Aroma & Rasa'],
            ['kode' => 'G18', 'nama' => 'Terdapat noda hijau di daun jamur', 'kategori' => 'Warna & Kondisi'],
            ['kode' => 'G19', 'nama' => 'Perakaran jamur tiram lembek', 'kategori' => 'Kondisi Akar'],
            ['kode' => 'G20', 'nama' => 'Jamur tiram rontok', 'kategori' => 'Kondisi Buah'],
            ['kode' => 'G21', 'nama' => 'Ukuran dan bentuk spora tidak normal', 'kategori' => 'Spora'],
            ['kode' => 'G22', 'nama' => 'Perubahan tekstur jamur lembek', 'kategori' => 'Tekstur'],
            ['kode' => 'G23', 'nama' => 'Pada miselium terdapat warna coklat atau merah tua', 'kategori' => 'Kondisi Miselium'],
            ['kode' => 'G24', 'nama' => 'Kerusakan pada tubuh buah jamur tiram', 'kategori' => 'Kerusakan'],
            ['kode' => 'G25', 'nama' => 'Batang jamur tiram terlihat berlubang', 'kategori' => 'Kerusakan'],
        ];

        foreach ($gejala as $item) {
            Gejala::create($item);
        }
    }
}
