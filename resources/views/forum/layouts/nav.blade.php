<!--========================== Header section Start ==========================-->
<div class="header-main-area">
    <div class="header" id="header">
        <div class="container-fluid position-relative">
            <div class="row">
                <div class="header-wrapper">
                    <!-- ham menu -->
                    <i class="fa-sharp fa-solid fa-bars-staggered ham__menu" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></i>

                    <!-- logo -->
                    <div class="header-menu-wrapper align-items-center d-flex">
                        <div class="logo-wrapper">
                            <a href="{{ route("mobileView.forum") }}" class="normal-logo" id="normal-logo">
                                <img src="{{ asset('files/general/logo.png') }}" alt="">
                            </a>
                            <a href="{{ route("mobileView.forum") }}" class="dark-logo hidden" id="dark-logo">
                                <img src="{{ asset('files/general/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- / logo -->

                    <!-- Header Menu -->
                    <div class="menu-wrapper">
                        <ul class="main-menu">
                            <li>
                                <div class="header-search-bar">
                                    <form id="header-search">
                                        <div class="header-search-input">
                                            <input type="text" placeholder="" class="header-form--control"
                                                onkeyup="search(this);">
                                        </div>
                                        <button class="header-search-btn">
                                            <span class="icon">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                                <div class="search-result-box d-none">

                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Header Menu /> -->
                    <!-- user actn -->

                        <div class="menu-right-wrapper">

                            <ul>
                                <li class="search-icon">
                                    <a href="#" class="login-registration-list__link">
                                        <span class="icon search-icon">
                                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                        </span>
                                    </a>
                                </li>

                                <!-- < dark option -->
                                <li class="dark-mood-option">
                                    <div class="light-dark-btn-wrap ms-1" id="light-dark-checkbox1">
                                        <i class="las la-moon mon-icon"></i>
                                        <i class="las la-sun sun-icon"></i>
                                    </div>
                                </li>
                                <!-- dark option /> -->

                            </ul>
                        </div>

                    <!-- user actn /> -->
                </div>

            </div>
        </div>
    </div>
</div>
<!--========================== Header section End ==========================-->



<!--========================== Sidebar mobile menu wrap Start ==========================-->
<div class="offcanvas offcanvas-start text-bg-light" tabindex="-1" id="offcanvasExample">
    <div class="offcanvas-header">
        <div class="logo">
            <div class="header-menu-wrapper align-items-center d-flex">
                <div class="logo-wrapper">
                    <a href="{{ route("mobileView.forum") }}" class="normal-logo" id="offcanvas-logo-normal"> <img
                            src="{{ asset('files/general/logo.png') }}" alt=""></a>
                    <a href="{{ route("mobileView.forum") }}" class="dark-logo hidden" id="offcanvas-logo-dark"> <img
                            src="{{ asset('files/general/logo.png') }}" alt=""></a>
                </div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="side-Nav">
            <li>
                <a class="active" href="{{ route("mobileView.forum") }}">
                    Home </a>
            </li>

            <li>
                <a href="{{ route("mobileView.popularPosts") }}">
                    Popular </a>
            </li>

            <li>
                <a href="{{ route("mobileView.bookmarks") }}">
                    Bookmarks </a>
            </li>
            <p class="pt-4 pb-2 gfuns"><strong>Categories</strong></p>
            @foreach ($forumCategories as $fc)
                <li>
                    <a href="/mobile/view/forum/category/{{ $fc->id }}/posts">
                        {{ $fc->category }} </a>
                </li>
            @endforeach

            <p class="pt-4 pb-2 gfuns"><strong>Topics</strong></p>
            @foreach ($topTopics as $ft)
                <li>
                    <a href="/mobile/view/forum/topic/{{ $ft->id }}/posts">
                        {{ $ft->topic }} </a>
                </li>
            @endforeach

            @foreach ($otherTopics as $oft)
                <li>
                    <a href="/mobile/view/forum/topic/{{ $oft->id }}/posts">
                        {{ $oft->topic }} </a>
                </li>
            @endforeach



        </ul>
    </div>
</div>
<!--========================== Sidebar mobile menu wrap End ==========================-->
