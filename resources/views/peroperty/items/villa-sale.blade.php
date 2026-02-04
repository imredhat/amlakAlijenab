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
<<<<<<< HEAD
            return "رهن و اجاره اداری، تجاری و صنعتی";
            break;
        case 'commercial-sale':
            return "خرید و فروش اداری، تجاری و صنعتی";
=======
            return "رهن و اجاره تجاری";
            break;
        case 'commercial-sale':
            return "خرید و فروش تجاری";
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
            break;
        case 'land':
            return "زمین و باغ";
            break;
<<<<<<< HEAD
        case 'pre-sale':
            return "پیش فروش و مشارکت در ساخت";
            break;

=======
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
        default:
            break;
    }
}

$media = json_decode($property[0]->media);

?>


<<<<<<< HEAD
=======


>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
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
<<<<<<< HEAD
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

=======
                        <div class="tns-carousel-inner equal-height-cover"
                            data-carousel-options='{"navAsThumbnails": true, "navContainer": "#thumbnails", "gutter": 12, "responsive": {"0":{"controls": false},"500":{"controls": true}}}'> 
                            @foreach($media as $m);
                            <div><img class="rounded-3" src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Image"></div>
                            @endforeach;
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
                        </div>
                    </div>
                    <!-- Thumbnails nav-->
                    <ul class="tns-thumbnails mb-4" id="thumbnails">
<<<<<<< HEAD

                        @foreach($media as $m);
                        <li class="tns-thumbnail"><img src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Thumbnail"></li>
                        @endforeach;

                        <!-- <li class="tns-thumbnail">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100"><i class="fi-play-circle fs-4 mb-1"></i><span>مشاهده</span></div>
                        </li> -->

=======
                        @foreach($media as $m);
                        <li class="tns-thumbnail"><img src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Thumbnail"></li>
                        @endforeach;
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
                    </ul>
                </div>
                <!-- Page title + Features-->
                <div class="order-lg-2 order-1 mt-3">
                    <h1 class="h2 mb-2">{{$property[0] -> title}}</h1>
                    <p class="mb-2 pb-1 fs-base">{{$property[0] -> address}}</p>
                    <ul class="d-flex mb-4 pb-lg-2 list-unstyled">
<<<<<<< HEAD
                        <li class="me-3 pe-3 border-end"><b class="me-1"></b><i class="fi-home mt-n1 lead align-middle text-muted"></i> {{$property[0] -> area}}</li>
=======
                        <li class="me-3 pe-3 border-end"><b class="me-1"></b><i class="fi-home mt-n1 lead align-middle text-muted"></i> ویلا</li>
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
                        <li class="me-3 pe-3 border-end"><b class="me-1"></b><i class="fi-house-chosen mt-n1 lead align-middle text-muted"></i> {{$property[0] -> city}}</li>
                    </ul>
                </div>
            </div>
            <!-- Overview-->
            <h2 class="h5">توضیحات</h2>
