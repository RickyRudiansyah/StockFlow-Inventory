<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'DejaVu Sans', Arial, sans-serif;
        }

        body {
            font-size: 11px;
            color: #333;
            line-height: 1.5;
            min-height: 100vh;
            padding-bottom: 60px; /* ruang untuk footer */
            position: relative;
        }

        .header {
            background: #06d6a0;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #05b989;
        }

        .header h1 {
            font-size: 20px;
            font-weight: bold;
        }

        .header .subtitle {
            font-size: 11px;
            opacity: 0.9;
        }

        .meta-info {
            display: flex;
            justify-content: space-between;
            padding: 15px 20px;
            background: #f8f9fa;
        }

        .meta-card {
            background: #ffffff;
            border-left: 4px solid #06d6a0;
            padding: 10px;
            box-shadow: 0 0 3px rgba(0,0,0,0.05);
        }

        .meta-card p {
            margin-bottom: 4px;
            font-size: 10px;
        }

        .summary-box {
            margin: 20px;
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }

        .summary-box h3 {
            font-size: 12px;
            margin-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 5px;
        }

        .summary-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .summary-item {
            flex: 1;
            min-width: 100px;
            text-align: center;
            margin: 5px;
        }

        .summary-item .value {
            font-size: 14px;
            font-weight: bold;
        }

        .summary-item .label {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
        }

        .summary-item.in .value {
            color: #28a745;
        }

        .summary-item.out .value {
            color: #dc3545;
        }

        .content {
            padding: 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            font-size: 9px;
        }

        table th {
            background: #495057;
            color: white;
            text-transform: uppercase;
        }

        table tbody tr:hover {
            background-color: #e9f5f2;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-in {
            background: #d4edda;
            color: #155724;
        }

        .badge-out {
            background: #f8d7da;
            color: #721c24;
        }

        .currency {
            font-family: 'DejaVu Sans Mono', monospace;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 10px 20px;
            font-size: 9px;
            display: flex;
            justify-content: space-between;
        }

        @media print {
            .footer {
                position: relative;
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN TRANSAKSI</h1>
        <div class="subtitle">Dibuat pada: {{ $date }}</div>
    </div>

    <div class="meta-info">
        <div class="meta-card">
            <p><strong>FILTER LAPORAN:</strong></p>
            <p>Periode: {{ $filter['periode'] }}</p>
            <p>Tipe: {{ $filter['tipe'] }}</p>
        </div>
        <div class="meta-card">
            <p><strong>Dicetak oleh:</strong> {{ $printed_by }}</p>
            <p><strong>Total Data:</strong> {{ $summary['total_transaksi'] }} transaksi</p>
        </div>
    </div>

    <div class="summary-box">
        <h3>📊 RINGKASAN TRANSAKSI</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="value">{{ number_format($summary['total_transaksi']) }}</div>
                <div class="label">Total Transaksi</div>
            </div>
            <div class="summary-item in">
                <div class="value">{{ number_format($summary['total_masuk']) }}</div>
                <div class="label">Barang Masuk</div>
            </div>
            <div class="summary-item out">
                <div class="value">{{ number_format($summary['total_keluar']) }}</div>
                <div class="label">Barang Keluar</div>
            </div>
            <div class="summary-item in">
                <div class="value currency">Rp {{ number_format($summary['nilai_masuk'], 0, ',', '.') }}</div>
                <div class="label">Nilai Masuk</div>
            </div>
            <div class="summary-item out">
                <div class="value currency">Rp {{ number_format($summary['nilai_keluar'], 0, ',', '.') }}</div>
                <div class="label">Nilai Keluar</div>
            </div>
        </div>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 12%">Tanggal</th>
                    <th style="width: 10%">Tipe</th>
                    <th style="width: 25%">Nama Barang</th>
                    <th style="width: 10%" class="text-center">Jumlah</th>
                    <th style="width: 13%" class="text-right">Harga per Unit</th>
                    <th style="width: 13%" class="text-right">Total</th>
                    <th style="width: 12%">Oleh</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $index => $trx)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $trx->tanggal_transaksi->format('d/m/Y') }}</strong></td>
                    <td class="text-center">
                        @if($trx->tipe_transaksi === 'masuk')
                            <span class="badge badge-in">🟢 MASUK</span>
                        @else
                            <span class="badge badge-out">🔴 KELUAR</span>
                        @endif
                    </td>
                    <td>{{ $trx->barang->nama_barang ?? '-' }}</td>
                    <td class="text-center"><strong>{{ $trx->jumlah }}</strong></td>
                    <td class="text-right currency">Rp {{ number_format($trx->harga_per_unit, 0, ',', '.') }}</td>
                    <td class="text-right currency"><strong>Rp {{ number_format($trx->jumlah * $trx->harga_per_unit, 0, ',', '.') }}</strong></td>
                    <td>{{ $trx->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 15px; color: #666;">
                        Tidak ada data transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div>StockFlow - Smart Inventory Management System</div>
        <div>Halaman {
