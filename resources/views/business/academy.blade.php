@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Academy')
<script src="https://www.youtube.com/iframe_api"></script>

<style style="text/css">
    /* Apply a responsive container */
    .video-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* 16:9 aspect ratio (height/width) */
        overflow: hidden;
    }

    /* Style the iframe to take 100% width and height of its container */
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

<!-- Container fluid -->
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Academy</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Academy</li>
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
                                placeholder="Search Lessoons......" value="{{ $search }}">
                        </div>

                    </div>
                    <div class="col-6 col-lg-3">
                        <!-- form select -->
                        <select id="status" name="filter" class="form-select" aria-label="Default select example"
                            onChange="this.form.submit()">
                            <option value="desc" @if ($filter == 'desc') selected @endif>Sort by Newest
                                Lessons</option>
                            <option value="asc" @if ($filter == 'asc') selected @endif>Sort by Oldest
                                Lessons</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3">

        @foreach ($tutorialVideos as $vid)
            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                <!-- card -->
                <div class="card">
                    <div class="align-items-center">
                        <div class="video-container">
                            <!-- Replace 'VIDEO_ID' with the actual YouTube video ID -->
                            <iframe id="youtube-player" width="560" height="200"
                                src="{{ $vid->video_url }}" frameborder="0" allowfullscreen
                                style="border-radius: 8px 8px 0px 0px"></iframe>
                            <div class="play-button" id="play-button"></div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <div class="">
                            <h5 class="font-md" style="font-size:15px">{{ $vid->video_title }}</h5>
                            <p class="font-sm color-text-paragraph">{{ $vid->video_description }}</p>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (count($tutorialVideos) < 1)
        <div class="col-xl-12 col-12 job-items job-empty">
            <div class="text-center mt-4"><i class="bi bi-emoji-frown" style="font-size: 48px"></i>
                <h3 class="mt-2">No Lesson</h3>
                <div class="mt-2 text-muted"> There are no lessons found with your
                    queries. </div>
            </div>
        </div>
    @endif

    @if (count($tutorialVideos) > 0 && $marker != null)
        <div class="card-footer">
            <div class="row g-2 pt-3 ms-4 me-4">
                <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                    of
                    {{ number_format($lastRecord) }} Records</div>

                <div class="col-md-3">{{ $tutorialVideos->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
<script type="text/javascript">
    document.getElementById("academy").classList.add('active');
</script>

<script>
    // YouTube Player API setup
    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('youtube-player', {
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        // You can perform additional actions when the player is ready
    }

    // Handle play button click event
    document.getElementById('play-button').addEventListener('click', function() {
        player.playVideo();
        document.getElementById('play-button').style.display = 'none';
    });
</script>
@endsection
