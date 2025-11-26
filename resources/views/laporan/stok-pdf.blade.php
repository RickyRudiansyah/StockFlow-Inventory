<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Laporan Stok Barang' }}</title>
    <style>
        /* RESET & SETUP */
        @page { margin: 25px 30px; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 9pt; color: #2d3748; line-height: 1.3; }

        /* HEADER BRANDING */
        .header { border-bottom: 3px solid #3182ce; padding-bottom: 10px; margin-bottom: 15px; }
        .header h1 { font-size: 18pt; font-weight: 800; color: #1a202c; margin: 0; text-transform: uppercase; }
        .header .meta { text-align: right; font-size: 8pt; color: #718096; }
        .brand { color: #3182ce; font-weight: bold; }

        /* KPI CARDS */
        .kpi-container { width: 100%; border-collapse: separate; border-spacing: 8px; margin-bottom: 20px; width: calc(100% + 16px); margin-left: -8px; }
        .kpi-card { background: #f7fafc; padding: 10px; border-radius: 6px; border: 1px solid #edf2f7; text-align: center; }
        .kpi-card.highlight { background: #ebf8ff; border-color: #bee3f8; }
        .kpi-value { font-size: 12pt; font-weight: bold; color: #2c5282; display: block; margin-bottom: 2px; }
        .kpi-label { font-size: 6pt; text-transform: uppercase; color: #718096; letter-spacing: 0.5px; }

        /* SECTION TITLE & ICONS REPLACEMENT */
        .section-title {
            font-size: 10pt; font-weight: bold; color: #2d3748;
            border-left: 4px solid #3182ce; padding-left: 8px;
            margin: 15px 0 10px 0; text-transform: uppercase;
            display: flex; align-items: center;
        }

        /* PENGGANTI EMOJI: KOTAK WARNA KECIL */
        .icon-box {
            display: inline-block; width: 10px; height: 10px; margin-right: 6px; border-radius: 2px; vertical-align: middle;
        }
        .bg-blue { background: #3182ce; }
        .bg-green { background: #38a169; }
        .bg-red { background: #e53e3e; }
        .bg-dark { background: #2d3748; }

        /* DATA TABLE */
        table.data { width: 100%; border-collapse: collapse; font-size: 8pt; }
        table.data th { background: #2d3748; color: white; padding: 6px 8px; text-align: left; text-transform: uppercase; font-size: 7pt; letter-spacing: 0.5px; }
        table.data td { padding: 6px 8px; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
        table.data tr:nth-child(even) { background: #f7fafc; }

        /* UTILITIES */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-mono { font-family: 'Courier New', Courier, monospace; letter-spacing: -0.5px; }
        .font-bold { font-weight: bold; }

        /* BADGES STATUS */
        .badge { padding: 2px 5px; border-radius: 3px; font-size: 6pt; font-weight: bold; text-transform: uppercase; display: inline-block; min-width: 50px; text-align: center;}
        .badge-safe { background: #c6f6d5; color: #22543d; border: 1px solid #9ae6b4; } /* AMAN */
        .badge-low { background: #fed7d7; color: #742a2a; border: 1px solid #feb2b2; } /* KRITIS */
        .badge-out { background: #2d3748; color: #fff; border: 1px solid #1a202c; } /* HABIS */
        .badge-over { background: #bee3f8; color: #2c5282; border: 1px solid #90cdf4; } /* OVERSTOCK */

        /* VISUAL CHARTS (CSS) */
        .chart-container { width: 100%; height: 20px; background: #e2e8f0; border-radius: 4px; overflow: hidden; display: flex; margin-bottom: 5px; }
        .chart-bar { height: 100%; display: inline-block; text-align: center; color: rgba(255,255,255,0.9); font-size: 6pt; line-height: 20px; font-weight: bold; }

        /* LEGEND */
        .legend { font-size: 7pt; color: #718096; margin-bottom: 15px; }
        .dot { height: 8px; width: 8px; border-radius: 50%; display: inline-block; margin-right: 3px; vertical-align: middle; }

        /* FOOTER */
        .footer { position: fixed; bottom: -15px; left: 0; right: 0; font-size: 7pt; color: #a0aec0; border-top: 1px solid #e2e8f0; padding-top: 5px; }
    </style>
</head>
<body>

    <table class="header" width="100%">
        <tr>
            <td width="60%">
                <h1>Laporan Analisis Stok</h1>
                <div style="color: #718096; font-size: 9pt; margin-top: 2px;">
                    Filter: {{ $filter['kategori'] ?? 'Semua' }} | Status: {{ $filter['stok_menipis'] ?? 'Semua' }}
                </div>
            </td>
            <td width="40%" class="meta">
                <span class="brand">STOCKFLOW ANALYTICS</span><br>
                Dicetak: {{ $date }}<br>
                Oleh: {{ $printed_by }}
            </td>
        </tr>
    </table>

    @php
        // LOGIC HITUNG STATUS
        $totalItems = $barangs->count();
        $habis = $barangs->where('stok', 0)->count();
        $kritis = $barangs->where('stok', '>', 0)->filter(fn($b) => $b->stok <= $b->stok_minimum)->count();
        $over = $barangs->where('stok', '>', 50)->count(); // Asumsi Overstock > 50
        $aman = $totalItems - ($habis + $kritis + $over);

        // PERSENTASE CHART
        $pctHabis = $totalItems > 0 ? ($habis / $totalItems) * 100 : 0;
        $pctKritis = $totalItems > 0 ? ($kritis / $totalItems) * 100 : 0;
        $pctOver = $totalItems > 0 ? ($over / $totalItems) * 100 : 0;
        $pctAman = $totalItems > 0 ? ($aman / $totalItems) * 100 : 0;
    @endphp

    <table class="kpi-container">
        <tr>
            <td class="kpi-card highlight">
                <span class="kpi-value font-mono">Rp {{ number_format($summary['total_nilai_beli'], 0, ',', '.') }}</span>
                <span class="kpi-label">Total Nilai Aset (Modal)</span>
            </td>
            <td class="kpi-card">
                <span class="kpi-value font-mono" style="color: #38a169;">Rp {{ number_format($summary['total_nilai_jual'] - $summary['total_nilai_beli'], 0, ',', '.') }}</span>
                <span class="kpi-label">Potensi Profit (Margin)</span>
            </td>
            <td class="kpi-card" style="{{ $habis > 0 ? 'background:#fff5f5; border-color:#feb2b2;' : '' }}">
                <span class="kpi-value" style="{{ $habis > 0 ? 'color:#e53e3e;' : '' }}">{{ $habis }} SKU</span>
                <span class="kpi-label">Stok Habis (0)</span>
            </td>
            <td class="kpi-card">
                <span class="kpi-value">{{ $kritis }} SKU</span>
                <span class="kpi-label">Perlu Restock</span>
            </td>
        </tr>
    </table>

    <div class="section-title"><span class="icon-box bg-blue"></span> Distribusi Kesehatan Stok</div>
    <div class="chart-container">
        @if($pctAman > 0) <div class="chart-bar" style="width:{{ $pctAman }}%; background:#48bb78;">{{ round($pctAman) }}%</div> @endif
        @if($pctOver > 0) <div class="chart-bar" style="width:{{ $pctOver }}%; background:#4299e1;">{{ round($pctOver) }}%</div> @endif
        @if($pctKritis > 0) <div class="chart-bar" style="width:{{ $pctKritis }}%; background:#f56565;">{{ round($pctKritis) }}%</div> @endif
        @if($pctHabis > 0) <div class="chart-bar" style="width:{{ $pctHabis }}%; background:#2d3748;">{{ round($pctHabis) }}%</div> @endif
    </div>
    <div class="legend">
        <span class="dot" style="background:#48bb78;"></span>Aman
        <span class="dot" style="background:#4299e1; margin-left:10px;"></span>Overstock (>50)
        <span class="dot" style="background:#f56565; margin-left:10px;"></span>Kritis (<= Min)
        <span class="dot" style="background:#2d3748; margin-left:10px;"></span>Habis (0)
    </div>

    <table width="100%" style="margin-bottom: 20px;">
        <tr>
            <td width="48%" valign="top">
                <div class="section-title"><span class="icon-box bg-red"></span> Top 5 Stok Menipis/Habis</div>
                <table class="data">
                    <thead>
                        <tr><th>Barang</th><th class="text-center">Sisa</th><th class="text-center">Min</th></tr>
                    </thead>
                    <tbody>
                        @forelse($barangs->sortBy('stok')->take(5) as $item)
                        <tr>
                            <td>{{ $item->nama_barang }}</td>
                            <td class="text-center font-bold {{ $item->stok == 0 ? 'text-red' : '' }}">{{ $item->stok }}</td>
                            <td class="text-center">{{ $item->stok_minimum }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center">-</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
            <td width="4%"></td>
            <td width="48%" valign="top">
                <div class="section-title"><span class="icon-box bg-green"></span> Top 5 Stok Terbanyak</div>
                <table class="data">
                    <thead>
                        <tr><th>Barang</th><th class="text-center">Stok</th><th class="text-right">Aset (Rp)</th></tr>
                    </thead>
                    <tbody>
                        @forelse($barangs->sortByDesc('stok')->take(5) as $item)
                        <tr>
                            <td>{{ $item->nama_barang }}</td>
                            <td class="text-center font-bold">{{ $item->stok }}</td>
                            <td class="text-right font-mono">{{ number_format($item->stok * $item->harga_beli, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center">-</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title"><span class="icon-box bg-dark"></span> Detail Inventaris Lengkap</div>
    <table class="data">
        <thead>
            <tr>
                <th width="3%" class="text-center">No</th>
                <th width="8%">SKU</th>
                <th width="20%">Nama Barang</th>
                <th width="10%">Kategori</th>
                <th width="10%" class="text-right">Hrg Beli</th>
                <th width="10%" class="text-right">Hrg Jual</th>
                <th width="10%" class="text-right">Margin (Rp)</th>
                <th width="7%" class="text-center">Stok</th>
                <th width="12%" class="text-right">Total Aset</th>
                <th width="10%" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $index => $barang)
            @php
                $marginRp = $barang->harga_jual - $barang->harga_beli;
                $marginPct = $barang->harga_beli > 0 ? ($marginRp / $barang->harga_beli) * 100 : 0;
                $totalAset = $barang->stok * $barang->harga_beli;

                // TENTUKAN STATUS PER BARIS
                if ($barang->stok == 0) {
                    $statusBadge = '<span class="badge badge-out">HABIS</span>';
                } elseif ($barang->stok <= $barang->stok_minimum) {
                    $statusBadge = '<span class="badge badge-low">KRITIS</span>';
                } elseif ($barang->stok > 50) {
                    $statusBadge = '<span class="badge badge-over">OVER</span>';
                } else {
                    $statusBadge = '<span class="badge badge-safe">AMAN</span>';
                }
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="font-mono">{{ $barang->sku }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                <td class="text-right font-mono">{{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                <td class="text-right font-mono">{{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                <td class="text-right">
                    <div class="font-mono">{{ number_format($marginRp, 0, ',', '.') }}</div>
                    <div style="font-size: 6pt; color: #38a169;">{{ round($marginPct) }}%</div>
                </td>
                <td class="text-center font-bold">{{ $barang->stok }}</td>
                <td class="text-right font-mono font-bold">{{ number_format($totalAset, 0, ',', '.') }}</td>
                <td class="text-center">{!! $statusBadge !!}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center" style="padding: 20px; color: #a0aec0;">Tidak ada data barang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <table width="100%">
            <tr>
                <td width="70%">StockFlow Analytics | Data bersifat rahasia.</td>
                <td width="30%" style="text-align: right;">Hal <span style="content: counter(page)"></span></td>
            </tr>
        </table>
    </div>

</body>
</html>
