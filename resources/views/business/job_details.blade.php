@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Job Details')


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
            <div class="card mb-4">
                <!-- card body  -->
                <div class="card-body py-3">
                    <h4 class="card-title">Hired Artisan</h4>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset("assets/images/avatar/avatar-1.jpg") }}" alt=""
                            class="avatar-md avatar rounded-circle" />
                        <div class="ms-3">
                            <h4 class="mb-0">
                                Marvin McKinney
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- card body  -->

            </div>
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
