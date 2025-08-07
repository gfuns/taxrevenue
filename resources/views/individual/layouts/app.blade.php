<!DOCTYPE html>
<html lang="en">
@include('individual.layouts.header')

<body>
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->

            @include('individual.layouts.nav')

        <!-- Page Content -->
        <main id="page-content">
            <div class="header">
                @include('individual.layouts.topbar')
            </div>
            <!-- Container fluid -->

            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    @include('individual.layouts.footer')

    @yield('customjs')



</body>

</html>
