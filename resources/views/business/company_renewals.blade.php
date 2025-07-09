@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Registration Renewals')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Registration Renewals</h1>
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

                <!-- button -->
                <div>
                    <a href="#" class="btn btn-primary btn-sm me-2" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight">Renew Registration</a>
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
                        <div class="col-12 col-lg-9 mb-3 mb-lg-0">
                            <!-- search -->

                            <div class="d-flex align-items-center">
                                <span class="position-absolute ps-3 search-icon">
                                    <i class="fe fe-search"></i>
                                </span>
                                <!-- input -->
                                <input name="search" type="search" class="form-control ps-6"
                                    placeholder="Search Transactions Using Reference Number......"
                                    value="{{ $search }}">
                            </div>

                        </div>

                        <div class="col-6 col-lg-3">
                            <!-- form select -->
                            <select id="status" name="status" class="form-select" onChange="this.form.submit()">
                                <option value="">All Statuses</option>
                                <option value="pending" @if ($status == 'pending') selected @endif>Pending
                                </option>
                                <option value="paid" @if ($status == 'paid') selected @endif>Successful
                                </option>
                                <option value="failed" @if ($status == 'failed') selected @endif>Failed</option>
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
                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                                    style="font-size: 14px">
                                    <!-- Table Head -->
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Reference Number</th>
                                            <th>Company Name</th>
                                            <th>Period/Duration</th>
                                            <th>Amount Payable</th>
                                            <th>Status</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($transactions as $trx)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $trx->reference_number }}</td>
                                                <td>{{ $trx->company_name }}</td>
                                                <td>{{ $trx->period }} Year(s)</td>
                                                <td>&#8358;{{ number_format($trx->amount_paid, 2) }}</td>
                                                <td>
                                                    @if ($trx->status == 'pending')
                                                        <span class="badge text-warning bg-light-warning">Pending</span>
                                                    @elseif($trx->status == 'paid')
                                                        <span class="badge text-success bg-light-success">Paid</span>
                                                    @else
                                                        <span class="badge text-danger bg-light-danger">Failed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($trx->status == 'pending')
                                                        <a
                                                            href="{{ route('business.companyRenewalPreview', [$trx->reference_number]) }}"><button
                                                                class="btn btn-sm btn-primary">Pay Now!</button></a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach

                                        @if (count($transactions) < 1)
                                            <tr>
                                                <td colspan="7">
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

<!-- offcanvas -->
<div class="offcanvas offcanvas-end" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="offcanvasRight"
    style="width: 600px;">
    <div class="offcanvas-body" data-simplebar>
        <div class="offcanvas-header px-2 pt-0">
            <h3 class="offcanvas-title" id="offcanvasExampleLabel">Company Registration Renewal Application</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- card body -->
        <div class="container">
            <!-- form -->
            <form class="needs-validation" novalidate method="post"
                action="{{ route('business.initiateCompanyRenewal') }}">
                @csrf
                <div class="row">
                    <!-- form group -->
                    <div class="mb-3 col-12">
                        <label class="form-label">BSPPC Registration Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="registration_number"
                            placeholder="BSPPC Registration Number" required>
                        <div class="invalid-feedback">Please Provide BSPPC Registration Number.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Number of Years To Renew <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="period" placeholder="Number of Years To Renew"
                            required>
                        <div class="invalid-feedback">Please Provide Number of Years To Renew.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="expiry_date" placeholder="Expiry Date"
                            required>
                        <div class="invalid-feedback">Please Provide Expiry Date.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Company Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="company_email" placeholder="Company Email"
                            required>
                        <div class="invalid-feedback">Please Provide Company Email</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Director's Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone_number"
                            placeholder="Director's Phone Number" required>
                        <div class="invalid-feedback">Please Provide Director's Phone Number</div>
                    </div>

                    {{-- <div id="paymentNote" class="mb-3 col-12" style="color: black; display:none">
                        <u><b>Note:</b></u> You will be redirected to our payment gateway to pay the sum of
                        <b>&#8358;<span></span></b> to cover for your renewal fees for the provide period/duration.
                        <br />&nbsp;
                        <p>Click the <b>Submit Application</b> button only if you are ready to make the required
                            payment.</p>
                    </div> --}}

                    <div class="col-md-12 border-bottom"></div>
                    <!-- button -->
                    <div class="col-12 mt-4">
                        <button class="btn btn-primary" type="submit">Submit Application</button>
                        <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                            aria-label="Close">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("renewals").classList.add('active');
</script>

@endsection

