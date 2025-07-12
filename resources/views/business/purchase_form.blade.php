@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Company Registration')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Company Registration </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Company Registration</a>
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
                <h4>Company Registration/Revalidation</h4>

                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <!-- form -->
                        <form method="post" action="{{ route('business.purchaseRegForm') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-4 col-12" style="color: black; ">
                                    <strong>Dear
                                        {{ Auth::user()->last_name . ', ' . Auth::user()->other_names }}</strong>
                                    <br />&nbsp;
                                    <p>
                                        @php
                                            $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
                                            $inWords = ucwords($formatter->format($payment->amount));
                                        @endphp

                                        To begin your company registration application, you are required to pay a
                                        registration form fee of <strong>{{ $inWords }} Naira Only
                                            (&#8358;{{ number_format($payment->amount, 2) }})</strong>.

                                        <br /><br />Please note that you will be charged an additional Technology Fee of
                                        <b>&#8358;{{ number_format(($payment->fee / 100) * $payment->amount, 2) }}</b> when making this payment.

                                    </p>
                                    <br />
                                    <p>
                                        <strong><u>EXISTING CONTRACTORS SHOULD PLEASE NOTE:</u></strong><br />All existing contractors
                                        registered with the commission are now required to revalidate their account with the commission in
                                        line with our digitization reform process.
                                    </p>
                                </div>
                                <hr />
                            </div>
                            <div class="col-md-8"></div>
                            <!-- button -->
                            <div class="row col-12 d-flex align-items-center justify-content-between">
                                <div class="col-6">
                                    <a href="{{ route("business.accountRevalidation") }}"><button class="btn btn-success" type="button">Revalidate
                                            Your Existing BSPPC Account</button></a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-success" type="submit"
                                        onClick="this.disabled=true; this.innerHTML='Submiting request, please wait...';this.form.submit();">Purchase
                                        Company Registration Form</button>
                                </div>

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
    document.getElementById("registration").classList.add('active');
</script>

@endsection
