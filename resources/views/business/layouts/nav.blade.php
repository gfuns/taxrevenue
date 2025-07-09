<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{ route('business.dashboard') }}">
            <h3 class="fw-bold"><img src="{{ asset('images/logo_mail.png') }}" style="min-width: 185px; height: 50px"
                    alt="BPP Logo">
            </h3>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link " id="dashboard" href="{{ route('business.dashboard') }}">
                    <i class="nav-icon fe fe-home me-2"></i>
                    Dashboard
                </a>
            </li>


            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="wallet" href="{{ route("business.companyRegistration") }}">
                    <i class="nav-icon bi bi-pencil-square me-2"></i>
                    Company Registration
                </a>
            </li>

             <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="wallet" href="{{ route("business.companyRenewals") }}">
                    <i class="nav-icon bi bi-arrow-clockwise me-2"></i>
                    Registration Renewal
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>


            <li class="nav-item">
                <a class="nav-link " id="forum" href="{{ route("business.powerOfAttorney") }}">
                    <i class="nav-icon fa fa-gavel me-2"></i>
                    Power of Attorney
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="referrals" href="{{ route("business.awardLetters") }}">
                    <i class="nav-icon bi bi-award-fill me-2"></i>
                    Award Letter Request
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="referrals" href="{{ route("business.processingFees") }}">
                    <i class="nav-icon bi bi-cash-coin me-2"></i>
                    Processing Fees
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>


            <li class="nav-item">
                <a class="nav-link " id="help" href="#">
                    <i class="nav-icon bi bi-question-octagon-fill me-2"></i>
                    Help Desk
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
                            <a class="nav-link " id="profile" href="{{ route('business.viewProfile') }}">
                                Profile Information
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="security" href="{{ route('business.security') }}">
                                Security
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
