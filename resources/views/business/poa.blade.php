@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Power Of Attorney Application')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Power Of Attorney Application</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Power Of Attorney Application</a>
                            </li>
                        </ol>
                    </nav>
                </div>

                <!-- button -->
                <div>
                    <a href="#" class="btn btn-success btn-sm me-2" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight">Apply for Power Of Attorney</a>
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
                                <option value="awaiting approval" @if ($status == 'awaiting approval') selected @endif>
                                    Awaiting Approval
                                </option>
                                <option value="approved" @if ($status == 'approved') selected @endif>Approved
                                </option>
                                <option value="rejected" @if ($status == 'rejected') selected @endif>Rejected
                                </option>
                                <option value="payment failed" @if ($status == 'payment failed') selected @endif>Payment
                                    Failed</option>
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
                                            <th>Application Status</th>
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
                                                <td class="align-middle">
                                                    <div class="hstack gap-4">
                                                        <span class="dropdown dropstart">
                                                            <a class="btn btn-success bg-light-success text-success btn-sm"
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

                                                                <a class="dropdown-item"
                                                                    href="{{ route('business.powerOfAttorneyDetails', [$trx->reference_number]) }}"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>


                                                                @if ($trx->status == 'paid')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('receipt.powerOfAttorney', [$trx->reference_number]) }}"
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
            <h3 class="offcanvas-title" id="offcanvasExampleLabel">Power Of Attorney Application</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- card body -->
        <div class="container">
            <!-- form -->
            <form class="needs-validation" novalidate method="post"
                action="{{ route('business.initiatePOAApplication') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- form group -->
                    <div class="mb-3 col-12">
                        <label class="form-label">Name of Donor Company <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="donor_company"
                            placeholder="Name of Donor Company" value="{{ Auth::user()->company->company_name }}"
                            readonly required>
                        <div class="invalid-feedback">Please Provide Name of Donor Company.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Name of Donee Company <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="donee_company"
                            placeholder="Name of Donee Company" required>
                        <small style="color:red">Please Note: The Donee Company must be a registered contractor with
                            BSPPC</small>
                        <div class="invalid-feedback">Please Provide Name of Donee Company.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Donee Company Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="donee_company_address"
                            placeholder="Donee Company Address" required>
                        <div class="invalid-feedback">Please Provide Donee Company Address.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Donee Company Email<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="donee_company_email"
                            placeholder="Donee Company Email" required>
                        <div class="invalid-feedback">Please Provide Donee Company Email.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Donee Company Phone Number<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="donee_company_phone"
                            placeholder="Donee Company Phone Number" required>
                        <div class="invalid-feedback">Please Provide Donee Company Phone Number.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Contract Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contract_name" placeholder="Contract Name"
                            required>
                        <div class="invalid-feedback">Please Provide Contract Name.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Contract Sum <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contract_sum" placeholder="Contract Sum"
                            required oninput="validateInput(event)">
                        <div class="invalid-feedback">Please Provide Contract Sum.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Contract Duration <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contract_duration"
                            placeholder="Contract Duration" required>
                        <div class="invalid-feedback">Please Provide Contract Duration</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Procuring Entity (MDA) <span class="text-danger">*</span></label>
                        <select id="mda" name="mda" class="form-select">
                            <option value="">Select Procuring Entity (MDA)</option>
                            @foreach ($mdas as $mda)
                                <option value="{{ $mda->mda }}">{{ $mda->mda }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please Select Procuring Entity (MDA)</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Upload Contract Agreement <span class="text-danger">*</span></label>
                        <small style="color:green; display:block">Please Document Format Must Be Portable Document
                            Format (PDF).</small>
                        <input type="file" class="form-control" name="contract_agreement"
                            accept="application/pdf" placeholder="Upload Contract Agreement" required>
                        <div class="invalid-feedback">Please Upload Contract Agreement</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Upload Power Of Attorney <span class="text-danger">*</span></label>
                        <small style="color:green; display:block">Please Document Format Must Be Portable Document
                            Format (PDF).</small>
                        <input type="file" class="form-control" name="poa_document" accept="application/pdf"
                            placeholder="Upload Power Of Attorney" required>
                        <div class="invalid-feedback">Please Upload Power Of Attorney</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Notification of Award from Procuring Entity <span
                                class="text-danger">*</span></label>
                        <small style="color:green; display:block">Please Document Format Must Be Portable Document
                            Format (PDF).</small>
                        <input type="file" class="form-control" name="award_notification"
                            accept="application/pdf" placeholder="Upload Notification of Award from Procuring Entity"
                            required>
                        <div class="invalid-feedback">Please Upload Notification of Award from Procuring Entity</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Acceptance Letter <span class="text-danger">*</span></label>
                        <small style="color:green; display:block">Please Document Format Must Be Portable Document
                            Format (PDF).</small>
                        <input type="file" class="form-control" name="acceptance_letter" accept="application/pdf"
                            placeholder="Upload Acceptance Letter" required>
                        <div class="invalid-feedback">Please Upload Acceptance Letter</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">BOQ or BEME <span class="text-danger">*</span></label>
                        <small style="color:green; display:block">Please Document Format Must Be Portable Document
                            Format (PDF).</small>
                        <input type="file" class="form-control" name="boq_beme" accept="application/pdf"
                            placeholder="Upload BOQ or BEME" required>
                        <div class="invalid-feedback">Please Upload BOQ or BEME</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Company Profile of the Donee Company <span
                                class="text-danger">*</span></label>
                        <small style="color:green; display:block">Please Document Format Must Be Portable Document
                            Format (PDF).</small>
                        <input type="file" class="form-control" name="donee_company_profile"
                            accept="application/pdf" placeholder="Upload Company Profile of the Donee Company"
                            required>
                        <div class="invalid-feedback">Please Upload Company Profile of the Donee Company</div>
                    </div>

                    <div class="col-md-12 border-bottom"></div>
                    <!-- button -->
                    <div class="col-12 mt-4">
                        <button class="btn btn-success" type="submit">Submit Application</button>
                        <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="offcanvas"
                            aria-label="Close">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("poa").classList.add('active');
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
</script>
@endsection
