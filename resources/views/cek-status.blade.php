<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pengajuan</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #8E7AB5 0%, #D471AF 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container utama (Box Putih) */
        .container {
            width: 100%;
            max-width: 100%; /* Full width on mobile */
            min-height: 100vh;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            padding: 0;
            box-sizing: border-box;
            position: relative;
        }

        @media (min-width: 641px) {
            .container {
                max-width: 420px;
            }
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .card {
            background: white;
            padding: 30px 20px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e0e0e0;
            max-width: 90%;
        }

        /* Logo KAI */
        .logo {
            width: 140px;
            height: auto;
            margin: 0 auto 25px;
            display: block;
            object-fit: contain;
        }

        /* Judul */
        .title {
            font-size: 16px;
            font-weight: 600;
            color: #2D2A70;
            margin-bottom: 20px;
        }

        /* Input Field dengan Border Gradient Tipis */
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            font-family: inherit;
            font-size: 12px;
            outline: none;
            text-align: center;
        }

        input::placeholder {
            color: #bbb;
        }

        input:focus {
            border-color: #D471AF;
            box-shadow: 0 0 0 3px rgba(212, 113, 175, 0.1);
        }

        /* Button Submit dengan Gradient */
        .btn-submit {
            width: 100%;
            padding: 11px 20px;
            border-radius: 8px;
            border: none;
            color: white;
            font-weight: 600;
            font-size: 12px;
            background: linear-gradient(to right, #2B09A4, #C40E75);
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(224, 82, 151, 0.2);
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(224, 82, 151, 0.3);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            padding: 9px 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            color: #333;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #f7f7f7;
            border-color: #d0d0d0;
        }

        .btn-back iconify-icon {
            width: 18px;
            height: 18px;
        }
        .error-msg {
            color: #e74c3c;
            font-size: 11px;
            margin-top: 12px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #999;
            padding: 15px 25px;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="content-wrapper">
            <div class="card">
                <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo KAI">

            <div class="title">Cek Status Pengajuan</div>

            <form action="/cek-status" method="POST">
                @csrf
                <div class="input-group">
                    <input 
                        type="text" 
                        name="nomor" 
                        placeholder="Masukkan nomor pengajuan anda..."
                        value="{{ request('nomor') }}"
                        required
                    >
                </div>

                <button type="submit" class="btn-submit">Submit</button>
            </form>

            @if(session('error'))
                <div class="error-msg">⚠️ {{ session('error') }}</div>
            @endif

            <a href="/" class="btn-back">
                <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                Kembali
            </a>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2026 PT. Kereta Api Indonesia. All rights reserved.</p>
        </div>
    </div>

</body>
</html>