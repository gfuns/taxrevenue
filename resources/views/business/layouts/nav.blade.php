<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{ route('business.dashboard') }}">
            <h3 class="fw-bold"><img src="{{ asset('images/logo_mail.png') }}" style="min-width: 185px; height: 50px" alt="BPP Logo">
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

            @if (Auth::user()->profile_updated == 0)
                <!-- Nav item -->
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="businessInfo" href="">
                        <i class="nav-icon fe fe-briefcase me-2"></i>
                        Business Information
                    </a>
                </li>

                <!-- Nav item -->
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="page" href="">
                        <i class="nav-icon fe fe-layout me-2"></i>
                        Business Page Setup
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>



                <li class="nav-item">
                    <a class="nav-link " id="wallet" href="">
                        <i class="nav-icon bi bi-wallet me-2"></i>
                        Renew Registration
                    </a>
                </li>

                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>


                <li class="nav-item">
                    <a class="nav-link " id="forum" href="">
                        <i class="nav-icon bi bi-chat-left-dots me-2"></i>
                        Power of Attorney
                    </a>
                </li>

                <!-- Nav item -->
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="referrals" href="">
                        <i class="nav-icon bi bi-diagram-3-fill me-2"></i>
                        Award Leter
                    </a>
                </li>

                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="referrals" href="">
                        <i class="nav-icon bi bi-diagram-3-fill me-2"></i>
                        Processing Fee Remittance
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
                    <a class="nav-link " id="help" href="#">
                        <i class="nav-icon bi bi-question-octagon-fill me-2"></i>
                        Settings
                    </a>
                </li>
            @endif

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
