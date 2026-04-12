<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kunjungan</title>
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
        }

        body {
            padding: 8px;
        }

        .page {
            min-height: calc(100vh - 16px);
            background: #f4f4f4;
            display: grid;
            grid-template-columns: 400px 1fr;
            border-left: 3px solid #5b34ff;
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
            width: 150px;
            height: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .system-title {
            margin-top: 6px;
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
            color: #202020;
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
            padding: 24px 20px 18px;
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

        .top-actions {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            position: relative;
            z-index: 10002;
            margin-bottom: 28px;
        }

        .mini-icon {
            width: 18px;
            height: 18px;
            color: #8a45d6;
            margin-top: 4px;
            opacity: 0.92;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .mini-icon:hover {
            transform: translateY(-1px) scale(1.08);
            opacity: 1;
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

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #5b34ff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .detail-wrapper {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 18px;
        }

        .panel {
            background: #f9f9f9;
            border: 1.3px solid #bcbcbc;
            border-radius: 12px;
            padding: 18px;
        }

        .profile-row {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .profile-icon {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: linear-gradient(180deg, #6b55d9 0%, #d75d9f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .profile-name {
            font-size: 22px;
            font-weight: 800;
            color: #111;
            line-height: 1.2;
        }

        .profile-type {
            font-size: 13px;
            color: #7c7c7c;
            font-style: italic;
            margin-top: 3px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 16px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #5d5d5d;
            margin-bottom: 5px;
        }

        .field-value {
            min-height: 38px;
            background: #d9d9d9;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #171717;
            display: flex;
            align-items: center;
        }

        .field-value.italic {
            font-style: italic;
            font-weight: 500;
            color: #444;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .textarea-box {
            min-height: 78px;
            background: #d9d9d9;
            border-radius: 6px;
            padding: 12px;
            font-size: 12px;
            font-weight: 600;
            color: #171717;
            line-height: 1.5;
        }

        .visit-summary {
            display: grid;
            gap: 14px;
        }

        .summary-card {
            border-radius: 12px;
            padding: 18px;
            background: #f8f8f8;
            border: 1.6px solid transparent;
            background-image:
                linear-gradient(#f8f8f8, #f8f8f8),
                linear-gradient(90deg, #5338ff 0%, #ff2f8f 100%);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }

        .summary-card h4 {
            font-size: 15px;
            color: #666;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .summary-card .value {
            font-size: 28px;
            font-weight: 800;
            color: #5b2cb8;
            line-height: 1.1;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 120px;
            height: 34px;
            padding: 0 14px;
            border-radius: 999px;
            background: #d9ecff;
            color: #1d5fbf;
            font-size: 13px;
            font-weight: 700;
        }

        .notes-box {
            background: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 14px;
        }

        .notes-box h4 {
            font-size: 13px;
            color: #444;
            margin-bottom: 8px;
        }

        .notes-box p {
            font-size: 13px;
            color: #555;
            line-height: 1.6;
        }

        @media (max-width: 1100px) {
            .page {
                grid-template-columns: 320px 1fr;
            }

            .sidebar {
                padding: 24px 20px;
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

            .detail-wrapper {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 950px) {
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
                border-bottom: 2px solid #ff2f8f;
            }

            .content {
                padding: 14px;
            }
        }

        @media (max-width: 600px) {
            .header-title {
                font-size: 20px;
            }

            .profile-row {
                align-items: flex-start;
            }

            .profile-icon {
                width: 56px;
                height: 56px;
            }

            .profile-name {
                font-size: 18px;
            }

            .grid {
                grid-template-columns: 1fr;
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

                <a href="{{ route('admin.pengajuan') }}" class="menu-card {{ request()->routeIs('admin.pengajuan*') ? 'active' : '' }}">
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

                <a href="{{ route('admin.rekap') }}" class="menu-card {{ request()->routeIs('admin.rekap*') ? 'active' : '' }}">
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
                        <div class="menu-subtitle">Admin & Petugas</div>
                    </div>
                </a>
            </div>
        </aside>

        <main class="content">
            <div class="header-box">
                <div class="header-title">Detail Kunjungan</div>

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

            <a href="{{ route('admin.rekap') }}" class="back-link">
                ← Kembali ke rekap kunjungan
            </a>

            <div class="detail-wrapper">
                <div class="panel">
                    <div class="profile-row">
                        <div class="profile-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none">
                                <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="white" stroke-width="1.8"/>
                                <path d="M3.5 21C4.6 16.9 7.9 15 12 15C16.1 15 19.4 16.9 20.5 21" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </div>

                        <div>
                            <div class="profile-name">{{ $kunjungan['nama'] }}</div>
                            <div class="profile-type">{{ $kunjungan['jenis'] }}</div>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="field">
                            <label>Instansi</label>
                            <div class="field-value">{{ $kunjungan['instansi'] }}</div>
                        </div>

                        <div class="field">
                            <label>Nomor Pengajuan</label>
                            <div class="field-value">{{ $kunjungan['nomor_pengajuan'] }}</div>
                        </div>

                        <div class="field">
                            <label>Nama Penanggung Jawab</label>
                            <div class="field-value">{{ $kunjungan['penanggung_jawab'] }}</div>
                        </div>

                        <div class="field">
                            <label>Jabatan PIC</label>
                            <div class="field-value">{{ $kunjungan['jabatan_pic'] }}</div>
                        </div>

                        <div class="field">
                            <label>Stasiun Kunjungan</label>
                            <div class="field-value">{{ $kunjungan['stasiun_kunjungan'] }}</div>
                        </div>

                        <div class="field">
                            <label>Dokumen Pendukung</label>
                            <div class="field-value italic">{{ $kunjungan['dokumen'] }}</div>
                        </div>

                        <div class="field full-width">
                            <label>Tujuan Kunjungan</label>
                            <div class="textarea-box">{{ $kunjungan['tujuan'] }}</div>
                        </div>
                    </div>
                </div>

                <div class="visit-summary">
                    <div class="summary-card">
                        <h4>Tanggal Kunjungan</h4>
                        <div class="value">{{ $kunjungan['tanggal_kunjungan'] }}</div>
                    </div>

                    <div class="summary-card">
                        <h4>Check-in</h4>
                        <div class="value">{{ $kunjungan['check_in'] }}</div>
                    </div>

                    <div class="summary-card">
                        <h4>Check-out</h4>
                        <div class="value">{{ $kunjungan['check_out'] }}</div>
                    </div>

                    <div class="summary-card">
                        <h4>Durasi Kunjungan</h4>
                        <div class="value">{{ $kunjungan['durasi'] }}</div>
                    </div>

                    <div class="notes-box">
                        <h4>Status</h4>
                        <div class="status-pill">{{ $kunjungan['status'] }}</div>
                    </div>

                    <div class="notes-box">
                        <h4>Catatan Kunjungan</h4>
                        <p>{{ $kunjungan['catatan'] }}</p>
                    </div>
                </div>
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