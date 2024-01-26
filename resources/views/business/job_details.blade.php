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
                                <a href="{{ route("business.jobListing") }}">Jobs</a>
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
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('business.jobAssets', [$job->id]) }}">Files and Assets</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('business.jobApplications', [$job->id]) }}">Applications</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-12 mb-4 mb-xl-0">
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
                        <h4 class="mb-2">Job Description</h4>
                        <p>@php echo $job->job_description; @endphp</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="mb-2">Job Requirements</h4>
                        <p> @php echo $job->job_requirements;  @endphp</p>
                    </div>
                </div>
            </div>

            <!-- card  -->
            <div class="card mb-4">
                <!-- card body  -->
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-calendar fs-3" style="color: #754ffe"></i>
                            <div class="ms-2">
                                <h5 class="mb-0 text-body">Application Commencement</h5>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-dark mb-0 fw-semibold">
                                    {{ date_format(new DateTime($job->application_commencement), 'j M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card body  -->
                <div class="card-body border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-calendar fs-3" style="color: #754ffe"></i>
                            <div class="ms-2">
                                <h5 class="mb-0 text-body">Application Deadline</h5>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-dark mb-0 fw-semibold">
                                    {{ date_format(new DateTime($job->application_deadline), 'j M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card body  -->
                <div class="card-body border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-clock fs-3" style="color: #754ffe"></i>
                            <div class="ms-2">
                                <h5 class="mb-0 text-body">Duration</h5>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-dark mb-0 fw-semibold">{{ $job->duration }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card body  -->
                <div class="card-body border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span style="color: #754ffe; font-size: 20px"><b>&#8358;</b></span>
                            <div class="ms-2">
                                <h5 class="mb-0 text-body">Budget</h5>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-dark mb-0 fw-semibold">
                                    {{ $job->currency }}{{ number_format($job->minimum_salary) }} -
                                    {{ $job->currency }}{{ number_format($job->maximum_salary) }}
                                    {{ $job->salary_rate }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-briefcase fs-3" style="color: #754ffe"></i>
                            <div class="ms-2">
                                <h5 class="mb-0 text-body">Engagement Type</h5>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-dark mb-0 fw-semibold">{{ $job->engagement_type }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-feather fs-3" style="color: #754ffe"></i>
                            <div class="ms-2">
                                <h5 class="mb-0 text-body">Skill Level</h5>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-dark mb-0 fw-semibold">{{ $job->skill_level }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-flag fs-3" style="color: #754ffe"></i>
                            <div class="ms-2">
                                <h5 class="mb-0 text-body">Languages</h5>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-dark mb-0 fw-semibold">{{ $job->getOriginalLanguages() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fe fe-map-pin fs-3" style="color: #754ffe"></i>
                            <div class="ms-2">
                                <h5 class="mb-0 text-body">Work Location</h5>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="text-dark mb-0 fw-semibold">
                                    {{ $job->location_type == 'remote' ? 'Remote' : $job->city . ', ' . $job->country }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12">
            <!-- card  -->
            @php
                $application = \App\Models\JobApplication::where("job_listing_id", $job->id)->where("hiring_status", "Hired")->first();
            @endphp
            @if(isset($application))
            <div class="card mb-4">
                <!-- card body  -->
                <div class="card-body">
                    <h4 class="card-title" style="color:black">Hired Artisan's Profile</h4>
                    <hr />
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt=""
                                class="avatar-md avatar rounded-circle" />
                            <div class="ms-3">
                                <h4 class="mb-0">
                                    {{ $application->artisan->customer->first_name . ' ' . $application->artisan->customer->last_name }}
                                </h4>
                                <small style="color:black"><b>{{ $application->artisan->profession }}</b></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p>{{ $application->artisan->biography }}</p>
                    </div>

                    <div class="mb-4">
                        @if (isset($application->artisan->skills))
                            <p style="color:black"><strong>Skills</strong></p>
                            <div class="tags">
                                @php
                                    $skills = explode(', ', $application->artisan->skills);
                                @endphp
                                @foreach ($skills as $tag)
                                    <a class="btn btn-tag mb-3" style="cursor: pointer">{{ $tag }}</a>&nbsp;
                                @endforeach
                            </div>
                        @endif

                    </div>

                    <div class="mb-4">
                        <div class="container">
                            <!-- row -->
                            <div class="row">
                                <div class="col-4 border-top-md border-bottom border-end-md border-start-lg">
                                    <!-- text -->
                                    <div class="py-1 pt-3 text-center">
                                        <div class="mb-3">
                                            <i class="fe fe-award" style="color: #690068; font-size: 24px"> </i>
                                        </div>
                                        <div class="lh-1">
                                            <h4 class="mb-1">{{ number_format($application->artisan->jobs_done) }}
                                            </h4>
                                            <span>Jobs Done</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-4 border-top-md border-bottom border-end-lg ">
                                    <!-- icon -->
                                    <div class="py-1 pt-3 text-center">
                                        <div class="mb-3">
                                            <i class="fe fe-calendar" style="color: #690068; font-size: 24px"> </i>
                                        </div>
                                        <!-- text -->
                                        <div class="lh-1">
                                            <h4 class="mb-1">
                                                {{ date_format($application->artisan->created_at, 'M, Y') }}</h4>
                                            <span>Member Since</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-4 border-top-lg border-bottom border-end-md ">
                                    <!-- icon -->
                                    <div class="py-1 pt-3 text-center">
                                        <div class="mb-3">
                                            <i class="fe fe-star" style="color: #690068; font-size: 24px"> </i>
                                        </div>
                                        <!-- text -->
                                        <div class="lh-1">
                                            <h4 class="mb-1">{{ number_format($application->artisan->review) }}</h4>
                                            <span>Positive Reviews</span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endif
            <!-- card  -->
            <div class="card mb-4">
                <!-- card body -->

                <div class="card-header">
                    <h4 class="mb-0">Project Milestones</h4>
                </div>
                <!-- table -->
                <div class="table-responsive overflow-y-hidden">
                    <table class="table mb-0 text-nowrap table-hover table-centered">
                        <thead class="table-light">
                            <tr>
                                <th>Milestone</th>
                                <th>Budget</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Design a Geeks UI Figma</td>
                                <td>&#8358;1,000</td>
                                <td>30 Aug, 2021</td>
                                <td>Pending</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- card  -->

        </div>
    </div>
</section>
<script type="text/javascript">
    document.getElementById("jobs").classList.add('active');
</script>

@endsection
