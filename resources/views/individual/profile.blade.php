@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Profile Information')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Profile Information </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('individual.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Profile Information
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
            @if (Auth::user()->profile_updated == 0)
                <div class="offset-xl-1 col-xl-10 col-md-12 col-12">
                    <div class="alert alert-danger">
                        <center>Please Update Your Account Information.</center>
                    </div>

                    <!-- card -->
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body p-lg-6">
                            <!-- form -->
                            <form method="post" class="needs-validation" novalidate
                                action="{{ route('individual.updateProfile') }}">
                                @csrf
                                <div class="row">
                                    <!-- form group -->
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                                            class="form-control" placeholder="Enter Last Name" required>

                                        <div class="invalid-feedback">Please provide last name.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Other Names <span class="text-danger">*</span></label>
                                        <input type="text" name="other_names" value="{{ Auth::user()->other_names }}"
                                            class="form-control" placeholder="Enter Other Names" required>

                                        <div class="invalid-feedback">Please provide other names.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{ Auth::user()->email }}"
                                            class="form-control" placeholder="Enter Last Name" required readonly>

                                        <div class="invalid-feedback">Please provide email address.</div>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Phone Number<span class="text-danger">*</span></label>
                                        <input type="text" name="phone_number"
                                            value="{{ Auth::user()->phone_number }}" class="form-control"
                                            placeholder="Enter Phone Number" required>
                                        <div class="invalid-feedback">Please provide phone number.</div>

                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Date of Birth<span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="dob" value="" class="form-control"
                                            placeholder="Enter Date of Birth" required>

                                        <div class="invalid-feedback">Please provide date of birth.</div>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                                        <select id="gender" name="gender" class="form-control" data-width="100%"
                                            required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                                        <div class="invalid-feedback">Please select gender.</div>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Marital Status <span
                                                class="text-danger">*</span></label>
                                        <select id="maritalStatus" name="marital_status"
                                            class="@error('marital_status') is-invalid @enderror" data-width="100%"
                                            required>
                                            <option value="">Select Marital Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widow/Widower">Widow/Widower</option>
                                        </select>

                                        <div class="invalid-feedback">Please select marital status.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Nationality <span class="text-danger">*</span></label>

                                        <select class="form-control text-dark" required="required" name="country"
                                            onChange="print_state('state',this.selectedIndex);" id="country"
                                            style="width:100%" required>
                                        </select>
                                        <div class="invalid-feedback">Please select nationality.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">State Of Origin <span
                                                class="text-danger">*</span></label>

                                        <select class="form-control text-dark" required name="state" id="state"
                                            style="width:100%">
                                            <option value="">Select State Of Origin</option>
                                        </select>
                                        <script language="javascript">
                                            print_country("country");
                                        </script>

                                        <div class="invalid-feedback">Please select state of origin.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">LGA Of Origin <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="lga_origin" value="" class="form-control"
                                            placeholder="LGA Of Origin" required>
                                        <div class="invalid-feedback">Please select lga of origin.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Identification Type <span
                                                class="text-danger">*</span></label>
                                        <select id="idType" name="identification_type" class="form-control"
                                            data-width="100%" required>
                                            <option value="">Select Identification Type</option>
                                            <option value="NIN">National Identification Number (NIN)</option>
                                            <option value="BVN">Bank Verification Number (BVN)</option>
                                        </select>

                                        <div class="invalid-feedback">Please select identification type.</div>
                                    </div>


                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Identification Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="identification_number" value=""
                                            class="form-control" placeholder="Enter Identification Number" required>

                                        <div class="invalid-feedback">Please select identification number.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Tax Payer Identification Number (TIN) </label>
                                        <input type="text" name="tin" value="" class="form-control"
                                            placeholder="Enter Tax Payer Identification Number (TIN)">

                                        <div class="invalid-feedback">Please provide tax identification number.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Annual Income <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="annual_income" value=""
                                            class="form-control" placeholder="Enter Annual Income" required
                                            oninput="validateInput(event)">

                                        <div class="invalid-feedback">Please provide annual income.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Public Servant? <span
                                                class="text-danger">*</span></label>
                                        <select id="publicServant" name="public_servant" class="form-control"
                                            data-width="100%" required>
                                            <option value="">Select A Response</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>

                                        <div class="invalid-feedback">Please select a respone.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Occupation <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="occupation" value="" class="form-control"
                                            placeholder="Occupation" required>

                                        <div class="invalid-feedback">Please provide occupation.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">State Of Residence <span
                                                class="text-danger">*</span></label>
                                        <select id="stateResidence" name="state_residence" class="form-control"
                                            data-width="100%" required>
                                            <option value="">Select State Of Residence</option>
                                            <option value="Abia">Abia</option>
                                            <option value="Abuja (FCT)">Abuja (FCT)</option>
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
                                            <option value="Kwara">Kwara</option>
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

                                        <div class="invalid-feedback">Please provide state of residence.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">LGA Of Residence <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="lga_residence" value=""
                                            class="form-control" placeholder="Enter LGA Of Residence" required>

                                        <div class="invalid-feedback">Please provide lga of residence.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">City Of Residence <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="city_residence" value=""
                                            class="form-control" placeholder="Enter City Of Residence" required>

                                        <div class="invalid-feedback">Please provide city of residence.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">House Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="house_number" value=""
                                            class="form-control" placeholder="Enter House Number" required>

                                        <div class="invalid-feedback">Please provide house number.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Street Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="street_name" value="" class="form-control"
                                            placeholder="Enter Street Name" required>

                                        <div class="invalid-feedback">Please provide street name.</div>
                                    </div>

                                    <div class="mb-3 col-md-6 col-12">
                                        <label class="form-label">Tax Station<span
                                                class="text-danger">*</span></label>
                                        <select id="taxStation" name="tax_station" class="form-control"
                                            data-width="100%" required>
                                            <option value="">Select Tax Station</option>
                                            @foreach ($taxStations as $office)
                                                <option value="{{ $office->id }}">{{ $office->tax_office }},
                                                    {{ $office->lga->lga }} LGA</option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">Please select tax station.</div>
                                    </div>

                                    <div class="col-md-8"></div>
                                    <!-- button -->
                                    <div class="col-12">
                                        <button class="btn btn-success w-100" type="submit">Update
                                            Account Information</button>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            @else
                <div class=" col-xl-12 col-md-12 col-12">
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body p-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="betty" colspan="4"> PERSONAL INFORMATION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="" width="20%">Taxayer ID</th>
                                            <td class="" colspan="2" width="30%">
                                                {{ Auth::user()->taxpayer->btin }}</td>
                                            <td class="" rowspan="5" align="right"
                                                style="text-align: center" width="50%">
                                                <img src="{{ Auth::user()->profile_photo == null ? asset('assets/images/avatar/avatar.webp') : Auth::user()->profile_photo }}"
                                                    id="vphoto" class="img-responsive" style="max-width: 150px" />

                                                @if (!isset(Auth::user()->profile_photo))
                                                    <button class="btn btn-success btn-sm mt-5" data-bs-toggle="modal"
                                                        data-bs-target="#uploadPhoto"
                                                        data-myid="{{ Auth::user()->id }}">Upload Profile
                                                        Picture</button>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="">Last Name</th>
                                            <td class="" colspan="2">{{ Auth::user()->last_name }}</td>
                                        </tr>

                                        <tr>
                                            <th class="">Other Names</th>
                                            <td class="" colspan="2">{{ Auth::user()->other_names }}</td>
                                        </tr>

                                        <tr>
                                            <th class="">Email Address</th>
                                            <td class="" colspan="2">{{ Auth::user()->email }}</td>
                                        </tr>

                                        <tr>
                                            <th class="">Phone Number</th>
                                            <td class="" colspan="2">{{ Auth::user()->phone_number }}</td>
                                        </tr>

                                        <tr>
                                            <th class="" width="20%">Date Of Birth</th>
                                            <td class="" width="30%">
                                                {{ date_format(new DateTime(Auth::user()->individual->dob), 'jS F, Y') }}
                                            </td>
                                            <th class="" width="20%">Gender</th>
                                            <td class="" width="30%">
                                                {{ ucwords(Auth::user()->individual->gender) }}</td>
                                        </tr>

                                        <tr>
                                            <th class="">Marital Status</th>
                                            <td class="">{{ Auth::user()->individual->marital_status }}</td>
                                            <th class="">Nationality</th>
                                            <td class="">{{ Auth::user()->individual->nationality }}</td>
                                        </tr>

                                        <tr>
                                            <th class="">Identification Type</th>
                                            <td class="">
                                                {{ strtoupper(Auth::user()->individual->identification_type) }}</td>
                                            <th class="">Identification Number</th>
                                            <td class="">{{ Auth::user()->individual->identification_number }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="">State / LGA / City of Residence</th>
                                            <td class="">{{ Auth::user()->individual->state_residence }} /
                                                {{ Auth::user()->individual->lga_residence }} /
                                                {{ Auth::user()->individual->city_residence }}</td>
                                            <th class="">Contact Address</th>
                                            <td class="">{{ Auth::user()->individual->house_number }}
                                                {{ Auth::user()->individual->street_name }}</td>
                                        </tr>

                                        <tr>
                                            <th class="">Tax Station</th>
                                            <td class="">{{ Auth::user()->individual->office->tax_office }}</td>
                                            <th class="">Occupation</th>
                                            <td class="">{{ Auth::user()->individual->occupation }}</td>
                                        </tr>

                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <div class="pt-4 table-responsive">
                                <div class="pb-2 text-end">
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addChild" data-myid="{{ Auth::user()->id }}">Add Child</button>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addSpouse" data-myid="{{ Auth::user()->id }}">Add
                                        Spouse</button>
                                </div>
                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                                    style="font-size: 14px">
                                    <!-- Table Head -->
                                    <thead class="table-light">
                                        <tr>
                                            <th class="betty" colspan="8"> FAMILY RELATIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Relationship</th>
                                            <th>B-TIN</th>
                                            <th>Date Of Birth</th>
                                            <th>Occupation</th>
                                            <th>Business Name</th>
                                            <th>Business Address</th>
                                        </tr>
                                        @foreach (Auth::user()->taxpayer->familyMembers() as $family)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $family->full_name }}</td>
                                                <td>{{ ucwords($family->relationship) }}</td>
                                                <td>{{ $family->btin ?? 'Nil' }}</td>
                                                <td>{{ date_format(new DateTime($family->dob), 'jS M, Y') }}</td>
                                                <td>{{ $family->occupation }}</td>
                                                <td>{{ $family->business_name ?? 'Nil' }}</td>
                                                <td>{{ $family->business_address ?? 'Nil' }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>
                </div>

            @endif

        </div>
    </div>
</section>

@if (!isset(Auth::user()->profile_photo))
    <div class="modal fade" id="uploadPhoto" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="newCatgoryLabel">
                        Upload Picture
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="needs-validation" novalidate method="post"
                        action="{{ route('individual.uploadPhoto') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <label class="form-label">Upload a valid image </label>
                                <input type="file" name="profile_photo" class="form-control"
                                    placeholder="Upload a valid image" required>
                                <div class="invalid-feedback">Please upload a valid image.</div>
                            </div>

                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-success" type="submit">Upload Picture</button>
                                <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endif


<div class="modal fade" id="addSpouse" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    Add Spouse
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate method="post"
                    action="{{ route('individual.addSpouse') }}">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="isTaxPayer"
                                        name="registered" value="yes" checked>
                                    <label class="form-check-label" for="isTaxPayer"><span style="color:black">Spouse
                                            is a registered Tax Payer?</span></label>
                                </div>
                            </div>
                        </div>

                        <div id="tpBtin" class="mb-3 col-12">
                            <label class="form-label">Spouse's B-TIN </label>
                            <input id="btin" type="text" name="btin" class="form-control"
                                placeholder="Spouse's B-TIN" maxlength="10" required autocomplete="off">
                            <div class="invalid-feedback">Please provide spouse's B-TIN.</div>
                            <div id="validationprogress" class="valid-feedback" style="font-weight:bold;">
                                Validating B-TIN...</div>
                            <div id="validationerror" class="validationerror">B-TIN Validation Failed</div>
                        </div>

                        <div id="tpName" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Spouse's Full Name </label>
                            <input id="taxpayer" type="text" name="full_name" class="form-control"
                                placeholder="Full Name" required>
                            <div class="invalid-feedback">Please provide spouse's full name.</div>
                        </div>

                        <div id="pdob" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Date Of Birth </label>
                            <input id="dob" type="date" name="dob" class="form-control"
                                placeholder="Date Of Birth" required>
                            <div class="invalid-feedback">Please provide spouse's date of birth.</div>
                        </div>

                        <div id="poccupation" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Occupation </label>
                            <input id="occupation" type="text" name="occupation" class="form-control"
                                placeholder="Occupation" required>
                            <div class="invalid-feedback">Please provide spouse's occupation.</div>
                        </div>

                        <div id="pbiz" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Employer/Business Name </label>
                            <input id="biz" type="text" name="business_name" class="form-control"
                                placeholder="Employer/Business Name" required>
                            <div class="invalid-feedback">Please provide spouse's employer/business name.</div>
                        </div>

                        <div id="pbizad" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Employer/Business Address </label>
                            <input id="bizad" type="text" name="business_address" class="form-control"
                                placeholder="Employer/Business Address" required>
                            <div class="invalid-feedback">Please provide spouse's employer/business address.</div>
                        </div>

                        <div class="col-md-12 border-bottom"></div>
                        <!-- button -->
                        <div class="col-12 mt-4">
                            <button id="submitbutton" class="btn btn-success" type="submit" disabled>Add
                                Spouse</button>
                            <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addChild" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    Add Child
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate method="post"
                    action="{{ route('individual.addChild') }}">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="isTaxPayer2"
                                        name="registered" value="yes" checked>
                                    <label class="form-check-label" for="isTaxPayer2"><span style="color:black">Child
                                            is a registered Tax Payer?</span></label>
                                </div>
                            </div>
                        </div>

                        <div id="tpBtin2" class="mb-3 col-12">
                            <label class="form-label">Child's B-TIN </label>
                            <input id="btin2" type="text" name="btin" class="form-control"
                                placeholder="Child's B-TIN" maxlength="10" required autocomplete="off">
                            <div class="invalid-feedback">Please provide child's B-TIN.</div>
                            <div id="validationprogress2" class="valid-feedback" style="font-weight:bold;">
                                Validating B-TIN...</div>
                            <div id="validationerror2" class="validationerror">B-TIN Validation Failed</div>
                        </div>

                        <div id="tpName2" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Child's Full Name </label>
                            <input id="taxpayer2" type="text" name="full_name" class="form-control"
                                placeholder="Full Name" required>
                            <div class="invalid-feedback">Please provide child's full name.</div>
                        </div>

                        <div id="pdob2" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Date Of Birth </label>
                            <input id="dob2" type="date" name="dob" class="form-control"
                                placeholder="Date Of Birth" required>
                            <div class="invalid-feedback">Please provide child's date of birth.</div>
                        </div>

                        <div id="poccupation2" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Occupation </label>
                            <input id="occupation2" type="text" name="occupation" class="form-control"
                                placeholder="Occupation" required>
                            <div class="invalid-feedback">Please provide child's occupation.</div>
                        </div>

                        <div id="pbiz2" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Employer/Business Name </label>
                            <input id="biz2" type="text" name="business_name" class="form-control"
                                placeholder="Employer/Business Name" required>
                            <div class="invalid-feedback">Please provide child's employer/business name.</div>
                        </div>

                        <div id="pbizad2" class="mb-3 col-12" style="display: none">
                            <label class="form-label">Employer/Business Address </label>
                            <input id="bizad2" type="text" name="business_address" class="form-control"
                                placeholder="Employer/Business Address" required>
                            <div class="invalid-feedback">Please provide child's employer/business address.</div>
                        </div>

                        <div class="col-md-12 border-bottom"></div>
                        <!-- button -->
                        <div class="col-12 mt-4">
                            <button id="submitbutton2" class="btn btn-success" type="submit" disabled>Add
                                Child</button>
                            <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("profile").classList.add('active');
</script>


@endsection

@section('customjs')

@include('individual.layouts.ajax')

<script type="text/javascript">
    $(document).ready(function() {
        $('#country').select2();
    });

    $(document).ready(function() {
        $('#state').select2();
    });

    $(document).ready(function() {
        $('#gender').select2();
    });

    $(document).ready(function() {
        $('#idType').select2();
    });

    $(document).ready(function() {
        $('#publicServant').select2();
    });

    $(document).ready(function() {
        $('#maritalStatus').select2();
    });

    $(document).ready(function() {
        $('#taxStation').select2();
    });

    $(document).ready(function() {
        $('#stateResidence').select2();
    });



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
