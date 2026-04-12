<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 5 - Konfirmasi Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'Poppins', sans-serif; 
            background-color: #f7f7f7; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
        }
        
        .mobile-container { 
            width: 100%; 
            max-width: 420px; 
            min-height: 100vh; 
            background: #ffffff; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            display: flex; 
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
        }

        .stepper-box { 
            border: 1px solid #e0e0e0; 
            border-radius: 12px; 
            padding: 15px 10px; 
            background: #f9f9f9; 
            margin-bottom: 20px; 
        }
        .stepper { display: flex; justify-content: space-between; position: relative; }
        .step { display: flex; flex-direction: column; align-items: center; flex: 1; position: relative; }
        
        .step:not(:last-child)::after { 
            content: ''; position: absolute; top: 15px; left: 50%; width: 100%; height: 2px; background: #eee; z-index: 1; 
        }
        .step.completed:not(:last-child)::after { background: #A55EA1; }

        .circle { 
            width: 30px; height: 30px; border-radius: 50%; background: #eee; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 12px; font-weight: 600; color: #999; margin-bottom: 5px; 
            position: relative; z-index: 2; 
        }
        .step.active .circle { 
            background: linear-gradient(135deg, #6A8BB0, #E05297); color: white; 
        }
        .step.completed .circle { background: #A55EA1; color: white; }
        
        .label { font-size: 8px; text-align: center; color: #bbb; font-weight: 500; line-height: 1.2; }
        .step.active .label, .step.completed .label { color: #E05297; font-weight: 600; }

        .form-section {
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .title-header { display: flex; align-items: center; gap: 12px; margin-bottom: 15px; }
        .title-icon { color: #E05297; font-size: 24px; }
        .main-title { font-size: 20px; font-weight: 700; color: #2D2A70; }

        .section-group { margin-bottom: 15px; }
        .section-h { 
            font-size: 15px; 
            font-weight: 700; 
            color: #333; 
            border-bottom: 1px solid #ddd; 
            padding-bottom: 5px; 
            margin-bottom: 8px;
        }
        
        .data-row { font-size: 13px; margin-bottom: 4px; color: #444; line-height: 1.4; }
        .data-row b { color: #333; }
        .text-grey { color: #999; font-weight: 400; }
        .text-green { color: #28a745; font-weight: 600; }

        .agreement { 
            display: flex; 
            gap: 10px; 
            margin-top: 15px; 
            font-size: 11px; 
            color: #666; 
            align-items: flex-start;
            line-height: 1.4;
        }
        .agreement input { margin-top: 3px; }

        .buttons { display: flex; gap: 10px; margin-top: 25px; }
        .btn-back { 
            flex: 1; background: #e0e0e0; color: #333; border: none; 
            padding: 12px; border-radius: 10px; font-weight: 600; cursor: pointer;
        }
        .btn-next { 
            flex: 2; background: linear-gradient(to right, #6A8BB0, #E05297); 
            color: white; border: none; padding: 12px; border-radius: 10px; 
            font-weight: 600; cursor: pointer;
        }
        .btn-next:disabled { opacity: 0.6; cursor: not-allowed; }
    </style>
</head>
<body>

<div class="mobile-container">
    <div class="stepper-box">
        <div class="stepper">
            <div class="step completed"><div class="circle">1</div><div class="label">Jenis<br>Kunjungan</div></div>
            <div class="step completed"><div class="circle">2</div><div class="label">Data<br>Diri</div></div>
            <div class="step completed"><div class="circle">3</div><div class="label">Akses<br>Pintu</div></div>
            <div class="step completed"><div class="circle">4</div><div class="label">Unggah<br>Dokumen</div></div>
            <div class="step active"><div class="circle">5</div><div class="label">Konfirmasi</div></div>
            <div class="step"><div class="circle">6</div><div class="label">Status</div></div>
        </div>
    </div>

    <div class="form-section">
        <div class="title-header">
            <div class="title-icon">🚀</div>
            <div class="main-title">Konfirmasi Data</div>
        </div>

        <div class="section-group">
            <div class="section-h">Jenis Kunjungan</div>
            <div class="data-row"><b>Tipe Visitor :</b> <span class="text-grey">{{ $data['jenis_kunjungan'] ?? '' }}</span></div>
        </div>

        <div class="section-group">
            <div class="section-h">Data Pribadi</div>
            <div class="data-row"><b>Nama :</b> <span class="text-grey">{{ $data['nama'] ?? '' }}</span></div>
            <div class="data-row"><b>Instansi :</b> <span class="text-grey">{{ $data['instansi'] ?? '' }}</span></div>
            <div class="data-row"><b>Nomor Hp :</b> <span class="text-grey">{{ $data['no_hp'] ?? '' }}</span></div>
            <div class="data-row"><b>Email :</b> <span class="text-grey">{{ $data['email'] ?? '' }}</span></div>
            <div class="data-row"><b>Nama PIC :</b> <span class="text-grey">{{ $data['nama_pic'] ?? '' }}</span></div>
            <div class="data-row"><b>Jabatan PIC :</b> <span class="text-grey">{{ $data['jabatan_pic'] ?? '' }}</span></div>
        </div>

        <div class="section-group">
            <div class="section-h">Detail Kunjungan</div>
            <div class="data-row"><b>Tanggal Mulai :</b> <span class="text-grey">{{ $data['tanggal_kunjungan'] ?? '' }}</span></div>
            <div class="data-row"><b>Tanggal Selesai :</b> <span class="text-grey">{{ $data['tanggal_selesai'] ?? '' }}</span></div>
            <div class="data-row"><b>Stasiun Kunjungan :</b> <span class="text-grey">{{ $data['stasiun_kunjungan'] ?? '' }}</span></div>
            <div class="data-row"><b>Tujuan :</b> <span class="text-grey">{{ $data['accessPurpose'] ?? '' }}</span></div>
            <div class="data-row"><b>Layanan Pendampingan :</b> <span class="text-grey">{{ $data['layanan_pendampingan'] ?? '' }}</span></div>
        </div>

        <div class="section-group">
            <div class="section-h">Upload Surat Tugas</div>
            <div class="data-row"><b>Surat Tugas :</b> <span class="text-grey">{{ basename($data['document'] ?? '') }}</span></div>
        </div>

        <div class="section-group">
            <div class="section-h">Permohonan Akses Pintu</div>
            <div class="data-row"><b>Pintu Diajukan :</b> <span class="text-grey">{{ $data['accessDoor'] ?? '' }}</span></div>
            <div class="data-row"><b>Waktu Akses :</b> <span class="text-grey">{{ $data['accessTime'] ?? '' }}</span></div>
            <div class="data-row"><b>Kendaraan :</b> <span class="text-grey">{{ $data['vehicle'] ?? '' }}</span></div>
            <div class="data-row"><b>Nomor Polisi :</b> <span class="text-grey">{{ $data['plate'] ?? '' }}</span></div>
        </div>

        <div class="agreement">
            <input type="checkbox" id="checkAgree">
            <label for="checkAgree">Saya menyatakan data di atas benar dan bersedia mematuhi SOP</label>
        </div>

        <div class="buttons">
            <button type="button" class="btn-back" onclick="history.back()">Kembali</button>

            <form method="POST" action="/step5">
                @csrf
                @foreach($data as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" id="btnNext" class="btn-next" disabled>Lanjutkan</button>
            </form>
        </div>
    </div>
</div>

<script>
    const checkbox = document.getElementById('checkAgree');
    const btnNext = document.getElementById('btnNext');

    checkbox.addEventListener('change', function() {
        btnNext.disabled = !this.checked;
    });
</script>

</body>
</html>