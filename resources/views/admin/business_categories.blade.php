@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Business Categories')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Business Categories</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Business Categories</a>
                            </li>
                        </ol>
                    </nav>
                </div>

                @if (\App\Http\Controllers\MenuController::canCreate(Auth::user()->role_id, 1) == true)
                    <!-- button -->
                    <div>
                        <a href="#" class="btn btn-success btn-sm me-2" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight">Add New Business Category</a>

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
                &nbsp;
                <div>
                    <div class="tab-content" id="tabContent">
                        <!-- Tab -->
                        <div class="tab-pane fade show active" id="all-orders" role="tabpanel"
                            aria-labelledby="all-orders-tab">
                            <div class="table-responsive" style="min-height:200px">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                                    style="font-size: 14px;">
                                    <!-- Table Head -->
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Business Category</th>
                                            <th>Status</th>
                                            @if (\App\Http\Controllers\MenuController::canEdit(Auth::user()->role_id, 1) == true)
                                                <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($categories as $cat)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $cat->category }}</td>
                                                <td>
                                                    @if ($cat->status == 'active')
                                                        <span class="badge text-success bg-light-success">Active</span>
                                                    @else
                                                        <span
                                                            class="badge text-danger bg-light-danger">Deactivated</span>
                                                    @endif
                                                </td>
                                                @if (\App\Http\Controllers\MenuController::canEdit(Auth::user()->role_id, 1) == true)
                                                    <td class="align-middle">
                                                        <div class="hstack gap-4">
                                                            <span class="dropdown dropstart">
                                                                <a class="btn btn-success bg-light-success text-success btn-sm"
                                                                    href="#" role="button"
                                                                    data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                                                    aria-expanded="false">Action</a>
                                                                <span class="dropdown-menu"><span
                                                                        class="dropdown-header">Action</span>

                                                                    <a class="dropdown-item" href="#"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#editCategory"
                                                                        data-myid="{{ $cat->id }}"
                                                                        data-category="{{ $cat->category }}"><i
                                                                            class="fe fe-edit dropdown-item-icon"></i>Update
                                                                        Details</a>

                                                                    @if ($cat->status == 'active')
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('admin.deactivateCategory', [$cat->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to deacticate this category?');"><i
                                                                                class="fe fe-x-circle dropdown-item-icon"></i>Deactivate
                                                                            Category</a>
                                                                    @else
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('admin.activateCategory', [$cat->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to activate this category?');"><i
                                                                                class="fe fe-check-circle dropdown-item-icon"></i>Activate
                                                                            Category</a>
                                                                    @endif

                                                                </span>
                                                            </span>

                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach

                                        @if (count($categories) < 1)
                                            <tr>
                                                <td colspan="4">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>



                        </div>

                    </div>
                </div>
                <!-- Card Footer -->
                &nbsp;
            </div>
        </div>
    </div>
</section>

@if (\App\Http\Controllers\MenuController::canCreate(Auth::user()->role_id, 1) == true)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel"> New Business Category</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form class="needs-validation" novalidate method="post"
                    action="{{ route('admin.storeBusinessCategory') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label">Business Category <span class="text-danger">*</span></label>
                            <input type="text" name="category" class="form-control"
                                placeholder="Enter Business Category" required>
                            <div class="invalid-feedback">Please enter business category.</div>
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editCategory" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel"> Update Business Category</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form class="needs-validation" novalidate method="post"
                    action="{{ route('admin.updateBusinessCategory') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label">Business Category <span class="text-danger">*</span></label>
                            <input id="category" type="text" name="category" class="form-control"
                                placeholder="Enter Business Category" required>
                            <div class="invalid-feedback">Please enter business category.</div>
                        </div>

                        <input id="myid" type="hidden" name="category_id" class="form-control" required>

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

<script type="text/javascript">
    document.getElementById("platSettings").classList.add('show');
    document.getElementById("categories").classList.add('active');
</script>

@endsection
