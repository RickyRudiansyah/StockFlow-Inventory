<x-app-layout>
    <x-slot name="header">Tambah Supplier</x-slot>

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
            background: var(--sf-success-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sf-success);
        }

        .form-card-body { padding: 1.5rem; }
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

        .form-input::placeholder, .form-textarea::placeholder { color: var(--sf-text-muted); }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-error {
            color: var(--sf-danger);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
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
            background: linear-gradient(135deg, var(--sf-success) 0%, #34d399 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }
    </style>

    <nav class="breadcrumb">
        <a href="{{ route('supplier.index') }}" class="breadcrumb-link">Supplier</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Tambah Baru</span>
    </nav>

    <div class="form-card">
        <div class="form-card-header">
            <h2 class="form-card-title">
                <div class="form-card-title-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                Tambah Supplier Baru
            </h2>
        </div>

        <div class="form-card-body">
            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                    <input type="text" id="nama_supplier" name="nama_supplier" class="form-input" value="{{ old('nama_supplier') }}" placeholder="PT. Contoh Supplier" required autofocus>
                    @error('nama_supplier')
                        <p class="form-error">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-row cols-2">
                    <div class="form-group">
                        <label for="telepon" class="form-label">Telepon <span class="form-label-optional">(Opsional)</span></label>
                        <input type="text" id="telepon" name="telepon" class="form-input" value="{{ old('telepon') }}" placeholder="021-12345678">
                        @error('telepon')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="form-label-optional">(Opsional)</span></label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="supplier@email.com">
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat <span class="form-label-optional">(Opsional)</span></label>
                    <textarea id="alamat" name="alamat" class="form-textarea" placeholder="Jl. Contoh No. 123, Jakarta">{{ old('alamat') }}</textarea>
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
                        Simpan Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
