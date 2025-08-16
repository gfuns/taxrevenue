@extends('mda.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Payment Details')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Payment Details </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('mda.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Payment Details</a>
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
                                    <td>{{ $trx->reference }}</td>
                                </tr>
                                <tr>
                                    <td><b>Revenue Item:</b></td>
                                    <td>{{ $trx->tax->revenue_item }}</td>
                                </tr>
                                <tr>
                                    <td><b>Tax Payer:</b></td>
                                    <td>{{ $trx->tax_payer }}</td>
                                </tr>

                                @if (isset($trx->tax_payer_id))
                                    <tr>
                                        <td><b>Tax Payer BTIN:</b></td>
                                        <td>{{ $trx->taxpayer->btin ?? 'NIL' }}</td>
                                    </tr>
                                @endif

                                @if (isset($trx->tax_office_id))
                                    <tr>
                                        <td><b>Tax Office:</b></td>
                                        <td>{{ $trx->office->tax_office }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td><b>Period:</b></td>
                                    <td>{{ $trx->period }}</td>
                                </tr>
                                <tr>
                                    <td><b>Amount:</b></td>
                                    <td>&#8358;{{ number_format($trx->amount, 2) }}</td>
                                </tr>
                                <td><b>Transaction Status:</b></td>
                                <td>
                                    @if ($trx->status == 'pending')
                                        <span
                                            class="badge text-warning bg-light-warning">{{ ucwords($trx->status) }}</span>
                                    @elseif($trx->status == 'successful')
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
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("payments").classList.add('active');
</script>

@endsection
