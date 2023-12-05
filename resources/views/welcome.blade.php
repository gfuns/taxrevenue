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
                                                <form method="GET" action="#" accept-charset="UTF-8">
                                                    <div class="box-industry">
                                                        <select
                                                            class="form-input mr-10 select-active input-industry job-category"
                                                            name=job_categories>
                                                            <option value="">Select Job Type</option>
                                                        </select>
                                                    </div>
                                                    <select class="form-input mr-10 select-location" name=location
                                                        data-location-type="state">
                                                        <option value="">Location</option>
                                                    </select>
                                                    <input class="form-input input-keysearch mr-10" name=keyword
                                                        value="" type=text placeholder="Your keyword...">
                                                    <div class="search-btn-group">
                                                        <button class="btn btn-default btn-find font-sm">Search</button>

                                                    </div>
                                                </form>
                                            </div>
                                            <img class="img-responsive mt-50" alt=""
                                                src="{{ asset('storage/pages/arrow.png') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-12 d-none d-xl-block col-md-6">
                                        <img class="img-responsive" alt=""
                                            src="{{ asset('storage/pages/hero_image.png') }}">
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
                                        by Category </h2>
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
                                                            <p class="font-xs"> {{ $cat->jobs }} <span> Jobs
                                                                    Available </span>
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
                <section class="section-box mt-50 job-of-the-day">
                    <div class="container">
                        <div class="text-center">
                            <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp"> Jobs Of
                                The Day</h2>
                            <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">
                                Search and connect with the right jobs faster. </p>

                        </div>
                        <div class="mt-70">
                            <div class="tab-content" id="myTabContent-1">
                                <div class="tab-pane fade show active" id="tab-job-1" aria-labelledby="tab-job-1">
                                    <div class="row job-of-the-day-list">
                                        @foreach ($todayJobs as $job)
                                            {{-- featured-job-item --}}
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                                <div class="card-grid-2 hover-up items ">
                                                    <div class="card-grid-2-image-left job-item"><span
                                                            class="flash"></span>
                                                        <div class="image-box"><img src="{{ $job->business_logo }}"
                                                                alt="{{ $job->business_name }}"></div>
                                                        <div class="right-info"><a class="name-job"
                                                                title="{{ $job->business_name }}"
                                                                href="/business/details/{{ $job->slug }}">{{ $job->business_name }}</a><span
                                                                class="location-small">{{ $job->country }},
                                                                {{ $job->city }}</span></div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <div class="h6 fw-bold text-truncate"><a
                                                                href="/job/details/{{ $job->slug }}"
                                                                title="{{ $job->job_title }}">{{ $job->job_title }}</a>
                                                        </div>
                                                        <div class="mt-5"><span class="card-briefcase">
                                                                {{ $job->engagement_type }} </span><span
                                                                class="card-time">{{ $job->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <p class="font-sm color-text-paragraph job-description mt-15">
                                                            {{ $job->job_description }}</p>
                                                        <div class="mt-15">

                                                            <a class="btn btn-grey-small mr-5 mb-2"
                                                                href="#">Sketch</a>
                                                            <a class="btn btn-grey-small mr-5 mb-2"
                                                                href="#">JavaScript</a>
                                                        </div>
                                                        <div class="card-2-bottom mt-15">
                                                            <div class="row">
                                                                <div class="col-12 salary-information"><span
                                                                        class="card-text-price">
                                                                        &#8358;{{ number_format($job->minimum_salary, 0) }}
                                                                        -
                                                                        &#8358;{{ number_format($job->maximum_salary, 0) }}
                                                                    </span><span
                                                                        class="text-muted">/{{ $job->salary_rate }}</span>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <div class="">
                                                                        <a href="/job/details/{{ $job->slug }}">
                                                                            <button class="btn btn-apply-now">
                                                                                Apply Now </button></a>
                                                                    </div>
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
                        {{-- <div class="text-center mt-50"><a
                                class="btn btn-brand-1 mt--30 hover-up view-more-posts"
                                href="blog.html"> View more </a></div> --}}
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
                                        <img alt="#" src="{{ asset('storage/pages/frame359.png') }}">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="content-job-inner"><span class="color-text-mutted text-32"
                                        style="color: #690068">Millions Of
                                        Jobs.</span>
                                    <h2 class="text-52 wow animate__animated animate__fadeInUp">Find The One
                                        That’s Right <span class="color-brand-2" style="color: #FEBA00">For You</span>
                                    </h2>
                                    <div class="mt-40 pr-50 text-md-lh28 wow animate__animated animate__fadeInUp">
                                        Search all the open positions on Arete Planet. Get your own personalized
                                        salary estimate. Read reviews on over 600,000 companies worldwide. The
                                        right job is out there.</div>
                                    <div class="mt-40">
                                        <div class="wow animate__animated animate__fadeInUp"><a
                                                class="btn btn-secondary" href="/find-jobs">Search jobs</a><a
                                                class="btn btn-link" href="#">Learn more</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div>
                <section class="section-box mt-50 top-companies">
                    <div class="container">
                        <div class="text-center">
                            <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Top
                                <span class="color-brand-2" style="color:#690068">Recruiters</span>
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
                                    <div class="swiper-slide">
                                        @foreach ($topRecruiters as $biz)
                                            <div class="item-5 hover-up wow animate__animated animate__fadeIn">
                                                <div class="item-logo">
                                                    <a href="/business/details/{{ $biz->slug }}">
                                                        <div class="image-left">
                                                            <img alt="{{ $biz->business_name }}"
                                                                src={{ $biz->business_logo }} style="height: 50px">
                                                        </div>
                                                        <div class="text-info-right">
                                                            <h4>{{ $biz->business_name }}</h4>
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
                                                            <span class="font-xs color-text-mutted ml-10"><span>
                                                                    (</span><span>{{ $biz->reviews->count() }}</span><span>)
                                                                </span></span>
                                                        </div>
                                                    </a>
                                                    <div class="text-info-bottom mt-5"><span
                                                            class="font-xs color-text-mutted icon-location location-label"
                                                            title="{{ $biz->city }}, {{ $biz->country }}">
                                                            {{ $biz->city }}, {{ $biz->country }} </span><span
                                                            class="font-xs color-text-mutted float-end mt-5">
                                                            {{ $biz->jobListing->count() == 0 ? 'No' : $biz->jobListing->count() }}
                                                            Job Openings </span></div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <div>
                <section class="section-box mt-50 mb-50 news-or-blogs">
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
                                            <div class="swiper-slide">
                                                <div
                                                    class="card-grid-3 hover-up wow animate__animated animate__fadeIn">
                                                    <div class="text-center card-grid-3-image"><a
                                                            href="/blog/details/{{ $bp->slug }}">
                                                            <figure><img alt="#" src="{{ $bp->cover_photo }}">
                                                            </figure>
                                                        </a></div>
                                                    <div class="card-block-info">
                                                        <div class="tags mb-15">
                                                            <a class="btn btn-tag" href="#">New</a>&nbsp;
                                                            <a class="btn btn-tag" href="#">Event</a>&nbsp;
                                                        </div>
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
                                                                        12 mins to read </span>
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
        </div>
    </div>
    </div>
</main>

<script type="text/javascript">
    document.getElementById("home").classList.add('active');
</script>
@endsection
