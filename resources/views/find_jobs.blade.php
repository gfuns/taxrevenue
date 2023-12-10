@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Find Jobs')

<main class="main">
    <div class="ck-content">
        <div>
            <section class="section-box">
                <div class="banner-hero hero-2 hero-3" style="background:url({{ asset('files/pages/Search.png') }}">
                    <div class="banner-inner">
                        <div class="block-banner">
                            <h1 class="text-42 color-white wow animate__animated animate__fadeInUp"> The Official
                                <span class="color-green">Nigerian Job</span> Portal
                            </h1>
                            <div class="font-lg font-regular color-white mt-20 wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s"> “Arete is our first stop whenever we're hiring a PHP role.
                                We've hired 10 PHP developers in the last few years, all thanks to Arete.” — Andrew
                                Hall, Elite JSC. </div>
                            <div class="form-find position-relative mt-40 wow animate__animated animate__fadeIn"
                                data-wow-delay=".2s">
                                <form method="GET" action="#" accept-charset="UTF-8">
                                    <div class="box-industry">
                                        <select class="form-input mr-10 select-active input-industry job-category"
                                            name=job_categories[]>
                                            <option value="">Industry</option>
                                        </select>
                                    </div><select class="form-input mr-10 select-location" name=location
                                        data-location-type="state">
                                        <option value="">Location</option>
                                    </select><input class="form-input input-keysearch mr-10" name=keyword value=""
                                        type=text placeholder="Your keyword...">
                                    <div class="search-btn-group"><button
                                            class="btn btn-default btn-find font-sm">Search</button><button type=button
                                            class="btn btn-default font-sm btn-advanced-filter">Advanced
                                            Filter</button></div>
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
                        <div class="col-lg-3 col-md-12 filter-section col-sm-12 col-12 sidebar-filter-mobile">
                            <div class="sidebar-shadow none-shadow mb-30">
                                <div class="backdrop"></div>
                                <div class="sidebar-filters sidebar-filter-mobile__inner">
                                    <form method="GET" action="#"
                                        accept-charset="UTF-8" id="jobs-filter-form"
                                        class="sidebar-filter-mobile__content"><input type=hidden name=page
                                            data-value="1"><input type=hidden name=keyword value=""><input
                                            type=hidden name=per_page><input type=hidden name=layout><input type=hidden
                                            name=sort_by>
                                        <div class="filter-block head-border mb-30">
                                            <h5> Advanced Filters <a class="link-reset" href="jobs.html">Reset</a>
                                            </h5>
                                        </div>
                                        <div class="filter-block mb-30">
                                            <div class="mb-3 select-style select-style-icon"><select
                                                    class="form-control submit-form-filter form-icons select-active select-location"
                                                    form="jobs-filter-form" id="selectCity" name=location
                                                    data-location-type="state"
                                                    data-placeholder="Select location"></select><i
                                                    class="fi-rr-marker"></i></div>
                                        </div>
                                        <div class="filter-block mb-20">
                                            <h5 class="medium-heading mb-15">Industry</h5>
                                            <div class="mb-3 ps-custom-scrollbar">
                                                <ul class="list-checkbox">
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="1"><span
                                                                class="text-small">Content Writer</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">51</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="2"><span
                                                                class="text-small">Market Research</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">19</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="8"><span
                                                                class="text-small">Management</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">15</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="10"><span
                                                                class="text-small">Security Analyst</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">14</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="3"><span
                                                                class="text-small">Marketing &amp; Sale</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">12</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="5"><span
                                                                class="text-small">Finance</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">12</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="6"><span
                                                                class="text-small">Software</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">9</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="4"><span
                                                                class="text-small">Customer Help</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">8</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="9"><span
                                                                class="text-small">Retail &amp;
                                                                Products</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">7</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_categories[]
                                                                form="jobs-filter-form" value="7"><span
                                                                class="text-small">Human Resource</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">6</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="filter-block mb-20">
                                            <h5 class="medium-heading mb-25">Salary range</h5>
                                            <div class="list-checkbox pb-20">
                                                <div class="row position-relative mt-10 mb-20">
                                                    <div class="col-sm-12 box-slider-range">
                                                        <div id="slider-range" data-current-range="0"
                                                            data-max-salary-range="18700"></div>
                                                        <div class="salary-range mt-2"></div>
                                                    </div>
                                                    <div class="box-input-money"><input
                                                            class="input-disabled form-control submit-form-filter"
                                                            name=offered_salary_from type=hidden value="0"><input
                                                            class="input-disabled form-control submit-form-filter"
                                                            name=offered_salary_to type=hidden value="18700"
                                                            data-default-value="18700"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="filter-block mb-30">
                                            <h5 class="medium-heading mb-10">Experience Level</h5>
                                            <div class="mb-3 ps-custom-scrollbar">
                                                <ul class="list-checkbox">
                                                    <li><label class="cb-container"><input type=checkbox
                                                                name=job_experiences[] class="submit-form-filter"
                                                                id="check-job-experience-1" value="1"
                                                                form="jobs-filter-form"><span
                                                                class="text-small">Fresh</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">11</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                name=job_experiences[] class="submit-form-filter"
                                                                id="check-job-experience-2" value="2"
                                                                form="jobs-filter-form"><span class="text-small">Less
                                                                Than 1 Year</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">8</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                name=job_experiences[] class="submit-form-filter"
                                                                id="check-job-experience-3" value="3"
                                                                form="jobs-filter-form"><span class="text-small">1
                                                                Year</span><span class="checkmark"></span></label><span
                                                            class="number-item">14</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                name=job_experiences[] class="submit-form-filter"
                                                                id="check-job-experience-4" value="4"
                                                                form="jobs-filter-form"><span class="text-small">2
                                                                Year</span><span class="checkmark"></span></label><span
                                                            class="number-item">11</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                name=job_experiences[] class="submit-form-filter"
                                                                id="check-job-experience-5" value="5"
                                                                form="jobs-filter-form"><span class="text-small">3
                                                                Year</span><span class="checkmark"></span></label><span
                                                            class="number-item">7</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="filter-block mb-30">
                                            <h5 class="medium-heading mb-10">Job Posted</h5>
                                            <div class="mb-3">
                                                <ul class="list-checkbox">
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=date_posted
                                                                value="last_hour" id="date-posted-last_hour"
                                                                form="jobs-filter-form"><span class="text-small">Last
                                                                hour</span><span class="checkmark"></span></label></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=date_posted
                                                                value="last_24_hours" id="date-posted-last_24_hours"
                                                                form="jobs-filter-form"><span class="text-small">Last
                                                                24 hours</span><span class="checkmark"></span></label>
                                                    </li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=date_posted
                                                                value="last_7_days" id="date-posted-last_7_days"
                                                                form="jobs-filter-form"><span class="text-small">Last
                                                                7 days</span><span class="checkmark"></span></label>
                                                    </li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=date_posted
                                                                value="last_14_days" id="date-posted-last_14_days"
                                                                form="jobs-filter-form"><span class="text-small">Last
                                                                14 days</span><span class="checkmark"></span></label>
                                                    </li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=date_posted
                                                                value="last_1_month" id="date-posted-last_1_month"
                                                                form="jobs-filter-form"><span class="text-small">Last
                                                                1 month</span><span class="checkmark"></span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="filter-block mb-20">
                                            <h5 class="medium-heading mb-15">Job type</h5>
                                            <div class="mb-3 ps-custom-scrollbar">
                                                <ul class="list-checkbox">
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" value="2"
                                                                name=job_types[] id="check-job-type-2"
                                                                form="jobs-filter-form"><span
                                                                class="text-small">Freelance</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">12</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" value="3"
                                                                name=job_types[] id="check-job-type-3"
                                                                form="jobs-filter-form"><span class="text-small">Full
                                                                Time</span><span class="checkmark"></span></label><span
                                                            class="number-item">11</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" value="4"
                                                                name=job_types[] id="check-job-type-4"
                                                                form="jobs-filter-form"><span
                                                                class="text-small">Internship</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">10</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" value="5"
                                                                name=job_types[] id="check-job-type-5"
                                                                form="jobs-filter-form"><span class="text-small">Part
                                                                Time</span><span class="checkmark"></span></label><span
                                                            class="number-item">10</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" value="1"
                                                                name=job_types[] id="check-job-type-1"
                                                                form="jobs-filter-form"><span
                                                                class="text-small">Contract</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">8</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="filter-block mb-20">
                                            <h5 class="medium-heading mb-15">Skill</h5>
                                            <div class="mb-3 ps-custom-scrollbar">
                                                <ul class="list-checkbox">
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-1" autocomplete="off"
                                                                form="jobs-filter-form" value="1"><span
                                                                class="text-small">JavaScript</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">11</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-2" autocomplete="off"
                                                                form="jobs-filter-form" value="2"><span
                                                                class="text-small">PHP</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">8</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-6" autocomplete="off"
                                                                form="jobs-filter-form" value="6"><span
                                                                class="text-small">WordPress</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">7</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-3" autocomplete="off"
                                                                form="jobs-filter-form" value="3"><span
                                                                class="text-small">Python</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">5</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-4" autocomplete="off"
                                                                form="jobs-filter-form" value="4"><span
                                                                class="text-small">Laravel</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">5</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-8" autocomplete="off"
                                                                form="jobs-filter-form" value="8"><span
                                                                class="text-small">FilamentPHP</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">5</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-5" autocomplete="off"
                                                                form="jobs-filter-form" value="5"><span
                                                                class="text-small">CakePHP</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">4</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-7" autocomplete="off"
                                                                form="jobs-filter-form" value="7"><span
                                                                class="text-small">Flutter</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">3</span></li>
                                                    <li><label class="cb-container"><input type=checkbox
                                                                class="submit-form-filter" name=job_skills[]
                                                                id="btn-check-outlined-9" autocomplete="off"
                                                                form="jobs-filter-form" value="9"><span
                                                                class="text-small">React.js</span><span
                                                                class="checkmark"></span></label><span
                                                            class="number-item">3</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 jobs-listing">
                            <div class="content-page job-content-section">
                                <div class="box-filters-job">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-5 jobs-listing-container"><span
                                                class="text-small text-showing showing-of-results"> Showing 1-12 of
                                                51 job(s) </span></div>
                                        <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                                            <div class="display-flex2">

                                                <div class="box-border"><span class="text-sort_by">Sort by:</span>
                                                    <div class="dropdown dropdown-sort"><button
                                                            class="btn dropdown-toggle" id="dropdownSort2" type=button
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            data-bs-display="static"><span>Newest</span><i
                                                                class="fi-rr-angle-small-down"></i></button>
                                                        <ul class="dropdown-menu js-dropdown-clickable dropdown-menu-light"
                                                            aria-labelledby="dropdownSort2">
                                                            <li><a class="dropdown-item dropdown-sort-by active"
                                                                    data-sort-by="newest" href="#"> Newest
                                                                </a></li>
                                                            <li><a class="dropdown-item dropdown-sort-by"
                                                                    data-sort-by="oldest" href="#"> Oldest
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
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up  ">
                                                <div class="card-grid-2-image-left job-item"><span class="flash"></span>
                                                    <div class="image-box"><img src="{{ $job->business->business_logo }}"
                                                            alt="#"></div>
                                                    <div class="right-info"><a class="name-job" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 200px;"
                                                            href="/business/details/{{ $job->business->slug }}" title="{{ $job->business->business_name }}"> {{ $job->business->business_name }} </a><span
                                                            class="location-small"> {{ $job->country }},
                                                            {{ $job->city }} </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="/job/details/{{ $job->slug }}"
                                                            title="{{ $job->job_title }}">{{ $job->job_title }}</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> {{ $job->engagement_type }}
                                                        </span><span class="card-time">{{ $job->created_at->diffForHumans() }}</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">
                                                        {{ strip_tags($job->job_description) }}</p>
                                                    <div class="mt-30">
                                                        <a class="btn btn-grey-small mr-5 mb-2" href="#">Sketch</a>
                                                            <a class="btn btn-grey-small mr-5 mb-2"
                                                            href="#">JavaScript</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price" title="&#8358;{{ number_format($job->minimum_salary, 0) }}
                                                                    -
                                                                    &#8358;{{ number_format($job->maximum_salary, 0) }}">
                                                                    &#8358;{{ number_format($job->minimum_salary, 0) }}
                                                                        -
                                                                        &#8358;{{ number_format($job->maximum_salary, 0) }} </span><span
                                                                    class="text-muted">/{{ $job->salary_rate }}</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class="">
                                                                    <a href="/job/details/{{ $job->slug }}">
                                                                        <button class="btn btn-apply-now"> Apply Now</button>
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
                            {{-- <div class="paginations">
                                <ul class="pager">
                                    <li><a class="pager-prev pagination-button text-center" href="javascript:void(0)"
                                            tabindex="-1"><i class="fi fi-rr-arrow-small-left btn-prev"></i></a></li>
                                    <li><a class="pager-number active" href="javascript:void(0)">1</a></li>
                                    <li><a class="pager-number pagination-button" data-page="2"
                                            href="jobs1560.html?layout=grid&amp;page=2">2</a></li>
                                    <li><a class="pager-number pagination-button" data-page="3"
                                            href="jobsfe37.html?layout=grid&amp;page=3">3</a></li>
                                    <li><a class="pager-number pagination-button" data-page="4"
                                            href="jobs945f.html?layout=grid&amp;page=4">4</a></li>
                                    <li><a class="pager-number pagination-button" data-page="5"
                                            href="jobsc901.html?layout=grid&amp;page=5">5</a></li>
                                    <li><a class="pager-next pagination-button text-center" data-page="2"
                                            href="#"><i class="fi fi-rr-arrow-small-right btn-next"></i></a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</main>

<script type="text/javascript">
    document.getElementById("findjobs").classList.add('active');
</script>
@endsection
