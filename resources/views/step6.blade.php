<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 6 - Status Pengajuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            margin: 0; padding: 0; font-family: 'Poppins', sans-serif; 
            background-color: #f7f7f7; display: flex; justify-content: center; 
            align-items: center; min-height: 100vh; 
        }
        
        .mobile-container { 
            width: 100%; max-width: 420px; min-height: 100vh; background: #ffffff; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); display: flex; 
            flex-direction: column; padding: 20px; box-sizing: border-box;
        }

        /* --- STEPPER BOX UNIFIED COLOR --- */
        .stepper-box { 
            border: 1px solid #e0e0e0; border-radius: 12px; padding: 15px 10px; 
            background: #f9f9f9; margin-bottom: 20px; 
        }
        .stepper { display: flex; justify-content: space-between; position: relative; }
        .step { display: flex; flex-direction: column; align-items: center; flex: 1; position: relative; }
        
        /* Garis penghubung semua warna Ungu */
        .step:not(:last-child)::after { 
            content: ''; position: absolute; top: 15px; left: 50%; width: 100%; height: 2px; 
            background: #A55EA1; z-index: 1; 
        }

        /* Lingkaran semua warna Ungu Gradasi */
        .circle { 
            width: 30px; height: 30px; border-radius: 50%; 
            background: linear-gradient(135deg, #6A8BB0, #E05297); /* Samakan dengan step aktif sebelumnya */
            display: flex; align-items: center; justify-content: center; 
            font-size: 12px; font-weight: 600; color: white; margin-bottom: 5px; 
            position: relative; z-index: 2; 
        }
        
        .label { font-size: 8px; text-align: center; color: #E05297; font-weight: 600; line-height: 1.2; }

        /* Garis bawah biru pada Step 6 (Sesuai Desain) */
        .step.active .label { position: relative; }
        .step.active .label::after {
            content: ''; position: absolute; bottom: -4px; left: 10%; width: 80%; height: 3px;
            background: #007bff; border-radius: 2px;
        }

        /* CONTENT SECTION */
        .form-section {
            border: 1px solid #ccc; border-radius: 15px; padding: 30px 20px;
            flex-grow: 1; display: flex; flex-direction: column; align-items: center; text-align: center;
        }

        .success-icon {
            width: 100px; height: 100px; background-color: #fff; border: 4px solid #82e0aa;
            border-radius: 40px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;
        }
        .success-icon::before { content: '✓'; font-size: 50px; color: #82e0aa; font-weight: bold; }

        .main-title { font-size: 22px; font-weight: 700; color: #000; margin-bottom: 10px; }
        .sub-title { font-size: 13px; color: #999; margin-bottom: 25px; line-height: 1.5; }

        .id-box {
            width: 100%; border: 2px solid; border-image: linear-gradient(to right, #6A8BB0, #E05297) 1;
            padding: 15px; background: #fdfdfd; margin-bottom: 30px;
        }
        .id-label { font-size: 11px; color: #666; margin-bottom: 5px; font-weight: 600; }
        .id-number { font-size: 20px; font-weight: 700; color: #333; letter-spacing: 1px; }

        .info-section { width: 100%; text-align: left; }
        .info-title { font-size: 14px; font-weight: 700; color: #000; margin-bottom: 15px; }
        .info-list { list-style: none; padding: 0; margin: 0; }
        .info-item { display: flex; gap: 12px; font-size: 12px; color: #444; margin-bottom: 12px; align-items: flex-start; }
        .dot { width: 8px; height: 8px; background-color: #999; border-radius: 50%; margin-top: 5px; flex-shrink: 0; }

        .buttons { display: flex; gap: 10px; margin-top: auto; width: 100%; }
        .btn-home { flex: 1; background: #e0e0e0; color: #000; border: none; padding: 14px; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 12px; }
        .btn-status { flex: 1.2; background: linear-gradient(to right, #6A8BB0, #E05297); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 12px; }
    </style>
</head>
<body>

<div class="mobile-container">
    <div class="stepper-box">
        <div class="stepper">
            <div class="step"><div class="circle">1</div><div class="label">Jenis<br>Kunjungan</div></div>
            <div class="step"><div class="circle">2</div><div class="label">Data<br>Diri</div></div>
            <div class="step"><div class="circle">3</div><div class="label">Akses<br>Pintu</div></div>
            <div class="step"><div class="circle">4</div><div class="label">Unggah<br>Dokumen</div></div>
            <div class="step"><div class="circle">5</div><div class="label">Konfirmasi</div></div>
            <div class="step active"><div class="circle">6</div><div class="label">Status</div></div>
        </div>
    </div>

    <div class="form-section">
        <div class="success-icon"></div>
        <div class="main-title">Pengajuan Berhasil Dikirim!</div>
        <div class="sub-title">Pengajuan kunjungan anda telah berhasil dikirim dan sedang dalam proses verifikasi.</div>

        <div class="id-box">
            <div class="id-label">Nomor Pengajuan</div>
            <div class="id-number">{{ $nomor }}</div>
        </div>

        <div class="info-section">
            <div class="info-title">Informasi Penting :</div>
            <ul class="info-list">
                <li class="info-item"><div class="dot"></div><span>Notifikasi akan dikirim melalui Email/WhatsApp</span></li>
                <li class="info-item"><div class="dot"></div><span>Simpan nomor pengajuan untuk tracking status</span></li>
                <li class="info-item"><div class="dot"></div><span>Hubungi (0274) xxxxxx jika ada pertanyaan</span></li>
            </ul>
        </div>

        <div class="buttons">
<button type="button" class="btn-home" onclick="window.location.href='/'">
    Kembali ke Beranda
</button>

<button type="button" class="btn-status" onclick="window.location.href='/cek-status'">
    Cek Status Pengajuan
</button>
        </div>
    </div>
</div>

</body>
</html>