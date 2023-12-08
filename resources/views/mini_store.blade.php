@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Mini Store ')
<style>
    .centered-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        max-height: 100%;
    }
</style>
<main class="main">
    <div class="ck-content">
        <div>
            <section class="section-box">
                <div class="breadcrumb-cover page_speed_160581955"
                    style="background:url({{ asset('storage/pages/Search.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="mb-10" style="color:#fff">Mini Store</h2>
                                <span class=" font-regular text-white">Shop for products you love with ease</span>
                            </div>
                            <div class="col-lg-3 text-md-end">
                                <ul class="breadcrumbs ">
                                    <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                            Home </a></li>
                                    <li><a href="/mini-store">Mini Store</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div>
            <section class="section-box mt-30">
                <div class="container">
                    <div class="row row-filter">

                        <div class="col-12 col-lg-12 jobs-listing">
                            <div class="content-page job-content-section">
                                <div class="box-filters-job">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-5 jobs-listing-container"><span
                                                class="text-small text-showing showing-of-results"> Showing 1-12 of
                                                51 Product(s) </span></div>
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
                                                                    data-sort-by="newest" href="#"> Newest
                                                                </a></li>
                                                            <li><a class="dropdown-item dropdown-sort-by"
                                                                    data-sort-by="oldest" href="#"> Oldest
                                                                </a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row showing-of-results">
                                    @foreach ($products as $prod)
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 jobs-item job-grid">
                                            <div class="card-grid-2 hover-up ">
                                                <div class="card-grid-2-image-left">
                                                    {{-- <span class="flash"></span> --}}

                                                    <div class="product-box" style=" height: 25vh;">
                                                        <img class="centered-image" src="{{ $prod->thumbnail }}"
                                                            alt="#">
                                                    </div>

                                                </div>
                                                <div class="card-block-info">
                                                    <h6 class="" style="font-size: 14px"><a
                                                            href="{{ $prod->affiliate_link }}" target="_blank"
                                                            title="{{ $prod->product_name }}">{{ $prod->product_name }}</a>
                                                    </h6>

                                                    <div class="card-2-bottom mt-30">
                                                        <div class="row">
                                                            <div class="col-12 salary-information">
                                                                <span class="card-text-price">
                                                                    &#8358;{{ number_format($prod->discounted_price, 2) }}
                                                                </span><br />
                                                                <span class="text-muted"
                                                                    style="text-decoration: line-through;">&#8358;{{ number_format($prod->original_price, 2) }}</span>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <div class="">
                                                                    <a href="{{ $prod->affiliate_link }}" target="_blank">
                                                                        <button class="btn btn-apply-now"> Buy Now
                                                                        </button>
                                                                    </a>
                                                                </div>
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
                                    <li><a class="pager-prev pagination-button text-center" href="javascript:void(0)"
                                            tabindex="-1"><i class="fi fi-rr-arrow-small-left btn-prev"></i></a></li>
                                    <li><a class="pager-number active" href="javascript:void(0)">1</a></li>
                                    <li><a class="pager-number pagination-button" data-page="2"
                                            href="https://jobbox.archielite.com/jobs?layout=grid&amp;page=2">2</a>
                                    </li>
                                    <li><a class="pager-number pagination-button" data-page="3"
                                            href="https://jobbox.archielite.com/jobs?layout=grid&amp;page=3">3</a>
                                    </li>
                                    <li><a class="pager-number pagination-button" data-page="4"
                                            href="https://jobbox.archielite.com/jobs?layout=grid&amp;page=4">4</a>
                                    </li>
                                    <li><a class="pager-number pagination-button" data-page="5"
                                            href="https://jobbox.archielite.com/jobs?layout=grid&amp;page=5">5</a>
                                    </li>
                                    <li><a class="pager-next pagination-button text-center" data-page="2"
                                            href="#"><i class="fi fi-rr-arrow-small-right btn-next"></i></a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</main>

<script type="text/javascript">
    document.getElementById("resources").classList.add('active');
</script>

@endsection
