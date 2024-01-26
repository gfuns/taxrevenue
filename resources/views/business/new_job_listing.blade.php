@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | New Job Listing')

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

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
    <form method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
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

                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="category">Skill Level</label>
                            <select class="form-select text-dark" id="category" required>
                                <option value="">Skill Level</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Expert">Expert</option>
                            </select>
                            <div class="invalid-feedback">Please choose skill level.</div>
                        </div>

                        <div class="mb-4 col-md-12">
                            <label class="form-label" for="category">Job Description</label>
                            <textarea id="editor1" name="description" class="form-control" placeholder="Job Description" required></textarea>
                            <div class="invalid-feedback">Please enter job description.</div>
                        </div>

                        <div class="mb-4 col-md-12">
                            <label class="form-label" for="category">Job Requirements</label>
                            <textarea id="editor2" name="requirements" class="form-control" placeholder="Job Requirements" required></textarea>
                            <div class="invalid-feedback">Please enter job requirements.</div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="openPositions" class="form-label">Open Positions</label>
                                <input type="text" name="open_positions" id="openPositions"
                                    class="form-control text-dark " placeholder="Open Positions" required>
                                <div class="invalid-feedback">Please enter open positions.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="duration" class="form-label">Project Duration (In Months)</label>
                                <input type="text" name="project_duration" id="duration"
                                    class="form-control text-dark " placeholder="Project Duration (In Months)" required>
                                <div class="invalid-feedback">Please enter project duration.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">Country</label>
                                <input type="text" id="selectDate" class="form-control text-dark "
                                    placeholder="Select Application Opening Date" required>
                                <div class="invalid-feedback">Please select valid date.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">State</label>
                                <input type="text" id="selectDate" class="form-control text-dark "
                                    placeholder="Select Application Closing Date" required>
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
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="workMode" class="form-label">Work Mode</label>
                                <select name="work_mode" class="form-select text-dark" id="workMode" required>
                                    <option value="">Work Mode</option>
                                    <option value="n-Office">In-Office</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Hybrid">Hybrid</option>
                                </select>
                                <div class="invalid-feedback">Please select work mode.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="paymentSchedule" class="form-label">Payment Schedule</label>
                                <select name="paymen_schedule" class="form-select text-dark" id="paymentSchedule"
                                    required>
                                    <option value="">Payment Schedule</option>
                                    <option value="Hourly">Hourly</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Milestone Dependent">Milestone Dependent</option>
                                    <option value="End of Project">End of Project</option>
                                </select>
                                <div class="invalid-feedback">Please select payment schedule.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="minimumSalary" class="form-label">Minimum Expected Renumeration</label>
                                <input type="text" name="minimum_renumeration" id="minimumSalary"
                                    class="form-control text-dark" placeholder="Minimum Expected Renumeration"
                                    required>
                                <div class="invalid-feedback">Please enter minimum expected renumeration.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="maximumSalary" class="form-label">Maximum Expected Renumeration</label>
                                <input type="text" name="maximum_renumeration" id="maximumSalary"
                                    class="form-control text-dark" placeholder="Maximum Expected Renumeration"
                                    required>
                                <div class="invalid-feedback">Please enter maximum expected renumeration.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">Application Opening Date</label>
                                <input type="text" id="selectDate" class="form-control text-dark flatpickr"
                                    placeholder="Select Application Opening Date" required>
                                <div class="invalid-feedback">Please select valid date.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">Application Closing Date</label>
                                <input type="text" id="selectDate" class="form-control text-dark flatpickr"
                                    placeholder="Select Application Closing Date" required>
                                <div class="invalid-feedback">Please select valid date.</div>
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
                                <input class="form-check-input" type="checkbox" value="{{ $jc->id }}"
                                    id="{{ $jc->id }}">
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


                <div class="card mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-lg-flex">
                        <h4 class="mb-0">Featured Files and Images</h4>
                    </div>
                    <!-- List group -->
                    <div class="p-4">

                        @foreach ($files as $file)
                            <div class="row justify-content-between align-items-center mb-1">
                                <!-- col -->
                                <div class="col-10">
                                    <div class="d-md-flex">
                                        <div>
                                            <!-- img -->
                                            <img src="{{ $file->asset_url }}" alt=""
                                                class="icon-shape icon-lg rounded">
                                        </div>

                                        <div class="ms-md-4 mt-lg-0">
                                            <!-- heading -->
                                            <p class="mb-1">{{ $file->asset_name }}</p>
                                            <!-- text -->
                                        </div>
                                    </div>
                                </div>
                                <!-- button -->
                                <div class="col-2 d-grid">
                                    <a href="" class="mb-2" style="color:red"><i
                                            class="fe fe-trash"></i></a>
                                </div>
                            </div>
                            <hr />
                        @endforeach


                    </div>
                </div>

                <div class="card mt-4 mt-lg-0 mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-lg-flex">
                        <h4 class="mb-0">Status</h4>
                    </div>
                    <!-- List Group -->
                    <div class="p-3 col-md-12">
                        <select name="jobStatus" class="form-select text-dark" id="jobStatus" required>
                            <option value="">Status</option>
                            <option value="Hourly">Draft</option>
                            <option value="Weekly">Publish</option>
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
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
</script>
@endsection
