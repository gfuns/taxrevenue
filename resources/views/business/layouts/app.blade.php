<!DOCTYPE html>
<html lang="en">
@include('business.layouts.header')

<body>
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->

            @include('business.layouts.nav')

        <!-- Page Content -->
        <main id="page-content">
            <div class="header">
                @include('business.layouts.topbar')
            </div>
            <!-- Container fluid -->

            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    @include('business.layouts.footer')

    @yield('customjs')



</body>

</html>
