@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Registration Renewals')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Registration Renewals </h1>
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
                            action="{{ route('business.updateRenewalApplication') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-12">
                                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="company_name"
                                        placeholder="Company Name" value="{{ Auth::user()->company->company_name }}"
                                        required readonly>
                                    <div class="invalid-feedback">Please Provide Company Name.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Company Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="company_address"
                                        placeholder="Company Address"
                                        value="{{ Auth::user()->company->company_address }}" required readonly>
                                    <div class="invalid-feedback">Please Provide Company Address.</div>
                                </div>

                                <!-- form group -->
                                <div class="mb-3 col-12">
                                    <label class="form-label">BSPPC Registration Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="registration_number"
                                        placeholder="BSPPC Registration Number"
                                        value="{{ Auth::user()->company->bsppc_number }}">
                                    <div class="invalid-feedback">Please Provide BSPPC Registration Number.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Expiry Date Of Previous Certificate<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="expiry_date"
                                        placeholder="Expiry Date" value="{{ $trx->expiry_date }}" required>
                                    <div class="invalid-feedback">Please Provide Expiry Date.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Director's Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone_number"
                                        placeholder="Director's Phone Number" value="{{ $trx->phone_number }}" required>
                                    <div class="invalid-feedback">Please Provide Director's Phone Number</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Company Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" value="{{ $trx->email }}"
                                        name="company_email" placeholder="Company Email" required>
                                    <div class="invalid-feedback">Please Provide Company Email</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Upload Previous BSPPC Certificate </label>
                                    <small style="color:green; display:block">Please Document Format Must Be Portable
                                        Document
                                        Format (PDF).</small>
                                    <input type="file" class="form-control" name="bsppc_certificate"
                                        accept="application/pdf" placeholder="Upload Previous BSPPC Certificate">
                                    <small style="color:red"><u>Note:</u> Existing contractors who are renewing for the
                                        first time
                                        on this platform should scan the passport page and the last update page of their
                                        green card
                                        in one single document before uploading.</small>
                                    <div class="invalid-feedback">Please Upload Previous BSPPC Certificate</div>
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
    document.getElementById("renewals").classList.add('active');
</script>

@endsection
