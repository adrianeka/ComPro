<!doctype html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MoneyHub - Company Profile {{ $title ?? '' }}</title>
    <meta name="author" content="Themeholy">
    <meta name="description" content="MoneyHub - Company Profile">
    <meta name="keywords" content="MoneyHub - Company Profile">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Favicons --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    {{-- Google Fonts (biarkan external – bisa nanti self-host) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    {{-- Bundled CSS & JS --}}
    @vite(['resources/css/app.css'])

    {{-- Placeholder tambahan jika butuh page-level CSS --}}
    @stack('styles')
</head>
<body class="@yield('body-class')">

    <div class="cursor"></div>
    <div class="cursor2"></div>

    {{-- Preloader --}}
    <div id="preloader" class="preloader">
        <button class="th-btn th-radius preloaderCls">Cancel Preloader</button>
        <div id="loader" class="th-preloader">
            <div class="animation-preloader">
                <div class="txt-loading">
                    <span class="characters" preloader-text="M">M</span>
                    <span class="characters" preloader-text="O">O</span>
                    <span class="characters" preloader-text="N">N</span>
                    <span class="characters" preloader-text="E">E</span>
                    <span class="characters" preloader-text="Y">Y</span>
                    <span class="characters" preloader-text="H">H</span>
                    <span class="characters" preloader-text="U">U</span>
                    <span class="characters" preloader-text="B">B</span>
                </div>
            </div>
        </div>
    </div>

    <x-site-header />
    {{ $slot }}
    <x-site-footer />

    <div class="scroll-top">
        <svg class="progress-circle svg-content" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </div>

    {{-- Placeholder tambahan page-level JS --}}
    @vite(['resources/js/app.js'])
    <script src="{{ asset('assets/js/particles.min.js') }}"></script>
    <script src="{{ asset('assets/js/particles-config.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script>
        if (window.gsap && window.ScrollTrigger) {
            window.gsap.registerPlugin(window.ScrollTrigger);
            console.log('GSAP OK v' + window.gsap.version);
        } else {
            console.warn('GSAP belum kebaca');
        }
    </script>
    @stack('scripts')
</body>
</html>