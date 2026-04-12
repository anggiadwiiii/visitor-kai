<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan - Disetujui</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(to right, #6A56A5, #D45B9C);
            --bg-light: #f8f9fa;
            --success-green: #2ecc71;
            --border-color: #eee;
            --gray-btn: #e0e0e0;
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
            max-width: 450px;
            background: white;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 40px 25px;
            box-sizing: border-box;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        /* Garis Hijau Samping */
        .mobile-wrapper::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 20px;
            background-color: #B2E8B1;
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
            margin-left: 15px;
            flex-grow: 1;
        }

        /* --- HEADER STATUS --- */
        .status-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 35px;
        }

        .check-box {
            width: 65px;
            height: 65px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .check-box svg {
            width: 70px;
            height: 70px;
        }

        .status-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin: 0;
            line-height: 1.2;
        }

        .status-sub {
            font-size: 12px;
            color: #999;
            margin: 5px 0 0 0;
        }

        /* --- DETAIL LIST --- */
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1.5px solid var(--border-color);
            gap: 15px;
        }

        .label {
            font-size: 11px;
            font-weight: 700;
            color: #444;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .value {
            font-size: 12px;
            font-weight: 700;
            color: #000;
            text-align: right;
            word-break: break-word;
        }

        /* --- QR SECTION --- */
        .qr-card {
            margin-top: 40px;
            border: 2px dashed #ccc;
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            background: #fff;
        }

        .qr-code-img {
            width: 170px;
            height: 170px;
            margin: 15px auto;
            display: block;
        }

        .btn-download {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(212, 91, 156, 0.3);
        }

        /* --- INFO BOX --- */
        .info-box {
            margin-top: 35px;
            background-color: #EAFBF3;
            border: 1px solid #B2E8B1;
            border-radius: 15px;
            padding: 18px;
        }

        .info-box h4 {
            font-size: 13px;
            margin: 0 0 10px 0;
        }

        .info-list {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .info-list li {
            font-size: 11px;
            color: #555;
            margin-bottom: 6px;
            display: flex;
            gap: 10px;
            line-height: 1.5;
        }

        .info-list li::before {
            content: '•';
            font-weight: bold;
            color: #2ecc71;
        }

        /* --- TOMBOL BACK --- */
        .footer-actions {
            margin-top: 40px;
            padding-bottom: 20px;
        }

        .btn-back {
            width: 100%;
            background-color: var(--gray-btn);
            color: #555;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background 0.3s;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #d4d4d4;
        }
    </style>
</head>
<body>

<div class="mobile-wrapper">
    <div class="content">
        
        <div class="status-header">
            <div class="check-box">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="none" stroke="#82e0aa" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 10l-4 4l-2-2m4.246-8.541l1.221 1.04c.308.262.69.42 1.092.453l1.6.128a1.92 1.92 0 0 1 1.761 1.76l.127 1.6c.033.403.192.786.454 1.093l1.04 1.22a1.92 1.92 0 0 1 0 2.492l-1.04 1.221c-.262.308-.421.69-.453 1.093l-.128 1.6a1.92 1.92 0 0 1-1.76 1.761l-1.6.128a1.92 1.92 0 0 0-1.093.452l-1.221 1.04a1.92 1.92 0 0 1-2.492 0l-1.22-1.04a1.92 1.92 0 0 0-1.094-.452l-1.6-.128a1.92 1.92 0 0 1-1.76-1.762l-.128-1.599a1.92 1.92 0 0 0-.453-1.092l-1.04-1.222a1.92 1.92 0 0 1 0-2.49l1.04-1.222c.263-.308.42-.69.452-1.093l.128-1.599A1.92 1.92 0 0 1 6.842 5.08l1.598-.127A1.92 1.92 0 0 0 9.533 4.5l1.221-1.04a1.92 1.92 0 0 1 2.492 0"/>
                </svg>
            </div>
            <div>
                <h1 class="status-title">{{ $statusText }}</h1>
                <p class="status-sub">Tanggal Pengajuan: {{ $data->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <div class="detail-item">
            <span class="label">Nomor Pengajuan</span>
            <span class="value">{{ $data->nomor }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Nama</span>
            <span class="value">{{ $data->nama }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Area/Stasiun</span>
            <span class="value">{{ $data->stasiun_kunjungan }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Tanggal Kunjungan</span>
            <span class="value">{{ $data->tanggal_kunjungan }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Status</span>
            <span class="value" style="color: {{ $currentColor }};">{{ $statusText }}</span>
        </div>

        @if($isApproved)
        <div class="qr-card">
            <div style="font-size: 13px; font-weight: 700; margin-bottom: 15px;">QR Code Check-In/out</div>
            {!! $qrCodeHtml !!}
            <p style="font-size: 11px; color: #666; margin-bottom: 20px;">Tunjukkan QR Code ini ke petugas keamanan</p>
            <a href="#" class="btn-download">
                <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
                Download QR Code
            </a>
        </div>
        @endif

        <div class="info-box">
            <h4>Informasi Penting:</h4>
            <ul class="info-list">
                @if($isApproved)
                <li>QR Code berlaku untuk 1 kali kunjungan</li>
                <li>Simpan QR Code dengan baik</li>
                <li>Tunjukkan saat check-in dan check-out</li>
                @elseif($isRejected)
                <li>Permohonan ditolak, silakan hubungi admin</li>
                @elseif($isCancelled)
                <li>Permohonan telah dibatalkan</li>
                @else
                <li>Permohonan sedang diproses</li>
                <li>Notifikasi akan dikirim via email/WhatsApp</li>
                @endif
            </ul>
        </div>

        <div class="footer-actions">
            <a href="/" class="btn-back">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

</body>
</html>