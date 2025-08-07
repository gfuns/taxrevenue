<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="apps" content="{{ env('APP_NAME') }}">
    <meta name="author" content="{{ env('APP_NAME') }} - No. 1 P2P Platform">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}?version={{ date('his') }}">
    <title>Two-Factor Verification | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('auth/assets/css/vendor.bundle.css') }}?ver={{ date('his') }}">
    <link rel="stylesheet" href="{{ asset('auth/assets/css/style-green.css') }}?ver={{ date('his') }}">
</head>

<body class="page-ath theme-modern page-ath-modern page-ath-alt">

    <div class="page-ath-wrap">
        <div class="page-ath-content">

            <center>
                <div class="page-ath-header"><a href="/" class="page-ath-logo"
                        style="font-weight:bold; font-size: 30px"><img class="page-ath-logo-img"
                            src="{{ asset('images/logo_green.png') }}" alt="BPP Logo"  style="max-width: 200px">
                    </a></div>
            </center>

            <div class="page-ath-form" style="width: 500px">
                <h2 class="page-ath-heading">2FA Authentication</h2>
                <p>Hello <strong>{{ Auth::user()->last_name." ".Auth::user()->other_names }}</strong>,
                    <br>Enter the Two Factor Authentication Code Sent To Your {{Auth::user()->auth_2fa}}.
                </p>
                @if(Session::has('error'))
                <div class="alert alert-danger">Invalid Authentication Code.</div>
                @endif
                <form id="active" action="{{ route('login.validate2fa') }}" method="POST"
                    autocomplete="off" class="validate-modern">
                    @csrf
                    <div class="input-item">
                        <input name="confirmation_code" type="text" required="required" data-msg-required="Required."
                            data-msg-maxlength="Maximum 6 chars." placeholder="Enter your two factor authentication code"
                            class="input-bordered" autofocus="" maxlength="6">
                    </div>
                    <div class="">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block w-100">Authenticate</button>
                        </div>
                    </div>
                </form>
                <div class="gaps-2x"></div>
            </div>

            <div class="page-ath-footer text-center">

                <div class="copyright-text">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. <br/>All Right Reserved.
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('auth/assets/js/jquery.bundle.js') }}?ver={{ date('his') }}"></script>
    <script src="{{ asset('auth/assets/js/script.js') }}?ver={{ date('his') }}"></script>
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
