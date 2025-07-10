@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Award Letter Requests')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Award Letter Requests</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Award Letter Requests</a>
                            </li>
                        </ol>
                    </nav>
                </div>

                <!-- button -->
                <div>
                    <a href="#" class="btn btn-primary btn-sm me-2" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight">Request For Award Letter</a>
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
                                            {{-- <th>Donor Company</th> --}}
                                            <th>Contract Name</th>
                                            <th>Award Date</th>
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
                                                {{-- <td>{{ $trx->donor_company }}</td> --}}
                                                <td>{{ $trx->contract_name }}</td>
                                                <td>{{ date_format(new DateTime($trx->award_date), 'jS M, Y') }}</td>
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
                                                <td class="align-middle">
                                                    <div class="hstack gap-4">
                                                        <span class="dropdown dropstart">
                                                            <a class="btn btn-primary bg-light-primary text-primary btn-sm"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                data-bs-offset="-20,20" aria-expanded="false">Action</a>
                                                            <span class="dropdown-menu"><span
                                                                    class="dropdown-header">Action</span>
                                                                @if ($trx->status == 'pending')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('business.powerOfAttorneyPreview', [$trx->reference_number]) }}"><i
                                                                            class="fe fe-trash dropdown-item-icon"></i>Make
                                                                        Payment</a>
                                                                @endif

                                                                <a class="dropdown-item" href="#"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>


                                                                @if ($trx->status == 'paid')
                                                                    <a class="dropdown-item" href="#"
                                                                        target="_blank"><i
                                                                            class="fe fe-printer dropdown-item-icon"></i>Print
                                                                        Receipt</a>
                                                                @endif
                                                            </span>
                                                        </span>

                                                    </div>
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
            <h3 class="offcanvas-title" id="offcanvasExampleLabel">Award Letter Request</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- card body -->
        <div class="container">
            <!-- form -->
            <form id="myForm" class="needs-validation" novalidate method="post"
                action="{{ route('business.initiateAwardLetterRequest') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- form group -->
                    <div class="mb-3 col-12">
                        <label class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="company_name"
                            placeholder="Company Name" value="{{ Auth::user()->company->company_name }}" required readonly>
                        <div class="invalid-feedback">Please Provide Company Name.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Contract Name/LOT <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contract_name"
                            placeholder="Contract Name/LOT" required>
                        <div class="invalid-feedback">Please Provide Contract Name/LOT.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Contract Sum <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contract_sum" placeholder="Contract Sum"
                            required oninput="validateInput(event)">
                        <div class="invalid-feedback">Please Provide Contract Sum.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Date of Award<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_of_award" placeholder="Date of Award"
                            required>
                        <div class="invalid-feedback">Please Provide Date of Award.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Contract Duration <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contract_duration"
                            placeholder="Contract Duration" required>
                        <div class="invalid-feedback">Please Provide Contract Duration</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">MDA <span class="text-danger">*</span></label>
                        <select id="mda" name="mda" class="form-control form-select">
                            <option value="">Select MDA</option>
                            @foreach ($mdas as $mda)
                                <option value="{{ $mda->mda }}">{{ $mda->mda }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please Select MDA</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Processing Fee Reference No. Indicating Payment of 1% Processing Fee <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="reference_number"
                            placeholder="Processing Fee Reference No. Indicating Payment of 1% Processing Fee" required>
                        <div class="invalid-feedback">Please Provide Processing Fee Reference Number</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Tax Clearance Certificate For the past three (3) Years <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="tcc"
                            placeholder="Tax Clearance Certificate" required>
                        <div class="invalid-feedback">Please Upload Tax Clearance Certificate</div>
                    </div>

                    <div class="col-md-12 border-bottom"></div>
                    <!-- button -->
                    <div class="col-12 mt-4">
                        <button id="submitBtn" class="btn btn-primary" type="submit">Submit Application</button>
                        <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                            aria-label="Close">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("awards").classList.add('active');
</script>

@endsection

@section('customjs')
<script type="text/javascript">
    function validateInput(event) {
        const input = event.target;
        let value = input.value;

        // Remove commas from the input value
        value = value.replace(/,/g, '');

        // Regular expression to match non-numeric and non-decimal characters
        const nonNumericDecimalRegex = /[^0-9.]/g;

        if (nonNumericDecimalRegex.test(value)) {
            // If non-numeric or non-decimal characters are found, remove them from the input value
            value = value.replace(nonNumericDecimalRegex, '');
        }

        // Ensure there is only one decimal point in the value
        const decimalCount = value.split('.').length - 1;
        if (decimalCount > 1) {
            value = value.replace(/\./g, '');
        }

        // Assign the cleaned value back to the input field
        input.value = value;
    }


    // $('#myForm').on('submit', function() {
    //     $('#submitBtn').prop('disabled', true).text('Submitting...');
    // });
</script>
@endsection
