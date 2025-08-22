@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Tax Payer Assessment Details')

<style type="text/css">
    body {
        overflow: hidden;
    }

    #scrollContainer {
        height: 600px;
        /* or use 100vh, or calc(100vh - headerHeight) */
        overflow-y: auto;
        /* enables vertical scrolling */
        overflow-x: hidden;
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE and Edge */
    }

    #scrollContainer::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }

    #assessmentInfo {
        max-height: 400px;
        /* just example to force scrolling */
    }

    .incomeSource {
        padding-left: 50px !important;
    }

    @media (max-width: 768px) {
        .incomeSource {
            padding-left: 35px !important;
        }
    }
</style>

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Tax Payer Assessment Details </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Tax Payer Assessment Details</a>
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
            <div class="col-md-8 col-12 mb-5">
                <h4>Information About Returns Filed</h4>
                <div id="scrollContainer">
                    <div id="assessmentInfo">
                        <!-- card -->
                        <div class="card">
                            <!-- card body -->
                            <div class="card-body">
                                <!-- form -->

                                <div class="row table-responsive">
                                    <table class="table" style="border-bottom: #fff; color: #000; font-size:14px">
                                        <tr>
                                            <td width="55%"><b>Tax Payer:</b></td>
                                            <td>{{ $assessment->taxpayer->tax_payer }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>B-TIN:</b></td>
                                            <td>{{ $assessment->taxpayer->btin }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Tax Period:</b></td>
                                            <td>Year {{ $assessment->return->period }}</td>
                                        </tr>

                                        @if (isset($assessment->taxpayer->individual->business_type))
                                            <tr>
                                                <td><b>Business Type:</b></td>
                                                <td>{{ $assessment->taxpayer->individual->business_type }}</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td><b>Date Of Filing:</b></td>
                                            <td>{{ date_format($assessment->created_at, 'jS F, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Income Declared:</b></td>
                                            <td>&#8358;{{ number_format($assessment->return->income, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><b>Income Sources:</b></td>
                                        </tr>
                                        <tr>
                                            <td class="incomeSource">Salary:</b></td>
                                            <td>&#8358;{{ number_format($assessment->return->incomeSources->salary, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="incomeSource">Allowances:</td>
                                            <td>&#8358;{{ number_format($assessment->return->incomeSources->allowances, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="incomeSource">Commissions, Bonuses, Gratuities etc:</td>
                                            <td>&#8358;{{ number_format($assessment->return->incomeSources->commissions, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="incomeSource">Trade, Business, Profession, Vocation etc:</td>
                                            <td>&#8358;{{ number_format($assessment->return->incomeSources->trade, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="incomeSource">Consolidated Gross Income:</td>
                                            <td>&#8358;{{ number_format($assessment->return->incomeSources->consolidated_income, 2) }}
                                            </td>
                                        </tr>

                                    </table>
                                    <hr />
                                    <div class="table-responsive">
                                        <h5>Previously Filed Returns</h5>
                                        <!-- Table -->
                                        <table
                                            class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                                            style="font-size: 14px">
                                            <!-- Table Head -->
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Period</th>
                                                    <th>Income Declared</th>
                                                    <th>Tax Paid</th>
                                                    <th>Status</th>
                                                    <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Table body -->
                                                @php
                                                    $sno = 1;
                                                @endphp
                                                @foreach ($previousReturns as $pr)
                                                    <tr>
                                                        <td>{{ $sno++ }}</td>
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
                                                        <td>{{ $sno++ }}</td>
                                                        <td>Year {{ $ud->period }}</td>
                                                        <td>&#8358;{{ number_format($ud->income, 2) }}</td>
                                                        <td>&#8358;{{ number_format($ud->tax_paid, 2) }}</td>
                                                        <td><span
                                                                class="badge text-warning bg-light-warning">Unverified</span>
                                                        </td>
                                                        <td><a href="{{ $ud->document }}" target="_blank"><button
                                                                    class="btn btn-sm btn-outline-success">View
                                                                    Document</button></a></td>
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
                                <div class="col-md-8 mt-3 mb-5">&nbsp;</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <h4>Assessment Summary</h4>

                <!-- card -->
                <div id="assessmentSummary" class="card">
                    <!-- card body -->
                    <div class="card-body">
                        @if ($assessment->status == 'awaiting assessment')
                            <div class="mb-2">
                                Tax Payer Return is awaiting Assessment.
                            </div>
                            <div class="col-md-8 mb-2"></div>
                            <div class="col-12 mb-4">
                                <button class="btn btn-outline-success w-100" type="button" data-bs-toggle="modal"
                                    data-bs-target="#taxpayerAssessment">Provide Assessment</button>

                            </div>
                        @endif

                        {{-- <div class="mb-3">
                            Tax Payer Return Filing has been asssessed by his Area Tax Officer and is awaiting your
                            review.
                            <div class="col-md-8 mb-2"></div>
                            <div class="col-12">
                                <button class="btn btn-outline-success w-100" type="button" data-bs-toggle="modal"
                                    data-bs-target="#taxpayerAssessment">Review Assessment</button>

                            </div>
                        </div> --}}

                        {{-- <div class="mb-3">
                            Tax Payer Return Filing has been asssessed by his Area Tax Officer and reviewed by the Director of Assessment and is now awaiting your approval.
                            <div class="col-md-8 mb-2"></div>
                            <div class="col-12">
                                <button class="btn btn-outline-success w-100" type="button" data-bs-toggle="modal"
                                    data-bs-target="#taxpayerAssessment">Review And Approve Assessment</button>

                            </div>
                        </div> --}}

                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("assessments").classList.add('active');
</script>

@endsection

<div class="modal fade" id="taxpayerAssessment" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel">
<div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title mb-0" id="newCatgoryLabel">
                Tax Payer Assessment
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form class="needs-validation" novalidate method="post" action="{{ route('individual.addChild') }}">
                @csrf
                <div class="row">
                    <!-- form group -->

                    <div class="mb-3 col-12">
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="penalizable" name="penalty"
                                    value="yes">
                                <label class="form-check-label" for="penalizable"><span style="color:black">Is There
                                        A Penalty For This Transaction?</span></label>
                            </div>
                        </div>
                    </div>

                    <div id="taxPayablediv" class="mb-3 col-12">
                        <label class="form-label">Tax Payable Based on Assessment </label>
                        <input id="taxpayable" type="text" name="tax_payable" class="form-control"
                            placeholder="Tax Payable Based on Assessment" oninput="validateInput(event)" required
                            autocomplete="off">
                        <div class="invalid-feedback">Please provide tax payable based on assessment.</div>
                    </div>

                    <div id="penaltydiv" class="mb-3 col-12" style="display: none">
                        <label class="form-label">Penalty Attached For This Transaction </label>
                        <input id="penalty" type="text" name="penalty" class="form-control"
                            placeholder="Penalty Attached For This Transaction" oninput="validateInput(event)"
                            required autocomplete="off">
                        <div class="invalid-feedback">Please provide the penalty for this transaction.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Comment </label>
                        <textarea id="comment" name="comment" class="form-control" style="resize:none" required rows="5"
                            placeholder="Please provide a comment to enable the tax payer gain insights on your assement leading to the tax amount appropriated for payment."></textarea>
                        <div class="invalid-feedback">Please provide a comment .</div>
                    </div>

                    <div class="col-md-12 border-bottom"></div>
                    <!-- button -->
                    <div class="col-12 mt-4">
                        <button id="submitbutton2" class="btn btn-success" type="submit">Submit
                            Assessment</button>
                        <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
