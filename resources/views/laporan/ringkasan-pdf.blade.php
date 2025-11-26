<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px 30px;
            margin-bottom: 25px;
            text-align: center;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header .subtitle {
            font-size: 11px;
            opacity: 0.9;
        }
        .header .company {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }
        .section {
            padding: 0 30px;
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #495057;
            border-bottom: 2px solid #667eea;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-card {
            display: table-cell;
            width: 16.66%;
            padding: 5px;
            vertical-align: top;
        }
        .stat-card-inner {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px 10px;
            text-align: center;
        }
        .stat-card-inner.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        .stat-card-inner.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            border: none;
        }
        .stat-card-inner.warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
        }
        .stat-value {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table th {
            background: #495057;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
        }
        table td {
            padding: 8px 6px;
            border-bottom: 1px solid #dee2e6;
            font-size: 9px;
        }
        table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
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
            border-left: 4px solid #ffc107;
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .alert-box h4 {
            font-size: 11px;
            color: #856404;
            margin-bottom: 5px;
        }
        .alert-box p {
            font-size: 9px;
            color: #856404;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 10px 30px;
            font-size: 8px;
            color: #6c757d;
        }
        .footer .left {
            float: left;
        }
        .footer .right {
            float: right;
        }
        .meta-line {
            text-align: center;
            font-size: 9px;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .currency {
            font-family: 'DejaVu Sans Mono', monospace;
        }
        .two-col {
            display: table;
            width: 100%;
        }
        .two-col .col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 15px;
        }
        .two-col .col:last-child {
            padding-right: 0;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company">📦 STOCKFLOW</div>
        <h1>{{ $title }}</h1>
        <div class="subtitle">{{ __('laporan.generated_at') }}: {{ $date }}</div>
    </div>

    <p class="meta-line">{{ __('laporan.printed_by') }}: <strong>{{ $printed_by }}</strong></p>

    {{-- Statistik Utama --}}
    <div class="section">
        <div class="section-title">📊 {{ __('laporan.statistik_umum') }}</div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-inner primary">
                    <div class="stat-value">{{ number_format($stats['total_barang']) }}</div>
                    <div class="stat-label">{{ __('laporan.total_barang') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner">
                    <div class="stat-value">{{ number_format($stats['total_kategori']) }}</div>
                    <div class="stat-label">{{ __('laporan.kategori') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner">
                    <div class="stat-value">{{ number_format($stats['total_supplier']) }}</div>
                    <div class="stat-label">{{ __('laporan.supplier') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner">
                    <div class="stat-value">{{ number_format($stats['total_transaksi']) }}</div>
                    <div class="stat-label">{{ __('laporan.transaksi') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner success">
                    <div class="stat-value currency" style="font-size: 14px;">Rp {{ number_format($stats['nilai_inventaris']/1000000, 1) }}jt</div>
                    <div class="stat-label">{{ __('laporan.nilai_inventaris') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-inner warning">
                    <div class="stat-value currency" style="font-size: 14px;">Rp {{ number_format($stats['potensi_penjualan']/1000000, 1) }}jt</div>
                    <div class="stat-label">{{ __('laporan.potensi_jual') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Peringatan Stok Menipis --}}
    @if($stok_menipis->count() > 0)
    <div class="section">
        <div class="section-title">⚠️ {{ __('laporan.peringatan_stok') }}</div>
        <div class="alert-box">
            <h4>{{ __('laporan.perhatian') }}!</h4>
            <p>{{ __('laporan.ada') }} {{ $stok_menipis->count() }} {{ __('laporan.barang_perlu_restock') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>{{ __('laporan.nama_barang') }}</th>
                    <th>{{ __('laporan.kategori') }}</th>
                    <th class="text-center">{{ __('laporan.stok_sekarang') }}</th>
                    <th class="text-center">{{ __('laporan.stok_minimum') }}</th>
                    <th class="text-center">{{ __('laporan.selisih') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stok_menipis as $item)
                <tr>
                    <td><strong>{{ $item->nama_barang }}</strong></td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="text-center"><span class="badge badge-danger">{{ $item->stok }} {{ $item->satuan }}</span></td>
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
        <div class="section-title">🕐 {{ __('laporan.transaksi_terakhir') }} (10 Terbaru)</div>
        <table>
            <thead>
                <tr>
                    <th>{{ __('laporan.tanggal') }}</th>
                    <th>{{ __('laporan.tipe') }}</th>
                    <th>{{ __('laporan.barang') }}</th>
                    <th class="text-center">{{ __('laporan.jumlah') }}</th>
                    <th class="text-right">{{ __('laporan.nilai') }}</th>
                    <th>{{ __('laporan.oleh') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi_terbaru as $trx)
                <tr>
                    <td>{{ $trx->tanggal_transaksi->format('d/m/Y') }}</td>
                    <td>
                        @if($trx->tipe_transaksi === 'masuk')
                            <span class="badge badge-in">▲ {{ __('laporan.masuk') }}</span>
                        @else
                            <span class="badge badge-out">▼ {{ __('laporan.keluar') }}</span>
                        @endif
                    </td>
                    <td>{{ $trx->barang->nama_barang ?? '-' }}</td>
                    <td class="text-center">{{ $trx->jumlah }}</td>
                    <td class="text-right currency">Rp {{ number_format($trx->jumlah * $trx->harga_per_unit, 0, ',', '.') }}</td>
                    <td>{{ $trx->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">{{ __('laporan.tidak_ada_transaksi') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Komposisi per Kategori --}}
    <div class="section">
        <div class="section-title">📁 {{ __('laporan.komposisi_kategori') }}</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 60%">{{ __('laporan.nama_kategori') }}</th>
                    <th style="width: 20%" class="text-center">{{ __('laporan.jumlah_barang') }}</th>
                    <th style="width: 20%" class="text-center">{{ __('laporan.persentase') }}</th>
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
        <div class="left">StockFlow - Smart Inventory Management System | {{ __('laporan.dokumen_otomatis') }}</div>
        <div class="right">{{ __('laporan.halaman') }} 1 {{ __('laporan.dari') }} 1</div>
    </div>
</body>
</html>
