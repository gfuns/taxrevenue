@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Tutorial Videos')

    <main class="main">
        <section class="section-box-2 company-detail">
            <div class="container">
                <div class="banner-hero banner-image-single">
                    <div class="wrap-cover-image"><img src="{{ asset("storage/general/cover-image.png") }}" alt="LinkedIn"></div>
                </div>
                <div class="box-company-profile">
                    <div class="image-company"><img src="{{ asset("storage/companies/1.png") }}" class="img-fluid" alt="LinkedIn">
                    </div>
                    <div class="row mt-30">
                        <div class="col-lg-8 col-md-12">
                            <h5 class="f-18"> LinkedIn <span class="card-location font-regular ml-20">New York,
                                    USA</span></h5>
                            <p class="mt-5 font-md color-text-paragraph-2 mb-15">Nihil rerum iure in et eligendi. Nihil
                                rem mollitia rerum enim tenetur id sunt. Quaerat id ex et et. Et nesciunt non quaerat
                                sit illo quidem sed omnis.</p>
                        </div>
                        <div class="col-lg-4 col-md-12 text-lg-end"><a
                                class="btn btn-call-icon btn-apply btn-apply-big" href="tel:+16319375345"> Contact Us
                            </a></div>
                    </div>
                </div>
                <div class="border-bottom pt-10 pb-10"></div>
            </div>
        </section>
        <section class="section-box mt-50 company-detail-job-list">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="content-single">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-about" role="tabpanel"
                                    aria-labelledby="tab-about">
                                    <h4>Welcome to LinkedIn</h4>
                                    <div class="ck-content">
                                        <p class="text-muted"> Objectively pursue diverse catalysts for change for
                                            interoperable meta-services. Distinctively re-engineer revolutionary
                                            meta-services and premium architectures. Intrinsically incubate intuitive
                                            opportunities and real-time potentialities. Appropriately communicate
                                            one-to-one technology.</p>
                                        <p class="text-muted">Intrinsically incubate intuitive opportunities and
                                            real-time potentialities Appropriately communicate one-to-one technology.
                                        </p>
                                        <p class="text-muted"> Exercitation photo booth stumptown tote bag Banksy, elit
                                            small batch freegan sed. Craft beer elit seitan exercitation, photo booth et
                                            8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus,
                                            Marfa eiusmod Pinterest in do umami readymade swag.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-related-job content-page box-list-jobs">
                            <h5 class="mb-30">Latest Jobs</h5>
                            <div class="display-list">
                                <div class="col-12 jobs-listing">
                                    <div class="card-grid-2 hover-up"><span class="flash"></span>
                                        <div class="row">
                                            <div class=" col-lg-6 col-md-6 col-sm-12">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src="{{ asset("storage/companies/1.png") }}"
                                                            alt="LinkedIn"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="../jobs/senior-solutions-engineer.html">Senior
                                                            Solutions Engineer</a><span class="location-small">New
                                                            York, US</span></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                                                <div class="pl-15 mb-15 mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                        href="../job-tags/sketch.html">Sketch</a><a
                                                        class="btn btn-grey-small mr-5 mb-2"
                                                        href="../job-tags/javascript.html">JavaScript</a></div>
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <div class="mt-5"><span class="card-briefcase"> Contract </span><span
                                                    class="card-time"><span>2 days ago</span></span></div>
                                            <p class="font-sm color-text-paragraph mt-10">Eos est quibusdam et
                                                aspernatur eum quo animi. Non sequi distinctio aperiam commodi. Quo qui
                                                qui eum ut ut quia vel. Qui expedita est atque velit assumenda laborum.
                                            </p>
                                            <div class="card-2-bottom mt-20">
                                                <div class="row">
                                                    <div class="col-lg-7 col-7"><span class="card-text-price"
                                                            title="$7,000 - $11,200"> $7,000 - $11,200 </span><span
                                                            class="text-muted">/Yearly</span></div>
                                                    <div class="col-lg-5 col-5 text-end">
                                                        <div class=""><button class="btn btn-apply-now"
                                                                data-job-name="Senior Solutions Engineer"
                                                                data-job-id="42" data-bs-toggle="modal"
                                                                data-bs-target="#ModalApplyJobForm"> Apply Now
                                                            </button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 jobs-listing">
                                    <div class="card-grid-2 hover-up"><span class="flash"></span>
                                        <div class="row">
                                            <div class=" col-lg-6 col-md-6 col-sm-12">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src="{{ asset("storage/companies/1.png") }}"
                                                            alt="LinkedIn"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="../jobs/analyst-relations-manager-application-security.html">Analyst
                                                            Relations Manager, Application Security</a><span
                                                            class="location-small">New York, US</span></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                                                <div class="pl-15 mb-15 mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                        href="../job-tags/illustrator.html">Illustrator</a><a
                                                        class="btn btn-grey-small mr-5 mb-2"
                                                        href="../job-tags/javascript.html">JavaScript</a></div>
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <div class="mt-5"><span class="card-briefcase"> Internship </span><span
                                                    class="card-time"><span>1 week ago</span></span></div>
                                            <p class="font-sm color-text-paragraph mt-10">Quod et facilis et illo fugit
                                                aut. Ipsum corporis odio voluptas eos qui et cumque et. Et quia beatae
                                                culpa ad. Sint neque sunt et iure dolor fugiat.</p>
                                            <div class="card-2-bottom mt-20">
                                                <div class="row">
                                                    <div class="col-lg-7 col-7"><span class="card-text-price"
                                                            title="$7,000 - $13,400"> $7,000 - $13,400 </span><span
                                                            class="text-muted">/Weekly</span></div>
                                                    <div class="col-lg-5 col-5 text-end">
                                                        <div class=""><button class="btn btn-apply-now"
                                                                data-job-name="Analyst Relations Manager, Application Security"
                                                                data-job-id="22" data-bs-toggle="modal"
                                                                data-bs-target="#ModalApplyJobForm"> Apply Now
                                                            </button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 jobs-listing">
                                    <div class="card-grid-2 hover-up"><span class="flash"></span>
                                        <div class="row">
                                            <div class=" col-lg-6 col-md-6 col-sm-12">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src="{{ asset("storage/companies/1.png") }}"
                                                            alt="LinkedIn"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="../jobs/full-stack-engineer.html">Full Stack
                                                            Engineer</a><span class="location-small">New York,
                                                            US</span></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                                                <div class="pl-15 mb-15 mt-30"><a class="btn btn-grey-small mr-5 mb-2"
                                                        href="../job-tags/sketch.html">Sketch</a><a
                                                        class="btn btn-grey-small mr-5 mb-2"
                                                        href="../job-tags/python.html">Python</a></div>
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <div class="mt-5"><span class="card-briefcase"> Internship </span><span
                                                    class="card-time"><span>3 weeks ago</span></span></div>
                                            <p class="font-sm color-text-paragraph mt-10">Harum aut consequatur
                                                ducimus. Qui illo rem corporis unde vel deleniti. Sed autem nesciunt
                                                dolore et.</p>
                                            <div class="card-2-bottom mt-20">
                                                <div class="row">
                                                    <div class="col-lg-7 col-7"><span class="card-text-price"
                                                            title="$7,300 - $14,100"> $7,300 - $14,100 </span><span
                                                            class="text-muted">/Yearly</span></div>
                                                    <div class="col-lg-5 col-5 text-end">
                                                        <div class=""><button class="btn btn-apply-now"
                                                                data-bs-target="#ModalApplyExternalJobForm"
                                                                data-bs-toggle="modal"
                                                                data-job-name="Full Stack Engineer" data-job-id="2">
                                                                Apply Now </button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 position-relative review-listing page_speed_115609192">
                            <h6 class="fs-17 fw-semibold mb-3">LinkedIn&#039;s Reviews</h6>
                            <div class="spinner-overflow"></div>
                            <div class="half-circle-spinner page_speed_1268025327">
                                <div class="circle circle-1"></div>
                                <div class="circle circle-2"></div>
                            </div>
                            <div class="review-list">
                                <div class="d-sm-flex align-items-top review-item">
                                    <div class="flex-shrink-0"><img
                                            class="rounded-circle avatar-md img-thumbnail review-user-avatar"
                                            src="{{ asset("storage/avatars/1-150x150.png") }}" alt="Theron Johns"></div>
                                    <div class="flex-grow-1 ms-sm-3">
                                        <div>
                                            <p class="text-muted float-end fs-14 mb-2">Dec 01, 2023</p>
                                            <h6 class="mt-sm-0 mt-3 mb-1">Theron Johns</h6>
                                            <div class="text-warning review-rating mb-2">
                                                <img alt="star"
                                                    class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"/><img
                                                    alt="star" class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                                    alt="star" class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                                    alt="star" class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                                    alt="star" class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"></div>
                                            <p class="text-muted fst-italic">I Love this Script. I also found how to
                                                add other fees. Now I just wait the BIG update for the Marketplace with
                                                the Bulk Import. Just do not forget to make it to be Multi-language for
                                                us the Botble Fans.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-top review-item">
                                    <div class="flex-shrink-0"><img
                                            class="rounded-circle avatar-md img-thumbnail review-user-avatar"
                                            src="{{ asset("storage/avatars/3-150x150.png") }}" alt="Rory Balistreri"></div>
                                    <div class="flex-grow-1 ms-sm-3">
                                        <div>
                                            <p class="text-muted float-end fs-14 mb-2">Dec 01, 2023</p>
                                            <h6 class="mt-sm-0 mt-3 mb-1">Rory Balistreri</h6>
                                            <div class="text-warning review-rating mb-2"><img alt="star"
                                                    class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                                    alt="star" class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                                    alt="star" class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                                    alt="star" class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                                    alt="star" class="rating-star"
                                                    src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"></div>
                                            <p class="text-muted fst-italic">Customer Support are grade (A*), however
                                                the code is a way too over engineered for it&#039;s purpose.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-pagination d-flex justify-content-center mt-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                        <div class="sidebar-border">
                            <div class="sidebar-heading">
                                <div class="avatar-sidebar">
                                    <div class="sidebar-info pl-0"><span
                                            class="sidebar-company mb-2">LinkedIn</span><img alt="star"
                                            class="rating-star" src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                            alt="star" class="rating-star"
                                            src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img alt="star"
                                            class="rating-star" src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img
                                            alt="star" class="rating-star"
                                            src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><img alt="star"
                                            class="rating-star"
                                            src="{{ asset("themes/jobbox/imgs/template/icons/star.svg") }}"><span
                                            class="font-xs color-text-mutted ml-10"><span>(</span><span>2</span><span>)</span></span><span
                                            class="card-location"></span></div>
                                </div>
                            </div>
                            <div class="sidebar-list-job">
                                <div class="box-map job-board-street-map-container">
                                    MAP comes here
                                </div>
                                <div class="d-none" id="street-map-popup-template">
                                    <div>
                                        <table width=100%>
                                            <tr>
                                                <td width=40 class="image-company-sidebar">
                                                    <div><img src="{{ asset("storage/companies/1.png") }}" width=40 alt="LinkedIn">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="infomarker">
                                                        <h5><a href="linkedin.html" target="_blank">LinkedIn</a></h5>
                                                        <div class="text-info"><i class="mdi mdi-account"></i><span>3
                                                                Employees</span></div>
                                                        <div class="text-muted"><i class="uil uil-map"></i><span>42083
                                                                Wunsch Mountains Suite 670East Darricktown, AR 30086,
                                                                New York, New York, USA</span></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-list-job">
                                <ul>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                        <div class="sidebar-text-info"><span class="text-description">Year
                                                founded</span><strong class="small-heading">1992</strong></div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-globe"></i></div>
                                        <div class="sidebar-text-info"><span class="text-description">Website
                                            </span><a href="https://www.linkedin.com/"><strong
                                                    class="small-heading">https://www.linkedin.com</strong></a></div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                        <div class="sidebar-text-info"><span class="text-description">Last Jobs
                                                Posted</span><strong class="small-heading">2 days ago</strong></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidebar-list-job">
                                <ul class="ul-disc">
                                    <li>42083 Wunsch Mountains Suite 670East Darricktown, AR 30086</li>
                                    <li>Phone: +16319375345</li>
                                </ul>
                                <div class="text-center mt-30"></div>
                                <div class="mt-30"></div>
                            </div>
                        </div>
                        <div class="ads_banner_widget"><a href="../index.html"><img
                                    src="{{ asset("storage/widgets/widget-banner.png") }}" alt="Banner image"
                                    class="align-middle"></a></div>
                    </div>
                </div>
            </div>
            <form method="GET" action="#" accept-charset="UTF-8"
                id="job-pagination-form"><input type=hidden name=page value="1"></form>
        </section>

    </main>
    <script type="text/javascript">
        document.getElementById("businesses").classList.add('active');
    </script>
    @endsection
