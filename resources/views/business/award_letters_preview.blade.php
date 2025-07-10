@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Award Letter Requests')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Award Letter Requests </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Award Letter Requests</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="py-6">
        <!-- row -->
        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-md-12 col-12">
                <h4>Please Preview Your Application Details</h4>

                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <!-- form -->
                        <form method="post" action="{{ route('business.processPayment') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <table class="table" style="border-bottom: #fff; color: #000">
                                    <tr>
                                        <td><b>Company Name:</b></td>
                                        <td>{{ $trx->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Contract Name/LOT:</b></td>
                                        <td>{{ $trx->contract_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Contract Sum:</b></td>
                                        <td>&#8358;{{ number_format($trx->contract_amount, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Date of Award:</b></td>
                                        <td>{{ date_format(new DateTime($trx->award_date), 'jS F, Y') }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Contract Duration:</b></td>
                                        <td>{{ $trx->contract_duration }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>MDA:</b></td>
                                        <td>{{ $trx->mda }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Amount Payable:</b></td>
                                        <td>&#8358;{{ number_format($trx->amount_paid, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Uploaded Documents:</b></td>
                                        <td>
                                            <ol style="padding-left:17px">
                                                <li><a href="">Proof of Payment of 1% Processing Fee</a></li>
                                                <li><a href="">Tax Clearance Certificate for the period of three (3) years</a></li>
                                                <li><a href="">BSPPC Certificate (Front and Back)</a></li>
                                                <li><a href="">CAC Certificate</a></li>
                                            </ol>
                                        </td>
                                    </tr>

                                </table>
                                <hr />
                                <div class="mb-4 col-12" style="color: black; ">
                                    <u><b>Note:</b></u> You will be charged an additional Technology Fee of
                                    <b>&#8358;{{ number_format($payment->fee_charged, 2) }}</b> when making your
                                    payment.
                                </div>
                                <!-- form group -->
                                <input type="hidden" class="form-control" name="reference"
                                    value="{{ $trx->reference_number }}" required>
                            </div>
                            <div class="col-md-8"></div>
                            <!-- button -->
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="button"
                                    onClick="this.disabled=true; this.innerHTML='Submiting request, please wait...';this.form.submit();">Proceeed
                                    To Payment</button>

                            </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("awards").classList.add('active');
</script>

@endsection
