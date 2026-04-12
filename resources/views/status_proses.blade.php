<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan - Diproses</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --theme-yellow: #EBE571;
            --text-yellow: #F1C40F;
            --bg-light: #f8f9fa;
            --border-color: #ddd;
            --btn-grey: #D4D4D4;
            --btn-blue: #82B2E8;
            --btn-red: #E74C3C;
            --btn-green: #27AE60;
            --text-dark: #222;
            --icon-gold: #D4AC0D;
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

        /* Garis dekoratif di kiri */
        .mobile-wrapper::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 20px;
            background-color: var(--theme-yellow);
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
            margin-left: 15px;
            flex-grow: 1;
        }

        /* --- HEADER --- */
        .status-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 35px;
        }

        .icon-box {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .status-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            line-height: 1.2;
        }

        .status-sub {
            font-size: 12px;
            color: #888;
            margin: 5px 0 0 0;
        }

        /* --- DETAIL LIST --- */
        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 15px 0 5px 0;
            border-bottom: 1.5px solid var(--border-color);
            gap: 15px;
            margin-bottom: 5px;
        }

        .label { font-size: 11px; font-weight: 700; color: #444; flex-shrink: 0; }
        .value { font-size: 12px; font-weight: 700; color: var(--text-dark); text-align: right; word-break: break-word; }

        /* --- TIMELINE BOX --- */
        .timeline-box {
            background-color: var(--theme-yellow);
            border-radius: 15px;
            padding: 20px 15px;
            margin-top: 35px;
        }

        .timeline-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .timeline-steps {
            display: flex;
            justify-content: space-between;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .step-active .circle { background-color: white; }
        .step-inactive .circle { background-color: #E0E0E0; color: #888; font-weight: 700; }

        .step-icon { width: 28px; height: 28px; }
        .step-label { font-size: 10px; font-weight: 600; color: var(--text-dark); text-align: center; line-height: 1.3; }

        /* --- BUTTONS --- */
        .footer-actions {
            margin-top: 40px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding-bottom: 20px;
        }

        .btn {
            flex: 1;
            min-width: 140px;
            border: none;
            padding: 14px 10px;
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

        .btn:active { transform: scale(0.98); }
        .btn-grey { background-color: var(--btn-grey); color: #444; }
        .btn-blue { background-color: var(--btn-blue); color: #1b4b82; }
        .btn-red { background-color: var(--btn-red); color: white; }
        .btn-green { background-color: var(--btn-green); color: white; }

        .icon-svg { width: 18px; height: 18px; fill: currentColor; }
        .stroke-svg { width: 18px; height: 18px; stroke: currentColor; fill: none; }

        /* --- MODAL --- */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 20px;
        }

        .modal-content {
            background: white;
            width: 100%;
            max-width: 380px;
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .modal-title { font-weight: 700; font-size: 18px; margin-bottom: 5px; }
        .modal-text { font-size: 13px; color: #666; margin-bottom: 20px; }
        .alert-box { border-radius: 8px; padding: 12px; margin-bottom: 20px; text-align: left; }
        .modal-btns { display: flex; gap: 10px; }
    </style>
</head>
<body>

<div class="mobile-wrapper">
    <div class="content">
        <div class="status-header">
            <div class="icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 20 20"><g fill="var(--icon-gold)"><path fill-rule="evenodd" d="M7.203 4c.13.819.323 1.595.575 2.084c.198.385.586.874 1.118 1.407c.365.365.752.706 1.104.996c.352-.29.74-.631 1.104-.996c.532-.533.92-1.022 1.118-1.407c.252-.489.444-1.265.575-2.084zm-.662-2c-.844 0-1.518.697-1.42 1.536C5.246 4.612 5.499 6.026 6 7c.672 1.305 2.218 2.643 3.18 3.393c.485.38 1.155.38 1.64 0C11.783 9.643 13.329 8.305 14 7c.501-.973.754-2.388.88-3.464c.097-.84-.577-1.536-1.421-1.536z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M12.797 16c-.13-.819-.323-1.595-.575-2.084c-.198-.385-.586-.875-1.118-1.407A16 16 0 0 0 10 11.513c-.352.29-.74.631-1.104.996c-.532.532-.92 1.022-1.118 1.407c-.252.489-.444 1.265-.575 2.084zm.662 2c.844 0 1.518-.697 1.42-1.535c-.125-1.077-.378-2.492-.879-3.465c-.672-1.305-2.218-2.643-3.18-3.393a1.326 1.326 0 0 0-1.64 0C8.217 10.357 6.672 11.695 6 13c-.501.973-.754 2.388-.88 3.465c-.097.838.577 1.535 1.421 1.535z" clip-rule="evenodd"/><path d="M7 15.75s2-1.5 3-1.5s3 1.5 3 1.5v.5H7z"/><path fill-rule="evenodd" d="M4 2.5a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1m0 15a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1" clip-rule="evenodd"/></g></svg>
            </div>
            <div>
                <h1 class="status-title">Permohonan Diproses</h1>
                <p class="status-sub">Pengajuan sedang diproses</p>
            </div>
        </div>

        <div class="detail-item"><span class="label">Nomor Pengajuan</span><span class="value">{{ $data->nomor }}</span></div>
        <div class="detail-item"><span class="label">Nama</span><span class="value">{{ $data->nama }}</span></div>
        <div class="detail-item"><span class="label">Tanggal Pengajuan</span><span class="value">{{ $data->created_at->format('d M Y, H.i') }} WIB</span></div>
        <div class="detail-item"><span class="label">Status</span><span class="value" style="color: {{ $currentColor }};">{{ $statusText }}</span></div>
        <div class="detail-item"><span class="label">Estimasi Proses</span><span class="value">1-2 Hari Kerja</span></div>

        <div class="timeline-box">
            <div class="timeline-header">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                Estimasi Proses
            </div>
            
            <div class="timeline-steps">
                <div class="step step-active">
                    <div class="circle">
                        <svg class="step-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><g fill="none" stroke="var(--icon-gold)" stroke-linejoin="round" stroke-width="4"><path d="M24 44a19.94 19.94 0 0 0 14.142-5.858A19.94 19.94 0 0 0 44 24a19.94 19.94 0 0 0-5.858-14.142A19.94 19.94 0 0 0 24 4A19.94 19.94 0 0 0 9.858 9.858A19.94 19.94 0 0 0 4 24a19.94 19.94 0 0 0 5.858 14.142A19.94 19.94 0 0 0 24 44Z"/><path stroke-linecap="round" d="m16 24l6 6l12-12"/></g></svg>
                    </div>
                    <div class="step-label">Pengajuan<br>Diterima</div>
                </div>

                <div class="step step-active">
                    <div class="circle">
                        <svg class="step-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><g fill="var(--icon-gold)"><path fill-rule="evenodd" d="M7.203 4c.13.819.323 1.595.575 2.084c.198.385.586.874 1.118 1.407c.365.365.752.706 1.104.996c.352-.29.74-.631 1.104-.996c.532-.533.92-1.022 1.118-1.407c.252-.489.444-1.265.575-2.084zm-.662-2c-.844 0-1.518.697-1.42 1.536C5.246 4.612 5.499 6.026 6 7c.672 1.305 2.218 2.643 3.18 3.393c.485.38 1.155.38 1.64 0C11.783 9.643 13.329 8.305 14 7c.501-.973.754-2.388.88-3.464c.097-.84-.577-1.536-1.421-1.536z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M12.797 16c-.13-.819-.323-1.595-.575-2.084c-.198-.385-.586-.875-1.118-1.407A16 16 0 0 0 10 11.513c-.352.29-.74.631-1.104.996c-.532.532-.92 1.022-1.118 1.407c-.252.489-.444 1.265-.575 2.084zm.662 2c.844 0 1.518-.697 1.42-1.535c-.125-1.077-.378-2.492-.879-3.465c-.672-1.305-2.218-2.643-3.18-3.393a1.326 1.326 0 0 0-1.64 0C8.217 10.357 6.672 11.695 6 13c-.501.973-.754 2.388-.88 3.465c-.097.838.577 1.535 1.421 1.535z" clip-rule="evenodd"/><path d="M7 15.75s2-1.5 3-1.5s3 1.5 3 1.5v.5H7z"/><path fill-rule="evenodd" d="M4 2.5a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1m0 15a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1" clip-rule="evenodd"/></g></svg>
                    </div>
                    <div class="step-label">Verifikasi<br>Admin</div>
                </div>

                <div class="step step-inactive">
                    <div class="circle">3</div>
                    <div class="step-label">Persetujuan</div>
                </div>
                <div class="step step-inactive">
                    <div class="circle">4</div>
                    <div class="step-label">QR Code<br>Dikirim</div>
                </div>
            </div>
        </div>

        <div class="footer-actions">
            <button class="btn btn-grey" onclick="window.location.href='/'">
                <svg class="icon-svg" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                Beranda
            </button>
            <button class="btn btn-blue" onclick="alert('Menghubungi Admin...')">
                <svg class="stroke-svg" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.63A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                Hubungi Admin
            </button>
            <button class="btn btn-red" style="width: 100%; flex: none;" onclick="showModal('modalBatal')">
                <svg class="stroke-svg" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Batalkan Pengajuan
            </button>
        </div>
    </div>
</div>

<div id="modalBatal" class="modal-overlay">
    <div class="modal-content">
        <div style="margin-bottom: 15px;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#F39C12" stroke-width="1.5">
                <path d="M12 9V11M12 15H12.01M5.07 19H18.93C20.47 19 21.43 17.33 20.66 16L13.73 4C12.96 2.67 11.04 2.67 10.27 4L3.34 16C2.57 17.33 3.53 19 5.07 19Z" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="modal-title">Batalkan Permohonan?</div>
        <p class="modal-text">Konfirmasi pembatalan permohonan Anda</p>
        <div class="alert-box" style="background: #FFF9E6; border: 1px solid #FFE58F;">
            <strong style="color: #856404; font-size: 12px; display: block; margin-bottom: 4px;">Perhatian!</strong>
            <p style="color: #856404; font-size: 10px; margin: 0; line-height: 1.4;">Dengan membatalkan permohonan ini, semua dokumen dan data dihapus.</p>
        </div>
        <div class="modal-btns">
            <button class="btn btn-grey" onclick="hideModal('modalBatal')" style="flex:1">Kembali</button>
            <button class="btn btn-red" onclick="prosesBatalKeSukses()" style="flex:1.5">Batalkan Permohonan</button>
        </div>
    </div>
</div>

<div id="modalSuksesBatal" class="modal-overlay">
    <div class="modal-content">
        <div style="margin-bottom: 15px;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#27AE60" stroke-width="1.5">
                <path d="M22 11.08V12C21.99 14.16 21.3 16.25 20.01 17.98C18.72 19.71 16.9 20.97 14.84 21.58C12.77 22.2 10.56 22.12 8.53 21.37C6.51 20.63 4.78 19.25 3.61 17.44C2.44 15.63 1.88 13.49 2.02 11.34C2.16 9.18 3 7.14 4.4 5.5C5.8 3.86 7.69 2.72 9.8 2.24C11.9 1.76 14.1 1.98 16.07 2.86M22 4L12 14.01L9 11.01" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="modal-title">Pembatalan Berhasil!</div>
        <p class="modal-text">Permohonan Anda telah resmi dibatalkan.</p>
        <button class="btn btn-green" onclick="window.location.href='/'" style="width:100%">Tutup</button>
    </div>
</div>

<script>
    function showModal(id) { document.getElementById(id).style.display = 'flex'; }
    function hideModal(id) { document.getElementById(id).style.display = 'none'; }
    
    function prosesBatalKeSukses() {
        hideModal('modalBatal');
        setTimeout(() => { showModal('modalSuksesBatal'); }, 200);
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) { 
            event.target.style.display = 'none'; 
        }
    }
</script>

</body>
</html>