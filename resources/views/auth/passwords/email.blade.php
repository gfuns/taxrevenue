<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <title>Reset Password | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('auth/assets/css/vendor.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/assets/css/style.css') }}">

    <style type="text/css">
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
            z-index: 2; /* put above overlay */
        }
    </style>
</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap flex-row-reverse">
        <div class="page-ath-content">
            <div class="page-ath-header">
                <a href="/" class="page-ath-logo">
                    <img class="page-ath-logo-img" src="{{ asset('images/logo_green.png') }}" alt="BPP Logo"
                        style="max-width: 345px">
                </a>
            </div>

            <div class="page-ath-form">

                <h2 class="page-ath-heading">Reset Password
                    <span style="font-size: 16px">If you have forgotten your password, no worries. We'll
                        email you instructions to reset your password.</span>
                </h2>
                <form method="POST" action="{{ route('initiatePasswordReset') }}" class="validate validate-modern">
                    @csrf
                    <div class="input-item">
                        <input type="email" placeholder="Your Email Address" name="email"
                            value="{{ old('email') }}" class="input-bordered" required>
                    </div>
                    <div class="">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block w-100">Reset Password</button>
                        </div>
                    </div>

                    <div class="gaps-4x"></div>

                    <div class="form-note text-center"> <a href="/login"> <strong>Return To Login Page</strong></a>
                    </div>
                </form>

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

</body>

</html>
