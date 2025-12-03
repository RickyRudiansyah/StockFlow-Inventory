<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <style>
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon.blue { background: var(--sf-accent-light); color: var(--sf-accent); }
        .stat-icon.green { background: var(--sf-success-light); color: var(--sf-success); }
        .stat-icon.purple { background: rgba(139, 92, 246, 0.15); color: #8b5cf6; }
        .stat-icon.yellow { background: var(--sf-warning-light); color: var(--sf-warning); }
        .stat-icon.red { background: var(--sf-danger-light); color: var(--sf-danger); }
        .stat-icon.cyan { background: rgba(6, 182, 212, 0.15); color: #06b6d4; }

        .stat-content { flex: 1; }
        .stat-value { font-size: 1.75rem; font-weight: 800; color: var(--sf-text); line-height: 1.2; }
        .stat-label { font-size: 0.85rem; color: var(--sf-text-muted); margin-top: 0.25rem; }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 1024px) {
            .content-grid { grid-template-columns: 1fr 1fr; }
            .content-grid.full { grid-template-columns: 1fr; }
        }

        /* Cards */
        .card {
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 16px;
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--sf-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--sf-text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-title-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-title-icon.yellow { background: var(--sf-warning-light); color: var(--sf-warning); }
        .card-title-icon.blue { background: var(--sf-accent-light); color: var(--sf-accent); }
        .card-title-icon.green { background: var(--sf-success-light); color: var(--sf-success); }
        .card-title-icon.red { background: var(--sf-danger-light); color: var(--sf-danger); }

        .card-body { padding: 1.5rem; }
        .card-body.no-padding { padding: 0; }

        /* Alert List */
        .alert-list { display: flex; flex-direction: column; gap: 0.75rem; }

        .alert-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.875rem 1rem;
            background: var(--sf-secondary);
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .alert-item:hover { background: var(--sf-border); }

        .alert-item-info { display: flex; align-items: center; gap: 0.75rem; }

        .alert-item-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--sf-warning-light);
            color: var(--sf-warning);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert-item-name { font-weight: 600; color: var(--sf-text); font-size: 0.9rem; }
        .alert-item-category { font-size: 0.8rem; color: var(--sf-text-muted); }

        .alert-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            background: var(--sf-warning-light);
            color: var(--sf-warning);
        }

        .alert-badge.danger {
            background: var(--sf-danger-light);
            color: var(--sf-danger);
        }

        /* Empty State */
        .empty-state {
            padding: 2rem;
            text-align: center;
        }

        .empty-state-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 0.75rem;
            background: var(--sf-success-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sf-success);
        }

        .empty-state-text { color: var(--sf-text-muted); font-size: 0.9rem; }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 280px;
            padding: 1rem;
        }

        /* Transaction Table */
        .transaction-table { width: 100%; border-collapse: collapse; }

        .transaction-table th {
            padding: 0.875rem 1rem;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--sf-text-muted);
            background: var(--sf-secondary);
            border-bottom: 1px solid var(--sf-border);
        }

        .transaction-table td {
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            color: var(--sf-text);
            border-bottom: 1px solid var(--sf-border);
        }

        .transaction-table tbody tr:hover { background: rgba(59, 130, 246, 0.05); }
        .transaction-table tbody tr:last-child td { border-bottom: none; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.625rem;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .badge-masuk { background: var(--sf-success-light); color: var(--sf-success); }
        .badge-keluar { background: var(--sf-danger-light); color: var(--sf-danger); }

        /* Financial Cards */
        .financial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .financial-card {
            background: linear-gradient(135deg, var(--sf-card) 0%, var(--sf-secondary) 100%);
            border: 1px solid var(--sf-border);
            border-radius: 12px;
            padding: 1.25rem;
        }

        .financial-label { font-size: 0.8rem; color: var(--sf-text-muted); margin-bottom: 0.5rem; }
        .financial-value { font-size: 1.25rem; font-weight: 700; color: var(--sf-success); }
        .financial-value.profit { color: #8b5cf6; }

        /* Stock Ranking */
        .stock-list { display: flex; flex-direction: column; }

        .stock-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--sf-border);
        }

        .stock-item:last-child { border-bottom: none; }

        .stock-rank {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: var(--sf-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--sf-text-muted);
            margin-right: 0.75rem;
        }

        .stock-item-info { flex: 1; }
        .stock-item-name { font-weight: 600; color: var(--sf-text); font-size: 0.875rem; }
        .stock-item-category { font-size: 0.75rem; color: var(--sf-text-muted); }
        .stock-item-value { font-weight: 700; color: var(--sf-text); font-size: 0.9rem; }

        /* View All Link */
        .view-all {
            font-size: 0.8rem;
            color: var(--sf-accent);
            text-decoration: none;
            font-weight: 600;
        }

        .view-all:hover { text-decoration: underline; }
    </style>

    <!-- Financial Summary -->
    <div class="financial-grid">
        <div class="financial-card">
            <div class="financial-label">Total Nilai Aset Inventaris</div>
            <div class="financial-value">Rp {{ number_format($totalNilaiAset, 0, ',', '.') }}</div>
        </div>
        <div class="financial-card">
            <div class="financial-label">Potensi Keuntungan</div>
            <div class="financial-value profit">Rp {{ number_format($potensiProfit, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalBarang }}</div>
                <div class="stat-label">Total Produk</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalSupplier }}</div>
                <div class="stat-label">Total Supplier</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">
                <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalKategori }}</div>
                <div class="stat-label">Kategori Aktif</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon yellow">
                <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $barangMenipis->count() }}</div>
                <div class="stat-label">Stok Menipis</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $barangHabis }}</div>
                <div class="stat-label">Stok Habis</div>
            </div>
        </div>
    </div>

    <!-- Content Grid Row 1 -->
    <div class="content-grid">
        <!-- Low Stock Alert -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon yellow">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    Peringatan Stok Menipis
                </div>
                <a href="{{ route('barang.index') }}" class="view-all">Lihat Semua</a>
            </div>
            <div class="card-body">
                @if($barangMenipis->count() > 0)
                    <div class="alert-list">
                        @foreach($barangMenipis->take(5) as $barang)
                            <div class="alert-item">
                                <div class="alert-item-info">
                                    <div class="alert-item-icon">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="alert-item-name">{{ $barang->nama_barang }}</div>
                                        <div class="alert-item-category">{{ $barang->kategori->nama_kategori ?? '-' }}</div>
                                    </div>
                                </div>
                                <span class="alert-badge {{ $barang->stok <= 5 ? 'danger' : '' }}">
                                    Sisa: {{ $barang->stok }} {{ $barang->satuan }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="empty-state-text">Semua stok dalam kondisi aman</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Category Chart -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon blue">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                    Komposisi per Kategori
                </div>
            </div>
            <div class="card-body no-padding">
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid Row 2 - Stock Rankings -->
    <div class="content-grid">
        <!-- Stok Terbanyak -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon green">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    Stok Terbanyak
                </div>
            </div>
            <div class="card-body no-padding">
                <div class="stock-list">
                    @forelse($stokTerbanyak as $index => $barang)
                        <div class="stock-item">
                            <span class="stock-rank">{{ $index + 1 }}</span>
                            <div class="stock-item-info">
                                <div class="stock-item-name">{{ $barang->nama_barang }}</div>
                                <div class="stock-item-category">{{ $barang->kategori->nama_kategori ?? '-' }}</div>
                            </div>
                            <div class="stock-item-value">{{ $barang->stok }} {{ $barang->satuan }}</div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p class="empty-state-text">Belum ada data barang</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Stok Terendah -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon red">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                    </div>
                    Stok Terendah
                </div>
            </div>
            <div class="card-body no-padding">
                <div class="stock-list">
                    @forelse($stokTerendah as $index => $barang)
                        <div class="stock-item">
                            <span class="stock-rank">{{ $index + 1 }}</span>
                            <div class="stock-item-info">
                                <div class="stock-item-name">{{ $barang->nama_barang }}</div>
                                <div class="stock-item-category">{{ $barang->kategori->nama_kategori ?? '-' }}</div>
                            </div>
                            <div class="stock-item-value" style="color: var(--sf-warning);">{{ $barang->stok }} {{ $barang->satuan }}</div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p class="empty-state-text">Belum ada data barang</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="content-grid full">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon blue">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    Transaksi Terbaru
                </div>
                <a href="{{ route('transaksi.index') }}" class="view-all">Lihat Semua</a>
            </div>
            <div class="card-body no-padding">
                @if($transaksiTerbaru->count() > 0)
                    <table class="transaction-table">
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
                            @foreach($transaksiTerbaru as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                                    <td>{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                                    <td>
                                        @if($transaksi->tipe === 'masuk')
                                            <span class="badge badge-masuk">
                                                <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                                </svg>
                                                Masuk
                                            </span>
                                        @else
                                            <span class="badge badge-keluar">
                                                <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                                </svg>
                                                Keluar
                                            </span>
                                        @endif
                                    </td>
                                    <td style="font-weight: 600; color: {{ $transaksi->tipe === 'masuk' ? 'var(--sf-success)' : 'var(--sf-danger)' }}">
                                        {{ $transaksi->tipe === 'masuk' ? '+' : '-' }}{{ $transaksi->jumlah }}
                                    </td>
                                    <td>{{ $transaksi->user->name ?? '-' }}</td>
                                    <td style="color: var(--sf-text-muted);">{{ $transaksi->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <p class="empty-state-text">Belum ada transaksi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartValues) !!},
                    backgroundColor: [
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#06b6d4',
                        '#ec4899',
                        '#84cc16'
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#94a3b8',
                            padding: 15,
                            font: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
