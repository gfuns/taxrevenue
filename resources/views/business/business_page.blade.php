@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Business Page Setup')
<style type="text/css">
    .tbi {
        max-height: 8rem;
        max-width: 29rem;

    }

    .sbi {
        max-height: 8rem;
        max-width: 14rem;

    }

    .remove {
        position: absolute;
        top: -80px;
        right: -6px;
        width: auto;
        max-width: 100%;
    }

    .remove .btn {
        padding: 0;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #eaeaea;
    }

    @media (max-width:576px) {
        .tbi {
            max-height: 6rem;
            max-width: 17rem;

        }

        .sbi {
            max-height: 8rem;
            max-width: 16rem;

        }
    }
</style>

<!-- Container fluid -->
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Business Page Setup</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Business Page Setup</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h4">Top Banner (1920px X 360px)</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{ route('business.updateTopBanner') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="business_id" value="{{ $business->id }}">

                        <div class="row mb-3">
                            <div class="col-md-5 col-12 mb-3">
                                <input type="file" name="top_banner" class="form-control" />
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-primary"
                                        onClick = "this.disabled=true; this.innerHTML='Uploading file...';this.form.submit();">Update
                                        Banner</button>
                                </div>
                            </div>
                        </div>

                        @if (isset($topBanner))
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="mt-3">
                                        <!-- logo -->
                                        <div class="icon-shape icon-tb border rounded position-relative mb-3">
                                            <span class="position-absolute">
                                                <img class="tbi" alt="avatar" src="{{ $topBanner->file_url }}">
                                            </span>

                                            <div class="remove">
                                                <a href="{{ route("business.removePageFile", [$topBanner->id]) }}" onclick="return confirm('Are you sure you want to delete this file?');"><button class="btn btn-sm  remove-attachment"
                                                        type="button"><i class="fe fe-x"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted">We had to limit height to maintian consistancy. In some
                                        device
                                        both side of the banner might be cropped for height limitation.</small>
                                </div>

                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="card mt-6">
                <div class="card-header">
                    <h5 class="mb-0 h4">Slider Banners (1500px X 450px)</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{ route('business.uploadSliderBanner') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="business_id" value="{{ $business->id }}">

                        <div class="row mb-3">
                            <div class="col-md-5 col-12 mb-3">
                                <input type="file" name="slider_banner" class="form-control" />
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-primary"
                                        onClick = "this.disabled=true; this.innerHTML='Uploading file...';this.form.submit();">Upload
                                        Banner</button>
                                </div>
                            </div>
                        </div>

                        @if (count($sliderBanners) > 0)
                            <!-- Slider Banners -->
                            <div class="row mb-3 ">
                                <div class="col-12">
                                    <div class="mt-3">
                                        <!-- logo -->
                                        @foreach ($sliderBanners as $slider)
                                            <div
                                                class="icon-shape icon-slider border rounded position-relative me-3 mb-3">
                                                <span class="position-absolute">
                                                    <img class="sbi" alt="avatar" src="{{ $slider->file_url }}">
                                                </span>

                                                <div class="remove">
                                                    <a href="{{ route("business.removePageFile", [$slider->id]) }}" onclick="return confirm('Are you sure you want to delete this file?');"><button class="btn btn-sm  remove-attachment"
                                                            type="button"><i class="fe fe-x"></i></button></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="text-muted">We had to limit height to maintian consistancy. In some
                                        device
                                        both side of the banner might be cropped for height limitation.</small>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="card mt-6">
                <div class="card-header">
                    <h5 class="mb-0 h4">Business Catalogue</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{ route('business.uploadCatalogue') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="business_id" value="{{ $business->id }}">

                        <div class="row mb-3">
                            <div class="col-md-5 col-12 mb-3">
                                <input type="file" name="catalogue_image" class="form-control" />
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-primary"
                                        onClick = "this.disabled=true; this.innerHTML='Uploading file...';this.form.submit();">Upload
                                        Catalogue Image</button>
                                </div>
                            </div>
                        </div>

                        <!-- Slider Banners -->
                        <!-- logo -->
                        @if (count($catalogues) > 0)
                            <!-- Slider Banners -->
                            <div class="row mb-3 ">
                                <div class="col-12">
                                    <div class="mt-3">
                                        <!-- logo -->
                                        @foreach ($catalogues as $cat)
                                            <div
                                                class="icon-shape icon-xxl border rounded position-relative me-3 mb-3">
                                                <span class="position-absolute">
                                                    <img class="sbi" alt="avatar" src="{{ $cat->file_url }}">
                                                </span>

                                                <div class="remove">
                                                    <a href="{{ route("business.removePageFile", [$cat->id]) }}" onclick="return confirm('Are you sure you want to delete this file?');"><button class="btn btn-sm  remove-attachment"
                                                            type="button"><i class="fe fe-x"></i></button></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="text-muted">We had to limit height to maintian
                                        consistancy. In some
                                        device
                                        both side of the banner might be cropped for height
                                        limitation.</small>
                                </div>
                            </div>
                        @endif




                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("page").classList.add('active');
</script>

@endsection

@section('customjs')
<script>
    // Function to show or hide the custom text field based on selection
    function showHideTextField() {
        var selectBox = document.getElementById("category");
        var textDiv = document.getElementById("customOption");
        var textField = document.getElementById("customField");

        if (selectBox.value === "Others") {
            textDiv.style.display = "block";
            textField.setAttribute("required", true);
        } else {
            textDiv.style.display = "none";
        }
    }
</script>
@endsection
