@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | ' . $blogPost->post_title)
<style>
     h1, h2, h3, h4, h5, h6{
        padding-top: 20px;
        padding-bottom: 20px;
        font-size: 24px
    }

    p{
        font-size: 16px;
        text-align: justify
    }
</style>
<main class="main">
    <section class="section-box">
        <div class="breadcrumb-cover page_speed_160581955" style="background:url({{ asset('files/pages/Search.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h2 style="color:#fff; padding-bottom:0px">{{ $blogPost->post_title }}</h2>
                        <span class="font-regular text-white">
                            @if (isset($blogPost->tags))
                            <div class="tags mb-15">
                                @php
                                    $blogTags = explode(', ', $blogPost->tags);
                                @endphp
                                @foreach ($blogTags as $tag)
                                    <a class="btn btn-tag" style="cursor: pointer">{{ $tag }}</a>&nbsp;
                                @endforeach
                            </div>
                        @endif
                        </span>
                    </div>
                    <div class="col-lg-3 text-md-end">
                        <ul class="breadcrumbs ">
                            <li><a href="/"><span class="fi-rr-home icon-home"></span>
                                    Home </a></li>
                            <li><a href="/blog">Blog Posts</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ck-content">
        <div>
            <section class="section-box mt-50">
                <div class="post-loop-grid">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                {{-- <h3 class="mt-15">{{ $blogPost->post_title }}</h3> --}}
                                <div class="mt-20">
                                    <p class="font-md color-text-paragraph mt-20">
                                        @php echo $blogPost->blog_post; @endphp
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</main>
<script type="text/javascript">
    document.getElementById("blog").classList.add('active');
</script>

@endsection
