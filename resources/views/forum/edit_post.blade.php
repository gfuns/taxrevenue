@extends('forum.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Edit Post')

<body>
    <!--==================== Preloader Start ====================-->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <span class="loader-object"></span>
            </div>
        </div>
    </div>

    <!--==================== Preloader End ====================-->

    <section>
        @include('forum.layouts.nav')
        <!-- header -->
        <!-- body -->
        <div class="body-section">
            <div class="container-fluid">
                <div class="row m-0">
                    <!-- left side -->
                    @include('forum.layouts.left_nav')
                    <!-- left side / -->

                    <div class="col-lg-6">
                        <div class="row justify-content-center">
                            <div class="col-xl-10 col-lg-12 pt-60">
                                <div class="edit-post global-card mb-5">
                                    <h3 class="title mb-4">Edit Post</h3>
                                    <form method="POST" action="{{ route('forum.userPostUpdate') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12 mb-4">
                                                <div class="form-group">
                                                    <input class="form--control" placeholder="" name="post_title"
                                                        value="{{ $post->post_title }}">
                                                    <label class="form--label">Title</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-4">
                                                    <select class=" select form-control form--control" name="fcategory"
                                                        id="fcategory">
                                                        <option value="">Select Category (Optional)</option>
                                                        @foreach ($forumCategories as $fc)
                                                            <option value="{{ $fc->id }}"
                                                                @if ($fc->id == $post->forum_category_id) selected @endif>
                                                                {{ $fc->category }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-4">
                                                    <select class=" select form-control form--control" name="ftopic"
                                                        id="ftopic">
                                                        <option value="">Select Topic (Optional)</option>
                                                        @foreach ($forumTopics as $ft)
                                                            <option value="{{ $ft->id }}"
                                                                @if ($ft->id == $post->forum_topic_id) selected @endif>
                                                                {{ $ft->topic }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-sm-12 mb-4">
                                                <p class="mb-2">Allowed File Extensions: .jpg, .jpeg, .png (max:
                                                    <strong>2MB)</strong>
                                                </p>
                                                <div class="form-group">
                                                    <input class="form--control" type="file" placeholder=""
                                                        name="post_images[]" accept=".png, .jpg, .jpeg" multiple>
                                                    <label class="form--label">Image</label>
                                                </div>
                                            </div>
                                            @if (count($postImages) > 0)
                                                <div class="col-lg-12 mb-4 d-flex">
                                                    <div class="row w-100">
                                                        @foreach ($postImages as $pi)
                                                            <div class="col-xl-3 col-lg-6 image-card">
                                                                <div class="post-img-wrap">
                                                                    <div class="btn btn--sm btn--info detele-btn"
                                                                        onclick="imageDelete(this)"
                                                                        data-image-id ="{{ $pi->id }}"><i
                                                                            class="fa-solid fa-xmark"></i></div>
                                                                    <img src="{{ $pi->image }}" alt="image">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 mb-4">
                                                <div class="form-group">
                                                    <textarea id="editor1" class="form--control" placeholder="" name="post_body">@php echo $post->post_body; @endphp</textarea>
                                                    <label class="form--label">Post Body</label>
                                                </div>

                                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                            </div>
                                        </div>
                                        <button class="btn btn--base w-50">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- right side -->
                    @include('forum.layouts.right_nav')
                    <!-- right side /-->
                </div>
            </div>
        </div>

        @include('forum.layouts.modals')
    </section>

@endsection
