<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Visitor KAI</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #e9ecef;
        }

        .page-wrapper {
            position: relative;
            width: 100vw;
            height: 100vh;
            background-image: url('{{ asset('images/bg-kaii.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }

        .page-wrapper::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.12);
        }

        .content {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3.2vh;
            padding: 2vh 16px;
        }

        .main-title {
            text-align: center;
            color: #ffffff;
            font-size: clamp(20px, 2.3vw, 34px);
            font-weight: 800;
            line-height: 1.35;
            text-shadow:
                0 2px 0 rgba(0,0,0,0.18),
                0 5px 14px rgba(0,0,0,0.45);
        }

        .main-title span {
            display: block;
        }

        .login-card {
            width: min(92vw, 560px);
            background: rgba(248, 248, 248, 0.97);
            border: 1.5px solid #d86ab8;
            border-radius: 16px;
            padding: clamp(20px, 2.2vw, 34px) clamp(18px, 3.5vw, 54px);
            box-shadow: 0 10px 28px rgba(0,0,0,0.14);
        }

        .login-title {
            text-align: center;
            font-size: clamp(20px, 1.8vw, 28px);
            font-weight: 700;
            color: #111;
            margin-bottom: 18px;
        }

        .alert {
            width: 100%;
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .alert-danger {
            background: #ffe2e2;
            color: #b42318;
            border: 1px solid #f4b5b5;
        }

        .alert-success {
            background: #e8f8ed;
            color: #067647;
            border: 1px solid #abe6bf;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #111;
            margin-bottom: 6px;
            margin-left: 2px;
        }

        .form-input {
            width: 100%;
            height: 42px;
            border: 1.6px solid #d97ac8;
            border-radius: 8px;
            background: #fff;
            outline: none;
            padding: 0 14px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.12);
        }

        .error-text {
            margin-top: 4px;
            margin-left: 2px;
            color: #dc2626;
            font-size: 11px;
            line-height: 1.3;
        }

        .btn-login {
            width: 100%;
            height: 42px;
            margin-top: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(90deg, #6e56cf 0%, #d6579a 100%);
            box-shadow: 0 6px 14px rgba(157, 87, 196, 0.22);
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            opacity: 0.97;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .content {
                gap: 22px;
                padding: 20px 14px;
            }

            .login-card {
                width: min(94vw, 460px);
                padding: 22px 16px;
                border-radius: 14px;
            }

            .login-title {
                margin-bottom: 14px;
            }

            .form-group {
                margin-bottom: 10px;
            }

            .form-input,
            .btn-login {
                height: 40px;
            }
        }

        @media (max-width: 480px) {
            .page-wrapper {
                border-width: 2px;
            }

            .content {
                justify-content: center;
                gap: 18px;
                padding: 16px 12px;
            }

            .main-title {
                font-size: 18px;
                line-height: 1.4;
            }

            .login-card {
                width: 100%;
                max-width: 360px;
                padding: 18px 14px;
            }

            .login-title {
                font-size: 20px;
                margin-bottom: 12px;
            }

            .form-label {
                font-size: 12px;
                margin-bottom: 5px;
            }

            .form-input {
                height: 38px;
                font-size: 13px;
            }

            .btn-login {
                height: 38px;
                font-size: 14px;
                margin-top: 8px;
            }

            .alert {
                font-size: 11px;
                padding: 8px 10px;
                margin-bottom: 10px;
            }

            .error-text {
                font-size: 10px;
            }
        }

        @media (max-height: 700px) {
            .content {
                gap: 14px;
                padding: 12px;
            }

            .main-title {
                font-size: clamp(18px, 2vw, 28px);
                line-height: 1.3;
            }

            .login-card {
                padding: 18px 16px;
                max-width: 500px;
            }

            .login-title {
                font-size: 22px;
                margin-bottom: 10px;
            }

            .form-group {
                margin-bottom: 8px;
            }

            .form-input,
            .btn-login {
                height: 38px;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="content">
            <div class="main-title">
                <span>Sistem Pengelolaan Kartu Visitor PT</span>
                <span>KAI DAOP 6 Yogyakarta</span>
            </div>

            <div class="login-card">
                <div class="login-title">Login</div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->has('login'))
                    <div class="alert alert-danger">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-input"
                            value="{{ old('username') }}"
                            autocomplete="off"
                        >
                        @error('username')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                        >
                        @error('password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>