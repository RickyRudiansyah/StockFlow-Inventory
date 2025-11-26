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
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
            width: 20%;
            text-align: center;
            padding: 5px;
        }
        .summary-item .value {
            font-size: 14px;
            font-weight: bold;
            color: #495057;
        }
        .summary-item .label {
            font-size: 8px;
            color: #6c757d;
            text-transform: uppercase;
        }
        .summary-item.in .value {
            color: #28a745;
        }
        .summary-item.out .value {
            color: #dc3545;
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
        .badge-in {
            background: #d4edda;
            color: #155724;
        }
        .badge-out {
            background: #f8d7da;
            color: #721c24;
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
            <p>{{ __('laporan.periode') }}: {{ $filter['periode'] }}</p>
            <p>{{ __('laporan.tipe') }}: {{ $filter['tipe'] }}</p>
        </div>
        <div class="right">
            <p><strong>{{ __('laporan.printed_by') }}:</strong> {{ $printed_by }}</p>
            <p><strong>{{ __('laporan.total_data') }}:</strong> {{ $summary['total_transaksi'] }} {{ __('laporan.transaksi') }}</p>
        </div>
    </div>

    <div class="summary-box">
        <h3>{{ __('laporan.ringkasan') }}</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="value">{{ number_format($summary['total_transaksi']) }}</div>
                <div class="label">{{ __('laporan.total_transaksi') }}</div>
            </div>
            <div class="summary-item in">
                <div class="value">{{ number_format($summary['total_masuk']) }}</div>
                <div class="label">{{ __('laporan.barang_masuk') }}</div>
            </div>
            <div class="summary-item out">
                <div class="value">{{ number_format($summary['total_keluar']) }}</div>
                <div class="label">{{ __('laporan.barang_keluar') }}</div>
            </div>
            <div class="summary-item in">
                <div class="value currency">Rp {{ number_format($summary['nilai_masuk'], 0, ',', '.') }}</div>
                <div class="label">{{ __('laporan.nilai_masuk') }}</div>
            </div>
            <div class="summary-item out">
                <div class="value currency">Rp {{ number_format($summary['nilai_keluar'], 0, ',', '.') }}</div>
                <div class="label">{{ __('laporan.nilai_keluar') }}</div>
            </div>
        </div>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 12%">{{ __('laporan.tanggal') }}</th>
                    <th style="width: 10%">{{ __('laporan.tipe') }}</th>
                    <th style="width: 25%">{{ __('laporan.nama_barang') }}</th>
                    <th style="width: 10%" class="text-center">{{ __('laporan.jumlah') }}</th>
                    <th style="width: 13%" class="text-right">{{ __('laporan.harga_unit') }}</th>
                    <th style="width: 13%" class="text-right">{{ __('laporan.total') }}</th>
                    <th style="width: 12%">{{ __('laporan.oleh') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $index => $trx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $trx->tanggal_transaksi->format('d/m/Y') }}</td>
                    <td>
                        @if($trx->tipe_transaksi === 'masuk')
                            <span class="badge badge-in">▲ {{ __('laporan.masuk') }}</span>
                        @else
                            <span class="badge badge-out">▼ {{ __('laporan.keluar') }}</span>
                        @endif
                    </td>
                    <td>{{ $trx->barang->nama_barang ?? '-' }}</td>
                    <td class="text-center"><strong>{{ $trx->jumlah }}</strong></td>
                    <td class="text-right currency">{{ number_format($trx->harga_per_unit, 0, ',', '.') }}</td>
                    <td class="text-right currency"><strong>{{ number_format($trx->jumlah * $trx->harga_per_unit, 0, ',', '.') }}</strong></td>
                    <td>{{ $trx->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">{{ __('laporan.tidak_ada_data') }}</td>
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
