@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Company ' . $regType)

<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Company {{ $regType }}</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Company {{ $regType }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <form id="appForm" method="POST" action="{{ route('business.submitApplication') }}" class="needs-validation"
        novalidate>
        @csrf
        <div class="row">
            <div class="offset-xl-1 col-xl-10 col-lg-10 col-md-12 col-12">
                <!-- Card -->
                <div class="card border-0 mb-4">
                    <!-- Card header -->
                    <div class="card-header">
                        <h4 class="mb-0">Company {{ $regType }} Application</h4>
                    </div>

                    <!-- Card body -->
                    <div class="card-body">
                        @if ($regType == 'Revalidation')
                            <div class="mb-3 col-md-12">
                                <!-- Title -->
                                <label class="form-label">BSPPC Number</label>
                                <input type="text" name="bsppc_number" id="bsppcNumber"
                                    class="form-control text-dark" placeholder="BSPPC Number" required>
                                <div class="invalid-feedback">Please provide a response.</div>
                            </div>
                        @endif

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">CAC Registration Number</label>
                            <input type="text" name="cac_number" id="cacNumber" class="form-control text-dark"
                                placeholder="CAC Registration Number" required>
                            <div class="invalid-feedback">Please provide a response.</div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" id="companyName" class="form-control text-dark"
                                placeholder="Company Name" required>
                            <div class="invalid-feedback">Please provide a response.</div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">Company Address</label>
                            <input type="text" name="company_adress" id="companyAddress"
                                class="form-control text-dark" placeholder="Company Address" required>
                            <div class="invalid-feedback">Please provide a response.</div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">What Business Do You Seek Registration
                                For?</label>
                            <div class="row ms-2">
                                @foreach ($bizCategories as $bc)
                                    <!-- form check -->
                                    <div class="form-check mb-2 col-md-6 col-sm-6">
                                        <input class="form-check-input" name="categories[]" type="checkbox"
                                            value="{{ $bc->id }}" id="{{ $bc->id }}">
                                        <label class="form-check-label"
                                            for="{{ $bc->id }}">{{ $bc->category }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div id="catinvalid" class="invalid-feedback">Please select a category.</div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">Are You Registered With Any Works Registration
                                Board?</label>
                            <select name="prev_registered" class="form-select text-dark" id="auttrigger1" required>
                                <option value="">Select Response</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <div class="invalid-feedback">Please select a response.</div>
                        </div>

                        <div id="autopt1" style="display: none">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Which Class?</label>
                                    <select name="prev_class" class="form-select text-dark" id="prevClass"
                                        style="width: 100%">
                                        <option value="">Select Class</option>
                                        <option value="A">Class A</option>
                                        <option value="B">Class B</option>
                                        <option value="C">Class C</option>
                                        <option value="D">Class D</option>
                                        <option value="E">Class E</option>
                                        <option value="F">Class F</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a response.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Where?</label>
                                    <input type="text" name="prev_location" id="where"
                                        class="form-control text-dark" placeholder="Where?">
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">For What Works?</label>
                                    <input type="text" name="prev_works" id="whatworks"
                                        class="form-control text-dark" placeholder="For What Works?">
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">When?</label>
                                    <input type="text" name="prev_period" id="when"
                                        class="form-control text-dark" placeholder="When?">
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">What Is The Registration Number Of The
                                        Certificate?</label>
                                    <input type="text" name="prev_reg_number" id="certNo"
                                        class="form-control text-dark"
                                        placeholder="Registration Number Of The Certificate" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Is The Certiticate Of
                                        Registration Still Valid?</label>
                                    <select name="certificate_validity" class="form-select text-dark"
                                        id="auttrigger4" style="width: 100%">
                                        <option value="">Select Response</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a response.</div>
                                </div>

                                <div id="autopt4" style="display: none">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">If Not Why?</label>
                                        <input type="text" name="invalidity_reason" id="invalidityReason"
                                            class="form-control text-dark"
                                            placeholder="Why is certificate no longer valid?">
                                        <div class="invalid-feedback">Please provide a response.</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">Do You Have Experience Or Qualification In the
                                Field You Wish To Be Registered?</label>
                            <select name="business_experience" class="form-select text-dark" id="auttrigger2"
                                required>
                                <option value="">Select Response</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <div class="invalid-feedback">Please provide a response.</div>
                        </div>

                        <div id="autopt2" style="display: none">
                            <div class="mb-3 col-md-12">
                                <!-- Title -->
                                <label class="form-label">Give Details Of Your Experience In The
                                    Business</label>
                                <input type="text" name="experience_details" id="experienceDet"
                                    class="form-control text-dark"
                                    placeholder="Give Details Of Your Experience In The Business">
                                <div class="invalid-feedback">Please provide a response.</div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">How Much Capital Do You Have Available For This
                                Business?</label>
                            <input type="text" name="business_capital" id="capital"
                                class="form-control text-dark"
                                placeholder="Are you Registered With Any Works Registration Board?" oninput="validateInput(event)" required>
                            <div class="invalid-feedback">Please provide a response.</div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">Do You Operate A Bank Account For Your
                                Business?</label>
                            <select name="bank_exist" class="form-select text-dark" id="auttrigger3" required>
                                <option value="">Select Response</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <div class="invalid-feedback">Please select a response.</div>
                        </div>

                        <div id="autopt3" style="display: none">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" name="bank_name" id="bankName"
                                        class="form-control text-dark" placeholder="Bank Name" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Bank Branch</label>
                                    <input type="text" name="bank_branch" id="bankBranch"
                                        class="form-control text-dark" placeholder="Bank Branch" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Account Number</label>
                                    <input type="text" name="account_number" id="accNo"
                                        class="form-control text-dark" placeholder="Account Number" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Postal Address</label>
                                    <input type="text" name="postal_address" id="postCode"
                                        class="form-control text-dark" placeholder="Postal Code" required>
                                    <div class="invalid-feedback">Please provide a response.</div>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label class="form-label">Are You Applying For The Upgrading Of Your
                                Former Registration Certificate?</label>
                            <select name="upgrading" class="form-select text-dark" id="upgrading" required>
                                <option value="">Select Response</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <div class="invalid-feedback">Please provide a response.</div>
                        </div>

                        <input type="hidden" name="application_type" value="{{ strtolower($regType) }}" required>
                        <input type="hidden" name="form_reference" value="{{ strtolower($formRef) }}" required>

                        <!-- button -->
                        <div class="col-md-8"></div>
                        <!-- button -->
                        <div class="col-12">
                            <button class="btn btn-success w-100" type="submit">Submit And Proceed</button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</section>



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
