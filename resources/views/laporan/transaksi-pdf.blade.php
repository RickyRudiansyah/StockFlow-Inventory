<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Laporan Transaksi' }}</title>
    <style>
        /* --- 1. RESET & TYPOGRAPHY (UI/UX Best Practice) --- */
        @page {
            margin: 20px 25px; /* Margin diperkecil agar area data maksimal */
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif; /* Font standar yang bersih */
            font-size: 10px; /* Ukuran optimal untuk data padat */
            color: #2d3748; /* Dark Grey (lebih nyaman di mata daripada Hitam pekat) */
            line-height: 1.4;
        }

        /* --- 2. HEADER SECTION (Visual Hierarchy) --- */
        .header-container {
            border-bottom: 2px solid #05b989;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }
        .header-left {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }
        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 40%;
        }
        .report-title {
            font-size: 18px;
            font-weight: 800;
            color: #1a202c;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }
        .company-name {
            font-size: 12px;
            color: #05b989; /* Aksen Brand Color */
            font-weight: bold;
        }
        .meta-text {
            font-size: 9px;
            color: #718096;
        }

        /* --- 3. SUMMARY CARDS (Data Visualization) --- */
        .summary-container {
            width: 100%;
            margin-bottom: 25px;
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        .metric-box {
            text-align: center;
            padding: 0 10px;
            border-right: 1px solid #cbd5e0;
        }
        .metric-box:last-child {
            border-right: none;
        }
        .metric-value {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
        }
        .metric-label {
            font-size: 8px;
            text-transform: uppercase;
            color: #718096;
            letter-spacing: 0.5px;
        }
        /* Color Coding for Metrics */
        .text-blue { color: #3182ce; }
        .text-green { color: #38a169; }
        .text-red { color: #e53e3e; }

        /* --- 4. DATA TABLE (Core UX) --- */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
        }

        table.data-table th {
            background-color: #2d3748; /* Header Gelap untuk kontras tinggi */
            color: #ffffff;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 10px 8px;
            text-align: left;
            border-bottom: 2px solid #1a202c;
        }

        table.data-table th:first-child {
            border-top-left-radius: 6px;
        }

        table.data-table th:last-child {
            border-top-right-radius: 6px;
        }

        table.data-table td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        /* Zebra Striping untuk kemudahan baca baris panjang */
        table.data-table tr:nth-child(even) {
            background-color: #f7fafc;
        }

        /* Row Coloring berdasarkan tipe transaksi */
        table.data-table tr.masuk-row {
            background-color: #f0fff4 !important;
        }

        table.data-table tr.keluar-row {
            background-color: #fff5f5 !important;
        }

        /* ANTI-POTONG: Mencegah baris terpotong di tengah halaman */
        table.data-table tr {
            page-break-inside: avoid;
        }

        /* Helpers */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-mono { font-family: 'Courier New', Courier, monospace; letter-spacing: -0.5px; }
        .bold { font-weight: bold; }

        /* --- 5. BADGES (Visual Indicators) --- */
        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }
        .badge-in {
            background-color: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }
        .badge-out {
            background-color: #fed7d7;
            color: #742a2a;
            border: 1px solid #feb2b2;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 20px;
            font-size: 8px;
            color: #a0aec0;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
        }

        /* Summary Row */
        .summary-row {
            background-color: #edf2f7 !important;
            font-weight: bold;
            border-top: 2px solid #cbd5e0;
        }

        /* Print Optimization */
        @media print {
            .header-container, .summary-container {
                break-inside: avoid;
            }

            .data-table {
                break-inside: auto;
            }

            tr {
                break-inside: avoid;
                break-after: auto;
            }
        }
    </style>
</head>
<body>

    <div class="header-container">
        <div class="header-left">
            <div class="company-name">StockFlow System</div>
            <h1 class="report-title">{{ $title ?? 'Laporan Transaksi' }}</h1>
        </div>
        <div class="header-right">
            <div class="meta-text">Dicetak oleh: <span class="bold">{{ $printed_by ?? 'Admin' }}</span></div>
            <div class="meta-text">Tanggal Cetak: {{ $date ?? date('d F Y') }}</div>
            <div class="meta-text">Filter: {{ $filter['periode'] ?? 'Semua' }} | {{ $filter['tipe'] ?? 'Semua' }}</div>
        </div>
    </div>

    <div class="summary-container">
        <table class="summary-table">
            <tr>
                <td class="metric-box">
                    <span class="metric-value text-blue">{{ number_format($summary['total_transaksi'] ?? 0) }}</span>
                    <span class="metric-label">Total Transaksi</span>
                </td>
                <td class="metric-box">
                    <span class="metric-value text-green">{{ number_format($summary['total_masuk'] ?? 0) }}</span>
                    <span class="metric-label">Item Masuk</span>
                </td>
                <td class="metric-box">
                    <span class="metric-value text-red">{{ number_format($summary['total_keluar'] ?? 0) }}</span>
                    <span class="metric-label">Item Keluar</span>
                </td>
                <td class="metric-box">
                    <span class="metric-value text-green font-mono">Rp {{ number_format($summary['nilai_masuk'] ?? 0, 0, ',', '.') }}</span>
                    <span class="metric-label">Valuasi Masuk</span>
                </td>
                <td class="metric-box">
                    <span class="metric-value text-red font-mono">Rp {{ number_format($summary['nilai_keluar'] ?? 0, 0, ',', '.') }}</span>
                    <span class="metric-label">Valuasi Keluar</span>
                </td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%" class="text-center">No</th>
                <th style="width: 12%">Tanggal</th>
                <th style="width: 10%" class="text-center">Tipe</th>
                <th style="width: 23%">Nama Barang</th>
                <th style="width: 10%" class="text-center">Jml</th>
                <th style="width: 15%" class="text-right">Harga Unit</th>
                <th style="width: 15%" class="text-right">Total Nilai</th>
                <th style="width: 10%">User</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $index => $trx)
            <tr class="{{ $trx->tipe_transaksi === 'masuk' ? 'masuk-row' : 'keluar-row' }}">
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $trx->tanggal_transaksi->format('d/m/Y') }}</td>
                <td class="text-center">
                    @if($trx->tipe_transaksi === 'masuk')
                        <span class="badge badge-in">Masuk</span>
                    @else
                        <span class="badge badge-out">Keluar</span>
                    @endif
                </td>
                <td style="font-weight: 600; color: #4a5568;">
                    {{ $trx->barang->nama_barang ?? '-' }}
                </td>
                <td class="text-center bold">{{ $trx->jumlah }}</td>
                <td class="text-right font-mono">
                    Rp {{ number_format($trx->harga_per_unit, 0, ',', '.') }}
                </td>
                <td class="text-right font-mono bold">
                    Rp {{ number_format($trx->jumlah * $trx->harga_per_unit, 0, ',', '.') }}
                </td>
                <td style="font-size: 9px; color: #718096;">
                    {{ $trx->user->name ?? '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center" style="padding: 20px; color: #a0aec0; font-style: italic;">
                    -- Tidak ada data transaksi untuk periode ini --
                </td>
            </tr>
            @endforelse

            @if($transaksis->count() > 0)
            <tr class="summary-row">
                <td colspan="5" class="text-right bold" style="padding-right: 15px;">TOTAL:</td>
                <td class="text-right font-mono bold">
                    Rp {{ number_format($transaksis->sum('harga_per_unit'), 0, ',', '.') }}
                </td>
                <td class="text-right font-mono bold">
                    Rp {{ number_format($transaksis->sum(function($item) {
                        return $item->jumlah * $item->harga_per_unit;
                    }), 0, ',', '.') }}
                </td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <table width="100%">
            <tr>
                <td width="70%">StockFlow - Generated Automatically</td>
                <td width="30%" class="text-right">Halaman <span class="page-number"></span></td>
            </tr>
        </table>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = $fontMetrics->get_font("Helvetica, Arial, sans-serif");
            $size = 8;
            $width = $fontMetrics->get_text_width($text, $font, $size);
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 15;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>

</body>
</html>
