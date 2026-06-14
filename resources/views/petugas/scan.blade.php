<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR - Visitor System</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode" defer></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-start: #5b3fd3;
            --primary-end: #d83f93;
            --bg: #efefef;
            --card: #f8f8f8;
            --card-soft: #f3f3f3;
            --text-dark: #202020;
            --text-muted: #6f6f6f;
            --line: #dddddd;
            --success-bg: #e9f8ef;
            --success-text: #1f8a4d;
            --error-bg: #ffe8e8;
            --error-text: #d84141;
            --info-bg: #eef2ff;
            --info-text: #4b4fd4;
            --shadow: 0 14px 30px rgba(91, 63, 211, 0.12);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 18px;
            padding-bottom: max(18px, calc(18px + env(safe-area-inset-bottom)));
        }

        .phone {
            width: 100%;
            max-width: 100%; /* Full width on mobile */
            min-height: auto;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(0,0,0,0.12);
            border: 1px solid rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 641px) {
            .phone {
                max-width: 420px;
                min-height: 780px;
            }
        }

        .topbar {
            height: 56px;
            background: linear-gradient(90deg, var(--primary-start) 0%, var(--primary-end) 100%);
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 12px;
            box-shadow: 0 6px 16px rgba(91, 63, 211, 0.18);
            flex-shrink: 0;
        }

        .back {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            text-decoration: none;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.12);
            transition: 0.2s ease;
            flex-shrink: 0;
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
            position: relative;
        }

        .back:hover {
            background: rgba(255,255,255,0.2);
        }

        .topbar-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .topbar-text small {
            font-size: 9px;
            font-weight: 600;
            opacity: 0.85;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .topbar-text span {
            font-size: 14px;
            font-weight: 800;
        }

        .topbar-text span {
            font-size: 17px;
            font-weight: 800;
        }

        .content {
            padding: 22px 16px 22px;
            text-align: center;
        }

        .hero-card {
            background: linear-gradient(180deg, #fbfbfb 0%, #f4f4f4 100%);
            border: 1px solid #ececec;
            border-radius: 18px;
            padding: 16px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            box-shadow: var(--shadow);
            text-align: left;
        }

        .hero-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(90deg, var(--primary-start) 0%, var(--primary-end) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 18px rgba(91, 63, 211, 0.18);
        }

        .hero-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 3px;
        }

        .hero-desc {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.55;
        }

        .scanner-card {
            background: var(--card);
            border-radius: 18px;
            padding: 18px 14px 16px;
            border: 1px solid #ececec;
            box-shadow: var(--shadow);
        }

        .scan-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: var(--success-bg);
            color: var(--success-text);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .reader-frame {
            width: 100%;
            max-width: 310px;
            margin: 0 auto 18px;
            padding: 10px;
            border-radius: 24px;
            background: linear-gradient(90deg, rgba(91,63,211,0.16), rgba(216,63,147,0.16));
        }

        .reader-wrap {
            width: 100%;
            border-radius: 18px;
            overflow: hidden;
            background: #0f172a;
            position: relative;
            border: 2px solid rgba(255,255,255,0.55);
            box-shadow: inset 0 0 20px rgba(0,0,0,0.25);
        }

        .reader-wrap::before,
        .reader-wrap::after,
        .reader-corners-bottom::before,
        .reader-corners-bottom::after {
            content: "";
            position: absolute;
            width: 34px;
            height: 34px;
            border: 4px solid #ffffff;
            z-index: 10;
            pointer-events: none;
        }

        .reader-wrap::before {
            top: 12px;
            left: 12px;
            border-right: 0;
            border-bottom: 0;
            border-radius: 10px 0 0 0;
        }

        .reader-wrap::after {
            top: 12px;
            right: 12px;
            border-left: 0;
            border-bottom: 0;
            border-radius: 0 10px 0 0;
        }

        .reader-corners-bottom::before {
            bottom: 12px;
            left: 12px;
            border-right: 0;
            border-top: 0;
            border-radius: 0 0 0 10px;
        }

        .reader-corners-bottom::after {
            bottom: 12px;
            right: 12px;
            border-left: 0;
            border-top: 0;
            border-radius: 0 0 10px 0;
        }

        #reader {
            width: 100%;
            min-height: 290px;
        }

        .title {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 13px;
            color: #5f5f5f;
            line-height: 1.65;
            margin-bottom: 14px;
        }

        .info-box,
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            text-align: left;
            padding: 12px 13px;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.6;
            margin-bottom: 14px;
            border: 1px solid transparent;
        }

        .info-box {
            background: var(--info-bg);
            color: var(--info-text);
            border-color: rgba(91, 63, 211, 0.08);
        }

        .info-box.success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: rgba(31, 138, 77, 0.08);
        }

        .info-box.error,
        .alert {
            background: var(--error-bg);
            color: var(--error-text);
            border-color: rgba(216, 65, 65, 0.08);
        }

        .message-icon {
            flex-shrink: 0;
            margin-top: 1px;
        }

        .divider {
            margin: 18px 0 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .divider-text {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .manual-card {
            background: #ffffff;
            border: 1px solid #ececec;
            border-radius: 16px;
            padding: 15px 13px;
        }

        .manual-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            text-align: left;
        }

        .manual-head .icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #f0ebff;
            color: var(--primary-start);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .manual-head span {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .input-group {
            position: relative;
            margin-bottom: 12px;
        }

        .input-group iconify-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #9b9b9b;
            font-size: 18px;
        }

        .input-token {
            width: 100%;
            height: 48px;
            border: 1.6px solid #dddddd;
            border-radius: 12px;
            padding: 0 14px 0 42px;
            outline: none;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            transition: 0.2s ease;
            background: #fff;
        }

        .input-token::placeholder {
            color: #aaaaaa;
        }

        .input-token:focus {
            border-color: var(--primary-start);
            box-shadow: 0 0 0 4px rgba(91, 63, 211, 0.08);
        }

        .btn {
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 14px;
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .btn + .btn {
            margin-top: 10px;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--primary-start) 0%, var(--primary-end) 100%);
            box-shadow: 0 8px 18px rgba(91, 63, 211, 0.22);
        }

        .btn-secondary {
            background: #8d8d8d;
            box-shadow: 0 8px 18px rgba(0,0,0,0.12);
        }

        .helper-list {
            margin-top: 14px;
            display: grid;
            gap: 10px;
        }

        .helper-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            text-align: left;
            font-size: 12px;
            color: #666666;
            padding: 11px 12px;
            border-radius: 12px;
            background: var(--card-soft);
            border: 1px solid #ededed;
            line-height: 1.55;
        }

        .helper-item .icon {
            width: 30px;
            height: 30px;
            border-radius: 10px;
            background: #f0ebff;
            color: var(--primary-start);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.42);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            backdrop-filter: blur(4px);
            padding: 20px;
        }

        .modal-content {
            width: 100%;
            max-width: 320px;
            background: white;
            border-radius: 22px;
            padding: 34px 24px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.16);
        }

        .success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 18px;
            border-radius: 22px;
            background: #ecfdf5;
            color: var(--success);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 24px rgba(16,185,129,0.16);
        }

        .modal-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .modal-text {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.65;
            margin-bottom: 16px;
        }

        .modal-progress {
            width: 100%;
            height: 8px;
            border-radius: 999px;
            background: #ececec;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .modal-progress span {
            display: block;
            width: 40%;
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #10b981, #4ade80);
            animation: loadingBar 1.2s ease-in-out infinite;
        }

        @keyframes loadingBar {
            0% { width: 20%; }
            50% { width: 78%; }
            100% { width: 36%; }
        }

        .spinner {
            width: 28px;
            height: 28px;
            border: 3px solid #e5e7eb;
            border-top-color: var(--primary-start);
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 640px) {
            body {
                padding: 12px;
            }
        }

        @media (max-width: 420px) {
            body {
                padding: 0;
            }

            .phone {
                max-width: 100%;
                min-height: 100vh;
                border-radius: 0;
            }

            .topbar {
                height: 56px;
                gap: 8px;
                padding: 0 10px;
            }

            .back {
                width: 30px;
                height: 30px;
                font-size: 16px;
            }

            .topbar-text small {
                font-size: 8px;
            }

            .topbar-text span {
                font-size: 13px;
            }

            .content {
                padding: 16px 12px;
            }

            .hero-card {
                padding: 14px 12px;
                gap: 10px;
                margin-bottom: 14px;
            }

            .hero-icon {
                width: 48px;
                height: 48px;
                border-radius: 14px;
            }

            .hero-title {
                font-size: 14px;
                margin-bottom: 2px;
            }

            .hero-desc {
                font-size: 11px;
            }

            .title {
                font-size: 18px;
            }

            .subtitle {
                font-size: 12px;
            }

            .scanner-card {
                padding: 16px 12px;
            }

            .scan-badge {
                padding: 7px 12px;
                font-size: 11px;
            }

            #reader {
                min-height: 260px;
            }

            .info-box,
            .alert {
                padding: 10px 11px;
                font-size: 11px;
                gap: 8px;
            }

            .input-group iconify-icon {
                width: 16px;
                height: 16px;
            }

            .input-token {
                font-size: 12px;
                padding: 10px 12px;
                height: 36px;
            }

            .btn {
                padding: 10px 12px;
                font-size: 13px;
                height: 36px;
                border-radius: 8px;
            }

            .btn + .btn {
                margin-top: 8px;
            }

            .helper-list {
                gap: 8px;
            }

            .helper-item {
                padding: 10px 11px;
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="phone">
        <div class="topbar">
            <a href="{{ route('petugas.dashboard') }}" class="back" aria-label="Kembali">
                <iconify-icon icon="solar:arrow-left-linear" width="22" height="22"></iconify-icon>
            </a>

            <div class="topbar-text">
                <small>Petugas Keamanan</small>
                <span>Scan QR Visitor</span>
            </div>
        </div>

        <div class="content">
            @if($errors->has('scan'))
                <div class="alert">
                    <div class="message-icon">
                        <iconify-icon icon="solar:danger-triangle-bold-duotone" width="18" height="18"></iconify-icon>
                    </div>
                    <div>{{ $errors->first('scan') }}</div>
                </div>
            @endif

            <div class="hero-card">
                <div class="hero-icon">
                    <iconify-icon icon="solar:qr-code-linear" width="28" height="28"></iconify-icon>
                </div>
                <div>
                    <div class="hero-title">Validasi Akses Visitor</div>
                    <div class="hero-desc">Pindai QR untuk proses check-in atau check-out visitor secara cepat dan akurat.</div>
                </div>
            </div>

            <div class="scanner-card">
                <div class="scan-badge">
                    <iconify-icon icon="solar:camera-minimalistic-bold-duotone" width="16" height="16"></iconify-icon>
                    Kamera siap digunakan
                </div>

                <div class="reader-frame">
                    <div class="reader-wrap">
                        <div class="reader-corners-bottom"></div>
                        <div id="reader"></div>
                    </div>
                </div>

                <div class="title">Arahkan QR Code ke Kamera</div>
                <div class="subtitle">
                    Izinkan akses kamera untuk pemindaian otomatis. Kamu juga bisa menggunakan token manual di bawah.
                </div>

                <div id="scanStatus" class="info-box">
                    <div class="message-icon">
                        <iconify-icon icon="solar:hourglass-line-duotone" width="18" height="18"></iconify-icon>
                    </div>
                    <div>Inisialisasi kamera...</div>
                </div>

                <div class="divider">
                    <span class="divider-text">
                        <iconify-icon icon="solar:keyboard-linear" width="14" height="14"></iconify-icon>
                        Input Manual
                    </span>
                </div>

                <div class="manual-card">
                    <div class="manual-head">
                        <div class="icon">
                            <iconify-icon icon="solar:clipboard-text-linear" width="18" height="18"></iconify-icon>
                        </div>
                        <span>Masukkan token QR visitor</span>
                    </div>

                    <form method="POST" action="{{ route('petugas.scan.process') }}" id="scanForm">
                        @csrf

                        <div class="input-group">
                            <iconify-icon icon="solar:qr-code-linear"></iconify-icon>
                            <input
                                type="text"
                                name="qr_token"
                                id="qr_token"
                                class="input-token"
                                placeholder="Paste QR token di sini..."
                                value="{{ old('qr_token') }}"
                            >
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <iconify-icon icon="solar:check-read-linear" width="18" height="18"></iconify-icon>
                            Proses Scan
                        </button>

                        <button type="button" class="btn btn-secondary" id="retryCameraBtn">
                            <iconify-icon icon="solar:restart-bold" width="18" height="18"></iconify-icon>
                            Coba Ulang Kamera
                        </button>
                    </form>

                    <div class="helper-list">
                        <div class="helper-item">
                            <div class="icon">
                                <iconify-icon icon="solar:shield-check-linear" width="16" height="16"></iconify-icon>
                            </div>
                            <span>Pastikan izin kamera telah diberikan agar pemindaian berjalan otomatis.</span>
                        </div>

                        <div class="helper-item">
                            <div class="icon">
                                <iconify-icon icon="solar:scanner-linear" width="16" height="16"></iconify-icon>
                            </div>
                            <span>Posisikan QR di tengah frame agar pembacaan lebih cepat dan stabil.</span>
                        </div>

                        <div class="helper-item">
                            <div class="icon">
                                <iconify-icon icon="solar:document-text-linear" width="16" height="16"></iconify-icon>
                            </div>
                            <span>Gunakan token manual jika kamera perangkat tidak tersedia atau gagal dibuka.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="successModal" class="modal-overlay">
        <div class="modal-content">
            <div class="success-icon">
                <iconify-icon icon="solar:check-circle-bold-duotone" width="46" height="46"></iconify-icon>
            </div>

            <h2 class="modal-title">Scan Berhasil</h2>
            <p class="modal-text">QR Code berhasil terdeteksi. Sistem sedang memproses data visitor.</p>

            <div class="modal-progress">
                <span></span>
            </div>

            <div class="spinner"></div>
        </div>
    </div>

    <script>
        let html5QrCode = null;
        let scannerStarted = false;
        let isSubmitting = false;

        const qrInput = document.getElementById('qr_token');
        const scanForm = document.getElementById('scanForm');
        const scanStatus = document.getElementById('scanStatus');
        const retryCameraBtn = document.getElementById('retryCameraBtn');
        const successModal = document.getElementById('successModal');

        function setStatus(message, type = '') {
            const iconMap = {
                '': 'solar:hourglass-line-duotone',
                'success': 'solar:check-circle-bold-duotone',
                'error': 'solar:danger-triangle-bold-duotone'
            };

            scanStatus.className = 'info-box' + (type ? ' ' + type : '');
            scanStatus.innerHTML = `
                <div class="message-icon">
                    <iconify-icon icon="${iconMap[type] || iconMap['']}" width="18" height="18"></iconify-icon>
                </div>
                <div>${message}</div>
            `;
        }

        function submitScanResult(decodedText) {
            if (isSubmitting) return;

            isSubmitting = true;
            qrInput.value = decodedText;
            setStatus('QR berhasil dibaca. Memproses data...', 'success');

            if (html5QrCode && scannerStarted) {
                html5QrCode.stop().catch(() => {});
            }

            successModal.style.display = 'flex';

            setTimeout(() => {
                scanForm.submit();
            }, 1500);
        }

        scanForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const tokenValue = qrInput.value.trim();

            if (!tokenValue) {
                setStatus('Masukkan token QR terlebih dahulu.', 'error');
                qrInput.focus();
                return;
            }

            if (isSubmitting) {
                return;
            }

            isSubmitting = true;
            setStatus('Memproses token...', 'success');
            successModal.style.display = 'flex';

            if (html5QrCode && scannerStarted) {
                html5QrCode.stop().catch(() => {});
            }

            setTimeout(() => {
                scanForm.submit();
            }, 1000);
        });

        async function startScanner() {
            if (!window.Html5Qrcode) {
                setStatus('Library scanner gagal dimuat.', 'error');
                return;
            }

            try {
                if (!html5QrCode) {
                    html5QrCode = new Html5Qrcode('reader');
                }

                if (scannerStarted) {
                    await html5QrCode.stop().catch(() => {});
                    scannerStarted = false;
                }

                setStatus('Meminta izin kamera...', '');

                await html5QrCode.start(
                    { facingMode: 'environment' },
                    {
                        fps: 10,
                        qrbox: { width: 220, height: 220 },
                        aspectRatio: 1
                    },
                    (decodedText) => {
                        submitScanResult(decodedText);
                    },
                    () => {}
                );

                scannerStarted = true;
                setStatus('Kamera aktif. Arahkan QR ke dalam frame.', 'success');
            } catch (error) {
                console.error(error);
                setStatus('Kamera tidak bisa dibuka. Pakai localhost/HTTPS dan izinkan akses kamera, atau input manual.', 'error');
            }
        }

        retryCameraBtn.addEventListener('click', function () {
            startScanner();
        });

        window.addEventListener('load', function () {
            startScanner();
        });
    </script>
</body>
</html>