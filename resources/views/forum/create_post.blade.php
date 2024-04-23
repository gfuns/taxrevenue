@extends('forum.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Create Post')
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



    <!-- body -->
    <div class="body-section">
        <div class="container-fluid">
            <div class="row m-0">
                @include('forum.layouts.left_nav')

                <div class="col-lg-6">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 pt-60">
                            <div class="edit-post global-card">
                                <h3 class="title mb-4">Edit Post</h3>
                                <form method="POST" action="https://preview.wstacks.com/proforum/user/post/update/141"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row d-none">
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-group">
                                                <input class="form--control d-none" hidden placeholder=""
                                                    name="post_type" value="event">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            <div class="form-group">
                                                <input class="form--control" placeholder="" name="title"
                                                    value="Legends In Concert">
                                                <label class="form--label">Title</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-4">
                                                <select class=" select form-control form--control" name="category"
                                                    required="" id="category">
                                                    <option value="">Select Category</option>
                                                    <option value="1">
                                                        Sports</option>
                                                    <option value="2">
                                                        Tecnology</option>
                                                    <option value="5">
                                                        Animation</option>
                                                    <option value="7" selected>
                                                        Job</option>
                                                    <option value="10">
                                                        Education</option>
                                                    <option value="12">
                                                        News</option>
                                                    <option value="13">
                                                        Travel</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            <div class="form-group">
                                                <input class="form--control" placeholder="" name="fee"
                                                    value="180">
                                                <label class="form--label">Fees</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 mb-4">
                                            <div class="form-group">
                                                <input class="form--control" placeholder="" name="participant"
                                                    value="45">
                                                <label class="form--label">Participant</label>
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
                                                    name="images[]" accept=".png, .jpg, .jpeg" multiple>
                                                <label class="form--label">Image</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4 d-flex">
                                            <div class="row w-100">
                                                <div class="col-xl-3 col-lg-6 image-card">
                                                    <div class="post-img-wrap">
                                                        <div class="btn btn--sm btn--info detele-btn"
                                                            onclick="imageDelete(this)" data-image-id ="55"><i
                                                                class="fa-solid fa-xmark"></i></div>
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a2677aff611698309751.jpg"
                                                            alt="image">
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 image-card">
                                                    <div class="post-img-wrap">
                                                        <div class="btn btn--sm btn--info detele-btn"
                                                            onclick="imageDelete(this)" data-image-id ="56"><i
                                                                class="fa-solid fa-xmark"></i></div>
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a2677b9c4e1698309751.jpg"
                                                            alt="image">
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 image-card">
                                                    <div class="post-img-wrap">
                                                        <div class="btn btn--sm btn--info detele-btn"
                                                            onclick="imageDelete(this)" data-image-id ="57"><i
                                                                class="fa-solid fa-xmark"></i></div>
                                                        <img src="https://preview.wstacks.com/proforum/assets/images/posts/2023/10/653a2677beac21698309751.jpg"
                                                            alt="image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-xl-6 mb-4">
                                            <div class="form-group">
                                                <input class="form--control" type="datetime-local" placeholder=""
                                                    name="start_date" value="2023-10-26 14:41:00">
                                                <label class="form--label">Start Date</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-xl-6 mb-4">
                                            <div class="form-group">
                                                <input class="form--control" placeholder="" type="datetime-local"
                                                    name="end_date" value="2023-11-30 14:41:00">
                                                <label class="form--label">end Date</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="form-group">
                                                <textarea class="form--control trumEdit" placeholder="" name="content">&lt;p&gt;Legends In Concert is a live stage show featuring impersonators of Elvis Presley, Michael Jackson, and other legendary entertainers. See them live in concert in Barcelona!&lt;/p&gt;</textarea>
                                                <label class="form--label">Description</label>
                                            </div>
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
