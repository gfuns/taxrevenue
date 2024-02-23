@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Payment Methods')


<!-- Container fluid -->
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Payment Methods</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Methods</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row justify-content-center">
        <div class="row mt-0 mt-md-4">
            <div class="col-lg-3 col-md-4 col-12">
                <!-- Side navbar -->
                <nav class="navbar navbar-expand-md shadow-sm mb-4 mb-lg-0 sidenav">
                    <!-- Menu -->
                    <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
                    <!-- Button -->
                    <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fe fe-menu"></span>
                    </button>
                    <!-- Collpase navbar -->
                    <div class="collapse navbar-collapse" id="sidenav">
                        <div class="navbar-nav flex-column">
                            <span class="navbar-header">Subscription</span>
                            <ul class="list-unstyled ms-n2 mb-4">
                                <li class="nav-item">
                                    <a class="nav-link" href="student-subscriptions.html">
                                        <i class="fe fe-calendar nav-icon"></i>
                                        My Subscriptions
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="billing-info.html">
                                        <i class="fe fe-credit-card nav-icon"></i>
                                        Billing Info
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item active">
                                    <a class="nav-link" href="payment-method.html">
                                        <i class="fe fe-credit-card nav-icon"></i>
                                        Payment
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="invoice.html">
                                        <i class="fe fe-clipboard nav-icon"></i>
                                        Invoice
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="student-quiz.html">
                                        <i class="fe fe-help-circle nav-icon"></i>
                                        My Quiz Attempt
                                    </a>
                                </li>
                            </ul>
                            <!-- Navbar header -->
                            <span class="navbar-header">Account Settings</span>
                            <ul class="list-unstyled ms-n2 mb-0">
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="profile-edit.html">
                                        <i class="fe fe-settings nav-icon"></i>
                                        Edit Profile
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="security.html">
                                        <i class="fe fe-user nav-icon"></i>
                                        Security
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="social-profile.html">
                                        <i class="fe fe-refresh-cw nav-icon"></i>
                                        Social Profiles
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="notifications.html">
                                        <i class="fe fe-bell nav-icon"></i>
                                        Notifications
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="profile-privacy.html">
                                        <i class="fe fe-lock nav-icon"></i>
                                        Profile Privacy
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="delete-profile.html">
                                        <i class="fe fe-trash nav-icon"></i>
                                        Delete Profile
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="linked-accounts.html">
                                        <i class="fe fe-user nav-icon"></i>
                                        Linked Accounts
                                    </a>
                                </li>
                                <!-- Nav item -->
                                <li class="nav-item">
                                    <a class="nav-link" href="../index.html">
                                        <i class="fe fe-power nav-icon"></i>
                                        Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <div class="d-lg-flex justify-content-between align-items-center card-header">
                        <div class="mb-3 mb-lg-0">
                            <h3 class="mb-0">Current Plan</h3>
                            <span>Below your current active plan information.</span>
                        </div>
                        <div>
                            <a href="#" class="btn btn-outline-primary btn-sm">Switch to Annual Billing</a>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <h2 class="fw-bold mb-0">$39/Monthly</h2>
                        <p class="mb-0">
                            Your next monthly charge of
                            <span class="text-success">$39</span>
                            will be applied to your primary payment method on
                            <span class="text-success">July 20, 2020.</span>
                        </p>
                    </div>
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
                            <li class="list-group-item px-0 pb-3 pt-0">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <img src="../assets/images/creditcard/visa.svg" alt="card" class="me-3">
                                        <div>
                                            <h5 class="mb-0">Visa ending in 1234</h5>
                                            <p class="mb-0 fs-6">Expires in 10/2021</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success me-4">Primary</span>
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="paymentDropdown" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="paymentDropdown" style="">
                                                <span class="dropdown-header">Setting</span>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Remove
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                    Make it Primary
                                                </a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <!-- List group item -->
                            <li class="list-group-item px-0 py-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <img src="../assets/images/creditcard/mastercard.svg" alt="card" class="me-3">
                                        <div>
                                            <h5 class="mb-0">Mastercard ending in 1234</h5>
                                            <p class="mb-0 fs-6">Expires in 03/2022</p>
                                        </div>
                                    </div>
                                    <span class="dropdown dropstart">
                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="paymentDropdown1" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <span class="dropdown-menu" aria-labelledby="paymentDropdown1">
                                            <span class="dropdown-header">Setting</span>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                Remove
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                Make it Primary
                                            </a>
                                        </span>
                                    </span>
                                </div>
                            </li>
                            <!-- List group item -->
                            <li class="list-group-item px-0 py-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <img src="../assets/images/creditcard/discover.svg" alt="card" class="me-3">
                                        <div>
                                            <h5 class="mb-0">Discover ending in 1234</h5>
                                            <p class="mb-0 fs-6">Expires in 07/2021</p>
                                        </div>
                                    </div>
                                    <span class="dropdown dropstart">
                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="paymentDropdown2" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <span class="dropdown-menu" aria-labelledby="paymentDropdown2">
                                            <span class="dropdown-header">Setting</span>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                Remove
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                Make it Primary
                                            </a>
                                        </span>
                                    </span>
                                </div>
                            </li>
                            <!-- List group item -->
                            <li class="list-group-item px-0 py-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <img src="../assets/images/creditcard/americanexpress.svg" alt="card" class="me-3">
                                        <div>
                                            <h5 class="mb-0">American Express ending in 1234</h5>
                                            <p class="mb-0 fs-6">Expires in 12/2021</p>
                                        </div>
                                    </div>
                                    <span class="dropdown dropstart">
                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="paymentDropdown3" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <span class="dropdown-menu" aria-labelledby="paymentDropdown3">
                                            <span class="dropdown-header">Setting</span>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                Remove
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                Make it Primary
                                            </a>
                                        </span>
                                    </span>
                                </div>
                            </li>
                            <!-- List group item -->
                            <li class="list-group-item px-0 py-3 border-bottom">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <img src="../assets/images/creditcard/paypal.svg" alt="card" class="me-3">
                                        <div>
                                            <h5 class="mb-0">Paypal Express ending in 1234</h5>
                                            <p class="mb-0 fs-6">Expires in 10/2021</p>
                                        </div>
                                    </div>
                                    <span class="dropdown dropstart">
                                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="paymentDropdown4" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                            <i class="fe fe-more-vertical"></i>
                                        </a>
                                        <span class="dropdown-menu" aria-labelledby="paymentDropdown4">
                                            <span class="dropdown-header">Setting</span>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-edit dropdown-item-icon"></i>
                                                Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-trash dropdown-item-icon"></i>
                                                Remove
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fe fe-credit-card dropdown-item-icon"></i>
                                                Make it Primary
                                            </a>
                                        </span>
                                    </span>
                                </div>
                            </li>
                        </ul>
                        <!-- button-->
                        <a href="#" class="btn btn-outline-primary mt-4" data-bs-toggle="modal" data-bs-target="#paymentModal">Add Payment Method</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-11 col-12">

        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("businessInfo").classList.add('active');
</script>

@endsection




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
                    <form method="POST" action="" class="row mb-4 needs-validation" novalidate>
                        @csrf
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
                            <input id="nameoncard" type="text" class="form-control" name="name_on_card" placeholder="Name" required />
                            <div class="invalid-feedback">Please enter name of card.</div>
                        </div>
                        <!-- Month -->
                        <div class="mb-3 col-12 col-md-4">
                            <label class="form-label" for="month">Expiry Month</label>
                            <select class="form-select" id="month" name="expiry_month" required>
                                <option value="">Month</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                            <div class="invalid-feedback">Please select expiry month.</div>
                        </div>
                        <!-- Year -->
                        <div class="mb-3 col-12 col-md-4">
                            <label class="form-label" for="year">Expiry Year</label>
                            <input class="form-control" id="year-mask" type="text" name="expiry_year" value="" required />
                            <div class="invalid-feedback">Please enter expiry year.</div>
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
                        that you can later remove your card at the account setting page for billing & payments.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

