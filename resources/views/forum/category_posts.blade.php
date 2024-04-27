@extends('forum.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Category Posts')

<!--==================== Preloader Start ====================-->
<div id="loading" style="display: none;">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <span class="loader-object"></span>
        </div>
    </div>
</div>

<!--==================== Preloader End ====================-->
<section>
    <!-- header -->

    @include('forum.layouts.nav')


    <!-- body -->
    <div class="body-section">
        <div class="container-fluid">
            <div class="row m-0">
                <!-- left side -->
                @include('forum.layouts.left_nav')
                <!-- left side / -->


                <div class="col-xl-6 col-lg-6">
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="forum-card-wraper">

                                @if (Auth::user())
                                    <div class="post-feed dashboard--feed">
                                        <div class="user-info">
                                            <div class="user-thumb">
                                                <img src="{{ isset(Auth::user()->photo) ? Auth::user()->photo : asset('proforum/images/avatar.png') }}"
                                                    alt="avatar">
                                            </div>
                                            <input type="text" class="form-control form--control feed-input"
                                                placeholder="Start a Discussion" onclick="feedInput()">
                                        </div>
                                    </div>
                                @endif

                                @foreach ($posts as $post)
                                    <div class="forum-card">

                                        <div class="vote-item vote-qty">
                                            <div class="vote-item-wraper">
                                                <button class="vote-qty__increment post_vote "
                                                    data-post-id="{{ $post->id }}" data-post-vote="1">
                                                    <i class="fa-circle-up  fa-regular "></i>
                                                </button>

                                                <div class="vote-value-container total_post_vote{{ $post->id }}"
                                                    data-post-id="{{ $post->id }}">
                                                    <h6 class="vote-qty__value">
                                                        {{ $post->likes }}
                                                    </h6>
                                                </div>
                                                <button class="vote-qty__decrement post_vote "
                                                    data-post-id="{{ $post->id }}" data-post-vote="0">
                                                    <i class="fa-circle-down  fa-regular "></i>
                                                </button>
                                            </div>
                                        </div>

                                        @php
                                            $category = null;
                                            if (isset($post->forum_category_id)) {
                                                if ($post->category->category == 'Events') {
                                                    $category = 'event';
                                                } elseif ($post->category->category == 'Jobs') {
                                                    $category = 'job';
                                                }
                                            }
                                        @endphp

                                        <div class="card--body {{ $category }} ">
                                            <div class="card-auth-meta">
                                                <div class="auth-info">
                                                    <a href="/forum/user/{{ $post->customer_id }}">
                                                        <div class="user-thumb">
                                                            <img src="{{ isset($post->customer->photo) ? $post->customer->photo : asset('proforum/images/avatar.png') }}"
                                                                alt="avatar">
                                                        </div>
                                                        <p class="post-by">Posted by
                                                            <span>{{ $post->customer->first_name . ' ' . $post->customer->last_name }}</span>
                                                        </p>
                                                    </a>
                                                    <i class="fa-solid fa-circle"></i>
                                                    <p title="25 Oct, 2023 10:42 PM" class="time-status">
                                                        {{ $post->created_at->diffForHumans() }}
                                                    </p>


                                                </div>
                                                <div class="actn-dropdown-box">
                                                    @if (isset($post->forum_category_id))
                                                        <span
                                                            class="badge-{{ $category }}">{{ $post->category->category }}</span>
                                                    @endif
                                                    <button class="actn-dropdown-btn">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="actn-dropdown option">
                                                        <ul>
                                                            <li>
                                                                <button class="report_button report_post_button"
                                                                    data-post-id="{{ $post->id }}">
                                                                    <i class="fa-regular fa-flag"></i>
                                                                    <span>Report</span>
                                                                </button>
                                                            </li>
                                                            @if (Auth::user() && Auth::user()->id == $post->customer_id)
                                                                <li>
                                                                    <a class="edit_button"
                                                                        href="{{ route('forum.userPostEdit', [$post->id]) }}">
                                                                        <i class="fa-solid fa-pencil"></i>
                                                                        <span>Edit</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <a href="/forum/details/{{ $post->id }}/{{ $post->slug }}">
                                                    <h6 class="card-title ">{{ $post->post_title }} </h6>
                                                </a>

                                                <p class="card-sub-title wyg">
                                                    {{ strip_tags($post->truncateText($post->post_body, 30)) }}
                                                    @if (str_word_count($post->post_body) < 30)
                                                        ...
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="forum-cad-footer">
                                                <ul class="footer-item-list">
                                                    <li>
                                                        <a
                                                            href="/forum/details/{{ $post->id }}/{{ $post->slug }}"><i
                                                                class="las la-comments"></i>
                                                            <p>{{ $post->comments->count() }}
                                                                Comments </p>
                                                        </a>
                                                    </li>
                                                    <li><a
                                                            href="/forum/details/{{ $post->id }}/{{ $post->slug }}"><i
                                                                class="las la-eye"></i>
                                                            <p>{{ $post->views }} Views</p>
                                                        </a></li>
                                                    <li>
                                                        <!--  -->
                                                        <div class="actn-dropdown-box">
                                                            <button class="actn-dropdown-btn">
                                                                <i class="las la-share"></i>
                                                                <span> Share</span>
                                                            </button>
                                                            <div class="actn-dropdown">
                                                                @php

                                                                    $postURL =
                                                                        env('APP_URL') .
                                                                        '/forum/details/' .
                                                                        $post->id .
                                                                        '/' .
                                                                        $post->slug;
                                                                    $postTitle = preg_replace(
                                                                        '/ /',
                                                                        '-',
                                                                        $post->post_title,
                                                                    );
                                                                @endphp

                                                                <ul>
                                                                    <li>
                                                                        <a target="_blank" class="share_button"
                                                                            href="https://www.facebook.com/share.php?u={{ $postURL }}&title={{ $postTitle }}">
                                                                            <i class="fa-brands fa-facebook-f"></i>
                                                                            <span class="ms-3">Facebook</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a target="_blank" class="share_button"
                                                                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ $postURL }}&title={{ $postTitle }}&source=AretePlanet">
                                                                            <i class="fa-brands fa-linkedin-in"></i>
                                                                            <span class="ms-3">Linkedin</span>
                                                                        </a>

                                                                    </li>
                                                                    <li class="report_button">
                                                                        <a target="_blank" class="share_button"
                                                                            href="https://twitter.com/intent/tweet?status={{ $postTitle }}+{{ $postURL }}">
                                                                            <i class="fa-brands fa-twitter"></i>
                                                                            <span class="ms-3">Twitter</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                    </li>
                                                </ul>
                                                <div class="d-flex">
                                                    <button class="me-3 report_button report_post_button"
                                                        data-post-id="{{ $post->id }}"><i
                                                            class="fa-regular fa-flag"></i>
                                                    </button>
                                                    <button
                                                        class="bookmark-button @if (Auth::user() && $post->isBookmarked() == 1) active-bookmark @endif"
                                                        data-post-id="{{ $post->id }}" type="button">
                                                        <i
                                                            class="fa-regular fa-bookmark @if (Auth::user() && $post->isBookmarked() == 1) fa-solid @endif"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Data Loader -->
                    <div class="auto-load text-center mt-5 mb-4" style="display: none;">
                        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60"
                            viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                            <path fill="#000"
                                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate"
                                    dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite">
                                </animateTransform>
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- right side -->
                @include('forum.layouts.right_nav')
                <!-- right side /-->

            </div>
        </div>
    </div>

    @include('forum.layouts.modals')



</section>

@endsection

@section('customjs')
<script type="text/javascript">
    var icon = "iconfc" + {{ Js::from($id) }};
    var menu = "menufc" + {{ Js::from($id) }};
    document.getElementById(menu).classList.add('active');
    document.getElementById(icon).classList.add('active');
</script>

@endsection
