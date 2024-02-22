@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | ' . $job->job_title)
<style>
    .bs-icon{
        color: #690068;
    }
    .bs-icon:hover {
        color: #FEBA00
    }
</style>
<main class="main">
    <section class="section-box">
        <div class="breadcrumb-cover page_speed_160581955" style="background:url({{ asset('files/pages/Search.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="mb-10" style="color:#fff">{{ $job->job_title }}</h2>
                    </div>
                    <div class="col-lg-3 text-md-end">
                        <ul class="breadcrumbs ">
                            <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                    Home </a></li>
                            <li><a href="/job-portal">Job Portal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-50 job-detail-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12 col-lg-8">
                    <div class="job-overview">
                        <h5 class="border-bottom pb-15 mb-30">Job Details</h5>
                        <div class="row">
                            <div class="col-md-12 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/job-single/industry.svg') }}"
                                        alt="Industry">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description industry-icon mb-10">Job Title</span><span
                                        class="small-heading"> {{ $job->job_title }}
                                    </span></div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/job-single/location.svg') }}"
                                        alt="Location">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description mb-10">Location</span><strong class="small-heading">
                                        {{ $job->location == "remote" ? "Remote" : ($job->location == "hybrid" ? "Hybrid" : ($job->state.", ".$job->country)) }} </strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/job-single/salary.svg') }}"
                                        alt="Salary"></div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description salary-icon mb-10">Renumeration</span><strong
                                        class="small-heading">&#8358;{{ number_format($job->minimum_salary, 0) }} -
                                        &#8358;{{ number_format($job->maximum_salary, 0) }}
                                        /{{ $job->salary_rate }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/job-single/job-type.svg') }}"
                                        alt="Job type">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description jobtype-icon mb-10">Engagement Type</span><strong
                                        class="small-heading"> {{ $job->engagement_type }} </strong></div>
                            </div>

                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/blog/calendar.svg') }}"
                                        alt="Experience">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description experience-icon mb-10">Date
                                        Posted</span><strong
                                        class="small-heading">{{ $job->created_at->diffForHumans() }}</strong>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="content-single">
                        <div class="ck-content">
                            <h5>Company Description</h5>
                            <div>
                                <p> @php echo $job->company_description; @endphp </p>
                            </div>

                            <div>
                                @php echo $job->job_requirements; @endphp
                            </div>
                        </div>
                    </div>
                    <div class="content-single">
                        <div class="ck-content">
                            <h5>Job Description</h5>
                            <div>
                                <p> @php echo $job->job_description; @endphp </p>
                            </div>

                        </div>
                    </div>


                    <div class="single-apply-jobs">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="">
                                    <a href="{{ $job->application_url }}" target="_blank">
                                        <button class="btn btn-default mr-15"> Apply Now </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <div class="avatar-sidebar">
                                <figure><a href="/business/details/{{ $job->business->slug }}"><img alt="#"
                                            src="{{ $job->business->business_logo }}" /></a></figure>
                                <div class="sidebar-info">
                                    <a
                                        href="/business/details/{{ $job->business->slug }}"><span
                                            class="sidebar-company">{{ $job->business->business_name }}</span></a>
                                            <a
                                        class="link-underline mt-10 mb-2"
                                        href="/business/details/{{ $job->business->slug }}">{{ $job->business->state.", ".$job->business->country }}</a>

                                        @php
                                        $unrated = 5 - $job->business->rating;
                                    @endphp
                                    @for ($i = 1; $i <= $job->business->rating; $i++)
                                        <img alt="star" class="rating-star"
                                            src={{ asset('themes/jobbox/imgs/template/icons/star.svg') }}>
                                    @endfor
                                    @for ($i = 1; $i <= $unrated; $i++)
                                        <img alt="star" class="rating-star"
                                            src="{{ asset('themes/jobbox/imgs/template/icons/gray-star.svg') }}">
                                    @endfor

                                    <span
                                        class="font-xs color-text-mutted ml-10"><span>(</span><span>{{ $job->business->reviews->count() }}</span><span>)</span></span>
                                    </div>
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
                                        <strong class="small-heading">{{ $job->business->business_email }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item">
                                        <i class="fi-rr-phone-call"></i>
                                    </div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Phone Number</span>
                                        <strong class="small-heading">{{ $job->business->business_phone }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item">
                                        <i class="fi-rr-map-marker-home"></i>
                                    </div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Contact Address</span>
                                        <strong class="small-heading">{{ $job->business->business_address }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-globe"></i></div>
                                    <div class="sidebar-text-info">
                                        <span class="text-description">Website</span>
                                        <a href="{{ $job->business->website_url }}" target="_blank">
                                            <strong class="small-heading">{{ $job->business->website_url }}</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-border">
                        <h6 class="f-18">Similar Jobs</h6>
                        <div class="sidebar-list-job">
                            <ul>
                                @foreach ($similarJobs as $sjob)
                                    <li>
                                        <div
                                            class="card-list-4 wow animate__ animate__fadeIn hover-up animated page_speed_1597169048">
                                            <div class="image"><a
                                                    href="/business/details/{{ $sjob->business->slug }}"><img
                                                        src="{{ $sjob->business->business_logo }}" width=50
                                                        alt="#"></a>
                                            </div>
                                            <div class="info-text">
                                                <h5 class="font-md font-bold color-brand-1 mb-2"><a
                                                        href="/job/details/{{ $sjob->slug }}">{{ $sjob->job_title }}</a>
                                                </h5>
                                                <div
                                                    class="d-flex align-items-center gap-3 font-xs color-text-mutted mt-0">
                                                    <span class="fi-icon"><i class="fi-rr-briefcase"></i>
                                                        {{ $sjob->engagement_type }}
                                                    </span><span class="fi-icon"><i class="fi-rr-clock"></i><time
                                                            datetime="{{ date_format(new DateTime($sjob->application_commencement), 'dd/mm/YYYY') }}">
                                                            {{ date_format(new DateTime($sjob->application_commencement), 'M d, Y') }}
                                                        </time></span>
                                                </div>
                                                <div class="mt-6">
                                                    <div class="similar-jobs-content">
                                                        <div class="d-flex align-items-center job-information">
                                                            <div class="job-location"><span
                                                                    class="card-location">{{ $job->country }},
                                                                    {{ $job->city }}</span></div>
                                                            <div class="job-salary">
                                                                <h6 class="card-price text-nowrap mb-0"><span
                                                                        class="card-text-price"
                                                                        title="&#8358;{{ number_format($sjob->minimum_salary, 0) }} -
                                                                        &#8358;{{ number_format($sjob->maximum_salary, 0) }}">
                                                                        &#8358;{{ number_format($sjob->minimum_salary, 0) }}
                                                                        -
                                                                        &#8358;{{ number_format($sjob->maximum_salary, 0) }}
                                                                    </span><span
                                                                        class="text-muted">/{{ $sjob->salary_rate }}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<script type="text/javascript">
    document.getElementById("jobportal").classList.add('active');
</script>
@endsection
