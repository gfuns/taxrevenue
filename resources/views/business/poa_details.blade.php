@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Power Of Attorney Application')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Power Of Attorney Application </h1>
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
                                    <td width="50%"><b>Name of Donor Company:</b></td>
                                    <td>{{ $trx->donor_company }}</td>
                                </tr>
                                <tr>
                                    <td><b>Name of Donee Company:</b></td>
                                    <td>{{ $trx->donee_company_address }}</td>
                                </tr>
                                <tr>
                                    <td><b>Email of Donee Company:</b></td>
                                    <td>{{ $trx->donee_company_email }}</td>
                                </tr>
                                <tr>
                                    <td><b>Phone No. of Donee Company:</b></td>
                                    <td>{{ $trx->donee_company_phone }}</td>
                                </tr>
                                <tr>
                                    <td><b>Address of Donee Company:</b></td>
                                    <td>{{ $trx->donee_company }}</td>
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
                                    <td><b>Contract Duration:</b></td>
                                    <td>{{ $trx->contract_duration }}</td>
                                </tr>

                                <tr>
                                    <td><b>Procuring Entitty (MDA):</b></td>
                                    <td>{{ $trx->mda }}</td>
                                </tr>

                                <tr>
                                    <td><b>Uploaded Documents:</b></td>
                                    <td>
                                        <ol style="padding-left:17px;margin-bottom:0px">
                                            <li><a href="{{ $trx->contract_agreement }}" target="_blank">Contract
                                                    Agreement</a></li>
                                            <li><a href="{{ $trx->poa_document }}" target="_blank">Power Of
                                                    Attorney</a></li>
                                            <li><a href="{{ $trx->award_notification }}" target="_blank">Notification
                                                    of Award from Procuring Entity</a></li>
                                            <li><a href="{{ $trx->acceptance_letter }}" target="_blank">Acceptance
                                                    Letter</a></li>
                                            <li><a href="{{ $trx->boq_beme }}" target="_blank">BOQ or BEME</a></li>
                                            <li><a href="{{ $trx->donee_company_profile }}" target="_blank">Company
                                                    Profile of the Donee Company</a></li>
                                        </ol>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Amount Payable:</b></td>
                                    <td>&#8358;{{ number_format($trx->amount_paid, 2) }}</td>
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
                                        <td><b>Reason For Rejection</b></td>
                                        <td>{{ $trx->rejection_reason }}</td>
                                    </tr>
                                @endif

                            </table>

                        </div>
                        <div class="col-md-8"></div>
                        <!-- button -->
                        @if ($trx->status != 'pending' && $trx->status != 'payment failed' && $trx->status != 'rejected')
                            <div class="col-12">
                                <a href="{{ route('receipt.powerOfAttorney', [$trx->reference_number]) }}"
                                    target="_blank"><button class="btn btn-success w-100" type="button">Print Payment
                                        Receipt</button></a>
                            </div>
                        @endif

                        @if ($trx->status == 'rejected')
                            <div class="col-12">
                                <a href="{{ route('business.editPoaApplication', [$trx->reference_number]) }}"><button
                                        class="btn btn-success w-100" type="button">Update Application</button></a>
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
    document.getElementById("poa").classList.add('active');
</script>

@endsection
