<x-layout>
    <!-- Breadcumb -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Team Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Team Details</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Team Area -->
    <section class="space">
        <div class="container">
            <div class="about-card mb-5">
                <div class="about-card_img">
                    <img class="w-100" src="{{ asset($member['photo']) }}" alt="team image">
                </div>
                <div class="about-card_box">
                    <div class="about-card_top">
                        <div class="media-body">
                            <h2 class="about-card_title">{{ $member['name'] }}</h2>
                            <h5 class="about-card_desig">{{ $member['position'] }}</h5>
                        </div>
                    </div>
                    <h5>Informasi Pribadi</h5>
                    <div class="about-card_text">
                        <ul>
                            @foreach($member['personal'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <h5>Pengalaman Kerja</h5>
                    <div class="about-card_text">
                        <ul>
                            @foreach($member['experience'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>