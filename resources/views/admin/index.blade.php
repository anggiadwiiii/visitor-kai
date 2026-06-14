<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: #efefef;
        }

        body {
            padding: 8px;
        }

        .page {
            height: calc(100vh - 16px);
            background: #f4f4f4;
            border-left: 3px solid #5a37ff;
            display: grid;
            grid-template-columns: 400px 1fr;
            overflow: hidden;
        }

        .sidebar {
            padding: 28px 28px 24px;
            border-right: 2px solid #ff2d8d;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .logo-wrap {
            text-align: center;
            margin-top: 18px;
            margin-bottom: 22px;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-img {
            width: 180px;
            height: auto;
            object-fit: contain;
            object-position: center;
            display: block;
            margin: 0 auto;
        }

        .system-title {
            margin-top: 10px;
            text-align: center;
            font-size: 26px;
            font-style: italic;
            font-weight: 700;
            line-height: 1.35;
            background: linear-gradient(90deg, #4426a8 0%, #d31b87 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .menu-list {
            margin-top: 22px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .menu-card {
            background: #f9f9f9;
            border-radius: 12px;
            min-height: 98px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.02);
            transition: 0.2s ease;
            text-decoration: none;
            cursor: pointer;
            z-index: 2;
        }

        .menu-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.06);
        }

        .menu-card.active {
            background: #e6e6e6;
        }

        .menu-icon {
            width: 44px;
            min-width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-content {
            flex: 1;
        }

        .menu-title {
            font-size: 15px;
            font-weight: 700;
            color: #1f1f1f;
            line-height: 1.3;
            margin-bottom: 4px;
        }

        .menu-subtitle {
            font-size: 13px;
            color: #888;
            line-height: 1.35;
        }

        .menu-badge {
            position: absolute;
            right: 14px;
            top: 24px;
            min-width: 36px;
            height: 26px;
            padding: 0 10px;
            border-radius: 999px;
            background: linear-gradient(90deg, #7f52d6 0%, #d6579a 100%);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(180, 90, 170, 0.3);
        }

        .content {
            padding: 18px 18px 16px;
            overflow-y: auto;
        }

        .header-box {
            min-height: 92px;
            background: #f9f9f9;
            border: 1.3px solid #bcbcbc;
            border-radius: 8px;
            padding: 18px 24px 18px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .header-title {
            font-size: 26px;
            font-weight: 600;
            color: #555;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(180deg, #8d59d8 0%, #d86aa9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-menu {
            position: relative;
            z-index: 10005;
        }

        .profile-toggle {
            border: none;
            cursor: pointer;
            outline: none;
        }

        .profile-toggle:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 16px 26px rgba(156, 91, 196, 0.34);
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            min-width: 200px;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            padding: 12px;
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.2s, transform 0.2s;
            z-index: 10006;
        }

        .profile-dropdown.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .profile-dropdown-header {
            padding: 10px 12px 12px;
            border-bottom: 1px solid #ececec;
            margin-bottom: 8px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .profile-dropdown-header strong {
            font-size: 14px;
            color: #2b2b2b;
            font-weight: 700;
        }

        .profile-dropdown-header span {
            font-size: 12px;
            color: #8a8a8a;
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            background: #ff4d4d;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #cc0000;
        }

        .search-row {
            display: grid;
            grid-template-columns: 1fr 48px;
            gap: 8px;
            margin-bottom: 10px;
        }

        .search-input {
            width: 100%;
            height: 36px;
            border: 1px solid #c0c0c0;
            border-radius: 8px;
            padding: 0 14px;
            font-size: 13px;
            outline: none;
            background: #fafafa;
            font-family: inherit;
            color: #666;
        }

        .search-input::placeholder {
            color: #b3b3b3;
            font-style: italic;
        }

        .search-btn {
            height: 36px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: linear-gradient(90deg, #7852d7 0%, #d46aa3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cards {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .pengajuan-card {
            background: #f9f9f9;
            border-radius: 14px;
            border: 1.4px solid transparent;
            background-image:
                linear-gradient(#f9f9f9, #f9f9f9),
                linear-gradient(90deg, #4f38ff 0%, #ff2f8f 100%);
            background-origin: border-box;
            background-clip: padding-box, border-box;
            padding: 14px 14px 16px;
        }

        .pengajuan-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 10px;
        }

        .nama {
            font-size: 20px;
            line-height: 1.15;
            font-weight: 800;
            color: #111;
            margin-bottom: 2px;
        }

        .instansi {
            font-size: 12px;
            color: #8e8e8e;
            line-height: 1.25;
        }

        .status-badge {
            min-width: 100px;
            height: 22px;
            padding: 0 12px;
            border-radius: 999px;
            background: #e6dca0;
            color: #7a6f35;
            font-size: 11px;
            font-style: italic;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2px;
        }

        .info-list {
            margin: 8px 0 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #1f1f1f;
            font-size: 12px;
            font-weight: 600;
        }

        .info-item .icon {
            width: 18px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #202020;
        }

        .detail-btn {
            width: 100%;
            min-height: 36px;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(90deg, #3510b5 0%, #d2148a 100%);
            color: white;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .empty-state {
            padding: 20px;
            text-align: center;
            color: #777;
            font-size: 13px;
            background: #fafafa;
            border-radius: 10px;
        }

        @media (max-width: 1100px) {
            .page {
                grid-template-columns: 320px 1fr;
            }

            .sidebar {
                padding: 24px 20px;
            }

            .system-title {
                font-size: 22px;
            }

            .logo-img {
                width: 150px;
            }
        }

        @media (max-width: 900px) {
            html, body {
                overflow: auto;
            }

            body {
                padding: 0;
            }

            .page {
                min-height: 100vh;
                height: auto;
                grid-template-columns: 1fr;
                border-left: none;
            }

            .sidebar {
                border-right: none;
                border-bottom: 2px solid #ff2d8d;
                overflow: visible;
            }

            .content {
                overflow: visible;
                padding: 14px;
            }
        }

        @media (max-width: 640px) {
            .menu-card {
                min-height: 88px;
                padding: 14px;
            }

            .menu-icon {
                width: 40px;
                min-width: 40px;
                height: 40px;
            }

            .menu-title {
                font-size: 14px;
            }

            .menu-subtitle {
                font-size: 12px;
            }

            .menu-badge {
                min-width: 32px;
                height: 24px;
                font-size: 12px;
                right: 12px;
                top: 16px;
            }

            .header-title {
                font-size: 22px;
            }

            .pengajuan-top {
                flex-direction: column;
                gap: 8px;
            }

            .status-badge {
                align-self: flex-start;
            }

            .nama {
                font-size: 18px;
            }

            .instansi {
                font-size: 11px;
            }

            .logo-img {
                width: 140px;
            }

            .system-title {
                font-size: 20px;
            }
        }

        svg {
            display: block;
        }
    </style>
</head>
<body>
    <div class="page">
        <aside class="sidebar">
            <div class="logo-wrap">
                <a href="{{ route('admin.dashboard') }}" style="text-decoration:none;">
                    <div class="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo KAI" class="logo-img">
                    </div>
                    <div class="system-title">
                        Visitor Management<br>System
                    </div>
                </a>
            </div>

            <div class="menu-list">
                <a href="{{ route('admin.dashboard') }}" class="menu-card {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <div class="menu-icon">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 15.5L21 7.5L35 15.5V30.5C35 32.1569 33.6569 33.5 32 33.5H10C8.34315 33.5 7 32.1569 7 30.5V15.5Z" stroke="url(#g0)" stroke-width="2.5"/>
                            <path d="M15 33.5V19.5H27V33.5" stroke="url(#g0)" stroke-width="2.5"/>
                            <path d="M19 23.5H23" stroke="url(#g0)" stroke-width="2.5" stroke-linecap="round"/>
                            <defs>
                                <linearGradient id="g0" x1="7" y1="7.5" x2="35" y2="33.5" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#4F2ACB"/>
                                    <stop offset="1" stop-color="#E91E8C"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Dashboard</div>
                        <div class="menu-subtitle">Ringkasan & Statistik</div>
                    </div>
                </a>

                <a href="{{ route('admin.pengajuan') }}"
                   class="menu-card {{ request()->routeIs('admin.pengajuan*') ? 'active' : '' }}">
                    <div class="menu-icon">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                            <path d="M13 9.5H29L33 13.5V28.5C33 31.2614 30.7614 33.5 28 33.5H14C11.2386 33.5 9 31.2614 9 28.5V13.5L13 9.5Z" stroke="url(#g1)" stroke-width="2.5"/>
                            <path d="M15 9V6.5C15 5.11929 16.1193 4 17.5 4H24.5C25.8807 4 27 5.11929 27 6.5V9" stroke="url(#g1)" stroke-width="2.5"/>
                            <path d="M24.8 21.5L21 17.7L17.2 21.5" stroke="url(#g1)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 17.7V27.8" stroke="url(#g1)" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M26.8 29.5C26.8 32.151 24.651 34.3 22 34.3C19.349 34.3 17.2 32.151 17.2 29.5C17.2 26.849 19.349 24.7 22 24.7C24.651 24.7 26.8 26.849 26.8 29.5Z" fill="url(#g1)" stroke="white" stroke-width="1.5"/>
                            <path d="M22 27.6V31.4" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                            <circle cx="22" cy="25.9" r="1" fill="white"/>
                            <defs>
                                <linearGradient id="g1" x1="8" y1="4" x2="34" y2="35" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#4F2ACB"/>
                                    <stop offset="1" stop-color="#E91E8C"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Daftar Pengajuan</div>
                        <div class="menu-subtitle">Verifikasi pengajuan kunjungan</div>
                    </div>
                    <div class="menu-badge">{{ $pengajuanCount ?? 0 }}</div>
                </a>

                <a href="{{ route('admin.rekap') }}"
                   class="menu-card {{ request()->routeIs('admin.rekap') ? 'active' : '' }}">
                    <div class="menu-icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M8 31V19" stroke="url(#g2)" stroke-width="3" stroke-linecap="round"/>
                            <path d="M16 31V13" stroke="url(#g2)" stroke-width="3" stroke-linecap="round"/>
                            <path d="M24 31V22" stroke="url(#g2)" stroke-width="3" stroke-linecap="round"/>
                            <path d="M32 31V9" stroke="url(#g2)" stroke-width="3" stroke-linecap="round"/>
                            <path d="M7 24L15.5 16L22.5 21.5L33 10" stroke="url(#g2)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <defs>
                                <linearGradient id="g2" x1="7" y1="9" x2="33" y2="31" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#4F2ACB"/>
                                    <stop offset="1" stop-color="#E91E8C"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Rekap Kunjungan</div>
                        <div class="menu-subtitle">Lihat Riwayat Kunjungan</div>
                    </div>
                </a>

                <a href="{{ route('admin.users') }}" class="menu-card {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <div class="menu-icon">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                            <path d="M21 21C23.7614 21 26 18.7614 26 16C26 13.2386 23.7614 11 21 11C18.2386 11 16 13.2386 16 16C16 18.7614 18.2386 21 21 21Z" stroke="url(#g3)" stroke-width="2.5"/>
                            <path d="M12 32C12 28.134 16.0294 25 21 25C25.9706 25 30 28.134 30 32" stroke="url(#g3)" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M11 18C13.2091 18 15 16.2091 15 14C15 11.7909 13.2091 10 11 10C8.79086 10 7 11.7909 7 14C7 16.2091 8.79086 18 11 18Z" stroke="url(#g3)" stroke-width="2.5"/>
                            <path d="M4.8 29.2C4.8 26.286 7.35394 23.9 10.6 23.9C12.5072 23.9 14.202 24.7229 15.2 26" stroke="url(#g3)" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M31 18C33.2091 18 35 16.2091 35 14C35 11.7909 33.2091 10 31 10C28.7909 10 27 11.7909 27 14C27 16.2091 28.7909 18 31 18Z" stroke="url(#g3)" stroke-width="2.5"/>
                            <path d="M37.2 29.2C37.2 26.286 34.6461 23.9 31.4 23.9C29.4928 23.9 27.798 24.7229 26.8 26" stroke="url(#g3)" stroke-width="2.5" stroke-linecap="round"/>
                            <defs>
                                <linearGradient id="g3" x1="5" y1="10" x2="36" y2="32" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#4F2ACB"/>
                                    <stop offset="1" stop-color="#E91E8C"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="menu-content">
                        <div class="menu-title">Kelola Pengguna</div>
                        <div class="menu-subtitle">Admin & Petugas Keamanan</div>
                    </div>
                </a>
            </div>
        </aside>

        <main class="content">
            <div class="header-box">
                <div class="header-title">Daftar Pengajuan</div>

                <div class="profile-menu">
                    <button type="button" class="avatar profile-toggle" id="profileToggle">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="white" opacity="0.95"/>
                            <path d="M3.5 21C4.6 16.9 7.9 15 12 15C16.1 15 19.4 16.9 20.5 21" fill="white" opacity="0.95"/>
                        </svg>
                    </button>

                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="profile-dropdown-header">
                            <strong>{{ $adminName }}</strong>
                            <span>Admin</span>
                        </div>

                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.pengajuan') }}" class="search-row">
                <input
                    type="text"
                    name="search"
                    class="search-input"
                    placeholder="Cari nama visitor..."
                    value="{{ $search }}"
                >
                <button type="submit" class="search-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <circle cx="11" cy="11" r="7" stroke="white" stroke-width="2.6"/>
                        <path d="M20 20L16.65 16.65" stroke="white" stroke-width="2.6" stroke-linecap="round"/>
                    </svg>
                </button>
            </form>

            <div class="cards">
            @forelse($pengajuan as $item)
                <div class="pengajuan-card">
                    <div class="pengajuan-top">
                        <div>
                            <div class="nama">{{ $item->nama_pengunjung ?? ($item['nama'] ?? '-') }}</div>
                            <div class="instansi">{{ $item->asal_institusi ?? ($item['instansi'] ?? '-') }}</div>
                        </div>

                        <div class="status-badge">{{ $item->status ?? ($item['status'] ?? '-') }}</div>
                    </div>

                    <div class="info-list">
                        <div class="info-item">
                            <div class="icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="#222" stroke-width="2"/>
                                    <path d="M12 7V12L15 15" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span>
                                {{
                                    isset($item->tanggal_kunjungan)
                                        ? optional($item->tanggal_kunjungan)->translatedFormat('d F Y')
                                        : ($item['tanggal'] ?? '-')
                                }}
                            </span>
                        </div>

                        <div class="info-item">
                            <div class="icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 4H15" stroke="#222" stroke-width="1.8" stroke-linecap="round"/>
                                    <rect x="6" y="3" width="12" height="18" rx="2" stroke="#222" stroke-width="1.8"/>
                                    <path d="M9 8H15" stroke="#222" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9 12H13" stroke="#222" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M18 9L21 12L18 15" stroke="#222" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span>{{ $item->tujuan_kunjungan ?? ($item['keperluan'] ?? '-') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('admin.pengajuan.detail', $item->id ?? $item['id']) }}" class="detail-btn">
                        Lihat Detail dan Verifikasi
                    </a>
                </div>
            @empty
                <div class="empty-state">
                    Data pengajuan tidak ditemukan.
                </div>
            @endforelse
        </div>
        </main>
    </div>

    <script>
        const profileToggle = document.getElementById('profileToggle');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileToggle && profileDropdown) {
            profileToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('show');
                }
            });
        }
    </script>
</body>
</html>