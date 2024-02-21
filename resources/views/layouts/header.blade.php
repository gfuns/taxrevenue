<head>
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <meta charset=utf-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name=viewport>
    <style>
        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko70yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko50yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko40yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko20yygg-vb.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko70yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko50yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko40yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko20yygg-vb.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko70yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko50yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko40yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko20yygg-vb.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko70yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko50yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko40yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko20yygg-vb.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 800;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko70yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 800;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko50yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 800;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko40yygg-vbd-e.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Plus Jakarta Sans';
            font-style: normal;
            font-weight: 800;
            font-display: swap;
            src: url(storage/fonts/31a15fd7ae/splusjakartasansv3ldioaomqnqcsa88c7o9yz4kmcoog4ko20yygg-vb.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
    <style>
        :root {
            --primary-color: #3C65F5;
            --primary-color-hover: #b4c0e0;
            --secondary-color: #05264E;
            --border-color-2: #E0E6F7;
            --primary-font: 'Plus Jakarta Sans', sans-serif;
            --primary-color-rgb: 60, 101, 245;
        }
    </style>
    <title>Arete Planet</title>

    <link href="{{ asset('storage/general/favicon.png') }}" rel="shortcut icon">

    <link media="all" type=text/css rel="stylesheet"
        href="{{ asset('vendor/core/plugins/cookie-consent/css/cookie-consentf700.css') }}?v=1.0.1">
    <link media="all" type=text/css rel="stylesheet"
        href="{{ asset('vendor/core/plugins/language/css/language-publicd1f1.css') }}?v=2.2.0">
    <link media="all" type=text/css rel="stylesheet"
        href="{{ asset('vendor/core/core/base/libraries/ckeditor/content-styles.css') }}">
    <link media="all" type=text/css rel="stylesheet"
        href="{{ asset('themes/jobbox/plugins/bootstrap/bootstrap.min.css') }}">
    <link media="all" type=text/css rel="stylesheet" href="{{ asset('themes/jobbox/css/style9d7d.css') }}?v=1.10.0">
    <link media="all" type=text/css rel="stylesheet"
        href="{{ asset('themes/jobbox/plugins/animate.min9d7d.css') }}?v=1.10.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flat-icons@1.0.0/creative.min.css">

    <style>
        .page_speed_515102175 {
            display: none;
        }

        .page_speed_1267805100 {
            height: 16px
        }

        .page_speed_1341285398 {
            background: url(storage/pages/bg-left-hiring.png) no-repeat 0 0
        }

        .page_speed_200008368 {
            background: url(storage/pages/bg-right-hiring.png) no-repeat 0 0
        }

        .page_speed_151203300 {
            style-1
        }

        .page_speed_1823125816 {
            background-image: url(storage/locations/location1.png);
        }

        .page_speed_1686596359 {
            background-image: url(storage/locations/location2.png);
        }

        .page_speed_226706101 {
            background-image: url(storage/locations/location3.png);
        }

        .page_speed_235079432 {
            background-image: url(storage/locations/location4.png);
        }

        .page_speed_1703951091 {
            background-image: url(storage/locations/location5.png);
        }

        .page_speed_836935197 {
            background-image: url(storage/locations/location6.png);
        }

        .page_speed_593016145 {
            background-image: url(storage/general/newsletter-background-image.png)
        }

        .page_speed_287683390 {
            background-color: #000 !important;
            color: #fff !important;
        }

        .page_speed_2125851095 {
            max-width: 1170px;
        }

        .page_speed_1815023329 {
            background-color: #000 !important;
            color: #fff !important;
            border: 1px solid #fff !important;
        }

        .btn-white{
            background-color:#fff;
            color:#690068;
           border:1px solid #690068
        }

        .btn-white:hover{
            background-color:#FEBA00;
            color:#fff;
           border:1px solid #FEBA00
        }

        .main-menu li.active{
            color: #FEBA00;
        }
    </style>

<link href="{{asset('css/iziToast.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset("css/fonts.min.css") }}">
</head>
