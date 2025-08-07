@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Generate / Pay Bill')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Generate / Pay Bill </h1>
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
                                Generate / Pay Bill
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
                            action="{{ route('individual.updateProfile') }}">
                            @csrf
                            <div class="row">
                                <!-- form group -->
                                <div class="row" style="padding: 0px !important; margin-left: 1px">
                                    <label class="form-label">Payment Period <span class="text-danger">*</span></label>
                                    <div class="mb-3 col-md-6 col-12">
                                        <input type="text" name="last_name" value="" class="form-control"
                                            placeholder="Enter Payment Period" required>

                                        <div class="invalid-feedback">Please select payment period.</div>
                                    </div>
                                    <div class="mb-3 col-md-6 col-12">
                                        <input type="text" name="last_name" value="" class="form-control"
                                            placeholder="Enter Payment Period" required>

                                        <div class="invalid-feedback">Please select payment period.</div>
                                    </div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">MDA<span class="text-danger">*</span></label>
                                    <select id="mda" name="mda" class="form-control" data-width="100%"
                                        required>
                                        <option value="">Select MDA</option>
                                        @foreach ($mdas as $mda)
                                            <option value="{{ $mda->id }}">{{ $mda->mda }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">Please select MDA.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Revenue Item<span class="text-danger">*</span></label>
                                    <select id="revenueItem" name="revenue_item" class="form-control" data-width="100%"
                                        required>
                                        <option value="">Select Revenue Item</option>

                                    </select>

                                    <div class="invalid-feedback">Please select tax station.</div>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="amount" value="" class="form-control"
                                        placeholder="Amount" required readonly>
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
    document.getElementById("taxPayments").classList.add('show');
    document.getElementById("genBill").classList.add('active');
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
</script>

@endsection
