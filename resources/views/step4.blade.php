<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 4 - Upload Dokumen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            margin: 0; padding: 0; font-family: 'Poppins', sans-serif; 
            background-color: #f7f7f7; display: flex; justify-content: center; 
            align-items: center; min-height: 100vh; 
        }
        .mobile-container { 
            width: 100%; max-width: 420px; min-height: 100vh; background: #ffffff; 
            display: flex; flex-direction: column; padding: 25px; box-sizing: border-box;
        }

        /* STEPPER BOX */
        .stepper-box { 
            border: 1px solid #e0e0e0; border-radius: 12px; padding: 15px 10px; 
            background: #f9f9f9; margin-bottom: 25px; 
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
            font-size: 12px; font-weight: 600; color: #999; margin-bottom: 5px; z-index: 2; 
        }
        .step.active .circle { background: linear-gradient(135deg, #6A8BB0, #E05297); color: white; }
        .step.completed .circle { background: #A55EA1; color: white; }
        .label { font-size: 8px; text-align: center; color: #bbb; font-weight: 500; }
        .step.active .label, .step.completed .label { color: #E05297; font-weight: 600; }

        /* FORM CARD */
        .form-section {
            border: 1px solid #ccc; border-radius: 15px; padding: 20px;
            flex-grow: 1; display: flex; flex-direction: column; text-align: center;
        }
        .title-header { display: flex; align-items: center; gap: 12px; margin-bottom: 25px; text-align: left; }
        .main-title { font-size: 18px; font-weight: 700; color: #2D2A70; }

        /* UPLOAD AREA */
        .upload-card {
            border: 1px solid #eee; border-radius: 12px; padding: 40px 20px;
            background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 20px;
        }
        .upload-icon { width: 50px; opacity: 0.5; margin-bottom: 15px; }
        .upload-text { font-size: 14px; font-weight: 700; color: #333; margin-bottom: 5px; }
        .upload-subtext { font-size: 11px; color: #999; margin-bottom: 20px; }
        
        /* Tombol Pilih File */
        .btn-select {
            background: #e0e0e0; border: none; padding: 10px 20px;
            border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 12px;
        }

        /* Nama file yang terpilih */
        #fileNameDisplay {
            margin-top: 10px; font-size: 12px; color: #E05297; font-weight: 600;
        }

        /* NAVIGATION BUTTONS */
        .buttons { display: flex; gap: 10px; margin-top: auto; }
        .btn-back { flex: 1; background: #e0e0e0; border: none; padding: 12px; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .btn-next { 
            flex: 2; background: linear-gradient(to right, #6A8BB0, #E05297); 
            color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600; cursor: pointer; 
        }
    </style>
</head>
<body>

<div class="mobile-container">
    <div class="stepper-box">
        <div class="stepper">
            <div class="step completed"><div class="circle">1</div><div class="label">Jenis</div></div>
            <div class="step completed"><div class="circle">2</div><div class="label">Data</div></div>
            <div class="step completed"><div class="circle">3</div><div class="label">Akses</div></div>
            <div class="step active"><div class="circle">4</div><div class="label">Dokumen</div></div>
            <div class="step"><div class="circle">5</div><div class="label">Konfirmasi</div></div>
            <div class="step"><div class="circle">6</div><div class="label">Status</div></div>
        </div>
    </div>

    <div class="form-section">
        <div class="title-header">
            <span style="font-size: 24px;">📄</span>
            <div class="main-title">Upload Dokumen</div>
        </div>

        <form id="step4Form" method="POST" action="/step4" enctype="multipart/form-data">
            @csrf
            @foreach($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <div class="upload-card">
                <img src="https://cdn-icons-png.flaticon.com/512/109/109612.png" class="upload-icon">
                <div class="upload-text">Klik untuk upload surat tugas</div>
                <div class="upload-subtext">PDF, JPG, PNG (Max. 10MB)</div>
                
                <input type="file" id="realInput" name="document" hidden accept=".pdf,.jpg,.jpeg,.png">
                
                <button type="button" class="btn-select" id="fakeBtn">Pilih File</button>
                
                <div id="fileNameDisplay"></div>
            </div>

            <div class="buttons">
                <button type="button" class="btn-back" onclick="history.back()">Kembali</button>
                <button type="submit" class="btn-next">Lanjutkan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const realInput = document.getElementById('realInput');
    const fakeBtn = document.getElementById('fakeBtn');
    const fileNameDisplay = document.getElementById('fileNameDisplay');

    // Klik tombol palsu akan memicu input file asli
    fakeBtn.addEventListener('click', () => realInput.click());

    // Deteksi saat file dipilih
    realInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            fileNameDisplay.innerText = "File: " + this.files[0].name;
        } else {
            fileNameDisplay.innerText = "";
        }
    });
</script>

</body>
</html>