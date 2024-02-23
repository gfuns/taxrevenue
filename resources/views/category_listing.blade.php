@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Jobs For ' . $category->category_name)

<main class="main">
    <section class="section-box">
        <div class="breadcrumb-cover page_speed_160581955" style="background:url({{ asset('files/pages/Search.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="mb-10" style="color:#fff">{{ ucwords($category->category_name) }}</h2>
                    </div>
                    <div class="col-lg-6 text-md-end">
                        <ul class="breadcrumbs ">
                            <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                    Home </a></li>
                            <li><a href="/business-categories">Categories</a></li>
                            <li>{{ $category->category_name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-30">
        <div class="container">
            <div class="row flex-row-reverse row-filter justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 row col-12 float-right jobs-listing">
                    <div class="content-page job-content-section">
                        <div class="box-filters-job">
                            <div class="row">
                                <div class="col-xl-6 col-lg-5 jobs-listing-container"><span
                                        class="text-small text-showing showing-of-results"> Showing
                                        {{ $marker['begin'] }} to {{ $marker['end'] }} of
                                        {{ number_format($lastRecord) }} Records
                                    </span></div>
                                <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                                    <div class="display-flex2">

                                        <div class="box-border"><span class="text-sort_by">Sort by:</span>
                                            <div class="dropdown dropdown-sort"><button class="btn dropdown-toggle"
                                                    id="dropdownSort2" type=button data-bs-toggle="dropdown"
                                                    aria-expanded="false" data-bs-display="static"><span>Newest</span><i
                                                        class="fi-rr-angle-small-down"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-light"
                                                    aria-labelledby="dropdownSort2">
                                                    <li><a class="dropdown-item @if ($filter == 'desc') active @endif"
                                                            href="{{ url()->current() }}?filter=desc"> Newest </a></li>
                                                    <li><a class="dropdown-item @if ($filter == 'asc') active @endif"
                                                            href="{{ url()->current() }}?filter=asc"> Oldest </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row showing-of-results">
                            @foreach ($businesses as $biz)
                                <div class="col-md-6 col-xl-3 col-12 company-list-item">
                                    <div class="card-grid-2 hover-up"><span class="flash"></span>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src="{{ $biz->business_logo }}"
                                                            alt="#">
                                                    </div>
                                                    <div class="right-info">
                                                        <div class="trim-text">
                                                            <a class="name-job"
                                                                href="/business/details/{{ $biz->slug }}">{{ $biz->business_name }}</a>
                                                        </div>
                                                        <div class="location-small">
                                                            {{ $biz->state }}, {{ $biz->country }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card-block-info">
                                            <p class="font-xs color-text-paragraph-2 truncate-text">
                                                {{ strip_tags($biz->business_description) }} </p>
                                            <div class="card-2-bottom mt-20">
                                                <div class="row">
                                                    <div class="col-lg-6 col-7">
                                                        <div class="mt-5">
                                                            @php
                                                                $unrated = 5 - $biz->rating;
                                                            @endphp
                                                            @for ($i = 1; $i <= $biz->rating; $i++)
                                                                <img alt="star" class="rating-star"
                                                                    src={{ asset('themes/jobbox/imgs/template/icons/star.svg') }}>
                                                            @endfor
                                                            @for ($i = 1; $i <= $unrated; $i++)
                                                                <img alt="star" class="rating-star"
                                                                    src="{{ asset('themes/jobbox/imgs/template/icons/gray-star.svg') }}">
                                                            @endfor

                                                            <span
                                                                class="font-xs color-text-mutted ml-5"><span>(</span><span>{{ $biz->reviews->count() }}</span><span>)</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-5 text-end">
                                                        <div class="text-start text-md-end"><a class="btn btn-apply-now"
                                                                href="/business/details/{{ $biz->slug }}">
                                                                Explore Business </a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if (count($businesses) < 1)
                                <div class="col-xl-12 col-12 job-items job-empty">
                                    <div class="text-center mt-4"><i class="fi fi-rr-sad text-3xl"></i>
                                        <h3 class="mt-2">No Business</h3>
                                        <div class="mt-2 text-muted"> There are no businesses found with
                                            your
                                            queries. </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if (count($businesses) > 0 && $marker != null)
                        <div class="paginationssss">
                            <div class="row g-2 pt-3 ms-4 me-4">
                                <div class="col-md-9 mt-2">
                                    Showing {{ $marker['begin'] }} to {{ $marker['end'] }} of
                                    {{ number_format($lastRecord) }} Records
                                </div>

                                <div class="col-md-3">
                                    {{ $businesses->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>

<script type="text/javascript">
    document.getElementById("findjobs").classList.add('active');
</script>
@endsection
