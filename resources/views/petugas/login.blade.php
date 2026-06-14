<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login Petugas</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* CSS RESET & FIX SCROLL */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            overflow: hidden; /* Mematikan scroll browser luar */
            background: #efefef;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* PHONE FRAME - FIX 100% LAYAR HP */
        .phone-frame {
            width: 100%;
            max-width: 420px;
            height: 100vh; /* Paksa tinggi sama dengan layar */
            background: #fff;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* KHUSUS TAMPILAN DESKTOP */
        @media (min-width: 641px) {
            .phone-frame {
                height: 92vh; 
                border-radius: 30px;
            }
        }

        /* AREA ATAS (JUDUL) */
        .header-section {
            flex: 1; /* Mengambil sisa ruang agar form terdorong ke bawah */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .title {
            color: #5e239d;
            font-size: 24px;
            font-weight: 800;
            line-height: 1.3;
        }

        /* AREA BAWAH (FORM LOGIN) */
        .form-section {
            padding: 0 30px 60px; /* Jarak bawah lebih besar agar tidak mepet edge HP */
        }

        .login-title {
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #111;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .form-control {
            width: 100%;
            height: 48px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0 16px;
            outline: none;
            font-size: 14px;
            font-family: inherit;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #d94aa3;
            background-color: #fff;
        }

        .btn-login {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(90deg, #6c4cff, #d85c9f);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(216, 92, 159, 0.3);
            transition: opacity 0.2s;
        }

        .btn-login:active {
            opacity: 0.8;
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
    </style>
</head>
<body>
    <div class="phone-frame">
        
        <div class="header-section">
            <div class="title">
                Sistem Pengelolaan<br>
                Kartu Visitor
            </div>
        </div>

        <div class="form-section">
            <div class="login-title">Login</div>

            @if($errors->has('login'))
                <div class="alert">
                    {{ $errors->first('login') }}
                </div>
            @endif

            <form method="POST" action="{{ route('petugas.login.submit') }}">
                @csrf

                <div class="form-group">
                    <label>Username</label>
                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Masukkan username"
                        value="{{ old('username') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>

    </div>
</body>
</html>