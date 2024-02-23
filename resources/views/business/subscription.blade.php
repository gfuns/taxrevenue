@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Billing & Payments')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Billing & Payments</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Billing & Payments
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <div class="d-lg-flex justify-content-between align-items-center card-header">
                    @if (isset($activeSubscription))
                        <div class="mb-3 mb-lg-0">
                            <h3 class="mb-0">Current Plan</h3>
                            <span>Below is your current active plan information.</span>
                        </div>
                        <div>
                            <a href="{{ route('business.subscribe') }}" class="btn btn-outline-primary btn-sm">Switch
                                Subscription Plan</a>
                        </div>
                    @else
                        <div class="mb-3 mb-lg-0">
                            <h3 class="mb-0">You do not have an Active Plan</h3>
                            <span>Please select a subscription plan of your choice.</span>
                        </div>
                        <div>
                            <a href="{{ route('business.subscribe') }}" class="btn btn-outline-primary btn-sm">Select
                                Plan</a>
                        </div>
                    @endif
                </div>
                @if (isset($activeSubscription))
                    <!-- Card body -->
                    <div class="card-body">
                        <h3 class="fw-bold mb-0">
                            &#8358;{{ number_format($activeSubscription->subscription_amount, 2) }}/{{ $activeSubscription->plan->plan }}
                        </h3>
                        <p class="mb-0">
                            Your next monthly charge of
                            <span
                                class="text-success">&#8358;{{ number_format($activeSubscription->subscription_amount, 2) }}</span>
                            will be applied to your primary payment method on
                            <span
                                class="text-success">{{ date_format(new DateTime($activeSubscription->next_due_date), 'jS F, Y') }}</span>
                        </p>
                    </div>
                @endif
            </div>
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Payment Methods</h3>
                    <span>Primary payment method is used by default</span>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush">
                        <!-- List group item -->
                        @foreach ($customerCards as $card)
                            <li class="list-group-item px-0 pb-3 pt-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/images/creditcard/' . preg_replace('/ /', '', $card->card_brand) . '.svg') }}"
                                            alt="card" class="me-3">
                                        <div>
                                            <h5 class="mb-0">{{ ucwords($card->card_brand) }} ending with
                                                {{ $card->last_four_digits }}</h5>
                                            <p class="mb-0 fs-6">Expires on
                                                {{ $card->expiry_month }}/{{ $card->expiry_year }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if ($card->default_card == 1)
                                            <span class="badge bg-success me-4">Primary</span>
                                        @endif
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#"
                                                role="button" id="paymentDropdown" data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="paymentDropdown"
                                                style="">
                                                <span class="dropdown-header">Setting</span>
                                                @if ($card->default_card == 0)
                                                    <a class="dropdown-item"
                                                        href="{{ route('business.defaultCard', [$card->id]) }}">
                                                        <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                        Make it Primary
                                                    </a>
                                                @endif
                                                <a class="dropdown-item"
                                                    href="{{ route('business.deleteCard', [$card->id]) }}"
                                                    onclick="return confirm('Are you sure you want to delete this card?')">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove Card
                                                </a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <!-- button-->
                    <a href="#" class="btn btn-outline-primary mt-4" data-bs-toggle="modal"
                        data-bs-target="#paymentModal">Add Payment Method</a>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-12 mb-4 mb-xl-0">
            <!-- card  -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-0">
                        <h4 class="mb-0">Subscription History</h4>
                        <span>Below is a history of all your subscription transactions.</span>
                        <hr />
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox">
                            <!-- Table Head -->
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Transaction ID</th>
                                    <th>Service</th>
                                    <th>Provider</th>
                                    <th>Details</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

  <!-- Payment Modal -->
  <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center d-flex">
                <h4 class="modal-title" id="paymentModalLabel">Add New Payment Method</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div>
                    <!-- Form -->
                    <form class="row mb-4 needs-validation" novalidate>
                        <div class="mb-3 col-12 col-md-12 mb-4">
                            <h5 class="mb-3">Credit / Debit card</h5>
                            <!-- Radio button -->
                            <div class="d-inline-flex">
                                <div class="form-check me-2">
                                    <input type="radio" id="paymentRadioOne" name="paymentRadioOne" class="form-check-input" required />
                                    <label class="form-check-label" for="paymentRadioOne"><img src="../assets/images/creditcard/americanexpress.svg" alt="card" /></label>
                                </div>
                                <!-- Radio button -->
                                <div class="form-check me-2">
                                    <input type="radio" id="paymentRadioTwo" name="paymentRadioOne" class="form-check-input" required />
                                    <label class="form-check-label" for="paymentRadioTwo"><img src="../assets/images/creditcard/mastercard.svg" alt="card" /></label>
                                </div>

                                <!-- Radio button -->
                                <div class="form-check">
                                    <input type="radio" id="paymentRadioFour" name="paymentRadioOne" class="form-check-input" required />
                                    <label class="form-check-label" for="paymentRadioFour"><img src="../assets/images/creditcard/visa.svg" alt="card" /></label>
                                </div>
                            </div>
                        </div>
                        <!-- Name on card -->
                        <div class="mb-3 col-12 col-md-4">
                            <label for="nameoncard" class="form-label">Name on card</label>
                            <input id="nameoncard" type="text" class="form-control" name="nameoncard" placeholder="Name" required />
                            <div class="invalid-feedback">Please enter name of card.</div>
                        </div>
                        <!-- Month -->
                        <div class="mb-3 col-12 col-md-4">
                            <label class="form-label" for="month">Month</label>
                            <select class="form-select" id="month" required>
                                <option value="">Month</option>
                                <option value="Jan">Jan</option>
                                <option value="Feb">Feb</option>
                                <option value="Mar">Mar</option>
                                <option value="Apr">Apr</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="Aug">Aug</option>
                                <option value="Sep">Sep</option>
                                <option value="Oct">Oct</option>
                                <option value="Nov">Nov</option>
                                <option value="Dec">Dec</option>
                            </select>
                            <div class="invalid-feedback">Please enter month.</div>
                        </div>
                        <!-- Year -->
                        <div class="mb-3 col-12 col-md-4">
                            <label class="form-label" for="year">Year</label>
                            <select class="form-select" id="year" required>
                                <option value="">Year</option>
                                <option value="June">2018</option>
                                <option value="July">2019</option>
                                <option value="August">2020</option>
                                <option value="Sep">2021</option>
                                <option value="Oct">2022</option>
                            </select>
                            <div class="invalid-feedback">Please enter year.</div>
                        </div>
                        <!-- Card number -->
                        <div class="mb-3 col-md-8 col-12">
                            <label class="form-label" for="card-mask">Card Number</label>
                            <input class="form-control" id="card-mask" type="text" value="" required />
                            <div class="invalid-feedback">Please enter card number.</div>
                        </div>
                        <!-- CVV -->
                        <div class="mb-3 col-md-4 col-12">
                            <div class="mb-3">
                                <label class="form-label" for="digit-mask">
                                    CVV Code
                                    <i class="fe fe-help-circle ms-1" data-bs-toggle="tooltip" data-placement="top" title="A 3 - digit number, typically printed on the back of a card."></i>
                                </label>
                                <input class="form-control" id="digit-mask" type="text" value="" required />
                                <div class="invalid-feedback">Please enter cvv code.</div>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="col-md-6 col-12">
                            <button class="btn btn-primary" type="submit">Add New Card</button>
                            <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                    <span>
                        <strong>Note:</strong>
                        that you can later remove your card at the account setting page.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("subscription").classList.add('active');
</script>

@endsection

@section('customjs')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('.subscriptionAutoRenew').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var param = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/business/set-auto-renewal",
                data: {
                    'status': status,
                    'param': param
                },
                success: function(data) {
                    if (data.status === 200) {
                        Swal.fire({
                            text: 'Autorenewal Status Updated Successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            toast: true,
                            width: 450,
                            timer: 4000,
                            position: 'top-right'
                        })
                    } else {
                        Swal.fire({
                            text: 'Autorenewal Status Update Failed.',
                            icon: 'error',
                            showConfirmButton: false,
                            toast: true,
                            width: 450,
                            timer: 4000,
                            position: 'top-right'
                        })
                    }
                }
            });
        })
    })
</script>
@endsection
