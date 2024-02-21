@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | About Us')
<main class="main">
    <section class="section-box">
        <div class="breadcrumb-cover bg-img-about page_speed_1377612569" style="background:url({{ asset('files/pages/background-breadcrumb.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="mb-10">About Us</h2>
                        <p class="font-lg color-text-paragraph-2">Who We Are, Our Mission and Vision</p>
                    </div>
                    <div class="col-lg-6 text-md-end">
                        <ul class="breadcrumbs mt-40 ">
                            <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                    Home </a></li>
                            <li>About us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ck-content">
        <div>
            <section class="section-box mt-50">
                <div class="post-loop-grid">
                    <div class="container">
                        <div class="text-center">
                            <h6 class="f-18 color-text-mutted text-uppercase"></h6>
                            <h2
                                class="section-title mb-10 wow animate__ animate__fadeInUp animated page_speed_1550022378">
                                About Our Company </h2>
                            <p
                                class="font-sm color-text-paragraph wow animate__ animate__fadeInUp w-lg-50 mx-auto animated page_speed_1550022378">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ligula ante, dictum
                                non aliquet eu, dapibus ac quam. Morbi vel ante viverra orci tincidunt tempor eu id
                                ipsum. Sed consectetur, risus a blandit tempor, velit magna pellentesque risus, at
                                congue tellus dui quis nisl. </p>
                        </div>
                        <div class="row mt-70">
                            <div class="col-lg-6 col-md-12 col-sm-12"><img
                                    src="{{ asset("storage/pages/img_about2.png") }}" alt="Company Image"></div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <h3 class="mt-15">What we can do?</h3>
                                <div class="mt-20">
                                    <p class="font-md color-text-paragraph mt-20">Aenean sollicituin, lorem quis
                                        bibendum auctor nisi elit consequat ipsum sagittis sem nibh id elit. Duis
                                        sed odio sit amet nibh vulputate cursus a sit amet maurisorbi accumsan ipsum
                                        velit. Nam nec tellus a odio tincidunt auctora ornare odio. Aenean
                                        sollicituin, lorem quis bibendum auctor nisi elit consequat ipsum sagittis
                                        sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet
                                        maurisorbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctora
                                        ornare odio. Class aptent taciti sociosqu ad litora torquent per conubia
                                        nostra, per inceptos himenaeos. Duis non nisi purus. Integer sit nostra, per
                                        inceptos himenaeos. Class aptent taciti sociosqu ad litora torquent per
                                        conubia nostra, per inceptos himenaeos. Duis non nisi purus. Integer sit
                                        nostra, per inceptos himenaeos.</p>
                                </div>
                                <div class="mt-30"><a class="btn btn-brand-1" href="/"> Read more </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="team">
            <div class="container mt-50">
                <div class="text-center">
                    <h6 class="f-18 color-text-mutted text-uppercase"></h6>
                    <h2 class="section-title mb-10 wow animate__ animate__fadeInUp animated page_speed_1550022378">
                        Our Team </h2>
                    <p
                        class="font-sm color-text-paragraph w-lg-50 mx-auto wow animate__ animate__fadeInUp animated page_speed_1550022378">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ligula ante, dictum non
                        aliquet eu, dapibus ac quam. Morbi vel ante viverra orci tincidunt tempor eu id ipsum. Sed
                        consectetur, risus a blandit tempor, velit magna pellentesque risus, at congue tellus dui
                        quis nisl. </p>
                </div>
                <div class="row mt-70">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-md-30">
                        <div class="card-grid-4 text-center hover-up">
                            <div class="image-top-feature">
                                <figure><img alt="Jack Persion" src="{{ asset("storage/pages/1.png") }}">
                                </figure>
                            </div>
                            <div class="card-grid-4-info">
                                <h5 class="mt-10">Jack Persion</h5>
                                <p class="font-xs color-text-paragraph-2 mt-5 mb-5">Developer Fullstack</p><span
                                    class="card-location">USA</span>
                                <div class="text-center mt-30"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-md-30">
                        <div class="card-grid-4 text-center hover-up">
                            <div class="image-top-feature">
                                <figure><img alt="Tyler Men" src="{{ asset("storage/pages/2.png") }}">
                                </figure>
                            </div>
                            <div class="card-grid-4-info">
                                <h5 class="mt-10">Tyler Men</h5>
                                <p class="font-xs color-text-paragraph-2 mt-5 mb-5">Business Analyst</p><span
                                    class="card-location">Qatar</span>
                                <div class="text-center mt-30"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-md-30">
                        <div class="card-grid-4 text-center hover-up">
                            <div class="image-top-feature">
                                <figure><img alt="Mohamed Salah" src="{{ asset("storage/pages/3.png") }}">
                                </figure>
                            </div>
                            <div class="card-grid-4-info">
                                <h5 class="mt-10">Mohamed Salah</h5>
                                <p class="font-xs color-text-paragraph-2 mt-5 mb-5">Developer Fullstack</p><span
                                    class="card-location">India</span>
                                <div class="text-center mt-30"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-md-30">
                        <div class="card-grid-4 text-center hover-up">
                            <div class="image-top-feature">
                                <figure><img alt="Xao Shin" src="{{ asset("storage/pages/4.png") }}">
                                </figure>
                            </div>
                            <div class="card-grid-4-info">
                                <h5 class="mt-10">Xao Shin</h5>
                                <p class="font-xs color-text-paragraph-2 mt-5 mb-5">Developer Fullstack</p><span
                                    class="card-location">China</span>
                                <div class="text-center mt-30"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-md-30">
                        <div class="card-grid-4 text-center hover-up">
                            <div class="image-top-feature">
                                <figure><img alt="Peter Cop" src="{{ asset("storage/pages/5.png") }}">
                                </figure>
                            </div>
                            <div class="card-grid-4-info">
                                <h5 class="mt-10">Peter Cop</h5>
                                <p class="font-xs color-text-paragraph-2 mt-5 mb-5">Designer</p><span
                                    class="card-location">Russia</span>
                                <div class="text-center mt-30"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-md-30">
                        <div class="card-grid-4 text-center hover-up">
                            <div class="image-top-feature">
                                <figure><img alt="Jacob Jones" src="{{ asset("storage/pages/6.png") }}">
                                </figure>
                            </div>
                            <div class="card-grid-4-info">
                                <h5 class="mt-10">Jacob Jones</h5>
                                <p class="font-xs color-text-paragraph-2 mt-5 mb-5">Frontend Developer</p><span
                                    class="card-location">New York, US</span>
                                <div class="text-center mt-30"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-md-30">
                        <div class="card-grid-4 text-center hover-up">
                            <div class="image-top-feature">
                                <figure><img alt="Court Henry" src="{{ asset("storage/pages/7.png") }}">
                                </figure>
                            </div>
                            <div class="card-grid-4-info">
                                <h5 class="mt-10">Court Henry</h5>
                                <p class="font-xs color-text-paragraph-2 mt-5 mb-5">Backend Developer</p><span
                                    class="card-location">Portugal</span>
                                <div class="text-center mt-30"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-md-30">
                        <div class="card-grid-4 text-center hover-up">
                            <div class="image-top-feature">
                                <figure><img alt="Theresa" src="{{ asset("storage/pages/8.png") }}">
                                </figure>
                            </div>
                            <div class="card-grid-4-info">
                                <h5 class="mt-10">Theresa</h5>
                                <p class="font-xs color-text-paragraph-2 mt-5 mb-5">Backend Developer</p><span
                                    class="card-location">Thailand</span>
                                <div class="text-center mt-30"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</main>
@endsection
