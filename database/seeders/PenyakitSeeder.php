<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakit = [
            [
                'kode' => 'P01',
                'nama' => 'Trichoderma spp (Jamur Hijau)',
                'tipe' => 'Jamur',
                'deskripsi' => 'Jamur hijau yang menyerang baglog dan miselium jamur tiram. Ditandai dengan pertumbuhan jamur yang lambat atau tidak tumbuh.',
                'solusi' => json_encode([
                    'Pisahkan baglog yang terinfeksi dari area produksi',
                    'Gunakan fungisida alami dari bawang putih atau cengkeh',
                    'Jaga kelembaban ruangan di bawah 90%',
                    'Tingkatkan ventilasi dan pencahayaan',
                    'Desinfeksi alat-alat pertanian dengan larutan klorin 5%',
                ]),
            ],
            [
                'kode' => 'P02',
                'nama' => 'Neurospora spp',
                'tipe' => 'Jamur',
                'deskripsi' => 'Jamur merah/orange yang tumbuh pada media baglog. Menyebabkan pertumbuhan jamur menjadi lambat.',
                'solusi' => json_encode([
                    'Isolasi baglog yang terinfeksi',
                    'Gunakan fungisida berbahan aktif benzimidazol',
                    'Tingkatkan kebersihan lingkungan produksi',
                    'Sterilisasi media dengan autoclave maksimal',
                    'Hindari pencam dengan baglog lain',
                ]),
            ],
            [
                'kode' => 'P03',
                'nama' => 'Mucor spp',
                'tipe' => 'Jamur',
                'deskripsi' => 'Jamur hitam yang menyerang media baglog. Terjadi karena kelembaban dan suhu yang tidak tepat.',
                'solusi' => json_encode([
                    'Buang baglog yang terinfeksi',
                    'Kurangi kelembaban ruangan',
                    'Tingkatkan sirkulasi udara',
                    'Bersihkan ruangan dari sisa-sisa media lama',
                    'Gunakan kapur tohor untuk desinfeksi',
                ]),
            ],
            [
                'kode' => 'P04',
                'nama' => 'Penicilium spp',
                'tipe' => 'Jamur',
                'deskripsi' => 'Jamur berwarna hijau kebiruan yang menyerang miselium. Menyebabkan miselium gagal berkembang.',
                'solusi' => json_encode([
                    'Pisahkan media yang terinfeksi segera',
                    'Tingkatkan suhu ruangan hingga 25-27°C',
                    'Kurangi kelembaban hingga 80%',
                    'Gunakan fungisida sistemik',
                    'Jaga kebersihan ekstrim di area produksi',
                ]),
            ],
            [
                'kode' => 'P05',
                'nama' => 'Pseudomonas tolasii (Bakteri Brown Blotch)',
                'tipe' => 'Bakteri',
                'deskripsi' => 'Bakteri yang menyerang jamur tiram dewasa menyebabkan busuk coklat. Penyakit berbahaya karena cepat menyebar.',
                'solusi' => json_encode([
                    'Pisahkan jamur yang terinfeksi',
                    'Panen segera jamur yang masih sehat',
                    'Tingkatkan ventilasi dan kurangi kelembaban',
                    'Semprot dengan antibiotik (streptomisin 500 ppm)',
                    'Sterilisasi alat panen dengan desinfektan',
                ]),
            ],
            [
                'kode' => 'P06',
                'nama' => 'Chaetomium spp',
                'tipe' => 'Jamur',
                'deskripsi' => 'Jamur coklat yang tumbuh pada miselium menyebabkan warna miselium berubah coklat atau merah tua.',
                'solusi' => json_encode([
                    'Buang media yang terserang',
                    'Tingkatkan suhu inkubasi',
                    'Jaga media agar tidak terlalu lembab',
                    'Gunakan fungisida contact',
                    'Lakukan sanitasi umum',
                ]),
            ],
            [
                'kode' => 'P07',
                'nama' => 'Coprinus spp (Jamur Liar)',
                'tipe' => 'Jamur',
                'deskripsi' => 'Jamur liar dengan warna biru pada ujung jamur tiram. Berkompetisi dengan jamur tiram dalam nutrisi.',
                'solusi' => json_encode([
                    'Panen jamur tiram sebelum Coprinus berkembang',
                    'Tingkatkan pH media',
                    'Inokulasi dengan bibit berkualitas tinggi',
                    'Jaga kebersihan media',
                    'Gunakan fungisida preventif',
                ]),
            ],
            [
                'kode' => 'P08',
                'nama' => 'Tikus (Hama Binatang)',
                'tipe' => 'Hama Binatang',
                'deskripsi' => 'Tikus menggerat baglog dan tunas jamur tiram yang sedang berkembang, menyebabkan kerusakan media dan produksi.',
                'solusi' => json_encode([
                    'Pasang perangkap atau racun tikus',
                    'Tutup celah-celah ruangan dengan kawat kasa',
                    'Jangan tinggalkan pakan di sekitar areal budidaya',
                    'Lakukan pembersihan ruangan secara teratur',
                    'Gunakan kucing atau predator tikus lainnya',
                ]),
            ],
            [
                'kode' => 'P09',
                'nama' => 'Lalat (Hama Serangga)',
                'tipe' => 'Hama Serangga',
                'deskripsi' => 'Larva lalat merusak jamur tiram dengan membuat lubang. Jamur menjadi rusak dan tidak layak jual.',
                'solusi' => json_encode([
                    'Gunakan insektisida organik (pyrethrin)',
                    'Pasang kasa anti serangga pada ventilasi',
                    'Jaga kebersihan dan segera buang sisa panen',
                    'Gunakan pembakar untuk menarik dan membunuh lalat',
                    'Pantau ruangan secara berkala',
                ]),
            ],
            [
                'kode' => 'P10',
                'nama' => 'Tunggu/Gurem (Hama Serangga - Acari)',
                'tipe' => 'Hama Serangga',
                'deskripsi' => 'Tunggu (akarid) menyerang miselium dan tunas jamur tiram. Menyebabkan jamur tumbuh kecil-kecil.',
                'solusi' => json_encode([
                    'Gunakan akarisida (sulfur powder atau mitisida)',
                    'Tingkatkan sirkulasi udara',
                    'Jaga kelembaban pada level optimal 80-85%',
                    'Isolasi baglog yang terserang',
                    'Lakukan rotasi area budidaya',
                ]),
            ],
        ];

        foreach ($penyakit as $item) {
            Penyakit::create($item);
        }
    }
}
