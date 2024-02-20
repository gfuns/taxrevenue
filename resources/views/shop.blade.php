@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Shop ')
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
                    style="background:url({{ asset('files/pages/Search.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="mb-10" style="color:#fff">Our Shop</h2>
                                <span class=" font-regular text-white">Shop for products you love with ease</span>
                            </div>
                            <div class="col-lg-3 text-md-end">
                                <ul class="breadcrumbs ">
                                    <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                            Home </a></li>
                                    <li><a href="/shop-now">Shop</a></li>
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
                                        <div class="col-xl-8 col-lg-8 jobs-listing-container">
                                            <aside class="col-lg-8 widget widget_search mb-10">
                                                <div class="search-form">
                                                    <form role="search" method="GET" action="">
                                                        <input type=text placeholder="Search..."
                                                            value="{{ $search }}" name=q><button type=submit><i
                                                                class="fi-rr-search"></i></button>
                                                    </form>
                                                </div>
                                            </aside>
                                            {{-- <span
                                                class="text-small text-showing showing-of-results"> Showing 1-12 of
                                                51 Product(s) </span> --}}
                                        </div>
                                        <div class="col-xl-4 col-lg-4 text-lg-end mt-sm-15 d-none d-lg-block">
                                            <div class="display-flex2">
                                                <div class="box-border"><span class="text-sort_by">Sort by:</span>
                                                    <div class="dropdown dropdown-sort"><button
                                                            class="btn dropdown-toggle" id="dropdownSort2" type=button
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            data-bs-display="static"><span>Newest</span><i
                                                                class="fi-rr-angle-small-down"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-light"
                                                            aria-labelledby="dropdownSort2">
                                                            <li><a class="dropdown-item @if ($filter == 'desc') active @endif"
                                                                    href="{{ url()->current() }}?filter=desc"> Newest
                                                                </a>
                                                            </li>
                                                            <li><a class="dropdown-item @if ($filter == 'asc') active @endif"
                                                                    href="{{ url()->current() }}?filter=asc"> Oldest
                                                                </a>
                                                            </li>
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
                                                                    <a href="{{ $prod->affiliate_link }}"
                                                                        target="_blank">
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

                                    @if (count($products) < 1)
                                        <div class="col-xl-12 col-12 job-items job-empty">
                                            <div class="text-center mt-4"><i class="fi fi-rr-sad text-3xl"></i>
                                                <h3 class="mt-2">No Product</h3>
                                                <div class="mt-2 text-muted"> There are no products found with your
                                                    queries. </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    @if (count($products) > 0 && $marker != null)
                        <div class="paginationssss">
                            <div class="row g-2 pt-3 ms-4 me-4">
                                <div class="col-md-9 mt-2">
                                    Showing {{ $marker['begin'] }} to {{ $marker['end'] }} of
                                    {{ number_format($lastRecord) }} Records
                                </div>

                                <div class="col-md-3">{{ $products->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </section>
        </div>
    </div>

</main>

<script type="text/javascript">
    document.getElementById("shop").classList.add('active');
</script>

@endsection
