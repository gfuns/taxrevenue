@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | New Job Listing')

<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Add New Job</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="admin-dashboard.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('business.jobListing') }}">Job Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">New Job Listing</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('business.jobListing') }}" class="btn btn-outline-secondary">Back to Job
                        Listing</a>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('business.storeJobListing') }}" lass="needs-validation"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                <!-- Card -->
                <div class="card border-0 mb-4">
                    <!-- Card header -->
                    <div class="card-header">
                        <h4 class="mb-0">Job Details</h4>
                    </div>

                    <!-- Card body -->
                    <div class="card-body">

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label for="postTitle" class="form-label">Job Title</label>
                            <input type="text" name="job_title" id="jobTitle" class="form-control text-dark"
                                placeholder="Job Title" required>
                            {{-- <small>Keep your post titles under 60 characters. Write heading that describe the
                                job. Contextualize for Your Audience.</small> --}}
                            <div class="invalid-feedback">Please enter job title.</div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label for="postTitle" class="form-label">Job Tags</label>
                            <input name="tags" id="tags" value="" class="w-100" required
                                placeholder="Job Tags">
                            {{-- <small>Keep your post titles under 60 characters. Write heading that describe the
                                job. Contextualize for Your Audience.</small> --}}
                            <div class="invalid-feedback">Please enter job tags.</div>
                        </div>

                        <div class="mb-4 col-md-12">
                            <label class="form-label" for="category">Company Description</label>
                            <textarea id="editor2" name="company_description" class="form-control" placeholder="Company Description" required></textarea>
                            <div class="invalid-feedback">Please enter company description.</div>
                        </div>

                        <div class="mb-4 col-md-12">
                            <label class="form-label" for="category">Job Description</label>
                            <textarea id="editor1" name="job_description" class="form-control" placeholder="Job Description" required></textarea>
                            <div class="invalid-feedback">Please enter job description.</div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="workMode" class="form-label">Work Location</label>
                                <select name="work_location" class="form-select text-dark" id="workMode" required>
                                    <option value="">Work Location</option>
                                    <option value="in-office">In-Office</option>
                                    <option value="remote">Remote</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                                <div class="invalid-feedback">Please select work location.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="paymentSchedule" class="form-label">Payment Schedule</label>
                                <select name="payment_schedule" class="form-select text-dark" id="paymentSchedule"
                                    required>
                                    <option value="">Payment Schedule</option>
                                    <option value="Hourly">Hourly</option>
                                    <option value="Daily">Daily</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
                                </select>
                                <div class="invalid-feedback">Please select payment schedule.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="minimumSalary" class="form-label">Minimum Expected Renumeration</label>
                                <input type="text" name="minimum_renumeration" id="minimumSalary"
                                    class="form-control text-dark" placeholder="Minimum Expected Renumeration"
                                    oninput="validateInput(event)" required>
                                <div class="invalid-feedback">Please enter minimum expected renumeration.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="maximumSalary" class="form-label">Maximum Expected Renumeration</label>
                                <input type="text" name="maximum_renumeration" id="maximumSalary"
                                    class="form-control text-dark" placeholder="Maximum Expected Renumeration"
                                    oninput="validateInput(event)" required>
                                <div class="invalid-feedback">Please enter maximum expected renumeration.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">Country</label>
                                <select name="country" class="form-select text-dark" id="country" required>
                                    <option value="">Select Country</option>
                                    <option value="Nigeria">Nigeria</option>
                                </select>

                                {{-- <select class="form-control text-dark" required="required" name="country"
                                    onChange="print_state('state',this.selectedIndex);" id="country"
                                    style="width:100%" required>
                                </select> --}}
                                <div class="invalid-feedback">Please select a valid country.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">State</label>
                                <select name="state" class="form-select text-dark" id="state" required>
                                    <option value="">Select State</option>
                                    <option value="Abia">Abia</option>
                                    <option value="Abuja (FCT)">Abuja - Federal Capital Territory</option>
                                    <option value="Adamawa">Adamawa</option>
                                    <option value="Akwa Ibom">Akwa Ibom</option>
                                    <option value="Anambra">Anambra</option>
                                    <option value="Bauchi">Bauchi</option>
                                    <option value="Bayelsa">Bayelsa</option>
                                    <option value="Benue">Benue</option>
                                    <option value="Borno">Borno</option>
                                    <option value="Cross River">Cross River</option>
                                    <option value="Delta">Delta</option>
                                    <option value="Ebonyi">Ebonyi</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Ekiti">Ekiti</option>
                                    <option value="Enugu">Enugu</option>
                                    <option value="Gombe">Gombe</option>
                                    <option value="Imo">Imo</option>
                                    <option value="Jigawa">Jigawa</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Katsina">Katsina</option>
                                    <option value="Kebbi">Kebbi</option>
                                    <option value="Kogi">Kogi</option>
                                    <option value="kwara">Kwara</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Nassarawa">Nassarawa</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Ogun">Ogun</option>
                                    <option value="Ondo">Ondo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Sokoto">Sokoto</option>
                                    <option value="Taraba">Taraba</option>
                                    <option value="Yobe">Yobe</option>
                                    <option value="Zamfara">Zamfara</option>
                                </select>


                                {{-- <select class="form-control text-dark" required name="state" id="state"
                                    style="width:100%"></select>
                                <script language="javascript">
                                    print_country("country");
                                </script> --}}
                                <div class="invalid-feedback">Please select valid date.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" id="city" class="form-control text-dark"
                                    placeholder="City" required>
                                <div class="invalid-feedback">Please enter city.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="officeAddress" class="form-label">Office Address</label>
                                <input type="text" name="office_address" id="officeAddress"
                                    class="form-control text-dark" placeholder="Office Address" required>
                                <div class="invalid-feedback">Please enter office address.</div>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="applicationURL" class="form-label">Application URL</label>
                                <input type="text" name="application_url" value=""
                                    id="applicationURL" class="form-control text-dark" placeholder="Application URL" required>
                                <div class="invalid-feedback">Please enter application url.</div>
                            </div>
                        </div>


                        <!-- button -->
                    </div>

                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                <!-- Card -->

                <div class="card mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-lg-flex">
                        <h4 class="mb-0">Job Categories</h4>
                    </div>
                    <!-- List group -->
                    <div class="p-4">
                        @foreach ($jobCategories as $jc)
                            <!-- form check -->
                            <div class="form-check mb-2">
                                <input class="form-check-input" name="categories[]" type="checkbox"
                                    value="{{ $jc->id }}" id="{{ $jc->id }}">
                                <label class="form-check-label"
                                    for="{{ $jc->id }}">{{ $jc->category_name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-lg-flex">
                        <h4 class="mb-0">Engagement Types</h4>
                    </div>
                    <!-- List group -->
                    <div class="p-4">

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="engagement_type" value="Full Time"
                                id="Full Time">
                            <label class="form-check-label" for="all">Full Time</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="engagement_type" value="Part Time"
                                id="Part Time">
                            <label class="form-check-label" for="all">Part Time</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="engagement_type" value="Internship"
                                id="Internship">
                            <label class="form-check-label" for="all">Internship</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="engagement_type" value="Contract"
                                id="Contract">
                            <label class="form-check-label" for="all">Contract</label>
                        </div>


                    </div>
                </div>



                <div class="card mt-4 mt-lg-0 mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-lg-flex">
                        <h4 class="mb-0">Status</h4>
                    </div>
                    <!-- List Group -->
                    <div class="p-3 col-md-12">
                        <select name="job_status" class="form-select text-dark" id="jobStatus" required>
                            <option value="draft">Draft</option>
                            <option value="published" selected>Publish</option>
                        </select>
                    </div>

                    <button type="submit" class="m-3 btn btn-primary"
                        style="background: #690068; border: #690068"><i class="fe fe-save"></i>&nbsp; Save</button>

                    <!-- Card -->
                </div>
                <!-- Card  -->
            </div>
        </div>
    </form>
</section>



<script type="text/javascript">
    document.getElementById("jobs").classList.add('active');
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



<script type="text/javascript">
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');

    $(document).ready(function() {
            $('#country').select2();
        });

        $(document).ready(function() {
            $('#state').select2();
        });
</script>
@endsection
