<!DOCTYPE html>
<html lang="en">
@include('mda.layouts.header')

<body>
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->

            @include('mda.layouts.nav')

        <!-- Page Content -->
        <main id="page-content">
            <div class="header">
                @include('mda.layouts.topbar')
            </div>
            <!-- Container fluid -->

            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    @include('mda.layouts.footer')

    @yield('customjs')



</body>

</html>
