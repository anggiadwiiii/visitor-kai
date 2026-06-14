<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi QR Code Visitor</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #efefef;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            padding-bottom: max(20px, calc(20px + env(safe-area-inset-bottom)));
        }

        .phone {
            width: 100%;
            max-width: 100%; /* Full width on mobile */
            min-height: auto;
            background: #ffffff;
            overflow: visible;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        @media (min-width: 641px) {
            .phone {
                max-width: 420px;
                min-height: 720px;
            }
        }

        .topbar {
            height: 56px;
            background: linear-gradient(90deg, #5b3fd3 0%, #d83f93 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 14px;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(91, 63, 211, 0.24);
        }

        .content {
            padding: 26px 16px 24px;
            text-align: center;
        }

        .status-icon-wrap {
            margin: 8px auto 14px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .status-icon {
            width: 150px;
            height: 150px;
            filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.12));
            animation: bounce-in 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        @keyframes bounce-in {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            70% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .title {
            font-size: 26px;
            line-height: 1.2;
            font-weight: 800;
            background: linear-gradient(90deg, #2d2a70 0%, #5b3fd3 50%, #d83f93 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 4px;
            animation: fade-in 0.6s ease-out;
        }

        .subtitle {
            font-size: 14px;
            color: #6b7280;
            font-style: normal;
            margin-bottom: 22px;
            font-weight: 500;
            animation: fade-in 0.8s ease-out;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .detail-card {
            background: linear-gradient(135deg, #f8f9ff 0%, #f3f4ff 100%);
            border: 1.5px solid #e8ebff;
            border-radius: 16px;
            padding: 18px 16px;
            text-align: left;
            margin-bottom: 18px;
            box-shadow: 0 4px 12px rgba(91, 63, 211, 0.08);
        }

        .detail-title {
            font-size: 14px;
            font-weight: 800;
            color: #2d2a70;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-title::before {
            content: '';
            width: 4px;
            height: 16px;
            background: linear-gradient(90deg, #5b3fd3 0%, #d83f93 100%);
            border-radius: 2px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 14px 12px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            margin-bottom: 10px;
            border: 1px solid rgba(235, 238, 255, 0.8);
        }

        .row:last-child {
            margin-bottom: 0;
        }

        .label {
            width: 45%;
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
        }

        .value {
            width: 55%;
            font-size: 13px;
            font-weight: 700;
            color: #1f2937;
            text-align: right;
            line-height: 1.45;
        }

        .btn {
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background: linear-gradient(90deg, #5b3fd3 0%, #d83f93 100%);
            color: #fff;
            box-shadow: 0 6px 16px rgba(91, 63, 211, 0.28);
            margin-bottom: 12px;
        }

        .btn-secondary {
            background: linear-gradient(90deg, #6b7280 0%, #4b5563 100%);
            color: #fff;
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        }

        .footer-space {
            height: 4px;
        }

        @media (max-width: 640px) {
            body {
                padding: 12px;
            }

            .phone {
                border-radius: 12px;
            }
        }

        @media (max-width: 420px) {
            body {
                padding: 0;
            }

            .phone {
                border-radius: 0;
                max-width: 100%;
                min-height: 100vh;
            }

            .topbar {
                height: 56px;
                font-size: 13px;
                padding: 0 12px;
            }

            .content {
                padding: 20px 14px;
            }

            .status-icon-wrap {
                margin: 6px auto 12px;
            }

            .status-icon {
                width: 140px;
                height: 140px;
            }

            .title {
                font-size: 22px;
                margin-bottom: 2px;
            }

            .subtitle {
                font-size: 12px;
                margin-bottom: 14px;
            }

            .detail-card {
                padding: 12px 10px 3px;
                margin-bottom: 12px;
                border-radius: 8px;
            }

            .detail-title {
                font-size: 12px;
                margin-bottom: 8px;
            }

            .row {
                padding: 11px 0;
            }

            .label {
                font-size: 12px;
            }

            .value {
                font-size: 12px;
            }

            .btn {
                height: 36px;
                font-size: 13px;
                margin-bottom: 6px;
            }

            .footer-space {
                height: 3px;
            }
        }
    </style>
</head>
<body>
    <div class="phone">
        <div class="topbar">
            Validasi QR Code Visitor
        </div>

        <div class="content">
            <div class="status-icon-wrap">
                @if($mode === 'checkin')
                    <svg class="status-icon" viewBox="0 0 140 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M70 19C42.3858 19 20 41.3858 20 69C20 96.6142 42.3858 119 70 119C97.6142 119 120 96.6142 120 69" stroke="#67D37B" stroke-width="8" stroke-linecap="round"/>
                        <path d="M45 68.5L63 86L99.5 46" stroke="#67D37B" stroke-width="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                @else
                    <svg class="status-icon" viewBox="0 0 140 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M70 19C42.3858 19 20 41.3858 20 69C20 96.6142 42.3858 119 70 119C97.6142 119 120 96.6142 120 69" stroke="#FF6B6B" stroke-width="8" stroke-linecap="round"/>
                        <path d="M45 68.5L63 86L99.5 46" stroke="#FF6B6B" stroke-width="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                @endif
            </div>

            @if($mode === 'checkin')
                <div class="title">QR Code Valid!</div>
                <div class="subtitle">Check-in berhasil dicatat</div>
            @else
                <div class="title">Check-Out Berhasil</div>
                <div class="subtitle">Check-out berhasil dicatat</div>
            @endif

            <div class="detail-card">
                <div class="detail-title">Detail Visitor</div>

                <div class="row">
                    <div class="label">Nama</div>
                    <div class="value">{{ $visitor['nama'] }}</div>
                </div>

                <div class="row">
                    <div class="label">Instansi</div>
                    <div class="value">{{ $visitor['instansi'] }}</div>
                </div>

                <div class="row">
                    <div class="label">Jenis Visitor</div>
                    <div class="value">{{ $visitor['jenis_visitor'] }}</div>
                </div>

                <div class="row">
                    <div class="label">
                        {{ $mode === 'checkin' ? 'Waktu Check-In' : 'Waktu Check-out' }}
                    </div>
                    <div class="value">{{ $visitor['waktu'] }}</div>
                </div>
            </div>

            <button class="btn btn-primary" onclick="window.location='{{ route('petugas.scan') }}'">
                Scan QR Code lainnya
            </button>

            <button class="btn btn-secondary" onclick="window.location='{{ route('petugas.dashboard') }}'">
                Kembali ke Beranda
            </button>

            <div class="footer-space"></div>
        </div>
    </div>
</body>
</html>