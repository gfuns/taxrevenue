<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <title>Sign-In | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('auth/assets/css/vendor.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/assets/css/style.css') }}">

    <style type="text/css">
        .password-toggle {
            position: relative;
        }

        .password-toggle input[type="password"] {
            padding-right: 30px;
        }

        .password-toggle .toggle-password {
            position: absolute;
            top: 35%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .positionTop {
            padding-bottom: 700px;
        }

        .page-ath-gfx {
            background-image: url("{{ asset('auth/images/ath-gfx.png') }}");
            background-size: cover;
            background-position: center;
            position: relative;
            height: 100vh;
            /* or your desired height */
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            /* adjust opacity here */
            z-index: 1;
        }
    </style>

</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap flex-row-reverse">
        <div class="page-ath-content">
            <div class="page-ath-header">
                <a href="/" class="page-ath-logo">
                    <img class="page-ath-logo-imgsss" src="{{ asset('images/logo.png') }}" alt="BPP Logo"
                        style="max-width: 345px">
                </a>
            </div>


            <div class="page-ath-form">
                <h2 class="page-ath-heading">Sign In
                    <small>With Your Account Credentials</small>
                </h2>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Invalid Login Credentials</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('deletionProcessMessage'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Your Account Is Undergoing Deletion Process</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form class="validate validate-modern" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-item">
                        <input type="email" placeholder="Your Email" data-msg-required="Required."
                            class="input-bordered" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="input-item password-toggle">
                        <input id="password" type="password" placeholder="Password" minlength="6"
                            data-msg-required="Required." data-msg-minlength="At least 6 chars." class="input-bordered"
                            name="password" value="" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="input-item text-left">
                            <input class="input-checkbox input-checkbox-md" type="checkbox" name="remember"
                                id="remember-me">
                            <label for="remember-me">Remember Me</label>
                        </div>
                        <div>
                            <a href="/password/reset">Forgot password?</a>
                            <div class="gaps-2x"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </form>

                <div class="gaps-4x"></div>
                <div class="form-note text-center">
                    Don’t have an account? <a href="/register"> <strong>Sign up
                            here</strong></a>
                </div>
            </div>


            <div class="page-ath-footer text-center">
                <div class="copyright-text">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. <br />All Right Reserved.
                </div>
            </div>
        </div>
        <div class="page-ath-gfx">
            <div class="bg-overlay"></div>
            <div class="w-100 d-flex ">
                <div class="col-md-11 col-xl-11">
                    <div class="positionTop">
                        <a href="/"><span
                                style="background-color: white; color: green; padding:10px; border-radius: 20px"><strong><i
                                        class="fas fa-arrow-alt-circle-left"></i> Back
                                    to Website</strong></span></a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('auth/assets/js/jquery.bundle.js') }}"></script>
    <script src="{{ asset('auth/assets/js/script.js') }}"></script>
    @include('sweetalert::alert')
    <script type="text/javascript">
        jQuery(function() {
            var $frv = jQuery('.validate');
            if ($frv.length > 0) {
                $frv.validate({
                    errorClass: "input-bordered-error error"
                });
            }
        });
    </script>


    <script type="text/javascript">
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var icon = document.querySelector(".toggle-password i");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

</body>

</html>
