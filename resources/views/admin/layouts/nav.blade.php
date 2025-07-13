<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <h3 class="fw-bold"><img src="{{ asset('images/logo_white.png') }}" style="min-width: 185px; height: 50px"
                    alt="BPP Logo">
            </h3>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link " id="dashboard" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fe fe-home me-2"></i>
                    Dashboard
                </a>
            </li>


            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="companies" href="{{ route('admin.companyRegistrations') }}">
                    <i class="nav-icon bi bi-pencil-square me-2"></i>
                    Company Registrations
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="renewals" href="{{ route('admin.companyRenewals') }}">
                    <i class="nav-icon bi bi-arrow-clockwise me-2"></i>
                    Registration Renewals
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>


            <li class="nav-item">
                <a class="nav-link " id="poa" href="{{ route('admin.powerOfAttorney') }}">
                    <i class="nav-icon fa fa-gavel me-2"></i>
                    Power of Attorneys
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="processingfee" href="{{ route('admin.processingFees') }}">
                    <i class="nav-icon bi bi-cash-coin me-2"></i>
                    Processing Fees
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="awards" href="{{ route('admin.awardLetters') }}">
                    <i class="nav-icon bi bi-award-fill me-2"></i>
                    Award Letter Requests
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#platSettings"
                    aria-expanded="false" aria-controls="platSettings">
                    <i class="nav-icon bi bi-gear-wide-connected me-2"></i> Platform Configurations
                </a>
                <div id="platSettings" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link " id="features" href="{{ route('admin.platformFeatures') }}">
                                Platform Features
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="categories" href="{{ route('admin.businessCategories') }}">
                                Business Categories
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="documents" href="{{ route('admin.documentManagement') }}">
                                Document Mgt.
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="payItems" href="{{ route('admin.paymentItems') }}">
                                Payment Items
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="roles" href="{{ route('admin.userRoles') }}">
                                Roles and Permissions
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="users" href="{{ route('admin.userManagement') }}">
                                User Management
                            </a>
                        </li>

                    </ul>
                </div>
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
                            <a class="nav-link " id="profile" href="{{ route('admin.viewProfile') }}">
                                Profile Information
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="security" href="{{ route('admin.security') }}">
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
