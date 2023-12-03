<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta name="keywords" content="">
    <meta name="author" content="Gabriel Nwankwo">


    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Libs CSS -->
    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <title>{{ env('APP_NAME') }} | Login</title>
</head>

<body>
    <!-- Page content -->
    <main>
        <section class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center g-0 min-vh-100">

                <div class="col-lg-5 col-md-8 py-8 py-xl-0">
                    <!-- Card -->
                    <div class="card shadow ">
                        <!-- Card body -->
                        <div class="card-body p-6">
                            <div class="mb-4 row">
                                <div class="col-md-8 col-12">
                                    <a href="/admin"><img src="{{ asset('assets/images/brand/logo/logo.png') }}"
                                            class="mb-4" alt="" style="max-width: 250px"></a>
                                </div>
                                <div class="col-md-8 col-12">
                                    <h3 class="mb-1 fw-bold">Choose a new password</h3>
                                    <span>Type your new password below</span>
                                </div>
                            </div>
                            <!-- Form -->
                            <form class="needs-validation" novalidate method="post"
                                action="{{ route('passwordReset') }}">
                                @csrf

                                <input class="form-control mb-2" id="token" type="hidden" name="token"
                                    value={{ $token }} readonly />

                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="login" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="**************" required>
                                    <div class="invalid-feedback">Please enter your new password.</div>
                                    @error('password')
                                        <span class="" role="alert" style="color:red; font-size: 12px">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <input type="password" id="password" class="form-control"
                                        name="password_confirmation" placeholder="**************" required>
                                    <div class="invalid-feedback">Please re-enter your new password.</div>
                                    @error('password')
                                        <span class="" role="alert" style="color:red; font-size: 12px">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Checkbox -->
                                <div class="d-lg-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberme">
                                        <label class="form-check-label " for="rememberme">Remember me</label>
                                    </div>
                                    <div>
                                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                                    </div>
                                </div>
                                <div>
                                    <!-- Button -->
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary ">Sign in</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
    @include('sweetalert::alert')

</body>

</html>
