@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Wallet')


<!-- Container fluid -->
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Wallet</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Wallet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row justify-content-center p-1 p-lg-3">
        <div class="mt-0 ">

            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card header -->

                    <!-- Card body -->
                    <div class="card-body">

                        <div class="row mt-3 mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-10 mb-lg-0">
                                <div class="text-center">

                                    <h4 class="mb-1">Your Arete Wallet Balance</h4>
                                    <h5 class="mb-0 display-5 fw-bold mt-4">
                                        &#8358;{{ number_format(Auth::user()->wallet->arete_balance, 2) }}</h5>
                                    <div class="mt-4">
                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#topupModal">Top Up</button>
                                        <button class="btn btn-danger ms-5" data-bs-toggle="modal"
                                            data-bs-target="#withdrawalModal">Withdraw</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3 mb-lg-0">
                                <div class="text-center">

                                    <h4 class="mb-1">Your Arete Bonus Balance</h4>
                                    <h5 class="mb-0 display-5 fw-bold mt-4">
                                        &#8358;{{ number_format(Auth::user()->wallet->referral_points, 2) }}</h5>
                                    @if (Auth::user()->wallet->referral_points >= 10000)
                                        <div class="mt-4">
                                            <button class="btn btn-danger ms-5" data-bs-toggle="modal"
                                                data-bs-target="#bonusWithdrawalModal">Withdraw</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card mb-4">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card rounded-3">
                                <!-- Card header -->
                                <div class="card-header p-0">
                                    <div>
                                        <!-- Nav -->
                                        <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" href="{{ route('business.myWallet') }}"
                                                    role="tab">Top Up Transactions</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" href="{{ route('business.myWalletWithdrawals') }}"
                                                    role="tab">Withdrawal Transactions</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" href="{{ route('business.myWalletPoints') }}"
                                                    role="tab">Arete Bonus Transactions</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <!-- Table -->
                                    <div class="tab-content" id="tabContent">
                                        <!--Tab pane -->
                                        <div class="tab-pane fade active show" id="courses" role="tabpanel"
                                            aria-labelledby="courses-tab">
                                            <!-- Card header -->
                                            <div class="card-header border-bottom-0">
                                                <h3 class="h4 mb-3 mt-4">Top Transactions</h3>
                                                {{-- <div class="row align-items-center">
                                                    <div class="col-lg-3 col-md-6 pe-md-0 mb-2 mb-lg-0">
                                                        <!-- Custom select -->
                                                        <select class="form-select">
                                                            <option value="">30 days</option>
                                                            <option value="Last 7 days">2 Months</option>
                                                            <option value="High Rated">6 Months</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 pe-md-0 mb-2 mb-lg-0">
                                                        <!-- Custom select -->
                                                        <select class="form-select">
                                                            <option value="">Oct 2020</option>
                                                            <option value="Jan 2021">Jan 2021</option>
                                                            <option value="May 2021">May 2021</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">
                                                        <!-- Custom select -->
                                                        <select class="form-select">
                                                            <option value="">Transaction Type</option>
                                                            <option value="cash transactions">Cash Transactions</option>
                                                            <option value="non-cash transactions">Non Cash Transactions
                                                            </option>
                                                            <option value="credit transactions">Credit Transactions
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 text-lg-end">
                                                        <!-- Button -->
                                                        <a href="#" class="btn btn-outline-secondary btn-icon"
                                                            download="">
                                                            <i class="fe fe-download"></i>
                                                        </a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <!-- Table -->
                                            <div class="table-responsive">
                                                <table
                                                    class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>S/No</th>
                                                            <th>Topup Amount</th>
                                                            <th>Payment Method</th>
                                                            <th>Balance Before</th>
                                                            <th>Balance After</th>
                                                            <th>Transaction Date</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($topUps as $trx)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>&#8358;{{ number_format($trx->amount, 2) }}</td>
                                                                <td>{{ $trx->payment_method }}</td>
                                                                <td>&#8358;{{ number_format($trx->balance_before, 2) }}
                                                                </td>
                                                                <td>&#8358;{{ number_format($trx->balance_after, 2) }}
                                                                </td>
                                                                <td>{{ date_format($trx->created_at, 'jS M, Y') }}</td>
                                                                <td>
                                                                    @if ($trx->status == 'Initiated')
                                                                        <span
                                                                            class="badge text-info bg-light-info">Initiated</span>
                                                                    @elseif($trx->status == 'Pending')
                                                                        <span
                                                                            class="badge text-warning bg-light-warning">Pending</span>
                                                                    @elseif($trx->status == 'Successful')
                                                                        <span
                                                                            class="badge text-success bg-light-success">Successful</span>
                                                                    @else
                                                                        <span
                                                                            class="badge text-danger bg-light-danger">Failed</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <!-- Card Footer -->
                                <div class="card-footer">
                                    @if (count($topUps) < 1)
                                        <div class="col-xl-12 col-12 job-items job-empty">
                                            <div class="text-center mt-4"><i class="bi bi-emoji-frown"
                                                    style="font-size: 48px"></i>
                                                <h3 class="mt-2">No Top Up Transaction</h3>
                                                <div class="mt-2 text-muted"> There are no top up
                                                    transactions found with your
                                                    queries. </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Paginator --}}

                                    @if (count($topUps) > 0 && $marker != null)
                                        <div class="row g-2 pt-3 me-4">
                                            <div class="col-md-9">Showing {{ $marker['begin'] }} to
                                                {{ $marker['end'] }}
                                                of
                                                {{ number_format($lastRecord) }} Records</div>

                                            <div class="col-md-3">
                                                {{ $topUps->appends(request()->input())->links() }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-lg-11 col-12">

        </div>
    </div>
</div>


<!-- Topup Modal -->
<div class="modal fade" id="topupModal" tabindex="-1" role="dialog" aria-labelledby="topupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center d-flex">
                <h4 class="modal-title" id="topupModalLabel">Wallet Topup</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="mb-3 col-12 col-md-12 mb-4">
                    <form method="POST" action="{{ route('business.initiateWalletTopup') }}"
                        class="row mb-4 needs-validation" novalidate>
                        @csrf
                        <div class="mb-3 col-12">
                            <label for="amount" class="form-label">Topup Amount</label>
                            <input id="amount" type="text" class="form-control" name="topup_amount"
                                placeholder="Topup Amount" oninput="validateInput(event)" required />
                            <div class="invalid-feedback">Please enter topup amount.</div>
                        </div>

                        <div class=" col-12">
                            <button class="btn btn-primary text-end" type="submit"
                                onClick = "this.disabled=true; this.innerHTML='Submiting request, please wait...';this.form.submit();">Proceed
                                To Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Withdrawal Modal -->
<div class="modal fade" id="withdrawalModal" tabindex="-1" role="dialog" aria-labelledby="withdrawalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center d-flex">
                <h4 class="modal-title" id="withdrawalModalLabel">Wallet Withdrawal Transaction</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="mb-3 col-12 col-md-12 mb-4">
                    <form method="POST" action="{{ route('business.initiateWalletWithdrawal') }}"
                        class="row mb-4 needs-validation" novalidate>
                        @csrf
                        <div class="mb-3 col-12">
                            <label for="bank" class="form-label">Bank</label>
                            <select name="bank" class="form-select text-dark" id="bank" required
                                style="width:100%">
                                <option value="">Select Bank</option>
                                @foreach ($bankList as $bank)
                                    <option value="{{ $bank->bank_code }}">{{ $bank->bank_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please enter topup amount.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="accountnumber" class="form-label">Account Number</label>
                            <input id="accountnumber" type="text" class="form-control" name="account_number"
                                placeholder="Account Number" oninput="validateInput(event)" maxlength="10"
                                required />
                            <div class="invalid-feedback">Please enter account Number.</div>
                            <div id="validationprogress" class="valid-feedback" style="font-weight:bold;">Validating
                                Account Number...</div>
                            <div id="validationerror" class="invalid-feedback" style="font-weight:bold;">Account
                                Number Validation Failed</div>
                        </div>

                        <div id="accountnamediv" class="mb-3 col-12">
                            <label for="accountname" class="form-label">Account Name</label>
                            <input id="accountname" type="text" class="form-control" name="account_name"
                                placeholder="Account Name" required readonly />
                            <div class="invalid-feedback">Please enter account Number.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="amount" class="form-label">Withdrawal Amount</label>
                            <input id="amount" type="text" class="form-control" name="amount"
                                placeholder="Withdrawal Amount" oninput="validateInput(event)" required />
                            <div class="invalid-feedback">Please enter withdrawal amount.</div>
                        </div>

                        @if (Auth::user()->withdrawal_confirmation == 'GoogleAuth')
                            <div class="mb-3 col-12">
                                <label for="gacode" class="form-label">Google Authenticator Code</label>
                                <input id="gacode" type="text" class="form-control"
                                    name="google_authenticator_code" placeholder="Google Authenticator Code"
                                    required />
                                <div class="invalid-feedback">Please enter google authenticator code.</div>
                            </div>
                        @endif

                        <div class=" col-12">
                            <button id="submitbutton" class="btn btn-primary text-end" type="submit"
                                onClick = "this.disabled=true; this.innerHTML='Submiting request, please wait...';this.form.submit();">Submit
                                Withdrawal Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bonusWithdrawalModal" tabindex="-1" role="dialog"
    aria-labelledby="withdrawalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center d-flex">
                <h4 class="modal-title" id="withdrawalModalLabel">Bonus Withdrawal Transaction</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="mb-3 col-12 col-md-12 mb-4">
                    <form method="POST" action="{{ route('business.initiateBonusWithdrawal') }}"
                        class="row mb-4 needs-validation" novalidate>
                        @csrf
                        <div class="mb-3 col-12">
                            <label for="bank" class="form-label">Bank</label>
                            <select name="bank" class="form-select text-dark" id="bank2" required
                                style="width:100%">
                                <option value="">Select Bank</option>
                                @foreach ($bankList as $bank)
                                    <option value="{{ $bank->bank_code }}">{{ $bank->bank_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please enter topup amount.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="accountnumber" class="form-label">Account Number</label>
                            <input id="accountnumber2" type="text" class="form-control" name="account_number"
                                placeholder="Account Number" oninput="validateInput(event)" maxlength="10"
                                required />
                            <div class="invalid-feedback">Please enter account Number.</div>
                            <div id="validationprogress2" class="valid-feedback" style="font-weight:bold;">Validating
                                Account Number...</div>
                            <div id="validationerror2" class="invalid-feedback" style="font-weight:bold;">Account
                                Number Validation Failed</div>
                        </div>

                        <div id="accountnamediv2" class="mb-3 col-12">
                            <label for="accountname" class="form-label">Account Name</label>
                            <input id="accountname2" type="text" class="form-control" name="account_name"
                                placeholder="Account Name" required readonly />
                            <div class="invalid-feedback">Please enter account Number.</div>
                        </div>

                        <div class="mb-3 col-12">
                            <label for="amount" class="form-label">Withdrawal Amount</label>
                            <input id="amount" type="text" class="form-control" name="amount"
                                placeholder="Withdrawal Amount" oninput="validateInput(event)" required />
                            <div class="invalid-feedback">Please enter withdrawal amount.</div>
                        </div>

                        @if (Auth::user()->withdrawal_confirmation == 'GoogleAuth')
                            <div class="mb-3 col-12">
                                <label for="gacode" class="form-label">Google Authenticator Code</label>
                                <input id="gacode" type="text" class="form-control"
                                    name="google_authenticator_code" placeholder="Google Authenticator Code"
                                    required />
                                <div class="invalid-feedback">Please enter google authenticator code.</div>
                            </div>
                        @endif

                        <div class=" col-12">
                            <button id="submitbutton2" class="btn btn-primary text-end" type="submit"
                                onClick = "this.disabled=true; this.innerHTML='Submiting request, please wait...';this.form.submit();">Submit
                                Withdrawal Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("wallet").classList.add('active');
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

<script type="text/javascript">
    $(document).ready(function() {
        // Hide the account name text field by default
        $('#accountnamediv').hide();

        // Disable the submit button by default
        $('#submitbutton').prop('disabled', true);

        // AJAX request on account number change
        $('#accountnumber').on('input', function() {
            var accountnumber = $(this).val();
            var bank = document.getElementById("bank").value;

            // Check if the length of the input is between 1 and 10 digits
            if (accountnumber.length == 10) {
                $('#validationprogress').show();
                $('#validationerror').hide();
                // Make AJAX call to validate account number
                $.ajax({
                    url: '{{ route('business.validateAccount') }}',
                    type: 'POST',
                    data: {
                        accountnumber: accountnumber,
                        bank: bank,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Update account name field with the returned value
                        $('#accountname').val(response.account_name);
                        // Show the account name text field
                        $('#accountnamediv').show();
                        // Enable the submit button
                        $('#submitbutton').prop('disabled', false);
                        $('#validationprogress').hide();

                    },
                    error: function(xhr, status, error) {
                        $('#validationprogress').hide();
                        $('#validationerror').show();
                        // Handle errors if needed
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        // Hide the account name text field by default
        $('#accountnamediv2').hide();

        // Disable the submit button by default
        $('#submitbutton2').prop('disabled', true);

        // AJAX request on account number change
        $('#accountnumber2').on('input', function() {
            var accountnumber = $(this).val();
            var bank = document.getElementById("bank2").value;

            // Check if the length of the input is between 1 and 10 digits
            if (accountnumber.length == 10) {
                $('#validationprogress2').show();
                $('#validationerror2').hide();
                // Make AJAX call to validate account number
                $.ajax({
                    url: '{{ route('business.validateAccount') }}',
                    type: 'POST',
                    data: {
                        accountnumber: accountnumber,
                        bank: bank,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Update account name field with the returned value
                        $('#accountname2').val(response.account_name);
                        // Show the account name text field
                        $('#accountnamediv2').show();
                        // Enable the submit button
                        $('#submitbutton2').prop('disabled', false);
                        $('#validationprogress2').hide();

                    },
                    error: function(xhr, status, error) {
                        $('#validationprogress2').hide();
                        $('#validationerror2').show();
                        // Handle errors if needed
                    }
                });
            }
        });
    });
</script>
@endsection
