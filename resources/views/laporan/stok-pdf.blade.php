<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        /* RESET SANGAT SEDERHANA */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.3;
            padding: 0;
            margin: 0;
        }

        /* HEADER */
        .header {
            background: #4361ee;
            color: white;
            padding: 15px 20px;
            text-align: center;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header .subtitle {
            font-size: 10px;
            opacity: 0.9;
        }

        /* META INFO */
        .meta-info {
            display: table;
            width: 100%;
            margin-bottom: 15px;
            padding: 0 20px;
        }

        .meta-info .left, .meta-info .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .meta-info p {
            margin-bottom: 2px;
            font-size: 9px;
        }

        /* SUMMARY */
        .summary-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 12px;
            margin: 0 20px 15px 20px;
        }

        .summary-grid {
            display: table;
            width: 100%;
        }

        .summary-item {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 5px;
        }

        .summary-item .value {
            font-size: 14px;
            font-weight: bold;
        }

        .summary-item .label {
            font-size: 8px;
            color: #666;
        }

        /* TABLE */
        .content {
            padding: 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table th {
            background: #495057;
            color: white;
            padding: 6px 4px;
            text-align: left;
            font-size: 8px;
            border: 1px solid #dee2e6;
        }

        table td {
            padding: 6px 4px;
            border: 1px solid #dee2e6;
            font-size: 8px;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* BADGES */
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        /* FOOTER */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 8px 20px;
            font-size: 8px;
        }

        .footer .left { float: left; }
        .footer .right { float: right; }

        .currency {
            font-family: 'DejaVu Sans Mono', monospace;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="subtitle">Dibuat pada: {{ $date }}</div>
    </div>

    <div class="meta-info">
        <div class="left">
            <p><strong>Filter:</strong></p>
            <p>Kategori: {{ $filter['kategori'] }}</p>
            <p>Stok Menipis: {{ $filter['stok_menipis'] }}</p>
        </div>
        <div class="right">
            <p><strong>Dicetak oleh:</strong> {{ $printed_by }}</p>
            <p><strong>Total Data:</strong> {{ $summary['total_items'] }} item</p>
        </div>
    </div>

    <div class="summary-box">
        <h3>RINGKASAN</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="value">{{ number_format($summary['total_items']) }}</div>
                <div class="label">Total Jenis</div>
            </div>
            <div class="summary-item">
                <div class="value currency">Rp {{ number_format($summary['total_nilai_beli'], 0, ',', '.') }}</div>
                <div class="label">Nilai Beli</div>
            </div>
            <div class="summary-item">
                <div class="value currency">Rp {{ number_format($summary['total_nilai_jual'], 0, ',', '.') }}</div>
                <div class="label">Nilai Jual</div>
            </div>
            <div class="summary-item">
                <div class="value">{{ $summary['stok_menipis'] }}</div>
                <div class="label">Stok Menipis</div>
            </div>
        </div>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>SKU</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th class="text-right">Harga Beli</th>
                    <th class="text-right">Harga Jual</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Min</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $index => $barang)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $barang->sku }}</strong></td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $barang->supplier->nama_supplier ?? '-' }}</td>
                    <td class="text-right currency">{{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                    <td class="text-right currency">{{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                    <td class="text-center"><strong>{{ $barang->stok }}</strong></td>
                    <td class="text-center">{{ $barang->stok_minimum }}</td>
                    <td class="text-center">
                        @if($barang->stok <= $barang->stok_minimum)
                            <span class="badge badge-danger">MENIPIS</span>
                        @else
                            <span class="badge badge-success">AMAN</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="left">StockFlow - Inventory System</div>
        <div class="right">Halaman <span class="page-number"></span></div>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("DejaVu Sans");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 20;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>
