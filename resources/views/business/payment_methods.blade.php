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

