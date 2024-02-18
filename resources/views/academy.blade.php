@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Academy')
<script src="https://www.youtube.com/iframe_api"></script>
<main class="main">
    <div class="ck-content">
        <div>
            <section class="section-box">
                <div class="breadcrumb-cover page_speed_160581955"
                    style="background:url({{ asset('files/pages/Search.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="mb-10" style="color:#fff">Academy</h2>
                                <span class=" font-regular text-white">Get caught up on all of Arete’s feature to grow your business and get more clients</span>
                            </div>
                            <div class="col-lg-3 text-md-end">
                                <ul class="breadcrumbs ">
                                    <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                            Home </a></li>
                                    <li><a href="/academy">Academy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div>
            <section class="section-box mt-50 mb-50">
                <div class="container">
                    <div class="box-filters-job">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 jobs-listing-container">
                                <aside class="col-lg-8 widget widget_search mb-10">
                                    <div class="search-form">
                                        <form role="search" method="GET" action="">
                                            <input type=text placeholder="Search..." value=""
                                                name=q><button type=submit><i
                                                    class="fi-rr-search"></i></button>
                                        </form>
                                    </div>
                                </aside>
                            </div>
                            <div class="col-xl-4 col-lg-4 text-lg-end mt-sm-15 d-none d-lg-block">
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
                    <div class="row mt-50">
                        @foreach ($tutorialVideos as $vid)
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div
                                    class="card-grid-border-2 hover-up wow animate__ animate__fadeIn animated page_speed_1648937243">
                                    <div class="video-container">
                                        <!-- Replace 'VIDEO_ID' with the actual YouTube video ID -->
                                        <iframe id="youtube-player" width="560" height="200"
                                            src="{{ $vid->video_url }}" frameborder="0" allowfullscreen style="border-radius: 8px 8px 0px 0px"></iframe>
                                        <div class="play-button" id="play-button"></div>
                                    </div>
                                    <div class="p-20">
                                        <h6 class="mb-10">{{ $vid->video_title }}</h6>
                                        <p class="font-sm mb-5 color-text-paragraph">{{ $vid->video_description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

    </div>

</main>

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
