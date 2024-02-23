@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Withdrawals')


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
                            <li class="breadcrumb-item active" aria-current="page">Withdrawals</li>
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
                                        <button class="btn btn-success">Top Up</button>
                                        <button class="btn btn-danger ms-5">Withdraw</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3 mb-lg-0">
                                <div class="text-center">

                                    <h4 class="mb-1">Your Arete Referral Points Balance</h4>
                                    <h5 class="mb-0 display-5 fw-bold mt-4">
                                        {{ number_format(Auth::user()->wallet->referral_points, 0) }} Points</h5>
                                    <p class="px-4 mt-3"><b>Exchange Rate:</b> <span
                                            style="color:black; font-size: 14px; font-weight:bold">1 Arete Point =
                                            &#8358;1</span></p>
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
                                                <a class="nav-link" href="{{ route('business.myWallet') }}"
                                                    role="tab">Top Up Transactions</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active"
                                                    href="{{ route('business.myWalletWithdrawals') }}"
                                                    role="tab">Withdrawal Transactions</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" href="{{ route('business.myWalletPoints') }}"
                                                    role="tab">Referral Points Transactions</a>
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
                                                <h3 class="h4 mb-3 mt-4">Withdrawal Transactions</h3>
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
                                                            <th>Trx. Amount</th>
                                                            <th>Recipient's Details</th>
                                                            <th>Balance Before</th>
                                                            <th>Balance After</th>
                                                            <th>Transaction Date</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($withdrawals as $trx)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>&#8358;{{ number_format($trx->amount, 2) }}</td>
                                                                <td>
                                                                    {{ $trx->bank }}<br />
                                                                    {{ $trx->account_number }}<br />
                                                                    {{ $trx->account_name }}
                                                                </td>
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
                                    @if (count($withdrawals) < 1)
                                        <div class="col-xl-12 col-12 job-items job-empty">
                                            <div class="text-center mt-4"><i class="bi bi-emoji-frown"
                                                    style="font-size: 48px"></i>
                                                <h3 class="mt-2">No Withdrawal Transaction</h3>
                                                <div class="mt-2 text-muted"> There are no withdrawal
                                                    transactions found with your
                                                    queries. </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Paginator --}}

                                    @if (count($withdrawals) > 0 && $marker != null)
                                        <div class="row g-2 pt-3 me-4">
                                            <div class="col-md-9">Showing {{ $marker['begin'] }} to
                                                {{ $marker['end'] }}
                                                of
                                                {{ number_format($lastRecord) }} Records</div>

                                            <div class="col-md-3">
                                                {{ $withdrawals->appends(request()->input())->links() }}
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

<script type="text/javascript">
    document.getElementById("wallet").classList.add('active');
</script>

@endsection
