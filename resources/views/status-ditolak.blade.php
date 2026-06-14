<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan - Ditolak</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --status-red: #FF5E5E;
            --bg-light: #f8f9fa;
            --border-color: #eee;
            --btn-grey: #D4D4D4;
            --btn-blue: #82B2E8;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }

        .mobile-wrapper {
            width: 100%;
            max-width: 420px;
            background: white;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 25px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        /* Garis Merah Samping */
        .mobile-wrapper::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background-color: var(--status-red);
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
            margin: 0;
            flex-grow: 1;
        }

        /* --- HEADER STATUS --- */
        .status-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            background-color: var(--status-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Ukuran SVG Cross */
        .icon-circle svg {
            width: 32px;
            height: 32px;
        }

        .status-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: #222;
        }

        .status-sub {
            font-size: 11px;
            color: #888;
            margin: 5px 0 0 0;
        }

        /* --- DETAIL LIST --- */
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1.5px solid var(--border-color);
            gap: 15px;
        }

        .label {
            font-size: 11px;
            font-weight: 700;
            color: #444;
            flex-shrink: 0;
        }

        .value {
            font-size: 12px;
            font-weight: 700;
            color: #000;
            text-align: right;
            word-break: break-word;
        }

        /* --- ALASAN PENOLAKAN BOX --- */
        .reason-box {
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid var(--status-red);
            border-left: 6px solid var(--status-red);
            border-radius: 12px;
            padding: 15px;
        }

        .reason-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--status-red);
        }

        .reason-text {
            font-size: 11px;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        /* --- FOOTER BUTTONS --- */
        .footer-actions {
            margin-top: 25px;
            display: flex;
            gap: 15px;
            padding-bottom: 10px;
        }

        .btn {
            flex: 1;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.1s, opacity 0.2s;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-grey { background-color: var(--btn-grey); color: #444; }
        .btn-blue { background-color: var(--btn-blue); color: #1b4b82; }

        .icon-svg { width: 18px; height: 18px; fill: currentColor; }
    </style>
</head>
<body>

<div class="mobile-wrapper">
    <div class="content">
        
        <div class="status-header">
            <div class="icon-circle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                    <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                        <path d="m10.25 5.75-4.5 4.5m0-4.5 4.5 4.5"/>
                        <circle cx="8" cy="8" r="6.25"/>
                    </g>
                </svg>
            </div>
            <div>
                <h1 class="status-title">{{ $statusText }}</h1>
                <p class="status-sub">Tanggal : {{ $isRejected && $pengajuan->tanggal_ditolak ? $pengajuan->tanggal_ditolak->format('d M Y, H.i') : 'Dibatalkan' }} WIB</p>
            </div>
        </div>

        <div class="detail-item">
            <span class="label">Nomor Pengajuan</span>
            <span class="value">{{ $inputNomor }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Nama</span>
            <span class="value">{{ $pengajuan->nama_pengunjung }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Instansi</span>
            <span class="value">{{ $pengajuan->asal_institusi ?? '-' }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Tanggal Pengajuan</span>
            <span class="value">{{ $pengajuan->created_at->format('d M Y, H.i') }} WIB</span>
        </div>

        <div class="detail-item">
            <span class="label">Status</span>
            <span class="value" style="color: {{ $currentColor }};">{{ $statusText }}</span>
        </div>

        @if($isRejected && $pengajuan->catatan_admin)
        <div class="reason-box">
            <div class="reason-header">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                Alasan Penolakan:
            </div>
            <p class="reason-text">
                {{ $pengajuan->catatan_admin }}
            </p>
        </div>
        @elseif($isCancelled)
        <div class="reason-box">
            <div class="reason-header">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                Keterangan:
            </div>
            <p class="reason-text">
                Permohonan ini telah dibatalkan oleh pemohon.
            </p>
        </div>
        @endif

        <div class="footer-actions">
            <button class="btn btn-grey" onclick="window.location.href='/'">
                <svg class="icon-svg" viewBox="0 0 24 24">
                    <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
                </svg>
                Ajukan Ulang
            </button>
            
            <button class="btn btn-blue" onclick="window.open('https://wa.me/62895342116058', '_blank')">
                <svg class="icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.63A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                Hubungi Petugas Keamanan
            </button>
        </div>

    </div>
</div>

</body>
</html>