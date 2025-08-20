@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Tax Payer Details')

<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Tax Payer Details</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Tax Payer Details</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card border-0 mb-4">
                <!-- Card header -->
                <div class="card-header d-lg-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">Tax Payer Information
                        </h4>
                    </div>
                </div>

                @if ($taxPayer->category == 'individual')
                    @include('admin.includes.individual')
                @else
                    @include('admin.includes.corporate')
                @endif

                <div class="ps-4 pe-4 pb-5 table-responsive">
                    <hr />
                    <div class="pt-3"><h4>Tax Payer's Payment History</h4></div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Card -->
                        <div class="card rounded-3">
                            <!-- Card Header -->
                            <form id="form" name="form" method="GET">
                                <div class="p-4 row gx-3">
                                    <!-- Form -->
                                    <div class="col-12 col-lg-9 mb-3 mb-lg-0">
                                        <!-- search -->

                                        <div class="d-flex align-items-center">
                                            <span class="position-absolute ps-3 search-icon">
                                                <i class="fe fe-search"></i>
                                            </span>
                                            <!-- input -->
                                            <input name="search" type="search" class="form-control ps-6"
                                                placeholder="Search Payment History Using Payment Reference......"
                                                value="{{ $search }}">
                                        </div>

                                    </div>

                                    <div class="col-6 col-lg-3">
                                        <!-- form select -->
                                        <select id="status" name="status" class="form-select"
                                            onChange="this.form.submit()">
                                            <option value="">All Statuses</option>
                                            <option value="pending" @if ($status == 'pending') selected @endif>
                                                Pending
                                            </option>
                                            <option value="successful"
                                                @if ($status == 'successful') selected @endif>
                                                Successful
                                            </option>
                                            <option value="failed" @if ($status == 'failed') selected @endif>
                                                Failed
                                            </option>
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
                                            <table
                                                class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                                                style="font-size: 14px">
                                                <!-- Table Head -->
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Reference</th>
                                                        <th>MDA</th>
                                                        <th>Revenue Item</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Table body -->
                                                    @foreach ($paymentHistory as $ph)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $ph->reference }}</td>
                                                            <td>{{ $ph->mda->mda }}</td>
                                                            <td>{{ $ph->tax->revenue_item }}</td>
                                                            <td>&#8358;{{ number_format($ph->amount, 2) }}</td>

                                                            <td>
                                                                @if ($ph->status == 'pending')
                                                                    <span
                                                                        class="badge text-warning bg-light-warning">{{ ucwords($ph->status) }}</span>
                                                                @elseif ($ph->status == 'successful')
                                                                    <span
                                                                        class="badge text-success bg-light-success">{{ ucwords($ph->status) }}</span>
                                                                @else
                                                                    <span
                                                                        class="badge text-danger bg-light-danger">{{ ucwords($ph->status) }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    @if (count($paymentHistory) < 1)
                                                        <tr>
                                                            <td colspan="7">
                                                                <center>No Record Found</center>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                            </table>
                                        </div>
                                        @if (count($paymentHistory) > 0 && $marker != null)
                                            <div class="card-footer">
                                                <div class="row g-2 pt-3 ms-4 me-4">
                                                    <div class="col-md-9">Showing {{ $marker['begin'] }} to
                                                        {{ $marker['end'] }}
                                                        of
                                                        {{ number_format($lastRecord) }} Records</div>

                                                    <div class="col-md-3">
                                                        {{ $paymentHistory->appends(request()->input())->links() }}
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

            </div>

        </div>
    </div>
    </div>

</section>



<script type="text/javascript">
    document.getElementById("taxpayers").classList.add('active');
</script>

@endsection
