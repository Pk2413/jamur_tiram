@extends('layouts.app')

@section('content')
    <section class="min-h-screen bg-gradient-to-b from-green-50 via-white to-green-100 pb-16 pt-28">
        <div class="container mx-auto px-6 md:px-10">
            <div class="mb-10 text-center">
                <h1 class="mb-3 text-4xl font-extrabold text-gray-900">Riwayat Diagnosis Saya</h1>
                <p class="mx-auto max-w-2xl text-gray-600">
                    Daftar diagnosis yang pernah Anda lakukan sebelumnya di perangkat ini 🌱.
                </p>
            </div>

            <div id="history-container" class="mx-auto max-w-4xl space-y-6">
                <!-- Loading Spinner -->
                <div id="loading" class="py-10 text-center">
                    <div class="mx-auto h-12 w-12 animate-spin rounded-full border-b-2 border-t-2 border-green-600"></div>
                    <p class="mt-4 text-gray-500">Memuat riwayat...</p>
                </div>

                <!-- Empty State -->
                <div id="empty-state"
                    class="hidden rounded-3xl border border-green-100 bg-white py-20 text-center shadow-sm">
                    <div class="mb-4 text-6xl">📜</div>
                    <h3 class="text-xl font-bold text-gray-800">Belum Ada Riwayat</h3>
                    <p class="mt-2 text-gray-500">Anda belum melakukan diagnosis apapun.</p>
                    <a href="/diagnosis"
                        class="mt-6 inline-block rounded-xl bg-green-600 px-8 py-3 font-bold text-white shadow-lg transition hover:bg-green-700">
                        Mulai Diagnosis Sekarang
                    </a>
                </div>

                <!-- History List -->
                <div id="history-list" class="hidden space-y-4">
                    <!-- Data will be injected here -->
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const historyIds = JSON.parse(localStorage.getItem('diagnosis_history') || '[]');

            if (historyIds.length === 0) {
                document.getElementById('loading').classList.add('hidden');
                document.getElementById('empty-state').classList.remove('hidden');
                return;
            }

            // Fetch history data from server based on LocalStorage IDs
            fetch('/api/history-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ids: historyIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loading').classList.add('hidden');
                    const listContainer = document.getElementById('history-list');
                    listContainer.classList.remove('hidden');

                    if (data.length === 0) {
                        document.getElementById('empty-state').classList.remove('hidden');
                        return;
                    }

                    data.forEach(item => {
                        const date = new Date(item.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        const card = document.createElement('div');
                        card.className =
                            "bg-white p-6 rounded-2xl shadow-sm border border-green-100 flex flex-col md:flex-row justify-between items-center transition hover:shadow-md";
                        card.innerHTML = `
                <div class="flex items-center space-x-4 mb-4 md:mb-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-2xl">
                        🍄
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 text-lg">${item.penyakit ? item.penyakit.nama : 'Tidak diketahui'}</h4>
                        <p class="text-sm text-gray-500">${date}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right">
                        <span class="text-xs text-gray-400 block uppercase font-bold">Confidence</span>
                        <span class="text-xl font-black text-green-600">${(item.confidence_level * 100).toFixed(2)}%</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="/riwayat/${item.id}" class="bg-green-50 text-green-600 p-2 rounded-lg hover:bg-green-100 transition" title="Lihat Detail">
                            👁️
                        </a>
                        <button onclick="clearSpecific(${item.id})" class="text-gray-400 hover:text-red-500 transition" title="Hapus dari riwayat">
                            🗑️
                        </button>
                    </div>
                </div>
            `;
                        listContainer.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error('Error fetching history:', error);
                    document.getElementById('loading').innerHTML =
                        '<p class="text-red-500">Gagal memuat riwayat. Silakan muat ulang halaman.</p>';
                });
        });

        function clearSpecific(id) {
            if (confirm('Hapus diagnosis ini dari riwayat?')) {
                let history = JSON.parse(localStorage.getItem('diagnosis_history') || '[]');
                history = history.filter(hId => hId !== id);
                localStorage.setItem('diagnosis_history', JSON.stringify(history));
                location.reload();
            }
        }
    </script>
@endsection
