@extends('forum.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Forum')

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

    @include("forum.layouts.nav")


    <!-- body -->
    <div class="body-section">
        <div class="container-fluid">
            <div class="row m-0">
                <!-- left side -->
                @include("forum.layouts.left_nav")
                <!-- left side / -->


                <div class="col-xl-6 col-lg-6">
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="forum-card-wraper">
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="141"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote141"
                                                data-post-id="141">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="141"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body event ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="25 Oct, 2023 10:42 PM" class="time-status">5 months ago
                                                </p>


                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-event">Events</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="141">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/141/legends-in-concert">
                                                <h6 class="card-title ">Legends In Concert </h6>
                                            </a>

                                            <p class="card-sub-title wyg">Legends In Concert is a live stage show
                                                featuring impersonators of Elvis Presley, Michael Jackson, and other
                                                legendary entertainers. See them live in concert in Barcelona!
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/141/legends-in-concert"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/141/legends-in-concert"><i
                                                            class="las la-eye"></i>
                                                        <p>3K+ Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=legends-in-concert">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=legends-in-concert&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=legends-in-concert+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="141"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="141" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="140"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote140"
                                                data-post-id="140">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="140"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body event ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="25 Oct, 2023 10:41 PM" class="time-status">5 months ago
                                                </p>


                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-event">Events</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="140">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/140/gatlin-brothers">
                                                <h6 class="card-title ">Gatlin Brothers </h6>
                                            </a>

                                            <p class="card-sub-title wyg">The Gatlin Brothers are one of the most
                                                popular country music groups of all time. See them live in concert
                                                in Las Vegas!
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/140/gatlin-brothers"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/140/gatlin-brothers"><i
                                                            class="las la-eye"></i>
                                                        <p>783 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=gatlin-brothers">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=gatlin-brothers&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=gatlin-brothers+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="140"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="140" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="139"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote139"
                                                data-post-id="139">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="139"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body event ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="25 Oct, 2023 10:37 PM" class="time-status">5 months ago
                                                </p>


                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-event">Events</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="139">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/139/event-ritual">
                                                <h6 class="card-title ">Event Ritual </h6>
                                            </a>

                                            <p class="card-sub-title wyg">Alanis Morissette is coming to Los
                                                Angeles! Don't miss your chance to see this iconic singer-songwriter
                                                live in concert.
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/139/event-ritual"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/139/event-ritual"><i
                                                            class="las la-eye"></i>
                                                        <p>580 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=event-ritual">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=event-ritual&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=event-ritual+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="139"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="139" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="102"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote102"
                                                data-post-id="102">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="102"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/32">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/avatar6.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>tesos tesos</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 04:06 AM" class="time-status">6 months ago
                                                </p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 24 Nov, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="102">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/102/vacancy-announcement">
                                                <h6 class="card-title ">Vacancy Announcement </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 45000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/102/vacancy-announcement"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/102/vacancy-announcement"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/102/vacancy-announcement"><i
                                                            class="las la-eye"></i>
                                                        <p>1K+ Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=vacancy-announcement">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=vacancy-announcement&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=vacancy-announcement+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="102"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="102" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="95"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote95" data-post-id="95">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="95"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 04:01 AM" class="time-status">6 months ago
                                                </p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 30 Nov, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="95">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a href="https://preview.wstacks.com/proforum/details/95/actionaido">
                                                <h6 class="card-title ">Actionaido </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 80000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/95/actionaido"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/95/actionaido"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/95/actionaido"><i
                                                            class="las la-eye"></i>
                                                        <p>623 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=actionaido">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=actionaido&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=actionaido+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="95"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="95" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="93"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote93" data-post-id="93">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="93"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:50 AM" class="time-status">6 months ago
                                                </p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 31 Oct, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="93">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/93/senior-sales-officer">
                                                <h6 class="card-title ">Senior Sales Officer </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 25000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/93/senior-sales-officer"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/93/senior-sales-officer"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/93/senior-sales-officer"><i
                                                            class="las la-eye"></i>
                                                        <p>451 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=senior-sales-officer">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=senior-sales-officer&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=senior-sales-officer+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="93"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="93" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="85"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote85" data-post-id="85">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="85"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 04:00 AM" class="time-status">6 months ago
                                                </p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 15 Dec, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="85">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/85/vacancy-announcement">
                                                <h6 class="card-title ">VACANCY ANNOUNCEMENT </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 70000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/85/vacancy-announcement"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/85/vacancy-announcement"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/85/vacancy-announcement"><i
                                                            class="las la-eye"></i>
                                                        <p>297 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=vacancy-announcement">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=vacancy-announcement&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=vacancy-announcement+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="85"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="85" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="75"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote75" data-post-id="75">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="75"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 04:04 AM" class="time-status">6 months ago
                                                </p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 31 Oct, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="75">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/75/senior-manager">
                                                <h6 class="card-title ">Senior Manager </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 35000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/75/senior-manager"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/75/senior-manager"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/75/senior-manager"><i
                                                            class="las la-eye"></i>
                                                        <p>311 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=senior-manager">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=senior-manager&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=senior-manager+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="75"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="75" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="71"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote71" data-post-id="71">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="71"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:59 AM" class="time-status">6 months ago
                                                </p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 25 Nov, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="71">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/71/just-energy-transition-media-fellowship">
                                                <h6 class="card-title ">Just Energy Transition Media Fellowship
                                                </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 50000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/71/just-energy-transition-media-fellowship"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/71/just-energy-transition-media-fellowship"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/71/just-energy-transition-media-fellowship"><i
                                                            class="las la-eye"></i>
                                                        <p>185 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=just-energy-transition-media-fellowship">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=just-energy-transition-media-fellowship&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=just-energy-transition-media-fellowship+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="71"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="71" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="68"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote68" data-post-id="68">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="68"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 04:05 AM" class="time-status">6 months ago
                                                </p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 28 Oct, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="68">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a href="https://preview.wstacks.com/proforum/details/68/iut">
                                                <h6 class="card-title ">IUT </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 30000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a href="https://preview.wstacks.com/proforum/details/68/iut"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a href="https://preview.wstacks.com/proforum/details/68/iut"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a href="https://preview.wstacks.com/proforum/details/68/iut"><i
                                                            class="las la-eye"></i>
                                                        <p>124 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=iut">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=iut&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=iut+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="68"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="68" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="63"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote63"
                                                data-post-id="63">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="63"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:57 AM" class="time-status">6 months
                                                    ago</p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 04 Nov, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="63">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/63/sales-representative">
                                                <h6 class="card-title ">Sales Representative </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 50000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/63/sales-representative"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/63/sales-representative"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/63/sales-representative"><i
                                                            class="las la-eye"></i>
                                                        <p>195 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=sales-representative">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=sales-representative&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=sales-representative+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="63"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="63" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="62"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote62"
                                                data-post-id="62">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="62"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:56 AM" class="time-status">6 months
                                                    ago</p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 30 Nov, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="62">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/62/qa-automation-engineer">
                                                <h6 class="card-title ">QA Automation Engineer </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 30000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/62/qa-automation-engineer"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/62/qa-automation-engineer"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/62/qa-automation-engineer"><i
                                                            class="las la-eye"></i>
                                                        <p>108 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=qa-automation-engineer">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=qa-automation-engineer&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=qa-automation-engineer+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="62"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="62" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="61"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote61"
                                                data-post-id="61">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="61"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:53 AM" class="time-status">6 months
                                                    ago</p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 31 Oct, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="61">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/61/system-administrator">
                                                <h6 class="card-title ">System Administrator </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 40000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/61/system-administrator"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/61/system-administrator"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/61/system-administrator"><i
                                                            class="las la-eye"></i>
                                                        <p>116 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=system-administrator">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=system-administrator&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=system-administrator+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="61"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="61" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="59"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote59"
                                                data-post-id="59">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="59"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:50 AM" class="time-status">6 months
                                                    ago</p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 30 Nov, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="59">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/59/digital-marketing">
                                                <h6 class="card-title ">Digital Marketing </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 18000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/59/digital-marketing"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/59/digital-marketing"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/59/digital-marketing"><i
                                                            class="las la-eye"></i>
                                                        <p>116 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=digital-marketing">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=digital-marketing&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=digital-marketing+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="59"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="59" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="58"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote58"
                                                data-post-id="58">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="58"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:33 AM" class="time-status">6 months
                                                    ago</p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 15 Nov, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="58">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/58/international-leasing-and-financial-services-limited">
                                                <h6 class="card-title ">INTERNATIONAL LEASING AND FINANCIAL
                                                    SERVICES LIMITED </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 40000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/58/international-leasing-and-financial-services-limited"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/58/international-leasing-and-financial-services-limited"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/58/international-leasing-and-financial-services-limited"><i
                                                            class="las la-eye"></i>
                                                        <p>149 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=international-leasing-and-financial-services-limited">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=international-leasing-and-financial-services-limited&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=international-leasing-and-financial-services-limited+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="58"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="58" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="57"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote57"
                                                data-post-id="57">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="57"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body job ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:31 AM" class="time-status">6 months
                                                    ago</p>

                                                <i class="fa-solid fa-circle"></i>
                                                <p class="time-status">Deadline: 15 Nov, 2023</p>

                                            </div>
                                            <div class="actn-dropdown-box">
                                                <span class="badge-job">Jobs</span>
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="57">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/57/nvi-is-hiring">
                                                <h6 class="card-title ">NVI is hiring </h6>
                                            </a>
                                            <div class="job-time-line">
                                                <p>$ 30000</p>
                                            </div>

                                            <p class="card-sub-title wyg">About the jobFanfare Bangladesh Ltd. the
                                                first social commerce platform in Bangladesh (a Singapore JV
                                                company) is seeking for Sale Representative to expedite sales
                                                efforts and initiatives in
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/57/nvi-is-hiring"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/57/nvi-is-hiring"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Comments </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/57/nvi-is-hiring"><i
                                                            class="las la-eye"></i>
                                                        <p>134 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=nvi-is-hiring">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=nvi-is-hiring&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=nvi-is-hiring+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="57"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="57" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="47"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote47"
                                                data-post-id="47">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="47"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:21 AM" class="time-status">6 months
                                                    ago</p>


                                            </div>
                                            <div class="actn-dropdown-box">
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="47">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/47/person-environment-fit">
                                                <h6 class="card-title ">Person-environment fit </h6>
                                            </a>

                                            <p class="card-sub-title wyg">Interview structure is the degree to
                                                which interviews are identical and conducted the same across
                                                applicants. Also known as guided,&nbsp;systematic, or patterned
                                                interviews, structured, intervie
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/47/person-environment-fit"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/47/person-environment-fit"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Answers </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/47/person-environment-fit"><i
                                                            class="las la-eye"></i>
                                                        <p>86 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=person-environment-fit">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=person-environment-fit&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=person-environment-fit+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="47"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="47" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="46"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote46"
                                                data-post-id="46">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="46"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:21 AM" class="time-status">6 months
                                                    ago</p>


                                            </div>
                                            <div class="actn-dropdown-box">
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="46">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a href="https://preview.wstacks.com/proforum/details/46/strategies">
                                                <h6 class="card-title ">Strategies </h6>
                                            </a>

                                            <p class="card-sub-title wyg">Interview structure is the degree to
                                                which interviews are identical and conducted the same across
                                                applicants. Also known as guided,&nbsp;systematic, or patterned
                                                interviews, structured, intervie
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/46/strategies"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/46/strategies"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Answers </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/46/strategies"><i
                                                            class="las la-eye"></i>
                                                        <p>74 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=strategies">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=strategies&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=strategies+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="46"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="46" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="45"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote45"
                                                data-post-id="45">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="45"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:21 AM" class="time-status">6 months
                                                    ago</p>


                                            </div>
                                            <div class="actn-dropdown-box">
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="45">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a
                                                href="https://preview.wstacks.com/proforum/details/45/job-interview">
                                                <h6 class="card-title ">Job interview </h6>
                                            </a>

                                            <p class="card-sub-title wyg">Interview structure is the degree to
                                                which interviews are identical and conducted the same across
                                                applicants. Also known as guided,&nbsp;systematic, or patterned
                                                interviews, structured, intervie
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/45/job-interview"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/45/job-interview"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Answers </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/45/job-interview"><i
                                                            class="las la-eye"></i>
                                                        <p>101 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=job-interview">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=job-interview&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=job-interview+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="45"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="45" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="forum-card">

                                    <div class="vote-item vote-qty">
                                        <div class="vote-item-wraper">
                                            <button class="vote-qty__increment post_vote " data-post-id="44"
                                                data-post-vote="1">
                                                <i class="fa-circle-up  fa-regular "></i>
                                            </button>

                                            <div class="vote-value-container total_post_vote44"
                                                data-post-id="44">
                                                <h6 class="vote-qty__value">
                                                    0
                                                </h6>
                                            </div>
                                            <button class="vote-qty__decrement post_vote " data-post-id="44"
                                                data-post-vote="0">
                                                <i class="fa-circle-down  fa-regular "></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card--body ">
                                        <div class="card-auth-meta">
                                            <div class="auth-info">
                                                <a href="https://preview.wstacks.com/proforum/user-profile/34">
                                                    <div class="user-thumb">
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/user/profile/6526cc25c10a11697041445.png"
                                                            alt="avatar">
                                                    </div>
                                                    <p class="post-by">Posted by <span>test user</span>
                                                    </p>
                                                </a>
                                                <i class="fa-solid fa-circle"></i>
                                                <p title="12 Oct, 2023 03:20 AM" class="time-status">6 months
                                                    ago</p>


                                            </div>
                                            <div class="actn-dropdown-box">
                                                <button class="actn-dropdown-btn">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="actn-dropdown option">
                                                    <ul>
                                                        <li>
                                                            <button class="report_button report_post_button"
                                                                data-post-id="44">
                                                                <i class="fa-regular fa-flag"></i>
                                                                <span>Report</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <a href="https://preview.wstacks.com/proforum/details/44/assessment">
                                                <h6 class="card-title ">Assessment </h6>
                                            </a>

                                            <p class="card-sub-title wyg">Interview structure is the degree to
                                                which interviews are identical and conducted the same across
                                                applicants. Also known as guided,&nbsp;systematic, or patterned
                                                interviews, structured, intervie
                                                ... <a
                                                    href="https://preview.wstacks.com/proforum/details/44/assessment"
                                                    class="btn-sm p-1"><u>See More</u></a>
                                            </p>
                                        </div>
                                        <div class="forum-cad-footer">
                                            <ul class="footer-item-list">
                                                <li>
                                                    <a
                                                        href="https://preview.wstacks.com/proforum/details/44/assessment"><i
                                                            class="las la-comments"></i>
                                                        <p>0
                                                            Answers </p>
                                                    </a>
                                                </li>
                                                <li><a
                                                        href="https://preview.wstacks.com/proforum/details/44/assessment"><i
                                                            class="las la-eye"></i>
                                                        <p>70 Views</p>
                                                    </a></li>
                                                <li>
                                                    <!--  -->
                                                    <div class="actn-dropdown-box">
                                                        <button class="actn-dropdown-btn">
                                                            <i class="las la-share"></i>
                                                            <span> Share</span>
                                                        </button>
                                                        <div class="actn-dropdown">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.facebook.com/share.php?u=https://preview.wstacks.com/proforum&amp;title=assessment">
                                                                        <i class="fa-brands fa-facebook-f"></i>
                                                                        <span class="ms-3">Facebook</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://preview.wstacks.com/proforum&amp;title=assessment&amp;source=behands">
                                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                                        <span class="ms-3">Linkedin</span>
                                                                    </a>

                                                                </li>
                                                                <li class="report_button">
                                                                    <a target="_blank" class="report_button"
                                                                        href="https://twitter.com/intent/tweet?status=assessment+https://preview.wstacks.com/proforum">
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
                                                    data-post-id="44"><i class="fa-regular fa-flag"></i>
                                                </button>
                                                <button class="bookmark-button
                    "
                                                    data-post-id="44" type="button">
                                                    <i class="fa-regular fa-bookmark "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    @include("forum.layouts.right_nav")
                <!-- right side /-->

            </div>
        </div>
    </div>

    @include("forum.layouts.modals")



</section>
@endsection

@section("customjs")
<script type="text/javascript">
    document.getElementById("menupopular").classList.add('active');
    document.getElementById("iconpopular").classList.add('active');
</script>

@endsection
