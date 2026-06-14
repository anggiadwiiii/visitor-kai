<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #efefef;
            --panel: #f8f8f8;
            --panel-soft: #fcfcfc;
            --line: #d9d9d9;
            --text: #242424;
            --muted: #7b7b7b;
            --primary: #5a37ff;
            --secondary: #ff2d8d;
            --purple: #6c2bb8;
            --shadow-sm: 0 6px 18px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 16px 36px rgba(86, 54, 180, 0.10);
            --grad-main: linear-gradient(135deg, #5338ff 0%, #ff2f8f 100%);
            --grad-soft: linear-gradient(135deg, rgba(83, 56, 255, 0.10) 0%, rgba(255, 47, 143, 0.10) 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            min-height: 100%;
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(90, 55, 255, 0.08), transparent 22%),
                radial-gradient(circle at top right, rgba(255, 45, 141, 0.08), transparent 20%),
                var(--bg);
            color: var(--text);
        }

        body {
            padding: 8px;
        }

        .page {
            height: calc(100vh - 16px);
            background: rgba(244, 244, 244, 0.95);
            border-left: 3px solid var(--primary);
            display: grid;
            grid-template-columns: 390px 1fr;
            overflow: hidden;
            border-radius: 0 16px 16px 0;
            backdrop-filter: blur(8px);
        }

        .sidebar {
            padding: 28px 24px 24px;
            border-right: 2px solid rgba(255, 45, 141, 0.85);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            background: linear-gradient(180deg, rgba(255,255,255,0.16) 0%, rgba(255,255,255,0.04) 100%);
        }

        .sidebar::-webkit-scrollbar,
        .main::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-thumb,
        .main::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, rgba(90,55,255,0.35), rgba(255,45,141,0.35));
            border-radius: 999px;
        }

        .logo-wrap {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 24px;
            animation: fadeDown 0.7s ease both;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        .logo-img {
            width: 180px;
            height: auto;
            object-fit: contain;
            object-position: center;
            display: block;
            filter: drop-shadow(0 10px 22px rgba(90, 55, 255, 0.10));
            transition: transform 0.3s ease;
        }

        .logo-wrap:hover .logo-img {
            transform: translateY(-2px) scale(1.02);
        }

        .system-title {
            margin-top: 12px;
            text-align: center;
            font-size: 25px;
            font-style: italic;
            font-weight: 800;
            line-height: 1.28;
            background: linear-gradient(90deg, #4826b4 0%, #d11b86 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.3px;
        }

        .menu-list {
            margin-top: 18px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .menu-card {
            background: rgba(255,255,255,0.72);
            border-radius: 18px;
            min-height: 102px;
            padding: 18px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            border: 1px solid rgba(0,0,0,0.03);
            box-shadow: var(--shadow-sm);
            transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease, border-color 0.22s ease;
            text-decoration: none;
            overflow: hidden;
            animation: fadeUp 0.7s ease both;
        }

        .menu-card:nth-child(1) { animation-delay: 0.08s; }
        .menu-card:nth-child(2) { animation-delay: 0.14s; }
        .menu-card:nth-child(3) { animation-delay: 0.20s; }
        .menu-card:nth-child(4) { animation-delay: 0.26s; }

        .menu-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(90,55,255,0.05), rgba(255,45,141,0.05));
            opacity: 0;
            transition: opacity 0.22s ease;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(90,55,255,0.10);
        }

        .menu-card:hover::before {
            opacity: 1;
        }

        .menu-card.active {
            background: linear-gradient(135deg, rgba(255,255,255,0.96) 0%, rgba(246,240,255,0.96) 100%);
            box-shadow: 0 18px 36px rgba(105, 61, 197, 0.12);
            border-color: rgba(90,55,255,0.16);
        }

        .menu-card.active::after {
            content: "";
            position: absolute;
            left: 0;
            top: 16px;
            bottom: 16px;
            width: 5px;
            border-radius: 0 999px 999px 0;
            background: var(--grad-main);
        }

        .menu-icon,
        .menu-content,
        .menu-badge {
            position: relative;
            z-index: 1;
        }

        .menu-icon {
            width: 48px;
            min-width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(90,55,255,0.06), rgba(255,45,141,0.06));
        }

        .menu-content {
            flex: 1;
        }

        .menu-title {
            font-size: 15px;
            font-weight: 800;
            color: #181818;
            line-height: 1.3;
            margin-bottom: 4px;
        }

        .menu-subtitle {
            font-size: 13px;
            color: #7f7f7f;
            line-height: 1.4;
            font-weight: 500;
        }

        .menu-badge {
            position: absolute;
            right: 16px;
            top: 22px;
            min-width: 38px;
            height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            background: linear-gradient(90deg, #7f52d6 0%, #d6579a 100%);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 16px rgba(182, 86, 161, 0.28);
        }

        .main {
            padding: 16px 16px 16px;
            overflow-y: auto;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .main::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 92% 10%, rgba(255,45,141,0.05), transparent 14%),
                radial-gradient(circle at 70% 34%, rgba(90,55,255,0.05), transparent 18%);
            pointer-events: none;
        }

        .top-card {
            position: relative;
            z-index: 2;
            border: 1.5px solid #c4c4c4;
            border-radius: 18px;
            background: rgba(249, 249, 249, 0.88);
            min-height: 90px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px 16px 22px;
            margin-bottom: 14px;
            box-shadow: var(--shadow-sm);
            animation: fadeDown 0.75s ease both;
            overflow: visible;
        }

        .top-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(110deg, transparent, rgba(255,255,255,0.35), transparent);
            transform: translateX(-120%);
            animation: shine 4.8s linear infinite;
            pointer-events: none;
            border-radius: 18px;
        }

        .welcome-wrap {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            position: relative;
            z-index: 1;
        }

        .welcome-icon {
            margin-top: 1px;
            width: 26px;
            height: 26px;
            color: #8b8b8b;
            flex-shrink: 0;
        }

        .welcome-text small {
            display: block;
            font-size: 18px;
            color: #8b8b8b;
            line-height: 1.2;
            font-weight: 400;
            margin-bottom: 2px;
        }

        .welcome-text h2 {
            font-size: 26px;
            line-height: 1.18;
            font-weight: 800;
            color: #5320b8;
            letter-spacing: -0.4px;
        }

        .top-actions {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            position: relative;
            z-index: 10002;
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

        .avatar {
            width: 56px;
            height: 56px;
            border-radius: 999px;
            background: linear-gradient(180deg, #8e57da 0%, #d86aa9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 12px 22px rgba(156, 91, 196, 0.25);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
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
            top: calc(100% + 10px); /* Posisi tepat di bawah avatar */
            right: 0;
            min-width: 200px;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            padding: 12px;
            display: none; /* Kita gunakan display: block nanti via JS */
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
            background: #ff4d4d; /* Warna merah untuk logout */
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            max-width: 100%;
        }

        .stat-card {
            min-height: 130px;
            border-radius: 18px;
            background: rgba(248, 248, 248, 0.92);
            border: 1.6px solid transparent;
            background-image:
                linear-gradient(rgba(248,248,248,0.94), rgba(248,248,248,0.94)),
                linear-gradient(90deg, #5338ff 0%, #ff2f8f 100%);
            background-origin: border-box;
            background-clip: padding-box, border-box;
            padding: 16px 16px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 14px 30px rgba(78, 56, 170, 0.08);
            transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
            animation: fadeUp 0.8s ease both;
        }

        .stat-card:nth-child(1) { animation-delay: 0.10s; }
        .stat-card:nth-child(2) { animation-delay: 0.18s; }
        .stat-card:nth-child(3) { animation-delay: 0.26s; }
        .stat-card:nth-child(4) { animation-delay: 0.34s; }

        .stat-card::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(83,56,255,0.10), transparent 70%);
            top: -80px;
            right: -70px;
            pointer-events: none;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            left: 22px;
            right: 22px;
            bottom: 0;
            height: 3px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(83,56,255,0.85), rgba(255,47,143,0.85));
            opacity: 0;
            transform: scaleX(0.4);
            transform-origin: center;
            transition: 0.28s ease;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 38px rgba(83, 56, 170, 0.16);
        }

        .stat-card:hover::after {
            opacity: 1;
            transform: scaleX(1);
        }

        .stat-label {
            font-size: 12px;
            color: #7b7b7b;
            font-weight: 500;
            margin-bottom: 12px;
            line-height: 1.35;
            position: relative;
            z-index: 1;
        }

        .stat-value {
            font-size: 36px;
            color: #6a1fa4;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -1px;
            position: relative;
            z-index: 1;
        }

        .stat-fade {
            position: absolute;
            right: 18px;
            bottom: 16px;
            font-size: 18px;
            font-weight: 700;
            color: rgba(255,255,255,0.38);
            pointer-events: none;
        }

        .dashboard-sections {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 12px;
            flex: 1;
            min-height: 0;
        }

        .section-card {
            background: rgba(248, 248, 248, 0.92);
            border: 1.6px solid transparent;
            border-radius: 18px;
            padding: 14px;
            background-image:
                linear-gradient(rgba(248,248,248,0.94), rgba(248,248,248,0.94)),
                linear-gradient(135deg, rgba(83,56,255,0.06), rgba(255,45,141,0.06));
            background-origin: border-box;
            background-clip: padding-box, border-box;
            box-shadow: 0 14px 30px rgba(78, 56, 170, 0.08);
            animation: fadeUp 0.8s ease both;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .section-card:nth-child(1) { animation-delay: 0.42s; }
        .section-card:nth-child(2) { animation-delay: 0.50s; }
        .section-card:nth-child(3) { animation-delay: 0.58s; }
        .section-card:nth-child(4) { animation-delay: 0.66s; }

        .section-title {
            font-size: 13px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-icon {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #5338ff 0%, #ff2f8f 100%);
            border-radius: 6px;
            color: white;
            font-size: 12px;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
            overflow-y: auto;
            max-height: 160px;
        }

        .activity-item {
            display: flex;
            gap: 8px;
            padding: 6px 8px;
            border-radius: 8px;
            background: rgba(255,255,255,0.5);
            transition: all 0.25s ease;
            border-left: 2px solid transparent;
            font-size: 11px;
        }

        .activity-item:hover {
            background: rgba(255,255,255,0.8);
            border-left-color: #5338ff;
            transform: translateX(2px);
        }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5338ff, #ff2f8f);
            margin-top: 3px;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
            min-width: 0;
        }

        .activity-title {
            font-size: 11px;
            font-weight: 700;
            color: #2b2b2b;
            margin-bottom: 1px;
        }

        .activity-time {
            font-size: 10px;
            color: #9a9a9a;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }

       .quick-btn {
            padding: 8px 8px;
            border: 1.5px solid transparent;
            border-radius: 8px;
            background: linear-gradient(135deg, rgba(83,56,255,0.08) 0%, rgba(255,45,141,0.08) 100%);
            cursor: pointer;
            font-size: 10px;
            font-weight: 700;
            color: #5338ff;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            flex-direction: column;
        }
        .quick-btn small {
            font-size: 9px;
            font-weight: 600;
            color: #8a8a8a;
            line-height: 1;
        }

        .quick-btn:hover {
            background: linear-gradient(135deg, rgba(83,56,255,0.15) 0%, rgba(255,45,141,0.15) 100%);
            border-color: #5338ff;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(83,56,255,0.12);
        }

        .chart-placeholder {
            width: 100%;
            height: 120px;
            background: linear-gradient(135deg, rgba(83,56,255,0.08), rgba(255,45,141,0.08));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9a9a9a;
            font-size: 11px;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .chart-placeholder::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .insights-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 6px;
        }

        .insight-box {
            padding: 8px;
            border-radius: 8px;
            background: rgba(255,255,255,0.5);
            border: 1px solid transparent;
            transition: all 0.25s ease;
        }

        .insight-box:hover {
            background: rgba(255,255,255,0.8);
            border-color: rgba(83,56,255,0.2);
        }

        .insight-label {
            font-size: 9px;
            font-weight: 600;
            color: #8a8a8a;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .insight-value {
            font-size: 16px;
            font-weight: 800;
            color: #5338ff;
        }

        .insight-change {
            font-size: 9px;
            color: #4caf50;
            margin-top: 2px;
            font-weight: 600;
        }

        @media (max-width: 1200px) {
            .dashboard-sections {
                grid-template-columns: 1fr 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .section-card {
                padding: 12px;
            }

            .quick-actions {
                grid-template-columns: 1fr 1fr;
            }

            .welcome-text small {
                font-size: 14px;
            }

            .welcome-text h2 {
                font-size: 18px;
            }

            .stat-card {
                min-height: 100px;
                padding: 12px 12px;
            }

            .stat-label {
                font-size: 11px;
                margin-bottom: 8px;
            }

            .stat-value {
                font-size: 28px;
            }
        }

        @media (max-width: 640px) {
            .page {
                grid-template-columns: 280px 1fr;
            }

            .sidebar {
                padding: 16px 12px 12px;
            }

            .menu-list {
                gap: 12px;
                margin-top: 12px;
            }

            .menu-card {
                min-height: 80px;
                padding: 12px;
            }

            .logo-img {
                width: 140px;
                height: auto;
            }

            .system-title {
                font-size: 16px;
                margin-top: 8px;
            }

            .main {
                padding: 12px 12px 12px;
            }

            .top-card {
                padding: 12px 14px;
                margin-bottom: 10px;
                min-height: 80px;
            }

            .welcome-icon {
                width: 20px;
                height: 20px;
            }

            .welcome-text small {
                font-size: 12px;
            }

            .welcome-text h2 {
                font-size: 16px;
            }

            .stats-grid {
                gap: 8px;
                grid-template-columns: 1fr 1fr;
            }

            .stat-card {
                min-height: 90px;
                padding: 10px;
                border-radius: 12px;
            }

            .stat-label {
                font-size: 10px;
                margin-bottom: 6px;
            }

            .stat-value {
                font-size: 24px;
            }

            .dashboard-sections {
                grid-template-columns: 1fr 1fr;
                gap: 8px;
                margin-top: 8px;
            }

            .section-card {
                padding: 10px;
                border-radius: 12px;
            }

            .section-title {
                font-size: 11px;
                margin-bottom: 8px;
                gap: 6px;
            }

            .section-icon {
                width: 16px;
                height: 16px;
                border-radius: 4px;
            }

            .activity-list {
                gap: 4px;
                max-height: 140px;
            }

            .activity-item {
                gap: 6px;
                padding: 4px 6px;
                border-radius: 6px;
                font-size: 9px;
            }

            .activity-dot {
                width: 6px;
                height: 6px;
                margin-top: 2px;
            }

            .activity-title {
                font-size: 9px;
            }

            .activity-time {
                font-size: 8px;
            }

            .quick-actions {
                gap: 4px;
            }

            .quick-btn {
                padding: 6px 6px;
                font-size: 9px;
                gap: 3px;
                border-radius: 6px;
            }

            .chart-placeholder {
                height: 100px;
                font-size: 10px;
                border-radius: 10px;
            }

            .insights-grid {
                gap: 4px;
            }

            .insight-box {
                padding: 6px;
                border-radius: 6px;
            }

            .insight-label {
                font-size: 8px;
                margin-bottom: 2px;
            }

            .insight-value {
                font-size: 14px;
            }

            .insight-change {
                font-size: 8px;
                margin-top: 1px;
            }

            .avatar {
                width: 48px;
                height: 48px;
            }

            .profile-dropdown {
                min-width: 160px;
            }
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shine {
            0% {
                transform: translateX(-120%);
            }
            100% {
                transform: translateX(140%);
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
                        <img src="{{ asset('images/logo.png') }}?v=3" alt="Logo KAI" class="logo-img">
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
                    <div class="menu-badge">{{ $pengajuanCount ?? 0 }}</div>
                </a>

                <a href="{{ route('admin.rekap') }}" class="menu-card {{ request()->routeIs('admin.rekap') ? 'active' : '' }}">
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

                <a href="{{ route('admin.users') }}" class="menu-card {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <div class="menu-icon">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 21C23.7614 21 26 18.7614 26 16C26 13.2386 23.7614 11 21 11C18.2386 11 16 13.2386 16 16C16 18.7614 18.2386 21 21 21Z" stroke="url(#g3)" stroke-width="2.5"/>
                            <path d="M12 32C12 28.134 16.0294 25 21 25C25.9706 25 30 28.134 30 32" stroke="url(#g3)" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M11 18C13.2091 18 15 16.2091 15 14C15 11.7909 13.2091 10 11 10C8.79086 10 7 11.7909 7 14C7 16.2091 8.79086 18 11 18Z" stroke="url(#g3)" stroke-width="2.5"/>
                            <path d="M4.8 29.2C4.8 26.286 7.35394 23.9 10.6 23.9C12.5072 23.9 14.202 24.7229 15.2 26" stroke="url(#g3)" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M31 18C33.2091 18 35 16.2091 35 14C35 11.7909 33.2091 10 31 10C28.7909 10 27 11.7909 27 14C27 16.2091 28.7909 18 31 18Z" stroke="url(#g3)" stroke-width="2.5" stroke-linecap="round"/>
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
                        <!-- <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 3L12 7L8 11L4 7L8 3Z"></path>
                            <path d="M16 3L20 7L16 11L12 7L16 3Z" opacity="0.9"></path>
                            <path d="M12 11L16 15L12 19L8 15L12 11Z" opacity="0.75"></path>
                        </svg> -->
                    </div>
                    <div class="mini-icon">
                        <!-- <svg viewBox="0 0 24 24" fill="currentColor">
                            <circle cx="6" cy="12" r="1.8"></circle>
                            <circle cx="12" cy="12" r="1.8"></circle>
                            <circle cx="18" cy="12" r="1.8"></circle>
                        </svg> -->
                    </div>

                    <div class="profile-menu">
                        <button type="button" class="avatar profile-toggle" id="profileToggle">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
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
                    <div class="stat-fade">{{ $stats['pengunjung_aktif'] }}</div>
                </div>
            </div>

            <div class="dashboard-sections">
                <!-- Aktivitas Terbaru -->
                <div class="section-card">
                    <div class="section-title">
                        <div class="section-icon">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 1V7M7 13V7M1 7H7M13 7H7" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        Aktivitas Terbaru
                    </div>
                    <div class="activity-list">
        @forelse($aktivitasTerbaru as $activity)
            <div class="activity-item">
                <div class="activity-dot"></div>
                <div class="activity-content">
                    <div class="activity-title">{{ $activity['title'] }}</div>
                    <div class="activity-time">{{ $activity['time'] }}</div>
                </div>
            </div>
        @empty
            <div class="activity-item">
                <div class="activity-dot"></div>
                <div class="activity-content">
                    <div class="activity-title">Belum ada aktivitas</div>
                    <div class="activity-time">-</div>
                </div>
            </div>
        @endforelse
</div>
                </div>

                <!-- Quick Action -->
                <div class="section-card">
                    <div class="section-title">
                        <div class="section-icon">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.6667 1H2.33333C1.59695 1 1 1.59695 1 2.33333V11.6667C1 12.403 1.59695 13 2.33333 13H11.6667C12.403 13 13 12.403 13 11.6667V2.33333C13 1.59695 12.403 1 11.6667 1Z" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.33333 7L6.5 9.16667L10.8333 4.83333" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        Quick Action
                    </div>
                    <div class="quick-actions">
                @foreach($quickActions as $action)
                    <a href="{{ $action['route'] }}" class="quick-btn">
                        @if($action['label'] === 'Lihat Pengajuan')
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 1V11M1 6H11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        @elseif($action['label'] === 'Rekap Data')
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10V4M6 10V2M10 10V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        @elseif($action['label'] === 'Kelola Admin')
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="6" cy="3.5" r="1.5" stroke="currentColor" stroke-width="1"/>
                                <path d="M2 9.5C2 8.12 3.34 7 5 7H7C8.66 7 10 8.12 10 9.5" stroke="currentColor" stroke-width="1" stroke-linecap="round"/>
                            </svg>
                        @else
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.5 5.5H1M6 1V10M1 5.5L1.5 2H10.5L10.5 5.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @endif

                        {{ $action['label'] }}

                        @if(!is_null($action['count']))
                            <small>{{ $action['count'] }}</small>
                        @endif
                    </a>
                @endforeach
</div>
                </div>

                <!-- Grafik Kunjungan -->
                <div class="section-card">
    <div class="section-title">
        <div class="section-icon">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 11V7M5 11V3M8 11V5M11 11V2" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
                <path d="M1.5 12H12.5" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
            </svg>
        </div>
        Grafik Kunjungan
    </div>

    <div class="chart-placeholder" style="display:block; padding:12px;">
        @forelse($chartData as $item)
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">
                <div style="width:40px; font-size:11px;">
                    {{ $item['label'] }}
                </div>

                <div style="flex:1; background:#eee; border-radius:999px; height:10px; overflow:hidden;">
                    <div style="height:10px; width:{{ $item['width'] }}%; background:linear-gradient(90deg,#5338ff,#ff2f8f);"></div>
                </div>

                <div style="width:24px; font-size:11px; text-align:right;">
                    {{ $item['total'] }}
                </div>
            </div>
        @empty
            <div style="text-align:center; font-size:11px; color:#9a9a9a; padding-top:36px;">
                Belum ada data kunjungan
            </div>
        @endforelse
    </div>
</div>

                <!-- Insight Singkat -->
                <div class="section-card">
                <div class="section-title">
                    <div class="section-icon">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7" cy="7" r="6" stroke="white" stroke-width="1.2"/>
                            <path d="M7 7V4" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
                            <circle cx="7" cy="4" r="0.5" fill="white"/>
                        </svg>
                    </div>
                    Insight Singkat
                </div>
                <div class="insights-grid">
                 @forelse($insight as $item)
                        <div class="insight-box">
                            <div class="insight-label">{{ $item['label'] }}</div>
                            <div class="insight-value">{{ $item['value'] }}</div>
                            <div class="insight-change">{{ $item['change'] }}</div>
                        </div>
                    @empty
                        <div class="insight-box">
                            <div class="insight-label">Insight</div>
                            <div class="insight-value">-</div>
                            <div class="insight-change">Belum ada data</div>
                        </div>
                    @endforelse
                </div>
</div>
            </div>
        </main>
    </div>

    <script>
        const profileToggle = document.getElementById('profileToggle');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileToggle && profileDropdown) {
            profileToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });

            document.addEventListener('click', function (e) {
                if (!profileDropdown.contains(e.target) && !profileToggle.contains(e.target)) {
                    profileDropdown.classList.remove('show');
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    profileDropdown.classList.remove('show');
                }
            });
        }
    </script>
</body>
</html>