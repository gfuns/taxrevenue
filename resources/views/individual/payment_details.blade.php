@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Payment Details')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Payment Details' </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('individual.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Payment Details'</a>
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
                                    <td><b>Amount Paid:</b></td>
                                    <td>&#8358;{{ number_format($bill->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Date Generated:</b></td>
                                    <td>{{ date_format($bill->created_at, 'jS F, Y g:ia') }}</td>
                                </tr>
                                <tr>
                                    <td><b>Payment Status:</b></td>
                                    <td>
                                        @if ($bill->status == 'pending')
                                            <span
                                                class="badge text-warning bg-light-warning">{{ ucwords($bill->status) }}</span>
                                        @elseif($bill->status == 'successful')
                                            <span
                                                class="badge text-success bg-light-success">{{ ucwords($bill->status) }}</span>
                                        @else
                                            <span
                                                class="badge text-danger bg-light-danger">{{ ucwords($bill->status) }}</span>
                                        @endif
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-8"></div>
                        <!-- button -->
                        @if ($bill->status == 'successful')
                            <div class="col-12">
                                <a href="{{ route('receipt.paymentReceipt', [$bill->reference]) }}"
                                    target="_blank"><button class="btn btn-outline-success w-100" type="button">Print
                                        Payment
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
    document.getElementById("taxPayments").classList.add('show');
    document.getElementById("billPaymnt").classList.add('active');
</script>

@endsection
