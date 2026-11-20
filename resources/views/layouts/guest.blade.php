<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hunter Garage') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="login-page">
            <aside class="login-aside">
                <div class="login-card">
                    {{ $slot }}
                </div>
            </aside>

            <section class="login-hero" aria-label="Latar belakang bengkel">
                <div class="login-hero__overlay"></div>
                <div class="login-hero__content">
                    <p class="login-hero__title">
                        <span>Kepercayaan Anda</span>
                        <span class="login-hero__highlight">Prioritas Kami</span>
                    </p>
                    <p class="login-hero__brand">Hunter Garage · Servis &amp; Suku Cadang</p>
                </div>
            </section>
        </div>
    </body>
</html>
