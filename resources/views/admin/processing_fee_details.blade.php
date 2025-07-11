@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Processing Fee Remittance')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Processing Fee Remittance </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Processing Fee Remittance</a>
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
                                    <td><b>Payment Status:</b></td>
                                    <td>
                                        @if ($trx->status == 'pending')
                                            <span class="badge text-warning bg-light-warning">Pending</span>
                                        @elseif($trx->status == 'paid')
                                            <span class="badge text-success bg-light-success">Paid</span>
                                        @else
                                            <span class="badge text-danger bg-light-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>

                            </table>

                        </div>
                        <div class="col-md-8"></div>
                        <!-- button -->

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("processingfee").classList.add('active');
</script>

@endsection
