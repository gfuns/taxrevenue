<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Arete Planet">
    <meta name="keywords" content="">
    <meta name="author" content="Gabriel Nwankwo">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Libs CSS -->
    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link href="{{ asset('assets/libs/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/yaireo/tagify/dist/tagify.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/countries.js') }}"></script>

    <title>@yield('title')</title>
    @yield('style')

    <style type="text/css">
        /* Select2 dark mode customization */
        [data-theme="dark"] .select2-container--default .select2-selection--single {
            background-color: var(--geeks-input-bg);
            color: #fff;
            border-color: var(--geeks-input-border);
        }

        [data-theme="dark"] .select2-container--default .select2-dropdown {
            background-color: var(--geeks-input-bg);
            color: #fff;
        }

        [data-theme="dark"] .select2-container--default .select2-results__option {
            background-color: var(--geeks-input-bg);
            color: #fff;
        }

        [data-theme="dark"] .select2-container--default .select2-results__option--highlighted {
            background-color: var(--geeks-input-bg);
            color: #fff;
        }

        [data-theme="dark"] .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: #121212;
            color: #fff;
        }

        [data-theme="dark"] .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff;
            background-color: transparent;
        }

        [data-theme="dark"] .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: var(--geeks-input-bg);
        }

        [data-theme="dark"] .btn-default {
            color: #fff;
        }

        [data-theme="dark"] ::placeholder {
            color: white;
        }

        .datepicker-dropdown {
            padding: 15px;
            /* space inside the dropdown */
            /* border-radius: 8px; */
            /* optional: rounded corners */
        }
    </style>
</head>
