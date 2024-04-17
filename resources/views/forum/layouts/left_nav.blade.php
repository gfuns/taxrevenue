<!-- left side -->
<div class="col-lg-3">
    <aside class="leftside-bar">
        <!-- menu-item-wraper -->
        <div class="menu-item-wraper">
            <div class="nav-menu">
                <div class="navmenu-item-wraper">
                    <a href="/forum" class="menu-item">
                        <i class="fa-solid fa-house active"></i>
                        <h6 class="menu-name active">Home</h6>
                    </a>
                    <a href="/forum/popular-posts" class="menu-item">
                        <i class="fa-solid fa-star"></i>
                        <h6 class="menu-name ">Popular</h6>
                    </a>
                    @foreach ($forumCategories as $fc)
                        <a href="/forum/category/{{ $fc->id }}/posts" class="menu-item">
                            <i class="{{ $fc->icon }}"></i>
                            <h6 class="menu-name ">{{ $fc->category }}</h6>
                        </a>
                    @endforeach

                    <a href="/forum/bookmarks" class="menu-item">
                        <i class="fa-solid fa-bookmark"></i>
                        <h6 class="menu-name ">Bookmarks</h6>
                    </a>

                </div>
            </div>
            <!-- menu-item-wraper / -->
            <!-- latest-topics-menu -->
            <div class="latest-topics-menu">
                <div class="latest-topics-wraper">
                    <h6 class="menu-title">TOPICS</h6>
                    <div class="latest-topics-list">
                        @foreach ($topTopics as $ft)
                            <a href="/forum/topic/{{ $ft->id }}/posts" class="menu-item">
                                <i class="{{ $ft->icon }}"></i>
                                <h6 class="menu-name ">
                                    {{ $ft->topic }}</h6>
                            </a>
                        @endforeach

                        <div class="show-all-menu-wraper">
                            <div class="show-all-menu-item">
                                @foreach ($otherTopics as $oft)
                                    <a href="/forum/topic/{{ $oft->id }}/posts" class="menu-item">
                                        <i class="{{ $oft->icon }}"></i>
                                        <h6 class="menu-name">{{ $oft->topic }}</h6>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="menu-item">
                            <button class="show-all-tgl-btn">See More</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- latest-topics-menu / -->

            <!-- others-menu -->
            {{-- <div class="others-menu">
                <div class="others-item-wraper">
                    <h6 class="menu-title">Others</h6>

                    <div class="others-item-list">

                        <a href="/forum/cookie-policy" class="menu-item">
                            <i class="fas fa-cookie-bite"></i>
                            <h6 class="menu-name ">Cookie </h6>
                        </a>
                    </div>
                    <a href="/forum/policy/terms-of-service" class="menu-item">
                        <i class="fas fa-box"></i>
                        <h6 class="menu-name ">
                            Terms of Service</h6>
                    </a>
                    <a href="/forum/policy/privacy-policy" class="menu-item">
                        <i class="fab fa-fantasy-flight-games"></i>
                        <h6 class="menu-name ">
                            Privacy Policy</h6>
                    </a>
                </div>
            </div> --}}
            <!-- others-menu /-->

            <div class="copy-right-text text-center ps-5 mt-4">
                <p class="bottom-footer-text"> © Copyright {{ date("Y") }} . All Rights Reserved.</p>
            </div>
        </div>
    </aside>
</div>
<!-- left side / -->
