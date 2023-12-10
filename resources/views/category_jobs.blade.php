@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Jobs For '.$category->category_name)

    <main class="main">
        <section class="section-box">
            <div class="breadcrumb-cover page_speed_160581955" style="background:url({{ asset('files/pages/Search.png') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="mb-10" style="color:#fff">{{ ucwords($category->category_name) }}</h2>
                        </div>
                        <div class="col-lg-6 text-md-end">
                            <ul class="breadcrumbs ">
                                <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                        Home </a></li>
                                <li><a href="/job-categories">Categories</a></li>
                                <li>{{ $category->category_name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-box mt-30">
            <div class="container">
                <div class="row flex-row-reverse row-filter justify-content-center">
                    <div class="col-lg-9 col-md-12 col-sm-12 row col-12 float-right jobs-listing">
                        <div class="content-page job-content-section">
                            <div class="box-filters-job">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-5 jobs-listing-container"><span
                                            class="text-small text-showing showing-of-results"> Showing 1-6 of 6 job(s)
                                        </span></div>
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
                                                                data-sort-by="newest" href="#"> Newest </a></li>
                                                        <li><a class="dropdown-item dropdown-sort-by"
                                                                data-sort-by="oldest" href="#"> Oldest </a></li>
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
                                    <div class="card-grid-2 hover-up ">
                                        <div class="card-grid-2-image-left">
                                            <div class="image-box"><img
                                                    src="{{ $job->business_logo }}"
                                                    alt="#"></div>
                                            <div class="right-info"><a class="name-job"
                                                    href="/business/details/{{ $job->slug }}" title="{{ $job->business_name }}" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 200px;"> {{ $job->business_name }}
                                                </a><span class="location-small"> {{ $job->country }},
                                                    {{ $job->city }}  </span></div>
                                        </div>
                                        <div class="card-block-info">
                                            <h6 class="text-truncate"><a
                                                    href="/job/details/{{ $job->slug }}"
                                                    title="{{ $job->job_title }}">{{ $job->job_title }}</a></h6>
                                            <div class="mt-5"><span class="card-briefcase"> {{ $job->engagement_type }} </span><span
                                                    class="card-time">{{ $job->created_at->diffForHumans() }}</span></div>
                                            <p class="font-sm color-text-paragraph mt-15 job-description">{{ $job->job_description }}</p>
                                            <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                    href="#">Sketch</a><a
                                                    class="btn btn-grey-small mr-5 mb-2"
                                                    href="#">Lunacy</a>
                                            </div>
                                            <div class="card-2-bottom mt-30">
                                                <div class="row">
                                                    <div class="col-12 salary-information"><span
                                                            class="card-text-price" title="&#8358;{{ number_format($job->minimum_salary, 0) }}
                                                            -
                                                            &#8358;{{ number_format($job->maximum_salary, 0) }}"> &#8358;{{ number_format($job->minimum_salary, 0) }}
                                                            -
                                                            &#8358;{{ number_format($job->maximum_salary, 0) }} </span><span class="text-muted">/{{ $job->salary_rate }}</span></div>
                                                    <div class="col-12 mt-3">
                                                        <div class="">
                                                            <a href="/job/details/{{ $job->slug }}">
                                                                <button class="btn btn-apply-now"
                                                                > Apply Now
                                                            </button>
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
                    </div>
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
                                        <h5> Advanced Filters <a class="link-reset"
                                                href="https://jobbox.archielite.com/jobs">Reset</a></h5>
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
                                                            form="jobs-filter-form"><span class="text-small">Less Than
                                                            1 Year</span><span class="checkmark"></span></label><span
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
                                                            form="jobs-filter-form"><span class="text-small">Last 24
                                                            hours</span><span class="checkmark"></span></label></li>
                                                <li><label class="cb-container"><input type=checkbox
                                                            class="submit-form-filter" name=date_posted
                                                            value="last_7_days" id="date-posted-last_7_days"
                                                            form="jobs-filter-form"><span class="text-small">Last 7
                                                            days</span><span class="checkmark"></span></label></li>
                                                <li><label class="cb-container"><input type=checkbox
                                                            class="submit-form-filter" name=date_posted
                                                            value="last_14_days" id="date-posted-last_14_days"
                                                            form="jobs-filter-form"><span class="text-small">Last 14
                                                            days</span><span class="checkmark"></span></label></li>
                                                <li><label class="cb-container"><input type=checkbox
                                                            class="submit-form-filter" name=date_posted
                                                            value="last_1_month" id="date-posted-last_1_month"
                                                            form="jobs-filter-form"><span class="text-small">Last 1
                                                            month</span><span class="checkmark"></span></label></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="filter-block mb-20">
                                        <h5 class="medium-heading mb-15">Job type</h5>
                                        <div class="mb-3 ps-custom-scrollbar">
                                            <ul class="list-checkbox">
                                                <li><label class="cb-container"><input type=checkbox
                                                            class="submit-form-filter" value="2" name=job_types[]
                                                            id="check-job-type-2" form="jobs-filter-form"><span
                                                            class="text-small">Freelance</span><span
                                                            class="checkmark"></span></label><span
                                                        class="number-item">12</span></li>
                                                <li><label class="cb-container"><input type=checkbox
                                                            class="submit-form-filter" value="3" name=job_types[]
                                                            id="check-job-type-3" form="jobs-filter-form"><span
                                                            class="text-small">Full Time</span><span
                                                            class="checkmark"></span></label><span
                                                        class="number-item">11</span></li>
                                                <li><label class="cb-container"><input type=checkbox
                                                            class="submit-form-filter" value="4" name=job_types[]
                                                            id="check-job-type-4" form="jobs-filter-form"><span
                                                            class="text-small">Internship</span><span
                                                            class="checkmark"></span></label><span
                                                        class="number-item">10</span></li>
                                                <li><label class="cb-container"><input type=checkbox
                                                            class="submit-form-filter" value="5" name=job_types[]
                                                            id="check-job-type-5" form="jobs-filter-form"><span
                                                            class="text-small">Part Time</span><span
                                                            class="checkmark"></span></label><span
                                                        class="number-item">10</span></li>
                                                <li><label class="cb-container"><input type=checkbox
                                                            class="submit-form-filter" value="1" name=job_types[]
                                                            id="check-job-type-1" form="jobs-filter-form"><span
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
                </div>
            </div>
        </section>
    </main>

    <script type="text/javascript">
        document.getElementById("findjobs").classList.add('active');
    </script>
    @endsection
