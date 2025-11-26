<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Ringkasan Eksekutif' }}</title>
    <style>
        /* RESET & SETUP */
        @page {
            margin: 25px;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #2d3748;
            line-height: 1.3;
        }

        /* HEADER */
        .header {
            width: 100%;
            border-bottom: 3px solid #5a67d8;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 18pt;
            font-weight: 800;
            color: #1a202c;
            margin: 0;
            text-transform: uppercase;
        }
        .header .sub {
            font-size: 10pt;
            color: #718096;
            margin-top: 5px;
        }
        .header .meta {
            text-align: right;
            font-size: 9pt;
            color: #718096;
        }

        /* STATS BAR */
        .stats-bar {
            margin-bottom: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #e2e8f0;
        }
        .stats-item {
            text-align: center;
            padding: 0 8px;
        }
        .stats-value {
            font-size: 16px;
            font-weight: bold;
            color: #2d3748;
            display: block;
            margin-bottom: 3px;
        }
        .stats-label {
            font-size: 8px;
            text-transform: uppercase;
            color: #718096;
            letter-spacing: 0.5px;
        }

        /* KPI CARDS */
        .kpi-wrapper {
            width: 100%;
            margin-bottom: 20px;
        }
        .kpi-box {
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            padding: 12px;
            border-radius: 6px;
            text-align: center;
        }
        .kpi-box.highlight {
            background-color: #f0fff4;
            border-color: #9ae6b4;
        }
        .kpi-box.alert {
            background-color: #fff5f5;
            border-color: #feb2b2;
        }
        .kpi-box.warning {
            background-color: #fffaf0;
            border-color: #fbd38d;
        }

        .kpi-label {
            font-size: 7pt;
            text-transform: uppercase;
            color: #718096;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            display: block;
        }
        .kpi-value {
            font-size: 14pt;
            font-weight: bold;
            color: #2d3748;
            display: block;
            margin-bottom: 4px;
        }
        .kpi-sub {
            font-size: 7pt;
            color: #718096;
        }

        /* WARNA TEXT UTILITY */
        .text-green { color: #2f855a; }
        .text-red { color: #c53030; }
        .text-blue { color: #3182ce; }
        .text-orange { color: #dd6b20; }
        .font-bold { font-weight: bold; }

        /* TABEL DATA */
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 8pt;
        }
        table.data th {
            background-color: #edf2f7;
            text-align: left;
            padding: 6px;
            font-size: 8pt;
            text-transform: uppercase;
            border-bottom: 2px solid #cbd5e0;
        }
        table.data td {
            padding: 6px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 8pt;
        }
        table.data tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* SECTION TITLE */
        .section-head {
            font-size: 10pt;
            font-weight: bold;
            border-left: 4px solid #5a67d8;
            padding-left: 8px;
            margin: 15px 0 8px 0;
            color: #4a5568;
            text-transform: uppercase;
        }

        /* ICON REPLACEMENT (Kotak Warna) */
        .icon-box {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 5px;
            border-radius: 2px;
        }
        .bg-red { background: #e53e3e; }
        .bg-green { background: #38a169; }
        .bg-blue { background: #3182ce; }
        .bg-orange { background: #ed8936; }

        /* UTILS */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 7pt;
            color: white;
            font-weight: bold;
        }
        .bg-green { background: #38a169; }
        .bg-red { background: #e53e3e; }

        /* PROGRESS BAR */
        .progress-container {
            margin-top: 8px;
        }
        .progress-item {
            margin-bottom: 4px;
        }
        .progress-bar {
            background: #e2e8f0;
            border-radius: 3px;
            height: 6px;
            margin: 2px 0;
        }
        .progress-fill {
            background: #3182ce;
            height: 6px;
            border-radius: 3px;
        }

        /* COLUMN LAYOUT */
        .column-left {
            float: left;
            width: 48%;
        }
        .column-right {
            float: right;
            width: 48%;
        }
        .clearfix {
            clear: both;
        }

        /* FOOTER */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f8f9fa;
            border-top: 1px solid #e2e8f0;
            padding: 6px 25px;
            font-size: 7pt;
            color: #718096;
        }
        .footer table {
            width: 100%;
        }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td width="70%">
                <h1>Ringkasan Eksekutif</h1>
                <div class="sub">Laporan Performa Bisnis & Inventaris</div>
            </td>
            <td width="30%" class="meta">
                <b>STOCKFLOW SYSTEM</b><br>
                {{ $date }}<br>
                User: {{ $printed_by }}
            </td>
        </tr>
    </table>

    <div class="stats-bar">
        <table width="100%" cellspacing="8">
            <tr>
                <td width="25%" class="stats-item">
                    <div class="stats-value">{{ $stats['total_barang'] ?? 0 }}</div>
                    <div class="stats-label">Total Barang</div>
                </td>
                <td width="25%" class="stats-item">
                    <div class="stats-value">{{ $stats['total_kategori'] ?? 0 }}</div>
                    <div class="stats-label">Kategori</div>
                </td>
                <td width="25%" class="stats-item">
                    <div class="stats-value">{{ $stats['total_supplier'] ?? 0 }}</div>
                    <div class="stats-label">Supplier</div>
                </td>
                <td width="25%" class="stats-item">
                    <div class="stats-value">{{ $stats['total_transaksi'] ?? 0 }}</div>
                    <div class="stats-label">Total Transaksi</div>
                </td>
            </tr>
        </table>
    </div>

    <table class="kpi-wrapper" cellspacing="8">
        <tr>
            <td width="33%" class="kpi-box highlight">
                <span class="kpi-label text-green">Total Aset (Beli)</span>
                <span class="kpi-value text-green">Rp {{ number_format($stats['nilai_inventaris'], 0, ',', '.') }}</span>
                <span class="kpi-sub">Modal Barang Tersimpan</span>
            </td>
            <td width="33%" class="kpi-box warning">
                <span class="kpi-label text-blue">Potensi Omzet</span>
                <span class="kpi-value text-blue">Rp {{ number_format($stats['potensi_penjualan'], 0, ',', '.') }}</span>
                <span class="kpi-sub">Margin Kotor: Rp {{ number_format($stats['potensi_penjualan'] - $stats['nilai_inventaris'], 0, ',', '.') }}</span>
            </td>
            <td width="33%" class="kpi-box {{ $stok_menipis->count() > 0 ? 'alert' : 'highlight' }}">
                <span class="kpi-label {{ $stok_menipis->count() > 0 ? 'text-red' : 'text-green' }}">Status Gudang</span>
                <span class="kpi-value {{ $stok_menipis->count() > 0 ? 'text-red' : 'text-green' }}">
                    {{ $stok_menipis->count() > 0 ? $stok_menipis->count() . ' Item' : 'Aman' }}
                </span>
                <span class="kpi-sub">
                    {{ $stok_menipis->count() > 0 ? 'Butuh Restock Segera' : 'Semua Stok dalam Level Aman' }}
                </span>
            </td>
        </tr>
    </table>

    <div class="column-left">
        <div class="section-head"><span class="icon-box bg-red"></span> Prioritas Restock</div>
        @if($stok_menipis->count() > 0)
        <table class="data">
            <thead>
                <tr>
                    <th style="width: 60%">Barang</th>
                    <th style="width: 20%" class="text-center">Sisa</th>
                    <th style="width: 20%" class="text-center">Min</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stok_menipis->take(5) as $item)
                <tr>
                    <td><b>{{ $item->nama_barang }}</b></td>
                    <td class="text-center text-red font-bold">{{ $item->stok }} {{ $item->satuan }}</td>
                    <td class="text-center">{{ $item->stok_minimum }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="kpi-box highlight" style="text-align: center; color: #2f855a; padding: 10px;">
            <b>Kondisi Aman:</b> Tidak ada stok menipis.
        </div>
        @endif
    </div>

    <div class="column-right">
        <div class="section-head"><span class="icon-box bg-blue"></span> Sebaran Kategori</div>
        <table class="data">
            <thead>
                <tr>
                    <th style="width: 50%">Kategori</th>
                    <th style="width: 25%" class="text-center">Jml</th>
                    <th style="width: 25%" class="text-right">Porsi</th>
                </tr>
            </thead>
            <tbody>
                @php $totalItems = $kategori_chart->sum('barangs_count'); @endphp
                @foreach($kategori_chart->take(5) as $kat)
                <tr>
                    <td>{{ $kat->nama_kategori }}</td>
                    <td class="text-center">{{ $kat->barangs_count }}</td>
                    <td class="text-right">
                        {{ $totalItems > 0 ? round(($kat->barangs_count / $totalItems) * 100, 1) : 0 }}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Progress Bar untuk Kategori -->
        @if($kategori_chart->count() > 0)
        <div class="progress-container">
            @foreach($kategori_chart->take(3) as $kat)
            @php $percentage = $totalItems > 0 ? round(($kat->barangs_count / $totalItems) * 100, 1) : 0; @endphp
            <div class="progress-item">
                <div style="display: table; width: 100%; font-size: 7pt;">
                    <div style="display: table-cell; width: 40%; vertical-align: middle;">{{ $kat->nama_kategori }}</div>
                    <div style="display: table-cell; width: 50%; vertical-align: middle;">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $percentage }}%;"></div>
                        </div>
                    </div>
                    <div style="display: table-cell; width: 10%; text-align: right; padding-left: 5px; vertical-align: middle;">{{ $percentage }}%</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="clearfix"></div>

    <div class="section-head" style="margin-top: 15px;"><span class="icon-box bg-green"></span> Aktivitas Terkini</div>
    <table class="data">
        <thead>
            <tr>
                <th style="width: 15%">Waktu</th>
                <th style="width: 12%" class="text-center">Tipe</th>
                <th style="width: 38%">Barang</th>
                <th style="width: 10%" class="text-center">Qty</th>
                <th style="width: 25%" class="text-right">Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi_terbaru as $trx)
            <tr>
                <td>{{ $trx->tanggal_transaksi->format('d/m/y H:i') }}</td>
                <td class="text-center">
                    @if($trx->tipe_transaksi == 'masuk')
                        <span class="badge bg-green">MASUK</span>
                    @else
                        <span class="badge bg-red">KELUAR</span>
                    @endif
                </td>
                <td>{{ $trx->barang->nama_barang ?? '-' }}</td>
                <td class="text-center">{{ $trx->jumlah }}</td>
                <td class="text-right">Rp {{ number_format($trx->jumlah * $trx->harga_per_unit, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 10px; color: #718096; font-style: italic;">
                    Belum ada transaksi.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <table>
            <tr>
                <td width="70%">StockFlow - Smart Inventory Management System</td>
                <td width="30%" class="text-right">Halaman {PAGE_NUM} dari {PAGE_COUNT}</td>
            </tr>
        </table>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = $fontMetrics->get_font("Helvetica, Arial, sans-serif");
            $size = 7;
            $width = $fontMetrics->get_text_width($text, $font, $size);
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 12;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>

</body>
</html>
