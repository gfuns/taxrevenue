@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | FAQs ')
    <main class="main">
        <div class="ck-content">

            <div>
                <section class="section-box mt-50 mb-50">
                    <div class="container ">
                        <h2 class="text-center mb-15 wow animate__ animate__fadeInUp animated page_speed_1390205606">
                            Frequently Asked Questions </h2>
                        <div
                            class="font-lg color-text-paragraph-2 text-center wow animate__ animate__fadeInUp animated page_speed_1390205606">
                            Welcome to our FAQ page! Here, you'll find answers to common questions about our business directory platform. </div>
                        <div class="row mt-50">
                            @foreach ($faqList as $faq)
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div
                                    class="card-grid-border hover-up wow animate__ animate__fadeIn animated page_speed_2134450950">
                                    <h4 class="mb-20">{{ $faq->question }}</h4>
                                    <p class="font-sm mb-20 color-text-paragraph">{{ $faq->answer }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>

        </div>

    </main>
    @endsection
