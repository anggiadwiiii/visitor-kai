<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visitor KAI</title>

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

.container {
    width: 100%;
    max-width: 100%; /* Full width on mobile */
    min-height: 100vh;
    background: #ffffff;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    padding: 20px 15px; /* Responsive padding */
    box-sizing: border-box;
    position: relative;
    justify-content: space-between;
}

@media (min-width: 641px) {
    .container {
        max-width: 420px;
        padding: 25px;
    }
}

.content-wrapper {
    flex: 1;
    padding: 0;
}

.logo {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 70px;
    height: auto;
    object-fit: contain;
}

.title-box {
    background: linear-gradient(to right, #2B09A4, #C40E75);
    color: white;
    text-align: center;
    padding: 14px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    margin-top: 30px;
    margin-bottom: 10px;
}

.subtitle {
    text-align: center;
    font-size: 12px;
    color: #555;
    margin-top: 5px;
    margin-bottom: 20px;
}

.card {
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 15px;
    text-align: center;
    background: white;
    border: 1px solid #e0e0e0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.12);
}

.icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(to right, #2B09A4, #C40E75);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    margin-bottom: 12px;
    transition: transform 0.3s ease;
}

.icon-wrapper:hover {
    transform: scale(1.08);
}

.icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon svg {
    width: 32px;
    height: 32px;
}

.card-title {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
    color: #333;
}

.card-desc {
    font-size: 11px;
    color: #888;
    margin: 8px 0 12px 0;
    line-height: 1.4;
}

.btn {
    background: linear-gradient(to right, #2B09A4, #C40E75);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 2px 6px rgba(224, 82, 151, 0.2);
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(224, 82, 151, 0.3);
}

.train {
    width: 100%;
    margin-top: auto;
    padding-bottom: 10px;
    border-radius: 50% 50% 0 0;
}

.footer {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #e0e0e0;
    text-align: center;
    font-size: 11px;
    color: #999;
}
</style>
</head>

<body>

<div class="container">

    <!-- LOGO -->
    <img src="{{ asset('images/logo.png') }}" class="logo">

    <div class="content-wrapper">
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
    </div>

    <div class="footer">
        <p>&copy; 2026 PT. Kereta Api Indonesia. All rights reserved.</p>
    </div>

</div>

</body>
</html>