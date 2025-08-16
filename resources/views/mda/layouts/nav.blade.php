<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{ route('mda.dashboard') }}">
            <h3 class="fw-bold"><img src="{{ asset('images/logo_green.png') }}"
                    style="min-width: 185px; height: 60px; filter: brightness(0) invert(1);" alt="BPP Logo">
            </h3>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link " id="dashboard" href="{{ route('mda.dashboard') }}">
                    <i class="nav-icon fe fe-home me-2"></i>
                    Dashboard
                </a>
            </li>

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 1) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="generateBill" href="{{ route("mda.generateBill") }}">
                        <i class="nav-icon bi bi-person-bounding-box me-2"></i>
                        Generate Tax Payer Bill
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 14) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="payments" href="{{ route("mda.paymentHistory") }}">
                        <i class="nav-icon bi-clipboard2-data-fill me-2"></i>
                        Payment History
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 1) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="revenueItems" href="{{ route('mda.revenueItems') }}">
                        <i class="nav-icon bi bi-person-bounding-box me-2"></i>
                        Revenue Items
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 12) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="reports" href="{{ route('mda.reports') }}">
                        <i class="nav-icon bi-clipboard2-data-fill me-2"></i>
                        Administrative Reports
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navSettings"
                    aria-expanded="false" aria-controls="navSettings">
                    <i class="nav-icon bi bi-gear-wide-connected me-2"></i> Account Settings
                </a>
                <div id="navSettings" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link " id="profile" href="{{ route('mda.viewProfile') }}">
                                Profile Information
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="security" href="{{ route('mda.security') }}">
                                Account Security
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="nav-icon fe fe-log-out me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

        </ul>
        <!-- Card -->

    </div>
</nav>
