@extends('admin.layouts.app')

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
                    <h1 class="mb-0 h3 fw-bold">Administrative Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <div class="col-lg-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                            <h4 class="fs-6 text-uppercase fw-bold ls-md">Current Subscription</h4>
                            <div>
                                <span
                                    class="bi bi-award-fill fs-3 text-success"></span>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-1">
                            <span class="fs-5">No Active Subscription Found</span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                            <h4 class="fs-6 text-uppercase fw-bold ls-md">Arete Wallet Balance</h4>
                            <div>
                                <span class="bi bi-wallet fs-3 text-success"></span>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-1">&#8358;</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                            <h4 class="fs-6 text-uppercase fw-bold ls-md">Referral Points</h4>
                            <div>
                                <span class="bi bi-balloon-heart-fill fs-3 text-success"></span>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-1"></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2 lh-1">
                            <h4 class="fs-6 text-uppercase fw-bold ls-md">Total Jobs Posted</h4>
                            <div>
                                <span class="bi bi-briefcase-fill fs-3 text-success"></span>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-1"></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div
                    class="card-header align-items-center card-header-height d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Statistics of Customer Interactions and Reach</h4>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Earning chart -->
                    <div id="sessionChart" class="apex-charts"></div>
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
