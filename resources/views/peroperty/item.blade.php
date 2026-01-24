@include('partials.home.header')
@include('partials.home.menu')


<?php
function getCat($type)
{
    switch ($type) {
        case 'other':
            return "سایر";
            break;
        case 'pre-sale':
            return "پیش فروش";
            break;
        case 'villa-sale':
            return "خرید و فروش ویلا";
            break;
        case 'apartment-rent':
            return "رهن و اجاره خانه و آپارتمان";
            break;
        case 'apartment-sale':
            return "خرید و فروش خانه و آپارتمان";
            break;
        case 'villa-short-rent':
            return "اجاره کوتاه مدت ویلا، سوئیت";
            break;
        case 'commercial-rent':
            return "رهن و اجاره اداری، تجاری و صنعتی";
            break;
        case 'commercial-sale':
            return "خرید و فروش اداری، تجاری و صنعتی";
            break;
        case 'land':
            return "زمین و باغ";
            break;
        case 'pre-sale':
            return "پیش فروش و مشارکت در ساخت";
            break;

        default:
            break;
    }
}

$media = json_decode($property[0]->media);

?>


<!-- Page content-->
<section class="container mt-5 mb-lg-5 mb-4 pt-5 pb-lg-5">
    <!-- Breadcrumb-->
    <nav class="mb-3 pt-md-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
            <li class="breadcrumb-item"><a href="{{url('/')}}/category/{{$property[0] -> category}}">{{getCat($property[0] -> category)}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$property[0] -> title}}</li>
        </ol>
    </nav>
    <div class="row gy-5 pt-lg-2">
        <div class="col-lg-7">
            <div class="d-flex flex-column">
                <!-- Carousel with slides count-->
                <div class="order-lg-1 order-2">
                    <div class="tns-carousel-wrapper">
                        <div class="tns-slides-count text-light"><i class="fi-image fs-lg me-2"></i>
                            <div class="pe-1">
                                <span class="tns-current-slide fs-5 fw-bold"></span><span class="fs-5 fw-bold">/</span><span class="tns-total-slides fs-5 fw-bold"></span>
                            </div>
                        </div>
                        <div class="tns-carousel-inner" data-carousel-options="{&quot;navAsThumbnails&quot;: true, &quot;navContainer&quot;: &quot;#thumbnails&quot;, &quot;gutter&quot;: 12, &quot;responsive&quot;: {&quot;0&quot;:{&quot;controls&quot;: false},&quot;500&quot;:{&quot;controls&quot;: true}}}">
                            @foreach($media as $m);
                            <div><img class="rounded-3" src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Image"></div>
                            @endforeach;


                            <!--                         
                            <div>
                                <div class="ratio ratio-16x9">
                                    <iframe class="rounded-3" src="../../../www.aparat.com/video/video/embed/videohash/T0Imo/vt/frame.htm" title="فروش واحد 85متری" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div> -->

                        </div>
                    </div>
                    <!-- Thumbnails nav-->
                    <ul class="tns-thumbnails mb-4" id="thumbnails">

                        @foreach($media as $m);
                        <li class="tns-thumbnail"><img src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Thumbnail"></li>
                        @endforeach;

                        <!-- <li class="tns-thumbnail">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100"><i class="fi-play-circle fs-4 mb-1"></i><span>مشاهده</span></div>
                        </li> -->

                    </ul>
                </div>
                <!-- Page title + Features-->
                <div class="order-lg-2 order-1 mt-3">
                    <h1 class="h2 mb-2">{{$property[0] -> title}}</h1>
                    <p class="mb-2 pb-1 fs-base">{{$property[0] -> address}}</p>
                    <ul class="d-flex mb-4 pb-lg-2 list-unstyled">
                        <li class="me-3 pe-3 border-end"><b class="me-1"></b><i class="fi-home mt-n1 lead align-middle text-muted"></i> {{$property[0] -> area}}</li>
                        <li class="me-3 pe-3 border-end"><b class="me-1"></b><i class="fi-house-chosen mt-n1 lead align-middle text-muted"></i> {{$property[0] -> city}}</li>
                    </ul>
                </div>
            </div>
            <!-- Overview-->
            <h2 class="h5">توضیحات</h2>
            <p class="mb-4 pb-2"><?php echo nl2br($property[0]->description) ?></p>
            <!-- Rental agent-->
            <h2 class="h5">{{$user[0] -> company}}</h2>
            <div class="card card-horizontal">
                <div class="card-img-top bg-position-center-x" style="background-image: url({{url('/')}}/img/real-estate/agents/03.jpg);"></div>
                <blockquote class="blockquote card-body p-4">
                    <p class="mb-4">{{$user[0] -> bio}}</p>
                    <footer class="d-flex justify-content-between">
                        <div class="pe-3">
                            <h6 class="mb-0">{{$user[0] -> name}}</h6>
                            <div class="text-muted fw-normal fs-sm mb-3">نماینده گروه {{$user[0] -> company}}</div>
                            <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="https://instagram.com/{{$user[0] -> instagram}}"><i class="fi-instagram"></i></a>
                            <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="https://t.me/{{$user[0] -> telegram}}"><i class="fi-telegram"></i></a>
                            <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="https://wa.me/{{$user[0] -> whatsapp}}"><i class="fi-whatsapp"></i></a>
                        </div>
                        <!-- <div><span class="star-rating"><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i></span>
                            <div class="text-muted fs-sm mt-1">24 دیدگاه</div>
                        </div> -->
                    </footer>
                </blockquote>
            </div>
        </div>
        <!-- Sidebar with details-->
        <aside class="col-lg-5">
            <div class="ps-lg-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div><span class="badge bg-success me-2 mb-2">{{$property[0] -> status}}</span><span class="badge bg-info me-2 mb-2">جدید</span></div>
                    <div class="text-nowrap">
                        <button class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle ms-2 mb-2" type="button" data-bs-toggle="tooltip" title="نشان کردن"><i class="fi-heart"></i></button>
                        <div class="dropdown d-inline-block" data-bs-toggle="tooltip" title="اشتراک گذاری">
                            <button class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle ms-2 mb-2" type="button" data-bs-toggle="dropdown"><i class="fi-share"></i></button>
                            <div class="dropdown-menu dropdown-menu-end my-1">
                                <button class="dropdown-item" type="button"><i class="fi-facebook fs-base opacity-75 me-2"></i>فیسبوک</button>
                                <button class="dropdown-item" type="button"><i class="fi-twitter fs-base opacity-75 me-2"></i>توییتر</button>
                                <button class="dropdown-item" type="button"><i class="fi-instagram fs-base opacity-75 me-2"></i>اینستاگرام</button>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="h5 mb-2">قیمت:</h3>
                <h2 class="h3 mb-4 pb-2">{{number_format($property[0] -> price)}} تومان</h2>
                <!-- Property details-->
                <div class="card border-0 bg-secondary mb-4">
                    <div class="card-body">
                        <h5 class="mb-0 pb-3">مشخصات</h5>
                        <ul class="list-unstyled mt-n2 mb-0">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>نوع</td>
                                        <td><b>{{getCat($property[0] -> category)}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>متراژ (مترمربع)</td>
                                        <td><b>{{number_format($property[0] -> area)}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>استان</td>
                                        <td><b>{{$property[0] -> province}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>شهر</td>
                                        <td><b>{{$property[0] -> city}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>فروشنده</td>
                                        <td><b>{{$property[0] -> name.' '.$property[0] -> last_name}} ({{$property[0] -> company}})</b></td>
                                    </tr>
                                </tbody>
                            </table>



                        </ul>
                    </div>
                </div><a class="btn btn-lg btn-primary w-100 mb-3" href="tel:{{$property[0] -> tel}}">{{$property[0] -> tel}}</a>
                <a class="d-inline-block mb-4 pb-2 text-decoration-none" href="{{url('/')}}/page/faqs"><i class="fi-help me-2 mt-n1 align-middle"></i>سوالات متداول</a>

                <!-- Post meta-->
                <ul class="d-flex mb-4 list-unstyled fs-sm">
                    <li class="me-3 pe-3 border-end">تاریخ انتشار: <b> 26 بهمن</b></li>
                    <li class="me-3 pe-3">بازدید: <b>{{$property[0] -> visit_count}} نفر</b></li>
                </ul>
            </div>
        </aside>
    </div>
</section>

@if(isset($similar))
<!-- Recently viewed-->
<section class="container mb-5 pb-2 pb-lg-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h3 mb-0">آگهی های مشابه</h2>\
        <!-- <a class="btn btn-link fw-normal p-0" href="real-estate-catalog-rent.html">مشاهده همه<i class="fi-arrow-long-left ms-2"></i></a> -->
    </div>
    <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2">
        <div class="tns-carousel-inner row gx-4 mx-0 pt-3 pb-4" data-carousel-options="{&quot;items&quot;: 4, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;992&quot;:{&quot;items&quot;:4}}}">

            @foreach($similar as $p)
            <!-- Item-->
            <div class="col">
                <div class="card shadow-sm card-hover border-0 h-100">
                    <div class="card-img-top card-img-hover">
                        <a class="img-overlay" href="{{url('/')}}/p/{{$p->id}}/{{str_replace(' ','-',$p->title)}}" >

                            <div class="content-overlay end-0 top-0 pt-3 pe-3">
                                <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="نشان کردن"><i class="fi-heart"></i></button>
                            </div>
                            <img src="{{url('/')}}/upload/property/{{$p->id}}/{{$media[0]}}" alt="Image">
                    </div>
                    <div class="card-body position-relative pb-3">
                        <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">{{getCat($p -> category)}} </h4>
                        <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">ویلا بلوک آبشار | 140 متر مربع</a></h3>
                        <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                        <div class="fw-bold"><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>2560000 تومان</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap"><span class="d-inline-block mx-1 px-2 fs-sm">4<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">2<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">2<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
                </div>
            </div>

        </div>

        @endforeach
    </div>
</section>
@endif;


@include('partials.home.footer')