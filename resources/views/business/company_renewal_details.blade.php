@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Registration Renewals')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Registration Renewals </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Registration Renewals</a>
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
                <h4>Transaction Details</h4>

                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <!-- form -->

                        <div class="row">
                            <table class="table" style="border-bottom: #fff; color: #000">
                                <tr>
                                    <td><b>Reference Number:</b></td>
                                    <td>{{ $trx->reference_number }}</td>
                                </tr>
                                <tr>
                                    <td><b>Company Name:</b></td>
                                    <td>{{ $trx->company_name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Company Address:</b></td>
                                    <td>{{ $trx->company_address }}</td>
                                </tr>
                                <tr>
                                    <td><b>BSPPC Reg. No:</b></td>
                                    <td>{{ $trx->bsppc_number }}</td>
                                </tr>

                                <tr>
                                    <td><b>No. of Years To Renew:</b></td>
                                    <td>{{ $trx->period }} Year(s)</td>
                                </tr>

                                <tr>
                                    <td><b>Company Email:</b></td>
                                    <td>{{ $trx->email }}</td>
                                </tr>

                                <tr>
                                    <td><b>Director's Phone Number:</b></td>
                                    <td>{{ $trx->phone_number }}</td>
                                </tr>

                                <tr>
                                    <td><b>Amount Payable:</b></td>
                                    <td>&#8358;{{ number_format($trx->amount_paid, 2) }}</td>
                                </tr>

                                <tr>
                                    <td><b>Uploaded Documents:</b></td>
                                    <td>
                                        <ol style="padding-left:17px; margin-bottom:0px">
                                            <li><a href="">BSPPC Certificate (Front and Back)</a></li>
                                        </ol>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Application Status:</b></td>
                                    <td>
                                        @if ($trx->status == 'pending' || $trx->status == 'awaiting approval')
                                            <span
                                                class="badge text-warning bg-light-warning">{{ ucwords($trx->status) }}</span>
                                        @elseif($trx->status == 'approved')
                                            <span
                                                class="badge text-success bg-light-success">{{ ucwords($trx->status) }}</span>
                                        @else
                                            <span
                                                class="badge text-danger bg-light-danger">{{ ucwords($trx->status) }}</span>
                                        @endif
                                    </td>
                                </tr>

                            </table>

                        </div>
                        <div class="col-md-8"></div>
                        <!-- button -->
                        @if ($trx->status == 'paid')
                            <div class="col-12">
                                <a href="{{ route('receipt.companyRenewal', [$trx->reference_number]) }}"
                                    target="_blank"><button class="btn btn-success w-100" type="button">Print
                                        Receipt</button></a>

                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("renewals").classList.add('active');
</script>

@endsection
