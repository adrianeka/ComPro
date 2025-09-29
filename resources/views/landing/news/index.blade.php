<x-layout>
    <!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">News & Articles</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>News & Articles</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
    Blog Area
    ==============================-->
    <section class="th-blog-wrapper space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-lg-7">
                    @forelse($all_news as $news)
                        <div class="th-blog blog-single has-post-thumbnail">
                            <div class="blog-img">
                                <a href="{{ route('news.detail', $news->slug) }}">
                                    <img
                                        src="{{ $news->thumbnail ? asset($news->thumbnail) : asset('assets/img/blog/blog_1_1.jpg') }}"
                                        alt="{{ $news->title }}">
                                </a>
                            </div>

                            <div class="blog-content">
                                <div class="blog-meta">
                                    <a class="author" href="{{ route('news') }}">
                                        <img src="{{ asset('assets/img/blog/author-1-1.png') }}" alt="avater"> By {{ $news->author ?? 'Admin' }}
                                    </a>
                                    <a href="{{ route('news.detail', $news->slug) }}">
                                        <i class="fa-light fa-calendar-days"></i>
                                        {{ ($news->published_at ?? $news->created_at)?->format('d M, Y') }}
                                    </a>
                                </div>
                                <h2 class="blog-title">
                                    <a href="{{ route('news.detail', $news->slug) }}">{{ $news->title }}</a>
                                </h2>
                                <p class="blog-text">
                                    {{ $news->excerpt ? Str::limit(strip_tags($news->excerpt), 180) : Str::limit(strip_tags($news->content), 180) }}
                                </p>
                                <a href="{{ route('news.detail', $news->slug) }}" class="line-btn">Read More</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No news found.</p>
                    @endforelse

                    <div class="text-center">
                        {{ $all_news->onEachSide(1)->links('components.pagination-th') }}
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        <div class="widget">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                @foreach($recent as $r)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="{{ route('news.detail', $r->slug) }}">
                                            <img
                                                src="{{ $r->thumbnail ? asset($r->thumbnail) : asset('assets/img/blog/blog_1_1.jpg') }}"
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
      /* List utama: seragam 250px, crop rapi */
      .th-blog-wrapper .th-blog .blog-img {
        position: relative !important;
        width: 100% !important;
        height: 250px !important;        /* ubah kalau mau 300px */
        padding: 0 !important;
        aspect-ratio: auto !important;
        overflow: hidden !important;
        border-radius: 16px !important;
        background: #f2f4f5 !important;
        line-height: 0;
        margin-bottom: 22px;
      }
      .th-blog-wrapper .th-blog .blog-img > a {
        display: block;
        width: 100%;
        height: 100%;
      }
      .th-blog-wrapper .th-blog .blog-img img {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center center !important;
        display: block !important;
        border-radius: 16px !important;
      }

      /* Sidebar recent: 80x80 seperti tema awal */
      .sidebar-area .recent-post .media-img {
        width: 80px;
        height: 80px;
        flex: 0 0 80px;
        border-radius: 12px;
        overflow: hidden;
        background: #f2f4f5;
      }
      .sidebar-area .recent-post .media-img > a {
        display: block;
        width: 100%;
        height: 100%;
      }
      .sidebar-area .recent-post .media-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
      }
      @media (max-width: 575.98px) {
        .th-blog-wrapper .th-blog .blog-img { height: 220px !important; }
        .sidebar-area .recent-post .media-img { width: 64px; height: 64px; flex-basis: 64px; }
      }
    </style>
    @endpush
</x-layout>