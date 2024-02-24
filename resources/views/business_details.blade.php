@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | ' . $business->business_name)
<style type="text/css">
    .mts {
        margin-top: 0px;
    }

    .blo {
        min-height: 100px;
    }

    @media (max-width:576px) {
        .mts {
            margin-top: 20px !important;
        }

        .blo {
            min-height: 60px !important;

        }

    }
</style>
<main class="main">
    <section class="section-box-2 company-detail">
        <div class="">
            @if ($business->page_banner == 'static' && isset($topBanner->file_url))
                <div class="">
                    <div class="wrap-cover-image">
                        <img src="{{ $topBanner->file_url }}" alt="LinkedIn">
                    </div>
                </div>
            @endif

            @if ($business->page_banner == 'slider' && count($sliderBanners) > 0)
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        @foreach ($sliderBanners as $slider)
                            <div class="carousel-item active">
                                <img src="{{ $slider->file_url }}" class="d-block w-100" alt="...">

                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif
            <div class="box-company-profile">

                <div class="row mt-10">
                    <div class="row col-lg-8 col-12">
                        <div class="col-lg-2 col-3">
                            <img src="{{ $business->business_logo }}" class="img-fluid blo" alt="Logo">
                        </div>
                        <div class="col-lg-8 col-md-8 col-8">
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
                        <a class="btn  btn-apply"
                            href="whatsapp://send?phone={{ $business->business_phone }}&text=Hi, I saw your business page on Arete Planet. I am very please to connect with you."
                            target="_blank"> <i class="fab fa-whatsapp fa-1x me-2" style="font-size:18px"></i> Chat
                            Business
                        </a>
                    </div>

                </div>
            </div>
            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>
    <section class="section-box mt-10 company-detail-job-list">
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
                    @if ($business->catalogue_display == 'yes' && count($catalogues) > 0)
                        <div class="box-related-job content-page box-list-jobs">
                            <h5 class="mb-30">Find a display of some of our gods and services</h5>
                            <div class="display-grid row">
                                @foreach ($catalogues as $cat)
                                    <div class="col-4 col-lg-2 jobs-listing">
                                        <div class="card-grid-2 hover-up" style="background:white">
                                            <div class="row">
                                                <div class="image-box"><img src="{{ $cat->file_url }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr />
                    @endif
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

                            @if (count($reviews) < 1)
                                <div class="col-xl-12 col-12 job-items job-empty">
                                    <div class="mt-4">
                                        <p class="mt-2">No Reviews Found</p>
                                        @if (!Auth::user())
                                            <div class="mt-2 text-muted"> <a href="/login" style="color: #690068">Sign In</a> to write a
                                                review for this business. </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div>
                                <form action="https://jobbox.archielite.com/review/create" method="post" class="review-form mt-4 pt-3"><input type="hidden" name="_token" value="kqsYGdIzLnaRXefyGCoGvCSxU0QXqz9ntHSPQ6lf" autocomplete="off"><input type="hidden" name="reviewable_type" value="Botble\JobBoard\Models\Company"><input type="hidden" name="reviewable_id" value="1"><h6 class="fs-17 fw-semibold mb-2">Reviews for LinkedIn</h6><div class="row"><div class="col-lg-12"><div class="mb-3"><div class="br-wrapper br-theme-css-stars"><select name="star" class="jquery-bar-rating" data-read-only="false" style="display: none;"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5" selected="">5</option></select><div class="br-widget"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a><a href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a><a href="#" data-rating-value="3" data-rating-text="3" class="br-selected"></a><a href="#" data-rating-value="4" data-rating-text="4" class="br-selected"></a><a href="#" data-rating-value="5" data-rating-text="5" class="br-selected br-current"></a><div class="br-current-rating">5</div></div></div></div></div><div class="col-lg-12"><div class="mb-3"><label for="review" class="form-label">Review</label><textarea class="form-control" id="review" name="review" placeholder="Add your review"></textarea></div></div></div><div class="text-end"><button type="submit" class="btn btn-primary btn-hover"> Submit Review </button></div></form>
                            </div>

                            {{-- <div class="review-pagination d-flex justify-content-center mt-3"></div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="">
                            <h5 class="sidebar-company mb-4">Contact Details</h5>
                            @if (isset($business->latitude) && isset($business->longitude))
                                <div class="box-map job-board-street-map-container">
                                    <div id="map" style="height: 200px"></div>
                                </div>
                            @endif
                        </div>
                        <div class="sidebar-list-job">
                            <ul>
                                @if (isset($business->business_email))
                                    <li>
                                        <div class="sidebar-icon-item">
                                            <i class="fi-rr-envelope"></i>
                                        </div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Email Address</span>
                                            <a href="mailto:{{ $business->business_email }}">
                                                <strong class="small-heading">{{ $business->business_email }}</strong>
                                            </a>
                                        </div>
                                    </li>
                                @endif
                                @if (isset($business->business_phone))
                                    <li>
                                        <div class="sidebar-icon-item">
                                            <i class="fi-rr-phone-call"></i>
                                        </div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Phone Number</span>
                                            <a href="tel:{{ $business->business_phone }}">
                                                <strong class="small-heading">{{ $business->business_phone }}</strong>
                                            </a>
                                        </div>
                                    </li>
                                @endif
                                @if (isset($business->business_address))
                                    <li>
                                        <div class="sidebar-icon-item">
                                            <i class="fi-rr-map-marker-home"></i>
                                        </div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Contact Address</span>
                                            <strong class="small-heading">{{ $business->business_address }}</strong>
                                        </div>
                                    </li>
                                @endif
                                @if (isset($business->website_url))
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-globe"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Website</span>
                                            <a href="{{ $business->website_url }}" target="_blank">
                                                <strong class="small-heading">{{ $business->website_url }}</strong>
                                            </a>
                                        </div>
                                    </li>
                                @endif
                                @if (isset($business->facebook_url))
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fab fa-facebook"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Facebook</span>
                                            <a href="{{ $business->facebook_url }}" target="_blank">
                                                <strong class="small-heading">{{ $business->facebook_url }}</strong>
                                            </a>
                                        </div>
                                    </li>
                                @endif
                                @if (isset($business->linkedin_url))
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fab fa-linkedin-in"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">LinkedIn</span>
                                            <a href="{{ $business->linkedin_url }}" target="_blank">
                                                <strong class="small-heading">{{ $business->linkedin_url }}</strong>
                                            </a>
                                        </div>
                                    </li>
                                @endif
                                @if (isset($business->twitter_url))
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fab fa-twitter"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Twitter</span>
                                            <a href="{{ $business->twitter_url }}" target="_blank">
                                                <strong class="small-heading">{{ $business->twitter_url }}</strong>
                                            </a>
                                        </div>
                                    </li>
                                @endif
                                @if (isset($business->instagram_url))
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fab fa-instagram"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Instagram</span>
                                            <a href="{{ $business->instagram_url }}" target="_blank">
                                                <strong class="small-heading">{{ $business->instagram_url }}</strong>
                                            </a>
                                        </div>
                                    </li>
                                @endif
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

@section('customjs')
<script type="text/javascript">
    var business = {{ Js::from($business->business_name) }};
    var address = {{ Js::from($business->city . ', ' . $business->state . ', ' . $business->country) }};
    var latitude = {{ Js::from($business->latitude) }};
    var longitude = {{ Js::from($business->longitude) }};

    var map = L.map('map').setView([latitude, longitude], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);


    L.marker([51.5, -0.09]).addTo(map)
        .bindPopup('<strong>' + business + '.</strong> <br/>' + address)
        .openPopup();
</script>

<script type="text/javascript">
    var myCarousel = document.querySelector('#myCarousel')
    var carousel = new bootstrap.Carousel(myCarousel)
</script>


{{-- <script type="text/javascript">
    function getLatLngFromAddress(address) {
        // Replace 'YOUR_API_KEY' with your actual API key
        var apiKey = 'YOUR_API_KEY';
        var geocodingUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURIComponent(address) +
            '&key=' + apiKey;

        // Make a request to the Geocoding API
        fetch(geocodingUrl)
            .then(response => response.json())
            .then(data => {
                if (data.results.length > 0) {
                    // Get the latitude and longitude from the first result
                    var latitude = data.results[0].geometry.location.lat;
                    var longitude = data.results[0].geometry.location.lng;
                    console.log('Latitude:', latitude);
                    console.log('Longitude:', longitude);
                } else {
                    console.error('No results found');
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Example usage:
    getLatLngFromAddress('1600 Amphitheatre Parkway, Mountain View, CA');
</script> --}}
@endsection