<<<<<<< HEAD
            <p class="mb-4 pb-2"><?php echo nl2br($property[0] -> description)?></p>
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
=======
            <p class="mb-4 pb-2"><?php echo nl2br($property[0]->description) ?></p>

            <!-- امکانات ویلا -->
            <div class="mb-sm-3 mt-4">
                <h3 class="h5 mb-3">ویژگی‌های ویلا</h3>
                
                <ul class="list-unstyled row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-1 mb-1 text-nowrap">
                    <?php if (isset($property[0]->parking) && $property[0]->parking === 'دارد'): ?><li class="col"><i class="fi-parking mt-n1 me-2 fs-lg align-middle"></i>پارکینگ</li><?php endif; ?>
                    <?php if (isset($property[0]->storage) && $property[0]->storage === 'دارد'): ?><li class="col"><i class="fi-gearbox mt-n1 me-2 fs-lg align-middle"></i>انباری</li><?php endif; ?>
                    <?php if (isset($property[0]->balcony) && $property[0]->balcony === 'دارد'): ?><li class="col"><i class="fi-real-estate-house mt-n1 me-2 fs-lg align-middle"></i>بالکن</li><?php endif; ?>
                    <?php if (isset($property[0]->pool_type) && !empty($property[0]->pool_type)): ?><li class="col"><i class="fi-swimming-pool mt-n1 me-2 fs-lg align-middle"></i>استخر <?php echo $property[0]->pool_type; ?></li><?php endif; ?>
                    <?php if (isset($property[0]->cooling_system) && !empty($property[0]->cooling_system)): ?><li class="col"><i class="fi-snowflake mt-n1 me-2 fs-lg align-middle"></i><?php echo $property[0]->cooling_system; ?></li><?php endif; ?>
                        <!-- نوع ساختمان -->
                        <?php if (isset($property[0]->building_type) && !empty($property[0]->building_type)): ?><li class="col"><i class="fi-home mt-n1 me-2 fs-lg align-middle"></i>نوع: <?php echo $property[0]->building_type; ?></li><?php endif; ?>
                        
                        <!-- جهت ساختمان -->
                        <?php if (isset($property[0]->building_direction) && !empty($property[0]->building_direction)): ?><li class="col"><i class="fi-compass mt-n1 me-2 fs-lg align-middle"></i>جهت: <?php echo $property[0]->building_direction; ?></li><?php endif; ?>
                        
                        <!-- نوع کف -->
                        <?php if (isset($property[0]->floor_type) && !empty($property[0]->floor_type)): ?><li class="col"><i class="fi-layers mt-n1 me-2 fs-lg align-middle"></i>کف: <?php echo $property[0]->floor_type; ?></li><?php endif; ?>
                        
                        <!-- نوع سند -->
                        <?php if (isset($property[0]->document_type) && !empty($property[0]->document_type)): ?><li class="col"><i class="fi-file-text mt-n1 me-2 fs-lg align-middle"></i>سند: <?php echo $property[0]->document_type; ?></li><?php endif; ?>
                        
                </ul>
                
              
            </div>

            @if(isset($agent[0] -> name))
            <h2 class="h5">{{$agent[0] -> company}}</h2>
            <div class="card card-horizontal">
                <div class="card-img-top bg-position-center-x" style="background-image: url({{url('/')}}/img/real-estate/agents/03.jpg);"></div>
                <blockquote class="blockquote card-body p-4">
                    <p class="mb-4">{{$agent[0] -> bio}}</p>
                    <footer class="d-flex justify-content-between">
                        <div class="pe-3">
                            <h6 class="mb-0">{{$agent[0] -> name}}</h6>
                            <div class="text-muted fw-normal fs-sm mb-3">نماینده گروه {{$agent[0] -> company}}</div>
                            <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="https://instagram.com/{{$agent[0] -> instagram}}"><i class="fi-instagram"></i></a>
                            <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="https://t.me/{{$agent[0] -> telegram}}"><i class="fi-telegram"></i></a>
                            <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle me-2 mb-2" href="https://wa.me/{{$agent[0] -> whatsapp}}"><i class="fi-whatsapp"></i></a>
                        </div>
                    </footer>
                </blockquote>
            </div>
            @endif
        </div>
        
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
        <!-- Sidebar with details-->
        <aside class="col-lg-5">
            <div class="ps-lg-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
<<<<<<< HEAD
                    <div><span class="badge bg-success me-2 mb-2">{{$property[0] -> status}}</span><span class="badge bg-info me-2 mb-2">جدید</span></div>
