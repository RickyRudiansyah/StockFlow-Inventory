<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laporan Inventaris' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .card-hover {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .loading {
            display: none;
        }

        .btn-loading .loading {
            display: inline-block;
        }

        .btn-loading .text {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900">{{ $title ?? 'Pusat Laporan & Ekspor Data' }}</h1>
            <p class="text-gray-600 mt-2">Akses dan unduh laporan inventaris lengkap untuk analisis bisnis yang lebih baik</p>
        </header>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Stok Barang Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 card-hover overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start mb-5">
                        <div class="p-3 bg-blue-50 rounded-lg text-blue-600 mr-4">
                            <i class="fas fa-boxes text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Stok Barang</h3>
                            <p class="text-sm font-medium text-blue-600">Inventory Report</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                        Cetak daftar lengkap seluruh barang di gudang, termasuk detail status stok yang menipis atau aman.
                    </p>

                    <form action="{{ route('laporan.stok.pdf') }}" method="GET" target="_blank" class="space-y-4">
                        <div>
                            <label for="stok_menipis" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-filter mr-1 text-blue-500"></i> Filter Data
                            </label>
                            <div class="relative">
                                <select name="stok_menipis" id="stok_menipis"
                                    class="w-full pl-4 pr-10 py-3 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                                    <option value="0">📄 Semua Data Barang</option>
                                    <option value="1">⚠️ Hanya Stok Menipis</option>
                                    <option value="2">✅ Hanya Stok Aman</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <i class="fas fa-file-pdf mr-1"></i> Download PDF Stok
                            </button>
                            <p class="text-xs text-gray-500 mt-2 text-center">File akan diunduh dalam format PDF</p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Riwayat Transaksi Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 card-hover overflow-hidden">
                <div class="p-6">
                    <div class="flex items-start mb-5">
                        <div class="p-3 bg-green-50 rounded-lg text-green-600 mr-4">
                            <i class="fas fa-exchange-alt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Riwayat Transaksi</h3>
                            <p class="text-sm font-medium text-green-600">Transaction History</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                        Rekapitulasi lengkap arus barang masuk dan keluar berdasarkan rentang periode tanggal yang dipilih.
                    </p>

                    <form action="{{ route('laporan.transaksi.pdf') }}" method="GET" target="_blank" class="space-y-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="far fa-calendar-alt mr-1 text-green-500"></i> Dari Tanggal
                                </label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                    class="w-full border border-gray-300 rounded-lg py-2.5 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                            </div>
                            <div>
                                <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="far fa-calendar-check mr-1 text-green-500"></i> Sampai Tanggal
                                </label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                                    class="w-full border border-gray-300 rounded-lg py-2.5 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full flex justify-center items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                <i class="fas fa-chart-line mr-1"></i> Download PDF Transaksi
                            </button>
                            <p class="text-xs text-gray-500 mt-2 text-center">File akan diunduh dalam format PDF</p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ringkasan Eksekutif Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 card-hover overflow-hidden flex flex-col">
                <div class="p-6 flex-grow">
                    <div class="flex items-start mb-5">
                        <div class="p-3 bg-purple-50 rounded-lg text-purple-600 mr-4">
                            <i class="fas fa-chart-pie text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Ringkasan Eksekutif</h3>
                            <p class="text-sm font-medium text-purple-600">Executive Summary</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Gambaran umum performa inventaris. Berisi total nilai aset, statistik kategori, dan ringkasan aktivitas terbaru dalam satu halaman.
                    </p>

                    <div class="mt-4 p-4 bg-purple-50 rounded-lg">
                        <h4 class="font-medium text-purple-800 text-sm mb-2">Apa yang termasuk:</h4>
                        <ul class="text-xs text-purple-700 space-y-1">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle mr-2 text-purple-500"></i> Total nilai inventaris
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle mr-2 text-purple-500"></i> Statistik kategori barang
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle mr-2 text-purple-500"></i> Aktivitas terbaru
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="p-6 pt-0">
                    <a href="{{ route('laporan.ringkasan.pdf') }}" target="_blank"
                        class="w-full flex justify-center items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        <i class="fas fa-file-contract mr-1"></i> Download Ringkasan
                    </a>
                    <p class="text-xs text-gray-500 mt-2 text-center">File akan diunduh dalam format PDF</p>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="mt-10 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Panduan Penggunaan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-info-circle text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Laporan Stok Barang</h3>
                        <p class="text-sm text-gray-600 mt-1">Pilih filter untuk melihat semua barang atau hanya stok yang menipis</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-calendar-day text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Rentang Tanggal</h3>
                        <p class="text-sm text-gray-600 mt-1">Pastikan memilih rentang tanggal yang valid untuk laporan transaksi</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-purple-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-download text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Format File</h3>
                        <p class="text-sm text-gray-600 mt-1">Semua laporan akan diunduh dalam format PDF yang siap cetak</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set tanggal default untuk form transaksi
        document.addEventListener('DOMContentLoaded', function() {
            // Set tanggal mulai ke awal bulan ini
            const today = new Date();
            const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
            document.getElementById('tanggal_mulai').valueAsDate = firstDay;
            document.getElementById('tanggal_akhir').valueAsDate = today;
        });
    </script>
</body>
</html>
