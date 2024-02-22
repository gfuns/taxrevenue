@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Mini Store')
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
<!-- Container fluid -->
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Mini Store</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mini Store</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <!-- row -->
        <div class="row justify-content-between">
            <form id="form" name="form" method="GET">
                <div class=" row gx-3">
                    <!-- Form -->
                    <div class="col-12 col-lg-9 mb-3 mb-lg-0">
                        <!-- search -->

                        <div class="d-flex align-items-center">
                            <span class="position-absolute ps-3 search-icon">
                                <i class="fe fe-search"></i>
                            </span>
                            <!-- input -->
                            <input name="q" type="search" class="form-control ps-6"
                                placeholder="Search Products......" value="{{ $search }}">
                        </div>

                    </div>
                    <div class="col-6 col-lg-3">
                        <!-- form select -->
                        <select id="status" name="filter" class="form-select" aria-label="Default select example"
                            onChange="this.form.submit()">
                            <option value="desc" @if ($filter == 'desc') selected @endif>Sort by Newest
                                Products</option>
                            <option value="asc" @if ($filter == 'asc') selected @endif>Sort by Oldest
                                Products</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4">

        @foreach ($products as $prod)
            <div class="col mb-4">
                <!-- card -->
                <div class="card h-100">
                    <div class="align-items-center pt-5">
                        <a href="{{ $prod->affiliate_link }}" target="_blank">
                            <!-- img -->
                            <center><img src="{{ $prod->thumbnail }}" alt="" class="img-fluid rounded-top-md"
                                    style=" height: 23vh;"></center>
                        </a>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <div class="mb-4">
                            <h6><a href="{{ $prod->affiliate_link }}" target="_blank"
                                    class="text-inherit">{{ $prod->product_name }}</a></h6>
                        </div>
                        <h5 class="mb-0 text-muted" style="text-decoration: line-through;">
                            {{ $prod->currency }}{{ number_format($prod->original_price, 2) }}</h5>
                        <div class="d-flex justify-content-between">
                            <!-- heading -->
                            <h5 class="mb-0">{{ $prod->currency }}{{ number_format($prod->discounted_price, 2) }}</h5>
                            <!-- color -->
                            <a href="{{ $prod->affiliate_link }}" target="_blank">
                                <div class="btn btn-xs btn-primary">Buy Product</div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (count($products) < 1)
        <div class="col-xl-12 col-12 job-items job-empty">
            <div class="text-center mt-4"><i class="bi bi-emoji-frown" style="font-size: 48px"></i>
                <h3 class="mt-2">No Product</h3>
                <div class="mt-2 text-muted"> There are no products found with your
                    queries. </div>
            </div>
        </div>
    @endif

    @if (count($products) > 0 && $marker != null)
        <div class="card-footer">
            <div class="row g-2 pt-3 ms-4 me-4">
                <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                    of
                    {{ number_format($lastRecord) }} Records</div>

                <div class="col-md-3">{{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
<script type="text/javascript">
    document.getElementById("store").classList.add('active');
</script>

@endsection
