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
            padding: 20px 30px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 22px;
            margin-bottom: 5px;
        }
        .header .subtitle {
            font-size: 11px;
            opacity: 0.9;
        }
        .header .company {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        .meta-info {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            padding: 0 30px;
        }
        .meta-info .left, .meta-info .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .meta-info .right {
            text-align: right;
        }
        .meta-info p {
            margin-bottom: 3px;
            font-size: 9px;
            color: #666;
        }
        .meta-info strong {
            color: #333;
        }
        .summary-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin: 0 30px 20px 30px;
        }
        .summary-box h3 {
            font-size: 11px;
            color: #495057;
            margin-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 5px;
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
            font-size: 16px;
            font-weight: bold;
            color: #495057;
        }
        .summary-item .label {
            font-size: 8px;
            color: #6c757d;
            text-transform: uppercase;
        }
        .summary-item.warning .value {
            color: #dc3545;
        }
        .summary-item.success .value {
            color: #28a745;
        }
        .content {
            padding: 0 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background: #495057;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table td {
            padding: 8px 6px;
            border-bottom: 1px solid #dee2e6;
            font-size: 9px;
        }
        table tr:nth-child(even) {
            background: #f8f9fa;
        }
        table tr:hover {
            background: #e9ecef;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
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
        .page-break {
            page-break-after: always;
        }
        .currency {
            font-family: 'DejaVu Sans Mono', monospace;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company">StockFlow</div>
        <h1>{{ $title }}</h1>
        <div class="subtitle">{{ __('laporan.generated_at') }}: {{ $date }}</div>
    </div>

    <div class="meta-info">
        <div class="left">
            <p><strong>{{ __('laporan.filter') }}:</strong></p>
            <p>{{ __('laporan.kategori') }}: {{ $filter['kategori'] }}</p>
            <p>{{ __('laporan.stok_menipis_only') }}: {{ $filter['stok_menipis'] }}</p>
        </div>
        <div class="right">
            <p><strong>{{ __('laporan.printed_by') }}:</strong> {{ $printed_by }}</p>
            <p><strong>{{ __('laporan.total_data') }}:</strong> {{ $summary['total_items'] }} {{ __('laporan.items') }}</p>
        </div>
    </div>

    <div class="summary-box">
        <h3>{{ __('laporan.ringkasan') }}</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="value">{{ number_format($summary['total_items']) }}</div>
                <div class="label">{{ __('laporan.total_jenis') }}</div>
            </div>
            <div class="summary-item success">
                <div class="value currency">Rp {{ number_format($summary['total_nilai_beli'], 0, ',', '.') }}</div>
                <div class="label">{{ __('laporan.nilai_beli') }}</div>
            </div>
            <div class="summary-item success">
                <div class="value currency">Rp {{ number_format($summary['total_nilai_jual'], 0, ',', '.') }}</div>
                <div class="label">{{ __('laporan.nilai_jual') }}</div>
            </div>
            <div class="summary-item warning">
                <div class="value">{{ $summary['stok_menipis'] }}</div>
                <div class="label">{{ __('laporan.stok_menipis') }}</div>
            </div>
        </div>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th style="width: 4%">No</th>
                    <th style="width: 10%">SKU</th>
                    <th style="width: 20%">{{ __('laporan.nama_barang') }}</th>
                    <th style="width: 12%">{{ __('laporan.kategori') }}</th>
                    <th style="width: 12%">{{ __('laporan.supplier') }}</th>
                    <th style="width: 10%" class="text-right">{{ __('laporan.harga_beli') }}</th>
                    <th style="width: 10%" class="text-right">{{ __('laporan.harga_jual') }}</th>
                    <th style="width: 8%" class="text-center">{{ __('laporan.stok') }}</th>
                    <th style="width: 6%" class="text-center">Min</th>
                    <th style="width: 8%" class="text-center">Status</th>
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
                    <td class="text-center"><strong>{{ $barang->stok }}</strong> {{ $barang->satuan }}</td>
                    <td class="text-center">{{ $barang->stok_minimum }}</td>
                    <td class="text-center">
                        @if($barang->stok <= $barang->stok_minimum)
                            <span class="badge badge-danger">{{ __('laporan.menipis') }}</span>
                        @else
                            <span class="badge badge-success">{{ __('laporan.aman') }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">{{ __('laporan.tidak_ada_data') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="left">StockFlow - Smart Inventory Management System</div>
        <div class="right">{{ __('laporan.halaman') }} {PAGE_NUM} {{ __('laporan.dari') }} {PAGE_COUNT}</div>
    </div>
</body>
</html>