=======
                    <div><span class="badge bg-success me-2 mb-2">{{$property[0] -> status}}</span><span class="badge bg-info me-2 mb-2">ویلا</span></div>
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
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
<<<<<<< HEAD
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
                <!-- Amenities-->
                <div class="card border-0 bg-secondary mb-4">
                    <div class="card-body">
                        <h5>امکانات رفاهی</h5>
                        <ul class="list-unstyled row row-cols-md-2 row-cols-1 gy-2 mb-0 text-nowrap">
                            <li class="col"><i class="fi-wifi mt-n1 me-2 fs-lg align-middle"></i>وای فای</li>
                            <li class="col"><i class="fi-thermometer mt-n1 me-2 fs-lg align-middle"></i>سیستم گرمایشی</li>
                            <li class="col"><i class="fi-dish mt-n1 me-2 fs-lg align-middle"></i>استخر </li>
                            <li class="col"><i class="fi-parking mt-n1 me-2 fs-lg align-middle"></i>پارکینگ</li>
                            <li class="col"><i class="fi-snowflake mt-n1 me-2 fs-lg align-middle"></i>تهویه هوا</li>
                            <li class="col"><i class="fi-iron mt-n1 me-2 fs-lg align-middle"></i>گاز رومیزی</li>
                            <li class="col"><i class="fi-tv mt-n1 me-2 fs-lg align-middle"></i>تلویزیون</li>
                            <li class="col"><i class="fi-laundry mt-n1 me-2 fs-lg align-middle"></i>ماشین لباسشویی</li>
                            <li class="col"><i class="fi-cctv mt-n1 me-2 fs-lg align-middle"></i>دوربین مداربسته</li>
                            <li class="col"><i class="fi-no-smoke mt-n1 me-2 fs-lg align-middle"></i>سیگار ممنوع</li>
                        </ul>
                        <div class="collapse" id="seeMoreAmenities">
                            <ul class="list-unstyled row row-cols-md-2 row-cols-1 gy-2 pt-2 mb-0 text-nowrap">
                                <li class="col"><i class="fi-double-bed mt-n1 me-2 fs-lg align-middle"></i>2 خواب</li>
                                <li class="col"><i class="fi-bed mt-n1 me-2 fs-lg align-middle"></i>1 خواب</li>
                            </ul>
                        </div><a class="collapse-label collapsed d-inline-block mt-3" href="real-estate-single-v2.html#seeMoreAmenities" data-bs-toggle="collapse" data-bs-label-collapsed="مشاهده بیشتر" data-bs-label-expanded="بستن" role="button" aria-expanded="false" aria-controls="seeMoreAmenities"></a>
                    </div>
                </div>
                <!-- Not included in rent-->
                <div class="card border-0 bg-secondary mb-4">
                    <div class="card-body">
                        <h5>شامل اجاره نمی شود</h5>
                        <ul class="list-unstyled row row-cols-md-2 row-cols-1 gy-2 mb-0 text-nowrap">
                            <li class="col"><i class="fi-swimming-pool mt-n1 me-2 fs-lg align-middle"></i>استخر</li>
                            <li class="col"><i class="fi-cafe mt-n1 me-2 fs-lg align-middle"></i>رستوران</li>
                            <li class="col"><i class="fi-spa mt-n1 me-2 fs-lg align-middle"></i>سالن ماساژ</li>
                            <li class="col"><i class="fi-cocktail mt-n1 me-2 fs-lg align-middle"></i>کلاپ</li>
                        </ul>
                    </div>
                </div>
                <!-- Post meta-->
                <ul class="d-flex mb-4 list-unstyled fs-sm">
                    <li class="me-3 pe-3 border-end">تاریخ انتشار: <b> 26 بهمن</b></li>
                    <li class="me-3 pe-3 border-end">شماره آگهی: <b>681013232</b></li>
                    <li class="me-3 pe-3">بازدید: <b>48 نفر</b></li>
=======

                <!-- نمایش قیمت -->
                <h3 class="h5 mb-2">قیمت:</h3>
                <h2 class="h3 mb-4 pb-2">{{number_format($property[0]->price)}} تومان</h2>

                <!-- Property details-->
                <div class="card border-0 bg-secondary mb-4">
                    <div class="card-body">
                        <h5 class="mb-0 pb-3">مشخصات ویلا</h5>
                        <ul class="list-unstyled mt-n2 mb-0">
                            <table class="table">
                                <tbody>
                                    <tr><td>نوع</td><td><b>{{getCat($property[0]->category)}}</b></td></tr>
                                    <tr><td>قیمت</td><td><b>{{number_format($property[0]->price)}} تومان</b></td></tr>
                                    <tr><td>تعداد طبقات</td><td><b>{{$property[0]->floor_count ?? ''}}</b></td></tr>
                                    <tr><td>نوع ساختمان</td><td><b>{{$property[0]->building_type ?? ''}}</b></td></tr>
                                    <tr><td>تعداد اتاق</td><td><b>{{$property[0]->rooms ?? ''}}</b></td></tr>
                                    <tr><td>تعداد سرویس بهداشتی</td><td><b>{{$property[0]->toilet ?? ''}}</b></td></tr>
                                    <tr><td>جهت ساختمان</td><td><b>{{$property[0]->building_direction ?? ''}}</b></td></tr>
                                    <tr><td>نوع کف</td><td><b>{{$property[0]->floor_type ?? ''}}</b></td></tr>
                                    <tr><td>سیستم سرمایش</td><td><b>{{$property[0]->cooling_system ?? ''}}</b></td></tr>
                                    <tr><td>نوع سند</td><td><b>{{$property[0]->document_type ?? ''}}</b></td></tr>
                                    <tr><td>نوع استخر</td><td><b>{{$property[0]->pool_type ?? ''}}</b></td></tr>
                                    <?php if(isset($property[0]->parking) && $property[0]->parking === 'دارد'): ?><tr><td>پارکینگ</td><td><b>دارد</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->storage) && $property[0]->storage === 'دارد'): ?><tr><td>انباری</td><td><b>دارد</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->balcony) && $property[0]->balcony === 'دارد'): ?><tr><td>بالکن</td><td><b>دارد</b></td></tr><?php endif; ?>
                                    <tr><td>استان</td><td><b>{{$property[0]->province}}</b></td></tr>
                                    <tr><td>شهر</td><td><b>{{$property[0]->city}}</b></td></tr>
                                    <tr><td>فروشنده/نماینده</td><td><b>{{$property[0]->name.' '.$property[0]->last_name}} ({{$property[0]->company ?? 'بدون شرکت'}})</b></td></tr>
                                </tbody>
                            </table>
                        </ul>
                    </div>
                </div>

                <a class="btn btn-lg btn-primary w-100 mb-3" href="tel:{{$property[0] -> tel}}">{{$property[0] -> tel}}</a>
                <a class="d-inline-block mb-4 pb-2 text-decoration-none" href="{{url('/')}}/page/faqs"><i class="fi-help me-2 mt-n1 align-middle"></i>سوالات متداول</a>

                <!-- Post meta-->
                <ul class="d-flex mb-4 list-unstyled fs-sm">
                    <li class="me-3 pe-3 border-end">تاریخ انتشار: <b> <?= date('d F Y') ?></b></li>
                    <li class="me-3 pe-3">بازدید: <b>{{$property[0] -> visit_count ?? 0}} نفر</b></li>
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232
                </ul>
            </div>
        </aside>
    </div>
