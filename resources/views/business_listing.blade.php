@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Businesses ')
<style>
    .truncate-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* Limit to 3 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: normal;
        /* Use 'normal' to allow wrapping */
        text-overflow: ellipsis;
    }

    .trim-text {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* Limit to 3 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: normal;
        /* Use 'normal' to allow wrapping */
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
                                <h3 class="wow animate__animated animate__fadeInUp">Our Comprehensive <span
                                        style="color:#FEBA00"> Business Directory</span></h3>
                                <div class="font-md color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp"
                                    data-wow-delay=".1s">Discover Your Next Favorite Business Today: Search, Explore,
                                    Connect!</div>

                                <div class="banner-inner" style="margin:auto; max-width: 1000px; text-align:left">

                                    <div class="form-find position-relative mt-40 wow animate__animated animate__fadeIn"
                                        data-wow-delay=".2s">
                                        <form method="GET" action="" accept-charset="UTF-8">
                                            <select id="myloc" class="form-input mr-10" name="location">
                                                <option value="">Location</option>
                                                <option value="Abia"
                                                    @if ($location == 'Abia') selected @endif>
                                                    Abia
                                                </option>
                                                <option value="Abuja (FCT)"
                                                    @if ($location == 'Abuja (FCT)') selected @endif>
                                                    Abuja - Federal Capital Territory</option>
                                                <option value="Adamawa"
                                                    @if ($location == 'Adamawa') selected @endif>
                                                    Adamawa</option>
                                                <option value="Akwa Ibom"
                                                    @if ($location == 'Akwa Ibom') selected @endif>
                                                    Akwa
                                                    Ibom</option>
                                                <option value="Anambra"
                                                    @if ($location == 'Anambra') selected @endif>
                                                    Anambra</option>
                                                <option value="Bauchi"
                                                    @if ($location == 'Bauchi') selected @endif>
                                                    Bauchi
                                                </option>
                                                <option value="Bayelsa"
                                                    @if ($location == 'Bayelsa') selected @endif>
                                                    Bayelsa</option>
                                                <option value="Benue"
                                                    @if ($location == 'Benue') selected @endif>
                                                    Benue
                                                </option>
                                                <option value="Borno"
                                                    @if ($location == 'Borno') selected @endif>
                                                    Borno
                                                </option>
                                                <option value="Cross River"
                                                    @if ($location == 'Cross River') selected @endif>
                                                    Cross River</option>
                                                <option value="Delta"
                                                    @if ($location == 'Delta') selected @endif>
                                                    Delta
                                                </option>
                                                <option value="Ebonyi"
                                                    @if ($location == 'Ebonyi') selected @endif>
                                                    Ebonyi</option>
                                                <option value="Edo"
                                                    @if ($location == 'Edo') selected @endif>
                                                    Edo
                                                </option>
                                                <option value="Ekiti"
                                                    @if ($location == 'Ekiti') selected @endif>
                                                    Ekiti
                                                </option>
                                                <option value="Enugu"
                                                    @if ($location == 'Enugu') selected @endif>
                                                    Enugu
                                                </option>
                                                <option value="Gombe"
                                                    @if ($location == 'Gombe') selected @endif>
                                                    Gombe
                                                </option>
                                                <option value="Imo"
                                                    @if ($location == 'Imo') selected @endif>
                                                    Imo
                                                </option>
                                                <option value="Jigawa"
                                                    @if ($location == 'Jigawa') selected @endif>
                                                    Jigawa</option>
                                                <option value="Kaduna"
                                                    @if ($location == 'Kaduna') selected @endif>
                                                    Kaduna</option>
                                                <option value="Kano"
                                                    @if ($location == 'Kano') selected @endif>
                                                    Kano
                                                </option>
                                                <option value="Katsina"
                                                    @if ($location == 'Katsina') selected @endif>
                                                    Katsina</option>
                                                <option value="Kebbi"
                                                    @if ($location == 'Kebbi') selected @endif>
                                                    Kebbi
                                                </option>
                                                <option value="Kogi"
                                                    @if ($location == 'Kogi') selected @endif>
                                                    Kogi
                                                </option>
                                                <option value="kwara"
                                                    @if ($location == 'Kwara') selected @endif>
                                                    Kwara
                                                </option>
                                                <option value="Lagos"
                                                    @if ($location == 'Lagos') selected @endif>
                                                    Lagos
                                                </option>
                                                <option value="Nassarawa"
                                                    @if ($location == 'Nassarawa') selected @endif>
                                                    Nassarawa</option>
                                                <option value="Niger"
                                                    @if ($location == 'Niger') selected @endif>
                                                    Niger
                                                </option>
                                                <option value="Ogun"
                                                    @if ($location == 'Ogun') selected @endif>
                                                    Ogun
                                                </option>
                                                <option value="Ondo"
                                                    @if ($location == 'Ondo') selected @endif>
                                                    Ondo
                                                </option>
                                                <option value="Osun"
                                                    @if ($location == 'Osun') selected @endif>
                                                    Osun
                                                </option>
                                                <option value="Oyo"
                                                    @if ($location == 'Oyo') selected @endif>
                                                    Oyo
                                                </option>
                                                <option value="Plateau"
                                                    @if ($location == 'Plateau') selected @endif>
                                                    Plateau</option>
                                                <option value="Rivers"
                                                    @if ($location == 'Rivers') selected @endif>
                                                    Rivers</option>
                                                <option value="Sokoto"
                                                    @if ($location == 'Sokoto') selected @endif>
                                                    Sokoto</option>
                                                <option value="Taraba"
                                                    @if ($location == 'Taraba') selected @endif>
                                                    Taraba</option>
                                                <option value="Yobe"
                                                    @if ($location == 'Yobe') selected @endif>
                                                    Yobe
                                                </option>
                                                <option value="Zamfara"
                                                    @if ($location == 'Zamfara') selected @endif>
                                                    Zamfara</option>

                                            </select>

                                            <input class="form-input input-keysearch mr-10" name="keyword"
                                                value="{{ $keyword }}" type=text
                                                placeholder="Business Name or industry...">
                                            <div class="search-btn-group"><button
                                                    class="btn btn-default btn-find font-sm">Search</button>
                                            </div>
                                        </form>
                                    </div>

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
                                    <div class="box-filters-job d-none d-lg-block">
                                        <div class="row ">
                                            <div class="col-xl-6 col-lg-5"><span
                                                    class="text-small text-showing font-weight-bold"> Showing
                                                    {{ $marker['begin'] }} to {{ $marker['end'] }} of
                                                    {{ number_format($lastRecord) }} Records </span></div>
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
                                                            <ul class="dropdown-menu dropdown-menu-light"
                                                                aria-labelledby="dropdownSort2">
                                                                <li><a class="dropdown-item @if ($filter == 'desc') active @endif"
                                                                        href="{{ url()->current() }}?filter=desc">
                                                                        Newest </a></li>
                                                                <li><a class="dropdown-item @if ($filter == 'asc') active @endif"
                                                                        href="{{ url()->current() }}?filter=asc"> Oldest
                                                                    </a></li>
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
                                                                        src="{{ $biz->business_logo }}" alt="#">
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
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
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
            </div>
        </div>
    </div>

</main>

<script type="text/javascript">
    document.getElementById("businesses").classList.add('active');
</script>
@endsection
