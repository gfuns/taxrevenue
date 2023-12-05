@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Tutorial Videos')

    <main class="main">
        <div class="ck-content">
            <div>
                <section class="section-box mt-90 mb-50">
                    <div class="container">
                        <h2 class="text-center mb-15"> Pricing Table </h2>
                        <div class="font-lg color-text-paragraph-2 text-center"> Choose The Best Plan That’s For You
                        </div>
                        <div class="max-width-price">
                            <div class="block-pricing mt-70">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="box-pricing-item">
                                            <h3>Free First Post</h3>
                                            <div class="box-info-price"><span
                                                    class="text-price color-brand-2">$0</span></div>
                                            <div class="border-bottom mb-30"></div>
                                            <ul class="list-package-feature">
                                                <li><svg width=28 height=28 viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle opacity="0.1" cx="14" cy="14" r="14"
                                                            fill="#3C65F5" />
                                                        <path d="M19 10.5L11.5 18L8.5 15" stroke="#3C65F5"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg> 1 Listings </li>
                                                <li><svg width=28 height=28 viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle opacity="0.1" cx="14" cy="14" r="14"
                                                            fill="#3C65F5" />
                                                        <path d="M19 10.5L11.5 18L8.5 15" stroke="#3C65F5"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg> Limited purchase by account </li>
                                            </ul>
                                            <div><a class="btn btn-border"
                                                    href="https://jobbox.archielite.com/login">Choose plan</a></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="box-pricing-item">
                                            <h3>Single Post</h3>
                                            <div class="box-info-price"><span
                                                    class="text-price color-brand-2">$250</span></div>
                                            <div class="border-bottom mb-30"></div>
                                            <ul class="list-package-feature">
                                                <li><svg width=28 height=28 viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle opacity="0.1" cx="14" cy="14" r="14"
                                                            fill="#3C65F5" />
                                                        <path d="M19 10.5L11.5 18L8.5 15" stroke="#3C65F5"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg> 1 Listings </li>
                                                <li><svg width=28 height=28 viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle opacity="0.1" cx="14" cy="14" r="14"
                                                            fill="#3C65F5" />
                                                        <path d="M19 10.5L11.5 18L8.5 15" stroke="#3C65F5"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg> Unlimited purchase by account </li>
                                            </ul>
                                            <div><a class="btn btn-border"
                                                    href="https://jobbox.archielite.com/login">Choose plan</a></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="box-pricing-item">
                                            <h3>5 Posts</h3>
                                            <div class="box-info-price"><span
                                                    class="text-price color-brand-2">$1,000</span></div>
                                            <div class="border-bottom mb-30"></div>
                                            <ul class="list-package-feature">
                                                <li><svg width=28 height=28 viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle opacity="0.1" cx="14" cy="14" r="14"
                                                            fill="#3C65F5" />
                                                        <path d="M19 10.5L11.5 18L8.5 15" stroke="#3C65F5"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg> 5 Listings </li>
                                                <li><svg width=28 height=28 viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle opacity="0.1" cx="14" cy="14" r="14"
                                                            fill="#3C65F5" />
                                                        <path d="M19 10.5L11.5 18L8.5 15" stroke="#3C65F5"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg> Unlimited purchase by account </li>
                                            </ul>
                                            <div><a class="btn btn-border"
                                                    href="https://jobbox.archielite.com/login">Choose plan</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div>
                <section class="section-box mt-90 mb-50">
                    <div class="container ">
                        <h2 class="text-center mb-15 wow animate__ animate__fadeInUp animated page_speed_97195667">
                            Frequently Asked Questions </h2>
                        <div
                            class="font-lg color-text-paragraph-2 text-center wow animate__ animate__fadeInUp animated page_speed_97195667">
                            Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis a libero tempus,
                            blandit and cursus varius and magnis sapien </div>
                        <div class="row mt-50">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div
                                    class="card-grid-border hover-up wow animate__ animate__fadeIn animated page_speed_1648937243">
                                    <h4 class="mb-20">Where To Place A FAQ Page</h4>
                                    <p class="font-sm mb-20 color-text-paragraph">Just as the name suggests, a FAQ page
                                        is all about simple questions and answers. Gather common questions your
                                        customers have asked from your support team and include them in the FAQ, Use
                                        categories to organize questions related to specific topics.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div
                                    class="card-grid-border hover-up wow animate__ animate__fadeIn animated page_speed_1648937243">
                                    <h4 class="mb-20">Where can I get some?</h4>
                                    <p class="font-sm mb-20 color-text-paragraph">To an English person, it will seem
                                        like simplified English, as a skeptical Cambridge friend of mine told me what
                                        Occidental is. The European languages are members of the same family. Their
                                        separate existence is a myth.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div
                                    class="card-grid-border hover-up wow animate__ animate__fadeIn animated page_speed_1648937243">
                                    <h4 class="mb-20">Why do we use it?</h4>
                                    <p class="font-sm mb-20 color-text-paragraph">It will be as simple as Occidental;
                                        in fact, it will be Occidental. To an English person, it will seem like
                                        simplified English, as a skeptical Cambridge friend of mine told me what
                                        Occidental.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div
                                    class="card-grid-border hover-up wow animate__ animate__fadeIn animated page_speed_1648937243">
                                    <h4 class="mb-20">Where does it come from?</h4>
                                    <p class="font-sm mb-20 color-text-paragraph">If several languages coalesce, the
                                        grammar of the resulting language is more simple and regular than that of the
                                        individual languages. The new common language will be more simple and regular
                                        than the existing European languages.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div>
                <section class="section mt-50">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="section-title text-center mb-4 pb-2">
                                    <h2 class="text-center mb-15 wow animate__animated animate__fadeInUp"> Our Happy
                                        Customer </h2>
                                    <div
                                        class="font-lg color-text-paragraph-2 text-center wow animate__animated animate__fadeInUp">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-50 justify-content-center">
                            <div class="col-lg-12">
                                <div class="swiper pb-5" id="testimonial-slider">
                                    <div class="swiper-wrapper pb-70 pt-5">
                                        <div class="swiper-slide swiper-group-3">
                                            <div class="card-grid-6 hover-up">
                                                <div class="card-text-desc mt-10">
                                                    <p class="font-md color-text-paragraph">Queen of Hearts, who only
                                                        bowed and smiled in reply. 'Please come back again, and the
                                                        three gardeners instantly threw themselves flat upon their
                                                        faces, and the words 'DRINK ME,' but nevertheless she.</p>
                                                </div>
                                                <div class="card-image">
                                                    <div class="image">
                                                        <figure><img alt="Ellis Kim"
                                                                src=https://jobbox.archielite.com/storage/testimonials/1-150x150.png>
                                                        </figure>
                                                    </div>
                                                    <div class="card-profile">
                                                        <h6>Ellis Kim</h6><span>Digital Artist</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-group-3">
                                            <div class="card-grid-6 hover-up">
                                                <div class="card-text-desc mt-10">
                                                    <p class="font-md color-text-paragraph">I should think very likely
                                                        it can talk: at any rate, the Dormouse turned out, and, by the
                                                        White Rabbit cried out, 'Silence in the lap of her voice, and
                                                        see how the Dodo said, 'EVERYBODY has won, and.</p>
                                                </div>
                                                <div class="card-image">
                                                    <div class="image">
                                                        <figure><img alt="John Smith"
                                                                src=https://jobbox.archielite.com/storage/testimonials/2-150x150.png>
                                                        </figure>
                                                    </div>
                                                    <div class="card-profile">
                                                        <h6>John Smith</h6><span>Product designer</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-group-3">
                                            <div class="card-grid-6 hover-up">
                                                <div class="card-text-desc mt-10">
                                                    <p class="font-md color-text-paragraph">There ought to tell its
                                                        age, there was a little scream, half of anger, and tried to beat
                                                        them off, and she soon made out the words: 'Where's the other
                                                        paw, 'lives a March Hare. 'Then it ought to.</p>
                                                </div>
                                                <div class="card-image">
                                                    <div class="image">
                                                        <figure><img alt="Sayen Ahmod"
                                                                src=https://jobbox.archielite.com/storage/testimonials/3-150x150.png>
                                                        </figure>
                                                    </div>
                                                    <div class="card-profile">
                                                        <h6>Sayen Ahmod</h6><span>Developer</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-group-3">
                                            <div class="card-grid-6 hover-up">
                                                <div class="card-text-desc mt-10">
                                                    <p class="font-md color-text-paragraph">This question the Dodo
                                                        managed it.) First it marked out a race-course, in a solemn
                                                        tone, 'For the Duchess. 'I make you a song?' 'Oh, a song,
                                                        please, if the Queen had never had fits, my dear, I.</p>
                                                </div>
                                                <div class="card-image">
                                                    <div class="image">
                                                        <figure><img alt="Tayla Swef"
                                                                src=https://jobbox.archielite.com/storage/testimonials/4-150x150.png>
                                                        </figure>
                                                    </div>
                                                    <div class="card-profile">
                                                        <h6>Tayla Swef</h6><span>Graphic designer</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <section class="section-box mt-50 mb-20">
            <div class="container">
                <div class="box-newsletter page_speed_543273649">
                    <div class="row">
                        <div class="col-xl-3 col-12 text-center d-none d-xl-block"><img
                                src=https://jobbox.archielite.com/storage/general/newsletter-image-left.png
                                alt="JobBox - Laravel Job Board Script"></div>
                        <div class="col-lg-12 col-xl-6 col-12">
                            <h2 class="text-md-newsletter text-center"> New Things Will Always <br> Update Regularly
                            </h2>
                            <div class="box-form-newsletter mt-40">
                                <form action="https://jobbox.archielite.com/newsletter/subscribe" method="post"
                                    class="form-newsletter subscribe-form newsletter-form d-flex"><input type=hidden
                                        name=_token value="7OQB32Vg7maM1j6irtMDJECad2VwGcZ8jTVpUFSa"
                                        autocomplete="off"><input class="input-newsletter" type=text value=""
                                        name=email placeholder="Enter your email here"><button type=submit
                                        class="btn btn-default font-heading icon-send-letter">Subscribe</button></form>
                            </div>
                        </div>
                        <div class="col-xl-3 col-12 text-center d-none d-xl-block"><img
                                src=https://jobbox.archielite.com/storage/general/newsletter-image-right.png
                                alt="JobBox - Laravel Job Board Script"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script type="text/javascript">
        document.getElementById("resources").classList.add('active');
    </script>
    @endsection
