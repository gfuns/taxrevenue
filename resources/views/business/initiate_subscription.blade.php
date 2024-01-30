@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Subscriptions')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Subscriptions</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Subscriptions
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <div class="col-xl-7 col-12 mb-4 mb-xl-0">
            <!-- card  -->
            <div class="card">
                <!-- card body  -->
                <div class="card-body">
                    <div class="mb-4">
                        <p>
                            Choose the plan that's right for your business. Whether you're just getting starting or well
                            down the path to scaling, we've got you covered.
                        </p>
                    </div>
                    <div class="mb-4">
                        <h4 class="mb-4">What You Will Get:</h4>
                        <!-- list  -->
                        <ul class="list-group list-group-flush list-timeline-activity">
                            <li class="list-group-item px-0 pt-0 border-0 pb-6">
                                <div class="row position-relative">
                                    <div class="col-auto">
                                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-circle">
                                            <i class="fe fe-check"></i>
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5">Unlimited Job Posting</h4>
                                        <p class="mb-0 text-body">Post as many job listings as you need, without any
                                            limitations, and connect with the perfect candidates for your project.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0 pt-0 border-0 pb-6">
                                <div class="row position-relative">
                                    <div class="col-auto">
                                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-circle">
                                            <i class="fe fe-check"></i>
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5">Custom Contract</h4>
                                        <p class="mb-0 text-body">Tailor contracts to your unique needs, ensuring
                                            flexibility and clarity in your agreements with potential hires.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0 pt-0 border-0 pb-6">
                                <div class="row position-relative">
                                    <div class="col-auto">
                                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-circle">
                                            <i class="fe fe-check"></i>
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5">Milestone Payment</h4>
                                        <p class="mb-0 text-body">
                                            Facilitate secure and transparent transactions by breaking down payments
                                            into milestones, ensuring work is completed to satisfaction.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0 pt-0 border-0 pb-6">
                                <div class="row position-relative">
                                    <div class="col-auto">
                                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-circle">
                                            <i class="fe fe-check"></i>
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5">Artisan Hiring</h4>
                                        <p class="mb-0 text-body">
                                            Discover and hire skilled artisans for your projects, fostering a community
                                            of talented individuals ready to bring your vision to life
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0 pt-0 border-0">
                                <div class="row position-relative">
                                    <div class="col-auto">
                                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-circle">
                                            <i class="fe fe-check"></i>
                                        </div>
                                    </div>
                                    <div class="col ms-n3">
                                        <h4 class="mb-0 h5">Support</h4>
                                        <p class="mb-0 text-body">Receive dedicated support throughout your hiring
                                            process, ensuring a smooth and successful experience for both employers and
                                            candidates</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-12">
            <!-- card  -->
            @foreach ($subscriptionPlans as $plan)
                <div class="card mb-4">
                    <!-- card body  -->
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <h4 class="mb-2">
                                    {{ $plan->plan }}
                                    <small>({{ $plan->duration }} Days)</small>
                                </h4>
                                <h4 class="mb-4">
                                    &#8358; {{ number_format($plan->billing_amount, 2) }}
                                </h4>
                                <a href="{{ route("business.previewSubscription", [$plan->id]) }}"><button class="btn btn-primary btn-sm" style="background: #690068; border: #690068">Subscribe Now</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("subscription").classList.add('active');
</script>

@endsection
