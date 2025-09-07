@props([
    'menu' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'About', 'url' => route('home').'#about-sec'],
        ['label' => 'Legal', 'url' => route('home').'#legal-sec'],
        ['label' => 'Values', 'url' => route('home').'#value-sec'],
        ['label' => 'Team', 'url' => route('home').'#team-sec'],
        ['label' => 'Products', 'url' => route('home').'#product-sec'],
        ['label' => 'Network', 'url' => route('home').'#network-sec'],
        ['label' => 'News & Articles', 'url' => route('news')],
        ['label' => 'Contact', 'url' => route('home').'#contact-sec'],
    ],
    'contacts' => [
        'address' => 'Jl. Temanggung No. 27, Kec. Antapani, Kota Bandung, Jawa Barat',
        'phone_display' => '+62 xxx - xxxx - xxxx',
        'phone_raw' => '+62xxxxxxxxxxx',
        'emails' => [
            'moneyhub.cas@gmail.com',
            'corsec@moneyhub.co.id',
        ],
    ],
    'homeRoute' => 'home',
])

@php
    $isActive = function($itemUrl) {
        $current = url()->current();
        $base = explode('#', $itemUrl)[0];
        return $current === $base;
    };
@endphp

{{-- MOBILE MENU WRAPPER (pindahkan ke sini agar pasti dirender sebelum init JS) --}}
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a class="icon-masking" href="{{ route($homeRoute) }}">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="MoneyHub">
            </a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                @foreach($menu as $m)
                    <li><a href="{{ $m['url'] }}">{{ $m['label'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<header class="th-header header-layout2">
    {{-- Top Bar --}}
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                <div class="col-auto d-none d-lg-block">
                    <div class="header-links">
                        <ul>
                            @if(!empty($contacts['address']))
                                <li><i class="fas fa-map-location"></i> {{ $contacts['address'] }}</li>
                            @endif
                            @if(!empty($contacts['phone_raw']))
                                <li><i class="fas fa-phone"></i>
                                    <a href="tel:{{ $contacts['phone_raw'] }}">{{ $contacts['phone_display'] }}</a>
                                </li>
                            @endif
                            @if(!empty($contacts['emails']))
                                @foreach($contacts['emails'] as $email)
                                    <li><i class="fas fa-envelope"></i><a href="mailto:{{ $email }}">{{ $email }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Menu --}}
    <div class="sticky-wrapper">
        <div class="menu-area">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="header-logo">
                            <a class="icon-masking" href="{{ route($homeRoute) }}">
            
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="MoneyHub">
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <nav class="main-menu d-none d-lg-inline-block">
                            <ul>
                                @foreach($menu as $m)
                                    <li class="{{ $isActive($m['url']) ? 'active' : '' }}">
                                        <a href="{{ $m['url'] }}">{{ $m['label'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                        <div class="header-button d-inline-block d-lg-none">
                            <button type="button" class="th-menu-toggle" aria-label="Open mobile menu">
                                <i class="far fa-bars"></i>
                            </button>
                        </div>
                        {{-- Side menu opsional kalau mau nanti --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>