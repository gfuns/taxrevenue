@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | ' . $artisan->customer->first_name . ' ' . $artisan->customer->last_name)

<main class="main">
    <section class="section-box">
        <div class="breadcrumb-cover page_speed_160581955" style="background:url({{ asset('storage/pages/Search.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="mb-10" style="color:#fff">
                            {{ $artisan->customer->first_name . ' ' . $artisan->customer->last_name }}</h2>
                        <span class="card-location font-regular text-white">{{ $artisan->country }},
                            {{ $artisan->city }}</span>
                    </div>
                    <div class="col-lg-3 text-md-end">
                        <ul class="breadcrumbs ">
                            <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                    Home </a></li>
                            <li><a href="/artisans">Artisans</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="content-single">
                        <div class="tab-content">
                            <div class="tab-pane fade active show mb-5" id="tab-short-bio" role="tabpanel"
                                aria-labelledby="tab-short-bio">
                                <h4>About Me</h4>
                                <p>@php echo $artisan->biography; @endphp</p>
                            </div>
                            <div class="candidate-education-details mt-4 pt-3">
                                <h4 class="fs-17 fw-bold mb-0">Education</h4>
                                <div class="candidate-education-content mt-4 d-flex">
                                    <div class="circle flex-shrink-0 bg-soft-primary">C</div>
                                    <div class="ms-4">
                                        <h6 class="fs-16 mb-1">Culture and Technology Studies</h6>
                                        <p class="mb-2 text-muted">American Institute of Health Technology - (2023
                                            - 2023) </p>
                                        <p class="text-muted">There are many variations of passages of available,
                                            but the majority alteration in some form. As a highly skilled and
                                            successful product development and design specialist with more than 4
                                            Years of My experience</p>
                                    </div>
                                </div>
                            </div>
                            <div class="candidate-education-details mt-4 pt-3">
                                <h4 class="fs-17 fw-bold mb-0">Experience</h4>
                                <div class="candidate-education-content mt-4 d-flex">
                                    <div class="circle flex-shrink-0 bg-soft-primary"> W </div>
                                    <div class="ms-4">
                                        <h6 class="fs-16 mb-1">Web Designer</h6>
                                        <p class="mb-2 text-muted">Darwin Travel - (2023 - 2023) </p>
                                        <p class="text-muted">There are many variations of passages of available,
                                            but the majority alteration in some form. As a highly skilled and
                                            successful product development and design specialist with more than 4
                                            Years of My experience</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($reviews) > 0)
                        <div class="mt-4 pt-3 position-relative review-listing page_speed_1348359271">
                            <h6 class="fs-17 fw-semibold mb-3">Reviews for
                                {{ $artisan->customer->first_name . ' ' . $artisan->customer->last_name }}</h6>
                            <div class="spinner-overflow"></div>
                            <div class="half-circle-spinner page_speed_839467758">
                                <div class="circle circle-1"></div>
                                <div class="circle circle-2"></div>
                            </div>
                            <div class="review-list">
                                @foreach ($reviews as $review)
                                    <div class="d-sm-flex align-items-top review-item">
                                        <div class="flex-shrink-0"><img
                                                class="rounded-circle avatar-md img-thumbnail review-user-avatar"
                                                src="{{ $review->business->business_logo }}" alt="Dailymotion"></div>
                                        <div class="flex-grow-1 ms-sm-3">
                                            <div>
                                                <p class="text-muted float-end fs-14 mb-2">
                                                    {{ date_format($review->created_at, 'M d, Y') }}</p>
                                                <h6 class="mt-sm-0 mt-3 mb-1">{{ $review->business->business_name }}
                                                </h6>
                                                <div class="text-warning review-rating mb-2">
                                                    @php
                                                        $unrated = 5 - $review->rating;
                                                    @endphp
                                                    @for ($i = 1; $i <= $review->rating; $i++)
                                                        <img alt="star" class="rating-star"
                                                            src={{ asset('themes/jobbox/imgs/template/icons/star.svg') }}>
                                                    @endfor
                                                    @for ($i = 1; $i <= $unrated; $i++)
                                                        <img alt="star" class="rating-star"
                                                            src="{{ asset('themes/jobbox/imgs/template/icons/gray-star.svg') }}">
                                                    @endfor
                                                </div>
                                                <p class="text-muted fst-italic">
                                                    {{ $review->review }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="review-pagination d-flex justify-content-center mt-3"></div> --}}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="d-flex justify-content-between">
                            <h5 class="f-18">Overview</h5>
                            <div><img alt="star" class="rating-star"
                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                    alt="star" class="rating-star"
                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                    alt="star" class="rating-star"
                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                    alt="star" class="rating-star"
                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                    alt="star" class="rating-star"
                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                    class="font-xs color-text-mutted ml-10"><span>(</span><span>1</span><span>)</span></span>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <ul>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">View</span><strong
                                            class="small-heading">882</strong></div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-list-job">
                            <ul class="ul-disc">
                                <li>9827 Percival Fall Suite 063Champlinborough, VA 40080</li>
                                <li>Phone: +14807714272</li>
                                <li>Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="b2dad7d3c6dad1ddc6d79cded7dddcd3c0d6ddf2d5dfd3dbde9cd1dddf">[email&#160;protected]</a>
                                </li>
                            </ul>
                            <div class="mt-30"><a class="btn btn-send-message" href="tel:+14807714272"><span>Contact
                                        Me</span></a></div>
                        </div>
                    </div>
                    <div>
                        <div class="ads_banner_widget"><a href="/"><img
                                    src=https://jobbox.archielite.com/storage/widgets/widget-banner.png
                                    alt="Banner image" class="align-middle"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script type="text/javascript">
    document.getElementById("artisans").classList.add('active');
</script>

@endsection
