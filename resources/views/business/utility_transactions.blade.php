@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Utility Transactions')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Transaction History</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/admin">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Utilities</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Utility Transactions</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
                <!-- Card Header -->
                <form id="form" name="form" method="GET">
                    <div class="p-4 row gx-3">
                        <!-- Form -->
                        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                            <!-- search -->

                            <div class="d-flex align-items-center">
                                <span class="position-absolute ps-3 search-icon">
                                    <i class="fe fe-search"></i>
                                </span>
                                <!-- input -->
                                <input name="search" type="search" class="form-control ps-6"
                                    placeholder="Search for Transaction ID......" value="{{ $search }}">
                            </div>

                        </div>
                        <div class="col-6 col-lg-3">
                            <!-- form select -->
                            <select id="service" name="service" class="form-select" onChange="this.form.submit()">
                                <option value="">All Services</option>
                                <option value="Airtime" @if ($service == 'Airtime') selected @endif>Airtime
                                </option>
                                <option value="Data" @if ($service == 'Data') selected @endif>Data</option>
                                <option value="Electricity" @if ($service == 'Electricity') selected @endif>
                                    Electricity</option>
                                <option value="Cable" @if ($service == 'Cable') selected @endif>Cable</option>
                            </select>
                        </div>
                        <div class="col-6 col-lg-3">
                            <!-- form select -->
                            <select id="status" name="status" class="form-select" onChange="this.form.submit()">
                                <option value="">All Statuses</option>
                                <option value="Initiated" @if ($status == 'Initiated') selected @endif>Initiated
                                </option>
                                <option value="Pending" @if ($status == 'Pending') selected @endif>Pending
                                </option>
                                <option value="Successful" @if ($status == 'Successful') selected @endif>Successful
                                </option>
                                <option value="Failed" @if ($status == 'Failed') selected @endif>Failed</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div>
                    <div class="tab-content" id="tabContent">
                        <!-- Tab -->
                        <div class="tab-pane fade show active" id="all-orders" role="tabpanel"
                            aria-labelledby="all-orders-tab">
                            <div class="table-responsive">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox">
                                    <!-- Table Head -->
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction ID</th>
                                            <th>Service</th>
                                            <th>Provider</th>
                                            <th>Details</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($transactions as $trx)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    <a href="#"
                                                        class="fw-semibold">#{{ $trx->transaction_id }}</a>
                                                </td>
                                                <td>{{ $trx->trx_type }}</td>
                                                <td>{{ $trx->biller }} Nigeria</td>
                                                <td>{{ $trx->plan_details == null ? 'N' . number_format($trx->amount, 0) . ' ' . $trx->trx_type . ' Purchase' : $trx->plan_details }}
                                                </td>
                                                <td>{{ $trx->payment_method }}</td>
                                                <td>&#8358;{{ number_format($trx->total_amount, 2) }}</td>
                                                <td>{{ date_format($trx->created_at, 'd M, Y g:i A') }}</td>
                                                <td>
                                                    @if ($trx->status == 'Initiated')
                                                        <span class="badge text-info bg-light-info">Initiated</span>
                                                    @elseif($trx->status == 'Pending')
                                                        <span class="badge text-warning bg-light-warning">Pending</span>
                                                    @elseif($trx->status == 'Successful')
                                                        <span
                                                            class="badge text-success bg-light-success">Successful</span>
                                                    @else
                                                        <span class="badge text-danger bg-light-danger">Failed</span>
                                                    @endif
                                                </td>


                                            </tr>
                                        @endforeach

                                        @if (count($transactions) < 1)
                                            <tr>
                                                <td colspan="10">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>

                            @if (count($transactions) > 0 && $marker != null)
                                <div class="card-footer">
                                    <div class="row g-2 pt-3 ms-4 me-4">
                                        <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                                            of
                                            {{ number_format($lastRecord) }} Records</div>

                                        <div class="col-md-3">{{ $transactions->appends(request()->input())->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
                <!-- Card Footer -->

            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    document.getElementById("navBillPayments").classList.add('show');
    document.getElementById("billTrx").classList.add('active');
</script>

@endsection
