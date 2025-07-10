@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Payment Items')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h3 fw-bold">Payment Items</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Payment Items</a>
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
                                            <th>Payment Item</th>
                                            <th>Applicate Fee</th>
                                            <th>Tech. Fee Config.</th>
                                            <th>Technology Fee</th>
                                            <th><i class="nav-icon bi bi-three-dots me-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($paymentItems as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->item }}</td>
                                                <td>&#8358;{{ number_format($item->amount, 2) }}</td>
                                                <td>{{ ucwords($item->fee_config) }}</td>
                                                <td>
                                                    @if ($item->fee_config == 'fixed')
                                                        &#8358;
                                                        @endif{{ number_format($item->fee, 2) }}@if ($item->fee_config == 'percentage')
                                                            %
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

                                                                <a class="dropdown-item" href="#"
                                                                data-bs-toggle="offcanvas"
                                                                    data-bs-target="#editPaymentItem"
                                                                    data-myid="{{ $item->id }}"
                                                                    data-item="{{ $item->item }}"
                                                                    data-amount="{{ $item->amount }}"
                                                                    data-fee="{{ $item->fee }}"
                                                                    data-feeconfig="{{ $item->fee_config }}"><i
                                                                        class="fe fe-edit dropdown-item-icon"></i>Update
                                                                    Details</a>

                                                            </span>
                                                        </span>

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                        @if (count($paymentItems) < 1)
                                            <tr>
                                                <td colspan="6">
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

<div class="offcanvas offcanvas-end" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1"
    id="editPaymentItem" style="width: 600px;">
    <div class="offcanvas-body" data-simplebar>
        <div class="offcanvas-header px-2 pt-0">
            <h3 class="offcanvas-title" id="offcanvasExampleLabel">Edit Payment Items</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <!-- card body -->
        <div class="container">
            <!-- form -->
            <form class="needs-validation" novalidate method="post"
                action="{{ route('admin.updatePaymentItem') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- form group -->
                    <div class="mb-3 col-12">
                        <label class="form-label">Payment Item <span class="text-danger">*</span></label>
                        <input id="item" type="text" class="form-control" name="payment_item"
                            placeholder="Enter Payment Item" required>
                        <div class="invalid-feedback">Please provide payment item.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Application Fee <span class="text-danger">*</span></label>
                        <input id="amount" type="text" class="form-control" name="application_fee"
                            placeholder="Enter Application Fee" required oninput="validateInput(event)">
                        <div class="invalid-feedback">Please provide application fee.</div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Technology Fee Configuration <span class="text-danger">*</span></label>
                        <select id="feeconfig" name="fee_configuration" class="form-select">
                                <option value="">Select Technology Fee Configuration</option>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                            </select>
                        <div class="invalid-feedback">Please select technological fee configuration.</div>
                    </div>

                    <div id="" class="mb-3 col-12">
                        <label class="form-label" id="feelab1">Technology Fee </label> <span class="text-danger">*</span>
                        <input id="fee" type="text" class="form-control" name="fee"
                            placeholder="Enter Technology Fee" required oninput="validateInput(event)">
                        <div class="invalid-feedback">Please enter technological fee <span id="feelab2" style="display: none">(enter percentage to be charged)</span>.</div>
                    </div>


                    <input id="myid" type="hidden" name="item_id" class="form-control" required>

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


<script type="text/javascript">
    document.getElementById("platSettings").classList.add('show');
    document.getElementById("payItems").classList.add('active');
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
