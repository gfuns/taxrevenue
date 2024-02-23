<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <title>Reset Password | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('auth/assets/css/vendor.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/assets/css/style.css') }}">

</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap flex-row-reverse">
        <div class="page-ath-content">
            <div class="page-ath-header">
                <a href="/" class="page-ath-logo">
                    <img class="page-ath-logo-img" src="{{ asset('files/general/logo.png') }}"
                        alt="{{ env('APP_NAME') }}">
                </a>
            </div>

            <div class="page-ath-form">

                <h2 class="page-ath-heading">Reset Password
                    <span style="font-size: 14px">If you have forgotten your password, no worries. We'll
                        email you instructions to reset your password.</span>
                </h2>
                <form method="POST" action="{{ route("initiatePasswordReset") }}" class="validate validate-modern">
                    @csrf
                    <div class="input-item">
                        <input type="email" placeholder="Your Email Address" name="email" value="{{ old('email') }}"
                            class="input-bordered" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                        <div>
                            <a href="/login">Return to login</a>
                        </div>
                    </div>
                    <div class="gaps-0-5x"></div>
                </form>

            </div>

            <div class="page-ath-footer">
                <ul class="socials mb-3">
                    <li><a href="#"><em class="fab fa-facebook-f"></em></a></li>
                    <li><a href="#"><em class="fab fa-twitter"></em></a></li>
                    <li><a href="#"><em class="fab fa-linkedin-in"></em></a></li>
                    <li><a href="#"><em class="fab fa-github-alt"></em></a></li>
                    <li><a href="#"><em class="fab fa-youtube"></em></a></li>
                    <li><a href="#"><em class="fab fa-medium-m"></em></a></li>
                    <li><a href="#"><em class="fab fa-telegram-plane"></em></a></li>
                </ul>
                <ul class="footer-links guttar-20px align-items-center">
                    <li><a href="/privacy-policy" target="_blank">Privacy Policy</a></li>
                    <li><a href="/terms-and-conditions" target="_blank">Terms and Condition</a></li>
                    <li>
                        <div class="lang-switch relative"><a href="javascript:void(0)"
                                class="lang-switch-btn toggle-tigger">EN<em class="ti ti-angle-up"></em></a>
                            <div class="toggle-class dropdown-content dropdown-content-up">
                                <ul class="lang-list">
                                    <li><a href="?lang=en">English</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="copyright-text">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All Right Reserved.</div>
            </div>
        </div>
        <div class="page-ath-gfx" style="background-image: url({{ asset('auth/images/ath-gfx.png') }});">
            <div class="w-100 d-flex justify-content-center">
                <div class="col-md-11 col-xl-11">
                    <div style="padding-bottom: 30px">
                        <a href="/"><span
                                style="background-color: white; color: #690068; padding:10px; border-radius: 20px"><strong>Back
                                    to Home</strong></span></a>
                    </div>

                    <div style="margin-top: 450px; margin-bottom: 50px">
                        <span style="color:white; font-size: 72px; font-weight:bolder">Welcome to</span>
                        <span style="color:#FEBA00; font-size: 72px; font-weight:bolder"> &nbsp;Arete</span>

                        <p class="text-white">The No. 1 world class cutting-edge business directory designed for businesses
                            like you to elevate your business experience!</p>
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

</body>

</html>
