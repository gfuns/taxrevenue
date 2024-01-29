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

                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="category">Skill Level</label>
                            <select name="skill_level" class="form-control form-select text-dark" id="category"
                                required>
                                <option value="">Skill Level</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Expert">Expert</option>
                            </select>
                            <div class="invalid-feedback">Please choose skill level.</div>
                        </div>

                        <div class="mb-4 col-md-12">
                            <label class="form-label" for="category">Job Description</label>
                            <textarea id="editor1" name="job_description" class="form-control" placeholder="Job Description" required></textarea>
                            <div class="invalid-feedback">Please enter job description.</div>
                        </div>

                        <div class="mb-4 col-md-12">
                            <label class="form-label" for="category">Job Requirements</label>
                            <textarea id="editor2" name="job_requirements" class="form-control" placeholder="Job Requirements" required></textarea>
                            <div class="invalid-feedback">Please enter job requirements.</div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="openPositions" class="form-label">Open Positions</label>
                                <input type="text" name="open_positions" id="openPositions"
                                    class="form-control text-dark " placeholder="Open Positions"
                                    oninput="validateInput(event)" required>
                                <div class="invalid-feedback">Please enter open positions.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="duration" class="form-label">Project Duration (In Months)</label>
                                <input type="text" name="project_duration" id="duration"
                                    class="form-control text-dark " placeholder="Project Duration (In Months)"
                                    oninput="validateInput(event)" required>
                                <div class="invalid-feedback">Please enter project duration.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">Country</label>
                                <select class="form-control text-dark" required="required" name="country"
                                    onChange="print_state('state',this.selectedIndex);" id="country"
                                    style="width:100%" required>
                                </select>
                                <div class="invalid-feedback">Please select valid date.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">State</label>
                                <select class="form-control text-dark" required name="state" id="state"
                                    style="width:100%"></select>
                                <script language="javascript">
                                    print_country("country");
                                </script>
                                <script language="javascript">
                                    print_country("country");
                                </script>
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
                                    <option value="on-site">On-Site</option>
                                    <option value="remote">Remote</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                                <div class="invalid-feedback">Please select work mode.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="paymentSchedule" class="form-label">Payment Schedule</label>
                                <select name="payment_schedule" class="form-select text-dark" id="paymentSchedule"
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
                                <label for="selectDate" class="form-label">Application Opening Date</label>
                                <input type="text" name="application_opens" id="selectDate"
                                    class="form-control text-dark flatpickr"
                                    placeholder="Select Application Opening Date" required>
                                <div class="invalid-feedback">Please select valid date.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectDate" class="form-label">Application Closing Date</label>
                                <input type="text" name="application_closes" id="selectDate"
                                    class="form-control text-dark flatpickr"
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


                <div class="card mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-lg-flex" style="margin-right:0px; padding-right:0px">

                        <div class="container"
                            style="margin-left: 0px; padding-left:0px; margin-right:0px; padding-right:0px">
                            <div class="row">
                                <div class="col-md-7 col-7">
                                    <h4 class="mb-0">Featured Files & Images</h4>
                                </div>
                                <div class="col-md-5 col-5">
                                    <a href="#" class="btn btn-primary btn-xs text-end" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter">Upload File</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- List group -->
                    <div id="imagesContainer" class="p-4">

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

                    <input type="hidden" name="tracking_code" value="{{ Session::get('JTC') }}" required>

                    <button type="submit" class="m-3 btn btn-primary"
                        style="background: #690068; border: #690068"><i class="fe fe-save"></i>&nbsp; Save</button>

                    <!-- Card -->
                </div>
                <!-- Card  -->
            </div>
        </div>
    </form>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Upload Job Assets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('business.uploadJobAsset') }}" class="dropzone" id="job-assets"
                    enctype="multipart/form-data">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button id="loadImagesBtn" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save and Proceed</button>
            </div>
        </div>
    </div>
</div>

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
    Dropzone.autoDiscover = false;

    var dropzone = new Dropzone('#job-assets', {
        thumbnailWidth: 200,
    });

    dropzone.on("totaluploadprogress", function(progress) {
        var elProgress = document.getElementById("progress-bar"); // my progress bar

        elProgress.style.display = "block";

        if (elProgress === undefined || elProgress === null) return;

        elProgress.style.width = progress + "%"; // changing progress bar's length based on progress value
    });


    dropzone.on("success", function(file) {
        Swal.fire({
            text: 'File uploaded successfully.',
            icon: 'success',
            showConfirmButton: false,
            toast: true,
            width: 450,
            timer: 4000,
            position: 'top-right'
        })
    });

    dropzone.on("error", function(file, message) {
        Swal.fire({
            text: 'Something went wrong. File not uploaded.',
            icon: 'error',
            showConfirmButton: false,
            toast: true,
            width: 450,
            timer: 4000,
            position: 'top-right'
        })

        // dropzone.removeFile(file);

    });
</script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function() {
        $('#loadImagesBtn').on('click', function() {

            // Make an AJAX request to fetch images from the server
            $.ajax({
                url: "/business/fetch-job-asset", // Replace with the actual route that handles image fetching
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Handle the response and display images
                    displayImages(response);
                },
                error: function(error) {
                    alert('Error');
                    console.error('Error fetching images:', error);
                }
            });
        });


        // Function to display images in the imagesContainer
        function displayImages(images) {
            var container = $('#imagesContainer');
            container.empty(); // Clear previous images

            // Loop through the images and append them to the container
            $.each(images.files, function(index, image) {
                var imageHtml ='<div class="row justify-content-between align-items-center mb-1">'+
                                '<div class="col-10">'+
                                    '<div class="d-md-flex">'+
                                        '<div>'+
                                            '<img src="'+ image.asset_url +'" alt="" class="icon-shape icon-lg rounded">'+
                                        '</div>'+

                                        '<div class="ms-md-4 mt-lg-0">'+
                                            '<p class="mb-1">'+ image.asset_name +'</p>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="col-2 d-grid">'+
                                    '<a href="" class="mb-2" style="color:red"><i class="fe fe-trash"></i></a>'+
                                '</div>'+
                            '</div>'+
                            '<hr />'

                container.append(imageHtml);
            });
        }
    });
</script>


<script type="text/javascript">
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
</script>
@endsection
