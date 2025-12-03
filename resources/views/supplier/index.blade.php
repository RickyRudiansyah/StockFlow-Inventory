<x-app-layout>
    <x-slot name="header">Kelola Supplier</x-slot>

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

        /* Stat Cards */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-card-icon.green { background: var(--sf-success-light); color: var(--sf-success); }
        .stat-card-icon.blue { background: var(--sf-accent-light); color: var(--sf-accent); }
        .stat-card-icon.purple { background: rgba(139, 92, 246, 0.15); color: #8b5cf6; }

        .stat-card-value { font-size: 1.75rem; font-weight: 700; color: var(--sf-text); }
        .stat-card-label { font-size: 0.8rem; color: var(--sf-text-muted); }

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

        .data-table thead {
            background: var(--sf-secondary);
        }

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

        .data-table tbody tr {
            transition: background 0.2s ease;
        }

        .data-table tbody tr:hover {
            background: rgba(59, 130, 246, 0.05);
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Supplier Cell */
        .supplier-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .supplier-avatar {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--sf-success) 0%, #34d399 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .supplier-info-name {
            font-weight: 600;
            color: var(--sf-text);
            margin-bottom: 0.125rem;
        }

        .supplier-info-person {
            font-size: 0.8rem;
            color: var(--sf-text-muted);
        }

        /* Contact Cell */
        .contact-cell {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--sf-text-muted);
        }

        .contact-item svg {
            color: var(--sf-accent);
            flex-shrink: 0;
        }

        /* Address Cell */
        .address-cell {
            max-width: 200px;
            font-size: 0.85rem;
            color: var(--sf-text-muted);
            line-height: 1.4;
        }

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

        .badge-primary {
            background: var(--sf-accent-light);
            color: var(--sf-accent);
        }

        .badge-success {
            background: var(--sf-success-light);
            color: var(--sf-success);
        }

        /* Actions */
        .actions-cell {
            display: flex;
            gap: 0.5rem;
        }

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

        .btn-icon-edit {
            background: var(--sf-warning-light);
            color: var(--sf-warning);
        }

        .btn-icon-edit:hover {
            background: var(--sf-warning);
            color: white;
        }

        .btn-icon-delete {
            background: var(--sf-danger-light);
            color: var(--sf-danger);
        }

        .btn-icon-delete:hover {
            background: var(--sf-danger);
            color: white;
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

        .empty-state h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--sf-text);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--sf-text-muted);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .data-table thead { display: none; }
            .data-table, .data-table tbody, .data-table tr, .data-table td {
                display: block;
            }
            .data-table tr {
                padding: 1rem;
                border-bottom: 1px solid var(--sf-border);
            }
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
            .supplier-cell { flex-direction: column; align-items: flex-end; text-align: right; }
            .contact-cell { align-items: flex-end; }
            .actions-cell { justify-content: flex-end; }
        }
    </style>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h2>Daftar Supplier</h2>
            <p>Kelola data supplier dan rekanan bisnis Anda</p>
        </div>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Supplier
        </a>
    </div>

    <!-- Stat Cards -->
    <div class="stat-cards">
        <div class="stat-card">
            <div class="stat-card-icon green">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div>
                <div class="stat-card-value">{{ $suppliers->count() }}</div>
                <div class="stat-card-label">Total Supplier</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon blue">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <div class="stat-card-value">{{ $suppliers->sum('barangs_count') }}</div>
                <div class="stat-card-label">Total Barang</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-icon purple">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <div class="stat-card-value">{{ $suppliers->where('barangs_count', '>', 0)->count() }}</div>
                <div class="stat-card-label">Supplier Aktif</div>
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
        @if($suppliers->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th>Jumlah Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td data-label="Supplier">
                                <div class="supplier-cell">
                                    <div class="supplier-avatar">
                                        {{ strtoupper(substr($supplier->nama_supplier, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="supplier-info-name">{{ $supplier->nama_supplier }}</div>
                                        @if($supplier->kontak_person)
                                            <div class="supplier-info-person">{{ $supplier->kontak_person }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td data-label="Kontak">
                                <div class="contact-cell">
                                    @if($supplier->telepon)
                                        <div class="contact-item">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            {{ $supplier->telepon }}
                                        </div>
                                    @endif
                                    @if($supplier->email)
                                        <div class="contact-item">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $supplier->email }}
                                        </div>
                                    @endif
                                    @if(!$supplier->telepon && !$supplier->email)
                                        <span style="color: var(--sf-text-muted);">-</span>
                                    @endif
                                </div>
                            </td>
                            <td data-label="Alamat">
                                <div class="address-cell">
                                    {{ $supplier->alamat ?? '-' }}
                                </div>
                            </td>
                            <td data-label="Jumlah Barang">
                                @if($supplier->barangs_count > 0)
                                    <span class="badge badge-success">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                        {{ $supplier->barangs_count }} Barang
                                    </span>
                                @else
                                    <span class="badge badge-primary">
                                        0 Barang
                                    </span>
                                @endif
                            </td>
                            <td data-label="Aksi">
                                <div class="actions-cell">
                                    <a href="{{ route('supplier.edit', $supplier) }}" class="btn-icon btn-icon-edit" title="Edit">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('supplier.destroy', $supplier) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus supplier {{ $supplier->nama_supplier }}?')">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3>Belum ada supplier</h3>
                <p>Tambahkan supplier pertama Anda untuk mulai mengelola data rekanan bisnis.</p>
                <a href="{{ route('supplier.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Supplier
                </a>
            </div>
        @endif
    </div>
</x-app-layout>


