<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Dashboard Petugas</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --purple: #5b2be0;
            --pink: #e53e93;
            --purple-dark: #4b20c5;
            --text: #27272a;
            --muted: #71717a;
            --bg: #efefef;
            --card: #ffffff;
            --soft: #f5f5f5;
            --danger: #ef4444;
            --shadow: 0 10px 30px rgba(91, 43, 224, 0.10);
        }

        /* --- BAGIAN PENGUNCI LAYAR (PENTING) --- */
        html, body {
            height: 100%;
            width: 100%;
            overflow: auto; /* MEMUNGKINKAN SCROLL */
            background: var(--bg);
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text);
        }

        .phone-frame {
            width: 100%;
            max-width: 100%; /* Full width on mobile */
            height: auto;
            min-height: auto;
            background: #fff;
            position: relative;
            overflow: visible;
            display: block;
            margin: 0 auto;
            padding-bottom: 75px;
        }

        /* Responsive untuk tampilan desktop */
        @media (min-width: 641px) {
            .phone-frame {
                width: 100%;
                max-width: 420px;
                height: auto;
                min-height: auto;
                border-radius: 24px;
                box-shadow: 0 18px 45px rgba(0, 0, 0, 0.15);
                padding-bottom: 75px;
            }
        }

        /* Mobile adjustments */
        @media (max-width: 640px) {
            .nav-center .circle {
                width: 45px;
                height: 45px;
                border-width: 3px;
            }

            .nav-center {
                transform: translateY(-12px);
            }

            .bottom-nav {
                min-height: 65px;
            }
        }
        /* --------------------------------------- */

        .topbar {
            height: auto;
            min-height: 48px;
            padding: 8px 12px;
            background: linear-gradient(90deg, var(--purple), var(--pink));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
            position: relative;
            z-index: 15;
        }

        .topbar-title {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .topbar .avatar {
            width: 28px;
            height: 28px;
            border: 2px solid rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            flex-shrink: 0;
            margin-left: 8px;
        }

        .content {
            padding: 10px 8px;
            background: radial-gradient(circle at top right, rgba(229, 62, 147, 0.07), transparent 28%),
                        radial-gradient(circle at top left, rgba(91, 43, 224, 0.07), transparent 24%), #fff;
            display: block;
            position: relative;
            z-index: 10;
        }

        .content::-webkit-scrollbar { width: 0px; } /* Sembunyikan scrollbar */

        .welcome-card {
            background: linear-gradient(135deg, #fafafa, #f2f2f2);
            border-radius: 12px;
            padding: 10px 12px;
            margin-bottom: 8px;
            margin-top: 8px;
        }

        .welcome-small { color: var(--muted); font-size: 10px; margin-bottom: 4px; }
        .welcome-name { color: var(--purple-dark); font-size: 18px; font-weight: 800; text-transform: capitalize; }

        .stats { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 12px; }
        .stat-card {
            border-radius: 12px;
            padding: 12px 10px;
            background: #fff;
            border: 2px solid #eee;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-label { font-size: 11px; color: var(--muted); font-weight: 500; }
        .stat-value { font-size: 24px; font-weight: 800; color: #7c25b2; line-height: 1; }

        .section-title { font-size: 11px; font-weight: 700; color: #5b2be0; margin-bottom: 8px; margin-top: 8px; text-transform: uppercase; }
        .activity-list { background: rgba(255, 255, 255, 0.6); border-radius: 10px; padding: 8px; border: 1px solid #f0f0f0; margin-bottom: 20px; }
        .activity-item { display: flex; align-items: center; gap: 8px; padding: 7px 8px; border-radius: 8px; background: #fff; margin-bottom: 4px; font-size: 11px; }
        .activity-dot { width: 6px; height: 6px; border-radius: 50%; }
        .checkin { background: #22c55e; }
        .checkout { background: #ef4444; }

        .btn-logout { width: 100%; border: none; background: var(--danger); color: #fff; padding: 10px; border-radius: 10px; cursor: pointer; font-weight: 700; font-size: 12px; margin-top: 12px; margin-bottom: 8px; }

        /* BOTTOM NAV FIX */
        .bottom-nav-wrap {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            background: #fff;
            z-index: 25;
            box-shadow: 0 -8px 25px rgba(0, 0, 0, 0.06);
            padding-bottom: max(8px, env(safe-area-inset-bottom));
            border-top: 1px solid #f0f0f0;
        }

        @media (min-width: 641px) {
            .bottom-nav-wrap {
                left: 50%;
                transform: translateX(-50%);
                width: 420px;
                border-radius: 24px 24px 0 0;
            }
        }

        .nav-line-top { display: none; }
        .bottom-nav { 
            display: grid; 
            grid-template-columns: 1fr 1fr 1fr; 
            align-items: end; 
            text-align: center; 
            padding: 8px 8px 0; 
            min-height: 60px;
            gap: 4px;
        }
        .nav-item { 
            text-decoration: none; 
            color: #7a1eae; 
            font-size: 9px; 
            font-weight: 700; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            gap: 3px; 
            padding: 0 4px;
            position: relative;
            cursor: pointer;
            z-index: 10;
        }
        .nav-center { transform: translateY(-16px); }
        .nav-center .circle { 
            width: 50px; 
            height: 50px; 
            border-radius: 50%; 
            background: linear-gradient(180deg, var(--purple), var(--purple-dark)); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border: 4px solid #fff; 
            box-shadow: 0 8px 16px rgba(91, 43, 224, 0.15);
            pointer-events: none;
        }
        .nav-icon { width: 16px; height: 16px; }
        
        .nav-center .circle svg {
            pointer-events: none;
        }
        
        .nav-item span {
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="phone-frame">
        <div class="topbar">
            <div class="topbar-title">Dashboard Petugas</div>
            <div class="avatar"></div>
        </div>

        <div class="content">
            <div class="welcome-card">
                <div class="welcome-small">Selamat Datang</div>
                <div class="welcome-name">{{ $petugasName }}</div>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-label">Check-in</div>
                    <div class="stat-value">{{ $checkinCount }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Check-out</div>
                    <div class="stat-value">{{ $checkoutCount }}</div>
                </div>
            </div>

            <div class="section-title">Aktivitas Terbaru</div>
            <div class="activity-list">
                @forelse($recentActivity as $activity)
                    <div class="activity-item">
                        <div class="activity-dot {{ $activity['type'] }}"></div>
                        <div class="activity-text">
                            <div style="font-weight:700;">{{ Str::limit($activity['nama'], 18) }}</div>
                            <div style="font-size:9px; color:#999;">{{ $activity['type'] == 'checkin' ? 'Masuk' : 'Keluar' }} · {{ $activity['waktu'] }}</div>
                        </div>
                    </div>
                @empty
                    <div style="font-size:10px; color:#ccc; text-align:center; padding:10px;">Tidak ada aktivitas</div>
                @endforelse
            </div>

            <form method="POST" action="{{ route('petugas.logout') }}" style="margin-top:20px;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>

        <div class="bottom-nav-wrap">
            <div class="nav-line-top"></div>
            <div class="bottom-nav">
                <a href="{{ route('petugas.dashboard') }}" class="nav-item">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    <span>Home</span>
                </a>
                <a href="{{ route('petugas.scan') }}" class="nav-item nav-center">
                    <div class="circle">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect><path d="M14 14h7v7h-7z"></path>
                        </svg>
                    </div>
                    <span>Scan QR</span>
                </a>
                <a href="{{ route('petugas.riwayat') }}" class="nav-item">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
                    <span>Data</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>