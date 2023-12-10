@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | ' . $business->business_name)

<main class="main">
    <section class="section-box">
        <div class="breadcrumb-cover page_speed_160581955" style="background:url({{ asset('files/pages/Search.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="mb-10" style="color:#fff">{{ $business->business_name }}</h2>
                        <span class="card-location font-regular text-white">{{ $business->country }},
                            {{ $business->city }}</span>
                    </div>
                    <div class="col-lg-3 text-md-end">
                        <ul class="breadcrumbs ">
                            <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                    Home </a></li>
                            <li><a href="/businesses">Businesses</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-50 company-detail-job-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="content-single">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-about" role="tabpanel"
                                aria-labelledby="tab-about">
                                <h4>We are {{ $business->business_name }}</h4>
                                <div class="ck-content">
                                    <p>@php echo $business->business_description; @endphp</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-related-job content-page box-list-jobs">
                        <h5 class="mb-30">Latest Jobs</h5>
                        <div class="display-grid row">
                            @foreach ($latestJobs as $ljob)
                                <div class="col-12 col-lg-6 jobs-listing">
                                    <div class="card-grid-2 hover-up"><span class="flash"></span>
                                        <div class="row">
                                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img
                                                            src="{{ $ljob->business->business_logo }}" alt="">
                                                    </div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="/business/details/{{ $ljob->business->slug }}">{{ $ljob->business->business_name }}</a><span
                                                            class="location-small">{{ $ljob->country }},
                                                            {{ $ljob->city }}</span></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-block-info">
                                            <div class="mt-5">
                                                <span class="card-briefcase"> {{ $ljob->engagement_type }} </span>
                                                <span class="card-time">
                                                    <span>{{ $ljob->created_at->diffForHumans() }}</span>
                                                </span>
                                            </div>
                                            <p class="font-sm color-text-paragraph mt-10">
                                                {{ strip_tags($ljob->job_description) }}
                                            </p>
                                            <div class="col-lg-12 text-start col-md-12 col-sm-12">
                                                <div class="mb-15 mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                        href="#">Sketch</a><a class="btn btn-grey-small mr-5 mb-2"
                                                        href="#">JavaScript</a></div>
                                            </div>
                                            <div class="card-2-bottom mt-20">
                                                <div class="row">
                                                    <div class="col-lg-7 col-7"><span class="card-text-price"
                                                            title="&#8358;{{ number_format($ljob->minimum_salary, 0) }}
                                                            -
                                                            &#8358;{{ number_format($ljob->maximum_salary, 0) }}">
                                                            &#8358;{{ number_format($ljob->minimum_salary, 0) }}
                                                            -
                                                            &#8358;{{ number_format($ljob->maximum_salary, 0) }}
                                                        </span><span
                                                            class="text-muted">/{{ $ljob->salary_rate }}</span></div>
                                                    <div class="col-lg-5 col-5 text-end">
                                                        <div class="">
                                                            <a href="/job/details/{{ $ljob->slug }}">
                                                                <button class="btn btn-apply-now">Apply Now</button>
                                                            </a>
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
                    <hr />
                    <div class="mt-4 pt-3 position-relative review-listing page_speed_115609192">
                        <h6 class="fs-17 fw-semibold mb-3">Reviews For {{ $business->business_name }}</h6>
                        <div class="spinner-overflow"></div>
                        <div class="half-circle-spinner page_speed_1268025327">
                            <div class="circle circle-1"></div>
                            <div class="circle circle-2"></div>
                        </div>
                        <div class="review-list">
                            @foreach ($reviews as $review)
                                <div class="d-sm-flex align-items-top review-item">
                                    <div class="flex-shrink-0"><img
                                            class="rounded-circle avatar-md img-thumbnail review-user-avatar"
                                            src="{{ $review->artisan->customer->photo }}" alt=""></div>
                                    <div class="flex-grow-1 ms-sm-3">
                                        <div>
                                            <p class="text-muted float-end fs-14 mb-2">
                                                {{ date_format($review->created_at, 'M d, Y') }}</p>
                                            <h6 class="mt-sm-0 mt-3 mb-1">
                                                {{ $review->artisan->customer->first_name . ' ' . $review->artisan->customer->last_name }}
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
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <div class="avatar-sidebar">
                                <figure><a><img alt="#" src="{{ $business->business_logo }}" /></a></figure>
                                <div class="sidebar-info ">
                                    <span class="sidebar-company mb-2">{{ $business->business_name }}</span>

                                    <a class="link-underline mt-5 mb-2">{{ $business->jobListing->count() == 0 ? 'No' : $business->jobListing->count() }}
                                        Open Jobs</a>

                                    @php
                                        $unrated = 5 - $business->rating;
                                    @endphp
                                    @for ($i = 1; $i <= $business->rating; $i++)
                                        <img alt="star" class="rating-star"
                                            src={{ asset('themes/jobbox/imgs/template/icons/star.svg') }}>
                                    @endfor
                                    @for ($i = 1; $i <= $unrated; $i++)
                                        <img alt="star" class="rating-star"
                                            src="{{ asset('themes/jobbox/imgs/template/icons/gray-star.svg') }}">
                                    @endfor

                                    <span
                                        class="font-xs color-text-mutted ml-10"><span>(</span><span>{{ $business->reviews->count() }}</span><span>)</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="box-map job-board-street-map-container">
                                MAP comes here
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <ul>
                                <li>
                                    <div class="sidebar-icon-item">
                                        <i class="fi-rr-envelope"></i>
                                    </div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Email Address</span>
                                        <strong class="small-heading">{{ $business->business_email }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item">
                                        <i class="fi-rr-phone-call"></i>
                                    </div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Phone Number</span>
                                        <strong class="small-heading">{{ $business->business_phone }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item">
                                        <i class="fi-rr-map-marker-home"></i>
                                    </div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Contact Address</span>
                                        <strong class="small-heading">{{ $business->business_address }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-globe"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Website</span>
                                        <a href="{{ $business->website_url }}" target="_blank">
                                            <strong class="small-heading">{{ $business->website_url }}</strong>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fab fa-facebook"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Facebook</span>
                                        <strong class="small-heading">{{ $business->facebook_url }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fab fa-linkedin-in"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">LinkedIn</span>
                                        <strong class="small-heading">{{ $business->linkedin_url }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fab fa-twitter"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Twitter</span>
                                        <strong class="small-heading">{{ $business->twitter_url }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fab fa-instagram"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Instagram</span>
                                        <strong class="small-heading">{{ $business->instagram_url }}</strong>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ads_banner_widget"><a href="../index.html"><img
                                src="{{ asset('files/widgets/widget-banner.png') }}" alt="Banner image"
                                class="align-middle"></a></div>
                </div>
            </div>
        </div>
        <form method="GET" action="#" accept-charset="UTF-8" id="job-pagination-form"><input type=hidden
                name=page value="1"></form>
    </section>

</main>
<script type="text/javascript">
    document.getElementById("businesses").classList.add('active');
</script>
@endsection
