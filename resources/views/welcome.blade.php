<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hunter Garage - Servis Kendaraan Lebih Mudah</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Arial, sans-serif;
            color: #172033;
            background: #f5f7fb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
        }

        .page {
            width: min(1120px, calc(100% - 40px));
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 28px 0;
        }

        .brand {
            color: #172033;
            font-size: 20px;
            font-weight: 700;
            text-decoration: none;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .button {
            display: inline-block;
            padding: 12px 18px;
            border: 1px solid #d6dce8;
            border-radius: 8px;
            color: #172033;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .button-primary {
            border-color: #155eef;
            color: #fff;
            background: #155eef;
        }

        .hero {
            display: grid;
            min-height: 480px;
            align-content: center;
            justify-items: start;
            padding: 64px;
            border-radius: 20px;
            background: linear-gradient(120deg, #eef4ff, #fff 70%);
        }

        .eyebrow {
            margin: 0 0 16px;
            color: #155eef;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        h1 {
            max-width: 680px;
            margin: 0;
            font-size: clamp(38px, 6vw, 64px);
            line-height: 1.08;
        }

        .description {
            max-width: 560px;
            margin: 22px 0 30px;
            color: #586174;
            font-size: 18px;
            line-height: 1.7;
        }

        @media (max-width: 600px) {
            .page {
                width: min(100% - 28px, 1120px);
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 16px;
            }

            .hero {
                min-height: 420px;
                padding: 32px 24px;
            }

            .description {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <a class="brand" href="{{ url('/') }}">Hunter Garage</a>
            <nav class="nav" aria-label="Navigasi utama">
                @auth
                    <a class="button button-primary" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="button" href="{{ route('login') }}">Masuk</a>
                    @if (Route::has('register'))
                        <a class="button button-primary" href="{{ route('register') }}">Daftar</a>
                    @endif
                @endauth
            </nav>
        </header>

        <main class="hero">
            <p class="eyebrow">Platform layanan Hunter Garage</p>
            <h1>Perawatan kendaraan jadi lebih mudah.</h1>
            <p class="description">
                Kelola kebutuhan servis kendaraan Anda bersama Hunter Garage.
                Masuk atau buat akun untuk memulai.
            </p>
            <a class="button button-primary" href="{{ route('login') }}">Mulai sekarang</a>
        </main>
    </div>
</body>
</html>
