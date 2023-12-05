@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Businesses ')

    <main class="main">
        <div class="ck-content">
            <div>
                <div class="companies-list">
                    <section class="section-box-2">
                        <div class="container">
                            <div class="banner-hero banner-company">
                                <div class="block-banner text-center">
                                    <h3 class="wow animate__animated animate__fadeInUp">Browse <span  style="color:#FEBA00">Businesses</span></h3>
                                    <div class="font-sm color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp"
                                        data-wow-delay=".1s">Thousands of jobs in the computer, engineering technology and other industries are waiting for you.</div>
                                    <div class="box-list-character">
                                        <ul>
                                            <li><a class="filter-by-word " data-keyword="A" href="#">A</a></li>
                                            <li><a class="filter-by-word " data-keyword="B" href="#">B</a></li>
                                            <li><a class="filter-by-word " data-keyword="C" href="#">C</a></li>
                                            <li><a class="filter-by-word " data-keyword="D" href="#">D</a></li>
                                            <li><a class="filter-by-word " data-keyword="E" href="#">E</a></li>
                                            <li><a class="filter-by-word " data-keyword="F" href="#">F</a></li>
                                            <li><a class="filter-by-word " data-keyword="G" href="#">G</a></li>
                                            <li><a class="filter-by-word " data-keyword="H" href="#">H</a></li>
                                            <li><a class="filter-by-word " data-keyword="I" href="#">I</a></li>
                                            <li><a class="filter-by-word " data-keyword="J" href="#">J</a></li>
                                            <li><a class="filter-by-word " data-keyword="K" href="#">K</a></li>
                                            <li><a class="filter-by-word " data-keyword="L" href="#">L</a></li>
                                            <li><a class="filter-by-word " data-keyword="M" href="#">M</a></li>
                                            <li><a class="filter-by-word " data-keyword="N" href="#">N</a></li>
                                            <li><a class="filter-by-word " data-keyword="O" href="#">O</a></li>
                                            <li><a class="filter-by-word " data-keyword="P" href="#">P</a></li>
                                            <li><a class="filter-by-word " data-keyword="Q" href="#">Q</a></li>
                                            <li><a class="filter-by-word " data-keyword="R" href="#">R</a></li>
                                            <li><a class="filter-by-word " data-keyword="S" href="#">S</a></li>
                                            <li><a class="filter-by-word " data-keyword="T" href="#">T</a></li>
                                            <li><a class="filter-by-word " data-keyword="U" href="#">U</a></li>
                                            <li><a class="filter-by-word " data-keyword="V" href="#">V</a></li>
                                            <li><a class="filter-by-word " data-keyword="W" href="#">W</a></li>
                                            <li><a class="filter-by-word " data-keyword="X" href="#">X</a></li>
                                            <li><a class="filter-by-word " data-keyword="Y" href="#">Y</a></li>
                                            <li><a class="filter-by-word " data-keyword="Z" href="#">Z</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section-box mt-30">
                        <div class="container">

                            <div class="row flex-row-reverse row-filter justify-content-center">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 company-listing">
                                    <div class="content-page ">
                                        <div class="box-filters-job">
                                            <div class="row ">
                                                <div class="col-xl-6 col-lg-5"><span
                                                        class="text-small text-showing font-weight-bold"> Showing 1 –
                                                        12 of 20 job(s) </span></div>
                                                <div class="col-xl-6 col-lg-7 text-lg-end mt-sm-15">
                                                    <div class="display-flex2">
                                                        <div class="box-border mr-10"><span
                                                                class="text-sort_by">Show:</span>
                                                            <div class="dropdown dropdown-sort"><button
                                                                    class="btn dropdown-toggle" id="dropdownSort"
                                                                    type=button data-bs-toggle="dropdown"
                                                                    aria-expanded="false"
                                                                    data-bs-display="static"><span>12</span><i
                                                                        class="fi-rr-angle-small-down"></i></button>
                                                                <ul class="dropdown-menu js-dropdown-clickable dropdown-menu-light"
                                                                    aria-labelledby="dropdownSort">
                                                                    <li><a class="dropdown-item per-page-item"
                                                                            data-per-page="12" href="#"> 12 </a>
                                                                    </li>
                                                                    <li><a class="dropdown-item per-page-item"
                                                                            data-per-page="24" href="#"> 24 </a>
                                                                    </li>
                                                                    <li><a class="dropdown-item per-page-item"
                                                                            data-per-page="36" href="#"> 36 </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="box-border"><span class="text-sort_by">Sort
                                                                by:</span>
                                                            <div class="dropdown dropdown-sort"><button
                                                                    class="btn dropdown-toggle" id="dropdownSort2"
                                                                    type=button data-bs-toggle="dropdown"
                                                                    aria-expanded="false"
                                                                    data-bs-display="static"><span>Newest</span><i
                                                                        class="fi-rr-angle-small-down"></i></button>
                                                                <ul class="dropdown-menu js-dropdown-clickable dropdown-menu-light"
                                                                    aria-labelledby="dropdownSort2">
                                                                    <li><a class="dropdown-item dropdown-sort-by active"
                                                                            data-sort-by="newest" href="#">
                                                                            Newest </a></li>
                                                                    <li><a class="dropdown-item dropdown-sort-by"
                                                                            data-sort-by="oldest" href="#">
                                                                            Oldest </a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="box-view-type"><a class="view-type layout-company"
                                                                href="#" data-layout="list"><img
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/icon-list.svg
                                                                    alt="List layout"></a><a
                                                                class="view-type layout-company" href="#"
                                                                data-layout="grid"><img
                                                                    src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/icon-grid.svg
                                                                    alt="Grid layout"></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row display-list">
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/2.png
                                                                        alt="Adobe Illustrator"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/adobe-illustrator">Adobe
                                                                        Illustrator</a><span
                                                                        class="location-small">Germany, Germany</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/adobe-illustrator">Adobe
                                                                Illustrator</a></h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
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
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/adobe-illustrator">
                                                                            4 Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/9.png
                                                                        alt="Honda"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/honda">Honda</a><span
                                                                        class="location-small">Holland, Holland</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/honda">Honda</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
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
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>2</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/honda">
                                                                            2 Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/6.png
                                                                        alt="Equity"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/equity">Equity</a><span
                                                                        class="location-small">Denmark, Denmark</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/equity">Equity</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
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
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>4</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/equity">
                                                                            No Opening Job </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/8.png
                                                                        alt="Kentucky"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/kentucky">Kentucky</a><span
                                                                        class="location-small">France, France</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/kentucky">Kentucky</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
                                                                    <div class="mt-5"><img alt="star"
                                                                            class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>1</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/kentucky">
                                                                            2 Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/7.png
                                                                        alt="Greenwood"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/greenwood">Greenwood</a><span
                                                                        class="location-small">Holland, Holland</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/greenwood">Greenwood</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
                                                                    <div class="mt-5"><img alt="star"
                                                                            class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>3</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/greenwood">
                                                                            1 Opening Job </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/6.png
                                                                        alt="Whop.com"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/whopcom">Whop.com</a><span
                                                                        class="location-small">Germany, Germany</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/whopcom">Whop.com</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
                                                                    <div class="mt-5"><img alt="star"
                                                                            class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>3</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/whopcom">
                                                                            4 Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/5.png
                                                                        alt="PowerHome"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/powerhome">PowerHome</a><span
                                                                        class="location-small">Germany, Germany</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/powerhome">PowerHome</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
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
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>3</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/powerhome">
                                                                            1 Opening Job </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/4.png
                                                                        alt="NewSum"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/newsum">NewSum</a><span
                                                                        class="location-small">France, France</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/newsum">NewSum</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
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
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>5</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/newsum">
                                                                            2 Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/8.png
                                                                        alt="Periscope"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/periscope">Periscope</a><span
                                                                        class="location-small">New York, USA</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/periscope">Periscope</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
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
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>3</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/periscope">
                                                                            3 Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/7.png
                                                                        alt="Nintendo"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/nintendo">Nintendo</a><span
                                                                        class="location-small">Denmark, Denmark</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/nintendo">Nintendo</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
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
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>4</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/nintendo">
                                                                            3 Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/6.png
                                                                        alt="Quora JSC"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/quora-jsc">Quora
                                                                        JSC</a><span class="location-small">Germany,
                                                                        Germany</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/quora-jsc">Quora
                                                                JSC</a></h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
                                                                    <div class="mt-5"><img alt="star"
                                                                            class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><img
                                                                            alt="star" class="rating-star"
                                                                            src=https://jobbox.archielite.com/themes/jobbox/imgs/template/icons/gray-star.svg><span
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>1</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/quora-jsc">
                                                                            2 Opening Jobs </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 col-12 company-list-item">
                                                <div class="card-grid-2 hover-up"><span class="flash"></span>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card-grid-2-image-left">
                                                                <div class="image-box"><img
                                                                        src=https://jobbox.archielite.com/storage/companies/5.png
                                                                        alt="Linkedin"></div>
                                                                <div class="right-info"><a class="name-job"
                                                                        href="https://jobbox.archielite.com/companies/linkedin">Linkedin</a><span
                                                                        class="location-small">Denmark, Denmark</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block-info">
                                                        <h4><a
                                                                href="https://jobbox.archielite.com/companies/linkedin">Linkedin</a>
                                                        </h4>
                                                        <div class="card-2-bottom mt-20">
                                                            <div class="row">
                                                                <div class="col-lg-7 col-7">
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
                                                                            class="font-xs color-text-mutted ml-5"><span>(</span><span>3</span><span>)</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-5 text-end">
                                                                    <div class="text-start text-md-end"><a
                                                                            class="btn btn-apply-now"
                                                                            href="https://jobbox.archielite.com/companies/linkedin">
                                                                            4 Opening Jobs </a></div>
                                                                </div>
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
                                                    href="https://jobbox.archielite.com/companies?page=2">2</a></li>
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
        document.getElementById("businesses").classList.add('active');
    </script>
    @endsection
