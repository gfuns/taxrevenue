@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Job Details')
<style>
    .btn-tag {
        background: #E0E6F7;
        color: #690068;
        padding: 3px 10px;
        font-size: 12px;
    }

    .btn-tag:hover {
        background: #690068;
        color: #fff
    }

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

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 mb-2">
            <!-- Page header -->
            <div class="d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Job Details</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.jobListing') }}">Jobs</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Job Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <!-- nav  -->
            <ul class="nav nav-lb-tab">
                <li class="nav-item ms-0 me-3">
                    <a class="nav-link active" href="{{ route('business.jobDetails', [$job->id]) }}">Overview</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9 col-12 mb-4 mb-xl-0">
            <!-- card  -->
            <div class="card mb-4">
                <!-- card body  -->
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="mb-2">Job Title</h4>
                        <p>
                            {{ $job->job_title }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <h4 class="mb-2">Work Location</h4>
                        <p>
                            {{ ucwords($job->location) }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <h4 class="mb-2">Engagement Type</h4>
                        <p>
                            {{ $job->engagement_type }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <h4 class="mb-2">Renumeration</h4>
                        <p>

                                &#8358;{{ number_format($job->minimum_salary) }} -
                                &#8358;{{ number_format($job->maximum_salary) }} /
                                {{ $job->salary_rate }}

                        </p>
                    </div>
                    <div class="mb-4">
                        <h4 class="mb-2">Application URL</h4>
                        <p>
                            {{ $job->application_url }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <h4 class="mb-2">Office Address</h4>
                        <p>
                            {{ $job->office_address }}, {{ $job->state }}, {{ $job->country }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <h4 class="mb-2">Company Description</h4>
                        <p>@php echo $job->company_description; @endphp</p>
                    </div>

                    <div class="mb-4">
                        <h4 class="mb-2">Job Description</h4>
                        <p>@php echo $job->job_description; @endphp</p>
                    </div>
                </div>
            </div>


        </div>

    </div>
</section>



<script type="text/javascript">
    document.getElementById("jobs").classList.add('active');
</script>

@endsection
