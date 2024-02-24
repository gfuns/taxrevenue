<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="apps" content="{{ env('APP_NAME') }}">
    <meta name="author" content="{{ env('APP_NAME') }} - No. 1 P2P Platform">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}?version={{ date('his') }}">
    <title>Two-Factor Verification | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.css') }}?ver={{ date('his') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-green.css') }}?ver={{ date('his') }}">
</head>

<body class="page-ath theme-modern page-ath-modern page-ath-alt">

    <div class="page-ath-wrap">
        <div class="page-ath-content">

            <center>
                <div class="page-ath-header"><a href="/" class="page-ath-logo"
                        style="font-weight:bold; font-size: 30px"><img class="page-ath-logo-img"
                            src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 50px">
                    </a></div>
            </center>



            <div class="page-ath-form" style="width: 500px">
                <h2 class="page-ath-heading">2FA Authentication</h2>
                <p>Hello <strong>{{ Auth::user()->first_name." ".Auth::user()->last_name }}</strong>,
                    <br>Enter the Authentication Confirmation Code sent to your registered {{Auth::user()->auth_2fa}}.
                </p>
                @if(Session::has('error'))
                <div class="alert alert-warning">Invalid Authentication Confirmation Code.</div>
                @endif
                <form id="active" action="{{ route('login.validate2fa') }}" method="POST"
                    autocomplete="off" class="validate-modern">
                    @csrf
                    <div class="input-item">
                        <input name="confirmation_code" type="text" required="required" data-msg-required="Required."
                            data-msg-maxlength="Maximum 6 chars." placeholder="Enter your authentication confirmation code"
                            class="input-bordered" autofocus="" maxlength="6">
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">Authenticate</button>
                        </div>
                    </div>
                </form>
                <div class="gaps-2x"></div>
            </div>


            @php
                    $social = \App\Models\Social::find(1);
                @endphp
            <div class="page-ath-footer">
                <ul class="socials mb-3">
                    <li><a href="{{ $social->facebook == null ? '#' : $social->facebook }}" title="Facebook"><em
                                class="fab fa-facebook-f"></em></a></li>
                    <li><a href="{{ $social->twitter == null ? '#' : $social->twitter }}" title="Twitter"><em
                                class="fab fa-twitter"></em></a></li>
                    <li><a href="{{ $social->slack == null ? '#' : $social->slack }}" title="Slack"><em class="fab fa-slack"></em></a></li>
                    <li><a href="{{ $social->instagram == null ? '#' : $social->instagram }}" title="Instagram"><em
                                class="fab fa-instagram"></em></a></li>
                    <li><a href="{{ $social->linkedin == null ? '#' : $social->linkedin }}" title="LinkedIn"><em class="fab fa-linkedin"></em></a>
                    </li>
                    <li><a href="{{ $social->medium == null ? '#' : $social->medium }}" title="Medium"><em class="fab fa-medium"></em></a>
                    </li>
                </ul>
                <ul class="footer-links guttar-20px align-items-center">
                    <li><a href="/privacy-policy">Privacy and Policy</a></li>
                    <li><a href="/terms-and-condition">Terms and Condition</a></li>
                </ul>
                <div class="copyright-text">&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All Right Reserved.
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery.bundle.js') }}?ver={{ date('his') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}?ver={{ date('his') }}"></script>
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
