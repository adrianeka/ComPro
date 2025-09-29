<x-layout>
    <!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper " data-bg-src="{{ asset('assets/img/bg/breadcumb-bg.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">News Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('news') }}">News & Articles</a></li>
                    <li>News Details</li>
                </ul>
            </div>
        </div>
    </div>

    <!--==============================
        Blog Area
    ==============================-->
    <section class="th-blog-wrapper blog-details space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-lg-7">
                    <div class="th-blog blog-single">
                        @php
                            $thumbPath = $news->thumbnail;
                            $isFullUrl = is_string($thumbPath) && preg_match('#^https?://#i', $thumbPath);
                            $fileExists = $thumbPath && \Illuminate\Support\Facades\File::exists(public_path($thumbPath));
                            $heroUrl = $isFullUrl
                                ? $thumbPath
                                : ($fileExists 
                                    ? asset($thumbPath)
                                    : asset('assets/img/blog/placeholder-391x250.jpg'));
                        @endphp

                        <div class="blog-img">
                            <img
                                src="{{ $heroUrl }}"
                                alt="{{ $news->title }}">
                        </div>

                        <div class="blog-content">
                            <div class="blog-meta">
                                <a class="author" href="#">
                                    <img src="{{ asset('assets/img/blog/author-1-1.png') }}" alt="avater">
                                    By {{ $news->author ?? 'Admin' }}
                                </a>
                                <a href="#">
                                    <i class="fa-light fa-calendar-days"></i>
                                    {{ ($news->published_at ?? $news->created_at)?->format('d F, Y') }}
                                </a>
                            </div>
                            <h2 class="blog-title">{{ $news->title }}</h2>

                            {!! $news->content !!}
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        <div class="widget">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                @foreach($recent as $r)
                                    @php
                                        $t = $r->thumbnail;
                                        $tIsUrl = is_string($t) && preg_match('#^https?://#i', $t);
                                        $tFileExists = $t && \Illuminate\Support\Facades\File::exists(public_path($t));
                                        $thumbRecent = $tIsUrl
                                            ? $t
                                            : ($tFileExists
                                                ? asset($t)
                                                : asset('assets/img/blog/blog_1_1.jpg'));
                                    @endphp
                                    <div class="recent-post">
                                        <div class="media-img">
                                            <a href="{{ route('news.detail', $r->slug) }}">
                                                <img
                                                    src="{{ $thumbRecent }}"
                                                    alt="{{ $r->title }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="post-title">
                                                <a class="text-inherit" href="{{ route('news.detail', $r->slug) }}">
                                                    {{ $r->title }}
                                                </a>
                                            </h4>
                                            <div class="recent-post-meta">
                                                <a href="{{ route('news.detail', $r->slug) }}">
                                                    <i class="fal fa-calendar-days"></i>
                                                    {{ ($r->published_at ?? $r->created_at)?->format('d M, Y') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
      /* Hero/detail image: seragam & crop rapi (ubah tinggi jika perlu) */
      .blog-details .th-blog .blog-img {
        position: relative !important;
        width: 100% !important;
        height: 420px !important;       /* atur 350–500 sesuai selera */
        padding: 0 !important;
        aspect-ratio: auto !important;
        overflow: hidden !important;
        border-radius: 16px !important;
        background: #f2f4f5 !important;
        line-height: 0;
        margin-bottom: 24px;
      }
      .blog-details .th-blog .blog-img img {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
        border-radius: 16px !important;
      }
      @media (max-width: 575.98px) {
        .blog-details .th-blog .blog-img { height: 280px !important; }
      }

      /* Sidebar recent: 80x80 seragam */
      .sidebar-area .recent-post .media-img {
        width: 80px;
        height: 80px;
        flex: 0 0 80px;
        border-radius: 12px;
        overflow: hidden;
        background: #f2f4f5;
      }
      .sidebar-area .recent-post .media-img > a { display:block; width:100%; height:100%; }
      .sidebar-area .recent-post .media-img img {
        width:100%; height:100%;
        object-fit:cover; object-position:center; display:block;
      }
      @media (max-width: 575.98px) {
        .sidebar-area .recent-post .media-img { width:64px; height:64px; flex-basis:64px; }
      }
    </style>
    @endpush
</x-layout>