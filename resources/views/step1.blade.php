<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1 - Jenis Kunjungan</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
       /* --- BASE LAYOUT --- */
body { margin: 0; padding: 0; font-family: 'Poppins', sans-serif; background-color: #f7f7f7; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
.mobile-container { width: 100%; max-width: 420px; min-height: 100vh; background: #ffffff; box-shadow: 0 10px 30px rgba(0,0,0,0.1); display: flex; flex-direction: column; padding: 25px; box-sizing: border-box; position: relative; }
.content { padding: 0; }

/* --- STEPPER --- */
.stepper-box { border: 1px solid #e0e0e0; border-radius: 12px; padding: 12px 8px; background: #fff; margin-bottom: 25px; }
.stepper { display: flex; justify-content: space-between; }
.step { display: flex; flex-direction: column; align-items: center; flex: 1; position: relative; }
.step:not(:last-child)::after { content: ''; position: absolute; top: 15px; left: 50%; width: 100%; height: 2px; background: #eee; z-index: 1; }
.circle { width: 30px; height: 30px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; color: #999; margin-bottom: 5px; position: relative; z-index: 2; }
.step.active .circle { background: linear-gradient(135deg, #6A8BB0, #E05297); color: white; }
.label { font-size: 8px; text-align: center; color: #bbb; font-weight: 500; }
.step.active .label { color: #8e44ad; font-weight: 600; }

/* --- HEADER TITLE & ICON (UPDATED) --- */
.title-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
.title-icon { 
    width: 42px; 
    height: 42px; 
    /* Menggunakan gradasi agar senada dengan tombol */
    background: linear-gradient(135deg, #6A8BB0, #E05297); 
    border-radius: 10px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    box-shadow: 0 4px 10px rgba(224, 82, 151, 0.2);
}
.header-svg { width: 26px; height: 26px; }
/* Memaksa warna ikon di header jadi putih */
.header-svg path { fill: #ffffff !important; }
.main-title { font-size: 18px; font-weight: 600; color: #2D2A70; }

/* --- CARDS --- */
.card-list { display: flex; flex-direction: column; gap: 15px; }
.card { background: white; border: 1px solid #e0e0e0; border-radius: 15px; padding: 15px; text-align: center; cursor: pointer; transition: all 0.3s ease; position: relative; overflow: hidden; }
.card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px; }

/* Tema Warna Card */
.card.blue::before { background: #6A8BB0; }
.card.purple::before { background: #8e44ad; }
.card.yellow::before { background: #f1c40f; }
.card.green::before { background: #2ecc71; }
.card.red::before { background: #e74c3c; }

/* --- SVG ICON IN CARDS --- */
.card-icon-svg { width: 45px; height: 45px; margin-bottom: 8px; display: inline-block; }

/* Mewarnai garis SVG (stroke) sesuai tema kartu */
.card.blue .card-icon-svg path[stroke="#fff"] { stroke: #6A8BB0; }
.card.purple .card-icon-svg path[stroke="#fff"] { stroke: #8e44ad; }
.card.yellow .card-icon-svg path[stroke="#fff"] { stroke: #f1c40f; }
.card.green .card-icon-svg path[stroke="#fff"] { stroke: #2ecc71; }
.card.red .card-icon-svg path[stroke="#fff"] { stroke: #e74c3c; }

/* Mewarnai isi SVG (fill) sesuai tema kartu */
.card.blue .card-icon-svg path[fill="#fff"] { fill: #6A8BB0; }
.card.purple .card-icon-svg path[fill="#fff"] { fill: #8e44ad; }
.card.yellow .card-icon-svg path[fill="#fff"] { fill: #f1c40f; }
.card.green .card-icon-svg path[fill="#fff"] { fill: #2ecc71; }
.card.red .card-icon-svg path[fill="#fff"] { fill: #e74c3c; }

.card-name { font-weight: 600; font-size: 14px; margin-bottom: 4px; color: #333; }
.card-info { font-size: 11px; color: #888; }
.card.selected { border: 2px solid #E05297; background: #fff9fc; }

/* --- FOOTER & BUTTON --- */
.footer-action { position: fixed; bottom: 0; max-width: 420px; width: 100%; padding: 15px 20px; background: white; box-sizing: border-box; display: flex; justify-content: flex-end; border-top: 1px solid #eee; z-index: 10; left: 50%; transform: translateX(-50%); }
.btn-lanjut { background: linear-gradient(to right, #6A8BB0, #E05297); color: white; padding: 12px 35px; border-radius: 12px; border: none; font-weight: 600; font-size: 14px; cursor: pointer; box-shadow: 0 4px 12px rgba(224, 82, 151, 0.2); }
.btn-lanjut:disabled { background: #ccc; box-shadow: none; cursor: not-allowed; }
    </style>
</head>
<body>

<div class="mobile-container">
    <div class="content">
        <div class="stepper-box">
            <div class="stepper">
                <div class="step active"><div class="circle">1</div><div class="label">Jenis<br>Kunjungan</div></div>
                <div class="step"><div class="circle">2</div><div class="label">Data<br>Diri</div></div>
                <div class="step"><div class="circle">3</div><div class="label">Akses<br>Pintu</div></div>
                <div class="step"><div class="circle">4</div><div class="label">Unggah<br>Dokumen</div></div>
                <div class="step"><div class="circle">5</div><div class="label">Konfirmasi</div></div>
                <div class="step"><div class="circle">6</div><div class="label">Status</div></div>
            </div>
        </div>

        <div class="title-header">
            <div class="title-icon">
                <svg class="header-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="#ffffff" d="M14 13h5v-2h-5zm0-3h5V8h-5zm-9 6h8v-.55q0-1.125-1.1-1.787T9 13t-2.9.663T5 15.45zm5.413-4.587Q11 10.825 11 10t-.587-1.412T9 8t-1.412.588T7 10t.588 1.413T9 12t1.413-.587M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm0-2h16V6H4zm0 0V6z"/>
                </svg>
            </div>
            <div class="main-title">Pilih Jenis Kunjungan:</div>
        </div>

        <div class="card-list">
            <div class="card blue" onclick="select(this, 'Regular')">
                <svg class="card-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none"><path fill="#fff" d="M15 15H9a4 4 0 0 0-3.834 2.856A8.98 8.98 0 0 0 12 21a8.98 8.98 0 0 0 6.834-3.144A4 4 0 0 0 15 15" opacity="0.16"/><path stroke="#fff" stroke-width="2" d="M21 12a8.96 8.96 0 0 1-1.526 5.016A8.99 8.99 0 0 1 12 21a8.99 8.99 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="#fff" d="M13 9a1 1 0 0 1-1 1v2a3 3 0 0 0 3-3zm-1 1a1 1 0 0 1-1-1H9a3 3 0 0 0 3 3zm-1-1a1 1 0 0 1 1-1V6a3 3 0 0 0-3 3zm1-1a1 1 0 0 1 1 1h2a3 3 0 0 0-3-3zm-6.834 9.856l-.959-.285l-.155.523l.355.413zm13.668 0l.76.651l.354-.413l-.155-.523zM9 16h6v-2H9zm0-2a5 5 0 0 0-4.793 3.571l1.917.57A3 3 0 0 1 9 16zm3 6a7.98 7.98 0 0 1-6.075-2.795l-1.518 1.302A9.98 9.98 0 0 0 12 22zm3-4c1.357 0 2.506.902 2.876 2.142l1.916-.571A5 5 0 0 0 15 14zm3.075 1.205A7.98 7.98 0 0 1 12 20v2a9.98 9.98 0 0 0 7.593-3.493z"/></g></svg>
                <div class="card-name">Visitor Reguler</div>
                <div class="card-info">Kunjungan untuk tamu umum harian</div>
            </div>

            <div class="card purple" onclick="select(this, 'VIP')">
                <svg class="card-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none"><path fill="#fff" d="M15 15H9a4 4 0 0 0-3.834 2.856A8.98 8.98 0 0 0 12 21a8.98 8.98 0 0 0 6.834-3.144A4 4 0 0 0 15 15" opacity="0.16"/><path stroke="#fff" stroke-width="2" d="M21 12a8.96 8.96 0 0 1-1.526 5.016A8.99 8.99 0 0 1 12 21a8.99 8.99 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="#fff" d="M13 9a1 1 0 0 1-1 1v2a3 3 0 0 0 3-3zm-1 1a1 1 0 0 1-1-1H9a3 3 0 0 0 3 3zm-1-1a1 1 0 0 1 1-1V6a3 3 0 0 0-3 3zm1-1a1 1 0 0 1 1 1h2a3 3 0 0 0-3-3zm-6.834 9.856l-.959-.285l-.155.523l.355.413zm13.668 0l.76.651l.354-.413l-.155-.523zM9 16h6v-2H9zm0-2a5 5 0 0 0-4.793 3.571l1.917.57A3 3 0 0 1 9 16zm3 6a7.98 7.98 0 0 1-6.075-2.795l-1.518 1.302A9.98 9.98 0 0 0 12 22zm3-4c1.357 0 2.506.902 2.876 2.142l1.916-.571A5 5 0 0 0 15 14zm3.075 1.205A7.98 7.98 0 0 1 12 20v2a9.98 9.98 0 0 0 7.593-3.493z"/></g></svg>
                <div class="card-name">Visitor VIP</div>
                <div class="card-info">Kunjungan untuk Pejabat, Tokoh, dan Mitra</div>
            </div>

            <div class="card yellow" onclick="select(this, 'Vendor')">
                <svg class="card-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none"><path fill="#fff" d="M15 15H9a4 4 0 0 0-3.834 2.856A8.98 8.98 0 0 0 12 21a8.98 8.98 0 0 0 6.834-3.144A4 4 0 0 0 15 15" opacity="0.16"/><path stroke="#fff" stroke-width="2" d="M21 12a8.96 8.96 0 0 1-1.526 5.016A8.99 8.99 0 0 1 12 21a8.99 8.99 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="#fff" d="M13 9a1 1 0 0 1-1 1v2a3 3 0 0 0 3-3zm-1 1a1 1 0 0 1-1-1H9a3 3 0 0 0 3 3zm-1-1a1 1 0 0 1 1-1V6a3 3 0 0 0-3 3zm1-1a1 1 0 0 1 1 1h2a3 3 0 0 0-3-3zm-6.834 9.856l-.959-.285l-.155.523l.355.413zm13.668 0l.76.651l.354-.413l-.155-.523zM9 16h6v-2H9zm0-2a5 5 0 0 0-4.793 3.571l1.917.57A3 3 0 0 1 9 16zm3 6a7.98 7.98 0 0 1-6.075-2.795l-1.518 1.302A9.98 9.98 0 0 0 12 22zm3-4c1.357 0 2.506.902 2.876 2.142l1.916-.571A5 5 0 0 0 15 14zm3.075 1.205A7.98 7.98 0 0 1 12 20v2a9.98 9.98 0 0 0 7.593-3.493z"/></g></svg>
                <div class="card-name">Visitor Vendor</div>
                <div class="card-info">Kunjungan untuk Teknisi, Vendor, dan Cleaning</div>
            </div>

            <div class="card green" onclick="select(this, 'Pelajar')">
                <svg class="card-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none"><path fill="#fff" d="M15 15H9a4 4 0 0 0-3.834 2.856A8.98 8.98 0 0 0 12 21a8.98 8.98 0 0 0 6.834-3.144A4 4 0 0 0 15 15" opacity="0.16"/><path stroke="#fff" stroke-width="2" d="M21 12a8.96 8.96 0 0 1-1.526 5.016A8.99 8.99 0 0 1 12 21a8.99 8.99 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="#fff" d="M13 9a1 1 0 0 1-1 1v2a3 3 0 0 0 3-3zm-1 1a1 1 0 0 1-1-1H9a3 3 0 0 0 3 3zm-1-1a1 1 0 0 1 1-1V6a3 3 0 0 0-3 3zm1-1a1 1 0 0 1 1 1h2a3 3 0 0 0-3-3zm-6.834 9.856l-.959-.285l-.155.523l.355.413zm13.668 0l.76.651l.354-.413l-.155-.523zM9 16h6v-2H9zm0-2a5 5 0 0 0-4.793 3.571l1.917.57A3 3 0 0 1 9 16zm3 6a7.98 7.98 0 0 1-6.075-2.795l-1.518 1.302A9.98 9.98 0 0 0 12 22zm3-4c1.357 0 2.506.902 2.876 2.142l1.916-.571A5 5 0 0 0 15 14zm3.075 1.205A7.98 7.98 0 0 1 12 20v2a9.98 9.98 0 0 0 7.593-3.493z"/></g></svg>
                <div class="card-name">Visitor Pelajar</div>
                <div class="card-info">Kunjungan untuk Pelajar/Magang/Studi</div>
            </div>

            <div class="card red" onclick="select(this, 'Darurat')">
                <svg class="card-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none"><path fill="#fff" d="M15 15H9a4 4 0 0 0-3.834 2.856A8.98 8.98 0 0 0 12 21a8.98 8.98 0 0 0 6.834-3.144A4 4 0 0 0 15 15" opacity="0.16"/><path stroke="#fff" stroke-width="2" d="M21 12a8.96 8.96 0 0 1-1.526 5.016A8.99 8.99 0 0 1 12 21a8.99 8.99 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="#fff" d="M13 9a1 1 0 0 1-1 1v2a3 3 0 0 0 3-3zm-1 1a1 1 0 0 1-1-1H9a3 3 0 0 0 3 3zm-1-1a1 1 0 0 1 1-1V6a3 3 0 0 0-3 3zm1-1a1 1 0 0 1 1 1h2a3 3 0 0 0-3-3zm-6.834 9.856l-.959-.285l-.155.523l.355.413zm13.668 0l.76.651l.354-.413l-.155-.523zM9 16h6v-2H9zm0-2a5 5 0 0 0-4.793 3.571l1.917.57A3 3 0 0 1 9 16zm3 6a7.98 7.98 0 0 1-6.075-2.795l-1.518 1.302A9.98 9.98 0 0 0 12 22zm3-4c1.357 0 2.506.902 2.876 2.142l1.916-.571A5 5 0 0 0 15 14zm3.075 1.205A7.98 7.98 0 0 1 12 20v2a9.98 9.98 0 0 0 7.593-3.493z"/></g></svg>
                <div class="card-name">Visitor Darurat</div>
                <div class="card-info">Keperluan Pengawas K3, Audit, dan Tim Teknis</div>
            </div>
        </div>
    </div>
    <div class="footer-action">
        <button id="btnNext" class="btn-lanjut" disabled onclick="goNext()">Lanjutkan</button>
    </div>
</div>

<script>
    let selectedJenis = "";
    function select(el, val) {
        document.querySelectorAll('.card').forEach(c => c.classList.remove('selected'));
        el.classList.add('selected');
        selectedJenis = val;
        document.getElementById('btnNext').disabled = false;
    }
    function goNext() {
        if(!selectedJenis) return;
        window.location.href = "/step2?jenis=" + selectedJenis;
    }
</script>

</body>
</html>