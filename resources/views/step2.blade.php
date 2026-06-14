<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 2 - Data Diri</title>
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

        /* STEPPER BOX */
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
            width: 28px; height: 28px; border-radius: 50%; background: #eee; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 11px; font-weight: 600; color: #999; margin-bottom: 5px; 
            position: relative; z-index: 2; 
        }
        .step.active .circle { 
            background: linear-gradient(135deg, #6A8BB0, #E05297); color: white; 
        }
        .step.completed .circle { background: #A55EA1; color: white; }
        
        .label { font-size: 8px; text-align: center; color: #bbb; font-weight: 500; line-height: 1.2; }
        .step.active .label, .step.completed .label { color: #E05297; font-weight: 600; }

        /* FORM SECTION DENGAN CARD BORDER */
        .form-section {
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .title-header { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
        .title-icon { color: #E05297; font-size: 20px; }
        .main-title { font-size: 16px; font-weight: 700; color: #2D2A70; }

        /* FORM GROUP */
        .form-group { margin-bottom: 12px; }
        label { display: block; font-size: 11px; font-weight: 600; margin-bottom: 5px; color: #333; }
        
        input, select { 
            width: 100%; padding: 10px 12px; border-radius: 8px; 
            border: 1px solid #ccc; background: #fcfcfc;
            box-sizing: border-box; font-family: inherit; font-size: 12px;
        }

        input.is-invalid, select.is-invalid {
            border-color: #dc3545 !important;
            background-color: #fff5f5;
        }

        .error-message {
            color: #dc3545;
            font-size: 11px;
            margin-top: 4px;
            font-weight: 500;
            display: block;
        }

        /* BUTTONS */
        .buttons { display: flex; gap: 10px; margin-top: 10px; }
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
            <div class="step active"><div class="circle">2</div><div class="label">Data<br>Diri</div></div>
            <div class="step"><div class="circle">3</div><div class="label">Akses<br>Pintu</div></div>
            <div class="step"><div class="circle">4</div><div class="label">Unggah<br>Dokumen</div></div>
            <div class="step"><div class="circle">5</div><div class="label">Konfirmasi</div></div>
            <div class="step"><div class="circle">6</div><div class="label">Status</div></div>
        </div>
    </div>

    <div class="form-section">
        <div class="title-header">
            <div class="main-title">Data Diri Kunjungan:</div>
        </div>

        <form method="POST" action="/step2">
            @csrf
            @foreach($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input type="hidden" name="jenis_kunjungan" value="{{ $data['jenis'] ?? '' }}">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $data['nama'] ?? '' }}" placeholder="Masukkan nama lengkap" class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @if($errors->has('nama'))
                    <span class="error-message">{{ $errors->first('nama') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Instansi / Perusahaan</label>
                <input type="text" name="instansi" value="{{ $data['instansi'] ?? '' }}" placeholder="Masukkan instansi" class="{{ $errors->has('instansi') ? 'is-invalid' : '' }}">
                @if($errors->has('instansi'))
                    <span class="error-message">{{ $errors->first('instansi') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Nama PIC</label>
                <input type="text" name="nama_pic" value="{{ $data['nama_pic'] ?? '' }}" placeholder="Masukkan nama PIC" class="{{ $errors->has('nama_pic') ? 'is-invalid' : '' }}">
                @if($errors->has('nama_pic'))
                    <span class="error-message">{{ $errors->first('nama_pic') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Jabatan PIC</label>
                <input type="text" name="jabatan_pic" value="{{ $data['jabatan_pic'] ?? '' }}" placeholder="Masukkan jabatan PIC" class="{{ $errors->has('jabatan_pic') ? 'is-invalid' : '' }}">
                @if($errors->has('jabatan_pic'))
                    <span class="error-message">{{ $errors->first('jabatan_pic') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Nomor Handphone</label>
                <input type="tel" name="no_hp" value="{{ $data['no_hp'] ?? '' }}" placeholder="0812xxxx" class="{{ $errors->has('no_hp') ? 'is-invalid' : '' }}">
                @if($errors->has('no_hp'))
                    <span class="error-message">{{ $errors->first('no_hp') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $data['email'] ?? '' }}" placeholder="email@example.com" class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                @if($errors->has('email'))
                    <span class="error-message">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Tanggal Kunjungan</label>
                <input type="date" name="tanggal_kunjungan" value="{{ $data['tanggal_kunjungan'] ?? '' }}" class="{{ $errors->has('tanggal_kunjungan') ? 'is-invalid' : '' }}">
                @if($errors->has('tanggal_kunjungan'))
                    <span class="error-message">{{ $errors->first('tanggal_kunjungan') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ $data['tanggal_selesai'] ?? '' }}">
            </div>

            <div class="form-group">
                <label>Stasiun Kunjungan</label>
                <select name="stasiun_kunjungan" class="{{ $errors->has('stasiun_kunjungan') ? 'is-invalid' : '' }}">
                    <option value="">Pilih Stasiun</option>
                    <option value="Stasiun Lempuyangan" {{ (isset($data['stasiun_kunjungan']) && $data['stasiun_kunjungan'] == 'Stasiun Lempuyangan') ? 'selected' : '' }}>Stasiun Lempuyangan</option>
                    <option value="Stasiun Yogyakarta" {{ (isset($data['stasiun_kunjungan']) && $data['stasiun_kunjungan'] == 'Stasiun Yogyakarta') ? 'selected' : '' }}>Stasiun Yogyakarta</option>
                    <option value="Stasiun Solo Balapan" {{ (isset($data['stasiun_kunjungan']) && $data['stasiun_kunjungan'] == 'Stasiun Solo Balapan') ? 'selected' : '' }}>Stasiun Solo Balapan</option>
                    <option value="Stasiun Purwosari" {{ (isset($data['stasiun_kunjungan']) && $data['stasiun_kunjungan'] == 'Stasiun Purwosari') ? 'selected' : '' }}>Stasiun Purwosari</option>
                    <option value="Stasiun Klaten" {{ (isset($data['stasiun_kunjungan']) && $data['stasiun_kunjungan'] == 'Stasiun Klaten') ? 'selected' : '' }}>Stasiun Klaten</option>
                </select>
                @if($errors->has('stasiun_kunjungan'))
                    <span class="error-message">{{ $errors->first('stasiun_kunjungan') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Layanan Pendampingan</label>
                <select name="layanan_pendampingan" class="{{ $errors->has('layanan_pendampingan') ? 'is-invalid' : '' }}">
                    <option value="">Pilih Layanan</option>
                    <option value="Pilih Layanan" {{ (isset($data['layanan_pendampingan']) && $data['layanan_pendampingan'] == 'Pilih Layanan') ? 'selected' : '' }}>Pilih Layanan</option>
                    <option value="Layanan Pendampingan Umum" {{ (isset($data['layanan_pendampingan']) && $data['layanan_pendampingan'] == 'Layanan Pendampingan Umum') ? 'selected' : '' }}>Layanan Pendampingan Umum</option>
                    <option value="Layanan Pendampingan VIP" {{ (isset($data['layanan_pendampingan']) && $data['layanan_pendampingan'] == 'Layanan Pendampingan VIP') ? 'selected' : '' }}>Layanan Pendampingan VIP</option>
                    <option value="Tanpa Pendampingan" {{ (isset($data['layanan_pendampingan']) && $data['layanan_pendampingan'] == 'Tanpa Pendampingan') ? 'selected' : '' }}>Tanpa Pendampingan</option>
                </select>
                @if($errors->has('layanan_pendampingan'))
                    <span class="error-message">{{ $errors->first('layanan_pendampingan') }}</span>
                @endif
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