@extends('mda.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Generate Tax Payer Bill')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Generate Tax Payer Bill </h1>
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
                                Generate Tax Payer Bill
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
                            action="{{ route('mda.initiateBillGeneration') }}">
                            @csrf
                            <div class="row">
                                <!-- form group -->
                                <div class="mb-3 col-12">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="isTaxPayer"
                                                name="registered" value="yes" checked>
                                            <label class="form-check-label" for="btin"><span
                                                    style="color:black">Registered Tax Payer?</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div id="tpBtin" class="mb-3 col-12">
                                    <label class="form-label">B-TIN <span class="text-danger">*</span></label>
                                    <input id="btin" type="text" name="btin" value=""
                                        class="form-control" placeholder="Enter Tax Payer's B-TIN" autocomplete="off"
                                        required>

                                    <div class="invalid-feedback">Please enter tax payer's B-TIN.</div>
                                </div>

                                <div id="tpName" class="mb-3 col-12" style="display: none">
                                    <label class="form-label">Tax Payer Name <span class="text-danger">*</span></label>
                                    <input id="taxpayer" type="text" name="tax_payer" value=""
                                        class="form-control" placeholder="Enter Tax Payer's Name" autocomplete="off"
                                        required>

                                    <div class="invalid-feedback">Please enter tax payer's Name.</div>
                                </div>


                                <div class="row" style="padding: 0px !important; margin-left: 1px">
                                    <label class="form-label">Payment Period <span class="text-danger">*</span></label>
                                    <div class="mb-3 col-md-6 col-12">
                                        <input id="startPeriod" type="text" name="start_period" value=""
                                            class="form-control" placeholder="Enter Start Period" autocomplete="off"
                                            required>

                                        <div class="invalid-feedback">Please select payment period.</div>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <input id="endPeriod" type="text" name="end_period" value=""
                                            class="form-control" placeholder="Enter End Period" autocomplete="off"
                                            required>

                                        <div class="invalid-feedback">Please select payment period.</div>
                                    </div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Revenue Item<span class="text-danger">*</span></label>
                                    <select id="revenueItem" name="revenue_item" class="form-control" data-width="100%"
                                        required>
                                        <option value="" data-amount="999">Select Tax/Revenue Item</option>
                                        @foreach ($paymentItems as $pi)
                                            <option value="{{ $pi->id }}">{{ $pi->revenue_item }} |
                                                {{ $pi->revenue_code }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">Please select tax station.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                                    <input id="taxAmount" type="text" name="amount" value=""
                                        class="form-control" placeholder="Amount" required oninput="validateInput(event)">
                                        <div class="invalid-feedback">Please enter amount.</div>
                                </div>

                                <div class="col-md-8"></div>
                                <!-- button -->
                                <div class="col-12">
                                    <button class="btn btn-success w-100" type="submit">Generate Bill</button>

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
    document.getElementById("generateBill").classList.add('active');
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


    $('#revenueItem').change(function() {
        var taxId = $(this).val();
        $('#taxAmount').html(
            '<option value="">Fetching data, please wait...</option>'); // Show "Fetching data" message
        $.ajax({
            url: "/ajax/tax-amount/" + taxId,
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data.amount && data.amount !== "") {
                    $('#taxAmount').val(data.amount).prop("readonly", true);
                } else {
                    $('#taxAmount').val("").prop("readonly", false);
                }

            }
        });
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
