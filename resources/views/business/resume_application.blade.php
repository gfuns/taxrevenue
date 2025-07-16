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
            <div class="offset-xl-1 col-xl-10 col-md-12 col-12">
                <h4>Company Registration/Revalidation</h4>

                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <!-- form -->
                        <div class="row">
                            <div class="mb-4 col-12" style="color: black; ">
                                <strong>Dear
                                    {{ Auth::user()->last_name . ', ' . Auth::user()->other_names }}</strong>
                                <br />&nbsp;
                                @if ($company->application_stage == 'projects')
                                    <p>
                                        Your application is currently incomplete. You last stopped at the
                                        <b>Company Information Stage</b>. <br /><br />
                                        @if ($company->upgrade_application == 'yes')
                                            The next stage of your application will require you to state past
                                            contracts awarded to your company and successfully executed.<br /><br />
                                        @else
                                            The next stage of your application will require you to upload required
                                            company documents.<br /><br />
                                        @endif
                                        Please resume from where you left off to complete your application.
                                    </p>
                                @elseif ($company->application_stage == 'documents')
                                    <p>
                                        Your application is currently incomplete. You last stopped at the

                                        @if ($company->upgrade_application == 'yes')
                                            <b>Contracts Executed Stage</b> <br /><br />
                                        @else
                                            <b>Company Information Stage</b> <br /><br />
                                        @endif

                                        The next stage of your
                                        application will require you to upload required company documents.
                                        <br /><br />Please resume from where you left off to complete your
                                        application.
                                    </p>
                                @else
                                    <p>
                                        Your application is currently incomplete. You last stopped at the
                                        <b>Company Documents Upload Stage</b>. <br /><br /> The next stage of your
                                        application will require you to pay an application fee of
                                        <strong>{{ $payment->amountInWords() }} Naira Only
                                            (&#8358;{{ number_format($payment->amount, 2) }})</strong>.
                                        <br /><br />Please note that you will be charged an additional Technology
                                        Fee of
                                        <b>&#8358;{{ number_format(($payment->fee / 100) * $payment->amount, 2) }}</b>
                                        when making this payment.
                                        <br /><br />Please proceed to make the aforementioned payment to complete
                                        your application.
                                    </p>
                                @endif
                            </div>
                            <hr />
                        </div>
                        <div class="col-md-8"></div>
                        <!-- button -->
                        <div class="col-12">
                            <a href="{{ route('business.resumeApplication', [$company->id]) }}"><button
                                    class="btn btn-success w-100" type="submit">
                                    @if ($company->application_stage == 'payment')
                                        Pay Application Fee
                                    @else
                                        Resume Application
                                    @endif
                                </button>
                            </a>
                        </div>
                    </div>
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
