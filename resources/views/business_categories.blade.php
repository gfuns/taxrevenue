@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Business Categories ')

<main class="main">
    <div class="ck-content">
        <div>
            <section class="section-box">
                <div class="breadcrumb-cover page_speed_160581955"
                    style="background:url({{ asset('files/pages/Search.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2 class="mb-10" style="color:#fff">Business Categories</h2>
                            </div>
                            <div class="col-lg-6 text-md-end">
                                <ul class="breadcrumbs ">
                                    <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                            Home </a></li>
                                    <li><a href="/business-categories">Categories</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div>
            <section class="section-box mt-80" style="margin-bottom: 270px">
                <div class="section-box wow animate__animated animate__fadeIn">
                    <div class="container">
                        <div class="text-start pb-30">
                            <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp"> Business Categories
                            </h2>
                            <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp"> </p>
                        </div>
                        <div class="row job-categories">
                            @foreach ($categories as $cat)
                                <div class="col-xl-3 col-sm-1 col-xs-1"><a href="/business-categories/{{ $cat->slug }}">
                                        <div class="item-logo">
                                            <div class="image-left"><img src="{{ $cat->category_icon == null ? "https://res.cloudinary.com/soha/image/upload/v1701601099/fvnn5nrxg9m4di9jjrux.png" :  $cat->category_icon}}" alt="#"
                                                    style="width: 42px"></div>
                                            <div class="text-info-right">
                                                <h6
                                                    style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 200px;">
                                                    {{ ucwords($cat->category_name) }}</h6>
                                                <p class="font-xs"> {{ $cat->businesses }}
                                                    <span> Listing(s) Available </span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>

</main>


@endsection
