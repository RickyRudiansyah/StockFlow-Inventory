<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StockFlow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.8/dist/css/bootstrap.min.css')}}">
    <script src="{{asset('bootstrap-5.3.8/dist/js/bootstrap.bundle.min.js')}}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --sf-primary: #0f172a;
            --sf-secondary: #1e293b;
            --sf-accent: #3b82f6;
            --sf-accent-hover: #2563eb;
            --sf-accent-light: rgba(59, 130, 246, 0.1);
            --sf-success: #10b981;
            --sf-success-light: rgba(16, 185, 129, 0.1);
            --sf-warning: #f59e0b;
            --sf-warning-light: rgba(245, 158, 11, 0.1);
            --sf-danger: #ef4444;
            --sf-danger-light: rgba(239, 68, 68, 0.1);
            --sf-text: #f8fafc;
            --sf-text-muted: #94a3b8;
            --sf-border: #334155;
            --sf-card: #1e293b;
            --sf-sidebar: #0f172a;
            --sf-body: #0c1222;
        }

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--sf-body);
            color: var(--sf-text);
            min-height: 100vh;
        }

        /* Main Layout */
        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--sf-sidebar);
            border-right: 1px solid var(--sf-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 50;
            transition: transform 0.3s ease;
        }

        .sidebar.hidden-mobile {
            transform: translateX(-100%);
        }

        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0) !important;
            }
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--sf-border);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .sidebar-logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--sf-accent) 0%, #60a5fa 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .sidebar-logo-icon svg {
            width: 24px;
            height: 24px;
            color: white;
        }

        .sidebar-logo-text {
            font-size: 1.375rem;
            font-weight: 800;
            color: var(--sf-text);
            letter-spacing: -0.02em;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--sf-text-muted);
            padding: 0 0.75rem;
            margin-bottom: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--sf-text-muted);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.925rem;
        }

        .nav-item:hover {
            background: var(--sf-accent-light);
            color: var(--sf-text);
        }

        .nav-item.active {
            background: var(--sf-accent);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .nav-item-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .nav-item-badge {
            margin-left: auto;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.2rem 0.5rem;
            border-radius: 100px;
            background: var(--sf-danger);
            color: white;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid var(--sf-border);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--sf-secondary);
            border-radius: 12px;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .user-card:hover {
            background: var(--sf-card);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--sf-accent) 0%, #60a5fa 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 0.9rem;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            color: var(--sf-text);
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--sf-text-muted);
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .role-badge {
            display: inline-flex;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .role-badge.admin {
            background: var(--sf-danger-light);
            color: var(--sf-danger);
        }

        .role-badge.staff {
            background: var(--sf-accent-light);
            color: var(--sf-accent);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        @media (min-width: 1024px) {
            .main-content {
                margin-left: 280px;
            }
        }

        /* Top Header */
        .top-header {
            background: var(--sf-sidebar);
            border-bottom: 1px solid var(--sf-border);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid var(--sf-border);
            border-radius: 10px;
            background: transparent;
            color: var(--sf-text);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .mobile-menu-btn:hover {
            background: var(--sf-secondary);
        }

        @media (min-width: 1024px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--sf-text);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid var(--sf-border);
            border-radius: 10px;
            background: transparent;
            color: var(--sf-text-muted);
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .header-btn:hover {
            background: var(--sf-secondary);
            color: var(--sf-text);
        }

        .header-btn .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 18px;
            height: 18px;
            background: var(--sf-danger);
            border-radius: 50%;
            font-size: 0.65rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Page Content */
        .page-content {
            flex: 1;
            padding: 1.5rem;
        }

        @media (min-width: 768px) {
            .page-content {
                padding: 2rem;
            }
        }

        /* Mobile Overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 45;
        }

        .mobile-overlay.active {
            display: block;
        }

        @media (min-width: 1024px) {
            .mobile-overlay {
                display: none !important;
            }
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 0.5rem);
            min-width: 200px;
            background: var(--sf-card);
            border: 1px solid var(--sf-border);
            border-radius: 12px;
            padding: 0.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 100;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--sf-text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: var(--sf-accent-light);
            color: var(--sf-text);
        }

        .dropdown-item.danger:hover {
            background: var(--sf-danger-light);
            color: var(--sf-danger);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--sf-border);
            margin: 0.5rem 0;
        }

        /* Logout form */
        .logout-form {
            margin: 0;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--sf-text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
        }

        .logout-btn:hover {
            background: var(--sf-danger-light);
            color: var(--sf-danger);
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }">
    <div class="app-layout">
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside class="sidebar" :class="{ 'hidden-mobile': !sidebarOpen }">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-logo">
                    <div class="sidebar-logo-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="sidebar-logo-text">StockFlow</span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <!-- Main Navigation -->
                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>

                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="nav-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                </div>

                <!-- Data Master -->
                {{-- <div class="nav-section">
                    <div class="nav-section-title">Data Master</div>

                    <a href="{{ route('kategori.index') }}" class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Kategori
                        <span class="nav-badge">{{ \App\Models\Kategori::count() }}</span>
                    </a>
                </div> --}}

                    {{-- Supplier - uncomment when ready --}}
                <div class="nav-section">
                    <div class="nav-section-title">Data Master</div>

                    <a href="{{ route('kategori.index') }}" class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <svg class="nav-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span>Kategori</span>
                        <span class="nav-item-badge">{{ \App\Models\Kategori::count() }}</span>
                    </a>

                    <a href="{{ route('supplier.index') }}" class="nav-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
                        <svg class="nav-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Supplier</span>
                        <span class="nav-item-badge">{{ \App\Models\Supplier::count() }}</span>
                    </a>

                    <a href="{{ route('barang.index') }}" class="nav-item {{ request()->routeIs('barang.*') ? 'active' : '' }}">
                        <svg class="nav-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Barang</span>
                        <span class="nav-item-badge">{{ \App\Models\Barang::count() }}</span>
                    </a>

                    <a href="{{ route('transaksi.index') }}" class="nav-item {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                        <svg class="nav-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Transaksi</span>
                    </a>
                </div>

                <!-- Reports -->
                <div class="nav-section">
                    <div class="nav-section-title">Laporan</div>

                    <a href="{{ route('laporan.index') }}" class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        <svg class="nav-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Laporan & Export
                    </a>
                </div>

                <!-- Admin Only -->
                @if(Auth::user()->isAdmin())
                <div class="nav-section">
                    <div class="nav-section-title">Administrasi</div>

                    <a href="{{ route('users.index') }}" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <svg class="nav-item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Kelola User
                        <span class="nav-item-badge">{{ \App\Models\User::count() }}</span>
                    </a>
                </div>
                @endif
            </nav>

            <!-- Sidebar Footer - User Info -->
            <div class="sidebar-footer">
                <div class="user-card" x-data="{ open: false }" @click.away="open = false">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">
                            <span class="role-badge {{ Auth::user()->isAdmin() ? 'admin' : 'staff' }}">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <header class="top-header">
                <div class="header-left">
                    <button class="mobile-menu-btn" @click="sidebarOpen = !sidebarOpen">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    @isset($header)
                        <h1 class="page-title">{{ $header }}</h1>
                    @endisset
                </div>

                <div class="header-right">
                    <!-- Notifications -->
                    @php
                        $lowStockCount = \App\Models\Barang::whereColumn('stok', '<=', 'stok_minimum')->count();
                    @endphp
                    <button class="header-btn" title="Notifikasi">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if($lowStockCount > 0)
                            <span class="badge">{{ $lowStockCount }}</span>
                        @endif
                    </button>

                    <!-- User Dropdown -->
                    <div class="dropdown" x-data="{ open: false }">
                        <button class="header-btn" @click="open = !open">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu" :class="{ 'active': open }" x-show="open" @click.away="open = false">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil Saya
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="page-content">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
