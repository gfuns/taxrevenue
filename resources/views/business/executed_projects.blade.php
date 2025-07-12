@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Company ' . ucwords($company->application_type))

<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Company {{ ucwords($company->application_type) }}</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Company {{ ucwords($company->application_type) }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card border-0 mb-4">
                <!-- Card header -->
                <div class="card-header d-lg-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">Company {{ ucwords($company->application_type) }} Application > Executed Projects
                        </h4>
                    </div>
                    <div>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addProject"
                            data-backdrop="static">Add Project</button>
                    </div>
                </div>

                <!-- Card body -->
                <div class="table-responsive">
                    <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                        style="font-size: 14px">
                        <!-- Table Head -->
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Awarding Body</th>
                                <th>Project Description</th>
                                <th>Contract Sum</th>
                                <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($executedProjects as $ep)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $ep->awarding_body }}</td>
                                    <td>{{ $ep->contract_description }}</td>
                                    <td>&#8358;{{ number_format($ep->amount, 2) }}</td>
                                    <td class="align-middle">
                                        <div class="hstack gap-4">
                                            <span class="dropdown dropstart">
                                                <a class="btn btn-success bg-light-success text-success btn-sm"
                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                    data-bs-offset="-20,20" aria-expanded="false">Action</a>
                                                <span class="dropdown-menu"><span class="dropdown-header">Action</span>
                                                    <a class="dropdown-item"
                                                        href="{{ route('business.removeProject', [$ep->id]) }}" onclick="return confirm('Are you sure you want to remove this project?');"><i
                                                            class="fe fe-trash dropdown-item-icon"></i>Remove Project</a>
                                                </span>
                                            </span>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if (count($executedProjects) < 1)
                                <tr>
                                    <td colspan="5">
                                        <center>No Record Found</center>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>

                </div>
                <!-- button -->
                <div class="col-md-8 mt-5"></div>
                <!-- button -->
                @if (count($executedProjects) > 0)
                    <div class="col-12 p-4">
                        <a href="{{ route("business.companyDocuments", [$company->id]) }}"><button class="btn btn-success w-100" type="submit">Submit And Proceed</button></a>
                    </div>
                @endif
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
                        <input type="text" name="contract_amount" id="contractAmount" class="form-control text-dark"
                            placeholder="Contract Amount" oninput="validateInput(event)" required>
                        <div class="invalid-feedback">Please provide a response.</div>
                    </div>

                    <input type="hidden" name="company_id" value="{{ $company->id }}" required>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ms-2">Submit</button>
                    <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="modal">Close</button>
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
</script>
@endsection
