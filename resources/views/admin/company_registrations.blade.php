@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Company Registrations')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Company Registrations</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Company Registrations</a>
                            </li>
                        </ol>
                    </nav>
                </div>

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
                                    placeholder="Search Registrations Using Company Name, BSPPC Number or CAC Number......"
                                    value="{{ $search }}">
                            </div>

                        </div>

                        <div class="col-6 col-lg-3">
                            <!-- form select -->
                            <select id="status" name="status" class="form-select" onChange="this.form.submit()">
                                <option value="">All Statuses</option>
                                <option value="pending" @if ($status == 'pending') selected @endif>Pending
                                </option>
                                <option value="approved" @if ($status == 'approved') selected @endif>Approved
                                </option>
                                <option value="rejected" @if ($status == 'rejected') selected @endif>Rejected
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
                            <div class="table-responsive" style="min-height:200px">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                                    style="font-size: 14px;">
                                    <!-- Table Head -->
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name</th>
                                            <th>BSPPC Reg. No</th>
                                            <th>CAC Reg. No</th>
                                            <th>Business Category</th>
                                            <th>Classification</th>
                                            <th>Reg. Date</th>
                                            <th>Application Status</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($transactions as $trx)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $trx->company_name }}</td>
                                                <td>{{ $trx->bsppc_number ?? 'Not Assigned' }}</td>
                                                <td>{{ $trx->cac_number }}</td>
                                                <td>{{ $trx->business_category }}</td>
                                                <td>{{ $trx->classification }}</td>
                                                <td>{{ date_format($trx->created_at, 'jS M, Y') }}</td>
                                                <td>
                                                    @if ($trx->status == 'pending' || $trx->status == 'awaiting approval')
                                                        <span
                                                            class="badge text-warning bg-light-warning">{{ ucwords($trx->status) }}</span>
                                                    @elseif($trx->status == 'approved')
                                                        <span
                                                            class="badge text-success bg-light-success">{{ ucwords($trx->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge text-danger bg-light-danger">{{ ucwords($trx->status) }}</span>
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

                                                                <a class="dropdown-item" href="#"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>

                                                                <a class="dropdown-item" href="#"><i
                                                                        class="fe fe-upload dropdown-item-icon"></i>Upload
                                                                    BSPPC Certificate</a>

                                                                <a class="dropdown-item" href="#"><i
                                                                        class="fe fe-check-circle dropdown-item-icon"></i>Approve
                                                                    Application</a>

                                                                <a class="dropdown-item" href="#"><i
                                                                        class="fe fe-x-circle dropdown-item-icon"></i>Reject
                                                                    Application</a>

                                                            </span>
                                                        </span>

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                        @if (count($transactions) < 1)
                                            <tr>
                                                <td colspan="9">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            @if (count($transactions) > 0 && $marker != null)
                                <div class="card-footer">
                                    <div class="row g-2 pt-3 ms-4 me-4">
                                        <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                                            of
                                            {{ number_format($lastRecord) }} Records</div>

                                        <div class="col-md-3">{{ $transactions->appends(request()->input())->links() }}
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


<script type="text/javascript">
    document.getElementById("companies").classList.add('active');
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
@endsection
