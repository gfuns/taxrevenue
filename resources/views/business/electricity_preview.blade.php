@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Buy Electricity Units')
<style>
    /* Style your cards as needed */
    .selected-card {
        border: 1px solid #21a184;
    }
</style>

<!-- Content -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">Buy Electricity Units</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Utilities</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Buy Electricity Units</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <!-- card body -->
        <div class="card-body">
            <!-- form -->

            <div class="row">
                <h4>Please preview the details of your transaction</h4>
                <div class="col-lg-7 col-md-7 col-12" style="margin-left: 0px; padding-left:0px">
                    <!-- basic table -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Transaction ID</th>
                                <th>{{ $trx->transaction_id }}</th>
                            </tr>
                            <tr>
                                <th>Provider</th>
                                <th>{{ $trx->biller }}</th>
                            </tr>
                            <tr>
                                <th>Trans. Type</th>
                                <th>{{ $trx->trx_type }} Purchase</th>
                            </tr>
                            <tr>
                                <th>Meter Number (Prepaid)</th>
                                <th>{{ $trx->recipient }}</th>
                            </tr>
                            <tr>
                                <th>Customer Name</th>
                                <th>{{ $trx->recipient_name }}</th>
                            </tr>
                            <tr>
                                <th>Customer Address</th>
                                <th>{{ $trx->recipient_address }}</th>
                            </tr>
                            <tr>
                                <th>Topup Amount</th>
                                <th>&#8358;{{ number_format($trx->amount, 2) }}</th>
                            </tr>
                            <tr>
                                <th>Transaction Fee</th>
                                <th>&#8358;{{ number_format($trx->fee, 2) }}</th>
                            </tr>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <th>{{ date_format($trx->created_at, 'd M, Y h:i A') }}</th>
                            </tr>
                            <tr>
                                <th>Transaction Status</th>
                                <th>{{ $trx->status }}</th>
                            </tr>
                        </tbody>
                    </table>
                    <!-- basic table -->
                </div>

                <p>&nbsp;</p>
                <h4>Select Your Preferred Payment Method</h4>
                <p>You can choose to pay with your Referral Points Balance or using your Debit Card.</p>
                <p><b><u>Note:</u> Referral Points Balance is: {{ number_format(Auth::user()->wallet->referral_points, 0) }}.</b></p>
                <hr />

            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-6" style="margin-left: 0px; padding-left:0px">
                        <!-- First button -->
                        <a href="{{ route('business.walletElectricityPurchase', [$trx->transaction_id]) }}"><button class="btn btn-primary pr-12" type="button"
                            onClick="this.disabled=true; this.innerHTML='Submiting request, please wait...';">Pay
                            With Referral Points
                            &nbsp;<i class="bi bi-p-circle"></i></button></a>
                    </div>
                    <div class="col-md-4 col-6">
                        <!-- Second button floated to the right -->
                        <a href=""><button class="btn btn-primary" type="button"
                            onClick="this.disabled=true; this.innerHTML='Submiting request, please wait...';">Pay
                            With Debit Card
                            &nbsp;<i class="bi bi-credit-card"></i></button></a>
                    </div>
                </div>
            </div>

        </div>
    </div>


</section>

<script type="text/javascript">
    document.getElementById("navBillPayments").classList.add('show');
    document.getElementById("electricity").classList.add('active');
</script>
@endsection


@section('customjs')

<script type="text/javascript">
    function handleCardClick(card) {
        var allCards = document.querySelectorAll('.card');
        allCards.forEach(function(c) {
            c.classList.remove('selected-card');
        });

        card.classList.add('selected-card');
        var biller = card.id;
        document.getElementById('biller').value = biller;
    }
</script>

@endsection
