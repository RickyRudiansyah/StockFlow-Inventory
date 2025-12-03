<x-app-layout>
    <x-slot name="header">Catat Transaksi</x-slot>

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
            background: var(--sf-accent-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sf-accent);
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

        .form-error {
            color: var(--sf-danger);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Transaction Type Selector */
        .tipe-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .tipe-option {
            position: relative;
        }

        .tipe-option input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .tipe-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            padding: 1.25rem;
            background: var(--sf-primary);
            border: 2px solid var(--sf-border);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .tipe-option label:hover {
            border-color: var(--sf-text-muted);
        }

        .tipe-option input:checked + label {
            border-color: var(--sf-accent);
            background: var(--sf-accent-light);
        }

        .tipe-option.masuk input:checked + label {
            border-color: var(--sf-success);
            background: var(--sf-success-light);
        }

        .tipe-option.keluar input:checked + label {
            border-color: var(--sf-danger);
            background: var(--sf-danger-light);
        }

        .tipe-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tipe-option.masuk .tipe-icon {
            background: var(--sf-success-light);
            color: var(--sf-success);
        }

        .tipe-option.keluar .tipe-icon {
            background: var(--sf-danger-light);
            color: var(--sf-danger);
        }

        .tipe-label {
            font-weight: 600;
            color: var(--sf-text);
        }

        .tipe-desc {
            font-size: 0.8rem;
            color: var(--sf-text-muted);
        }

        /* Barang Info */
        .barang-info {
            background: var(--sf-secondary);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 0.75rem;
            display: none;
        }

        .barang-info.show { display: block; }

        .barang-info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.375rem 0;
        }

        .barang-info-label { color: var(--sf-text-muted); font-size: 0.85rem; }
        .barang-info-value { color: var(--sf-text); font-weight: 600; font-size: 0.85rem; }

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
    </style>

    <nav class="breadcrumb">
        <a href="{{ route('transaksi.index') }}" class="breadcrumb-link">Transaksi</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Catat Baru</span>
    </nav>

    <div class="form-card">
        <div class="form-card-header">
            <h2 class="form-card-title">
                <div class="form-card-title-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                Catat Transaksi Baru
            </h2>
        </div>

        <div class="form-card-body">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Tipe Transaksi</label>
                    <div class="tipe-selector">
                        <div class="tipe-option masuk">
                            <input type="radio" name="tipe" id="tipe_masuk" value="masuk" {{ old('tipe') == 'masuk' ? 'checked' : '' }} required>
                            <label for="tipe_masuk">
                                <div class="tipe-icon">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                    </svg>
                                </div>
                                <span class="tipe-label">Barang Masuk</span>
                                <span class="tipe-desc">Penambahan stok</span>
                            </label>
                        </div>
                        <div class="tipe-option keluar">
                            <input type="radio" name="tipe" id="tipe_keluar" value="keluar" {{ old('tipe') == 'keluar' ? 'checked' : '' }}>
                            <label for="tipe_keluar">
                                <div class="tipe-icon">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                    </svg>
                                </div>
                                <span class="tipe-label">Barang Keluar</span>
                                <span class="tipe-desc">Pengurangan stok</span>
                            </label>
                        </div>
                    </div>
                    @error('tipe')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="barang_id" class="form-label">Pilih Barang</label>
                    <select id="barang_id" name="barang_id" class="form-select" required onchange="showBarangInfo(this)">
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}"
                                    data-stok="{{ $barang->stok }}"
                                    data-satuan="{{ $barang->satuan }}"
                                    data-harga="{{ $barang->harga }}"
                                    {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                {{ $barang->nama_barang }} (Stok: {{ $barang->stok }} {{ $barang->satuan }})
                            </option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    <div class="barang-info" id="barangInfo">
                        <div class="barang-info-row">
                            <span class="barang-info-label">Stok Tersedia</span>
                            <span class="barang-info-value" id="infoStok">-</span>
                        </div>
                        <div class="barang-info-row">
                            <span class="barang-info-label">Harga Satuan</span>
                            <span class="barang-info-value" id="infoHarga">-</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-input" value="{{ old('jumlah') }}" placeholder="Masukkan jumlah" min="1" required>
                    @error('jumlah')
                        <p class="form-error">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keterangan" class="form-label">Keterangan <span class="form-label-optional">(Opsional)</span></label>
                    <textarea id="keterangan" name="keterangan" class="form-textarea" placeholder="Contoh: Pembelian dari supplier X">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showBarangInfo(select) {
            const infoBox = document.getElementById('barangInfo');
            const infoStok = document.getElementById('infoStok');
            const infoHarga = document.getElementById('infoHarga');

            if (select.value) {
                const option = select.options[select.selectedIndex];
                const stok = option.dataset.stok;
                const satuan = option.dataset.satuan;
                const harga = option.dataset.harga;

                infoStok.textContent = stok + ' ' + satuan;
                infoHarga.textContent = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
                infoBox.classList.add('show');
            } else {
                infoBox.classList.remove('show');
            }
        }

        // Show info on page load if barang is already selected
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('barang_id');
            if (select.value) {
                showBarangInfo(select);
            }
        });
    </script>
</x-app-layout>
