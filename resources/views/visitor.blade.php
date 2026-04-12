<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visitor KAI</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #f5f5f5;
}

.container {
    max-width: 420px;
    margin: auto;
    padding: 20px;
    position: relative;
}

.logo {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 80px;
}

.title-box {
    background: linear-gradient(to right, #2B09A4, #C40E75);
    color: white;
    text-align: center;
    padding: 12px;
    border-radius: 25px;
    font-weight: 600;
    margin-top: 50px;
    opacity: 0.7;
}

.subtitle {
    text-align: center;
    font-size: 13px;
    color: #555;
    margin-top: 8px;
}

.card {
    border-radius: 15px;
    padding: 20px;
    margin-top: 20px;
    text-align: center;
    background: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.icon-wrapper {
    width: 76px;
    height: 76px;
    border-radius: 50%;
    background: linear-gradient(to right, #2B09A4, #C40E75);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    margin-bottom: 10px;
}

.icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon svg {
    width: 35px;
    height: 35px;
}

.card-title {
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 5px;
}

.card-desc {
    font-size: 12px;
    color: #666;
    margin: 10px 0;
}

.btn {
    background: linear-gradient(to right, #2B09A4, #C40E75);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 10px;
    font-size: 12px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    opacity: 0.7;
}

.train {
    width: 100%;
    margin-top: 30px;
    border-radius: 50% 50% 0 0;
}

/* Hover untuk card */
.card:hover {
    transform: translateY(-5px); /* card naik sedikit */
    box-shadow: 0 8px 20px rgba(0,0,0,0.2); /* shadow lebih besar */
    transition: all 0.3s ease;
}

/* Hover untuk icon wrapper */
.icon-wrapper:hover {
    transform: scale(1.1); /* membesar 10% */
    transition: transform 0.3s ease;
}

/* Hover untuk button */
.btn:hover {
    filter: brightness(1.1); /* sedikit lebih terang */
    transform: scale(1.05); /* membesar sedikit */
    transition: all 0.3s ease;
}
</style>
</head>

<body>

<div class="container">

    <!-- LOGO -->
    <img src="{{ asset('images/logo.png') }}" class="logo">

    <!-- HEADER -->
    <div class="title-box">
        Pengajuan Kartu Visitor
    </div>

    <div class="subtitle">
        Pilih layanan yang anda butuhkan
    </div>

    <!-- CARD 1: Ajukan Permohonan -->
    <div class="card">
        <div class="icon-wrapper">
            <div class="icon">
                <!-- SVG gradien -->
                <svg viewBox="0 0 24 24">
                    <defs>
                        <linearGradient id="gradEdit" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#2B09A4"/>
                            <stop offset="100%" stop-color="#C40E75"/>
                        </linearGradient>
                    </defs>
                    <path fill="url(#gradEdit)" d="M5 21h14c1.1 0 2-.9 2-2v-7h-2v7H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"/>
                    <path fill="url(#gradEdit)" d="M7 13v3c0 .55.45 1 1 1h3c.27 0 .52-.11.71-.29l9-9a.996.996 0 0 0 0-1.41l-3-3a.996.996 0 0 0-1.41 0l-9.01 8.99A1 1 0 0 0 7 13m10-7.59L18.59 7L17.5 8.09L15.91 6.5zm-8 8l5.5-5.5l1.59 1.59l-5.5 5.5H9z"/>
                </svg>
            </div>
        </div>
        <div class="card-title">Ajukan Permohonan</div>
        <div class="card-desc">
            Daftarkan kartu visitor untuk mengakses area stasiun dengan mengisi proses yang mudah.
        </div>
        <a href="/step1" class="btn">
            DAFTAR SEKARANG
        </a>
    </div>

    <!-- CARD 2: Cek Status -->
    <div class="card">
        <div class="icon-wrapper">
            <div class="icon">
                <!-- SVG gradien check -->
                <svg viewBox="0 0 24 24">
                    <defs>
                        <linearGradient id="gradCheck" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#2B09A4"/>
                            <stop offset="100%" stop-color="#C40E75"/>
                        </linearGradient>
                    </defs>
                    <g fill="none" stroke="url(#gradCheck)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                        <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2"/>
                        <path d="m9 15 2 2 4-4"/>
                    </g>
                </svg>
            </div>
        </div>
        <div class="card-title">Cek Status</div>
        <div class="card-desc">
            Cek status permohonan dan terima kartu visitor yang telah disetujui oleh petugas stasiun.
        </div>
        <a href="/cek-status" class="btn">
            CEK STATUS
        </a>
    </div>

    <!-- TRAIN -->
    <img src="{{ asset('images/kereta.png') }}" class="train">

</div>

</body>
</html>