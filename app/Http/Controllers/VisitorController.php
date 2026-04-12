<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            min-height: 100%;
            font-family: 'Poppins', sans-serif;
            background: #efefef;
            color: #222;
        }

        body {
            padding: 8px;
        }

        .page {
            min-height: calc(100vh - 16px);
            background: #f4f4f4;
            border-left: 3px solid #5a37ff;
            display: grid;
            grid-template-columns: 400px 1fr;
        }

        .sidebar {
            padding: 34px 36px 28px;
            border-right: 2px solid #ff2d8d;
            display: flex;
            flex-direction: column;
        }

        .logo-wrap {
            text-align: center;
            margin-top: 34px;
            margin-bottom: 24px;
        }

        .logo {
            font-size: 72px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -2px;
            display: inline-flex;
            align-items: center;
            position: relative;
        }

        .logo .k,
        .logo .i {
            color: #5b569d;
        }

        .logo .a {
            color: #f08a45;
            margin: 0 2px;
            position: relative;
        }

        .logo::after {
            content: "";
            position: absolute;
            left: 42px;
            top: 34px;
            width: 78px;
            height: 7px;
            background: #f08a45;
            transform: rotate(-20deg);
            border-radius: 20px;
        }

        .system-title {
            margin-top: 2px;
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
            margin-top: 26px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .menu-card {
            background: #f9f9f9;
            border-radius: 10px;
            min-height: 98px;
            padding: 18px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.02);
            transition: 0.2s ease;
            text-decoration: none;
        }

        .menu-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.06);
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

        .main {
            padding: 30px 24px 24px;
        }

        .top-card {
            border: 1.5px solid #b4b4b4;
            border-radius: 8px;
            background: #f9f9f9;
            min-height: 102px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px 18px 28px;
            margin-bottom: 30px;
        }

        .welcome-wrap {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .welcome-icon {
            margin-top: 1px;
            width: 22px;
            height: 22px;
            color: #868686;
        }

        .welcome-text small {
            display: block;
            font-size: 18px;
            color: #8b8b8b;
            line-height: 1.2;
            font-weight: 400;
        }

        .welcome-text h2 {
            font-size: 25px;
            line-height: 1.2;
            font-weight: 800;
            color: #5320b8;
        }

        .top-actions {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .mini-icon {
            width: 18px;
            height: 18px;
            color: #8a45d6;
            margin-top: 2px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            background: linear-gradient(180deg, #8e57da 0%, #d86aa9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(220px, 1fr));
            gap: 24px 20px;
        }

        .stat-card {
            min-height: 115px;
            border-radius: 14px;
            background: #f8f8f8;
            border: 1.6px solid transparent;
            background-image:
                linear-gradient(#f8f8f8, #f8f8f8),
                linear-gradient(90deg, #5338ff 0%, #ff2f8f 100%);
            background-origin: border-box;
            background-clip: padding-box, border-box;
            padding: 18px 22px;
            position: relative;
        }

        .stat-label {
            font-size: 18px;
            color: #7b7b7b;
            font-weight: 500;
            margin-bottom: 18px;
            line-height: 1.25;
        }

        .stat-value {
            font-size: 38px;
            color: #6a1fa4;
            font-weight: 500;
            line-height: 1;
        }

        .stat-fade {
            position: absolute;
            right: 18px;
            bottom: 16px;
            font-size: 18px;
            font-weight: 700;
            color: rgba(255,255,255,0.35);
            pointer-events: none;
        }

        @media (max-width: 1100px) {
            .page {
                grid-template-columns: 320px 1fr;
            }

            .sidebar {
                padding: 28px 22px;
            }

            .logo {
                font-size: 62px;
            }

            .logo::after {
                left: 36px;
                top: 29px;
                width: 66px;
            }

            .system-title {
                font-size: 22px;
            }

            .welcome-text small {
                font-size: 16px;
            }

            .welcome-text h2 {
                font-size: 22px;
            }

            .stat-label {
                font-size: 16px;
            }

            .stat-value {
                font-size: 34px;
            }
        }

        @media (max-width: 900px) {
            body {
                padding: 0;
            }

            .page {
                min-height: 100vh;
                grid-template-columns: 1fr;
                border-left: none;
            }

            .sidebar {
                border-right: none;
                border-bottom: 2px solid #ff2d8d;
                padding: 22px 16px 20px;
            }

            .logo-wrap {
                margin-top: 0;
                margin-bottom: 18px;
            }

            .logo {
                font-size: 54px;
            }

            .logo::after {
                left: 31px;
                top: 25px;
                width: 57px;
                height: 6px;
            }

            .system-title {
                font-size: 20px;
            }

            .menu-list {
                margin-top: 18px;
            }

            .main {
                padding: 18px 16px 24px;
            }

            .top-card {
                padding: 16px;
                min-height: auto;
                margin-bottom: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }
        }

        @media (max-width: 640px) {
            .menu-card {
                min-height: 88px;
                padding: 14px 14px;
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

            .top-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .top-actions {
                width: 100%;
                justify-content: flex-end;
            }

            .welcome-text small {
                font-size: 15px;
            }

            .welcome-text h2 {
                font-size: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                min-height: 105px;
                padding: 16px 18px;
            }

            .stat-label {
                font-size: 16px;
                margin-bottom: 14px;
            }

            .stat-value {
                font-size: 32px;
            }
        }

        @media (max-width: 420px) {
            .sidebar {
                padding: 18px 12px;
            }

            .main {
                padding: 16px 12px 20px;
            }

            .logo {
                font-size: 48px;
            }

            .logo::after {
                left: 27px;
                top: 22px;
                width: 50px;
            }

            .system-title {
                font-size: 18px;
            }

            .welcome-icon {
                width: 20px;
                height: 20px;
            }

            .welcome-text small {
                font-size: 14px;
            }

            .welcome-text h2 {
                font-size: 18px;
            }

            .avatar {
                width: 38px;
                height: 38px;
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
                <div class="logo">
                    <span class="k">K</span><span class="a">A</span><span class="i">I</span>
                </div>
                <div class="system-title">
                    Visitor Management<br>System
                </div>
            </div>

            <div class="menu-list">
                <a href="{{ route('admin.pengajuan') }}" class="menu-card {{ request()->routeIs('admin.pengajuan') ? 'active' : '' }}">
                    <div class="menu-icon">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <div class="menu-badge">24</div>
                </a>

                <a href="#" class="menu-card">
                    <div class="menu-icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
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

                <a href="#" class="menu-card">
                    <div class="menu-icon">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
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

        <main class="main">
            <div class="top-card">
                <div class="welcome-wrap">
                    <div class="welcome-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M12 12C14.4853 12 16.5 9.98528 16.5 7.5C16.5 5.01472 14.4853 3 12 3C9.51472 3 7.5 5.01472 7.5 7.5C7.5 9.98528 9.51472 12 12 12Z" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M4 20C4.8 16.8 7.6 15 12 15C16.4 15 19.2 16.8 20 20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="welcome-text">
                        <small>Selamat Datang</small>
                        <h2>{{ $adminName }}</h2>
                    </div>
                </div>

                <div class="top-actions">
                    <div class="mini-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 3L12 7L8 11L4 7L8 3Z"></path>
                            <path d="M16 3L20 7L16 11L12 7L16 3Z" opacity="0.9"></path>
                            <path d="M12 11L16 15L12 19L8 15L12 11Z" opacity="0.75"></path>
                        </svg>
                    </div>
                    <div class="mini-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <circle cx="6" cy="12" r="1.8"></circle>
                            <circle cx="12" cy="12" r="1.8"></circle>
                            <circle cx="18" cy="12" r="1.8"></circle>
                        </svg>
                    </div>
                    <div class="avatar">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="white" opacity="0.95"/>
                            <path d="M3.5 21C4.6 16.9 7.9 15 12 15C16.1 15 19.4 16.9 20.5 21" fill="white" opacity="0.95"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Pengajuan Baru</div>
                    <div class="stat-value">{{ $stats['pengajuan_baru'] }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Disetujui</div>
                    <div class="stat-value">{{ $stats['disetujui'] }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Pengunjung Hari Ini</div>
                    <div class="stat-value">{{ $stats['pengunjung_hari_ini'] }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Pengunjung Aktif</div>
                    <div class="stat-value">{{ $stats['pengunjung_aktif'] }}</div>
                    <div class="stat-fade">24</div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>