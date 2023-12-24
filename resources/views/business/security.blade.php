@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Account Security')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Account Security </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Account Security
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
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Change Password</h4>
                    </div>
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <!-- form -->
                        <form method="post" action="{{ route('business.updatePassword') }}">
                            @csrf
                            <div class="row">
                                <!-- form group -->
                                <div class="mb-3 col-12">
                                    <label class="form-label">Current Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        placeholder="Enter Current Password" required>
                                    @error('current_password')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">New Password <span class="text-danger">*</span></label>
                                    <input type="password" name="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        placeholder="Enter New Password" required>
                                    @error('new_password')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label">Confirm New Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="new_password_confirmation"
                                        class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                        placeholder="Confirm New Password" required>
                                    @error('new_password_confirmation')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-8"></div>
                                <!-- button -->
                                <div class="col-12">
                                    <button class="btn btn-primary" type="button"
                                        onClick="this.disabled=true; this.innerHTML='Submiting request, please wait...';this.form.submit();">Change
                                        Password</button>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="offset-xl-2 col-xl-8 col-md-12 col-12">
                <!-- card -->
                <div class="card mb-6">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Two Factor Authentication</h4>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <div class="mb-5">
                            <h4 class="mb-0">Receive 2FA Code Via Email</h4>
                            <!-- List group -->
                            <ul class="list-group list-group-flush">
                                <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div>Receive an authentication code via your registered email address for every new
                                        sign-in attempt.</div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input data-id="email_auth2fa" type="checkbox"
                                                class="form-check-input emailAuth2FA" id="email2fa" @if (Auth::user()->auth_2fa == 'Email') checked @endif>
                                            <label class="form-check-label" for="email2fa"></label>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>
                        <div class="mb-5">
                            <h4 class="mb-0">Google Authenticator</h4>
                            <!-- List group -->
                            <ul class="list-group list-group-flush">
                                <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div class="row">
                                        <div>Get your authenticatetion code via the Google Authenticator app for every
                                            new sign-in attempt.</div>
                                        @if (!isset(Auth::user()->google2fa_secret))
                                            <div class="mt-2">
                                                <button class="btn btn-primary btn-sm">Setup Google
                                                    Authenticator</button>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input data-id="google_auth2fa" type="checkbox"
                                                class="form-check-input googleAuth2FA" id="google2fa"
                                                @if (Auth::user()->auth_2fa == 'GoogleAuth') checked @endif type="checkbox">
                                            <label class="form-check-label" for="google2fa"></label>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>
            </div>

            <div class="offset-xl-2 col-xl-8 col-md-12 col-12">
                <!-- card -->
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Withdrawal Confirmation</h4>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <div class="mb-5">
                            <h4 class="mb-0">Receive Confirmation Code Via Email</h4>
                            <!-- List group -->
                            <ul class="list-group list-group-flush">
                                <!-- List group item -->
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div>Receive a confirmation code via your registered email address for every
                                        withdrawal request initiated.</div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input data-id="email_withdrawal" type="checkbox"
                                                class="form-check-input emailWithdrawal" id="emailwithdrawal">
                                            <label class="form-check-label" for="emailwithdrawal"></label>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>
                        <div class="mb-5">
                            <h4 class="mb-0">Google Authenticator</h4>
                            <!-- List group -->
                            <ul class="list-group list-group-flush">
                                <!-- List group item -->
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 py-2">
                                    <div class="row">
                                        <div>Get your confirmation code via the Google Authenticator app for every
                                            withdrawal request initiated.</div>
                                        @if (!isset(Auth::user()->google2fa_secret))
                                            <div class="mt-2">
                                                <button class="btn btn-primary btn-sm">Setup Google
                                                    Authenticator</button>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input data-id="google_withdrawal" type="checkbox"
                                                class="form-check-input googleAuthWithdrawal" id="googleAuthW">
                                            <label class="form-check-label" for="googleAuthW"></label>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("security").classList.add('active');
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
        $('.googleAuth2FA').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var param = $(this).data('id');

            const targetSwitchIds = ['email2fa'];
            // Toggle the state of the target switches
            targetSwitchIds.forEach(function(targetId) {
                const targetSwitch = $('#' + targetId);
                targetSwitch.prop('checked', false);
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('business.select2FA') }}",
                data: {
                    'status': status,
                    'param': param
                },
                success: function(data) {
                    if (data.status === "success") {
                        Swal.fire({
                            text: 'Authentication 2FA Method Updated Successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            toast: true,
                            width: 450,
                            timer: 4000,
                            position: 'top-right'
                        })
                    } else {
                        Swal.fire({
                            text: 'Please Setup Google Authenticator to be able to enable this option.',
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


    $(function() {
        $('.emailAuth2FA').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var param = $(this).data('id');

            const targetSwitchIds = ['google2fa'];
            // Toggle the state of the target switches
            targetSwitchIds.forEach(function(targetId) {
                const targetSwitch = $('#' + targetId);
                targetSwitch.prop('checked', false);
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('business.select2FA') }}",
                data: {
                    'status': status,
                    'param': param
                },
                success: function(data) {
                    if (data.status === "success") {
                        Swal.fire({
                            text: 'Authentication 2FA Method Updated Successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            toast: true,
                            width: 450,
                            timer: 4000,
                            position: 'top-right'
                        })
                    } else {
                        Swal.fire({
                            text: 'Oops! Something Went Wrong',
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


    $(function() {
        $('.googleAuthWithdrawal').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var param = $(this).data('id');

            const targetSwitchIds = ['emailwithdrawal'];
            // Toggle the state of the target switches
            targetSwitchIds.forEach(function(targetId) {
                const targetSwitch = $('#' + targetId);
                targetSwitch.prop('checked', false);
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('business.selectWithdrawalConfirmation') }}",
                data: {
                    'status': status,
                    'param': param
                },
                success: function(data) {
                    if (data.status === "success") {
                        Swal.fire({
                            text: 'Withdrawal Confirmation Method Updated Successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            toast: true,
                            width: 450,
                            timer: 4000,
                            position: 'top-right'
                        })
                    } else {
                        Swal.fire({
                            text: 'Please Setup Google Authenticator to be able to enable this option.',
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


    $(function() {
        $('.emailWithdrawal').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var param = $(this).data('id');

            const targetSwitchIds = ['googleAuthW'];
            // Toggle the state of the target switches
            targetSwitchIds.forEach(function(targetId) {
                const targetSwitch = $('#' + targetId);
                targetSwitch.prop('checked', false);
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('business.selectWithdrawalConfirmation') }}",
                data: {
                    'status': status,
                    'param': param
                },
                success: function(data) {
                    if (data.status === "success") {
                        Swal.fire({
                            text: 'Withdrawal Confirmation Method Updated Successfully.',
                            icon: 'success',
                            showConfirmButton: false,
                            toast: true,
                            width: 450,
                            timer: 4000,
                            position: 'top-right'
                        })
                    } else {
                        Swal.fire({
                            text: 'Oops! Something Went Wrong',
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
