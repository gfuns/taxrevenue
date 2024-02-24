@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | ' . $business->business_name)
<style type="text/css">
    .mts {
        margin-top: 0px;
    }

    @media (max-width:576px) {
        .mts {
            margin-top: 20px !important;
        }

    }
</style>
<main class="main">
    <section class="section-box-2 company-detail">
        <div class="">
            <div class="">
                <div class="wrap-cover-image">
                    <img src="{{ $topBanner->file_url }}" alt="LinkedIn">
                </div>
            </div>
            <div class="box-company-profile">

                <div class="row mt-30">
                    <div class="row col-lg-8 col-12">
                        <div class="col-lg-2 col-2">
                            <img src="{{ $business->business_logo }}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="col-lg-8 col-md-10 col-10">
                            <h5 class="f-20"> {{ $business->business_name }}</h5>
                            <span class="mt-6" style="display: block; font-size: 14px">
                                {{ $business->city . ', ' . $business->state . ', ' . $business->country }}</span>
                            <span class="font-regular">
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
                                    class="font-xs color-text-mutted ml-10"><span>(</span><span>{{ $business->reviews->count() }}</span><span>
                                        Reviews)</span></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 text-lg-end mts">
                        <a class="btn btn-apply-icon btn-apply"
                            href="whatsapp://send?phone={{ $business->business_phone }}&text=Hi, I saw your business page on Arete Planet. I am very please to connect with you."
                            target="_blank"> Chat Business
                        </a>
                    </div>

                </div>
            </div>
            <div class="border-bottom pt-10 pb-10"></div>
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
                                <h5 class="f-20" style="color:black">Who We Are and What We do</h5>
                                <div class="ck-content">
                                    <p style="font-size: 12px">@php echo $business->business_description; @endphp</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-related-job content-page box-list-jobs">
                        <h5 class="mb-30">Find a display of some of our gods and services</h5>
                        <div class="display-grid row">
                            @foreach ($catalogues as $cat)
                                <div class="col-4 col-lg-2 jobs-listing">
                                    <div class="card-grid-2 hover-up" style="background:white">
                                        <div class="row">
                                            <div class="image-box"><img src="{{ $cat->file_url }}" alt=""></div>
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
                </div>
            </div>
        </div>
    </section>

</main>
<script type="text/javascript">
    document.getElementById("businesses").classList.add('active');
</script>
@endsection
