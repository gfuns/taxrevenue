@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Notification Settings')


<!-- Content -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">Notification Settings</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Notification Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <!-- Notification -->
                        <h3 class="mb-0">Notifications</h3>
                        <p class="mb-0">You will get only notifications for what you have enabled.</p>
                    </div>
                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="checkAll" checked="">
                            <label class="form-check-label" for="checkAll"></label>
                        </div>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <div class="mb-5">
                        <h4 class="mb-0">Security Alerts</h4>
                        <!-- List group -->
                        <ul class="list-group list-group-flush">
                            <!-- List group item -->
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                <div>Email me whenever an unusual activity is encountered</div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="switchOne" checked="">
                                        <label class="form-check-label" for="switchOne"></label>
                                    </div>
                                </div>
                            </li>
                            <!-- List group item -->
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                <div>Email me if new browser is used to sign in</div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="switchTwo">
                                        <label class="form-check-label" for="switchTwo"></label>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <div class="mb-5">
                        <h4 class="mb-0">News and Updates</h4>
                        <!-- List group-->
                        <ul class="list-group list-group-flush">
                            <!-- List group item -->
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                <div>Notify me by email about sales and latest news</div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="switchThree" checked="">
                                        <label class="form-check-label" for="switchThree"></label>
                                    </div>
                                </div>
                            </li>
                            <!-- List group item -->
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                <div>Email me about new features and updates</div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="switchFour">
                                        <label class="form-check-label" for="switchFour"></label>
                                    </div>
                                </div>
                            </li>
                            <!-- List group item -->
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                <div>Email me about tips on using my account</div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="switchFive" checked="">
                                        <label class="form-check-label" for="switchFive"></label>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <a href="#" class="text-danger mt-5 mb-2 d-block">
                            <a href="{{ route('business.unsubscribeAllNotifications') }}" class="text-danger"; style="text-decoration: none"><button class="btn btn-danger btn-xs mb-3"> Unsubscribe from all of the above</button></a></u>
                        </a>
                        <p class="mb-0">Please note: you'll still receive important administrative and security emails such as password resets, new feature releases etc.</p>
                    </div>
                </div>
            </div>
            <!-- Card -->

        </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("notification").classList.add('active');
</script>
@endsection
