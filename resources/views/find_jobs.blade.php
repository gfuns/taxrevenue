@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Find Jobs')

    <main class="main">
        <div class="ck-content">
            <div>
                <section class="section-box">
                    <div class="banner-hero hero-2 hero-3">
                        <div class="banner-inner">
                            <div class="block-banner">
                                <h1 class="text-42 color-white wow animate__animated animate__fadeInUp"> The official
                                    <span class="color-green">IT Jobs</span> site </h1>
                                <div class="font-lg font-regular color-white mt-20 wow animate__animated animate__fadeInUp"
                                    data-wow-delay=".1s"> “JobBox is our first stop whenever we're hiring a PHP role.
                                    We've hired 10 PHP developers in the last few years, all thanks to JobBox.” — Andrew
                                    Hall, Elite JSC. </div>
                                <div class="form-find position-relative mt-40 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".2s">
                                    <form method="GET" action="https://jobbox.archielite.com/jobs"
                                        accept-charset="UTF-8"
                                        data-quick-search-url="https://jobbox.archielite.com/ajax/quick-search-jobs">
                                        <div class="box-industry"><select
                                                class="form-input mr-10 select-active input-industry job-category"
                                                name=job_categories[]>
                                                <option value="">Industry</option>
                                            </select></div><select class="form-input mr-10 select-location"
                                            name=location data-location-type="state">
                                            <option value="">Location</option>
                                        </select><input class="form-input input-keysearch mr-10" name=keyword
                                            value="" type=text placeholder="Your keyword...">
                                        <div class="search-btn-group"><button
                                                class="btn btn-default btn-find font-sm">Search</button><button
                                                type=button
                                                class="btn btn-default font-sm btn-advanced-filter">Advanced
                                                Filter</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-60">
                            <div class="box-swiper mt-50">
                                <div class="swiper-container swiper-group-5 swiper">
                                    <div class="swiper-wrapper pb-25 pt-5">
                                        <div class="swiper-slide hover-up"><a
                                                href="job-categories/content-writer.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/content.png
                                                            alt="Content Writer"></div>
                                                    <div class="text-info-right">
                                                        <h4>Content Writer</h4>
                                                        <p class="font-xs"> 51 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a
                                                href="job-categories/market-research.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/research.png
                                                            alt="Market Research"></div>
                                                    <div class="text-info-right">
                                                        <h4>Market Research</h4>
                                                        <p class="font-xs"> 19 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a
                                                href="job-categories/marketing-sale.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/marketing.png
                                                            alt="Marketing &amp; Sale"></div>
                                                    <div class="text-info-right">
                                                        <h4>Marketing &amp; Sale</h4>
                                                        <p class="font-xs"> 12 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a
                                                href="job-categories/customer-help.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/customer.png
                                                            alt="Customer Help"></div>
                                                    <div class="text-info-right">
                                                        <h4>Customer Help</h4>
                                                        <p class="font-xs"> 8 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a href="job-categories/finance.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/finance.png
                                                            alt="Finance"></div>
                                                    <div class="text-info-right">
                                                        <h4>Finance</h4>
                                                        <p class="font-xs"> 12 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a href="job-categories/software.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/lightning.png
                                                            alt="Software"></div>
                                                    <div class="text-info-right">
                                                        <h4>Software</h4>
                                                        <p class="font-xs"> 9 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a
                                                href="job-categories/human-resource.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/human.png
                                                            alt="Human Resource"></div>
                                                    <div class="text-info-right">
                                                        <h4>Human Resource</h4>
                                                        <p class="font-xs"> 6 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a href="job-categories/management.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/management.png
                                                            alt="Management"></div>
                                                    <div class="text-info-right">
                                                        <h4>Management</h4>
                                                        <p class="font-xs"> 15 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a
                                                href="job-categories/retail-products.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/retail.png
                                                            alt="Retail &amp; Products"></div>
                                                    <div class="text-info-right">
                                                        <h4>Retail &amp; Products</h4>
                                                        <p class="font-xs"> 7 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                        <div class="swiper-slide hover-up"><a
                                                href="job-categories/security-analyst.html">
                                                <div class="item-logo">
                                                    <div class="image-left"><img src=storage/general/security.png
                                                            alt="Security Analyst"></div>
                                                    <div class="text-info-right">
                                                        <h4>Security Analyst</h4>
                                                        <p class="font-xs"> 14 <span>Jobs Available</span></p>
                                                    </div>
                                                </div>
                                            </a></div>
                                    </div>
                                    <div class="swiper-pagination swiper-pagination-style-border"></div>
                                </div>
                            </div>
                        </div>
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
                                        <form method="GET" action="https://jobbox.archielite.com/ajax/jobs"
                                            accept-charset="UTF-8" id="jobs-filter-form"
                                            class="sidebar-filter-mobile__content"><input type=hidden name=page
                                                data-value="1"><input type=hidden name=keyword value=""><input
                                                type=hidden name=per_page><input type=hidden name=layout><input
                                                type=hidden name=sort_by>
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
                                                                name=offered_salary_from type=hidden
                                                                value="0"><input
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
                                                                    form="jobs-filter-form"><span
                                                                    class="text-small">Less Than 1 Year</span><span
                                                                    class="checkmark"></span></label><span
                                                                class="number-item">8</span></li>
                                                        <li><label class="cb-container"><input type=checkbox
                                                                    name=job_experiences[] class="submit-form-filter"
                                                                    id="check-job-experience-3" value="3"
                                                                    form="jobs-filter-form"><span class="text-small">1
                                                                    Year</span><span
                                                                    class="checkmark"></span></label><span
                                                                class="number-item">14</span></li>
                                                        <li><label class="cb-container"><input type=checkbox
                                                                    name=job_experiences[] class="submit-form-filter"
                                                                    id="check-job-experience-4" value="4"
                                                                    form="jobs-filter-form"><span class="text-small">2
                                                                    Year</span><span
                                                                    class="checkmark"></span></label><span
                                                                class="number-item">11</span></li>
                                                        <li><label class="cb-container"><input type=checkbox
                                                                    name=job_experiences[] class="submit-form-filter"
                                                                    id="check-job-experience-5" value="5"
                                                                    form="jobs-filter-form"><span class="text-small">3
                                                                    Year</span><span
                                                                    class="checkmark"></span></label><span
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
                                                                    form="jobs-filter-form"><span
                                                                    class="text-small">Last hour</span><span
                                                                    class="checkmark"></span></label></li>
                                                        <li><label class="cb-container"><input type=checkbox
                                                                    class="submit-form-filter" name=date_posted
                                                                    value="last_24_hours"
                                                                    id="date-posted-last_24_hours"
                                                                    form="jobs-filter-form"><span
                                                                    class="text-small">Last 24 hours</span><span
                                                                    class="checkmark"></span></label></li>
                                                        <li><label class="cb-container"><input type=checkbox
                                                                    class="submit-form-filter" name=date_posted
                                                                    value="last_7_days" id="date-posted-last_7_days"
                                                                    form="jobs-filter-form"><span
                                                                    class="text-small">Last 7 days</span><span
                                                                    class="checkmark"></span></label></li>
                                                        <li><label class="cb-container"><input type=checkbox
                                                                    class="submit-form-filter" name=date_posted
                                                                    value="last_14_days" id="date-posted-last_14_days"
                                                                    form="jobs-filter-form"><span
                                                                    class="text-small">Last 14 days</span><span
                                                                    class="checkmark"></span></label></li>
                                                        <li><label class="cb-container"><input type=checkbox
                                                                    class="submit-form-filter" name=date_posted
                                                                    value="last_1_month" id="date-posted-last_1_month"
                                                                    form="jobs-filter-form"><span
                                                                    class="text-small">Last 1 month</span><span
                                                                    class="checkmark"></span></label></li>
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
                                                                    form="jobs-filter-form"><span
                                                                    class="text-small">Full Time</span><span
                                                                    class="checkmark"></span></label><span
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
                                                                    form="jobs-filter-form"><span
                                                                    class="text-small">Part Time</span><span
                                                                    class="checkmark"></span></label><span
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
                                                    <div class="box-border mr-10"><span
                                                            class="text-sort_by">Show:</span>
                                                        <div class="dropdown dropdown-sort"><button
                                                                class="btn dropdown-toggle" id="dropdownSort"
                                                                type=button data-bs-toggle="dropdown"
                                                                aria-expanded="false"
                                                                data-bs-display="static"><span>12</span><i
                                                                    class="fi-rr-angle-small-down"></i></button>
                                                            <ul class="dropdown-menu js-dropdown-clickable dropdown-menu-light"
                                                                aria-labelledby="dropdownSort">
                                                                <li><a class="dropdown-item per-page-item"
                                                                        href="#" data-per-page="12">12</a><a
                                                                        class="dropdown-item per-page-item"
                                                                        href="#" data-per-page="24">24</a><a
                                                                        class="dropdown-item per-page-item"
                                                                        href="#" data-per-page="36">36</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="box-border"><span class="text-sort_by">Sort by:</span>
                                                        <div class="dropdown dropdown-sort"><button
                                                                class="btn dropdown-toggle" id="dropdownSort2"
                                                                type=button data-bs-toggle="dropdown"
                                                                aria-expanded="false"
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
                                                    <div class="box-view-type"><a class="view-type layout-job"
                                                            href="#" data-layout="list"><img
                                                                src=themes/jobbox/imgs/template/icons/icon-list.svg
                                                                alt="List layout"></a><a class="view-type layout-job"
                                                            href="#" data-layout="grid"><img
                                                                src=themes/jobbox/imgs/template/icons/icon-grid.svg
                                                                alt="Grid layout"></a><a
                                                            class="view-type layout-job map" href="#"
                                                            data-layout="map"><img
                                                                src=themes/jobbox/imgs/template/map/map.png
                                                                alt="Map layout"></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row showing-of-results">
                                        <div class="loading-ring">
                                            <div class="loading-ring-wrapper">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up featured-job-item ">
                                                <div class="card-grid-2-image-left"><span class="flash"></span>
                                                    <div class="image-box"><img src=storage/companies/2.png
                                                            alt="Services Sales Representative"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/square.html"> Square </a><span
                                                            class="location-small"> England, UK </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/services-sales-representative.html"
                                                            title="Services Sales Representative">Services Sales
                                                            Representative</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Part Time
                                                        </span><span class="card-time">1 day ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Id ex
                                                        corrupti consequatur quia consequatur excepturi. Vero a
                                                        laudantium vel. Aliquam et sint quasi quibusdam. Fugiat dolores
                                                        dolore et autem aperiam.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/sketch.html">Sketch</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/javascript.html">JavaScript</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price" title="$6,200 - $12,600">
                                                                    $6,200 - $12,600 </span><span
                                                                    class="text-muted">/Yearly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button class="btn btn-apply-now"
                                                                        data-job-name="Services Sales Representative"
                                                                        data-job-id="40" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up ">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src=storage/companies/4.png
                                                            alt="Senior Enterprise Advocate, EMEA"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/dailymotion.html"> Dailymotion </a><span
                                                            class="location-small"> Denmark, DN </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/senior-enterprise-advocate-emea.html"
                                                            title="Senior Enterprise Advocate, EMEA">Senior Enterprise
                                                            Advocate, EMEA</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Contract
                                                        </span><span class="card-time">1 day ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Magni
                                                        itaque corrupti cupiditate. Quae fuga unde mollitia impedit.
                                                        Minus error enim delectus repellendus harum accusamus autem.
                                                        Neque repellat repellendus quis.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/adobe-xd.html">Adobe XD</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/lunacy.html">Lunacy</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price" title="$9,500 - $11,900">
                                                                    $9,500 - $11,900 </span><span
                                                                    class="text-muted">/Yearly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button class="btn btn-apply-now"
                                                                        data-job-name="Senior Enterprise Advocate, EMEA"
                                                                        data-job-id="23" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up featured-job-item ">
                                                <div class="card-grid-2-image-left"><span class="flash"></span>
                                                    <div class="image-box"><img src=storage/companies/1.png
                                                            alt="Senior Solutions Engineer"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/linkedin.html"> LinkedIn </a><span
                                                            class="location-small"> New York, US </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/senior-solutions-engineer.html"
                                                            title="Senior Solutions Engineer">Senior Solutions
                                                            Engineer</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Contract
                                                        </span><span class="card-time">2 days ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Eos
                                                        est quibusdam et aspernatur eum quo animi. Non sequi distinctio
                                                        aperiam commodi. Quo qui qui eum ut ut quia vel. Qui expedita
                                                        est atque velit assumenda laborum.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/sketch.html">Sketch</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/javascript.html">JavaScript</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price"
                                                                    title="$7,000 - $11,200"> $7,000 - $11,200
                                                                </span><span class="text-muted">/Yearly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Senior Solutions Engineer"
                                                                        data-job-id="42" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up ">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src=storage/companies/7.png
                                                            alt="Deal Desk Manager"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/nintendo.html"> Nintendo </a><span
                                                            class="location-small"> Denmark, DN </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a href="jobs/deal-desk-manager.html"
                                                            title="Deal Desk Manager">Deal Desk Manager</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Internship
                                                        </span><span class="card-time">3 days ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Quia
                                                        ut veritatis consequatur quo voluptates autem consectetur. Quo
                                                        error laudantium nesciunt sit inventore recusandae. Dolore nemo
                                                        tenetur corrupti ut.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/sketch.html">Sketch</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/lunacy.html">Lunacy</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price" title="$4,400 - $9,500">
                                                                    $4,400 - $9,500 </span><span
                                                                    class="text-muted">/Hourly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Deal Desk Manager"
                                                                        data-job-id="24" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up ">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src=storage/companies/2.png
                                                            alt="Staff Engineering Manager, Actions"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/adobe-illustrator.html"> Adobe Illustrator
                                                        </a><span class="location-small"> Germany, DN </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/staff-engineering-manager-actions.html"
                                                            title="Staff Engineering Manager, Actions">Staff
                                                            Engineering Manager, Actions</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Freelance
                                                        </span><span class="card-time">3 days ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Est
                                                        nulla nobis necessitatibus natus ipsa soluta. Ab modi quia sint.
                                                        Et ut amet ad dolorem dignissimos modi non qui. Pariatur minus
                                                        nam cum ab tempore.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/illustrator.html">Illustrator</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/php.html">PHP</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price"
                                                                    title="$4,500 - $12,100"> $4,500 - $12,100
                                                                </span><span class="text-muted">/Daily</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Staff Engineering Manager, Actions"
                                                                        data-job-id="15" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up ">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src=storage/companies/5.png
                                                            alt="Digital Marketing Manager"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/toyota.html"> Toyota </a><span
                                                            class="location-small"> Denmark, DN </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/digital-marketing-manager.html"
                                                            title="Digital Marketing Manager">Digital Marketing
                                                            Manager</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Contract
                                                        </span><span class="card-time">3 days ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Vero
                                                        nam asperiores alias qui ut. Facere cupiditate veritatis
                                                        incidunt voluptatem.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/adobe-xd.html">Adobe XD</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/php.html">PHP</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price" title="$8,300 - $8,900">
                                                                    $8,300 - $8,900 </span><span
                                                                    class="text-muted">/Yearly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Digital Marketing Manager"
                                                                        data-job-id="4" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up ">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src=storage/companies/3.png
                                                            alt="Support Engineer (Enterprise Support Japanese)">
                                                    </div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/bing-search.html"> Bing Search </a><span
                                                            class="location-small"> Germany, DN </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/support-engineer-enterprise-support-japanese.html"
                                                            title="Support Engineer (Enterprise Support Japanese)">Support
                                                            Engineer (Enterprise Support Japanese)</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Full Time
                                                        </span><span class="card-time">3 days ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Odit
                                                        reprehenderit expedita perferendis necessitatibus consequuntur.
                                                        Perferendis omnis quam repellat voluptatem. Qui aspernatur
                                                        dolorum voluptas cupiditate voluptas aspernatur ad.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/sketch.html">Sketch</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/javascript.html">JavaScript</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price" title="$900 - $10,200">
                                                                    $900 - $10,200 </span><span
                                                                    class="text-muted">/Hourly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Support Engineer (Enterprise Support Japanese)"
                                                                        data-job-id="37" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up featured-job-item ">
                                                <div class="card-grid-2-image-left"><span class="flash"></span>
                                                    <div class="image-box"><img src=storage/companies/5.png
                                                            alt="Enterprise Account Executive"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/linkedin.html"> Linkedin </a><span
                                                            class="location-small"> Denmark, DN </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/enterprise-account-executive.html"
                                                            title="Enterprise Account Executive">Enterprise Account
                                                            Executive</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Freelance
                                                        </span><span class="card-time">5 days ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">
                                                        Quisquam at et impedit repellendus quia. Dolore et voluptatem
                                                        est unde. Consequuntur aut sint aut similique voluptates odit.
                                                        Facilis dolor et dignissimos.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/figma.html">Figma</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/lunacy.html">Lunacy</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price"
                                                                    title="$7,200 - $15,800"> $7,200 - $15,800
                                                                </span><span class="text-muted">/Weekly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Enterprise Account Executive"
                                                                        data-job-id="34" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up featured-job-item ">
                                                <div class="card-grid-2-image-left"><span class="flash"></span>
                                                    <div class="image-box"><img src=storage/companies/6.png
                                                            alt="Staff Software Engineer"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/quora-jsc.html"> Quora JSC </a><span
                                                            class="location-small"> Germany, DN </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/staff-software-engineer.html"
                                                            title="Staff Software Engineer">Staff Software
                                                            Engineer</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Part Time
                                                        </span><span class="card-time">6 days ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Ipsa
                                                        excepturi velit nihil velit. Nobis eum est deleniti voluptatem.
                                                        Cum vel facere id est dolores hic quaerat. Voluptatibus sequi
                                                        veritatis perspiciatis doloribus eaque facilis.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/adobe-xd.html">Adobe XD</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/lunacy.html">Lunacy</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price"
                                                                    title="$7,100 - $11,100"> $7,100 - $11,100
                                                                </span><span class="text-muted">/Yearly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Staff Software Engineer"
                                                                        data-job-id="18" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up ">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src=storage/companies/3.png
                                                            alt="Senior Software Engineer, npm CLI"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/bing-search.html"> Bing Search </a><span
                                                            class="location-small"> Germany, DN </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/senior-software-engineer-npm-cli.html"
                                                            title="Senior Software Engineer, npm CLI">Senior Software
                                                            Engineer, npm CLI</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Contract
                                                        </span><span class="card-time">6 days ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Et
                                                        est temporibus ut pariatur quis dolorum. Voluptatem commodi
                                                        harum cumque praesentium quos iusto qui. Sint et laudantium
                                                        maxime ipsum. Omnis voluptatem distinctio voluptatibus quo aut
                                                        et nam.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/figma.html">Figma</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/php.html">PHP</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price"
                                                                    title="$6,500 - $10,600"> $6,500 - $10,600
                                                                </span><span class="text-muted">/Weekly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Senior Software Engineer, npm CLI"
                                                                        data-job-id="12" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up featured-job-item ">
                                                <div class="card-grid-2-image-left"><span class="flash"></span>
                                                    <div class="image-box"><img src=storage/companies/8.png
                                                            alt="Senior Cloud Solutions Engineer"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/periscope.html"> Periscope </a><span
                                                            class="location-small"> New York, US </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/senior-cloud-solutions-engineer.html"
                                                            title="Senior Cloud Solutions Engineer">Senior Cloud
                                                            Solutions Engineer</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Internship
                                                        </span><span class="card-time">1 week ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">
                                                        Veniam aliquid officia voluptatem. Tempore autem veritatis id
                                                        qui. Dolor voluptatum temporibus itaque vel nesciunt
                                                        consectetur. Est quis est debitis nulla accusantium incidunt
                                                        voluptas.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/figma.html">Figma</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/javascript.html">JavaScript</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price"
                                                                    title="$7,500 - $16,900"> $7,500 - $16,900
                                                                </span><span class="text-muted">/Yearly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Senior Cloud Solutions Engineer"
                                                                        data-job-id="47" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up featured-job-item ">
                                                <div class="card-grid-2-image-left"><span class="flash"></span>
                                                    <div class="image-box"><img src=storage/companies/1.png
                                                            alt="Analyst Relations Manager, Application Security">
                                                    </div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="companies/linkedin.html"> LinkedIn </a><span
                                                            class="location-small"> New York, US </span></div>
                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="text-truncate"><a
                                                            href="jobs/analyst-relations-manager-application-security.html"
                                                            title="Analyst Relations Manager, Application Security">Analyst
                                                            Relations Manager, Application Security</a></h6>
                                                    <div class="mt-5"><span class="card-briefcase"> Internship
                                                        </span><span class="card-time">1 week ago</span></div>
                                                    <p class="font-sm color-text-paragraph mt-15 job-description">Quod
                                                        et facilis et illo fugit aut. Ipsum corporis odio voluptas eos
                                                        qui et cumque et. Et quia beatae culpa ad. Sint neque sunt et
                                                        iure dolor fugiat.</p>
                                                    <div class="mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/illustrator.html">Illustrator</a><a
                                                            class="btn btn-grey-small mr-5 mb-2"
                                                            href="job-tags/javascript.html">JavaScript</a></div>
                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information"><span
                                                                    class="card-text-price"
                                                                    title="$7,000 - $13,400"> $7,000 - $13,400
                                                                </span><span class="text-muted">/Weekly</span></div>
                                                            <div class="col-12 mt-3">
                                                                <div class=""><button
                                                                        class="btn btn-apply-now"
                                                                        data-job-name="Analyst Relations Manager, Application Security"
                                                                        data-job-id="22" data-bs-toggle="modal"
                                                                        data-bs-target="#ModalApplyJobForm"> Apply Now
                                                                    </button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="paginations">
                                    <ul class="pager">
                                        <li><a class="pager-prev pagination-button text-center"
                                                href="javascript:void(0)" tabindex="-1"><i
                                                    class="fi fi-rr-arrow-small-left btn-prev"></i></a></li>
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
                                                href="#"><i
                                                    class="fi fi-rr-arrow-small-right btn-next"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <script id="traffic-popup-map-template" type=text/x-jquery-tmpl>
                    <div><table width=100%><tr><td width=40><div ><img src=${item.company_logo_thumb} width=40 alt="${item.company_name}"></div></td><td><div class="infomarker"><h5 class="${item.company_url ? '' : 'd-none'}"><a href="${item.company_url}" target="_blank">${item.company_name}</a></h5><div class="text-info"><strong>${item.job_name}</strong></div><div class="text-info"><i class="mdi mdi-account"></i><span>${item.number_of_positions} Vacancy</span><span class="${item.job_type ? '' : 'd-none'}"><span>-</span><span>${item.job_type}</span></span></div><div class="text-muted ${item.full_address ? '' : 'd-none'}"><i class="uil uil-map"></i><span>${item.full_address}</span></div></div></td></tr></table></div>
                </script>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        document.getElementById("findjobs").classList.add('active');
    </script>
    @endsection

