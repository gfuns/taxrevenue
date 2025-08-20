@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Previously Filed Returns')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Previously Filed Returns</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('individual.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Previously Filed Returns</a>
                            </li>
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
                <div>
                    <div class="tab-content" id="tabContent">
                        <!-- Tab -->
                        <div class="tab-pane fade show active" id="all-orders" role="tabpanel"
                            aria-labelledby="all-orders-tab">
                            <div class="p-3">
                                <h5>Dear {{ Auth::user()->last_name . ' ' . Auth::user()->other_names }},</h5>
                                <p style="color:black">Our records indicates that you have incomplete filed returns for
                                    the last three years. Specifically for Years:
                                    <strong>{{ $missedReturns }}</strong>.<br />If you have duly filed your returns for
                                    the specified period, kindly upload proof of payment or your awarded Tax Clearance
                                    Certificate (TCC) for the specified period using the button below:
                                </p>
                                @if (empty($missedYears))
                                    <a href="{{ route('individual.previewApplication', [$return->reference]) }}"><button
                                            class="btn btn-success btn-md mt-4 mb-4">Preview And
                                            Submit Filing For Assessment</button></a>
                                @else
                                    <button class="btn btn-success btn-md mt-4 mb-4" data-bs-toggle="modal"
                                        data-bs-target="#uploadTaxClearance">Upload Payment Proof</button>
                                @endif
                            </div>



                        </div>

                    </div>
                </div>
                <!-- Card Footer -->

            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-12 mt-5">
            <!-- Card -->
            <div class="card rounded-3">
                <!-- Card Header -->
                <div class="p-3">
                    <h4>Income and Tax Payment For The Last Three Years</h4>
                </div>
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
                                            <th>Period</th>
                                            <th>Income Declared</th>
                                            <th>Tax Paid</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @php
                                            $sno = 1;
                                        @endphp
                                        @foreach ($previousReturns as $pr)
                                            <tr>
                                                <td>{{ $sno ++ }}</td>
                                                <td>{{ $pr->period }}</td>
                                                <td>&#8358;{{ number_format($pr->income, 2) }}</td>
                                                <td>&#8358;{{ number_format($pr->tax_paid, 2) }}</td>
                                                <td>
                                                    @if ($pr->status == 'paid')
                                                        <span
                                                            class="badge text-success bg-light-success">Verified</span>
                                                    @else
                                                        <span
                                                            class="badge text-warning bg-light-warning">Unverified</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        @foreach ($uploadedDocuments as $ud)
                                            <tr>
                                                <td>{{ $sno ++ }}</td>
                                                <td>Year {{ $ud->period }}</td>
                                                <td>&#8358;{{ number_format($ud->income, 2) }}</td>
                                                <td>&#8358;{{ number_format($ud->tax_paid, 2) }}</td>
                                                <td><span class="badge text-warning bg-light-warning">Unverified</span>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if (count($previousReturns) < 1 && count($uploadedDocuments) < 1)
                                            <tr>
                                                <td colspan="5">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif


                                    </tbody>
                                </table>
                            </div>



                        </div>

                    </div>
                </div>
                <!-- Card Footer -->

            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="uploadTaxClearance" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    Upload Payment Proof OR Tax Clearance Certificate
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form method="post" class="needs-validation" novalidate
                action="{{ route('individual.uploadPreviousReturns') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="mb-3 col-12">
                        <label class="form-label">Period <span class="text-danger">*</span></label>
                        <select id="taxPeriod" name="period" class="form-control" data-width="100%" required>
                            <option value="">Select Period</option>
                            @foreach ($missedYears as $year)
                                <option value="{{ $year }}">Year {{ $year }}</option>
                            @endforeach
                        </select>

                        <div class="invalid-feedback">Please select a period.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Income Declared <span class="text-danger">*</span></label>
                        <input id="income" type="text" name="income_declared" value=""
                            oninput="validateInput(event)" class="form-control" placeholder="Income Declared"
                            autocomplete="off" required>

                        <div class="invalid-feedback">Please enter an amount.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Tax Paid <span class="text-danger">*</span></label>
                        <input id="tax" type="text" name="tax_paid" value=""
                            oninput="validateInput(event)" class="form-control" placeholder="Tax Paid"
                            autocomplete="off" required>

                        <div class="invalid-feedback">Please enter an amount.</div>
                    </div>


                    <div class="mb-3 col-12">
                        <label class="form-label">Proof of Payment / TCC <span class="text-danger">*</span></label>
                        <input id="taxClearance" type="file" name="tax_clearance" value=""
                            class="form-control" placeholder="Select File" required>
                        <div class="invalid-feedback">Please upload a document.</div>
                    </div>

                    <input id="myid" type="hidden" name="return_id" value="{{ $return->id }}"
                        class="form-control" required>

                </div>
                <div class="modal-footer">
                    <button type="sumit" class="btn btn-success">Upload Document</button>
                    <button type="button" class="btn btn-outline-success ms-2"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("returns").classList.add('show');
    document.getElementById("filed").classList.add('active');
</script>

@endsection
