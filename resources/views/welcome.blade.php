@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Home')

<main class="main">
    <div class="main-content">
        <div class="page-content" id="app">
            <div class="ck-content">
                <div>
                    <div class="bg-homepage1"></div>
                    <section class="section-box">
                        <div class="banner-hero hero-1">
                            <div class="banner-inner">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-12">
                                        <div class="block-banner">
                                            <h1 class="heading-banner wow animate__animated animate__fadeInUp"> It's
                                                Easy to Find Your <span class="color-brand-2">Dream Job</span>
                                            </h1>
                                            <div class="banner-description mt-20 wow animate__animated animate__fadeInUp"
                                                data-wow-delay=".1s"> Each month, more than 3 million job seekers
                                                turn to Arete in their search for work, making over 140,000
                                                applications every single day </div>
                                            <div class="form-find position-relative mt-40 wow animate__animated animate__fadeIn"
                                                data-wow-delay=".2s">
                                                <form method="GET" action="/find-jobs" accept-charset="UTF-8">
                                                    <div class="box-industry">
                                                        <select class="form-input mr-10 select-active input-industry "
                                                            name="job_categories">
                                                            <option value="">Select Job Type</option>
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}">
                                                                    {{ $cat->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <select class="form-input mr-10 select-active input-industry"
                                                        name="location" data-location-type="state">
                                                        <option value="">Location</option>
                                                        <option value="Nigeria">Nigeria</option>
                                                    </select>
                                                    <input class="form-input input-keysearch mr-10" name="keyword"
                                                        value="" type=text placeholder="Your keyword...">
                                                    <div class="search-btn-group">
                                                        <button class="btn btn-default btn-find font-sm">Search</button>

                                                    </div>
                                                </form>
                                            </div>
                                            <img class="img-responsive mt-50 d-none d-lg-block d-xl-block"
                                                alt="" src="{{ asset('files/pages/arrow.png') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-12 d-none d-xl-block col-md-6">
                                        <img class="img-responsive" alt=""
                                            src="{{ asset('files/pages/hero_image.png') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div>
                    <section class="section-box mt-80">
                        <div class="section-box wow animate__animated animate__fadeIn">
                            <div class="container">
                                <div class="text-center">
                                    <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp"> Browse
                                        Businesses by Category </h2>
                                    <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">
                                        Find the job that’s perfect for you. about 800+ new jobs everyday </p>
                                </div>
                                <div class="box-swiper mt-50">
                                    <div class="swiper-container swiper-group-5 swiper">
                                        <div class="swiper-wrapper pb-70 pt-5">

                                            @foreach ($categories as $cat)
                                                @if ($loop->iteration % 2 == 1)
                                                    <div class="swiper-slide hover-up">
                                                @endif

                                                <a href="/job-categories/{{ $cat->slug }}">
                                                    <div class="item-logo">
                                                        <div class="image-left"><img src="{{ $cat->category_icon }}"
                                                                alt="Content Writer"></div>
                                                        <div class="text-info-right">
                                                            <div class="h6">{{ $cat->category_name }}</div>
                                                            <p class="font-xs"> {{ $cat->jobs }} <span> Listing(s)
                                                                    Available</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>

                                                @if ($loop->iteration % 2 == 0 || $loop->last)
                                        </div>
                                        @endif
                                        @endforeach


                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                </div>
                </section>
            </div>
            <div>
                <div class="section-box mb-30">
                    <div class="container">
                        <div class="box-we-hiring">
                            <div class="box-we-hiring-before page_speed_1341285398"></div>
                            <div class="text-1"><span class="text-we-are">We are</span><span
                                    class="text-hiring">HIRING</span></div>
                            <div class="text-2"> Let’s <span class="color-brand-1">Work</span> Together
                                <br>&amp;<span class="color-brand-1"> Explore</span> Opportunities
                            </div>
                            <div class="text-3"><a href="#">
                                    <div class="btn btn-apply btn-apply-icon">Apply</div>
                                </a></div>
                            <div class="box-we-hiring-after page_speed_200008368"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <section class="section-box mt-50 top-companies">
                    <div class="container">
                        <div class="text-center">
                            <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Top
                                <span class="color-brand-2" style="color:#690068">Businesses</span>
                            </h2>
                            <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">
                                Discover your next career move, freelance gig, or internship from your dream recruiters
                                and businesses all over the World.</p>
                        </div>
                    </div>
                    <div class="container">
                        <div class="box-swiper mt-50">
                            <div class="swiper-container swiper-group-1 swiper-style-2 swiper">
                                <div class="swiper-wrapper pt-5">
                                    <div class="row display-list">
                                        @foreach ($topRecruiters as $biz)
                                            <div class="col-md-6 col-xl-3 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src="{{ $biz->business_logo }}" alt="#">
                                                                </div>
                                                                <div class="right-info">
                                                                    <div class="trim-text">
                                                                        <a class="name-job"
                                                                            href="/business/details/{{ $biz->slug }}">{{ $biz->business_name }}</a>
                                                                    </div>
                                                                    <div class="location-small">
                                                                        {{ $biz->state }}, {{ $biz->country }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="card-block-info">
                                                        <p class="font-xs color-text-paragraph-2 truncate-text">
                                                            {{ strip_tags($biz->business_description) }} </p>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-7">
                                                                    <div class="mt-5">
                                                                        @php
                                                                            $unrated = 5 - $biz->rating;
                                                                        @endphp
                                                                        @for ($i = 1; $i <= $biz->rating; $i++)
                                                                            <img alt="star" class="rating-star"
                                                                                src={{ asset('themes/jobbox/imgs/template/icons/star.svg') }}>
                                                                        @endfor
                                                                        @for ($i = 1; $i <= $unrated; $i++)
                                                                            <img alt="star" class="rating-star"
                                                                                src="{{ asset('themes/jobbox/imgs/template/icons/gray-star.svg') }}">
                                                                        @endfor

                                                                        <span
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>{{ $biz->reviews->count() }}</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="/business/details/{{ $biz->slug }}">
                                                                            Explore Business </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-50 mb-30">
                            <a class="btn btn-apply btn-apply-icon mt--30 hover-up view-more-posts"
                                href="/business-listing"> View More Businesses</a>
                        </div>
                    </div>
                </section>
            </div>
            <div>
                <section class="section-box overflow-visible mt-100 mb-50">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="box-image-job">
                                    <figure class="wow animate__animated animate__fadeIn">
                                        <img alt="#" src="{{ asset('files/pages/frame359.png') }}">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="content-job-inner"><span class="color-text-mutted text-32"
                                        style="color: #690068">Lots Of
                                        Jobs Available.</span>
                                    <h2 class="text-52 wow animate__animated animate__fadeInUp">Find The One
                                        That’s Right <span class="color-brand-2" style="color: #FEBA00">For You</span>
                                    </h2>
                                    <div class="mt-20 text-md-lh28 text-24 wow animate__animated animate__fadeInUp">
                                        Search all the availabe jobs on Arete's Job Portal. Get your own personalized
                                        salary estimate. Read reviews on over 600,000 businesses in Nigeria. The
                                        right job for you is out there.</div>
                                    <div class="mt-40">
                                        <div class="wow animate__animated animate__fadeInUp">
                                            <a class="btn btn-secondary btn-apply-icon" href="/job-portal">Search
                                                Jobs</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div>
                <section class="section-box mt-50 mb-30 news-or-blogs">
                    <div class="container">
                        <div class="text-center">
                            <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">News and
                                Blog</h2>
                            <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">
                                Get the latest news, updates and tips from Arete to help your business growth process.
                            </p>
                        </div>
                    </div>
                    <div class="container">
                        <div class="mt-50">
                            <div class="box-swiper style-nav-top">
                                <div class="swiper-container swiper-group-3 swiper">
                                    <div class="swiper-wrapper pb-70 pt-5">
                                        @foreach ($blogPosts as $bp)
                                            @php
                                                $wordCount = str_word_count($bp->blog_post);
                                                $readingSpeed = 50; // Adjust as needed
                                                $readingTime = ceil($wordCount / $readingSpeed);
                                            @endphp
                                            <div class="swiper-slide">
                                                <div
                                                    class="card-grid-3 hover-up wow animate__animated animate__fadeIn">
                                                    <div class="text-center card-grid-3-image"><a
                                                            href="/blog/details/{{ $bp->slug }}">
                                                            <figure><img alt="#" src="{{ $bp->cover_photo }}">
                                                            </figure>
                                                        </a></div>
                                                    <div class="card-block-info">
                                                        @if (isset($bp->tags))
                                                            <div class="tags mb-15">
                                                                @php
                                                                    $blogTags = explode(', ', $bp->tags);
                                                                @endphp
                                                                @foreach ($blogTags as $tag)
                                                                    <a class="btn btn-tag"
                                                                        style="cursor: pointer">{{ $tag }}</a>&nbsp;
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                        <h5><a
                                                                href="/blog/details/{{ $bp->slug }}">{{ $bp->post_title }}</a>
                                                        </h5>
                                                        <p class="mt-10 color-text-paragraph font-sm post-description">
                                                            {{ strip_tags($bp->blog_post) }}
                                                        </p>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-6">
                                                                    <div class="d-flex"><img class="img-rounded"
                                                                            src="{{ $bp->user->profile_photo }}"
                                                                            alt="#">
                                                                        <div class="info-right-img"><span
                                                                                class="font-sm font-bold color-brand-1 op-70">{{ $bp->user->first_name . ' ' . $bp->user->last_name }}</span><br><span
                                                                                class="font-xs color-text-paragraph-2">{{ date_format($bp->created_at, 'M d, Y') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 text-md-end col-6 pt-15">
                                                                    <span class="color-text-paragraph-2 font-xs">
                                                                        {{ $readingTime }} mins to read </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>



            <div>
                <div class="section-box mb-30">
                    <div class="container">
                        <div class="box-we-hiring">
                            <div class="box-we-hiring-before page_speed_1341285398"></div>
                            <div class="text-1"><span class="text-we-are">We are</span><span
                                    class="text-hiring">HIRING</span></div>
                            <div class="text-2"> Let’s <span class="color-brand-1">Work</span> Together
                                <br>&amp;<span class="color-brand-1"> Explore</span> Opportunities
                            </div>
                            <div class="text-3"><a href="#">
                                    <div class="btn btn-apply btn-apply-icon">Apply</div>
                                </a></div>
                            <div class="box-we-hiring-after page_speed_200008368"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</main>

<script type="text/javascript">
    document.getElementById("home").classList.add('active');
</script>
@endsection
