@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Business Dashboard')
<style type="text/css">
    .candidate-education-content .circle {
        border-radius: 40px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        width: 35px;
    }

    .bg-soft-primary {
        background-color: rgba(118, 109, 244, .15) !important;
        color: #766df4 !important;
    }
</style>

<!-- Page Header -->
<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-lg-flex justify-content-between align-items-center">
                <div class="mb-3 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Business Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-bold ls-md">Total Jobs Posted</span>
                        </div>
                        <div>
                            <span class="bi bi-briefcase-fill fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ number_format($param['jobsPosted'], 0) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-bold ls-md">Total Applicants</span>
                        </div>
                        <div>
                            <span class="bi bi-people-fill fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ number_format($param['totalApplicants'], 0) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-bold ls-md">Arete Wallet Balance</span>
                        </div>
                        <div>
                            <span class="bi bi-wallet fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">&#8358;{{ number_format($param['areteBalance'], 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-bold ls-md">Referral Points</span>
                        </div>
                        <div>
                            <span class="bi bi-balloon-heart-fill fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ number_format($param['referralPoints'], 0) }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div
                    class="card-header align-items-center card-header-height d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Statistics of Active Applicants</h4>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Earning chart -->
                    <div id="earning" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-4">
            <!-- Card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header d-flex align-items-center justify-content-between card-header-height">
                    <h4 class="mb-0">Job Listing</h4>
                    <a href="{{ route('business.jobListing') }}" class="btn btn-outline-secondary btn-sm">View All</a>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush">
                        @foreach ($latestJobs as $job)
                            <li class="list-group-item px-0 pt-0 mb-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="candidate-education-content d-flex">
                                            <div class="circle flex-shrink-0 bg-soft-primary">
                                                {{ strtoupper(Str::substr($job->job_title, 0, 1)) }} </div>
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5">{{ $job->job_title }}</h4>
                                        <span class="me-2 fs-6">
                                            <span class="text-dark me-1 fw-semibold">Date Posted:</span>
                                            {{ date_format($job->created_at, 'jS F, Y') }}
                                        </span>
                                    </div>

                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-4">
            <!-- Card -->
            <div class="card ">
                <!-- Card header -->
                <div class="card-header d-flex align-items-center justify-content-between card-header-height">
                    <h4 class="mb-0">Job Applications</h4>
                    <a href="{{ route('business.allJobApplications') }}" class="btn btn-outline-secondary btn-sm">View
                        All</a>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush">
                        @foreach ($latestApplications as $app)
                            <li class="list-group-item px-0 pt-0 mb-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-md avatar-indicators avatar-online">
                                            <img alt="avatar" src="{{ $app->artisan->customer->photo }}"
                                                class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5">
                                            {{ $app->artisan->customer->first_name . ' ' . $app->artisan->customer->last_name }}
                                        </h4>
                                        <span class="me-2 fs-6">
                                            {{ $app->artisan->profession }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-4">
            <!-- Card -->
            <div class="card h-100">
                <!-- Card header -->
                <div class="card-header card-header-height d-flex align-items-center">
                    <h4 class="mb-0">Transactions</h4>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list-timeline-activity">
                        <li class="list-group-item px-0 pt-0 border-0 mb-2">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <img alt="avatar" src="../../assets/images/avatar/avatar-6.jpg"
                                            class="rounded-circle">
                                    </div>
                                </div>
                                <div class="col ms-n2">
                                    <h4 class="mb-0 h5">Dianna Smiley</h4>
                                    <p class="mb-1">Just buy the courses”Build React Application Tutorial”</p>
                                    <span class="fs-6">2m ago</span>
                                </div>
                            </div>
                        </li>
                        <!-- List group -->
                        <li class="list-group-item px-0 pt-0 border-0 mb-2">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-md avatar-indicators avatar-offline">
                                        <img alt="avatar" src="../../assets/images/avatar/avatar-7.jpg"
                                            class="rounded-circle">
                                    </div>
                                </div>
                                <div class="col ms-n2">
                                    <h4 class="mb-0 h5">Irene Hargrove</h4>
                                    <p class="mb-1">Comment on “Bootstrap Tutorial” Says “Hi,I m irene...</p>
                                    <span class="fs-6">1 hour ago</span>
                                </div>
                            </div>
                        </li>
                        <!-- List group -->
                        <li class="list-group-item px-0 pt-0 border-0 mb-2">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-md avatar-indicators avatar-busy">
                                        <img alt="avatar" src="../../assets/images/avatar/avatar-4.jpg"
                                            class="rounded-circle">
                                    </div>
                                </div>
                                <div class="col ms-n2">
                                    <h4 class="mb-0 h5">Trevor Bradle</h4>
                                    <p class="mb-1">Just share your article on Social Media..</p>
                                    <span class="fs-6">2 month ago</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0 border-0">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-md avatar-indicators avatar-away">
                                        <img alt="avatar" src="../../assets/images/avatar/avatar-1.jpg"
                                            class="rounded-circle">
                                    </div>
                                </div>
                                <div class="col ms-n2">
                                    <h4 class="mb-0 h5">John Deo</h4>
                                    <p class="mb-1">Just buy the courses”Build React Application Tutorial”</p>
                                    <span class="fs-6">2m ago</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    //document.getElementById("navDashboard").classList.add('show');
    document.getElementById("dashboard").classList.add('active');
</script>

@endsection
