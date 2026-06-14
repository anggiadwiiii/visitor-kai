<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 3 - Akses Pintu</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
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
            padding: 25px;
            box-sizing: border-box;
        }

        /* STEPPER BOX SESUAI GAMBAR */
        .stepper-box { 
            border: 1px solid #e0e0e0; 
            border-radius: 12px; 
            padding: 15px 10px; 
            background: #f9f9f9; 
            margin-bottom: 25px; 
        }
        .stepper { display: flex; justify-content: space-between; position: relative; }
        .step { display: flex; flex-direction: column; align-items: center; flex: 1; position: relative; }
        
        /* Garis penghubung */
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

        /* FORM CONTAINER */
        .form-section {
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .title-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .title-icon { color: #E05297; font-size: 22px; }
        .main-title { font-size: 18px; font-weight: 700; color: #2D2A70; }

        /* INPUT STYLING */
        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 12px; font-weight: 600; margin-bottom: 6px; color: #333; }
        
        input, select { 
            width: 100%; padding: 12px 15px; border-radius: 10px; 
            border: 1px solid #ccc; background: #fcfcfc;
            box-sizing: border-box; font-family: inherit; font-size: 13px;
        }

        /* BUTTONS */
        .buttons { display: flex; gap: 10px; margin-top: auto; padding-top: 20px; }
        .btn-back { 
            flex: 1; background: #e0e0e0; color: #333; border: none; 
            padding: 12px; border-radius: 10px; font-weight: 600; cursor: pointer;
        }
        .btn-next { 
            flex: 2; background: linear-gradient(to right, #6A8BB0, #E05297); 
            color: white; border: none; padding: 12px; border-radius: 10px; 
            font-weight: 600; cursor: pointer;
        }
    </style>
</head>
<body>

<div class="mobile-container">
    <div class="stepper-box">
        <div class="stepper">
            <div class="step completed"><div class="circle">1</div><div class="label">Jenis<br>Kunjungan</div></div>
            <div class="step completed"><div class="circle">2</div><div class="label">Data<br>Diri</div></div>
            <div class="step active"><div class="circle">3</div><div class="label">Akses<br>Pintu</div></div>
            <div class="step"><div class="circle">4</div><div class="label">Unggah<br>Dokumen</div></div>
            <div class="step"><div class="circle">5</div><div class="label">Konfirmasi</div></div>
            <div class="step"><div class="circle">6</div><div class="label">Status</div></div>
        </div>
    </div>

    <div class="form-section">
        <div class="title-header">
            <div class="main-title">Permohonan Akses Pintu:</div>
        </div>

        <form method="POST" action="/step3">
            @csrf
            @foreach($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <div class="form-group">
                <label>Pilih Pintu yang Diajukan</label>
                <select name="accessDoor">
                    <option value="">Pilih Pintu</option>
                    <option value="Pintu Utama" {{ (isset($data['accessDoor']) && $data['accessDoor'] == 'Pintu Utama') ? 'selected' : '' }}>Pintu Utama</option>
                    <option value="Barat" {{ (isset($data['accessDoor']) && $data['accessDoor'] == 'Barat') ? 'selected' : '' }}>Barat</option>
                    <option value="Timur" {{ (isset($data['accessDoor']) && $data['accessDoor'] == 'Timur') ? 'selected' : '' }}>Timur</option>
                    <option value="Utara" {{ (isset($data['accessDoor']) && $data['accessDoor'] == 'Utara') ? 'selected' : '' }}>Utara</option>
                    <option value="Selatan" {{ (isset($data['accessDoor']) && $data['accessDoor'] == 'Selatan') ? 'selected' : '' }}>Selatan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Waktu Akses</label>
                <input type="time" name="accessTime" value="{{ $data['accessTime'] ?? '' }}">
            </div>

            <div class="form-group">
                <label>Tujuan Akses</label>
                <input type="text" name="accessPurpose" value="{{ $data['accessPurpose'] ?? '' }}" placeholder="Masukkan tujuan">
            </div>

            <div class="form-group">
                <label>Jumlah & Jenis Kendaraan</label>
                <input type="text" name="vehicle" value="{{ $data['vehicle'] ?? '' }}" placeholder="Contoh: 1 Mobil">
            </div>

            <div class="form-group">
                <label>Nomor Polisi Kendaraan</label>
                <input type="text" name="plate" value="{{ $data['plate'] ?? '' }}" placeholder="B 1234 ABC">
            </div>

            <div class="buttons">
                <button type="button" class="btn-back" onclick="history.back()">Kembali</button>
                <button type="submit" class="btn-next">Lanjutkan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>