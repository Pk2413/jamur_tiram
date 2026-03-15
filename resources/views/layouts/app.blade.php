<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Diagnosis Jamur Tiram</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-50">

    {{-- ✅ Navbar Utama --}}
    <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
        <div class="container mx-auto flex justify-between items-center px-6 py-3">
            <h1 class="text-xl font-semibold text-green-700">Sistem Pakar Jamur Tiram</h1>
            <div class="flex space-x-6">
                <a href="{{ url('/') }}" 
                   class="{{ Request::is('/') ? 'text-white bg-green-600 px-4 py-2 rounded-md shadow-md transition' : 'text-gray-800 hover:text-green-700 px-4 py-2 rounded-md transition' }}">
                    Beranda
                </a>
                <a href="{{ url('/diagnosis') }}" 
                   class="{{ Request::is('diagnosis') ? 'text-white bg-green-600 px-4 py-2 rounded-md shadow-md transition' : 'text-gray-800 hover:text-green-700 px-4 py-2 rounded-md transition' }}">
                    Diagnosis
                </a>
                <a href="{{ url('/penyakit') }}" 
                   class="{{ Request::is('penyakit') ? 'text-white bg-green-600 px-4 py-2 rounded-md shadow-md transition' : 'text-gray-800 hover:text-green-700 px-4 py-2 rounded-md transition' }}">
                    Penyakit
                </a>
                <a href="{{ url('/tentang') }}" 
                   class="{{ Request::is('tentang') ? 'text-white bg-green-600 px-4 py-2 rounded-md shadow-md transition' : 'text-gray-800 hover:text-green-700 px-4 py-2 rounded-md transition' }}">
                    Tentang Kami
                </a>
            </div>
        </div>
    </nav>

    {{-- ✅ Konten Utama, beri padding agar tidak tertutup navbar --}}
    <main class="pt-0 px-2">
        @yield('content')
    </main>

</body>
</html>
