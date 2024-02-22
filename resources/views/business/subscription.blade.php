@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Billing & Payments')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Billing & Payments</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Billing & Payments
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
        <div class="col-lg-6 col-md-6 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <div class="d-lg-flex justify-content-between align-items-center card-header">
                    @if (isset($activeSubscription))
                        <div class="mb-3 mb-lg-0">
                            <h3 class="mb-0">Current Plan</h3>
                            <span>Below is your current active plan information.</span>
                        </div>
                        <div>
                            <a href="{{ route('business.subscribe') }}" class="btn btn-outline-primary btn-sm">Switch
                                Subscription Plan</a>
                        </div>
                    @else
                        <div class="mb-3 mb-lg-0">
                            <h3 class="mb-0">You do not have an Active Plan</h3>
                            <span>Please select a subscription plan of your choice.</span>
                        </div>
                        <div>
                            <a href="{{ route('business.subscribe') }}" class="btn btn-outline-primary btn-sm">Select
                                Plan</a>
                        </div>
                    @endif
                </div>
                @if (isset($activeSubscription))
                    <!-- Card body -->
                    <div class="card-body">
                        <h3 class="fw-bold mb-0">
                            &#8358;{{ number_format($activeSubscription->subscription_amount, 2) }}/{{ $activeSubscription->plan->plan }}
                        </h3>
                        <p class="mb-0">
                            Your next monthly charge of
                            <span
                                class="text-success">&#8358;{{ number_format($activeSubscription->subscription_amount, 2) }}</span>
                            will be applied to your primary payment method on
                            <span
                                class="text-success">{{ date_format(new DateTime($activeSubscription->next_due_date), 'jS F, Y') }}</span>
                        </p>
                    </div>
                @endif
            </div>
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Payment Methods</h3>
                    <span>Primary payment method is used by default</span>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush">
                        <!-- List group item -->
                        @foreach ($customerCards as $card)
                            <li class="list-group-item px-0 pb-3 pt-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/images/creditcard/' . preg_replace('/ /', '', $card->card_brand) . '.svg') }}"
                                            alt="card" class="me-3">
                                        <div>
                                            <h5 class="mb-0">{{ ucwords($card->card_brand) }} ending with
                                                {{ $card->last_four_digits }}</h5>
                                            <p class="mb-0 fs-6">Expires on
                                                {{ $card->expiry_month }}/{{ $card->expiry_year }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if ($card->default_card == 1)
                                            <span class="badge bg-success me-4">Primary</span>
                                        @endif
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#"
                                                role="button" id="paymentDropdown" data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="paymentDropdown"
                                                style="">
                                                <span class="dropdown-header">Setting</span>
                                                @if ($card->default_card == 0)
                                                    <a class="dropdown-item"
                                                        href="{{ route('business.defaultCard', [$card->id]) }}">
                                                        <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                        Make it Primary
                                                    </a>
                                                @endif
                                                <a class="dropdown-item"
                                                    href="{{ route('business.deleteCard', [$card->id]) }}"
                                                    onclick="return confirm('Are you sure you want to delete this card?')">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove Card
                                                </a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <!-- button-->
                    <a href="#" class="btn btn-outline-primary mt-4" data-bs-toggle="modal"
                        data-bs-target="#paymentModal">Add Payment Method</a>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-12 mb-4 mb-xl-0">
            <!-- card  -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class="mb-0">Subscription History</h4>
                        <span>Below is a history of all your subscription transactions.</span>
                        <hr />
                    </div>


                </div>

            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("subscription").classList.add('active');
</script>

@endsection

@section('customjs')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('.subscriptionAutoRenew').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var param = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/business/set-auto-renewal",
                data: {
                    'status': status,
                    'param': param
                },
                success: function(data) {
                    if (data.status === 200) {
                        Swal.fire({
                            text: 'Autorenewal Status Updated Successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            toast: true,
                            width: 450,
                            timer: 4000,
                            position: 'top-right'
                        })
                    } else {
                        Swal.fire({
                            text: 'Autorenewal Status Update Failed.',
                            icon: 'error',
                            showConfirmButton: false,
                            toast: true,
                            width: 450,
                            timer: 4000,
                            position: 'top-right'
                        })
                    }
                }
            });
        })
    })
</script>
@endsection
