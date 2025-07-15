@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Award Letter Requests')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Award Letter Requests </h1>
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
                                    <td><b>Contract Name:</b></td>
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
                                    <td><b>Uploaded Documents:</b></td>
                                    <td>
                                        <ol style="padding-left:17px; margin-bottom:0px">
                                            <li><a href="{{ route('receipt.processingFees', [$trx->fee_evidence]) }}"
                                                    target="_blank">Proof of Payment of 1% Processing Fee</a></li>
                                            <li><a href="{{ $trx->tcc_cert }}" target="_blank">Tax Clearance
                                                    Certificate For Three (3) Recent Years</a></li>
                                            <li><a href="{{ $trx->bsppc_cert }}" target="_blank">Valid BSPPC
                                                    Certificate</a></li>
                                            <li><a href="{{ $trx->cac_cert }}" target="_blank">CAC Certificate</a>
                                            </li>
                                            @if (isset($trx->advance_payment))
                                                <li><a href="{{ $trx->advance_payment }}" target="_blank">Evidence
                                                        of Advance Payment Guarantee</a></li>
                                            @endif
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Application Date:</b></td>
                                    <td>{{ date_format($trx->created_at, 'jS F, Y g:i:sa') }}</td>
                                </tr>
                                <tr>
                                    <td><b>Application Status:</b></td>
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
                                </tr>

                                @if ($trx->status == 'rejected')
                                    <tr>
                                        <th>Reason For Rejection</th>
                                        <td>{{ $trx->rejection_reason }}</td>
                                    </tr>
                                @endif

                            </table>

                        </div>
                        @if (
                            \App\Http\Controllers\MenuController::canEdit(Auth::user()->role_id, 6) == true &&
                                $trx->status == 'awaiting approval')
                            <hr />
                            <div class="col-md-8"></div>
                            <!-- button -->
                            <div class="row col-12 d-flex align-items-center justify-content-between">
                                <div class="col-6">
                                    <a href="{{ route('admin.approveAwardApplication', [$trx->id]) }}"
                                        onclick="return disableLink(this);"><button class="btn btn-success w-100"
                                            type="button">Approve Request</button></a>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-danger w-100" type="button" data-bs-toggle="modal"
                                        data-bs-target="#rejectApplication" data-backdrop="static"
                                        data-myid="{{ $trx->id }}">Reject
                                        Request</button>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="rejectApplication" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    Reject Application
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="{{ route('admin.rejectAwardApplication') }}" method="POST" class="needs-validation"
                novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3 col-12">
                        <label class="form-label">Reason For Rejection</label>
                        <textarea name="rejection_reason" class="form-control text-dark" placeholder="Reason For Rejection" rows="5"
                            required style="resize: none"></textarea>
                        <div class="invalid-feedback">Please provide reason for rejecting application.</div>
                    </div>

                    <input type="hidden" name="application_id" value="{{ $trx->id }}" required>

                </div>
                <div class="modal-footer">
                    <button id="submitBtn" class="btn btn-success" type="submit">Reject Application</button>
                    <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("awards").classList.add('active');
</script>

@endsection
