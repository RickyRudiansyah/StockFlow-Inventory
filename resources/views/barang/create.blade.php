<x-app-layout>
    <x-slot name="header">Tambah Barang</x-slot>

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
            max-width: 800px;
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
            background: var(--sf-accent-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sf-accent);
        }

        .form-card-body { padding: 1.5rem; }

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

        .form-input::placeholder, .form-textarea::placeholder { color: var(--sf-text-muted); }
        .form-input:read-only { background: var(--sf-secondary); cursor: not-allowed; }
        .form-select { cursor: pointer; }
        .form-textarea { resize: vertical; min-height: 80px; font-family: inherit; }

        .form-error {
            color: var(--sf-danger);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .form-hint { font-size: 0.8rem; color: var(--sf-text-muted); margin-top: 0.35rem; }

        .form-row { display: grid; gap: 1rem; }
        @media (min-width: 480px) {
            .form-row.cols-2 { grid-template-columns: 1fr 1fr; }
            .form-row.cols-3 { grid-template-columns: 1fr 1fr 1fr; }
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
            white-space: nowrap;
        }

        .profit-preview {
            background: var(--sf-secondary);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .profit-preview-label { font-size: 0.8rem; color: var(--sf-text-muted); margin-bottom: 0.25rem; }
        .profit-preview-value { font-size: 1.25rem; font-weight: 700; color: var(--sf-success); }
        .profit-preview-percent { font-size: 0.85rem; color: var(--sf-text-muted); margin-left: 0.5rem; }
    </style>

    <nav class="breadcrumb">
        <a href="{{ route('barang.index') }}" class="breadcrumb-link">Barang</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Tambah Baru</span>
    </nav>

    <div class="form-card">
        <div class="form-card-header">
            <h2 class="form-card-title">
                <div class="form-card-title-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                Tambah Barang Baru
            </h2>
        </div>

        <div class="form-card-body">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf

                <!-- Informasi Dasar -->
                <div class="form-section">
                    <div class="form-section-title">Informasi Dasar</div>

                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label for="kode_barang" class="form-label">Kode Barang <span class="form-label-optional">(Auto)</span></label>
                            <input type="text" id="kode_barang" name="kode_barang" class="form-input" value="{{ old('kode_barang', $kodeBarang ?? '') }}" placeholder="BRG-00001" readonly>
                            <p class="form-hint">Kode akan di-generate otomatis jika dikosongkan</p>
                            @error('kode_barang')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" id="nama_barang" name="nama_barang" class="form-input" value="{{ old('nama_barang') }}" placeholder="Contoh: Laptop ASUS ROG" required autofocus>
                            @error('nama_barang')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select id="kategori_id" name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
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
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
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
                        <textarea id="deskripsi" name="deskripsi" class="form-textarea" placeholder="Deskripsi singkat tentang barang...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Harga -->
                <div class="form-section">
                    <div class="form-section-title">Harga</div>

                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <div class="input-group">
                                <input type="number" id="harga_beli" name="harga_beli" class="form-input" value="{{ old('harga_beli', 0) }}" placeholder="0" min="0" required onchange="calculateProfit()">
                                <span class="input-group-addon">Rupiah</span>
                            </div>
                            @error('harga_beli')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <div class="input-group">
                                <input type="number" id="harga_jual" name="harga_jual" class="form-input" value="{{ old('harga_jual', 0) }}" placeholder="0" min="0" required onchange="calculateProfit()">
                                <span class="input-group-addon">Rupiah</span>
                            </div>
                            @error('harga_jual')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="profit-preview" id="profitPreview" style="display: none;">
                        <div class="profit-preview-label">Estimasi Keuntungan per Unit</div>
                        <div>
                            <span class="profit-preview-value" id="profitValue">Rp 0</span>
                            <span class="profit-preview-percent" id="profitPercent">(0%)</span>
                        </div>
                    </div>
                </div>

                <!-- Stok -->
                <div class="form-section">
                    <div class="form-section-title">Stok & Satuan</div>

                    <div class="form-row cols-3">
                        <div class="form-group">
                            <label for="stok" class="form-label">Stok Awal</label>
                            <input type="number" id="stok" name="stok" class="form-input" value="{{ old('stok', 0) }}" min="0" required>
                            @error('stok')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stok_minimum" class="form-label">Stok Minimum</label>
                            <input type="number" id="stok_minimum" name="stok_minimum" class="form-input" value="{{ old('stok_minimum', 5) }}" min="0" required>
                            <p class="form-hint">Notifikasi muncul jika stok di bawah nilai ini</p>
                            @error('stok_minimum')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" id="satuan" name="satuan" class="form-input" value="{{ old('satuan') }}" placeholder="pcs, kg, unit, dll" required>
                            @error('satuan')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Lokasi (Opsional) -->
                <div class="form-section">
                    <div class="form-section-title">Informasi Tambahan</div>

                    <div class="form-group">
                        <label for="lokasi_penyimpanan" class="form-label">Lokasi Penyimpanan <span class="form-label-optional">(Opsional)</span></label>
                        <input type="text" id="lokasi_penyimpanan" name="lokasi_penyimpanan" class="form-input" value="{{ old('lokasi_penyimpanan') }}" placeholder="Contoh: Rak A-1, Gudang Utama">
                        @error('lokasi_penyimpanan')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function calculateProfit() {
            const hargaBeli = parseFloat(document.getElementById('harga_beli').value) || 0;
            const hargaJual = parseFloat(document.getElementById('harga_jual').value) || 0;
            const profitPreview = document.getElementById('profitPreview');
            const profitValue = document.getElementById('profitValue');
            const profitPercent = document.getElementById('profitPercent');

            if (hargaBeli > 0 && hargaJual > 0) {
                const profit = hargaJual - hargaBeli;
                const percentage = ((profit / hargaBeli) * 100).toFixed(1);

                profitValue.textContent = 'Rp ' + profit.toLocaleString('id-ID');
                profitPercent.textContent = '(' + percentage + '%)';
                profitPreview.style.display = 'block';

                if (profit < 0) {
                    profitValue.style.color = 'var(--sf-danger)';
                } else {
                    profitValue.style.color = 'var(--sf-success)';
                }
            } else {
                profitPreview.style.display = 'none';
            }
        }

        // Calculate on page load if values exist
        document.addEventListener('DOMContentLoaded', calculateProfit);
    </script>
</x-app-layout>
