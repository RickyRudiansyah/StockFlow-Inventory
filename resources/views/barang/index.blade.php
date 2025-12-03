<x-app-layout>
    <x-slot name="header">Kelola Barang</x-slot>

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

        /* Filter Bar */
        .filter-bar {
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
        }

        .filter-group { flex: 1; min-width: 150px; }
        .filter-group.search { min-width: 250px; }

        .filter-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--sf-text-muted);
            margin-bottom: 0.375rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .filter-input, .filter-select {
            width: 100%;
            padding: 0.625rem 0.875rem;
            background: var(--sf-primary);
            border: 1px solid var(--sf-border);
            border-radius: 8px;
            color: var(--sf-text);
            font-size: 0.875rem;
        }

        .filter-input:focus, .filter-select:focus {
            outline: none;
            border-color: var(--sf-accent);
        }

        .filter-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-filter {
            padding: 0.625rem 1rem;
            font-size: 0.8rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-filter-apply {
            background: var(--sf-accent);
            border: none;
            color: white;
        }

        .btn-filter-reset {
            background: var(--sf-secondary);
            border: 1px solid var(--sf-border);
            color: var(--sf-text-muted);
            text-decoration: none;
        }

        /* Stat Cards */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .stat-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-card-icon.blue { background: var(--sf-accent-light); color: var(--sf-accent); }
        .stat-card-icon.yellow { background: var(--sf-warning-light); color: var(--sf-warning); }
        .stat-card-icon.red { background: var(--sf-danger-light); color: var(--sf-danger); }
        .stat-card-icon.green { background: var(--sf-success-light); color: var(--sf-success); }

        .stat-card-value { font-size: 1.5rem; font-weight: 700; color: var(--sf-text); }
        .stat-card-label { font-size: 0.75rem; color: var(--sf-text-muted); }

        /* Alert Messages */
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

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--sf-danger);
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

        /* Product Cell */
        .product-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .product-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--sf-accent) 0%, #60a5fa 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .product-info-name { font-weight: 600; color: var(--sf-text); }
        .product-info-code { font-size: 0.8rem; color: var(--sf-text-muted); }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.375rem 0.75rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-primary { background: var(--sf-accent-light); color: var(--sf-accent); }
        .badge-success { background: var(--sf-success-light); color: var(--sf-success); }
        .badge-warning { background: var(--sf-warning-light); color: var(--sf-warning); }
        .badge-danger { background: var(--sf-danger-light); color: var(--sf-danger); }

        /* Stock Status */
        .stock-cell { display: flex; flex-direction: column; gap: 0.25rem; }
        .stock-value { font-weight: 600; }
        .stock-min { font-size: 0.75rem; color: var(--sf-text-muted); }

        /* Price */
        .price-cell { font-weight: 600; color: var(--sf-success); }
        .price-beli { font-size: 0.8rem; color: var(--sf-text-muted); }

        /* Actions */
        .actions-cell { display: flex; gap: 0.5rem; }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-icon-edit { background: var(--sf-warning-light); color: var(--sf-warning); }
        .btn-icon-edit:hover { background: var(--sf-warning); color: white; }
        .btn-icon-delete { background: var(--sf-danger-light); color: var(--sf-danger); }
        .btn-icon-delete:hover { background: var(--sf-danger); color: white; }

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
        @media (max-width: 1024px) {
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
            .product-cell { flex-direction: column; align-items: flex-end; text-align: right; }
            .actions-cell { justify-content: flex-end; }
        }
    </style>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h2>Daftar Barang</h2>
            <p>Kelola inventaris produk dan stok Anda</p>
        </div>
        <a href="{{ route('barang.create') }}" class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Barang
        </a>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('barang.index') }}" method="GET" class="filter-bar">
        <div class="filter-group search">
            <label class="filter-label">Pencarian</label>
            <input type="text" name="search" class="filter-input" placeholder="Cari nama atau kode barang..." value="{{ request('search') }}">
        </div>
        <div class="filter-group">
            <label class="filter-label">Kategori</label>
            <select name="kategori" class="filter-select">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label class="filter-label">Supplier</label>
            <select name="supplier" class="filter-select">
                <option value="">Semua Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ request('supplier') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama_supplier }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label class="filter-label">Status Stok</label>
            <select name="status" class="filter-select">
                <option value="">Semua Status</option>
                <option value="aman" {{ request('status') == 'aman' ? 'selected' : '' }}>Stok Aman</option>
                <option value="menipis" {{ request('status') == 'menipis' ? 'selected' : '' }}>Stok Menipis</option>
                <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Stok Habis</option>
            </select>
        </div>
        <div class="filter-actions">
            <button type="submit" class="btn-filter btn-filter-apply">Filter</button>
            <a href="{{ route('barang.index') }}" class="btn-filter btn-filter-reset">Reset</a>
        </div>
    </form>

    <!-- Stat Cards -->
    <div class="stat-cards">
        <div class="stat-card">
            <div class="stat-card-icon blue">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <div class="stat-card-value">{{ $barangs->count() }}</div>
                <div class="stat-card-label">Total Barang</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon green">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <div class="stat-card-value">{{ $barangs->filter(fn($b) => $b->stok > $b->stok_minimum)->count() }}</div>
                <div class="stat-card-label">Stok Aman</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon yellow">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <div class="stat-card-value">{{ $barangs->filter(fn($b) => $b->stok > 0 && $b->stok <= $b->stok_minimum)->count() }}</div>
                <div class="stat-card-label">Stok Menipis</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon red">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div>
                <div class="stat-card-value">{{ $barangs->where('stok', 0)->count() }}</div>
                <div class="stat-card-label">Stok Habis</div>
            </div>
        </div>
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

    @if(session('error'))
        <div class="alert alert-error">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Data Table -->
    <div class="table-card">
        @if($barangs->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $barang)
                        <tr>
                            <td data-label="Barang">
                                <div class="product-cell">
                                    <div class="product-avatar">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="product-info-name">{{ $barang->nama_barang }}</div>
                                        <div class="product-info-code">{{ $barang->kode_barang ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Kategori">
                                <span class="badge badge-primary">{{ $barang->kategori->nama_kategori ?? '-' }}</span>
                            </td>
                            <td data-label="Supplier">
                                {{ $barang->supplier->nama_supplier ?? '-' }}
                            </td>
                            <td data-label="Harga">
                                <div>
                                    <div class="price-cell">Rp {{ number_format($barang->harga_jual ?? 0, 0, ',', '.') }}</div>
                                    <div class="price-beli">Beli: Rp {{ number_format($barang->harga_beli ?? 0, 0, ',', '.') }}</div>
                                </div>
                            </td>
                            <td data-label="Stok">
                                <div class="stock-cell">
                                    @if($barang->stok == 0)
                                        <span class="badge badge-danger">Habis</span>
                                    @elseif($barang->stok <= $barang->stok_minimum)
                                        <span class="badge badge-warning">{{ $barang->stok }} {{ $barang->satuan }}</span>
                                    @else
                                        <span class="stock-value">{{ $barang->stok }} {{ $barang->satuan }}</span>
                                    @endif
                                    <span class="stock-min">Min: {{ $barang->stok_minimum }}</span>
                                </div>
                            </td>
                            <td data-label="Aksi">
                                <div class="actions-cell">
                                    <a href="{{ route('barang.edit', $barang) }}" class="btn-icon btn-icon-edit" title="Edit">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('barang.destroy', $barang) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus barang {{ $barang->nama_barang }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3>Belum ada barang</h3>
                <p>Tambahkan barang pertama Anda untuk mulai mengelola inventaris.</p>
                <a href="{{ route('barang.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Barang
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
