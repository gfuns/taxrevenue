<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

@include('layouts.header')

<body>
    @include('layouts.nav')

    @yield('content')

    @include('layouts.footer')

    @yield('customjs')

</body>

</html>
