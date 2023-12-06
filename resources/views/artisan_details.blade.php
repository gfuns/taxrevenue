@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Tutorial Videos')

<main class="main">
    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-image-single">
                <div class="wrap-cover-image"><img src={{ asset("storage/covers/1.png") }} alt="Santa Altenwerth"></div>
            </div>
            <div class="box-company-profile">
                <div class="image-candidate"><img src="{{ asset("storage/avatars/2-150x150.png") }}" alt="Santa Altenwerth">
                </div>
                <div class="row mt-30">
                    <div class="col-lg-8 col-md-12">
                        <h5 class="f-18">Santa Altenwerth <span class="card-location font-regular ml-20">851
                                Block RuePort Wavaside, ID 80047-9347</span></h5>
                        <p class="mt-0 font-md color-text-paragraph-2 mb-15">I get" is the same.</p>
                    </div>
                    <div class="col-lg-4 col-md-12 text-lg-end"><a class="btn btn-download-icon btn-apply btn-apply-big"
                            href="../download-cv/016b58-2.pdf?path=resume%2F01.pdf">Download CV</a></div>
                </div>
            </div>
            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>
    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="content-single">
                        <div class="tab-content">
                            <div class="tab-pane fade active show mb-5" id="tab-short-bio" role="tabpanel"
                                aria-labelledby="tab-short-bio">
                                <h4>About Me</h4> Turtle--we used to know. Let me see--how IS it to the Duchess:
                                'and the moral of that is--"Birds of a tree in front of the tea--' 'The twinkling of
                                the month, and doesn't tell what o'clock it is!'.
                            </div>
                            <div class="candidate-education-details mt-4 pt-3">
                                <h4 class="fs-17 fw-bold mb-0">Education</h4>
                                <div class="candidate-education-content mt-4 d-flex">
                                    <div class="circle flex-shrink-0 bg-soft-primary">E</div>
                                    <div class="ms-4">
                                        <h6 class="fs-16 mb-1">Economics</h6>
                                        <p class="mb-2 text-muted">American Institute of Health Technology - (2023
                                            - 2023) </p>
                                        <p class="text-muted">There are many variations of passages of available,
                                            but the majority alteration in some form. As a highly skilled and
                                            successful product development and design specialist with more than 4
                                            Years of My experience</p>
                                    </div>
                                </div>
                            </div>
                            <div class="candidate-education-details mt-4 pt-3">
                                <h4 class="fs-17 fw-bold mb-0">Experience</h4>
                                <div class="candidate-education-content mt-4 d-flex">
                                    <div class="circle flex-shrink-0 bg-soft-primary"> W </div>
                                    <div class="ms-4">
                                        <h6 class="fs-16 mb-1">Web Designer</h6>
                                        <p class="mb-2 text-muted">GameDay Catering - (2023 - 2023) </p>
                                        <p class="text-muted">There are many variations of passages of available,
                                            but the majority alteration in some form. As a highly skilled and
                                            successful product development and design specialist with more than 4
                                            Years of My experience</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 position-relative review-listing page_speed_794637252">
                            <h6 class="fs-17 fw-semibold mb-3">Santa Altenwerth&#039;s Reviews</h6>
                            <div class="spinner-overflow"></div>
                            <div class="half-circle-spinner page_speed_1238515394">
                                <div class="circle circle-1"></div>
                                <div class="circle circle-2"></div>
                            </div>
                            <div class="review-list">
                                <div class="review-pagination d-flex justify-content-center mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="d-flex justify-content-between">
                            <h5 class="f-18">Overview</h5>
                            <div><img alt="star" class="rating-star"
                                    src=../themes/jobbox/imgs/template/icons/gray-star.svg><img alt="star"
                                    class="rating-star" src=../themes/jobbox/imgs/template/icons/gray-star.svg><img
                                    alt="star" class="rating-star"
                                    src=../themes/jobbox/imgs/template/icons/gray-star.svg><img alt="star"
                                    class="rating-star" src=../themes/jobbox/imgs/template/icons/gray-star.svg><img
                                    alt="star" class="rating-star"
                                    src=../themes/jobbox/imgs/template/icons/gray-star.svg><span
                                    class="font-xs color-text-mutted ml-10"><span>(</span><span>0</span><span>)</span></span>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <ul>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">View</span><strong
                                            class="small-heading">4,864</strong></div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-list-job">
                            <ul class="ul-disc">
                                <li>851 Block RuePort Wavaside, ID 80047-9347</li>
                                <li>Phone: +15643391588</li>
                                <li>Email: <a href="../cdn-cgi/l/email-protection.html" class="__cf_email__"
                                        data-cfemail="7a191b090a1f08541b0912161f1f3a1d171b131654191517">[email&#160;protected]</a>
                                </li>
                            </ul>
                            <div class="mt-30"><a class="btn btn-send-message" href="tel:+15643391588"><span>Contact
                                        Me</span></a></div>
                        </div>
                    </div>
                    <div>
                        <div class="ads_banner_widget"><a href="../index.html"><img
                                    src=../storage/widgets/widget-banner.png alt="Banner image"
                                    class="align-middle"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script type="text/javascript">
    document.getElementById("artisans").classList.add('active');
</script>
@endsection
