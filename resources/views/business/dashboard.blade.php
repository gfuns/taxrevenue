@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Contractor Dashboard')
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

    .bg-soft-success {
        background-color: #d1f5ea !important;
        color: #20c997 !important;
    }

    .bg-soft-danger {
        background-color: #fad9d8 !important;
        color: #dc3545 !important;
    }
</style>

<!-- Page Header -->
<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-lg-flex justify-content-between align-items-center">
                <div class="mb-3 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Contractor Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="row col-lg-12 col-12" style="margin: 0px !important; padding: 0px !important">
            <div class="col-lg-4 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                            <h4 class="fs-6 text-uppercase fw-bold ls-md">Registration Status</h4>
                            <div>
                                <span class="bi bi-check-circle-fill fs-3 text-success"></span>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-1">
                            <span class="fs-5">{{ ucwords(Auth::user()->company->status) }}</span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                            <h4 class="fs-6 text-uppercase fw-bold ls-md">Renewal Due Date</h4>
                            <div>
                                <span class="bi bi-calendar3 fs-3 text-success"></span>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-1">
                            <span
                                class="fs-5">{{ date_format(new DateTime(Auth::user()->company->nextRenewal()), 'jS F, Y') }}</span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                            <h4 class="fs-6 text-uppercase fw-bold ls-md">Ongoing Contract Awarded</h4>
                            <div>
                                <span class="bi bi-tools fs-3 text-success"></span>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-1">
                            <span class="fs-5">No Active Awarded Contract</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-12 d-none d-md-block p-3">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div
                    class="card-header align-items-center card-header-height d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Quick Links</h4>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <div class="row col-lg-12 col-12">
                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <a href="{{ route('business.companyRenewals') }}">
                                <div class="card mb-4" style="background: #023a1f">
                                    <!-- Card body -->
                                    <div class="p-3">
                                        <h4 class="fs-6 text-uppercase fw-bold ls-md text-white text-center">Renew
                                            License</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <a href="{{ route('business.powerOfAttorney') }}">
                                <div class="card mb-4" style="background: #023a1f">
                                    <!-- Card body -->
                                    <div class="p-3">
                                        <h4 class="fs-6 text-uppercase fw-bold ls-md text-white text-center">Apply For
                                            Power
                                            of Attorney</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <a href="{{ route('business.processingFees') }}">
                                <div class="card mb-4" style="background: #023a1f">
                                    <!-- Card body -->
                                    <div class="p-3">
                                        <h4 class="fs-6 text-uppercase fw-bold ls-md text-white text-center">Remit 1%
                                            Processing
                                            Fee</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <a href="{{ route('business.awardLetters') }}">
                                <div class="card mb-4" style="background: #023a1f">
                                    <!-- Card body -->
                                    <div class="p-3">
                                        <h4 class="fs-6 text-uppercase fw-bold ls-md text-white text-center">Apply For
                                            Award Letter</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <a href="{{ route('business.viewCertificate', [preg_replace("/\//", "-", Auth::user()->company->bsppc_number)]) }}" target="_blank">
                                <div class="card mb-4" style="background: #023a1f">
                                    <!-- Card body -->
                                    <div class="p-3">
                                        <h4 class="fs-6 text-uppercase fw-bold ls-md text-white text-center">View
                                            Certificate</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-12 col-12">
                            <!-- Card -->
                            <a href="{{ route('business.security') }}">
                                <div class="card mb-4" style="background: #023a1f">
                                    <!-- Card body -->
                                    <div class="p-3">
                                        <h4 class="fs-6 text-uppercase fw-bold ls-md text-white text-center">Account
                                            Security</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
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
