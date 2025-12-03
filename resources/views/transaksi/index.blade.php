<x-app-layout>
    <x-slot name="header">Riwayat Transaksi</x-slot>

    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header-content h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--sf-text);
            margin-bottom: 0.25rem;
        }

        .page-header-content p {
            color: var(--sf-text-muted);
            font-size: 0.875rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--sf-accent) 0%, #60a5fa 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        /* Alert */
        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--sf-success);
        }

        /* Table Card */
        .table-card {
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 16px;
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead { background: var(--sf-secondary); }

        .data-table th {
            padding: 1rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--sf-text-muted);
            border-bottom: 1px solid var(--sf-border);
        }

        .data-table td {
            padding: 1rem;
            font-size: 0.9rem;
            color: var(--sf-text);
            border-bottom: 1px solid var(--sf-border);
            vertical-align: middle;
        }

        .data-table tbody tr { transition: background 0.2s ease; }
        .data-table tbody tr:hover { background: rgba(59, 130, 246, 0.05); }
        .data-table tbody tr:last-child td { border-bottom: none; }

        /* Transaction Type Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.75rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-masuk {
            background: var(--sf-success-light);
            color: var(--sf-success);
        }

        .badge-keluar {
            background: var(--sf-danger-light);
            color: var(--sf-danger);
        }

        /* User Cell */
        .user-cell {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--sf-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 0.75rem;
        }

        /* Jumlah */
        .jumlah-masuk { color: var(--sf-success); font-weight: 600; }
        .jumlah-keluar { color: var(--sf-danger); font-weight: 600; }

        /* Pagination */
        .pagination-wrapper {
            padding: 1rem;
            border-top: 1px solid var(--sf-border);
        }

        /* Empty State */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            background: var(--sf-secondary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sf-text-muted);
        }

        .empty-state h3 { font-size: 1.125rem; font-weight: 600; color: var(--sf-text); margin-bottom: 0.5rem; }
        .empty-state p { color: var(--sf-text-muted); font-size: 0.9rem; margin-bottom: 1.5rem; }

        /* Responsive */
        @media (max-width: 768px) {
            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td { display: block; }
            .data-table tr { padding: 1rem; border-bottom: 1px solid var(--sf-border); }
            .data-table td {
                padding: 0.5rem 0;
                border: none;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .data-table td::before {
                content: attr(data-label);
                font-weight: 600;
                font-size: 0.75rem;
                color: var(--sf-text-muted);
                text-transform: uppercase;
            }
        }
    </style>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h2>Riwayat Transaksi</h2>
            <p>Catat dan pantau semua transaksi stok barang</p>
        </div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Catat Transaksi
        </a>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Data Table -->
    <div class="table-card">
        @if($transaksis->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Oleh</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $transaksi)
                        <tr>
                            <td data-label="Tanggal">
                                <div>
                                    <div style="font-weight: 600;">{{ $transaksi->created_at->format('d M Y') }}</div>
                                    <div style="font-size: 0.8rem; color: var(--sf-text-muted);">{{ $transaksi->created_at->format('H:i') }}</div>
                                </div>
                            </td>
                            <td data-label="Barang">
                                {{ $transaksi->barang->nama_barang ?? '-' }}
                            </td>
                            <td data-label="Tipe">
                                @if($transaksi->tipe === 'masuk')
                                    <span class="badge badge-masuk">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                        </svg>
                                        Masuk
                                    </span>
                                @else
                                    <span class="badge badge-keluar">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                        </svg>
                                        Keluar
                                    </span>
                                @endif
                            </td>
                            <td data-label="Jumlah">
                                <span class="{{ $transaksi->tipe === 'masuk' ? 'jumlah-masuk' : 'jumlah-keluar' }}">
                                    {{ $transaksi->tipe === 'masuk' ? '+' : '-' }}{{ $transaksi->jumlah }} {{ $transaksi->barang->satuan ?? '' }}
                                </span>
                            </td>
                            <td data-label="Oleh">
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($transaksi->user->name ?? 'U', 0, 2)) }}
                                    </div>
                                    {{ $transaksi->user->name ?? '-' }}
                                </div>
                            </td>
                            <td data-label="Keterangan">
                                {{ $transaksi->keterangan ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($transaksis->hasPages())
                <div class="pagination-wrapper">
                    {{ $transaksis->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3>Belum ada transaksi</h3>
                <p>Catat transaksi pertama Anda untuk mulai melacak pergerakan stok.</p>
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Catat Transaksi
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
