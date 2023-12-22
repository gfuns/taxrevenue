@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Job Assets')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 mb-2">
            <!-- Page header -->
            <div class="d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Job Assets</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route("business.jobListing") }}">Jobs</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.jobDetails', [$job->id]) }}">Jobs Details</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Job Assets</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12 mb-4">
            <!-- nav -->
            <ul class="nav nav-lb-tab">
                <li class="nav-item ms-0 me-3">
                    <a class="nav-link" href="{{ route('business.jobDetails', [$job->id]) }}">Overview</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link active" href="{{ route('business.jobAssets', [$job->id]) }}">Files and Assets</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('business.jobApplications', [$job->id]) }}">Applications</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-12">
            <!-- card -->
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="mb-0">Job Files and Assets</h4>
                </div>
                <!-- table -->
                <div class="table-responsive overflow-y-hidden">
                    <table class="table mb-0 text-nowrap table-hover table-centered">
                        <thead class="table-light">
                            <tr>
                                <th>Asset Name</th>
                                <th>File size</th>
                                <th>Date Uploaded</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobAssets as $asset)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="icon-shape icon-lg rounded-3 bg-light-primary">
                                                @if ($asset->asset_type == 'image')
                                                    <a href="{{ $asset->asset_url }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="currentColor"
                                                            class="bi bi-file-image text-info" viewBox="0 0 16 16">
                                                            <path d="M8.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z">
                                                            </path>
                                                            <path
                                                                d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v8l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @else
                                                    @if ($asset->file_type == 'xlsx')
                                                        <a href="{{ $asset->asset_url }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="currentColor"
                                                                class="bi bi-file-excel text-success"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704z">
                                                                </path>
                                                                <path
                                                                    d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    @elseif ($asset->file_type == 'doc' || $asset->file_type == 'docx')
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="currentColor"
                                                            class="bi bi-file-word text-success" viewBox="0 0 16 16">
                                                            <path
                                                                d="M4.879 4.515a.5.5 0 0 1 .606.364l1.036 4.144.997-3.655a.5.5 0 0 1 .964 0l.997 3.655 1.036-4.144a.5.5 0 0 1 .97.242l-1.5 6a.5.5 0 0 1-.967.01L8 7.402l-1.018 3.73a.5.5 0 0 1-.967-.01l-1.5-6a.5.5 0 0 1 .364-.606z">
                                                            </path>
                                                            <path
                                                                d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z">
                                                            </path>
                                                        </svg>
                                                    @elseif ($asset->file_type == 'ppt' || $asset->file_type == 'pptx')
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="currentColor"
                                                            class="bi bi-file-ppt text-danger" viewBox="0 0 16 16">
                                                            <path
                                                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z">
                                                            </path>
                                                            <path
                                                                d="M6 5a1 1 0 0 1 1-1h1.188a2.75 2.75 0 0 1 0 5.5H7v2a.5.5 0 0 1-1 0V5zm1 3.5h1.188a1.75 1.75 0 1 0 0-3.5H7v3.5z">
                                                            </path>
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="currentColor"
                                                            class="bi bi-file-text text-warning" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z">
                                                            </path>
                                                            <path
                                                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z">
                                                            </path>
                                                        </svg>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="ms-3">
                                                <h5 class="mb-0">
                                                    <a href="#" class="text-inherit">{{ $asset->asset_name }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $asset->file_size }}</td>
                                    <td>{{ date_format($asset->created_at, 'jS M, Y g:i A') }}</td>
                                    <td>
                                        <a href="{{ $asset->asset_url }}" target="_blank"
                                            class="text-body text-primary-hover texttooltip" data-template="five">
                                            <i class="fe fe-download fs-5"></i>

                                            <div id="five" class="d-none">
                                                <h6 class="mb-0 text-white">Download</h6>
                                            </div>
                                        </a>
                                        <a href="{{ $asset->asset_url }}" target="_blank"
                                            class="text-body text-primary-hover ms-3 texttooltip" data-template="six">
                                            <i class="fe fe-link fs-5"></i>
                                            <div id="six" class="d-none">
                                                <h6 class="mb-0 text-white">Link</h6>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    document.getElementById("jobs").classList.add('active');
</script>

@endsection
