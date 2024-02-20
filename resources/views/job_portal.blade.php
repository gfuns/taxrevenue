@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Job Portal')
<main class="main">
    <div class="ck-content">
        <div>
            <section class="section-box">
                <div class="banner-hero hero-2 hero-3" style="background:url({{ asset('files/pages/Search.png') }}">
                    <div class="banner-inner">
                        <div class="block-banner">
                            <h1 class="text-42 color-white wow animate__animated animate__fadeInUp"> The Official
                                <span class="color-green">Arete</span> Job Portal
                            </h1>
                            <div class="font-lg font-regular color-white mt-20 wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s"> “Arete is our first stop whenever we're hiring a PHP, Java or
                                JavaScript role.
                                We've hired over 60 developers in the last few years, all thanks to Arete.” — Andrew
                                Hall, Elite JSC. </div>
                            <div class="form-find position-relative mt-40 wow animate__animated animate__fadeIn"
                                data-wow-delay=".2s">
                                <form method="GET" action="" accept-charset="UTF-8">
                                    <select id="myloc" class="form-input mr-10" name="location">
                                        <option value="">Location</option>
                                        <option value="Abia" @if ($location == 'Abia') selected @endif>Abia
                                        </option>
                                        <option value="Abuja (FCT)" @if ($location == 'Abuja (FCT)') selected @endif>
                                            Abuja - Federal Capital Territory</option>
                                        <option value="Adamawa" @if ($location == 'Adamawa') selected @endif>
                                            Adamawa</option>
                                        <option value="Akwa Ibom" @if ($location == 'Akwa Ibom') selected @endif>Akwa
                                            Ibom</option>
                                        <option value="Anambra" @if ($location == 'Anambra') selected @endif>
                                            Anambra</option>
                                        <option value="Bauchi" @if ($location == 'Bauchi') selected @endif>Bauchi
                                        </option>
                                        <option value="Bayelsa" @if ($location == 'Bayelsa') selected @endif>
                                            Bayelsa</option>
                                        <option value="Benue" @if ($location == 'Benue') selected @endif>Benue
                                        </option>
                                        <option value="Borno" @if ($location == 'Borno') selected @endif>Borno
                                        </option>
                                        <option value="Cross River" @if ($location == 'Cross River') selected @endif>
                                            Cross River</option>
                                        <option value="Delta" @if ($location == 'Delta') selected @endif>Delta
                                        </option>
                                        <option value="Ebonyi" @if ($location == 'Ebonyi') selected @endif>
                                            Ebonyi</option>
                                        <option value="Edo" @if ($location == 'Edo') selected @endif>Edo
                                        </option>
                                        <option value="Ekiti" @if ($location == 'Ekiti') selected @endif>Ekiti
                                        </option>
                                        <option value="Enugu" @if ($location == 'Enugu') selected @endif>Enugu
                                        </option>
                                        <option value="Gombe" @if ($location == 'Gombe') selected @endif>Gombe
                                        </option>
                                        <option value="Imo" @if ($location == 'Imo') selected @endif>Imo
                                        </option>
                                        <option value="Jigawa" @if ($location == 'Jigawa') selected @endif>
                                            Jigawa</option>
                                        <option value="Kaduna" @if ($location == 'Kaduna') selected @endif>
                                            Kaduna</option>
                                        <option value="Kano" @if ($location == 'Kano') selected @endif>Kano
                                        </option>
                                        <option value="Katsina" @if ($location == 'Katsina') selected @endif>
                                            Katsina</option>
                                        <option value="Kebbi" @if ($location == 'Kebbi') selected @endif>Kebbi
                                        </option>
                                        <option value="Kogi" @if ($location == 'Kogi') selected @endif>Kogi
                                        </option>
                                        <option value="kwara" @if ($location == 'Kwara') selected @endif>Kwara
                                        </option>
                                        <option value="Lagos" @if ($location == 'Lagos') selected @endif>Lagos
                                        </option>
                                        <option value="Nassarawa" @if ($location == 'Nassarawa') selected @endif>
                                            Nassarawa</option>
                                        <option value="Niger" @if ($location == 'Niger') selected @endif>Niger
                                        </option>
                                        <option value="Ogun" @if ($location == 'Ogun') selected @endif>Ogun
                                        </option>
                                        <option value="Ondo" @if ($location == 'Ondo') selected @endif>Ondo
                                        </option>
                                        <option value="Osun" @if ($location == 'Osun') selected @endif>Osun
                                        </option>
                                        <option value="Oyo" @if ($location == 'Oyo') selected @endif>Oyo
                                        </option>
                                        <option value="Plateau" @if ($location == 'Plateau') selected @endif>
                                            Plateau</option>
                                        <option value="Rivers" @if ($location == 'Rivers') selected @endif>
                                            Rivers</option>
                                        <option value="Sokoto" @if ($location == 'Sokoto') selected @endif>
                                            Sokoto</option>
                                        <option value="Taraba" @if ($location == 'Taraba') selected @endif>
                                            Taraba</option>
                                        <option value="Yobe" @if ($location == 'Yobe') selected @endif>Yobe
                                        </option>
                                        <option value="Zamfara" @if ($location == 'Zamfara') selected @endif>
                                            Zamfara</option>

                                    </select>

                                    <input class="form-input input-keysearch mr-10" name="keyword"
                                        value="{{ $keyword }}" type=text
                                        placeholder="Job title, skills or industry...">
                                    <div class="search-btn-group"><button
                                            class="btn btn-default btn-find font-sm">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="container mt-60">
                        <div class="box-swiper mt-50">
                            <div class="swiper-container swiper-group-5 swiper">
                                <div class="swiper-wrapper pb-25 pt-5">
                                    @foreach ($categories as $cat)
                                        <div class="swiper-slide hover-up"><a href="/job-categories/{{ $cat->slug }}">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src="{{ $cat->category_icon }}"
                                                            alt="#"></div>
                                                    <div class="text-info-right">
                                                        <h4>{{ $cat->category_name }}</h4>
                                                        <p class="font-xs"> 51 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination swiper-pagination-style-border"></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </section>
        </div>
        <div>
            <section class="section-box mt-30">
                <div class="container">
                    <div class="row row-filter">

                        <div class="col-12 col-lg-12 jobs-listing">
                            <div class="content-page job-content-section">
                                <div class="box-filters-job d-none d-lg-block">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-5 jobs-listing-container"><span
                                                class="text-small text-showing showing-of-results"> Showing
                                                {{ $marker['begin'] }} to {{ $marker['end'] }} of
                                                {{ number_format($lastRecord) }} Records </span></div>
                                        <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                                            <div class="display-flex2">

                                                <div class="box-border"><span class="text-sort_by">Sort by:</span>
                                                    <div class="dropdown dropdown-sort"><button
                                                            class="btn dropdown-toggle" id="dropdownSort2" type=button
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            data-bs-display="static"><span>Newest</span><i
                                                                class="fi-rr-angle-small-down"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-light"
                                                            aria-labelledby="dropdownSort2">
                                                            <li><a class="dropdown-item @if ($filter == 'desc') active @endif"
                                                                    data-sort-by="newest"
                                                                    href="{{ url()->current() }}?filter=desc"> Newest
                                                                </a></li>
                                                            <li><a class="dropdown-item @if ($filter == 'asc') active @endif"
                                                                    data-sort-by="oldest"
                                                                    href="{{ url()->current() }}?filter=asc"> Oldest
                                                                </a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row showing-of-results">
                                    @foreach ($jobs as $job)
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up  ">
                                                <div class="card-grid-2-image-left job-item"><span
                                                        class="flash"></span>
                                                    <div class="image-box"><img
                                                            src="{{ $job->business->business_logo }}" alt="#">
                                                    </div>
                                                    <div class="right-info"><a class="name-job"
                                                            style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 200px;"
                                                            href="/business/details/{{ $job->business->slug }}"
                                                            title="{{ $job->business->business_name }}">
                                                            {{ $job->business->business_name }} </a><span
                                                            class="location-small"> {{ $job->state }},
                                                            {{ $job->country }} </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="/job/details/{{ $job->slug }}"
                                                            title="{{ $job->job_title }}">{{ $job->job_title }}</a>
                                                    </h6>
                                                    <div class="mt-5"><span class="card-briefcase">
                                                            {{ $job->engagement_type }}
                                                        </span><span
                                                            class="card-time">{{ $job->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">
                                                        {{ strip_tags($job->job_description) }}</p>

                                                    <div class="tags mt-30">

                                                        @foreach ($job->tags as $tag)
                                                            <a class="btn btn-tag mr-5 mb-2"
                                                                style="cursor: pointer">{{ $tag }}</a>&nbsp;
                                                        @endforeach

                                                    </div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price"
                                                                    title="&#8358;{{ number_format($job->minimum_salary, 0) }}
                                                                    -
                                                                    &#8358;{{ number_format($job->maximum_salary, 0) }}">
                                                                    &#8358;{{ number_format($job->minimum_salary, 0) }}
                                                                    -
                                                                    &#8358;{{ number_format($job->maximum_salary, 0) }}
                                                                </span><span
                                                                    class="text-muted">/{{ $job->salary_rate }}</span>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <div class="">
                                                                    <a href="/job/details/{{ $job->slug }}">
                                                                        <button class="btn btn-apply-now"> Apply
                                                                            Now</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if (count($jobs) < 1)
                                        <div class="col-xl-12 col-12 job-items job-empty">
                                            <div class="text-center mt-4"><i class="fi fi-rr-sad text-3xl"></i>
                                                <h3 class="mt-2">No Jobs</h3>
                                                <div class="mt-2 text-muted"> There are no jobs found with your
                                                    queries. </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @if (count($jobs) > 0 && $marker != null)
                                <div class="paginationssss">
                                    <div class="row g-2 pt-3 ms-4 me-4">
                                        <div class="col-md-9 mt-2">
                                            Showing {{ $marker['begin'] }} to {{ $marker['end'] }} of
                                            {{ number_format($lastRecord) }} Records
                                        </div>

                                        <div class="col-md-3">{{ $jobs->appends(request()->input())->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</main>

<script type="text/javascript">
    document.getElementById("jobportal").classList.add('active');
</script>
@endsection
