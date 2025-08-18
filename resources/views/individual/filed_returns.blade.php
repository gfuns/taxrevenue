@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Filed Returns')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Filed Returns</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('individual.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Filed Returns</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route("individual.fileReturns") }}" class="btn btn-success btn-sm me-2">
                        <i class="nav-icon bi bi-plus-circle me-2" style="font-size:14px; font-weight:bold"></i> File Returns</a>

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
                                    placeholder="Search Records Using Reference......" value="{{ $search }}">
                            </div>

                        </div>

                        <div class="col-6 col-lg-3">
                            <!-- form select -->
                            <select id="status" name="status" class="form-select" onChange="this.form.submit()">
                                <option value="">All Statuses</option>
                                <option value="draft" @if ($status == 'draft') selected @endif>
                                    Draft
                                </option>
                                <option value="awaiting assessment" @if ($status == 'awaiting assessment') selected @endif>
                                    Awaiting Assessment
                                </option>
                                <option value="awaiting payment" @if ($status == 'awaiting payment') selected @endif>
                                    Awaiting Payment
                                </option>
                                <option value="paid" @if ($status == 'paid') selected @endif>
                                    Paid
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
                                            <th>Reference</th>
                                            <th>Period</th>
                                            <th>Description</th>
                                            <th>Amount Payable</th>
                                            <th>Status</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($transactions as $trx)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $trx->reference }}</td>
                                                <td>{{ $trx->period }}</td>
                                                <td>{{ $trx->description }}</td>
                                                <td>&#8358;{{ number_format($trx->tax_paid, 2) }}</td>

                                                <td>
                                                    @if ($trx->status == 'draft')
                                                        <span
                                                            class="badge text-primary bg-light-primary">{{ ucwords($trx->status) }}</span>
                                                    @elseif ($trx->status == 'awaiting assessment' || $trx->status == 'awaiting payment')
                                                        <span
                                                            class="badge text-warning bg-light-warning">{{ ucwords($trx->status) }}</span>
                                                    @else
                                                        <span
                                                            class="badge text-success bg-light-success">{{ ucwords($trx->status) }}</span>
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

                                                                <a href="{{ route('admin.paymentDetails', [$ph->reference]) }}"
                                                                    style="cursor:pointer" class="dropdown-item"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>

                                                            </span>
                                                        </span>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if (count($transactions) < 1)
                                            <tr>
                                                <td colspan="7">
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

                                        <div class="col-md-3">
                                            {{ $transactions->appends(request()->input())->links() }}
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
    document.getElementById("returns").classList.add('show');
    document.getElementById("filed").classList.add('active');
</script>

@endsection
