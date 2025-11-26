<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>RINGKASAN INVENTARIS</title>
    <style>
        /* RESET DAN FONT */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9px;
            color: #333;
            line-height: 1.2;
            padding: 0;
            margin: 0;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #7209b7 0%, #4361ee 100%);
            color: white;
            padding: 12px 15px;
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 16px;
            margin-bottom: 3px;
            font-weight: bold;
        }

        .header .subtitle {
            font-size: 9px;
            opacity: 0.9;
        }

        /* META INFO */
        .meta-info {
            text-align: center;
            font-size: 8px;
            color: #666;
            margin-bottom: 12px;
            padding: 0 15px;
        }

        /* SECTION STYLES */
        .section {
            padding: 0 15px;
            margin-bottom: 12px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 6px;
            color: #333;
            border-bottom: 1px solid #7209b7;
            padding-bottom: 3px;
        }

        /* STATS GRID - DIKECILKAN */
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .stat-card {
            display: table-cell;
            width: 16.66%;
            padding: 3px;
            vertical-align: top;
        }

        .stat-card-inner {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 8px 4px;
            text-align: center;
            height: 100%;
        }

        .stat-card-inner.primary {
            background: linear-gradient(135deg, #7209b7 0%, #4361ee 100%);
            color: white;
            border: none;
        }

        .stat-card-inner.success {
            background: linear-gradient(135deg, #06d6a0 0%, #118ab2 100%);
            color: white;
            border: none;
        }

        .stat-card-inner.warning {
            background: linear-gradient(135deg, #f72585 0%, #b5179e 100%);
            color: white;
            border: none;
        }

        .stat-value {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .stat-label {
            font-size: 7px;
            text-transform: uppercase;
            opacity: 0.9;
            line-height: 1.1;
        }

        /* TABEL - DIKECILKAN */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7px;
            margin-bottom: 8px;
        }

        table th {
            background: #495057;
            color: white;
            padding: 5px 3px;
            text-align: left;
            border: 1px solid #dee2e6;
            font-weight: bold;
        }

        table td {
            padding: 5px 3px;
            border: 1px solid #dee2e6;
        }

        table tr:nth-child(even) {
            background: #f8f9fa;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* BADGES & ALERTS */
        .badge {
            display: inline-block;
            padding: 2px 5px;
            border-radius: 2px;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-in {
            background: #d4edda;
            color: #155724;
        }

        .badge-out {
            background: #f8d7da;
            color: #721c24;
        }

        .alert-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-left: 3px solid #ffc107;
            padding: 6px 8px;
            border-radius: 3px;
            margin-bottom: 8px;
        }

        .alert-box h4 {
            font-size: 9px;
            color: #856404;
            margin-bottom: 2px;
            font-weight: bold;
        }

        .alert-box p {
            font-size: 8px;
            color: #856404;
        }

        /* FOOTER */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 6px 15px;
            font-size: 7px;
            display: table;
            width: 100%;
        }

        .footer .left {
            display: table-cell;
            text-align: left;
            width: 70%;
        }

        .footer .right {
            display: table-cell;
            text-align: right;
            width: 30%;
        }

        .currency {
            font-family: 'DejaVu Sans Mono', monospace;
            font-weight: bold;
        }

        /* TWO COLUMN LAYOUT */
        .two-col {
            display: table;
            width: 100%;
        }

        .two-col .col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 5px;
        }

        .two-col .col:last-child {
            padding-right: 0;
            padding-left: 5px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RINGKASAN INVENTARIS</h1>
        <div class="subtitle">Dibuat pada: {{ $date }}</div>
    </div>

    <div class="meta-info">
        <strong>Dicetak oleh:</strong> {{ $printed_by }}
    </div>

    {{-- Statistik Utama --}}
    <div class="section">
        <div class="section-title">📊 STATISTIK UMUM</div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-inner primary">
                    <div class="stat-value">{{ number_format($stats['total_barang']) }}</div>
                    <div class="stat-label">Total Barang</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner">
                    <div class="stat-value">{{ number_format($stats['total_kategori']) }}</div>
                    <div class="stat-label">Kategori</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner">
                    <div class="stat-value">{{ number_format($stats['total_supplier']) }}</div>
                    <div class="stat-label">Supplier</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner">
                    <div class="stat-value">{{ number_format($stats['total_transaksi']) }}</div>
                    <div class="stat-label">Transaksi</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner success">
                    <div class="stat-value currency">Rp{{ number_format($stats['nilai_inventaris']/1000000, 1) }}jt</div>
                    <div class="stat-label">Nilai Inventaris</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner warning">
                    <div class="stat-value currency">Rp{{ number_format($stats['potensi_penjualan']/1000000, 1) }}jt</div>
                    <div class="stat-label">Potensi Jual</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Peringatan Stok Menipis --}}
    @if($stok_menipis->count() > 0)
    <div class="section">
        <div class="section-title">⚠️ PERINGATAN STOK MENIPIS</div>
        <div class="alert-box">
            <h4>PERHATIAN!</h4>
            <p>Ada {{ $stok_menipis->count() }} barang perlu restock</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width: 40%">Nama Barang</th>
                    <th style="width: 25%">Kategori</th>
                    <th style="width: 15%" class="text-center">Stok Sekarang</th>
                    <th style="width: 10%" class="text-center">Stok Minimum</th>
                    <th style="width: 10%" class="text-center">Selisih</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stok_menipis as $item)
                <tr>
                    <td><strong>{{ $item->nama_barang }}</strong></td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="text-center">
                        <span class="badge badge-danger">{{ $item->stok }} {{ $item->satuan }}</span>
                    </td>
                    <td class="text-center">{{ $item->stok_minimum }}</td>
                    <td class="text-center" style="color: #dc3545; font-weight: bold;">-{{ $item->stok_minimum - $item->stok }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{-- Transaksi Terbaru --}}
    <div class="section">
        <div class="section-title">🕐 TRANSAKSI TERBARU (10 Data)</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 12%">Tanggal</th>
                    <th style="width: 10%">Tipe</th>
                    <th style="width: 33%">Barang</th>
                    <th style="width: 10%" class="text-center">Jumlah</th>
                    <th style="width: 20%" class="text-right">Nilai</th>
                    <th style="width: 15%">Oleh</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi_terbaru as $trx)
                <tr>
                    <td>{{ $trx->tanggal_transaksi->format('d/m/Y') }}</td>
                    <td class="text-center">
                        @if($trx->tipe_transaksi === 'masuk')
                            <span class="badge badge-in">MASUK</span>
                        @else
                            <span class="badge badge-out">KELUAR</span>
                        @endif
                    </td>
                    <td>{{ $trx->barang->nama_barang ?? '-' }}</td>
                    <td class="text-center">{{ $trx->jumlah }}</td>
                    <td class="text-right currency">Rp {{ number_format($trx->jumlah * $trx->harga_per_unit, 0, ',', '.') }}</td>
                    <td>{{ $trx->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 10px; color: #666;">
                        Tidak ada transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Komposisi per Kategori --}}
    <div class="section">
        <div class="section-title">📁 KOMPOSISI KATEGORI</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 60%">Nama Kategori</th>
                    <th style="width: 20%" class="text-center">Jumlah Barang</th>
                    <th style="width: 20%" class="text-center">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @php $totalBarangKat = $kategori_chart->sum('barangs_count'); @endphp
                @foreach($kategori_chart as $kat)
                <tr>
                    <td><strong>{{ $kat->nama_kategori }}</strong></td>
                    <td class="text-center">{{ $kat->barangs_count }}</td>
                    <td class="text-center">{{ $totalBarangKat > 0 ? round(($kat->barangs_count / $totalBarangKat) * 100, 1) : 0 }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="left">StockFlow - Smart Inventory Management System | Dokumen dibuat otomatis</div>
        <div class="right">Halaman {PAGE_NUM} dari {PAGE_COUNT}</div>
    </div>
</body>
</html>