</section>
<<<<<<< HEAD
<!-- Recently viewed-->
<section class="container mb-5 pb-2 pb-lg-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h3 mb-0">بازدیدهای اخیر</h2><a class="btn btn-link fw-normal p-0" href="real-estate-catalog-rent.html">مشاهده همه<i class="fi-arrow-long-left ms-2"></i></a>
    </div>
    <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2">
        <div class="tns-carousel-inner row gx-4 mx-0 pt-3 pb-4" data-carousel-options="{&quot;items&quot;: 4, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;992&quot;:{&quot;items&quot;:4}}}">
            <!-- Item-->
            <div class="col">
                <div class="card shadow-sm card-hover border-0 h-100">
                    <div class="card-img-top card-img-hover"><a class="img-overlay" href="https://fixdevelopdemo.ir/theme/finder/demo/real-estate-single-v1-v1.html"></a>
                        <div class="content-overlay end-0 top-0 pt-3 pe-3">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="نشان کردن"><i class="fi-heart"></i></button>
                        </div><img src="img/real-estate/catalog/39.jpg" alt="Image">
                    </div>
                    <div class="card-body position-relative pb-3">
                        <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">فروش</h4>
                        <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">ویلا بلوک آبشار | 140 متر مربع</a></h3>
                        <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                        <div class="fw-bold"><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>2560000 تومان</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap"><span class="d-inline-block mx-1 px-2 fs-sm">4<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">2<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">2<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
                </div>
            </div>
            <!-- Item-->
            <div class="col">
                <div class="card shadow-sm card-hover border-0 h-100">
                    <div class="card-img-top card-img-hover"><a class="img-overlay" href="https://fixdevelopdemo.ir/theme/finder/demo/real-estate-single-v1-v1.html"></a>
                        <div class="content-overlay end-0 top-0 pt-3 pe-3">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="نشان کردن"><i class="fi-heart"></i></button>
                        </div><img src="img/real-estate/catalog/40.jpg" alt="Image">
                    </div>
                    <div class="card-body position-relative pb-3">
                        <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">اجاره</h4>
                        <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">آپارتمان 2 خواب | 85 متر مربع</a></h3>
                        <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                        <div class="fw-bold"><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>854000 تومان</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap"><span class="d-inline-block mx-1 px-2 fs-sm">3<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">2<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">2<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
                </div>
            </div>
            <!-- Item-->
            <div class="col">
                <div class="card shadow-sm card-hover border-0 h-100">
                    <div class="card-img-top card-img-hover"><a class="img-overlay" href="https://fixdevelopdemo.ir/theme/finder/demo/real-estate-single-v1-v1.html"></a>
                        <div class="content-overlay end-0 top-0 pt-3 pe-3">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="نشان کردن"><i class="fi-heart"></i></button>
                        </div><img src="img/real-estate/catalog/41.jpg" alt="Image">
                    </div>
                    <div class="card-body position-relative pb-3">
                        <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">اجاره</h4>
                        <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">ویلا بلوک آبشار | 140 متر مربع</a></h3>
                        <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                        <div class="fw-bold"><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>187000 تومان</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap"><span class="d-inline-block mx-1 px-2 fs-sm">1<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">1<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">1<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
                </div>
            </div>
            <!-- Item-->
            <div class="col">
                <div class="card shadow-sm card-hover border-0 h-100">
                    <div class="card-img-top card-img-hover"><a class="img-overlay" href="https://fixdevelopdemo.ir/theme/finder/demo/real-estate-single-v1-v1.html"></a>
                        <div class="content-overlay end-0 top-0 pt-3 pe-3">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="نشان کردن"><i class="fi-heart"></i></button>
                        </div><img src="img/real-estate/catalog/42.jpg" alt="Image">
                    </div>
                    <div class="card-body position-relative pb-3">
                        <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">فروش</h4>
                        <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">اقامتگاه ویلایی | 200 متر مربع</a></h3>
                        <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                        <div class="fw-bold"><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>133000 تومان</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap"><span class="d-inline-block mx-1 px-2 fs-sm">1<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">1<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">2<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
                </div>
            </div>
            <!-- Item-->
            <div class="col">
                <div class="card shadow-sm card-hover border-0 h-100">
                    <div class="card-img-top card-img-hover"><a class="img-overlay" href="https://fixdevelopdemo.ir/theme/finder/demo/real-estate-single-v1-v1.html"></a>
                        <div class="content-overlay end-0 top-0 pt-3 pe-3">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="نشان کردن"><i class="fi-heart"></i></button>
                        </div><img src="img/real-estate/catalog/43.jpg" alt="Image">
                    </div>
                    <div class="card-body position-relative pb-3">
                        <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">فروش</h4>
                        <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">ویلا بلوک آبشار | 250 متر مربع</a></h3>
                        <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                        <div class="fw-bold"><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>658000 تومان</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap"><span class="d-inline-block mx-1 px-2 fs-sm">1<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">1<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block mx-1 px-2 fs-sm">2<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
                </div>
            </div>
        </div>
    </div>
