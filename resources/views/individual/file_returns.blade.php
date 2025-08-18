@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | File Returns')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">File Returns </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('individual.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Payments</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                File Returns
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

            <div class="offset-xl-2 col-xl-8 col-md-12 col-12">


                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <!-- form -->
                        <form method="post" class="needs-validation" novalidate
                            action="{{ route('individual.initiateReturnsFiling') }}">
                            @csrf
                            <div class="row">
                                <!-- form group -->
                                <div class="row" style="padding: 0px !important; margin-left: 1px">
                                    <label class="form-label">Payment Period <span class="text-danger">*</span></label>
                                    <div class="mb-3 col-md-6 col-12">
                                        <select id="revenueItem" name="payment_period" class="form-control"
                                            data-width="100%" required>
                                            <option value="2020">Year 2020</option>
                                            <option value="2021">Year 2021</option>
                                            <option value="2022">Year 2022</option>
                                            <option value="2023">Year 2023</option>
                                            <option value="2024">Year 2024</option>
                                            <option value="2025" selected>Year 2025</option>
                                        </select>

                                        <div class="invalid-feedback">Please select payment period.</div>
                                    </div>
                                </div>

                                <div class="row" style="padding: 0px !important; margin-left: 1px">
                                    <label class="form-label">Income Generated From Employment <span
                                            class="text-danger">*</span></label>
                                    <div class="mb-3 col-md-4 col-12">
                                        <label class="form-label" style="font-size: 11px">Salary <span
                                                class="text-danger">*</span></label>
                                        <input id="startPeriod" type="text" name="salary" value=""
                                            class="form-control" placeholder="Enter Salary" autocomplete="off" required>

                                        <div class="invalid-feedback">Please enter an amount.</div>
                                    </div>
                                    <div class="mb-3 col-md-4 col-12">
                                        <label class="form-label" style="font-size: 11px">Allowances <span
                                                class="text-danger">*</span></label>
                                        <input id="endPeriod" type="text" name="allowances" value=""
                                            class="form-control" placeholder="Enter Allowances" autocomplete="off"
                                            required>

                                        <div class="invalid-feedback">Please enter an amount.</div>
                                    </div>
                                    <div class="mb-3 col-md-4 col-12">
                                        <label class="form-label" style="font-size: 11px">Commissions, Bonuses,
                                            Gratuities <span class="text-danger">*</span></label>
                                        <input id="endPeriod" type="text" name="commissions" value=""
                                            class="form-control" placeholder="Enter Commissions, Bonuses, Gratuities"
                                            autocomplete="off" required>

                                        <div class="invalid-feedback">Please enter an amount.</div>
                                    </div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Income Generated From Trade, Business, Profession,
                                        Vocation, etc <span class="text-danger">*</span></label>
                                    <input id="taxAmount" type="text" name="trades" value=""
                                        class="form-control" placeholder="Income Generated From Trade, Business, Profession, Vocation, etc" required>
                                    <div class="invalid-feedback">Please enter an amount.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Consolidated Gross Income <span
                                            class="text-danger">*</span></label>
                                    <input id="taxAmount" type="text" name="consolidated_income" value=""
                                        class="form-control" placeholder="Enter Consolidated Gross Income" required>
                                    <div class="invalid-feedback">Please enter an amount.</div>
                                </div>

                                <div class="col-md-8"></div>
                                <!-- button -->
                                <div class="col-12">
                                    <button class="btn btn-success w-100" type="submit">Submit and Proceed</button>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("returns").classList.add('show');
    document.getElementById("filed").classList.add('active');
</script>

@endsection

@section('customjs')
<script type="text/javascript">
    $(document).ready(function() {
        $('#mda').select2();
    });

    $(document).ready(function() {
        $('#revenueItem').select2();
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

    $('#startPeriod').datepicker({
        format: "MM yyyy", // Display format
        startView: "months", // Start in months view
        minViewMode: "months", // Only allow month/year selection
        autoclose: true,
        orientation: "bottom auto" // Force dropdown to bottom
    });

    $('#endPeriod').datepicker({
        format: "MM yyyy", // Display format
        startView: "months", // Start in months view
        minViewMode: "months", // Only allow month/year selection
        autoclose: true,
        orientation: "bottom auto" // Force dropdown to bottom
    });
</script>

@endsection
