@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Artisans ')

    <main class="main">
        <div class="ck-content">
            <div>
                <div class="container candidates-list">
                    <section class="section-box-2">
                        <div class="container">
                            <div class="banner-hero banner-company">
                                <div class="block-banner text-center">
                                    <h3 class="wow animate__animated animate__fadeInUp">Browse <span  style="color:#FEBA00">Artisans</span></h3>
                                    <div class="font-sm color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp"
                                        data-wow-delay=".1s">Thousands of Professional Artisians Available to be Hired for Jobs in their specialized Niches.</div>
                                    <div class="box-list-character">
                                        <ul>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="a">a</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="b">b</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="c">c</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="d">d</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="e">e</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="f">f</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="g">g</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="h">h</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="i">i</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="j">j</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="k">k</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="l">l</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="m">m</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="n">n</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="o">o</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="p">p</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="q">q</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="r">r</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="s">s</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="t">t</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="u">u</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="v">v</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="w">w</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="x">x</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="y">y</a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="keyword " data-keyword="z">z</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <form action="https://jobbox.archielite.com/ajax/candidates" class="candidate-filter-form"><input
                            type=hidden name=keyword value=""><input type=hidden name=per_page
                            value="12"><input type=hidden name=sort_by value="newest"><input type=hidden name=page
                            value="1"></form>
                    <section class="mt-30">
                        <div class="container position-relative">
                            <div class="content-page">

                                <div class="box-filters-job">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-5"><span class="text-small text-showing"> Showing
                                                1-12 of 56 candidate(s) </span></div>
                                        <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
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
                                                                    data-sort-by="newest" href="#"> Newest </a>
                                                            </li>
                                                            <li><a class="dropdown-item dropdown-sort-by"
                                                                    data-sort-by="oldest" href="#"> Oldest </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row candidate-list">
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd"><a
                                                        href="https://jobbox.archielite.com/candidates/arlie">
                                                        <figure><img alt="Arlie Lindgren"
                                                                src=https://jobbox.archielite.com/storage/avatars/2-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/arlie">
                                                        <h5>Arlie Lindgren</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">How
                                                        neatly spread.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Gryphon at the thought that
                                                    it would be like, &#039;--for they haven&#039;t got much evidence
                                                    YET,&#039; she said a...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>0</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd"><a
                                                        href="https://jobbox.archielite.com/candidates/santa">
                                                        <figure><img alt="Santa Altenwerth"
                                                                src=https://jobbox.archielite.com/storage/avatars/2-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/santa">
                                                        <h5>Santa Altenwerth</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">I
                                                        get&quot; is the same.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Turtle--we used to know. Let
                                                    me see--how IS it to the Duchess: &#039;and the moral of that
                                                    is--&quot;Birds of...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>0</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd"><a
                                                        href="https://jobbox.archielite.com/candidates/chaya">
                                                        <figure><img alt="Chaya Bechtelar"
                                                                src=https://jobbox.archielite.com/storage/avatars/3-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/chaya">
                                                        <h5>Chaya Bechtelar</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">Alice
                                                        replied, so.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Alice, and looking anxiously
                                                    round to see some meaning in it,&#039; said the Caterpillar.
                                                    &#039;Well, I&#039;ve tri...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>0</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd online"><a
                                                        href="https://jobbox.archielite.com/candidates/germaine">
                                                        <figure><img alt="Germaine Ernser"
                                                                src=https://jobbox.archielite.com/storage/avatars/3-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/germaine">
                                                        <h5>Germaine Ernser</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">Gryphon
                                                        repeated.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Alice, so please your
                                                    Majesty,&#039; he began. &#039;You&#039;re a very curious sensation,
                                                    which puzzled her very m...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>0</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd online"><a
                                                        href="https://jobbox.archielite.com/candidates/jakob">
                                                        <figure><img alt="Jakob Corwin"
                                                                src=https://jobbox.archielite.com/storage/avatars/1-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/jakob">
                                                        <h5>Jakob Corwin</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">Queen
                                                        said--&#039; &#039;Get.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Duchess. An invitation from
                                                    the Queen was to eat or drink under the sea,&#039; the Gryphon
                                                    whispered in r...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>0</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd online"><a
                                                        href="https://jobbox.archielite.com/candidates/estrella">
                                                        <figure><img alt="Estrella Daugherty"
                                                                src=https://jobbox.archielite.com/storage/avatars/2-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/estrella">
                                                        <h5>Estrella Daugherty</h5>
                                                    </a><span
                                                        class="font-xs color-text-mutted text-truncate">You&#039;re
                                                        mad.&#039; &#039;How.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">I beat him when he sneezes;
                                                    For he can thoroughly enjoy The pepper when he sneezes; For he can
                                                    thoro...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>1</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd online"><a
                                                        href="https://jobbox.archielite.com/candidates/gavin">
                                                        <figure><img alt="Gavin Pfannerstill"
                                                                src=https://jobbox.archielite.com/storage/avatars/2-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/gavin">
                                                        <h5>Gavin Pfannerstill</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">Let me
                                                        see: I&#039;ll.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">She generally gave herself
                                                    very good height indeed!&#039; said Alice, feeling very glad to find
                                                    that the...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>2</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd online"><a
                                                        href="https://jobbox.archielite.com/candidates/patsy">
                                                        <figure><img alt="Patsy Streich"
                                                                src=https://jobbox.archielite.com/storage/avatars/2-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/patsy">
                                                        <h5>Patsy Streich</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">Alice;
                                                        &#039;living at.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">I&#039;m not Ada,&#039; she
                                                    said, &#039;than waste it in less than no time to go, for the end of
                                                    the leaves: &#039;I sho...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>0</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd online"><a
                                                        href="https://jobbox.archielite.com/candidates/yvette">
                                                        <figure><img alt="Yvette Bashirian"
                                                                src=https://jobbox.archielite.com/storage/avatars/1-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/yvette">
                                                        <h5>Yvette Bashirian</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">Queen put
                                                        on his.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Mock Turtle. &#039;And how
                                                    many miles I&#039;ve fallen by this time). &#039;Don&#039;t
                                                    grunt,&#039; said Alice; &#039;all I know i...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>1</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd online"><a
                                                        href="https://jobbox.archielite.com/candidates/erling">
                                                        <figure><img alt="Erling O&#039;Conner"
                                                                src=https://jobbox.archielite.com/storage/avatars/1-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/erling">
                                                        <h5>Erling O&#039;Conner</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">Queen put
                                                        on your.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Mock Turtle: &#039;nine the
                                                    next, and so on.&#039; &#039;What a number of changes she had asked
                                                    it aloud; and in an...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>1</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd"><a
                                                        href="https://jobbox.archielite.com/candidates/geoffrey">
                                                        <figure><img alt="Geoffrey Gorczany"
                                                                src=https://jobbox.archielite.com/storage/avatars/1-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/geoffrey">
                                                        <h5>Geoffrey Gorczany</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">I suppose
                                                        Dinah&#039;ll.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Alice was only the pepper
                                                    that makes people hot-tempered,&#039; she went on, very much at
                                                    first, the two...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>0</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="card-grid-2 hover-up">
                                            <div class="card-grid-2-image-left">
                                                <div class="card-grid-2-image-rd"><a
                                                        href="https://jobbox.archielite.com/candidates/kobe">
                                                        <figure><img alt="Kobe Mitchell"
                                                                src=https://jobbox.archielite.com/storage/avatars/3-150x150.png>
                                                        </figure>
                                                    </a></div>
                                                <div class="card-profile pt-10"><a
                                                        href="https://jobbox.archielite.com/candidates/kobe">
                                                        <h5>Kobe Mitchell</h5>
                                                    </a><span class="font-xs color-text-mutted text-truncate">Alice and
                                                        all must.</span></div>
                                            </div>
                                            <div class="card-block-info">
                                                <p class="font-xs color-text-paragraph-2">Mock Turtle. &#039;She
                                                    can&#039;t explain MYSELF, I&#039;m afraid, but you might like to
                                                    hear her try and repeat so...</p>
                                                <div
                                                    class="employers-info align-items-center justify-content-center mt-15">
                                                    <div class="row justify-content-between align-items-center">
                                                        <div class="col-md-6"><span
                                                                class="d-flex align-items-center"><i
                                                                    class="fi-rr-marker mr-5 ml-0"></i><span
                                                                    class="font-sm color-text-mutted text-truncate">
                                                                    FRA </span></span></div>
                                                        <div class="col-md-6">
                                                            <div class="mt-5"><img alt="star"
                                                                    class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                    alt="star" class="rating-star"
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                    class="font-xs color-text-mutted ml-5"><span>(</span><span>2</span><span>)</span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="paginations">
                                        <ul class="pager">
                                            <li><a class="pager-prev pagination-button text-center"
                                                    href="javascript:void(0)" tabindex="-1"><i
                                                        class="fi fi-rr-arrow-small-left btn-prev"></i></a></li>
                                            <li><a class="pager-number active" href="javascript:void(0)">1</a></li>
                                            <li><a class="pager-number pagination-button" data-page="2"
                                                    href="https://jobbox.archielite.com/candidates?page=2">2</a></li>
                                            <li><a class="pager-number pagination-button" data-page="3"
                                                    href="https://jobbox.archielite.com/candidates?page=3">3</a></li>
                                            <li><a class="pager-number pagination-button" data-page="4"
                                                    href="https://jobbox.archielite.com/candidates?page=4">4</a></li>
                                            <li><a class="pager-number pagination-button" data-page="5"
                                                    href="https://jobbox.archielite.com/candidates?page=5">5</a></li>
                                            <li><a class="pager-next pagination-button text-center" data-page="2"
                                                    href="#"><i
                                                        class="fi fi-rr-arrow-small-right btn-next"></i></a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>


        </div>

    </main>

    <script type="text/javascript">
        document.getElementById("artisans").classList.add('active');
    </script>

    @endsection

