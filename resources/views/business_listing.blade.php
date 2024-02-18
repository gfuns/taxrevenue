@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Businesses ')
<style>
    .truncate-text {
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Limit to 3 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: normal; /* Use 'normal' to allow wrapping */
        text-overflow: ellipsis;
    }
</style>
<main class="main">
    <div class="ck-content">
        <div>
            <div class="companies-list">
                <section class="section-box-2">
                    <div class="container">
                        <div class="banner-hero banner-company">
                            <div class="block-banner text-center">
                                <h3 class="wow animate__animated animate__fadeInUp">Browse <span
                                        style="color:#FEBA00">Businesses</span></h3>
                                <div class="font-sm color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp"
                                    data-wow-delay=".1s">Thousands of jobs in the computer, engineering technology and
                                    other industries are waiting for you.</div>
                                <div class="box-list-character">
                                    <ul>
                                        <li><a href="/businesses?filter=A" class="keyword">a</a>
                                        </li>
                                        <li><a href="/businesses?filter=B" class="keyword ">b</a>
                                        </li>
                                        <li><a href="/businesses?filter=C" class="keyword ">c</a>
                                        </li>
                                        <li><a href="/businesses?filter=D" class="keyword ">d</a>
                                        </li>
                                        <li><a href="/businesses?filter=E" class="keyword ">e</a>
                                        </li>
                                        <li><a href="/businesses?filter=F" class="keyword ">f</a>
                                        </li>
                                        <li><a href="/businesses?filter=G" class="keyword ">g</a>
                                        </li>
                                        <li><a href="/businesses?filter=H" class="keyword ">h</a>
                                        </li>
                                        <li><a href="/businesses?filter=I" class="keyword ">i</a>
                                        </li>
                                        <li><a href="/businesses?filter=J" class="keyword ">j</a>
                                        </li>
                                        <li><a href="/businesses?filter=K" class="keyword ">k</a>
                                        </li>
                                        <li><a href="/businesses?filter=L" class="keyword ">l</a>
                                        </li>
                                        <li><a href="/businesses?filter=M" class="keyword ">m</a>
                                        </li>
                                        <li><a href="/businesses?filter=N" class="keyword ">n</a>
                                        </li>
                                        <li><a href="/businesses?filter=O" class="keyword ">o</a>
                                        </li>
                                        <li><a href="/businesses?filter=P" class="keyword ">p</a>
                                        </li>
                                        <li><a href="/businesses?filter=Q" class="keyword ">q</a>
                                        </li>
                                        <li><a href="/businesses?filter=R" class="keyword ">r</a>
                                        </li>
                                        <li><a href="/businesses?filter=S" class="keyword ">s</a>
                                        </li>
                                        <li><a href="/businesses?filter=T" class="keyword ">t</a>
                                        </li>
                                        <li><a href="/businesses?filter=U" class="keyword ">u</a>
                                        </li>
                                        <li><a href="/businesses?filter=V" class="keyword ">v</a>
                                        </li>
                                        <li><a href="/businesses?filter=W" class="keyword ">w</a>
                                        </li>
                                        <li><a href="/businesses?filter=X" class="keyword ">x</a>
                                        </li>
                                        <li><a href="/businesses?filter=Y" class="keyword ">y</a>
                                        </li>
                                        <li><a href="/businesses?filter=Z" class="keyword ">z</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section-box mt-30">
                    <div class="container">

                        <div class="row flex-row-reverse row-filter justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 company-listing">
                                <div class="content-page ">
                                    <div class="box-filters-job">
                                        <div class="row ">
                                            <div class="col-xl-6 col-lg-5"><span
                                                    class="text-small text-showing font-weight-bold"> Showing 1 –
                                                    12 of 20 Business(es) </span></div>
                                            <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                                                <div class="display-flex2">

                                                    <div class="box-border"><span class="text-sort_by">Sort
                                                            by:</span>
                                                        <div class="dropdown dropdown-sort"><button
                                                                class="btn dropdown-toggle" id="dropdownSort2"
                                                                type=button data-bs-toggle="dropdown"
                                                                aria-expanded="false"
                                                                data-bs-display="static"><span>Newest</span><i
                                                                    class="fi-rr-angle-small-down"></i></button>
                                                            <ul class="dropdown-menu js-dropdown-clickable dropdown-menu-light"
                                                                aria-labelledby="dropdownSort2">
                                                                <li><a class="dropdown-item dropdown-sort-by active"
                                                                        data-sort-by="newest" href="#">
                                                                        Newest </a></li>
                                                                <li><a class="dropdown-item dropdown-sort-by"
                                                                        data-sort-by="oldest" href="#">
                                                                        Oldest </a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row display-list">
                                        @foreach ($businesses as $biz)
                                            <div class="col-md-6 col-xl-3 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src="{{ $biz->business_logo }}"
                                                                        alt="#"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="/business/details/{{ $biz->slug }}">{{ $biz->business_name }}</a><span
                                                                        class="location-small">{{ $biz->country }},
                                                                        {{ $biz->city }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="card-block-info">
                                                        <p class="font-xs color-text-paragraph-2 truncate-text">
                                                            {{$biz->business_description }} </p>
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
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="/business/details/{{ $biz->slug }}">
                                                                            {{ $biz->jobListing->count() == 0 ? 'No' : $biz->jobListing->count() }}
                                                                            Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div class="paginations">
                                        <ul class="pager">
                                            <li><a class="pager-prev pagination-button text-center"
                                                    href="javascript:void(0)" tabindex="-1"><i
                                                        class="fi fi-rr-arrow-small-left btn-prev"></i></a></li>
                                            <li><a class="pager-number active" href="javascript:void(0)">1</a></li>
                                            <li><a class="pager-number pagination-button" data-page="2"
                                                    href="https://jobbox.archielite.com/companies?page=2">2</a></li>
                                            <li><a class="pager-next pagination-button text-center" data-page="2"
                                                    href="#"><i
                                                        class="fi fi-rr-arrow-small-right btn-next"></i></a></li>
                                        </ul>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

</main>

<script type="text/javascript">
    document.getElementById("businesses").classList.add('active');
</script>
@endsection
