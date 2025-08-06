@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Tax Payers')

<!-- Container fluid -->
<section class="container-fluid p-4">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h3 fw-bold">
                        Tax Payers
                    </h1>
                    <!-- Breadcrumb  -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tax Payers
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">

            <!-- Tab -->
            <div class="tab-content">
                <!-- Tab pane -->

                <!-- tab pane -->
                <div class="tab-pane fade show active" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
                    <!-- card -->
                    <div class="card mb-4">
                        <!-- Card header -->
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
                                            placeholder="Search Tax Payers......" value="{{ $search }}">
                                    </div>

                                </div>

                                <div class="col-6 col-lg-3">
                                    <!-- form select -->
                                    <select id="status" name="status" class="form-select"
                                        onChange="this.form.submit()">
                                        <option value="">All Statuses</option>
                                        <option value="active" @if ($status == 'active') selected @endif>
                                            Active
                                        </option>
                                        <option value="suspended" @if ($status == 'suspended') selected @endif>
                                            Suspended
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <!-- table -->
                        <div class="table-responsive overflow-y-hidden mb-5">
                            <table id="" class="table mb-0 text-nowrap table-hover table-centered "
                                style="font-size:12px">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">S/No</th>
                                        <th scope="col">Tax Payer</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">B-TIN</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($taxPayers as $tp)
                                        <tr>
                                            <td class="align-middle"> {{ $loop->index + 1 }}</td>
                                            <td class="align-middle"> {{ $tp->tax_payer  }}</td>
                                            <td class="align-middle"> {{ ucwords($tp->category)  }}</td>
                                            <td class="align-middle"> {{ $tp->btin  }}</td>
                                            <td class="align-middle"> {{ $tp->email }} </td>
                                            <td class="align-middle"> {{ $tp->phone_number }} </td>
                                            <td class="align-middle"> {{ $tp->role }} </td>
                                            <td>
                                                @if ($tp->user->status == 'active')
                                                    <span class="badge text-success bg-light-success">Active</span>
                                                @else
                                                    <span class="badge text-danger bg-light-danger">Suspended</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <div class="hstack gap-4">

                                                    <span class="dropdown dropstart">
                                                        <a class="btn btn-success bg-light-success text-success btn-sm"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            data-bs-offset="-20,20" aria-expanded="false">
                                                            Action</a>
                                                        @if (\App\Http\Controllers\MenuController::canEdit(Auth::user()->role_id, 1) == true)
                                                            <span class="dropdown-menu"><span
                                                                    class="dropdown-header">Action</span>
                                                                <a style="cursor:pointer" class="dropdown-item"
                                                                    data-bs-toggle="offcanvas"
                                                                    data-bs-target="#editAdmin"
                                                                    data-myid="{{ $usr->id }}"
                                                                    data-othernames="{{ $usr->other_names }}"
                                                                    data-lastname="{{ $usr->last_name }}"
                                                                    data-email="{{ $usr->email }}"
                                                                    data-phone="{{ $usr->phone_number }}"
                                                                    data-role="{{ $usr->role_id }}"><i
                                                                        class="fe fe-edit dropdown-item-icon"></i>Edit
                                                                    User Information</a>
                                                                @if ($usr->status == 'active')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.suspendUser', [$usr->id]) }}"
                                                                        onclick="return confirm('Are you sure you want to suspend this user?');"><i
                                                                            class="fe fe-x-circle dropdown-item-icon"></i>Suspend
                                                                        User</a>
                                                                @else
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.activateUser', [$usr->id]) }}"
                                                                        onclick="return confirm('Are you sure you want to activate this user?');"><i
                                                                            class="fe fe-check-circle dropdown-item-icon"></i>Activate
                                                                        User</a>
                                                                @endif
                                                            </span>
                                                        @endif
                                                    </span>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>

                            @if (count($taxPayers) < 1)
                                <div class="col-xl-12 col-12 job-items job-empty">
                                    <div class="text-center mt-4"><i class="bi bi-emoji-frown"
                                            style="font-size: 48px"></i>
                                        <h3 class="mt-2">No Tax Payer Found</h3>
                                        <div class="mt-2 text-muted"> There are no tax payer records found.
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        @if (count($taxPayers) > 0 && $marker != null)
                            <div class="card-footer">
                                <div class="row g-2 pt-3 ms-4 me-4">
                                    <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                                        of
                                        {{ number_format($lastRecord) }} Records</div>

                                    <div class="col-md-3">{{ $taxPayers->appends(request()->input())->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script type="text/javascript">
    document.getElementById("taxpayers").classList.add('active');
</script>

@endsection
