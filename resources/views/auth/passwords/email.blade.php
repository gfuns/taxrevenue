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
    <title>{{ env('APP_NAME') }} | Forgot Password</title>
</head>

<body>
    <main>
        <section class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center g-0 min-vh-100">
                <div class="col-lg-5 col-md-8 py-8 py-xl-0">
                    <!-- Card -->
                    <div class="card shadow">
                        <!-- Card body -->
                        <div class="card-body p-6">
                            <div class="mb-4 row">
                                <div class="col-md-8 col-12">
                                    <a href="/admin"><img src="{{ asset('images/logo.png') }}"
                                            class="mb-4" alt="" style="max-width: 250px"/></a>
                                </div>
                                <div class="col-md-8 col-12">
                                    <h2 class="mb-1 fw-bold">Forgot Password</h2>
                                    <p>Fill the form to reset your password.</p>
                                </div>
                            </div>
                            <!-- Form -->
                            <form class="needs-validation" novalidate method="post"
                                action="{{ route('forgotPassword') }}">
                                @csrf

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" value="{{ old('email') }}" id="email" class="form-control" name="email"
                                        placeholder="Enter Your Account Email " required />
                                    <div class="invalid-feedback">Please provide your account email.</div>
                                    @error('email')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Button -->
                                <div class="mb-3 d-grid">
                                    <button type="submit" class="btn btn-primary"> Send Resest Link </button>
                                </div>
                                <span>Return to <a href="/admin">sign in</a></span>
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
