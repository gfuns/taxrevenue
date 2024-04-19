@extends('forum.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Forum')

<!--==================== Preloader Start ====================-->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <span class="loader-object"></span>
        </div>
    </div>
</div>

<!--==================== Preloader End ====================-->
<section>
    @include('forum.layouts.nav')


    <!-- body -->
    <div class="body-section">
        <div class="container-fluid">
            <div class="row m-0">
                <!-- left side -->
                @include('forum.layouts.left_nav')
                <!-- left side / -->

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="forum-details-card-wraper">
                                <div class="forum-details-card">
                                    <div class="card--body">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="{{ isset($post->customer->photo) ? $post->customer->photo : asset('proforum/images/avatar.png')}}"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">
                                                        Posted by<span> {{ $post->customer->first_name." ".$post->customer->last_name }}</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">
                                                    {{ $post->created_at->diffForHumans() }}
                                                </p>




                                            </div>
                                            <div class="actn-dropdown-box">
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="me-3 report_button report_post_button"
                                                                data-post-id=139><i class="fa-regular fa-flag"></i>
                                                                <span> Report</span>

                                                            </button>
                                                        </li>
                                                        <li>
                                                            <a class="report_button"
                                                                href="https://preview.wstacks.com/proforum/user/post/edit/139">
                                                                <i class="fa-solid fa-pencil"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card-content">
                                            <h6 class="card-title">{{ $post->post_title }}</h6>

                                            {{-- <div class="gallery-img">
                                                <div class="main-img">
                                                    <a href="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a25585b68c1698309464.jpg"
                                                        class="glightbox" data-glightbox="type: image"><img
                                                            src="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a25585b68c1698309464.jpg"
                                                            alt="image">
                                                    </a>
                                                </div>
                                                <div class="sub-img">
                                                    <a href="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a255885b0d1698309464.jpg"
                                                        class="glightbox" data-glightbox="type: image"><img
                                                            src="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a255885b0d1698309464.jpg"
                                                            alt="image" /></a>

                                                    <a href="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a25588bbf21698309464.jpg"
                                                        class="glightbox more--img more--none"
                                                        data-glightbox="type: image"><img
                                                            src="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a25588bbf21698309464.jpg"
                                                            alt="image" />
                                                    </a>
                                                </div>
                                            </div> --}}



                                            <!-- Click photo to check out the modal -->



                                            <div class="wyg">
                                                @php echo $post->post_body; @endphp
                                            </div>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <div class="footer-item comment-voting vote-qty">
                                                        <button class="vote-qty__increment post_vote "
                                                            data-post-id="{{ $post->id }}" data-post-vote="1">
                                                            <i class="fa-circle-up  fa-regular "></i>
                                                        </button>
                                                        <div class="total_post_vote{{ $post->id }}" data-post-id="{{ $post->id }}">
                                                            <h6 class="vote-qty__value">
                                                                {{ $post->likes }}
                                                            </h6>
                                                        </div>
                                                        <button class="vote-qty__decrement post_vote "
                                                            data-post-id="{{ $post->id }}" data-post-vote="0">
                                                            <i class="fa-circle-down  fa-regular "></i>
                                                        </button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="footer-item">
                                                        <i class="las la-comments"></i>
                                                        <p id="postCommentCount">
                                                            {{ $post->comments->count() }}
                                                            Comments </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="footer-item">
                                                        <i class="las la-eye"></i>
                                                        <p>{{ $post->views }} Views </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn"><i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>

                                                        <div class="actn-dropdown">
                                                            @php

                                                            $postURL = env("APP_URL")."/forum/details/".$post->id."/".$post->slug;
                                                            $postTitle = preg_replace("/ /", "-", $post->post_title);
                                                            @endphp
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="share_button"
                                                                        href="https://www.facebook.com/share.php?u={{ $postURL }}&title={{ $postTitle }}">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span>Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="share_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&url={{ $postURL }}&title={{ $postTitle }}&source=AretePlanet">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span>Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="share_button"
                                                                        href="https://twitter.com/intent/tweet?status={{ $postTitle }}+{{ $postURL }}">
                                                                        <i class="fa-brands fa-twitter"></i>
                                                                        <span>Twitter</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                </li>
                                            </ul>
                                            <button class="me-3 report_post_button report_button" data-post-id={{ $post->id }}><i
                                                    class="fa-regular fa-flag"></i>
                                            </button>
                                            <button
                                                class="bookmark-button @if(Auth::user() && $post->isBookmarked() == 1) active-bookmark @endif"
                                                data-post-id="{{ $post->id }}" type="button">
                                                <i class="fa-regular fa-bookmark @if(Auth::user() && $post->isBookmarked() == 1) fa-solid @endif"></i>
                                            </button>

                                            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                                                <div class="toast" role="alert" aria-live="assertive"
                                                    aria-atomic="true">
                                                    <div class="toast-header">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            class="rounded me-2" alt="...">
                                                        <strong class="me-auto">Event Ritual</strong>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="toast" aria-label="Close"></button>
                                                    </div>
                                                    <div class="toast-body139">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if(Auth::user())

                                        <div class="single-comment-replay">
                                            <div class="auth-info">
                                                <a href="#">
                                                    <div class="user-thumb">
                                                        <img src="{{ isset($post->customer->photo) ? $post->customer->photo : asset('proforum/images/avatar.png')}}" alt="avatar">
                                                    </div>
                                                    <p class="post-by">
                                                        <span>{{ $post->customer->first_name." ".$post->customer->last_name }}</span>
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="comment-text">
                                                <form>
                                                    <div class="form-group">
                                                        <input type="text" name="post_id" hidden value="139">
                                                        <input type="text" name="parent_comment_id" hidden
                                                            value="">
                                                        <textarea placeholder="" class="form--control comment-replay-field" id="comment-field" name="comment"
                                                            onkeypress="singleCommentSubmit(this)"></textarea>
                                                        <label class="form--label">
                                                            Write Your Comments </label>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- right side -->
                 @include("forum.layouts.right_nav")
                 <!-- right side /-->

            </div>
        </div>
    </div>


</section>


@include('forum.layouts.modals')

@endsection

@section('customjs')
<script type="text/javascript">
    document.getElementById("menuhome").classList.add('active');
    document.getElementById("iconhome").classList.add('active');
</script>

@endsection
