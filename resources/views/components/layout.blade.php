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
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#0ea5e9">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    {{-- Google Fonts (biarkan external – bisa nanti self-host) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    {{-- Bundled CSS & JS --}}
    @vite(['resources/css/app.css'])

    {{-- jQuery dari CDN untuk memastikan tersedia --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- Placeholder tambahan jika butuh page-level CSS --}}
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css">
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
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/circle-progress.js') }}"></script>
    <script src="{{ asset('assets/js/tilt.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/smooth-scroll.js') }}"></script>
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
    <!-- Leaflet JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    @stack('scripts')
</body>
</html>