<x-app-layout>
    <x-slot name="header">Edit Barang</x-slot>

    <style>
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .breadcrumb-link { color: var(--sf-text-muted); text-decoration: none; transition: color 0.2s ease; }
        .breadcrumb-link:hover { color: var(--sf-accent); }
        .breadcrumb-separator { color: var(--sf-text-muted); }
        .breadcrumb-current { color: var(--sf-text); font-weight: 600; }

        .form-card {
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 16px;
            max-width: 700px;
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

        .info-box-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--sf-accent) 0%, #60a5fa 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .info-box-content { flex: 1; }
        .info-box-name { font-weight: 600; color: var(--sf-text); margin-bottom: 0.25rem; }
        .info-box-meta { font-size: 0.8rem; color: var(--sf-text-muted); }

        .form-section { margin-bottom: 2rem; }

        .form-section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--sf-text-muted);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--sf-border);
        }

        .form-group { margin-bottom: 1.25rem; }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--sf-text);
            margin-bottom: 0.5rem;
        }

        .form-label-optional { font-weight: 400; color: var(--sf-text-muted); font-size: 0.8rem; }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.875rem 1rem;
            background: var(--sf-primary);
            border: 1px solid var(--sf-border);
            border-radius: 10px;
            color: var(--sf-text);
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--sf-accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-select { cursor: pointer; }
        .form-textarea { resize: vertical; min-height: 80px; font-family: inherit; }

        .form-error { color: var(--sf-danger); font-size: 0.8rem; margin-top: 0.5rem; }
        .form-hint { font-size: 0.8rem; color: var(--sf-text-muted); margin-top: 0.35rem; }

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

        .btn-secondary { background: var(--sf-secondary); border: 1px solid var(--sf-border); color: var(--sf-text-muted); }
        .btn-secondary:hover { background: var(--sf-border); color: var(--sf-text); }

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

        .input-group { display: flex; gap: 0; }
        .input-group .form-input { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .input-group-addon {
            padding: 0.875rem 1rem;
            background: var(--sf-secondary);
            border: 1px solid var(--sf-border);
            border-left: none;
            border-radius: 0 10px 10px 0;
            color: var(--sf-text-muted);
            font-size: 0.9rem;
        }
    </style>

    <nav class="breadcrumb">
        <a href="{{ route('barang.index') }}" class="breadcrumb-link">Barang</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Edit: {{ $barang->nama_barang }}</span>
    </nav>

    <div class="form-card">
        <div class="form-card-header">
            <h2 class="form-card-title">
                <div class="form-card-title-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                Edit Barang
            </h2>
        </div>

        <div class="form-card-body">
            <div class="info-box">
                <div class="info-box-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div class="info-box-content">
                    <div class="info-box-name">{{ $barang->nama_barang }}</div>
                    <div class="info-box-meta">Stok saat ini: {{ $barang->stok }} {{ $barang->satuan }} • Ditambahkan {{ $barang->created_at->format('d M Y') }}</div>
                </div>
            </div>

            <form action="{{ route('barang.update', $barang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <div class="form-section-title">Informasi Dasar</div>

                    <div class="form-group">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-input" value="{{ old('nama_barang', $barang->nama_barang) }}" required autofocus>
                        @error('nama_barang')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select id="kategori_id" name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="supplier_id" class="form-label">Supplier</label>
                            <select id="supplier_id" name="supplier_id" class="form-select" required>
                                <option value="">-- Pilih Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $barang->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="form-label-optional">(Opsional)</span></label>
                        <textarea id="deskripsi" name="deskripsi" class="form-textarea">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">Harga & Stok</div>

                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label for="harga" class="form-label">Harga</label>
                            <div class="input-group">
                                <input type="number" id="harga" name="harga" class="form-input" value="{{ old('harga', $barang->harga) }}" min="0" required>
                                <span class="input-group-addon">Rupiah</span>
                            </div>
                            @error('harga')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" id="satuan" name="satuan" class="form-input" value="{{ old('satuan', $barang->satuan) }}" required>
                            @error('satuan')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" id="stok" name="stok" class="form-input" value="{{ old('stok', $barang->stok) }}" min="0" required>
                            <p class="form-hint">Untuk perubahan stok besar, gunakan menu Transaksi</p>
                            @error('stok')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stok_minimum" class="form-label">Stok Minimum</label>
                            <input type="number" id="stok_minimum" name="stok_minimum" class="form-input" value="{{ old('stok_minimum', $barang->stok_minimum) }}" min="0" required>
                            @error('stok_minimum')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Update Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
