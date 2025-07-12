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
                        <h4 class="mb-0">Company {{ ucwords($company->application_type) }} Application > Company
                            Documents
                        </h4>
                    </div>
                    <div>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadDocument"
                            data-backdrop="static">Upload Document</button>
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
                                <th>Document Title</th>
                                <th>Uploaded Document</th>
                                <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($documents as $doc)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $doc->docs->document_title }}</td>
                                    <td><a href="{{ $doc->document }}" target="_blank"><button class="btn btn-success btn-sm">View Document</button></a></td>
                                    <td class="align-middle">
                                        <div class="hstack gap-4">
                                            <span class="dropdown dropstart">
                                                <a class="btn btn-success bg-light-success text-success btn-sm"
                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                    data-bs-offset="-20,20" aria-expanded="false">Action</a>
                                                <span class="dropdown-menu"><span class="dropdown-header">Action</span>
                                                    <a class="dropdown-item"
                                                        href="{{ route('business.removeDocument', [$doc->id]) }}"
                                                        onclick="return confirm('Are you sure you want to remove this document?');"><i
                                                            class="fe fe-trash dropdown-item-icon"></i>Remove
                                                        Document</a>
                                                </span>
                                            </span>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if (count($documents) < 1)
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
                @if (count($documents) > 0)
                    <div class="col-12 p-4">
                        <a href="{{ route('business.previewApplication', [$company->id]) }}"><button
                                class="btn btn-success w-100" type="submit">Submit And Proceed</button></a>
                    </div>
                @endif
            </div>

        </div>
    </div>
    </div>

</section>

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
                        <select name="document_title" class="form-select text-dark" id="docTitle" style="width: 100%" required>
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
