@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Artisans ')
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
            <div class="container candidates-list">
                <section class="section-box-2">
                    <div class="container">
                        <div class="banner-hero banner-company">
                            <div class="block-banner text-center">
                                <h3 class="wow animate__animated animate__fadeInUp">Browse <span
                                        style="color:#FEBA00">Artisans</span></h3>
                                <div class="font-sm color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp"
                                    data-wow-delay=".1s">Thousands of Professional Artisians Available to be Hired for
                                    Jobs in their specialized Niches.</div>
                                <div class="box-list-character">
                                    <ul>
                                        <li><a href="/artisans?filter=A" class="keyword">a</a>
                                        </li>
                                        <li><a href="/artisans?filter=B" class="keyword ">b</a>
                                        </li>
                                        <li><a href="/artisans?filter=C" class="keyword ">c</a>
                                        </li>
                                        <li><a href="/artisans?filter=D" class="keyword ">d</a>
                                        </li>
                                        <li><a href="/artisans?filter=E" class="keyword ">e</a>
                                        </li>
                                        <li><a href="/artisans?filter=F" class="keyword ">f</a>
                                        </li>
                                        <li><a href="/artisans?filter=G" class="keyword ">g</a>
                                        </li>
                                        <li><a href="/artisans?filter=H" class="keyword ">h</a>
                                        </li>
                                        <li><a href="/artisans?filter=I" class="keyword ">i</a>
                                        </li>
                                        <li><a href="/artisans?filter=J" class="keyword ">j</a>
                                        </li>
                                        <li><a href="/artisans?filter=K" class="keyword ">k</a>
                                        </li>
                                        <li><a href="/artisans?filter=L" class="keyword ">l</a>
                                        </li>
                                        <li><a href="/artisans?filter=M" class="keyword ">m</a>
                                        </li>
                                        <li><a href="/artisans?filter=N" class="keyword ">n</a>
                                        </li>
                                        <li><a href="/artisans?filter=O" class="keyword ">o</a>
                                        </li>
                                        <li><a href="/artisans?filter=P" class="keyword ">p</a>
                                        </li>
                                        <li><a href="/artisans?filter=Q" class="keyword ">q</a>
                                        </li>
                                        <li><a href="/artisans?filter=R" class="keyword ">r</a>
                                        </li>
                                        <li><a href="/artisans?filter=S" class="keyword ">s</a>
                                        </li>
                                        <li><a href="/artisans?filter=T" class="keyword ">t</a>
                                        </li>
                                        <li><a href="/artisans?filter=U" class="keyword ">u</a>
                                        </li>
                                        <li><a href="/artisans?filter=V" class="keyword ">v</a>
                                        </li>
                                        <li><a href="/artisans?filter=W" class="keyword ">w</a>
                                        </li>
                                        <li><a href="/artisans?filter=X" class="keyword ">x</a>
                                        </li>
                                        <li><a href="/artisans?filter=Y" class="keyword ">y</a>
                                        </li>
                                        <li><a href="/artisans?filter=Z" class="keyword ">z</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mt-30">
                    <div class="container position-relative">
                        <div class="content-page">

                            <div class="box-filters-job">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-5"><span class="text-small text-showing"> Showing
                                            1-12 of 56 artisan(s) </span></div>
                                    <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                                        <div class="display-flex2">

                                            <div class="box-border"><span class="text-sort_by">Sort by:</span>
                                                <div class="dropdown dropdown-sort"><button
                                                        class="btn dropdown-toggle" id="dropdownSort2" type=button
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        data-bs-display="static"><span>Newest</span><i
                                                            class="fi-rr-angle-small-down"></i></button>
                                                    <ul class="dropdown-menu js-dropdown-clickable dropdown-menu-light"
                                                        aria-labelledby="dropdownSort2">
                                                        <li><a class="dropdown-item dropdown-sort-by active"
                                                                data-sort-by="newest" href="#"> Newest </a>
                                                        </li>
                                                        <li><a class="dropdown-item dropdown-sort-by"
                                                                data-sort-by="oldest" href="#"> Oldest </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row candidate-list">
                                @foreach ($candidates as $art)
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd"><a
                                                        href="/artisan/details/{{ $art->slug }}">
                                                        <figure><img alt="#" src="{{ $art->customer->photo }}">
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="/artisan/details/{{ $art->slug }}">
                                                        <h5>{{ $art->customer->first_name . ' ' . $art->customer->last_name }}
                                                        </h5>
                                                    </a><span
                                                        class="font-xs color-text-mutted text-truncate">{{ $art->profession }}</span>
                                                </div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2 truncate-text">
                                                    {{$art->biography }} </p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    {{ $art->customer->country }} </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5">
                                                                @php
                                                                    $unrated = (5 - $art->rating);
                                                                @endphp
                                                                @for ($i = 1; $i <= $art->rating; $i++)
                                                                    <img alt="star" class="rating-star"
                                                                        src="{{ asset('themes/jobbox/imgs/template/icons/star.svg') }}">
                                                                @endfor

                                                                @for ($i = 1; $i <= $unrated; $i++)
                                                                    <img alt="star" class="rating-star"
                                                                        src="{{ asset('themes/jobbox/imgs/template/icons/gray-star.svg') }}">
                                                                @endfor
                                                                <span class="font-xs color-text-mutted ml-5">
                                                                    <span>(</span><span>{{ $art->artsanReviews->count() }}</span><span>)</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="paginations">
                                        <ul class="pager">
                                            <li><a class="pager-prev pagination-button text-center"
                                                    href="javascript:void(0)" tabindex="-1"><i
                                                        class="fi fi-rr-arrow-small-left btn-prev"></i></a></li>
                                            <li><a class="pager-number active" href="javascript:void(0)">1</a></li>
                                            <li><a class="pager-number pagination-button" data-page="2"
                                                    href="https://jobbox.archielite.com/candidates?page=2">2</a></li>
                                            <li><a class="pager-number pagination-button" data-page="3"
                                                    href="https://jobbox.archielite.com/candidates?page=3">3</a></li>
                                            <li><a class="pager-number pagination-button" data-page="4"
                                                    href="https://jobbox.archielite.com/candidates?page=4">4</a></li>
                                            <li><a class="pager-number pagination-button" data-page="5"
                                                    href="https://jobbox.archielite.com/candidates?page=5">5</a></li>
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
    document.getElementById("artisans").classList.add('active');
</script>

@endsection
