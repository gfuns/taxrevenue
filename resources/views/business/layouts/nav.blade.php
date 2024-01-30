<nav class="navbar-vertical navbar navbar-dark">
    <div class="vh-100" data-simplebar>
        <!-- Brand logo -->
        <a class="navbar-brand" href="/admin">
            <h3 class="fw-bold"><img src="{{ asset('images/logo.png') }}" alt="">
            </h3>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link "  id="dashboard" href="">
                    <i class="nav-icon fe fe-home me-2"></i>
                    Dashboard
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="jobs" href="{{ route("business.jobListing") }}">
                    <i class="nav-icon bi bi-briefcase-fill me-2"></i>
                    Job Listing
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="applications" href="{{ route("business.allJobApplications") }}">
                    <i class="nav-icon bi bi-people-fill me-2"></i>
                    Job Applications
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="messages" href="#">
                    <i class="nav-icon fe fe-message-square me-2"></i>
                    Messages
                </a>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="wallet" href="#">
                    <i class="nav-icon bi bi-wallet me-2"></i>
                    Wallet
                </a>
            </li>


            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                    data-bs-target="#navBillPayments" aria-expanded="false" aria-controls="navBillPayments">
                    <i class="nav-icon bi bi-lightbulb-fill me-2"></i> Utilities
                </a>
                <div id="navBillPayments" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link " id="airtime" href="{{ route("business.buyAirtime") }}">
                                Airtime Purchase
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="data" href="{{ route("business.buyData") }}">
                                Data Purchase
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="cable" href="{{ route("business.buyCable") }}">
                                Cable Subscription
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="electricity" href="{{ route("business.buyElectricity") }}">
                                Electricity Purchase
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " id="billTrx" href="{{ route('business.utilityTransactions') }}">
                                Transaction History
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="referrals" href="{{ route("business.referrals") }}">
                    <i class="nav-icon bi bi-diagram-3-fill me-2"></i>
                    Referrals
                </a>
            </li>

             <!-- Nav item -->
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
                            <a class="nav-link " id="profile" href="{{ route("business.viewProfile") }}">
                                Profile
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link " id="changepwd" href="{{ route("business.changePassword") }}">
                                Change Password
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link " id="busDet" href="{{ route('business.businessProfile') }}">
                                Business Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="notification" href="{{ route("business.notificationSettings") }}">
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="security" href="{{ route("business.security") }}">
                                Security
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="subscription" href="{{ route("business.subscription") }}">
                                Subscription
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="deleteAccount" href="{{ route("business.deleteAccount") }}">
                                Delete Account
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <!-- Nav item -->
             <li class="nav-item">
                <div class="nav-divider"></div>
            </li>


            <li class="nav-item">
                <a class="nav-link " id="help" href="#">
                    <i class="nav-icon bi bi-question-octagon-fill me-2"></i>
                    Get Help
                </a>
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
