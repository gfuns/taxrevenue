@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Contact Us')
<main class="main">
    <section class="section-box">
        <div class="breadcrumb-cover bg-img-about page_speed_389113925"
            style="background:url({{ asset('files/pages/background-breadcrumb.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="mb-10">Contact</h2>
                        <p class="font-lg color-text-paragraph-2">Get the latest news, updates and tips</p>
                    </div>
                    <div class="col-lg-6 text-md-end">
                        <ul class="breadcrumbs mt-40 ">
                            <li><a href="https://jobbox.archielite.com"><span class="fi-rr-home icon-home"></span>
                                    Home </a></li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ck-content">
        <div>
            <section class="section-box mt-80">
                <div class="container">
                    <div class="box-info-contact">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <h6>Head Office</h6>
                                <div class="font-sm color-text-paragraph">205 North Michigan Avenue, Suite 810
                                    Chicago, 60601, US <br> Phone: 0543213336 <br> Email: info@areteplanet.com</a>
                                </div><a class="text-uppercase color-brand-2 link-map"
                                    href="https://maps.google.com/?q=Army Post Service House Scheme, Kurudu, Abuja"
                                    target="_blank">View
                                    map</a>
                            </div>
                            <div class="col-1 mb-4"></div>
                            <div class="col-lg-8 col-md-6 sm-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <h6>London Office</h6>
                                        <p class="font-sm color-text-paragraph mb-20"> 2118 Thornridge Cir.
                                            Syracuse, Connecticut 35624 </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <h6>New York Office</h6>
                                        <p class="font-sm color-text-paragraph mb-20"> 4517 Washington Ave.
                                            Manchester, Kentucky 39495 </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <h6>Chicago Office</h6>
                                        <p class="font-sm color-text-paragraph mb-20"> 3891 Ranchview Dr.
                                            Richardson, California 62639 </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <h6>San Francisco Office</h6>
                                        <p class="font-sm color-text-paragraph mb-20"> 4140 Parker Rd. Allentown,
                                            New Mexico 31134 </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <h6>Sydney Office</h6>
                                        <p class="font-sm color-text-paragraph mb-20"> 3891 Ranchview Dr.
                                            Richardson, California 62639 </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <h6>Singapore Office</h6>
                                        <p class="font-sm color-text-paragraph mb-20"> 4140 Parker Rd. Allentown,
                                            New Mexico 31134 </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <h6></h6>
                                        <p class="font-sm color-text-paragraph mb-20"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div>
            <section class="section-box mt-70">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mb-40"><span class="font-md color-brand-2 mt-20 d-inline-block">Contact
                                us</span>
                            <h2 class="mt-5 mb-10">Get in touch</h2>
                            <p class="font-md color-text-paragraph-2">The right move at the right time saves your
                                investment. live the dream of expanding your business.</p>
                            <form class="contact-form-style contact-form mt-30"
                                action="{{ route('processContactForm') }}" method="post">
                                @csrf
                                <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input class="font-sm color-text-paragraph-2" name="name"
                                                placeholder="Enter your name" type=text value="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input class="font-sm color-text-paragraph-2" name="email"
                                                placeholder="Your email" type="email" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="input-style mb-20">
                                            <input class="font-sm color-text-paragraph-2" name="subject"
                                                placeholder="Subject" type="text" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="textarea-style mb-30">
                                            <textarea class="font-sm color-text-paragraph-2" name="message" placeholder="Your Message"></textarea>
                                        </div>
                                        <button class="submit btn btn-send-message" type=submit>Send
                                            Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>

</main>
@endsection


@section('customjs')

<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':

                toastr.options.timeOut = 10000;
                toastr.info("{{ Session::get('message') }}");
                var audio = new Audio('audio.wav');
                audio.play();
                break;
            case 'success':

                toastr.options.timeOut = 10000;
                toastr.success("{{ Session::get('message') }}");
                var audio = new Audio('audio.wav');
                audio.play();

                break;
            case 'warning':

                toastr.options.timeOut = 10000;
                toastr.warning("{{ Session::get('message') }}");
                var audio = new Audio('audio.wav');
                audio.play();

                break;
            case 'error':

                toastr.options.timeOut = 10000;
                toastr.error("{{ Session::get('message') }}");
                var audio = new Audio('audio.wav');
                audio.play();

                break;
        }
    @endif
</script>

@endsection
