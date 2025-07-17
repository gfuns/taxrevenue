@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Contractor Registration Details')

<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Contractor Registration Details</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Contractor Registration Details</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            @if ($company->status == 'rejected')
                <div class="alert alert-danger">Your application was rejected for the following
                    reason(s):<br />{{ $company->rejection_reason }}<br />Please update your registration details below
                    and re-submit for review</div>
            @endif
            <!-- Card -->
            <div class="card border-0 mb-4">
                <!-- Card header -->
                <div class="card-header d-lg-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">Update Application Details
                        </h4>
                    </div>
                </div>

                <form class="needs-validation" novalidate method="post"
                    action="{{ route('business.updateRegDetails') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-4 col-md-12">

                        @if ($company->application_type == 'revalidation')
                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>BSPPC
                                        Number:</strong></div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="bsppc_number" id="bsppcNumber"
                                        class="form-control text-dark" placeholder="BSPPC Number"
                                        value="{{ $company->bsppc_number }}" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>
                        @endif

                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>CAC Registration
                                    Number:</strong></div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <input type="text" name="cac_number" id="cacNumber" class="form-control text-dark"
                                    placeholder="CAC Registration Number" value="{{ $company->cac_number }}" required>
                                <div class="invalid-feedback">Please provide a response.</div>
                            </div>
                        </div>

                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Company Name:</strong>
                            </div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <input type="text" name="company_name" id="companyName"
                                    class="form-control text-dark" placeholder="Company Name"
                                    value="{{ $company->company_name }}" required>
                                <div class="invalid-feedback">Please provide a response.</div>
                            </div>
                        </div>

                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Company
                                    Address:</strong>
                            </div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <input type="text" name="company_adress" id="companyAddress"
                                    class="form-control text-dark" placeholder="Company Address"
                                    value="{{ $company->company_address }}" required>
                                <div class="invalid-feedback">Please provide a response.</div>
                            </div>
                        </div>

                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>What Business Do You
                                    Seek
                                    Registration
                                    For?</strong></div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <div class="row ms-2">
                                    @foreach ($bizCategories as $bc)
                                        <!-- form check -->
                                        <div class="form-check mb-2 col-md-6 col-sm-6">
                                            <input class="form-check-input" name="categories[]" type="checkbox"
                                                value="{{ $bc->id }}" id="{{ $bc->id }}"
                                                {{ in_array($bc->id, $company->selectedIds()) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="{{ $bc->id }}">{{ $bc->category }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="catinvalid" class="invalid-feedback">Please select a category.</div>
                            </div>
                        </div>

                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Are You Registered With
                                    Any Works Registration
                                    Board?</strong></div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <select name="prev_registered" class="form-select text-dark" id="auttrigger1" required>
                                    <option value="">Select Response</option>
                                    <option value="yes" @if ($company->prev_reg == 'yes') selected @endif>Yes
                                    </option>
                                    <option value="no" @if ($company->prev_reg == 'no') selected @endif>No
                                    </option>
                                </select>
                                <div class="invalid-feedback">Please select a response.</div>
                            </div>
                        </div>

                        <div id="autopt1" @if ($company->prev_reg == 'no') style="display: none" @endif>
                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Which
                                        Class?</strong>
                                </div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <select name="prev_class" class="form-select text-dark" id="prevClass"
                                        style="width: 100%">
                                        <option value="">Select Class</option>
                                        <option value="A" @if ($company->prev_reg_class == 'A') selected @endif>
                                            Class A</option>
                                        <option value="B" @if ($company->prev_reg_class == 'B') selected @endif>
                                            Class B</option>
                                        <option value="C" @if ($company->prev_reg_class == 'C') selected @endif>
                                            Class C</option>
                                        <option value="D" @if ($company->prev_reg_class == 'D') selected @endif>
                                            Class D</option>
                                        <option value="E" @if ($company->prev_reg_class == 'E') selected @endif>
                                            Class E</option>
                                        <option value="F" @if ($company->prev_reg_class == 'F') selected @endif>
                                            Class F</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a response.</div>
                                </div>
                            </div>

                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Where?</strong>
                                </div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="prev_location" id="where"
                                        class="form-control text-dark" value="{{ $company->prev_reg_where }}"
                                        placeholder="Where?">
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>

                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>For What
                                        Works?</strong></div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="prev_works" id="whatworks"
                                        class="form-control text-dark" value="{{ $company->prev_reg_works }}"
                                        placeholder="For What Works?">
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>

                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>When?</strong>
                                </div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="prev_period" id="when"
                                        class="form-control text-dark" value="{{ $company->prev_reg_when }}"
                                        placeholder="When?">
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>

                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>What Is The
                                        Registration Number Of The
                                        Certificate?</strong></div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="prev_reg_number" id="certNo"
                                        class="form-control text-dark"
                                        placeholder="Registration Number Of The Certificate"
                                        value="{{ $company->prev_reg_no }}">
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>

                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Is The
                                        Certiticate Of
                                        Registration Still Valid?</strong></div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <select name="certificate_validity" class="form-select text-dark"
                                        id="auttrigger4" style="width: 100%">
                                        <option value="">Select Response</option>
                                        <option value="yes" @if ($company->prev_reg_valid == 'yes') selected @endif>
                                            Yes</option>
                                        <option value="no" @if ($company->prev_reg_valid == 'no') selected @endif>
                                            No</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a response.</div>
                                </div>
                            </div>

                            <div id="autopt4" @if ($company->prev_reg_valid == 'yes') style="display: none" @endif>
                                <div class="row ps-4 col-lg-12 col-12 mb-3">
                                    <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>If Not
                                            Why?</strong>
                                    </div>
                                    <div class="col-12 col-md-7 col-lg-7">
                                        <input type="text" name="invalidity_reason" id="invalidityReason"
                                            class="form-control text-dark"
                                            placeholder="Why is certificate no longer valid?"
                                            value="{{ ucwords($company->prev_reg_invalid_reason) }}">
                                        <div class="invalid-feedback">Please provide a response.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Do You Have
                                    Experience
                                    Or Qualification In the
                                    Field You Wish To Be Registered?</strong></div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <select name="business_experience" class="form-select text-dark" id="auttrigger2"
                                    required>
                                    <option value="">Select Response</option>
                                    <option value="yes" @if ($company->business_experience == 'yes') selected @endif>
                                        Yes
                                    </option>
                                    <option value="no" @if ($company->business_experience == 'no') selected @endif>
                                        No
                                    </option>
                                </select>
                                <div class="invalid-feedback">Please provide a response.</div>
                            </div>
                        </div>

                        <div id="autopt2" @if ($company->business_experience == 'no') style="display: none" @endif>
                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Give Details Of
                                        Your
                                        Experience In The
                                        Business:</strong></div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="experience_details" id="experienceDet"
                                        class="form-control text-dark" value="{{ $company->experience_details }}"
                                        placeholder="Give Details Of Your Experience In The Business">
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>How Much Capital Do
                                    You Have Available For This Business?</strong></div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <input type="text" name="business_capital" id="capital"
                                    class="form-control text-dark" value="{{ $company->business_capital }}"
                                    placeholder="Are you Registered With Any Works Registration Board?"
                                    oninput="validateInput(event)" required>
                                <div class="invalid-feedback">Please provide a response.</div>
                            </div>
                        </div>

                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Do You Operate A
                                    Bank
                                    Account For Your
                                    Business?</strong></div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <select name="bank_exist" class="form-select text-dark" id="auttrigger3" required>
                                    <option value="">Select Response</option>
                                    <option value="yes" @if ($company->operate_bank == 'yes') selected @endif>
                                        Yes
                                    </option>
                                    <option value="no" @if ($company->operate_bank == 'no') selected @endif>
                                        No
                                    </option>
                                </select>
                                <div class="invalid-feedback">Please select a response.</div>
                            </div>
                        </div>

                        <div id="autopt3" @if ($company->operate_bank == 'no') style="display: none" @endif>
                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Bank
                                        Name:</strong>
                                </div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="bank_name" id="bankName"
                                        class="form-control text-dark" placeholder="Bank Name"
                                        value="{{ $company->bank_name }}" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>

                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Bank
                                        Branch:</strong>
                                </div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="bank_branch" id="bankBranch"
                                        class="form-control text-dark" placeholder="Bank Branch"
                                        value="{{ $company->bank_branch }}" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>

                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Account
                                        Number:</strong></div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="account_number" id="accNo"
                                        class="form-control text-dark" placeholder="Account Number"
                                        value="{{ $company->account_number }}" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>

                            <div class="row ps-4 col-lg-12 col-12 mb-3">
                                <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Postal
                                        Code:</strong>
                                </div>
                                <div class="col-12 col-md-7 col-lg-7">
                                    <input type="text" name="postal_address" id="postCode"
                                        class="form-control text-dark" placeholder="Postal Code"
                                        value="{{ $company->bank_postal_address }}" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row ps-4 col-lg-12 col-12 mb-3">
                            <div class="col-12 col-md-5 col-lg-5" style="color: #3a3939"><strong>Are You Applying For
                                    The Upgrading Of Your
                                    Former Registration Certificate?</strong></div>
                            <div class="col-12 col-md-7 col-lg-7">
                                <select name="upgrading" class="form-select text-dark" id="upgrading" required>
                                    <option value="">Select Response</option>
                                    <option value="yes" @if ($company->upgrade_application == 'yes') selected @endif>
                                        Yes
                                    </option>
                                    <option value="no" @if ($company->upgrade_application == 'no') selected @endif>
                                        No
                                    </option>
                                </select>
                                <div class="invalid-feedback">Please provide a response.</div>
                            </div>
                        </div>

                    </div>

                    @if (count($executedProjects) > 0)
                        <div class="p-4 table-responsive">
                            <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                                style="font-size: 14px">
                                <!-- Table Head -->
                                <thead class="table-light">
                                    <tr>
                                        <div class="d-lg-flex align-items-center justify-content-between"
                                            style="background: #f1f5f9; box-shadow: inset 0 0 0 9999px var(--geeks-table-accent-bg); padding: .45rem 1.5rem; border-bottom: 1px solid #e2e8f0">
                                            <div>
                                                <h4 class="betty mb-0">PAST CONTRACTS EXECUTED
                                                </h4>
                                            </div>
                                            <div>
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#addProject" data-backdrop="static">Add
                                                    Project</button>
                                            </div>
                                        </div>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Awarding Body</th>
                                        <th>Project Description</th>
                                        <th>Contract Sum</th>
                                        <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                    </tr>
                                    @foreach ($executedProjects as $ep)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $ep->awarding_body }}</td>
                                            <td>{{ $ep->contract_description }}</td>
                                            <td>&#8358;{{ number_format($ep->amount, 2) }}</td>
                                            <td class="align-middle">
                                                <a class="btn btn-danger btn-xs bg-light-danger text-danger"
                                                    href="{{ route('business.removeProject', [$ep->id]) }}"
                                                    onclick="return confirm('Are you sure you want to remove this project?');"><i
                                                        class="fe fe-trash dropdown-item-icon"
                                                        style="color:red"></i>Remove
                                                    Project</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @endif

                    <!-- Card body -->
                    <div class="p-4 table-responsive">
                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                            style="font-size: 14px">
                            <!-- Table Head -->
                            <thead class="table-light">
                                <tr>
                                    <div class="d-lg-flex align-items-center justify-content-between"
                                        style="background: #f1f5f9; box-shadow: inset 0 0 0 9999px var(--geeks-table-accent-bg); padding: .45rem 1.5rem; border-bottom: 1px solid #e2e8f0">
                                        <div>
                                            <h4 class="betty mb-0">UPLOADED COMPANY DOCUMENTS</h4>
                                        </div>
                                        <div>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#uploadDocument" data-backdrop="static">Upload
                                                Document</button>
                                        </div>
                                    </div>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Document Title</th>
                                    <th>Uploaded Document</th>
                                    <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                </tr>
                                @foreach ($documents as $doc)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $doc->docs->document_title }}</td>
                                        <td><a href="{{ $doc->document }}" target="_blank"><button
                                                    class="btn btn-success btn-xs">View Document</button></a></td>
                                        <td class="align-middle">
                                            <a class="btn btn-danger btn-xs bg-light-danger text-danger"
                                                href="{{ route('business.removeDocument', [$doc->id]) }}"
                                                onclick="return confirm('Are you sure you want to remove this document?');"><i
                                                    class="fe fe-trash dropdown-item-icon"
                                                    style="color:red"></i>Remove
                                                Document</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                        <div class="col-md-12 border-bottom"></div>
                        <input type="hidden" name="application_id" value="{{ $company->id }}" required>
                        <div class="col-12 mt-4">
                            <button class="btn btn-success w-100" type="submit">Submit Changes</button>
                        </div>

                    </div>
                    <!-- button -->
                    <div class="col-md-8 mt-5"></div>
                    <!-- button -->
                </form>
            </div>

        </div>
    </div>
    </div>

