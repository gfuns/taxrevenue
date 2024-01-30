@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Subscriptions')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
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
        <div class="col-xl-6 col-12 mb-4 mb-xl-0">
            <!-- card  -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class="mb-0">Active Subscription Details</h4>
                    </div>
                    <!-- text -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span>Subscribed Plan:</span>
                        <span class="text-dark">{{ $activeSubscription->plan->plan }} Plan
                            ({{ $activeSubscription->plan->duration }} Days)</span>
                    </div>
                    <!-- text -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span>Subscription Fee:</span>
                        <span
                            class="text-dark">&#8358;{{ number_format($activeSubscription->subscription_amount, 2) }}</span>
                    </div>
                    <!-- text -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span>Payment Method:</span>
                        <span class="text-dark">{{ ucwords($activeSubscription->card->card_brand) }} Card</span>
                    </div>
                    <!-- text -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span>Card Number:</span>
                        <span class="text-dark">xxxx xxxx xxxx {{ $activeSubscription->card->last_four_digits }}</span>
                    </div>
                    <!-- text -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span>Status:</span>
                        <span class="text-dark">{{ ucwords($activeSubscription->status) }}</span>
                    </div>
                    <!-- text -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span>Date Subscribed:</span>
                        <span class="text-dark">{{ date_format($activeSubscription->created_at, 'jS F, Y') }}</span>
                    </div>
                    <!-- text -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span>Renewal Date:</span>
                        <span
                            class="text-dark">{{ date_format(new DateTime($activeSubscription->next_due_date), 'jS F, Y') }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span>Auto Renew Status:</span>
                        <div>
                            <div class="form-check form-switch">
                                <input data-id="{{ $activeSubscription->id }}" type="checkbox"
                                    class="form-check-input subscriptionAutoRenew" id="autorenew"
                                    @if ($activeSubscription->auto_renew == 1) checked="" @endif>
                                <label class="form-check-label" for="autorenew"></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <a href="{{ route('business.subscribe') }}"><button class="btn btn-primary"
                                type="submit">Change Plan</button></a>
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
