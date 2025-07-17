@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Processing Fee Remittance')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Processing Fee Remittance</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Processing Fee Remittance</a>
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
                <h4>Uupdate Application Details</h4>

                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">

                        <form class="needs-validation" novalidate method="post"
                            action="{{ route('business.updatePRFApplication') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- form group -->
                                <div class="mb-3 col-12">
                                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="company_name"
                                        placeholder="Company Name" value="{{ Auth::user()->company->company_name }}"
                                        required readonly>
                                    <div class="invalid-feedback">Please Provide Company Name.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Contract Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contract_name"
                                        placeholder="Contract Name" value="{{ $trx->contract_name }}" required>
                                    <div class="invalid-feedback">Please Provide Contract Name.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Contract Sum <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contract_sum"
                                        placeholder="Contract Sum" required value="{{ $trx->contract_amount }}"
                                        oninput="validateInput(event)">
                                    <div class="invalid-feedback">Please Provide Contract Sum.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Date of Award<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date_of_award"
                                        placeholder="Date of Award" value="{{ $trx->award_date }}" required>
                                    <div class="invalid-feedback">Please Provide Date of Award.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Contract Duration <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contract_duration"
                                        placeholder="Contract Duration" value="{{ $trx->contract_duration }}" required>
                                    <div class="invalid-feedback">Please Provide Contract Duration</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Procuring Entity (MDA) <span
                                            class="text-danger">*</span></label>
                                    <select id="umda" name="mda" class="form-select">
                                        <option value="">Select Procuring Entity (MDA)</option>
                                        @foreach ($mdas as $mda)
                                            <option value="{{ $mda->mda }}"
                                                @if ($trx->mda == $mda->mda) selected @endif>{{ $mda->mda }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please Select Procuring Entity (MDA)</div>
                                </div>

                                <input type="hidden" name="application_id" value="{{ $trx->id }}" required>
                                <div class="col-md-12 border-bottom"></div>
                                <!-- button -->
                                <div class="col-12 mt-4">
                                    <button class="btn btn-success w-100" type="submit">Submit Changes</button>
                                </div>
                            </div>
                        </form>
                        <!-- form -->


                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("processingfee").classList.add('active');
</script>

@endsection
