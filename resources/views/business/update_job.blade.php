@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Update Job Details')

<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Update Job Details</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="admin-dashboard.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('business.jobListing') }}">Job Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Update Job Details</li>
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
    <form method="POST" action="{{ route('business.updateJobListing') }}" lass="needs-validation"
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
                            <input type="text" name="job_title" id="jobTitle" value="{{ $jobDetails->job_title }}"
                                class="form-control text-dark" placeholder="Job Title" required>
                            {{-- <small>Keep your post titles under 60 characters. Write heading that describe the
                                job. Contextualize for Your Audience.</small> --}}
                            <div class="invalid-feedback">Please enter job title.</div>
                        </div>

                        <div class="mb-3 col-md-12">
                            <!-- Title -->
                            <label for="postTitle" class="form-label">Job Tags</label>
                            <input name="tags" id="tags" value="{{ implode(', ', $jobDetails->tags) }}"
                                class="w-100" required placeholder="Job Tags">
                            {{-- <small>Keep your post titles under 60 characters. Write heading that describe the
                                job. Contextualize for Your Audience.</small> --}}
                            <div class="invalid-feedback">Please enter job tags.</div>
                        </div>



                        <div class="mb-4 col-md-12">
                            <label class="form-label" for="category">Company Description</label>
                            <textarea id="editor2" name="company_description" class="form-control" placeholder="Company Description" required>@php echo $jobDetails->company_description @endphp</textarea>
                            <div class="invalid-feedback">Please enter company description.</div>
                        </div>

                        <div class="mb-4 col-md-12">
                            <label class="form-label" for="category">Job Description</label>
                            <textarea id="editor1" name="job_description" class="form-control" placeholder="Job Description" required>@php echo $jobDetails->job_description @endphp</textarea>
                            <div class="invalid-feedback">Please enter job description.</div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="workMode" class="form-label">Work Location</label>
                                <select name="work_location" class="form-select text-dark" id="workMode" required>
                                    <option value="" disabled>Work Location</option>
                                    <option value="on-site" @if ($jobDetails->location == 'in-office') selected @endif>In-Office
                                    </option>
                                    <option value="remote" @if ($jobDetails->location == 'remote') selected @endif>Remote
                                    </option>
                                    <option value="hybrid" @if ($jobDetails->location == 'hybrid') selected @endif>Hybrid
                                    </option>
                                </select>
                                <div class="invalid-feedback">Please select work location.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="paymentSchedule" class="form-label">Payment Schedule</label>
                                <select name="payment_schedule" class="form-select text-dark" id="paymentSchedule"
                                    required>
                                    <option value="" disabled>Payment Schedule</option>
                                    <option value="Hourly" @if ($jobDetails->salary_rate == 'Hourly') selected @endif>Hourly
                                    </option>
                                    <option value="Daily" @if ($jobDetails->salary_rate == 'Daily') selected @endif>Daily
                                    </option>
                                    <option value="Weekly" @if ($jobDetails->salary_rate == 'Weekly') selected @endif>Weekly
                                    </option>
                                    <option value="Monthly" @if ($jobDetails->salary_rate == 'Monthly') selected @endif>Monthly
                                    </option>
                                </select>
                                <div class="invalid-feedback">Please select payment schedule.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="minimumSalary" class="form-label">Minimum Expected Renumeration</label>
                                <input type="text" name="minimum_renumeration" id="minimumSalary"
                                    class="form-control text-dark" placeholder="Minimum Expected Renumeration"
                                    oninput="validateInput(event)" value="{{ $jobDetails->minimum_salary }}" required>
                                <div class="invalid-feedback">Please enter minimum expected renumeration.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="maximumSalary" class="form-label">Maximum Expected Renumeration</label>
                                <input type="text" name="maximum_renumeration" id="maximumSalary"
                                    class="form-control text-dark" placeholder="Maximum Expected Renumeration"
                                    oninput="validateInput(event)" value="{{ $jobDetails->maximum_salary }}" required>
                                <div class="invalid-feedback">Please enter maximum expected renumeration.</div>
                            </div>
                        </div>

                        <div id="physical" class="row">
                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">Country</label>
                                <select name="country" class="form-select text-dark" id="country" required>
                                    <option value="" disabled>Select Country</option>
                                    <option value="Nigeria" @if ($jobDetails->country == 'Nigeria') selected @endif>Nigeria
                                    </option>
                                </select>

                                {{-- <select class="form-control text-dark" name="country"
                                    onChange="print_state('state',this.selectedIndex);" id="country"
                                    style="width:100%" required>
                                </select> --}}
                                <div class="invalid-feedback">Please select a valid country.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">State</label>
                                <select name="state" class="form-select text-dark" id="state" required>
                                    <option value="" disabled>Select State</option>
                                    <option value="Abia" @if ($jobDetails->state == 'Abia') selected @endif>Abia
                                    </option>
                                    <option value="Abuja (FCT)" @if ($jobDetails->state == 'Abuja (FCT)') selected @endif>
                                        Abuja - Federal Capital Territory</option>
                                    <option value="Adamawa" @if ($jobDetails->state == 'Adamawa') selected @endif>
                                        Adamawa</option>
                                    <option value="Akwa Ibom" @if ($jobDetails->state == 'Akwa Ibom') selected @endif>Akwa
                                        Ibom</option>
                                    <option value="Anambra" @if ($jobDetails->state == 'Anambra') selected @endif>
                                        Anambra</option>
                                    <option value="Bauchi" @if ($jobDetails->state == 'Bauchi') selected @endif>Bauchi
                                    </option>
                                    <option value="Bayelsa" @if ($jobDetails->state == 'Bayelsa') selected @endif>
                                        Bayelsa</option>
                                    <option value="Benue" @if ($jobDetails->state == 'Benue') selected @endif>Benue
                                    </option>
                                    <option value="Borno" @if ($jobDetails->state == 'Borno') selected @endif>Borno
                                    </option>
                                    <option value="Cross River" @if ($jobDetails->state == 'Cross River') selected @endif>
                                        Cross River</option>
                                    <option value="Delta" @if ($jobDetails->state == 'Delta') selected @endif>Delta
                                    </option>
                                    <option value="Ebonyi" @if ($jobDetails->state == 'Ebonyi') selected @endif>
                                        Ebonyi</option>
                                    <option value="Edo" @if ($jobDetails->state == 'Edo') selected @endif>Edo
                                    </option>
                                    <option value="Ekiti" @if ($jobDetails->state == 'Ekiti') selected @endif>Ekiti
                                    </option>
                                    <option value="Enugu" @if ($jobDetails->state == 'Enugu') selected @endif>Enugu
                                    </option>
                                    <option value="Gombe" @if ($jobDetails->state == 'Gombe') selected @endif>Gombe
                                    </option>
                                    <option value="Imo" @if ($jobDetails->state == 'Imo') selected @endif>Imo
                                    </option>
                                    <option value="Jigawa" @if ($jobDetails->state == 'Jigawa') selected @endif>
                                        Jigawa</option>
                                    <option value="Kaduna" @if ($jobDetails->state == 'Kaduna') selected @endif>
                                        Kaduna</option>
                                    <option value="Kano" @if ($jobDetails->state == 'Kano') selected @endif>Kano
                                    </option>
                                    <option value="Katsina" @if ($jobDetails->state == 'Katsina') selected @endif>
                                        Katsina</option>
                                    <option value="Kebbi" @if ($jobDetails->state == 'Kebbi') selected @endif>Kebbi
                                    </option>
                                    <option value="Kogi" @if ($jobDetails->state == 'Kogi') selected @endif>Kogi
                                    </option>
                                    <option value="kwara" @if ($jobDetails->state == 'Kwara') selected @endif>Kwara
                                    </option>
                                    <option value="Lagos" @if ($jobDetails->state == 'Lagos') selected @endif>Lagos
                                    </option>
                                    <option value="Nassarawa" @if ($jobDetails->state == 'Nassarawa') selected @endif>
                                        Nassarawa</option>
                                    <option value="Niger" @if ($jobDetails->state == 'Niger') selected @endif>Niger
                                    </option>
                                    <option value="Ogun" @if ($jobDetails->state == 'Ogun') selected @endif>Ogun
                                    </option>
                                    <option value="Ondo" @if ($jobDetails->state == 'Ondo') selected @endif>Ondo
                                    </option>
                                    <option value="Osun" @if ($jobDetails->state == 'Osun') selected @endif>Osun
                                    </option>
                                    <option value="Oyo" @if ($jobDetails->state == 'Oyo') selected @endif>Oyo
                                    </option>
                                    <option value="Plateau" @if ($jobDetails->state == 'Plateau') selected @endif>
                                        Plateau</option>
                                    <option value="Rivers" @if ($jobDetails->state == 'Rivers') selected @endif>
                                        Rivers</option>
                                    <option value="Sokoto" @if ($jobDetails->state == 'Sokoto') selected @endif>
                                        Sokoto</option>
                                    <option value="Taraba" @if ($jobDetails->state == 'Taraba') selected @endif>
                                        Taraba</option>
                                    <option value="Yobe" @if ($jobDetails->state == 'Yobe') selected @endif>Yobe
                                    </option>
                                    <option value="Zamfara" @if ($jobDetails->state == 'Zamfara') selected @endif>
                                        Zamfara</option>
                                </select>


                                {{-- <select class="form-control text-dark" name="state" id="state"
                                    style="width:100%"></select>
                                <script language="javascript">
                                    print_country("country");
                                </script> --}}
                                <div class="invalid-feedback">Please select a valid state.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" id="city" value="{{ $jobDetails->city }}"
                                    class="form-control text-dark" placeholder="City" required>
                                <div class="invalid-feedback">Please enter city.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="officeAddress" class="form-label">Office Address</label>
                                <input type="text" name="office_address" value="{{ $jobDetails->office_address }}"
                                    id="officeAddress" class="form-control text-dark" placeholder="Office Address" required>
                                <div class="invalid-feedback">Please enter office address.</div>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="applicationURL" class="form-label">Application URL</label>
                                <input type="text" name="application_url" value="{{ $jobDetails->application_url }}"
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
                                    value="{{ $jc->id }}" id="{{ $jc->id }}"
                                    {{ in_array($jc->id, explode(', ', $jobDetails->getOriginalCategories())) ? 'checked' : '' }}>
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
                                id="Full Time" @if ($jobDetails->engagement_type == 'Full Time') checked @endif>
                            <label class="form-check-label" for="all">Full Time</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="engagement_type" value="Part Time"
                                id="Part Time" @if ($jobDetails->engagement_type == 'Part Time') checked @endif>
                            <label class="form-check-label" for="all">Part Time</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="engagement_type" value="Internship"
                                id="Internship" @if ($jobDetails->engagement_type == 'Internship') checked @endif>
                            <label class="form-check-label" for="all">Internship</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="engagement_type" value="Contract"
                                id="Contract" @if ($jobDetails->engagement_type == 'Contract') checked @endif>
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
                            <option value="draft" @if ($jobDetails->status == 'draft') selected @endif>Draft</option>
                            <option value="published" @if ($jobDetails->status == 'published') selected @endif>Publish
                            </option>
                        </select>
                    </div>

                    <input type="hidden" name="job_id" value="{{ $jobDetails->id }}" required>

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
        var country = {{ Js::from($jobDetails->country) }};
        $('#country').select2().val(country).trigger('change');
    });

    $(document).ready(function() {
        var state = {{ Js::from($jobDetails->state) }};
        $('#state').select2().val(state).trigger('change');
    });
</script>
@endsection
