<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('laporan.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card 1: Laporan Stok Barang --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ __('laporan.stok_barang') }}
                            </h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            {{ __('laporan.stok_barang_desc') }}
                        </p>

                        <form action="{{ route('laporan.stok.pdf') }}" method="GET">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('laporan.filter_kategori') }}
                                    </label>
                                    <select name="kategori_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm">
                                        <option value="">{{ __('laporan.semua_kategori') }}</option>
                                        @foreach(\App\Models\Kategori::all() as $kat)
                                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="stok_menipis" value="1" id="stok_menipis" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <label for="stok_menipis" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('laporan.hanya_stok_menipis') }}
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="mt-4 w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                {{ __('laporan.download_pdf') }}
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Card 2: Laporan Transaksi --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ __('laporan.transaksi') }}
                            </h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            {{ __('laporan.transaksi_desc') }}
                        </p>

                        <form action="{{ route('laporan.transaksi.pdf') }}" method="GET">
                            <div class="space-y-3">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            {{ __('laporan.dari_tanggal') }}
                                        </label>
                                        <input type="date" name="tanggal_mulai" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            {{ __('laporan.sampai_tanggal') }}
                                        </label>
                                        <input type="date" name="tanggal_akhir" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        {{ __('laporan.tipe_transaksi') }}
                                    </label>
                                    <select name="tipe" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm">
                                        <option value="">{{ __('laporan.semua') }}</option>
                                        <option value="masuk">{{ __('laporan.barang_masuk') }}</option>
                                        <option value="keluar">{{ __('laporan.barang_keluar') }}</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="mt-4 w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                {{ __('laporan.download_pdf') }}
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Card 3: Laporan Ringkasan --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ __('laporan.ringkasan_inventaris') }}
                            </h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            {{ __('laporan.ringkasan_desc') }}
                        </p>

                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('laporan.ringkasan_isi') }}:</p>
                            <ul class="text-xs text-gray-600 dark:text-gray-300 mt-2 space-y-1">
                                <li>• {{ __('laporan.statistik_umum') }}</li>
                                <li>• {{ __('laporan.daftar_stok_menipis') }}</li>
                                <li>• {{ __('laporan.transaksi_terakhir') }}</li>
                            </ul>
                        </div>

                        <a href="{{ route('laporan.ringkasan.pdf') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            {{ __('laporan.download_pdf') }}
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
