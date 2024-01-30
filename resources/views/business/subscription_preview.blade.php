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
        <div class="col-xl-6 col-12 mb-4 mb-xl-0">
            <!-- card  -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">

                    <div>

                        <h3 class="mb-4">Details Of Selected Plan:</h3>
                        <hr />
                        <!-- list -->
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between mb-2">
                                <span class="text-dark">Plan Type</span>
                                <span class="text-dark fw-medium">{{ $plan->plan }} ({{ $plan->duration }}
                                    Days)</span>
                            </li>
                            <li class="d-flex justify-content-between mt-4 mb-2">
                                <span class="text-dark">Plan Fee</span>
                                <span
                                    class="text-dark fw-medium">&#8358;{{ number_format($plan->billing_amount, 2) }}</span>
                            </li>
                            <li class="d-flex justify-content-between mt-4 mb-2">
                                <span class="text-dark">Expiration Date</span>
                                <span class="text-dark fw-medium">@php echo date_format(Carbon\Carbon::now()->addDays($plan->duration), 'jS F, Y'); @endphp</span>
                            </li>

                            <hr class="mt-4 my-3">
                            <p><b>Note:</b> On Expiration of your Arete Subscription, all services and features would
                                be suspended after 2 days of expiration till renewal of plan. We advice enabling the
                                Auto Renewal option to avoid a break in service.</p>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12">
            <!-- card  -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-4">
                        <!-- heading -->
                        <h3 class="mb-4">Payment Method</h3>
                        <hr />
                    </div>
                    @foreach ($customerCards as $card)
                        <div class="row pb-3 mb-3 border-bottom">
                            <div class="col-md-2 col-2">
                                <img src="{{ asset('assets/images/creditcard/' . $card->card_brand . '.svg') }}"
                                    alt="" class="mb-2 mt-2">
                            </div>
                            <div class="col-md-7 col-6">
                                <!-- text -->
                                <p class="mb-0 text-dark">Ending with {{ $card->last_four_digits }}</p>
                                <p class="mb-0">Expires {{ $card->expiry_month }}/{{ $card->expiry_year }}</p>
                            </div>
                            <div class="col-md-3 col-4">
                                <a href="{{ route('business.processSubscription', [$plan->id, $card->id]) }}"
                                    onClick="this.disabled=true; this.innerHTML='Processing...';"><button
                                        class="btn btn-primary btn-xs">Pay Now</button></a>
                            </div>
                        </div>
                    @endforeach
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
