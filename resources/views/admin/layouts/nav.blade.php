<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <h3 class="fw-bold"><img src="{{ asset('images/logo_green.png') }}"
                    style="min-width: 185px; height: 60px; filter: brightness(0) invert(1);" alt="BPP Logo">
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

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 2) == true)
                <!-- Nav item -->
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="taxpayers" href="{{ route("admin.taxPayers") }}">
                        <i class="nav-icon bi bi-people-fill me-2"></i>
                        Registered Tax Payers
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 3) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                        data-bs-target="#taxPayments" aria-expanded="false" aria-controls="taxPayments">
                        <i class="nav-icon bi bi-credit-card me-2"></i> Tax/Revenue Payments
                    </a>
                    <div id="taxPayments" class="collapse " data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">

                            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 3) == true)
                                <li class="nav-item">
                                    <a class="nav-link " id="returns" href="">
                                        Filed Returns
                                    </a>
                                </li>
                            @endif

                            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 4) == true)
                                <li class="nav-item">
                                    <a class="nav-link " id="pit" href="">
                                        Pers. Income Taxes
                                    </a>
                                </li>
                            @endif

                            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 5) == true)
                                <li class="nav-item">
                                    <a class="nav-link " id="devlevies" href="">
                                        Development Levies
                                    </a>
                                </li>
                            @endif

                            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 13) == true)
                                <li class="nav-item">
                                    <a class="nav-link " id="othertaxes" href="">
                                        Other Taxes/Revenue
                                    </a>
                                </li>
                            @endif

                            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 14) == true)
                                <li class="nav-item">
                                    <a class="nav-link " id="mdataxes" href="">
                                        MDA Taxes/Revenue
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>
            @endif


            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 6) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="awards" href="">
                        <i class="nav-icon bi bi-journal-check me-2"></i>
                        Assessments
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 7) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="awards" href="">
                        <i class="nav-icon bi bi-journal-x me-2"></i>
                        Objections
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 8) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="awards" href="">
                        <i class="nav-icon bi bi-award-fill me-2"></i>
                        TCC Requests
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 9) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="agents" href="{{ route("admin.collectionAgents") }}">
                        <i class="nav-icon bi bi-people me-2"></i>
                        Collection Agents
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 10) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="pos" href="{{ route("admin.posTerminals") }}">
                        <i class="nav-icon bi bi-calculator me-2"></i>
                        POS Terminals
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 11) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="consultants" href="{{ route('admin.taxConsultants') }}">
                        <i class="nav-icon bi bi-person-bounding-box me-2"></i>
                        Tax Consultants
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 12) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="reports" href="">
                        <i class="nav-icon bi-clipboard2-data-fill me-2"></i>
                        Administrative Reports
                    </a>
                </li>
            @endif

            @if (\App\Http\Controllers\MenuController::allowAccess(Auth::user()->role_id, 1) == true)
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                        data-bs-target="#platSettings" aria-expanded="false" aria-controls="platSettings">
                        <i class="nav-icon bi bi-tools me-2"></i> Platform Configurations
                    </a>
                    <div id="platSettings" class="collapse " data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">

                            <li class="nav-item">
                                <a class="nav-link " id="paymentItems" href="{{ route('admin.revenueItems') }}">
                                    Revenue Items
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " id="taxOffice" href="{{ route('admin.areaTaxOffices') }}">
                                    Area Tax Offices
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " id="mdas" href="{{ route('admin.manageMDAs') }}">
                                    MDAs
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " id="features" href="{{ route('admin.platformFeatures') }}">
                                    Platform Features
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
            @endif

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                    data-bs-target="#navSettings" aria-expanded="false" aria-controls="navSettings">
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
