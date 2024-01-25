@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Application Details')
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
                    <h1 class="mb-0 h2 fw-bold">Application Details</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.allJobApplications') }}">Applications</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Application Details</li>
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
                    {{-- <a class="nav-link active" style="cursor: pointer">Overview</a> --}}
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
                    <h4 class="card-title" style="color:black">Applicant's Profile</h4>
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

                    <hr />

                    <div class="mb-4">

                        <p style="color:black"><strong>Application Cover Letter</strong><br />

                            {{ $application->cover_letter }}
                        </p>


                    </div>
                </div>
            </div>

            <!-- card  -->
            <div class="card mb-4">
                <div class="card-body py-3">
                    <h4 class="card-title" style="color:black">Applicant's Work Experience</h4>
                    <hr />

                    <div class="candidate-education-details ">
                        @foreach (\App\Models\WorkExperience::orderBy('id', 'desc')->where('artisan_id', $application->artisan->id)->get() as $experience)
                            <div class="candidate-education-content mt-4 d-flex">
                                <div class="circle flex-shrink-0 bg-soft-primary">
                                    {{ strtoupper(Str::substr($experience->job_title, 0, 1)) }} </div>
                                <div class="ms-2">
                                    <h5 class="fs-16 mb-1"><b>{{ $experience->job_title }}</b></h5>
                                    <p class="mb-2" style="color:black">{{ $experience->employer }} -
                                        ({{ date_format(new DateTime($experience->start_date), 'M, Y') }} -
                                        {{ $experience->end_date == null ? 'Till Date' : date_format(new DateTime($experience->end_date), 'M, Y') }})
                                    </p>
                                    <p class="text-muted">{{ $experience->description }}</p>
                                </div>
                            </div>
                            <hr />
                        @endforeach
                    </div>


                </div>
            </div>

        </div>
        <div class="col-xl-6 col-12">

            <div class="card mb-4">
                <div class="card-body py-3">
                    <h4 class="card-title" style="color:black">Academic History</h4>
                    <hr />

                    <div class="candidate-education-details">
                        @foreach (\App\Models\EducationalHistory::orderBy('id', 'desc')->where('artisan_id', $application->artisan->id)->get() as $education)
                            <div class="candidate-education-content mt-4 d-flex">
                                <div class="circle flex-shrink-0 bg-soft-primary">
                                    {{ strtoupper(Str::substr($education->discipline, 0, 1)) }} </div>
                                <div class="ms-2">
                                    <h5 class="fs-16 mb-1"><b>{{ $education->discipline }}
                                            ({{ $education->degree }})
                                        </b></h5>
                                    <p class="mb-2" style="color:black">{{ $experience->employer }} -
                                        ({{ date_format(new DateTime($education->start_date), 'M, Y') }} -
                                        {{ $education->end_date == null ? 'Till Date' : date_format(new DateTime($education->end_date), 'M, Y') }})
                                    </p>
                                    <p class="text-muted">{{ $education->description }}</p>
                                </div>
                            </div>
                            <hr />
                        @endforeach
                    </div>


                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body py-3">
                    <h4 class="card-title" style="color:black">Portfolio</h4>
                    <hr />

                    <div class="">
                        <div class="container">
                            <!-- row -->
                            <div class="row">
                                @foreach (\App\Models\ArtisanPortfolio::where('artisan_id', $application->artisan->id)->get() as $portfolio)
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                        <!-- card -->
                                        <div class="card mb-4 card-hover">
                                            <!-- img -->
                                            <div class="">
                                                <a href="{{ $portfolio->portfolio_url }}" target="_blank"
                                                    class="text-inherit"><img src="{{ $portfolio->file }}"
                                                        alt="" class="card-img-top img-fluid"></a>
                                            </div>
                                            <!-- card body -->

                                                <h5 class="mt-2 ms-2 fw-semibold">
                                                    <a href="{{ $portfolio->portfolio_url }}" target="_blank"
                                                        class="text-inherit">{{ $portfolio->title }}</a>
                                                </h5>

                                        </div>
                                    </div>
                                @endforeach

                                <!-- btn -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    document.getElementById("applications").classList.add('active');
</script>

@endsection
