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
                <img src="{{ asset('images/Neurospora.jpg') }}" alt="Penyakit Jamur Tiram 1" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Neurospora spp</h2>
                    <p class="text-gray-700 text-sm">
                    Neurospora spp dengan warna oranye terang yang menyebar tidak merata di permukaan media tanam. Warna ini merupakan ciri khas kontaminasi Neurospora,
                     yang tumbuh cepat pada kondisi lembap dan suhu tinggi.
                     Miselium jamur tiram tampak terhambat, dengan sebagian area media tertutup lapisan oranye tebal.
                     Tubuh buah jamur tiram masih muncul di sisi baglog, tetapi pertumbuhannya tidak optimal.
                     Kontaminasi ini menandakan kompetisi nutrisi antara Neurospora dan jamur tiram,
                     yang dapat menurunkan hasil panen serta kualitas produksi.    
                    </p>
                </div>
            </div>

            {{-- Penyakit 2 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/Trichoderma.jpg') }}" alt="Penyakit Jamur Tiram 2" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Trichoderma spp</h2>
                    <p class="text-gray-700 text-sm">
                    Trichoderma spp. atau jamur hijau adalah kontaminan paling berbahaya pada jamur tiram yang muncul sebagai
                     bercak hijau di baglog. Jamur ini menyebar cepat di kondisi lembab dan sterilisasi kurang matang,
                     lalu merusak miselium sehingga jamur tiram jadi kerdil, busuk, atau gagal panen.
                     Penanganannya dengan segera membuang baglog terinfeksi dan mencegahnya lewat sterilisasi matang, 
                     kebersihan kumbung, serta sirkulasi udara baik.        
                </p>
                </div>
            </div>

            {{-- Penyakit 3 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/Penicilium spp.png') }}" alt="Penyakit Jamur Tiram 3" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Penicilium spp</h2>
                    <p class="text-gray-700 text-sm">
                        penyakit jamur tiram akibat Penicillium spp ditandai dengan munculnya lapisan 
                        hijau kebiruan pada baglog. Kontaminasi ini biasanya terjadi karena media kurang 
                        steril atau terlalu lembap. Kehadirannya membuat miselium terhambat dan tubuh buah
                        menjadi kecil serta tidak optimal, sehingga hasil panen menurun. Pencegahan dilakukan
                        dengan menjaga kebersihan ruang produksi dan memastikan media bebas dari kontaminasi.
                     </p>
                </div>
            </div>

            {{-- Penyakit 4 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/Pseudomans tolasi.png') }}" alt="Penyakit Jamur Tiram 4" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Pseudomonas tolaasii</h2>
                    <p class="text-gray-700 text-sm">
                        Penyakit jamur tiram akibat Pseudomonas tolaasii dikenal
                         brown blotch disease. Gejalanya berupa bercak cokelat
                        pada permukaan tubuh buah jamur tiram yang membuatnya tampak busuk
                        dan tidak menarik. Infeksi ini biasanya muncul pada kondisi lingkungan
                        yang terlalu lembap atau ventilasi kurang baik. Kehadiran bakteri ini
                        menyebabkan penurunan kualitas panen karena jamur menjadi bercak dan 
                        cepat rusak. Pencegahan dilakukan dengan menjaga kebersihan ruang produksi,
                        mengatur kelembapan, serta memastikan sirkulasi udara cukup agar tidak terjadi 
                        kontaminasi bakteri.
                    </p>
                </div>
            </div>

             {{-- Penyakit 5 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/Chaetomium spp.png') }}" alt="Penyakit Jamur Tiram 3" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Chaetomium spp</h2>
                    <p class="text-gray-700 text-sm">
Penyakit jamur tiram akibat Chaetomium spp ditandai dengan munculnya 
jamur berwarna gelap (hitam atau cokelat) pada permukaan baglog. 
Kontaminasi ini biasanya terjadi pada media yang lembap dan kurang steril. 
Kehadiran Chaetomium spp menyebabkan miselium jamur tiram terhambat sehingga 
pertumbuhan tubuh buah tidak optimal. Selain menurunkan hasil panen, jamur ini 
juga merusak kualitas media karena warna dan teksturnya berubah. 
Pencegahan dilakukan dengan menjaga kebersihan ruang produksi serta memastikan 
media benar-benar bebas dari kontaminasi sebelum digunakan.
                </p>
                </div>
            </div>

            {{-- Penyakit 6 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/Choprinus spp.png') }}" alt="Penyakit Jamur Tiram 4" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Coprinus spp</h2>
                    <p class="text-gray-700 text-sm">
Penyakit jamur tiram akibat Coprinus spp ditandai dengan munculnya jamur liar
 berwarna hitam yang tumbuh di permukaan baglog atau bahkan di sekitar tubuh
  buah jamur tiram. Kontaminasi ini biasanya terjadi karena kelembapan berlebih 
  dan kebersihan ruang produksi yang kurang terjaga. Kehadiran Coprinus spp 
  menyebabkan miselium jamur tiram terhambat dan tubuh buah menjadi tidak normal 
  serta kualitas panen menurun. Pencegahan dilakukan dengan menjaga kebersihan, 
  mengatur kelembapan, serta memastikan media bebas dari kontaminasi jamur liar.

                    </p>
                </div>
            </div>

             {{-- Penyakit 7 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/Tikus.png') }}" alt="Penyakit Jamur Tiram 3" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Tikus</h2>
                    <p class="text-gray-700 text-sm">
                    Tikus
Serangan tikus pada jamur tiram biasanya terlihat jelas karena mereka menggigit tubuh buah jamur hingga rusak. Akibatnya, jamur tampak sobek, cacat, bahkan sebagian hilang dimakan. Selain merusak bentuk dan kualitas panen, gigitan tikus juga bisa menyebabkan kontaminasi media karena sisa makanan dan kotoran mereka. Kehadiran tikus membuat miselium terganggu dan produksi jamur tiram menurun drastis.Pencegahan dilakukan dengan menutup celah masuk, menjaga kebersihan ruang produksi, serta menggunakan perangkap agar tikus tidak bisa mencapai baglog dan tubuh buah.
   
                </p>
                </div>
            </div>

             {{-- Penyakit 8 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/gurem.png') }}" alt="Penyakit Jamur Tiram 4" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Gurem(Tunggu)</h2>
                    <p class="text-gray-700 text-sm">
                   
Serangan tunggu/gurem pada budidaya jamur tiram biasanya berupa hama kecil mirip kutu yang hidup di sekitar baglog. Mereka menyerang dengan cara memakan miselium dan kadang juga merusak tubuh buah jamur tiram. Akibatnya, pertumbuhan jamur menjadi terhambat, hasil panen menurun, dan kualitas produksi tidak optimal. Kehadiran tunggu/gurem juga dapat menyebabkan kontaminasi media karena populasi mereka berkembang cepat di lingkungan lembap.Pencegahan dilakukan dengan menjaga kebersihan ruang produksi, mengatur kelembapan agar tidak terlalu tinggi, serta menutup celah yang memungkinkan hama ini masuk ke area budidaya.

                </p>
                </div>
            </div>

             {{-- Penyakit 9 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/mucorspp.jpg') }}" alt="Penyakit Jamur Tiram 3" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">Mucor spp</h2>
                    <p class="text-gray-700 text-sm">
                    
Penyakit jamur tiram akibat Mucor spp dikenal sebagai jamur kapas putih karena membentuk lapisan berbulu mirip kapas pada baglog. Kontaminasi ini biasanya muncul akibat sterilisasi media yang kurang sempurna atau kondisi lingkungan terlalu lembap. Kehadirannya membuat miselium terhambat, tubuh buah menjadi kecil dan tidak subur, sehingga hasil panen menurun. Pencegahan dilakukan dengan menjaga kebersihan ruang produksi dan memastikan media bebas dari kontaminasi.
        
                </p>
                </div>
            </div>

            {{-- Penyakit 10 --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <img src="{{ asset('images/lalat.png') }}" alt="Penyakit Jamur Tiram 4" class="w-full h-56 object-cover">
                <div class="p-6 text-left">
                    <h2 class="text-xl font-semibold text-green-700 mb-2">lalat</h2>
                    <p class="text-gray-700 text-sm">
                        Serangan lalat pada budidaya jamur tiram biasanya terjadi ketika lalat bertelur di dalam atau sekitar baglog. Telur tersebut menetas menjadi larva yang kemudian memakan miselium dan bahkan menyerang tubuh buah jamur tiram. Akibatnya, jamur rusak, kualitas panen menurun, dan sering tampak bercak atau lubang kecil pada permukaan jamur. Kehadiran lalat juga meningkatkan risiko kontaminasi media karena membawa mikroba lain.Pencegahan dilakukan dengan menjaga kebersihan ruang produksi, menggunakan saringan pada ventilasi, serta mengatur kelembapan agar lalat tidak mudah berkembang biak. </p>
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