</section>

=======

@if(isset($similar) && count($similar)>0)
<!-- Recently viewed-->
<section class="container mb-5 pb-2 pb-lg-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h3 mb-0">آگهی های مشابه</h2>
    </div>
    <div class="tns-carousel-wrapper similar tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2">
        <div class="tns-carousel-inner row gx-4 mx-0 pt-3 pb-4"
            data-carousel-options='{"items": 4, "rtl": true, "controlsText": ["<i class=\"fi-chevron-left\"></i>", "<i class=\"fi-chevron-right\"></i>"], "responsive": {"0":{"items":1},"500":{"items":2},"768":{"items":3},"992":{"items":4}}}'> 
            
            @foreach($similar as $s)
            <?php $Smedia = json_decode($s->media); ?>

            <!-- Item-->
            <div class="col">
                <div class="card shadow-sm card-hover border-0 h-100">
                    <div class="card-img-top card-img-hover">
                        <a class="img-overlay" href="{{url('/')}}/p/{{$s->id}}/{{str_replace(' ','-',$s->title)}}"></a>
                        <div class="content-overlay end-0 top-0 pt-3 pe-3">
                            <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="نشان کردن"><i class="fi-heart"></i></button>
                        </div>
                        <img src="{{url('/')}}/upload/property/{{$s->id}}/{{$Smedia[0]}}" alt="Image">
                    </div>
                    <?php $cat = $s->category ;?>
                    @include("peroperty.items.similar.".$cat."_similar")
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif;

<style>
    #thumbnails.tns-thumbnails {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 1rem;
        padding: 0;
        list-style: none;
    }

    #thumbnails.tns-thumbnails .tns-thumbnail {
        width: 80px;
        height: 60px;
        overflow: hidden;
        border-radius: 6px;
        cursor: pointer;
        opacity: 0.6;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
    }

    #thumbnails.tns-thumbnails .tns-thumbnail:hover {
        opacity: 0.8;
        transform: translateY(-2px);
    }

    #thumbnails.tns-thumbnails .tns-thumbnail.tns-nav-active {
        opacity: 1;
        border-color: #007bff;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    }

    #thumbnails.tns-thumbnails .tns-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.3s ease;
    }

    #thumbnails.tns-thumbnails .tns-thumbnail:hover img {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        #thumbnails.tns-thumbnails .tns-thumbnail {
            width: 70px;
            height: 52.5px;
        }
    }

    @media (max-width: 576px) {
        #thumbnails.tns-thumbnails .tns-thumbnail {
            width: 60px;
            height: 45px;
        }
    }
</style>
>>>>>>> 8c567890bce8ec0bb0bcfb499ebb6004d2290232

@include('partials.home.footer')