</section>
<div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    Add Executed Project
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form method="POST" action="{{ route('business.addProject') }}" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3 col-md-12">
                        <!-- Title -->
                        <label class="form-label">Awarding Body</label>
                        <input type="text" name="awarding_body" id="awardingBody" class="form-control text-dark"
                            placeholder="Awarding Body" required>
                        <div class="invalid-feedback">Please provide a response.</div>
                    </div>

                    <div class="mb-3 col-md-12">
                        <!-- Title -->
                        <label class="form-label">Contract Description</label>
                        <textarea name="contract_description" class="form-control text-dark" placeholder="Contract Description" required
                            rows="5" style="resize: none"></textarea>
                        <div class="invalid-feedback">Please provide a response.</div>
                    </div>

                    <div class="mb-3 col-md-12">
                        <!-- Title -->
                        <label class="form-label">Contract Amount</label>
                        <input type="text" name="contract_amount" id="contractAmount"
                            class="form-control text-dark" placeholder="Contract Amount"
                            oninput="validateInput(event)" required>
                        <div class="invalid-feedback">Please provide a response.</div>
                    </div>

                    <input type="hidden" name="company_id" value="{{ $company->id }}" required>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ms-2">Submit</button>
                    <button type="button" class="btn btn-outline-success ms-2"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="uploadDocument" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    Upload Document
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form method="POST" action="{{ route('business.uploadDocument') }}" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 col-md-12">
                        <!-- Title -->
                        <label class="form-label">Document Title</label>
                        <select name="document_title" class="form-select text-dark" id="docTitle"
                            style="width: 100%" required>
                            <option value="">Select Document</option>
                            @foreach ($uploadableDocs as $udoc)
                                <option value="{{ $udoc->id }}">{{ $udoc->document_title }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select document to be uploaded.</div>
                    </div>

                    <div class="mb-3 col-md-12">
                        <!-- Title -->
                        <label class="form-label">Upload Document</label>
                        <input type="file" name="document" id="document" class="form-control text-dark"
                            placeholder="Upload Document" accept="application/pdf" required>
                        <small style="color:red">Please Document Format Must Be Portable Document Format (PDF)</small>
                        <div class="invalid-feedback">Please upload document.</div>
                    </div>

                    <input type="hidden" name="company_id" value="{{ $company->id }}" required>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ms-2">Submit</button>
                    <button type="button" class="btn btn-outline-success ms-2"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("registration").classList.add('active');
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

    document.getElementById("appForm").addEventListener("submit", function(e) {
        const checkboxes = document.querySelectorAll('input[name="categories[]"]');
        const checked = document.querySelectorAll('input[name="categories[]"]:checked');
        if (checked.length === 0) {
            e.preventDefault(); // Stop form submission
            // Show the error message
            document.getElementById("catinvalid").style.display = "block";

            // Add red color to checkbox and labels
            checkboxes.forEach(cb => {
                cb.classList.add("is-invalid");
                const label = document.querySelector('label[for="' + cb.id + '"]');
                if (label) label.style.color = "red";
            });

            // document.querySelector('.invalid-feedback').style.display = 'block';
            // alert("Please select at least one business category.");
        }
    });
</script>
@endsection
