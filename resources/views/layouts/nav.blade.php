<header class="header sticky-bar ">
    <div class="container">
        <div class="main-header">
            <div class="header-left">
                <div class="header-logo"><a class="d-flex" href="/"><img alt="{{ env('APP_NAME') }} Logo"
                            src="{{ asset('files/general/logo.png') }}"></a></div>
            </div>
            <div class="header-nav">
                <nav class="nav-main-menu">
                    <ul class="main-menu">
                        <li><a id="home" href="/"> Home </a></li>
                        <li><a id="businesses" href="/business-listing" class=" "> Business Directory </a></li>
                        <li><a id="jobportal" href="/job-portal" class=" "> Job Portal </a></li>
                        <li><a id="academy" href="/academy" class=" "> Academy </a></li>
                        <li><a id="blog" href="/blog" class=" "> Blog </a></li>
                        <li><a id="forum" href="/forum" class=" "> Forum </a></li>
                        <li><a id="shop" href="/shop-now" class=" "> Shop Now </a></li>
                    </ul>
                </nav>
                <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span
                        class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
            </div>
            <div class="header-right">
                <div class="block-signin">

                    <a class="btn btn-white btn-shadow hover-up" href="/register">Register</a>
                    <a class="btn btn-primary btn-shadow hover-up" href="/login">Sign In</a>
                </div>

            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-content-area">
            <div class="perfect-scroll">

                <div class="mobile-menu-wrap mobile-header-border">
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class=" "><a href="/"> Home </a></li>
                            <li class=" "><a href="/business-listing"> Business Directory </a></li>
                            <li class=" "><a href="/job-portal"> Job Portal </a></li>
                            <li class=" "><a href="/academy"> Academy </a></li>
                            <li class=" "><a href="/blog"> Blog </a></li>
                            <li class=" "><a href="/forum"> Forum </a></li>
                            <li class=" "><a href="/shop-now"> Shop Now </a></li>

                        </ul>
                    </nav>
                </div>
                <div class="mobile-account">
                    <ul class="mobile-menu font-heading">
                        <li><a href="/login">Sign In</a></li>
                        <li><a href="/register">Sign Up</a></li>
                    </ul>
                </div>
                <div class="site-copyright">© {{ date('Y') }} {{ env('APP_NAME') }}. All right reserved.</div>
            </div>
        </div>
    </div>
</div>
