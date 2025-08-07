@extends('individual.layouts.app')

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
                                <a href="{{ route('individual.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Tax Consultants</a>
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
                <div class="p-3">
                    <h4>Assigned Consultant</h4>
                </div>
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
                                            <th>Consultant Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($assignedConsultants as $ac)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $ac->consultant->organization }}</td>
                                                <td>{{ $ac->consultant->surname }}, {{ $ac->consultant->first_name }}
                                                    {{ $ac->consultant->other_names }}
                                                </td>
                                                <td>{{ $ac->consultant->email }}</td>
                                                <td>{{ $ac->consultant->phone_number }}</td>
                                                <td>
                                                    @if ($ac->status == 'active')
                                                        <span
                                                            class="badge text-success bg-light-success">{{ ucwords($ac->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge text-danger bg-light-danger">{{ ucwords($ac->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger bg-light-danger text-danger btn-sm"
                                                        href="#" role="button">Cancel</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if (count($assignedConsultants) < 1)
                                            <tr>
                                                <td colspan="7">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer">
                                <div class="row g-2 pt-3 ms-4 me-4">

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- Card Footer -->

            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-12 mt-5">
            <!-- Card -->
            <div class="card rounded-3">
                <!-- Card Header -->
                <form id="form" name="form" method="GET">
                    <div class="p-4 row gx-3">
                        <div>
                            <h4>Approved Consultants</h4>
                        </div>
                        <!-- Form -->
                        <div class="col-12 col-lg-12 mb-3 mb-lg-0">
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
                                            <th>Consultant Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($taxConsultants as $tac)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $tac->organization }}</td>
                                                <td>{{ $tac->surname }}, {{ $tac->other_names }}</td>
                                                <td>{{ $tac->email }}</td>
                                                <td>{{ $tac->phone_number }}</td>
                                                <td>
                                                    <a style="cursor:pointer"
                                                        class="btn btn-success bg-light-success text-success btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#viewConsultantDetails"
                                                        data-myid="{{ $tac->id }}"
                                                        data-surname="{{ $tac->surname }}"
                                                        data-othernames="{{ $tac->other_names }}"
                                                        data-organization="{{ $tac->organization }}"
                                                        data-email="{{ $tac->email }}"
                                                        data-phone="{{ $tac->phone_number }}"
                                                        data-photo="{{ $tac->photo }}"
                                                        data-gender="{{ ucwords($tac->gender) }}">View Details</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if (count($taxConsultants) < 1)
                                            <tr>
                                                <td colspan="7">
                                                    <center>No Record Found</center>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            @if (count($taxConsultants) > 0 && $marker != null)
                                <div class="card-footer">
                                    <div class="row g-2 pt-3 ms-4 me-4">
                                        <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                                            of
                                            {{ number_format($lastRecord) }} Records</div>

                                        <div class="col-md-3">
                                            {{ $taxConsultants->appends(request()->input())->links() }}
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
                            <td class="" rowspan="8" align="right" style="text-align: center"><img
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

                <form method="post" action="{{ route('taxpayer.requestConsultant') }}">
                    @csrf

                    <input id="myid" type="hidden" name="consultant_id" class="form-control" required>
                    <button type="sumit" class="btn btn-outline-success w-100">Request Consultant</button>
                </form>
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
