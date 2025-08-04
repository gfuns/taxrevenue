<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <title>Sign-Up | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('auth/assets/css/vendor.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/assets/css/style.css') }}">

    <style type="text/css">
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* prevent body scroll */
        }

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

        .password-toggle .toggle-password-2 {
            position: absolute;
            top: 35%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .auth-wrapper {
            display: flex;
            height: 100vh;
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

        .positionTop {
            position: relative;
            padding-bottom: 700px;
            z-index: 2;
            /* put above overlay */
        }
    </style>

</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap flex-row-reverse">
        <div class="page-ath-content auth-wrapper" style="pading:0px; margin:0px">
            <div style="overflow-y: auto;">
                <div class="page-ath-header">
                    <a href="/" class="page-ath-logo">
                        <img class="page-ath-logo-img" src="{{ asset('images/logo_green.png') }}" alt="BPP Logo"
                            style="max-width: 200px">
                    </a>
                </div>

                <div class="page-ath-form">

                    <h2 class="page-ath-heading">Sign Up
                        <small>Create Your Account</small>
                    </h2>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form class="validate validate-modern" method="POST" action="{{ route('register') }}"
                        id="register">
                        @csrf
                        <div class="input-item">
                            <input type="text" placeholder="Last Name" class="input-bordered" name="last_name"
                                value="{{ old('last_name') }}" minlength="3" data-msg-required="Required."
                                data-msg-minlength="At least 3 chars." required>
                        </div>
                        <div class="input-item">
                            <input type="text" placeholder="Other Names" class="input-bordered" name="other_names"
                                value="{{ old('other_names') }}" minlength="3" data-msg-required="Required."
                                data-msg-minlength="At least 3 chars." required>
                        </div>
                        <div class="input-item">
                            <input type="email" placeholder="Your Email" class="input-bordered" name="email"
                                value="{{ old('email') }}" data-msg-required="Required."
                                data-msg-email="Enter valid email." required>
                        </div>
                        <div class="input-item">
                            <input type="text" placeholder="Your Phone Number" class="input-bordered"
                                name="phone_number" value="{{ old('phone_number') }}" data-msg-required="Required."
                                required>
                        </div>
                        <div class="input-item password-toggle">
                            <input type="password" placeholder="Password" class="input-bordered" name="password"
                                id="password" minlength="6" data-msg-required="Required."
                                data-msg-minlength="At least 6 chars." required>
                            <span class="toggle-password" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        <div class="input-item password-toggle">
                            <input type="password" placeholder="Repeat Password" class="input-bordered"
                                name="password_confirmation" data-rule-equalTo="#password" id="password2" minlength="6"
                                data-msg-required="Required."
                                data-msg-equalTo="Enter the same value with the password above."
                                data-msg-minlength="At least 6 chars." required>
                            <span class="toggle-password-2" onclick="togglePassword2Visibility()">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>

                        <div class="input-item text-left">
                            <input name="terms" class="input-checkbox input-checkbox-md" id="agree"
                                type="checkbox" required="required"
                                data-msg-required="You should accept our terms and policy.">
                            <label for="agree">I agree to the <a target="_blank"
                                    href="/terms-and-conditions">Terms
                                    and
                                    Condition</a>
                                and <a target="_blank" href="/privacy-policy">Privacy
                                    Policy</a>.</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                    </form>


                    <div class="gaps-2x"></div>
                    <div class="form-note text-center">
                        Already have an account ? <a href="/login"> <strong>Sign in
                                instead</strong></a>
                    </div>
                </div>

                <div class="page-ath-footer text-center">

                    <div class="copyright-text">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. <br />All Right
                        Reserved.
                    </div>
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

        function togglePassword2Visibility() {
            var passwordInput = document.getElementById("password2");
            var icon = document.querySelector(".toggle-password-2 i");

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
