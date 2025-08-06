@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Manage MDAs')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Ministries, Departments and Agencies</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Ministries, Departments and Agencies</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                @if (\App\Http\Controllers\MenuController::canCreate(Auth::user()->role_id, 1) == true)
                    <!-- button -->
                    <div>
                        <a href="#" class="btn btn-success btn-sm me-2" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight">Add New MDA</a>

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
                                    placeholder="Search Ministries, Departments and Agencies......"
                                    value="{{ $search }}">
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
                                            <th>MDA</th>
                                            <th>MDA Code</th>
                                            <th>Status</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($mdas as $mda)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $mda->mda }}</td>
                                                <td>{{ $mda->mda_code }}</td>
                                                <td>
                                                    @if ($mda->status == 'active')
                                                        <span
                                                            class="badge text-success bg-light-success">{{ ucwords($mda->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge text-danger bg-light-danger">{{ ucwords($mda->status) }}</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if ($mda->id > 1)
                                                        <div class="hstack gap-4">
                                                            <span class="dropdown dropstart">
                                                                <a class="btn btn-success bg-light-success text-success btn-sm"
                                                                    href="#" role="button"
                                                                    data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                                                    aria-expanded="false">Action</a>
                                                                <span class="dropdown-menu"><span
                                                                        class="dropdown-header">Action</span>

                                                                    <a style="cursor:pointer" class="dropdown-item"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#editMDA"
                                                                        data-myid="{{ $mda->id }}"
                                                                        data-mda="{{ $mda->mda }}"
                                                                        data-mdacode="{{ $mda->mda_code }}"><i
                                                                            class="fe fe-edit dropdown-item-icon"></i>Update
                                                                        Details</a>

                                                                </span>
                                                            </span>

                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if (count($mdas) < 1)
                                            <tr>
                                                <td colspan="7">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            @if (count($mdas) > 0 && $marker != null)
                                <div class="card-footer">
                                    <div class="row g-2 pt-3 ms-4 me-4">
                                        <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                                            of
                                            {{ number_format($lastRecord) }} Records</div>

                                        <div class="col-md-3">{{ $mdas->appends(request()->input())->links() }}
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
                <h3 class="offcanvas-title" id="offcanvasExampleLabel">Add New MDA</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form class="needs-validation" novalidate method="post" action="{{ route('admin.storeMDA') }}">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label">MDA <span class="text-danger">*</span></label>
                            <input type="text" name="mda" class="form-control" placeholder="Enter MDA" required>
                            <div class="invalid-feedback">Please provide mda.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">MDA Code <span class="text-danger">*</span></label>
                            <input type="text" name="mda_code" class="form-control" placeholder="Enter MDA Code"
                                required>
                            <div class="invalid-feedback">Please provide mda code.</div>
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editMDA" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel"> Edit MDA Details</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form class="needs-validation" novalidate method="post" action="{{ route('admin.updateMDA') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label">MDA <span class="text-danger">*</span></label>
                            <input id="editMda" type="text" name="mda" class="form-control"
                                placeholder="Enter MDA" required>
                            <div class="invalid-feedback">Please provide mda.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">MDA Code <span class="text-danger">*</span></label>
                            <input id="mdacode" type="text" name="mda_code" class="form-control"
                                placeholder="Enter MDA Code" required>
                            <div class="invalid-feedback">Please provide mda code.</div>
                        </div>


                        <input id="myid" type="hidden" name="mda_id" class="form-control" required>

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
    document.getElementById("mdas").classList.add('active');
</script>

@endsection
