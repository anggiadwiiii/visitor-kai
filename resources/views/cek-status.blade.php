<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pengajuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            /* Gradient background sesuai foto */
            background: linear-gradient(180deg, #8E7AB5 0%, #D471AF 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container utama (Box Putih) */
        .card {
            background: white;
            width: 85%;
            max-width: 350px;
            padding: 40px 25px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
        }

        /* Logo KAI */
        .logo {
            width: 120px;
            margin-bottom: 30px;
        }

        /* Judul */
        .title {
            font-size: 18px;
            font-weight: 700;
            color: #000;
            margin-bottom: 25px;
        }

        /* Input Field dengan Border Gradient Tipis */
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #D471AF; /* Warna border disesuaikan */
            font-family: inherit;
            font-size: 13px;
            outline: none;
            text-align: center;
        }

        input::placeholder {
            color: #ccc;
            font-style: italic;
        }

        /* Button Submit dengan Gradient */
        .btn-submit {
            width: 70%; /* Tombol tidak full width sesuai foto */
            padding: 12px;
            border-radius: 10px;
            border: none;
            color: white;
            font-weight: 600;
            font-size: 16px;
            background: linear-gradient(to right, #8E7AB5, #D471AF);
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(212, 113, 175, 0.3);
            transition: transform 0.2s;
        }

        .btn-submit:active {
            transform: scale(0.95);
        }

        /* Error Message */
        .error-msg {
            color: #ff4d4d;
            font-size: 12px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

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
    </div>

</body>
</html>