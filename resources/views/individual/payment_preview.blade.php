@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Bill Payment Preview')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Bill Payment Preview </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('individual.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Bill Payment Preview</a>
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
                <h4>Please Preview Payment Details</h4>

                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <!-- form -->
                        <form method="post" action="{{ route('individual.processBillPayment') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <table class="table" style="border-bottom: #fff; color: #000">
                                    <tr>
                                        <td><b>Payment Period:</b></td>
                                        <td>{{ $bill->period }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tax Station:</b></td>
                                        <td>{{ $bill->office->tax_office }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Benefiting MDA:</b></td>
                                        <td>{{ $bill->mda->mda }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tax/Revenue Item:</b></td>
                                        <td>{{ $bill->tax->revenue_item }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Amount Payable:</b></td>
                                        <td>&#8358;{{ number_format($bill->amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Date Generated:</b></td>
                                        <td>{{ date_format($bill->created_at, "jS F, Y g:ia") }}</td>
                                    </tr>

                                </table>
                                <hr />
                                <div class="mb-4 col-12" style="color: black; ">
                                    <u><b>Note:</b></u> You will be charged an additional Technology Fee of <b>&#8358;{{ number_format($bill->fee_charged, 2) }}</b> when making your payment.
                                </div>
                                <!-- form group -->
                                <input type="hidden" class="form-control" name="reference"
                                    value="{{ $bill->reference }}" required>
                            </div>
                            <div class="col-md-8"></div>
                            <!-- button -->
                            <div class="col-12">
                                <button class="btn btn-success w-100" type="button"
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
    document.getElementById("taxPayments").classList.add('show');
    document.getElementById("genBill").classList.add('active');
</script>

@endsection
