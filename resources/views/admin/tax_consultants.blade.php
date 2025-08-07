@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Tax Consultants')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Tax Consultants</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Tax Consultants</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                @if (\App\Http\Controllers\MenuController::canCreate(Auth::user()->role_id, 1) == true)
                    <!-- button -->
                    <div>
                        <a href="#" class="btn btn-success btn-sm me-2" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight">Add New Consultant</a>

                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
                <!-- Card Header -->
                <form id="form" name="form" method="GET">
                    <div class="p-4 row gx-3">
                        <!-- Form -->
                        <div class="col-12 col-lg-9 mb-3 mb-lg-0">
                            <!-- search -->

                            <div class="d-flex align-items-center">
                                <span class="position-absolute ps-3 search-icon">
                                    <i class="fe fe-search"></i>
                                </span>
                                <!-- input -->
                                <input name="search" type="search" class="form-control ps-6"
                                    placeholder="Search Tax Consultants......" value="{{ $search }}">
                            </div>

                        </div>

                        <div class="col-6 col-lg-3">
                            <!-- form select -->
                            <select id="status" name="status" class="form-select" onChange="this.form.submit()">
                                <option value="">All Statuses</option>
                                <option value="active" @if ($status == 'active') selected @endif>
                                    Active
                                </option>
                                <option value="deactivated" @if ($status == 'deactivated') selected @endif>
                                    Deactivated
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
                <div>
                    <div class="tab-content" id="tabContent">
                        <!-- Tab -->
                        <div class="tab-pane fade show active" id="all-orders" role="tabpanel"
                            aria-labelledby="all-orders-tab">
                            <div class="table-responsive">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                                    style="font-size: 14px">
                                    <!-- Table Head -->
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Organization</th>
                                            <th>Consultant's Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($consultants as $consular)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $consular->organization }}</td>
                                                <td>{{ $consular->surname.', ' . $consular->other_names }}</td>
                                                <td>{{ $consular->email }}</td>
                                                <td>{{ $consular->phone_number }}</td>
                                                <td>
                                                    @if ($consular->status == 'active')
                                                        <span
                                                            class="badge text-success bg-light-success">{{ ucwords($consular->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge text-danger bg-light-danger">{{ ucwords($consular->status) }}</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <div class="hstack gap-4">
                                                        <span class="dropdown dropstart">
                                                            <a class="btn btn-success bg-light-success text-success btn-sm"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                data-bs-offset="-20,20" aria-expanded="false">Action</a>
                                                            <span class="dropdown-menu"><span
                                                                    class="dropdown-header">Action</span>

                                                                <a style="cursor:pointer" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#viewConsultantDetails"
                                                                    data-myid="{{ $consular->id }}"
                                                                    data-surname="{{ $consular->surname }}"
                                                                    data-othernames="{{ $consular->other_names }}"
                                                                    data-email="{{ $consular->email }}"
                                                                    data-phone="{{ $consular->phone_number }}"
                                                                    data-photo="{{ $consular->photo }}"
                                                                    data-organization="{{ $consular->organization }}"
                                                                    data-gender="{{ ucwords($consular->gender) }}"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>

                                                                <a style="cursor:pointer" class="dropdown-item"
                                                                    data-bs-toggle="offcanvas"
                                                                    data-bs-target="#editConsultant"
                                                                    data-myid="{{ $consular->id }}"
                                                                    data-surname="{{ $consular->surname }}"
                                                                    data-othernames="{{ $consular->other_names }}"
                                                                    data-email="{{ $consular->email }}"
                                                                    data-organization="{{ $consular->organization }}"
                                                                    data-phone="{{ $consular->phone_number }}"
                                                                    data-gender="{{ $consular->gender }}"><i
                                                                        class="fe fe-edit dropdown-item-icon"></i>Update
                                                                    Details</a>

                                                            </span>
                                                        </span>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if (count($consultants) < 1)
                                            <tr>
                                                <td colspan="8">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            @if (count($consultants) > 0 && $marker != null)
                                <div class="card-footer">
                                    <div class="row g-2 pt-3 ms-4 me-4">
                                        <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                                            of
                                            {{ number_format($lastRecord) }} Records</div>

                                        <div class="col-md-3">{{ $consultants->appends(request()->input())->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div>

                    </div>
                </div>
                <!-- Card Footer -->

            </div>
        </div>
    </div>
</section>

@if (\App\Http\Controllers\MenuController::canCreate(Auth::user()->role_id, 1) == true)
    <!-- offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel"> Add New Tax Consultant</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form class="needs-validation" novalidate method="post"
                    action="{{ route('admin.storeConsultant') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label">Organization <span class="text-danger">*</span></label>
                            <input type="text" name="organization" class="form-control" placeholder="Enter Organization"
                                required>
                            <div class="invalid-feedback">Please provide organization.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Consultant's Surname <span class="text-danger">*</span></label>
                            <input type="text" name="surname" class="form-control" placeholder="Enter Surname"
                                required>
                            <div class="invalid-feedback">Please provide surname.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Consultant's Other Names <span class="text-danger">*</span></label>
                            <input type="text" name="other_names" class="form-control"
                                placeholder="Enter Other Names" required>
                            <div class="invalid-feedback">Please provide other names.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Enter Email Address" required>
                            <div class="invalid-feedback">Please provide email.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone_number" class="form-control"
                                placeholder="Enter Phone Number" required>
                            <div class="invalid-feedback">Please provide phone number.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <select id="gender" name="gender" class=" form-control" data-width="100%" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="invalid-feedback">Please select gender.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Profile Photo <span class="text-danger">*</span></label>
                            <input type="file" name="profile_photo" class="form-control"
                                placeholder="Upload Profile Photo" required>
                            <div class="invalid-feedback">Please upload profile photo.</div>
                        </div>

                        <div class="col-md-12 border-bottom"></div>
                        <!-- button -->
                        <div class="col-12 mt-4">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="offcanvas"
                                aria-label="Close">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif


@if (\App\Http\Controllers\MenuController::canEdit(Auth::user()->role_id, 1) == true)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editConsultant" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel"> Edit Tax Consultant Details</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form class="needs-validation" novalidate method="post"
                    action="{{ route('admin.updateConsultant') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- form group -->

                        <div class="mb-3 col-12">
                            <label class="form-label">Organization <span class="text-danger">*</span></label>
                            <input id="organization" type="text" name="organization" class="form-control" placeholder="Enter Organization"
                                required>
                            <div class="invalid-feedback">Please provide organization.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Surname <span class="text-danger">*</span></label>
                            <input id="surname" type="text" name="surname" class="form-control"
                                placeholder="Enter Surname" required>
                            <div class="invalid-feedback">Please provide surname.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Other Names <span class="text-danger">*</span></label>
                            <input id="othernames" type="text" name="other_names" class="form-control"
                                placeholder="Enter Other Names" required>
                            <div class="invalid-feedback">Please provide other names.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input id="email" type="email" name="email" class="form-control"
                                placeholder="Enter Email Address" required>
                            <div class="invalid-feedback">Please provide email.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input id="phone" type="text" name="phone_number" class="form-control"
                                placeholder="Enter Phone Number" required>
                            <div class="invalid-feedback">Please provide phone number.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Gender <span class="text-danger">*</span></label>
                            <select id="editGender" name="gender" class=" form-control" data-width="100%" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="invalid-feedback">Please select gender.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Profile Photo </label>
                            <input type="file" name="profile_photo" class="form-control"
                                placeholder="Upload Profile Photo">
                            <div class="invalid-feedback">Please upload profile photo.</div>
                        </div>

                        <input id="myid" type="hidden" name="consultant_id" class="form-control" required>

                        <div class="col-md-12 border-bottom"></div>
                        <!-- button -->
                        <div class="col-12 mt-4">
                            <button class="btn btn-success" type="submit">Save Changes</button>
                            <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="offcanvas"
                                aria-label="Close">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif



<div class="modal fade" id="viewConsultantDetails" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    View Consultant's Details
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="">Organization</td>
                            <td class=""><span id="vorganization"></span></td>
                            <td class="" rowspan="9" align="right" style="text-align: center"><img
                                    src="" id="vphoto" class="img-responsive" style="max-width: 150px" />
                            </td>
                        </tr>

                        <tr>
                            <td class="">Surname</td>
                            <td class=""><span id="vsurname"></span></td>
                        </tr>

                        <tr>
                            <td class="">Other Names</td>
                            <td class=""><span id="vothernames"></span></td>
                        </tr>

                        <tr>
                            <td class="">Email</td>
                            <td class=""><span id="vemail"></span></td>
                        </tr>

                        <tr>
                            <td class="">Phone Number</td>
                            <td class=""><span id="vphone"></span></td>
                        </tr>

                        <tr>
                            <td class="">Gender</td>
                            <td class=""><span id="vgender"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success ms-2" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("consultants").classList.add('active');
</script>

@endsection
