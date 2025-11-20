<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard StockFlow') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Bagian 1: Card Statistik Utama -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500">Total Produk</div>
                    <div class="text-3xl font-bold">{{ $totalBarang }} <span class="text-sm font-normal">Unit</span></div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500">Total Supplier</div>
                    <div class="text-3xl font-bold">{{ $totalSupplier }} <span class="text-sm font-normal">Mitra</span></div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="text-gray-500">Kategori Aktif</div>
                    <div class="text-3xl font-bold">{{ $totalKategori }} <span class="text-sm font-normal">Jenis</span></div>
                </div>
            </div>

            <!-- Bagian 2: Peringatan & Grafik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Stok Menipis -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-red-600">⚠️ Peringatan Stok Menipis</h3>
                    @if($barangMenipis->count() > 0)
                        <ul class="divide-y divide-gray-200">
                            @foreach($barangMenipis as $item)
                                <li class="py-3 flex justify-between items-center">
                                    <span>{{ $item->nama_barang }}</span>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Sisa: {{ $item->stok }} {{ $item->satuan }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-green-600">Aman! Semua stok di atas batas minimum.</p>
                    @endif
                </div>

                <!-- Grafik -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Komposisi Stok per Kategori</h3>
                    <div style="height: 250px;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Bagian 3: Tabel Transaksi -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Riwayat 5 Transaksi Terakhir</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Oleh</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($transaksiTerbaru as $tr)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tr->tanggal_transaksi->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $tr->barang->nama_barang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($tr->tipe_transaksi == 'masuk')
                                        <span class="text-green-600 font-bold">Masuk (+Stok)</span>
                                    @else
                                        <span class="text-red-600 font-bold">Keluar (-Stok)</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tr->jumlah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tr->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Jumlah Jenis Barang',
                    data: {!! json_encode($chartValues) !!},
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>
