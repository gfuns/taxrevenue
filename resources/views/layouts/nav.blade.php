<header class="header sticky-bar ">
    <div class="container">
        <div class="main-header">
            <div class="header-left">
                <div class="header-logo"><a class="d-flex" href="/"><img alt="{{ env('APP_NAME') }} Logo"
                            src={{ asset('storage/general/logo.png') }}></a></div>
            </div>
            <div class="header-nav">
                <nav class="nav-main-menu">
                    <ul class="main-menu">
                        <li><a id="home" href="/"> Home </a></li>
                        <li><a id="findjobs" href="/find-jobs" class=" "> Find Jobs </a></li>
                        <li><a id="businesses" href="/businesses" class=" "> Businesses </a></li>
                        <li><a id="artisans" href="/artisans" class=" "> Artisans </a></li>
                        <li class="has-children "><a id="resources" href="#" class=" "> Resources <div class="arrow-down"></div>
                            </a>
                            <ul class="sub-menu">

                                <li class=" ">
                                    <a href="/resources/blog"><i class="fas fa-globe" style="color: #690068"></i> Blog </a>
                                </li>
                                <li class=" ">
                                    <a href="/mini-store"><i class="fas fa-store" style="color: #690068"></i> Mini Store </a>
                                </li>
                                <li class=" ">
                                    <a href="/resources/tutorial-videos"><i class="far fa-play-circle" style="color: #690068"></i> Tutorial
                                        Videos </a>
                                </li>
                            </ul>
                        </li>
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
                            <li class=" "><a href="/find-jobs"> Find Jobs </a></li>
                            <li class=" "><a href="/businesses"> Businesses </a></li>
                            <li class=" "><a href="/artisans"> Artisans </a></li>

                            <li class=" has-children "><a href="#"> Resources <div class="arrow-down"></div>
                                </a>
                                <ul class="sub-menu">
                                    <li class=" ">
                                        <a href="/resources/blog"><i class="fi fi-rr-home"></i> Blog </a>
                                    </li>
                                    <li class=" ">
                                        <a href="/mini-store"><i class="fi fi-rr-home"></i> Mini Store </a>
                                    </li>
                                    <li class=" ">
                                        <a href="/resources/tutorial-videos"><i class="fi fi-rr-home"></i> Tutorial
                                            Videos </a>
                                    </li>
                                </ul>
                            </li>

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
