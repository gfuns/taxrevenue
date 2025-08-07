<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{ route('individual.dashboard') }}">
            <h3 class="fw-bold"><img src="{{ asset('images/logo_green.png') }}"
                    style="min-width: 185px; height: 60px; filter: brightness(0) invert(1);" alt="BPP Logo">
            </h3>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link " id="dashboard" href="{{ route('individual.dashboard') }}">
                    <i class="nav-icon fe fe-home me-2"></i>
                    Dashboard
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="assessments" href="">
                    <i class="nav-icon bi bi-journal-check me-2"></i>
                    Assessments
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="objections" href="">
                    <i class="nav-icon bi bi-journal-x me-2"></i>
                    Objections
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#returns"
                    aria-expanded="false" aria-controls="returns">
                    <i class="nav-icon bi bi-credit-card me-2"></i> Returns
                </a>
                <div id="returns" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link " id="returns" href="">
                                My Filed Returns
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="pit" href="">
                                Emp. Filed Returns
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#taxPayments"
                    aria-expanded="false" aria-controls="taxPayments">
                    <i class="nav-icon bi bi-wallet-fill me-2"></i> Payments
                </a>
                <div id="taxPayments" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link " id="returns" href="">
                                Generate/Pay Bill
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="pit" href="">
                                Payment History
                            </a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="office" href="">
                    <i class="nav-icon bi bi-house-fill me-2"></i>
                    Tax Offices
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="consultants" href="">
                    <i class="nav-icon bi bi-person-bounding-box me-2"></i>
                    Tax Consultants
                </a>
            </li>


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
                            <a class="nav-link " id="profile" href="{{ route('individual.viewProfile') }}">
                                Profile Information
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="security" href="{{ route('individual.security') }}">
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
