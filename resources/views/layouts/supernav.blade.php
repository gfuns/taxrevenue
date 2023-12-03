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
                <a class="nav-link " id="dashboard" href="/admin">
                    <i class="nav-icon fe fe-home me-2"></i> Dashboard
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading" style="color: #94a3b8">Courses</div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " id="coursecat" href="/admin/course-categories">
                    <i class="nav-icon fe fe-filter me-2"></i> Course Categories
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="courselist" href="/admin/course-list">
                    <i class="nav-icon fe fe-book-open me-2"></i> Course List
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="paths" href="/admin/learning-paths">
                    <i class="nav-icon fe fe-compass me-2"></i> Learning Paths
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading" style="color: #94a3b8">Users</div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link " id="admin" href="/admin/administrators">
                    <i class="nav-icon fe fe-user-check me-2"></i> Administrators
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="instructors" href="/admin/instructors">
                    <i class="nav-icon fe fe-user-plus me-2"></i> Instructors
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="students" href="/admin/students">
                    <i class="nav-icon fe fe-users me-2"></i> Students
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading" style="color: #94a3b8">Reports</div>
            </li>
            <li class="nav-item">
                <a class="nav-link  collapsed " id="adminReports" href="#" data-bs-toggle="collapse" data-bs-target="#navReports" aria-expanded="false" aria-controls="navReports">
                    <i class="nav-icon fe fe-bar-chart-2 me-2"></i> Administrative Reports
                </a>
                <div id="navReports" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " id="courseenrol" href="{{ route('admin.getCourseEnrolment') }}">
                                Course Enrolment Report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="coursecomplete" href="{{ route('admin.getCourseCompletion') }}">
                                Course Completion Report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="courseperform" href="{{ route('admin.getCoursePerformance') }}">
                                Course Performance Report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="coursesatis"  href="{{ route('admin.courseSatisfactionReport') }}">
                                Learners Satisfaction Report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="instructorperform" href="{{ route('admin.instrurctorPerformanceReport') }}">
                                Facilitator Approval Report
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <div class="nav-divider"></div>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading" style="color: #94a3b8">Settings</div>
            </li>
            <li class="nav-item">
                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navPlatformSetting" aria-expanded="false" aria-controls="navPlatformSetting">
                    <i class="nav-icon fe fe-settings me-2"></i> Platform Settings
                </a>
                <div id="navPlatformSetting" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a id="roles" class="nav-link " href="{{ route('admin.rolesAndPermissions') }}">
                                Roles & Permissions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="payment" class="nav-link " href="{{ route('admin.paymentGateways') }}">
                                Payment Processors
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
