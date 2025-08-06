@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | POS Terminals')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">POS Terminals</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">POS Terminals</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                @if (\App\Http\Controllers\MenuController::canCreate(Auth::user()->role_id, 1) == true)
                    <!-- button -->
                    <div>
                        <a href="#" class="btn btn-success btn-sm me-2" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight">Add New POS Terminal</a>

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
                                    placeholder="Search POS Terminals......" value="{{ $search }}">
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
                                            <th>POS Model</th>
                                            <th>Terminal ID</th>
                                            <th>Serial Number</th>
                                            <th>SIM No.</th>
                                            <th>Assigned</th>
                                            <th>Status</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($posTerminals as $pos)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $pos->model }}</td>
                                                <td>{{ $pos->terminal_id }}</td>
                                                <td>{{ $pos->serial_number }}</td>
                                                <td>{{ $pos->sim ?? 'Not Assigned' }}</td>
                                                <td>{{ $pos->assigned == 1 ? 'Assigned' : 'Not Assigned' }}</td>
                                                <td>
                                                    @if ($pos->status == 'active')
                                                        <span
                                                            class="badge text-success bg-light-success">{{ ucwords($pos->status) }}</span>
                                                    @elseif($pos->status == 'inactive')
                                                        <span
                                                            class="badge text-warning bg-light-warning">{{ ucwords($pos->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge text-danger bg-light-danger">{{ ucwords($pos->status) }}</span>
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
                                                                    data-bs-target="#viewPosDetails"
                                                                    data-myid="{{ $pos->id }}"
                                                                    data-model="{{ $pos->model }}"
                                                                    data-terminalid="{{ $pos->terminal_id }}"
                                                                    data-serialno="{{ $pos->serial_number }}"
                                                                    data-ip="{{ $pos->ip_address ?? 'Not Assigned'}}"
                                                                    data-port="{{ $pos->port ?? 'Not Assigned'}}"
                                                                    data-sim="{{ $pos->sim ?? 'Not Assigned'}}"
                                                                    data-assigned="{{ $pos->assigned == 1 ? 'Assigned' : 'Not Assigned' }}"
                                                                    data-status="{{ ucwords($pos->status) }}"
                                                                    data-date="{{  date_format($pos->created_at, 'jS F, Y g:i:a') }}"
                                                                    data-notificationip="{{ $pos->notification_ip ?? 'Not Assigned'}}"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>

                                                                <a style="cursor:pointer" class="dropdown-item"
                                                                    data-bs-toggle="offcanvas"
                                                                    data-bs-target="#editPosTerminal"
                                                                    data-myid="{{ $pos->id }}"
                                                                    data-model="{{ $pos->model }}"
                                                                    data-terminalid="{{ $pos->terminal_id }}"
                                                                    data-serialno="{{ $pos->serial_number }}"
                                                                    data-ip="{{ $pos->ip_address }}"
                                                                    data-port="{{ $pos->port }}"
                                                                    data-sim="{{ $pos->sim }}"
                                                                    data-notificationip="{{ $pos->notification_ip }}"><i
                                                                        class="fe fe-edit dropdown-item-icon"></i>Update
                                                                    Details</a>

                                                            </span>
                                                        </span>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if (count($posTerminals) < 1)
                                            <tr>
                                                <td colspan="8">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            @if (count($posTerminals) > 0 && $marker != null)
                                <div class="card-footer">
                                    <div class="row g-2 pt-3 ms-4 me-4">
                                        <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                                            of
                                            {{ number_format($lastRecord) }} Records</div>

                                        <div class="col-md-3">
                                            {{ $posTerminals->appends(request()->input())->links() }}
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
                <h3 class="offcanvas-title" id="offcanvasExampleLabel"> Add New POS Terminal</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form class="needs-validation" novalidate method="post"
                    action="{{ route('admin.storePosTerminal') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- form group -->

                        <div class="mb-3 col-12">
                            <label class="form-label">POS Model <span class="text-danger">*</span></label>
                            <select id="terminal" name="pos_model" class=" form-control" data-width="100%"
                                required>
                                <option value="">Select POS Model</option>
                                <option value="PAX">PAX</option>
                                <option value="PRO">PRO</option>
                                <option value="K11">K11</option>
                                <option value="NetPOS">NetPOS</option>
                                <option value="MP35P">MP35P</option>
                            </select>
                            <div class="invalid-feedback">Please select gender.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Terminal ID <span class="text-danger">*</span></label>
                            <input type="text" name="terminal_id" class="form-control"
                                placeholder="Enter Terminal ID" required>
                            <div class="invalid-feedback">Please provide terminal id.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                            <input type="text" name="serial_number" class="form-control"
                                placeholder="Enter Serial Number" required>
                            <div class="invalid-feedback">Please provide serial number.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">IP Address </label>
                            <input type="text" name="other_names" class="form-control"
                                placeholder="Enter IP Address">
                            <div class="invalid-feedback">Please provide IP address.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Notification IP Address </label>
                            <input type="text" name="notification_ip" class="form-control"
                                placeholder="Enter Notification IP Address">
                            <div class="invalid-feedback">Please provide notification IP address.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Port </label>
                            <input type="text" name="port" class="form-control" placeholder="Enter Port">
                            <div class="invalid-feedback">Please provide port.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">SIM Number </label>
                            <input type="text" name="SIM_number" class="form-control"
                                placeholder="Enter SIM Number">
                            <div class="invalid-feedback">Please provide SIM number.</div>
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editPosTerminal" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel"> Edit POS Terminal Details</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form class="needs-validation" novalidate method="post"
                    action="{{ route('admin.updatePosTerminal') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label">POS Model <span class="text-danger">*</span></label>
                            <select id="model" name="pos_model" class=" form-control" data-width="100%"
                                required>
                                <option value="">Select POS Model</option>
                                <option value="PAX">PAX</option>
                                <option value="PRO">PRO</option>
                                <option value="K11">K11</option>
                                <option value="NetPOS">NetPOS</option>
                                <option value="MP35P">MP35P</option>
                            </select>
                            <div class="invalid-feedback">Please select gender.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Terminal ID <span class="text-danger">*</span></label>
                            <input id="terminalid" type="text" name="terminal_id" class="form-control"
                                placeholder="Enter Terminal ID" required>
                            <div class="invalid-feedback">Please provide terminal id.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                            <input id="serialno" type="text" name="serial_number" class="form-control"
                                placeholder="Enter Serial Number" required>
                            <div class="invalid-feedback">Please provide serial number.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">IP Address </label>
                            <input id="ip" type="text" name="other_names" class="form-control"
                                placeholder="Enter IP Address">
                            <div class="invalid-feedback">Please provide IP address.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Notification IP Address </label>
                            <input id="notificationIp" type="text" name="notification_ip" class="form-control"
                                placeholder="Enter Notification IP Address">
                            <div class="invalid-feedback">Please provide notification IP address.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Port </label>
                            <input id="port" type="text" name="port" class="form-control"
                                placeholder="Enter Port">
                            <div class="invalid-feedback">Please provide port.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">SIM Number </label>
                            <input id="sim" type="text" name="SIM_number" class="form-control"
                                placeholder="Enter SIM Number">
                            <div class="invalid-feedback">Please provide SIM number.</div>
                        </div>

                        <input id="myid" type="hidden" name="pos_id" class="form-control" required>

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


<div class="modal fade" id="viewPosDetails" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    View POS Terminal Details
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>

                        <tr>
                            <td class=""><strong>POS Model:</strong></td>
                            <td class=""><span id="vmodel"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Terminal ID:</strong></td>
                            <td class=""><span id="vterminalid"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Serial Number</strong></td>
                            <td class=""><span id="vserialno"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>IP Addresss:</strong></td>
                            <td class=""><span id="vip"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Notification IP:</strong></td>
                            <td class=""><span id="vnotificationip"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Port:</strong></td>
                            <td class=""><span id="vport"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>SIM Number</strong></td>
                            <td class=""><span id="vsim"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Assigned?</strong></td>
                            <td class=""><span id="vassigned"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Status</strong></td>
                            <td class=""><span id="vstatus"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Date Created</strong></td>
                            <td class=""><span id="vdate"></span></td>
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
    document.getElementById("pos").classList.add('active');
</script>

@endsection
