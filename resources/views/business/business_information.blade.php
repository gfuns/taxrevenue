@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Business Information')


<!-- Container fluid -->
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Business Information</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Business Information</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row justify-content-center">
        <div class="col-lg-11 col-12">
            <form method="POST" action="{{ route('business.updateBusinessProfile') }}" class="needs-validation"
                novalidate enctype="multipart/form-data">
                @csrf
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div>
                                    <!-- logo -->
                                    <div class="icon-shape icon-xxl border rounded position-relative">
                                        <span class="position-absolute">
                                            <img alt="avatar"
                                                src="{{ $business->business_logo == null ? asset('assets/images/avatar/avatar.webp') : $business->business_logo }}"
                                                style="max-height:140px; max-width: 150px">
                                        </span>


                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-5">
                                <div class="col-md-6 col-12">
                                    <h5 class="mb-3">&nbsp; </h5>
                                    <input type="file" name="business_logo" class="form-control"
                                        @if ($business->businessLogo() == null) required @endif>
                                </div>
                            </div>
                            <!-- input -->
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Business Name </label>
                                <input type="text" name="business_name" value="{{ $business->business_name }}"
                                    class="form-control" placeholder="Enter Business Name" required>
                                <div class="invalid-feedback">Please enter business name</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Business Category</label>
                                <select id="category" name="business_category" class="@error('category') is-invalid @enderror" data-width="100%" required onchange="showHideTextField()">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($business->category_id == $category->id) selected @endif>
                                            {{ $category->category_name }}</option>
                                    @endforeach
                                    <option value="Others">Others</option>
                                </select>
                                <div class="invalid-feedback">Please select business category</div>

                                <div id="customOption" style="display: none;" class="pt-3">
                                    <input id="customField" type="text" name="category_name" value="" class="form-control" placeholder="Enter Your Business Category">
                                </div>
                            </div>
                            <!-- input -->
                            <div class="mb-3 col-md-12 col-12">
                                <label class="form-label">Business Description</label>
                                <textarea id="editor1" name="business_description" class="form-control" placeholder="Business Description" required>@php echo $business->business_description; @endphp</textarea>
                                <div class="invalid-feedback">Please enter business description</div>
                            </div>

                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Business Phone Number</label>
                                <input type="text" name="business_phone" value="{{ $business->business_phone }}"
                                    class="form-control" placeholder="Enter Business Phone Number" required>
                                <div class="invalid-feedback">Please enter business phone number</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Business Email Address</label>
                                <input type="text" name="business_email" value="{{ $business->business_email }}"
                                    class="form-control" placeholder="Enter Business Email Address" required>
                                <div class="invalid-feedback">Please enter business email</div>
                            </div>

                            <div class="mb-3 col-md-6 col-12">
                                <label for="selectDate" class="form-label">Country</label>

                                <select name="country" class="form-select text-dark" id="country" required>
                                    <option value="">Select Country</option>
                                    <option value="Nigeria" @if ($business->country == 'Nigeria') selected @endif>Nigeria
                                    </option>
                                </select>

                                {{-- <select class="form-control text-dark" required="required" name="country"
                                    onChange="print_state('state',this.selectedIndex);" id="country"
                                    style="width:100%" required>
                                </select> --}}
                                <div class="invalid-feedback">Please select valid date.</div>
                            </div>

                            <div class="mb-3 col-md-6 col-12">
                                <label for="selectDate" class="form-label">State</label>

                                <select name="state" class="form-select text-dark" id="state" required>
                                    <option value="" disabled>Select State</option>
                                    <option value="Abia" @if ($business->state == 'Abia') selected @endif>Abia
                                    </option>
                                    <option value="Abuja (FCT)" @if ($business->state == 'Abuja (FCT)') selected @endif>
                                        Abuja - Federal Capital Territory</option>
                                    <option value="Adamawa" @if ($business->state == 'Adamawa') selected @endif>
                                        Adamawa</option>
                                    <option value="Akwa Ibom" @if ($business->state == 'Akwa Ibom') selected @endif>Akwa
                                        Ibom</option>
                                    <option value="Anambra" @if ($business->state == 'Anambra') selected @endif>
                                        Anambra</option>
                                    <option value="Bauchi" @if ($business->state == 'Bauchi') selected @endif>Bauchi
                                    </option>
                                    <option value="Bayelsa" @if ($business->state == 'Bayelsa') selected @endif>
                                        Bayelsa</option>
                                    <option value="Benue" @if ($business->state == 'Benue') selected @endif>Benue
                                    </option>
                                    <option value="Borno" @if ($business->state == 'Borno') selected @endif>Borno
                                    </option>
                                    <option value="Cross River" @if ($business->state == 'Cross River') selected @endif>
                                        Cross River</option>
                                    <option value="Delta" @if ($business->state == 'Delta') selected @endif>Delta
                                    </option>
                                    <option value="Ebonyi" @if ($business->state == 'Ebonyi') selected @endif>
                                        Ebonyi</option>
                                    <option value="Edo" @if ($business->state == 'Edo') selected @endif>Edo
                                    </option>
                                    <option value="Ekiti" @if ($business->state == 'Ekiti') selected @endif>Ekiti
                                    </option>
                                    <option value="Enugu" @if ($business->state == 'Enugu') selected @endif>Enugu
                                    </option>
                                    <option value="Gombe" @if ($business->state == 'Gombe') selected @endif>Gombe
                                    </option>
                                    <option value="Imo" @if ($business->state == 'Imo') selected @endif>Imo
                                    </option>
                                    <option value="Jigawa" @if ($business->state == 'Jigawa') selected @endif>
                                        Jigawa</option>
                                    <option value="Kaduna" @if ($business->state == 'Kaduna') selected @endif>
                                        Kaduna</option>
                                    <option value="Kano" @if ($business->state == 'Kano') selected @endif>Kano
                                    </option>
                                    <option value="Katsina" @if ($business->state == 'Katsina') selected @endif>
                                        Katsina</option>
                                    <option value="Kebbi" @if ($business->state == 'Kebbi') selected @endif>Kebbi
                                    </option>
                                    <option value="Kogi" @if ($business->state == 'Kogi') selected @endif>Kogi
                                    </option>
                                    <option value="kwara" @if ($business->state == 'Kwara') selected @endif>Kwara
                                    </option>
                                    <option value="Lagos" @if ($business->state == 'Lagos') selected @endif>Lagos
                                    </option>
                                    <option value="Nassarawa" @if ($business->state == 'Nassarawa') selected @endif>
                                        Nassarawa</option>
                                    <option value="Niger" @if ($business->state == 'Niger') selected @endif>Niger
                                    </option>
                                    <option value="Ogun" @if ($business->state == 'Ogun') selected @endif>Ogun
                                    </option>
                                    <option value="Ondo" @if ($business->state == 'Ondo') selected @endif>Ondo
                                    </option>
                                    <option value="Osun" @if ($business->state == 'Osun') selected @endif>Osun
                                    </option>
                                    <option value="Oyo" @if ($business->state == 'Oyo') selected @endif>Oyo
                                    </option>
                                    <option value="Plateau" @if ($business->state == 'Plateau') selected @endif>
                                        Plateau</option>business
                                    <option value="Rivers" @if ($business->state == 'Rivers') selected @endif>
                                        Rivers</option>
                                    <option value="Sokoto" @if ($business->state == 'Sokoto') selected @endif>
                                        Sokoto</option>
                                    <option value="Taraba" @if ($business->state == 'Taraba') selected @endif>
                                        Taraba</option>
                                    <option value="Yobe" @if ($business->state == 'Yobe') selected @endif>Yobe
                                    </option>
                                    <option value="Zamfara" @if ($business->state == 'Zamfara') selected @endif>
                                        Zamfara</option>
                                </select>


                                {{-- <select class="form-control text-dark" required name="state" id="state"
                                    style="width:100%"></select>
                                <script language="javascript">
                                    print_country("country");
                                </script> --}}
                                <div class="invalid-feedback">Please select valid date.</div>
                            </div>

                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">City</label>
                                <input type="text" name="city" value="{{ $business->city }}"
                                    class="form-control" placeholder="Enter City" required>
                                <div class="invalid-feedback">Please enter city</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="business_address"
                                    value="{{ $business->business_address }}" class="form-control"
                                    placeholder="Enter Business Address" required>
                                <div class="invalid-feedback">Please enter business address</div>
                            </div>

                            <div class="mb-3 col-md-12 col-12">
                                <label class="form-label">Website URL</label>
                                <input type="text" name="website_url" value="{{ $business->website_url }}"
                                    class="form-control" placeholder="Enter Website URL">
                                <div class="invalid-feedback">Please enter website url</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Facebook Profile</label>
                                <input type="text" name="facebook_url" value="{{ $business->facebook_url }}"
                                    class="form-control" placeholder="Enter Facebook Profile">
                                <div class="invalid-feedback">Please enter facebook profile</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Instagram Profile</label>
                                <input type="text" name="instagram_url" value="{{ $business->instagram_url }}"
                                    class="form-control" placeholder="Enter Instagram Profile">
                                <div class="invalid-feedback">Please enter instagram profile</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Twitter Profile</label>
                                <input type="text" name="twitter_url" value="{{ $business->twitter_url }}"
                                    class="form-control" placeholder="Enter Twitter Profile">
                                <div class="invalid-feedback">Please enter twitter profile</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">LinkedIn Profile</label>
                                <input type="text" name="linkedin_url" value="{{ $business->linkedin_url }}"
                                    class="form-control" placeholder="Enter LinkedIn Profile">
                                <div class="invalid-feedback">Please enter linkedin profile</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="">
                    <button type="submit" class="btn btn-primary">Update Business Information</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("businessInfo").classList.add('active');
</script>

@endsection

@section('customjs')
<script>
    // Function to show or hide the custom text field based on selection
    function showHideTextField() {
        var selectBox = document.getElementById("category");
        var textDiv = document.getElementById("customOption");
        var textField = document.getElementById("customField");

        if (selectBox.value === "Others") {
            textDiv.style.display = "block";
            textField.setAttribute("required", true);
        } else {
            textDiv.style.display = "none";
        }
    }
</script>

<script type="text/javascript">
    CKEDITOR.replace('editor1');

    $(document).ready(function() {
        var country = {{ Js::from($business->country) }};
        $('#country').select2().val(country).trigger('change');
    });

    $(document).ready(function() {
        var state = {{ Js::from($business->state) }};
        $('#state').select2().val(state).trigger('change');
    });
</script>
@endsection
