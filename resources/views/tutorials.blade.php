@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Tutorial Videos')
<script src="https://www.youtube.com/iframe_api"></script>
<main class="main">
    <div class="ck-content">
        <div>
            <section class="section-box">
                <div class="banner-hero hero-2 hero-3" style="background:url({{ asset('storage/pages/Search.png') }}">
                    <div class="banner-inner" style="max-width: 800px">
                        <div class="block-banner">
                            <h1 class="text-42 color-white wow animate__animated animate__fadeInUp"> Tutorial
                                <span style="color:#FEBA00">Vidoes</span>
                            </h1>
                            <div class="font-lg font-regular color-white mt-20 mb-20 wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s"> Get caught up on all of Arete’s feature to grow your business and
                                get more clients as an Artisan </div>

                        </div>
                    </div>

                </div>
            </section>
        </div>
        <div>
            <section class="section-box mt-90 mb-50">
                <div class="container">

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
    document.getElementById("resources").classList.add('active');
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
