@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | ' . $job->job_title)

<main class="main">
    <section class="section-box">
        <div class="breadcrumb-cover page_speed_160581955" style="background:url({{ asset('storage/pages/Search.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 class="mb-10" style="color:#fff">{{ $job->job_title }}</h2>
                    </div>
                    <div class="col-lg-3 text-md-end">
                        <ul class="breadcrumbs ">
                            <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                    Home </a></li>
                            <li><a href="/find-jobs">Find Jobs</a></li>
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
                        <h5 class="border-bottom pb-15 mb-30">Job Information</h5>
                        <div class="row">
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/job-single/industry.svg') }}"
                                        alt="Industry">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description industry-icon mb-10">Industry</span><span
                                        class="small-heading"> Content Writer / Market Research / Security Analyst
                                    </span></div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src={{ asset('themes/jobbox/imgs/page/job-single/job-level.svg') }}
                                        alt="Job level">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description joblevel-icon mb-10">Job level</span><strong
                                        class="small-heading">{{ $job->skill_level }} Professional</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/job-single/salary.svg') }}"
                                        alt="Salary"></div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description salary-icon mb-10">Salary</span><strong
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
                                        class="text-description jobtype-icon mb-10">Job type</span><strong
                                        class="small-heading"> {{ $job->engagement_type }} </strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/blog/calendar.svg') }}"
                                        alt="Experience">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description experience-icon mb-10">Application Opens</span><strong
                                        class="small-heading">{{ date_format(new DateTime($job->application_commencement), 'M d, Y') }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/blog/calendar.svg') }}"
                                        alt="Experience">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description experience-icon mb-10">Application
                                        Deadline</span><strong
                                        class="small-heading">{{ date_format(new DateTime($job->application_deadline), 'M d, Y') }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('themes/jobbox/imgs/page/job-single/location.svg') }}"
                                        alt="Location">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description mb-10">Location</span><strong class="small-heading">
                                        {{ $job->country }}, {{ $job->state }},
                                        {{ $job->city }} </strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src={{ asset('themes/jobbox/imgs/page/company/icon-recruitment.svg') }}
                                        alt="Job level">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description joblevel-icon mb-10">Open Positions</span><strong
                                        class="small-heading">{{ $job->open_positions }} Open Positions</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src={{ asset('themes/jobbox/imgs/page/blog/home.svg') }} alt="Job level">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description joblevel-icon mb-10">Work Nature</span><strong
                                        class="small-heading">{{ ucwords($job->location_type) }}</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-15">
                                <div class="sidebar-icon-item"><img
                                        src={{ asset('themes/jobbox/imgs/template/icons/time.svg') }} alt="Job level">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description joblevel-icon mb-10">Duration</span><strong
                                        class="small-heading">{{ $job->duration }}</strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="content-single">
                        <div class="ck-content">
                            <h5>Job Description</h5>
                            <div>
                                <p> @php echo $job->job_description; @endphp </p>
                            </div>

                            <div>
                                @php echo $job->job_requirements; @endphp
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mt-4">
                            <h5 class="mb-3">Skills</h5>
                            <div class="job-details-desc">
                                <div class="mt-4"><span class="badge bg-primary me-1">Laravel</span></div>
                            </div>
                        </div> --}}


                    <div class="single-apply-jobs">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class=""><button class="btn btn-default mr-15"
                                        data-job-name="UI / UX Designer full-time" data-job-id="1"
                                        data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm"> Apply Now
                                    </button></div>
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
                                <div class="sidebar-info"><a
                                        href="/business/details/{{ $job->business->slug }}"><span
                                            class="sidebar-company">{{ $job->business->business_name }}</span></a><a
                                        class="link-underline mt-15"
                                        href="/business/details/{{ $job->business->slug }}">{{ $job->business->jobListing->count() == 0 ? 'No' : $job->business->jobListing->count() }}
                                        Open Jobs</a></div>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <ul class="ul-disc">
                                <li>{{ $job->business->business_address }}</li>
                                <li>Website: <a href="{{ $job->business->website_url }}"
                                        target="_blank">{{ $job->business->website_url }}</a></li>
                                <li>Phone: {{ $job->business->business_phone }}</li>
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
    document.getElementById("findjobs").classList.add('active');
</script>
@endsection
