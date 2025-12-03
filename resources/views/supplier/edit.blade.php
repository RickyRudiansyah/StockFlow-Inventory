<x-app-layout>
    <x-slot name="header">Edit Supplier</x-slot>

    <style>
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .breadcrumb-link {
            color: var(--sf-text-muted);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .breadcrumb-link:hover { color: var(--sf-accent); }
        .breadcrumb-separator { color: var(--sf-text-muted); }
        .breadcrumb-current { color: var(--sf-text); font-weight: 600; }

        .form-card {
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 16px;
            max-width: 600px;
        }

        .form-card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--sf-border);
        }

        .form-card-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--sf-text);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-card-title-icon {
            width: 40px;
            height: 40px;
            background: var(--sf-warning-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sf-warning);
        }

        .form-card-body { padding: 1.5rem; }

        .info-box {
            background: var(--sf-secondary);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .info-box-avatar {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--sf-success) 0%, #34d399 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .info-box-content { flex: 1; }
        .info-box-name { font-weight: 600; color: var(--sf-text); margin-bottom: 0.25rem; }
        .info-box-meta { font-size: 0.8rem; color: var(--sf-text-muted); }

        .form-group { margin-bottom: 1.5rem; }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--sf-text);
            margin-bottom: 0.5rem;
        }

        .form-label-optional {
            font-weight: 400;
            color: var(--sf-text-muted);
            font-size: 0.8rem;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 0.875rem 1rem;
            background: var(--sf-primary);
            border: 1px solid var(--sf-border);
            border-radius: 10px;
            color: var(--sf-text);
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--sf-accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-error {
            color: var(--sf-danger);
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .form-row { display: grid; gap: 1rem; }
        @media (min-width: 480px) {
            .form-row.cols-2 { grid-template-columns: 1fr 1fr; }
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            padding-top: 1rem;
            border-top: 1px solid var(--sf-border);
            margin-top: 1.5rem;
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

        .btn-secondary {
            background: var(--sf-secondary);
            border: 1px solid var(--sf-border);
            color: var(--sf-text-muted);
        }

        .btn-secondary:hover {
            background: var(--sf-border);
            color: var(--sf-text);
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
    </style>

    <nav class="breadcrumb">
        <a href="{{ route('supplier.index') }}" class="breadcrumb-link">Supplier</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Edit: {{ $supplier->nama_supplier }}</span>
    </nav>

    <div class="form-card">
        <div class="form-card-header">
            <h2 class="form-card-title">
                <div class="form-card-title-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                Edit Supplier
            </h2>
        </div>

        <div class="form-card-body">
            <div class="info-box">
                <div class="info-box-avatar">{{ strtoupper(substr($supplier->nama_supplier, 0, 2)) }}</div>
                <div class="info-box-content">
                    <div class="info-box-name">{{ $supplier->nama_supplier }}</div>
                    <div class="info-box-meta">Ditambahkan {{ $supplier->created_at->format('d M Y') }} • Terakhir diubah {{ $supplier->updated_at->diffForHumans() }}</div>
                </div>
            </div>

            <form action="{{ route('supplier.update', $supplier) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                    <input type="text" id="nama_supplier" name="nama_supplier" class="form-input" value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required autofocus>
                    @error('nama_supplier')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row cols-2">
                    <div class="form-group">
                        <label for="telepon" class="form-label">Telepon <span class="form-label-optional">(Opsional)</span></label>
                        <input type="text" id="telepon" name="telepon" class="form-input" value="{{ old('telepon', $supplier->telepon) }}">
                        @error('telepon')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="form-label-optional">(Opsional)</span></label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $supplier->email) }}">
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat <span class="form-label-optional">(Opsional)</span></label>
                    <textarea id="alamat" name="alamat" class="form-textarea">{{ old('alamat', $supplier->alamat) }}</textarea>
                    @error('alamat')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Update Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
