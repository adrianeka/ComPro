@props([
    // Tahun otomatis (bisa override: :year="2025")
    'year' => now()->year,

    // Info kontak (bisa override saat pemanggilan)
    'contact' => [
        'address' => 'Jl. Temanggung No. 27 Antapani, Kel. Antapani Kidul, Kec. Antapani, Kota Bandung, Jawa Barat',
        'phone_display' => '+62 xxx - xxxx - xxxx',
        'phone_raw' => '+62xxxxxxxxxxx',
        'emails' => [
            'moneyhub.cas@gmail.com',
            'corsec@moneyhub.co.id',
        ],
    ],

    // Link bawah (Terms, dll)
    'footerLinks' => [
        ['label' => 'Terms & Condition', 'url' => '#'],
        ['label' => 'Careers', 'url' => '#'],
        ['label' => 'Privacy Policy', 'url' => '#'],
    ],

    // Brand name / credit
    'brand' => 'MoneyHub',
    'creditName' => 'Themeholy',
    'creditUrl' => 'https://themeforest.net/user/themeholy',

    // Background image (optional)
    'background' => 'assets/img/bg/footer_bg_2.jpg',
])

@php
    // Helper format tanggal
    $formatDate = function($date) {
        try {
            return \Carbon\Carbon::parse($date)->format('d M, Y');
        } catch (\Exception $e) {
            return $date;
        }
    };
@endphp

<footer class="footer-wrapper footer-layout3"
        @if($background) data-bg-src="{{ asset($background) }}" @endif>

    {{-- Widget Area --}}
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">

                {{-- Contact Widget --}}
                <div class="col-md-6 col-xxl-3 col-xl-4">
                    <div class="widget footer-widget" id="contact-sec">
                        <h3 class="widget_title">Contact Us</h3>
                        <div class="th-widget-about">
                            @if(!empty($contact['address']))
                                <p class="about-text">
                                    <i class="fal fa-map-location"></i>
                                    {{ $contact['address'] }}
                                </p>
                            @endif
                            @if(!empty($contact['phone_raw']))
                                <p class="about-text">
                                    <i class="fal fa-phone"></i>
                                    <a style="color:inherit" href="tel:{{ $contact['phone_raw'] }}">{{ $contact['phone_display'] }}</a>
                                </p>
                            @endif
                            @if(!empty($contact['emails']))
                                @foreach($contact['emails'] as $mail)
                                    <p class="about-text">
                                        <i class="fal fa-envelope"></i>
                                        <a style="color:inherit" href="mailto:{{ $mail }}">{{ $mail }}</a>
                                    </p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Slot kolom kosong (bisa isi nanti) --}}
                <div class="col-md-6 col-xl-auto">
                    {{-- Contoh: social icons / about small --}}
                </div>
                <div class="col-md-6 col-xl-auto">
                    {{-- Contoh: newsletter / quick links --}}
                </div>

                {{-- Recent Posts --}}
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <h3 class="widget_title">Recent Posts</h3>
                        <div class="recent-post-wrap">
                            @forelse($recentPosts as $post)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="{{ $post['url'] }}">
                                            <img src="{{ $post['image'] ?? asset('images/placeholder.jpg') }}"
                                                 alt="{{ $post['title'] }}">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title">
                                            <a class="text-inherit" href="{{ $post['url'] }}">
                                                {{ $post['title'] }}
                                            </a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            <a href="{{ $post['url'] }}">
                                                <i class="fal fa-calendar-days"></i>
                                                {{ $formatDate($post['date'] ?? '') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted small mb-0">No posts available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="copyright-wrap">
        <div class="container">
            <div class="row justify-content-between align-items-center gy-3">
                <div class="col-lg-6">
                    <p class="copyright-text mb-0">
                        Copyright <i class="fal fa-copyright"></i>
                        {{ $year }} {{ $brand }}.
                        Powered by <a href="{{ $creditUrl }}" target="_blank" rel="noopener">{{ $creditName }}</a>.
                        All Rights Reserved.
                    </p>
                </div>
                <div class="col-lg-6 text-lg-end text-center"></div>
            </div>
        </div>
    </div>
</footer>