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
            return "پیش فروش و مشارکت در ساخت";
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
            return "رهن و اجاره تجاری";
            break;
        case 'commercial-sale':
            return "خرید و فروش تجاری";
            break;
        case 'land':
            return "زمین و باغ";
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
                        <div class="tns-carousel-inner equal-height-cover"
                            data-carousel-options='{"navAsThumbnails": true, "navContainer": "#thumbnails", "gutter": 12, "responsive": {"0":{"controls": false},"500":{"controls": true}}}'> 
                            @foreach($media as $m);
                            <div><img class="rounded-3" src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Image"></div>
                            @endforeach;
                        </div>
                    </div>
                    <!-- Thumbnails nav-->
                    <ul class="tns-thumbnails mb-4" id="thumbnails">
                        @foreach($media as $m);
                        <li class="tns-thumbnail"><img src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Thumbnail"></li>
                        @endforeach;
                    </ul>
                </div>
                <!-- Page title + Features-->
                <div class="order-lg-2 order-1 mt-3">
                    <h1 class="h2 mb-2">{{$property[0] -> title}}</h1>
                    <p class="mb-2 pb-1 fs-base">{{$property[0] -> address}}</p>
                    <ul class="d-flex mb-4 pb-lg-2 list-unstyled">
                        <li class="me-3 pe-3 border-end"><b class="me-1"></b><i class="fi-home mt-n1 lead align-middle text-muted"></i> {{$property[0] -> area}} متر</li>
                        <li class="me-3 pe-3 border-end"><b class="me-1"></b><i class="fi-house-chosen mt-n1 lead align-middle text-muted"></i> {{$property[0] -> city}}</li>
                    </ul>
                </div>
            </div>
            <!-- Overview-->
            <h2 class="h5">توضیحات پروژه</h2>
            <p class="mb-4 pb-2"><?php echo nl2br($property[0]->description) ?></p>

            <!-- جزئیات پروژه -->
            <div class="mb-sm-3 mt-4">
                <h3 class="h5 mb-3">جزئیات پروژه</h3>
                
                <ul class="list-unstyled row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-1 mb-1 text-nowrap">
                    <?php if (isset($property[0]->projectType) && !empty($property[0]->projectType)): ?><li class="col"><i class="fi-briefcase mt-n1 me-2 fs-lg align-middle"></i>نوع پروژه: <?php echo $property[0]->projectType; ?></li><?php endif; ?>
                    <?php if (isset($property[0]->propertyCondition) && !empty($property[0]->propertyCondition)): ?><li class="col"><i class="fi-home mt-n1 me-2 fs-lg align-middle"></i>وضعیت: <?php echo $property[0]->propertyCondition; ?></li><?php endif; ?>
                    <?php if (isset($property[0]->propertyLocation) && !empty($property[0]->propertyLocation)): ?><li class="col"><i class="fi-map-pin mt-n1 me-2 fs-lg align-middle"></i>موقعیت: <?php echo $property[0]->propertyLocation; ?></li><?php endif; ?>
                    <?php if (isset($property[0]->documentStatus) && !empty($property[0]->documentStatus)): ?><li class="col"><i class="fi-file-text mt-n1 me-2 fs-lg align-middle"></i>وضعیت سند: <?php echo $property[0]->documentStatus; ?></li><?php endif; ?>
                    <?php if (isset($property[0]->constructionPermit) && !empty($property[0]->constructionPermit)): ?><li class="col"><i class="fi-check-circle mt-n1 me-2 fs-lg align-middle"></i>پروانه: <?php echo $property[0]->constructionPermit; ?></li><?php endif; ?>
                    <?php if (isset($property[0]->exchange) && $property[0]->exchange === 'on'): ?><li class="col"><i class="fi-refresh mt-n1 me-2 fs-lg align-middle"></i>قابل معاوضه</li><?php endif; ?>
                                      <!-- درصد مشارکت -->
                        <?php if (isset($property[0]->participationPercent) && !empty($property[0]->participationPercent)): ?><li class="col"><i class="fi-percent mt-n1 me-2 fs-lg align-middle"></i>درصد مشارکت: <?php echo $property[0]->participationPercent; ?>%</li><?php endif; ?>
                        
                        <!-- واحد در طبقه -->
                        <?php if (isset($property[0]->unitsPerFloor) && !empty($property[0]->unitsPerFloor)): ?><li class="col"><i class="fi-layers mt-n1 me-2 fs-lg align-middle"></i>واحد در طبقه: <?php echo $property[0]->unitsPerFloor; ?></li><?php endif; ?>
                        
                        <!-- حداقل متراژ واحد -->
                        <?php if (isset($property[0]->minUnitArea) && !empty($property[0]->minUnitArea)): ?><li class="col"><i class="fi-maximize mt-n1 me-2 fs-lg align-middle"></i>حداقل واحد: <?php echo $property[0]->minUnitArea; ?> متر</li><?php endif; ?>
                        
                        <!-- سازنده -->
                        <?php if (isset($property[0]->builderName) && !empty($property[0]->builderName)): ?><li class="col"><i class="fi-user mt-n1 me-2 fs-lg align-middle"></i>سازنده: <?php echo $property[0]->builderName; ?></li><?php endif; ?>
                        
                        <!-- پرداخت‌ها -->
                        <?php if (isset($property[0]->initialPayment) && !empty($property[0]->initialPayment)): ?><li class="col"><i class="fi-credit-card mt-n1 me-2 fs-lg align-middle"></i>پیش پرداخت: <?php echo $property[0]->initialPayment; ?>%</li><?php endif; ?>
                        <?php if (isset($property[0]->deliveryPayment) && !empty($property[0]->deliveryPayment)): ?><li class="col"><i class="fi-calendar mt-n1 me-2 fs-lg align-middle"></i>پرداخت تحویل: <?php echo $property[0]->deliveryPayment; ?>%</li><?php endif; ?>
                                           <!-- پیشرفت پروژه -->
                        <?php if (isset($property[0]->projectStatus) && !empty($property[0]->projectStatus)): ?><li class="col"><i class="fi-settings mt-n1 me-2 fs-lg align-middle"></i>وضعیت ساخت: <?php echo $property[0]->projectStatus; ?></li><?php endif; ?>

              
                    </ul>
          
            </div>

            <!-- نوار پیشرفت -->
            <?php if (isset($property[0]->physicalProgress) && !empty($property[0]->physicalProgress)): ?>
            <div class="mt-4 mb-4">
                <h3 class="h5 mb-3">پیشرفت فیزیکی پروژه</h3>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                         role="progressbar" 
                         style="width: <?= $property[0]->physicalProgress ?>%;" 
                         aria-valuenow="<?= $property[0]->physicalProgress ?>" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        <?= $property[0]->physicalProgress ?>%
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <small>شروع</small>
                    <small><?= $property[0]->physicalProgress ?>% تکمیل</small>
                    <small>پایان</small>
                </div>
            </div>
            <?php endif; ?>

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
        
        <!-- Sidebar with details-->
        <aside class="col-lg-5">
            <div class="ps-lg-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div><span class="badge bg-success me-2 mb-2">{{$property[0] -> status}}</span><span class="badge bg-info me-2 mb-2">پیش فروش</span></div>
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

                <!-- نمایش قیمت -->
                <h3 class="h5 mb-2">قیمت کل پروژه:</h3>
                <h2 class="h3 mb-4 pb-2">{{number_format($property[0]->price)}} تومان</h2>

                <!-- تاریخ تحویل -->
                <?php if (isset($property[0]->deliveryYear) || isset($property[0]->deliveryMonth)): ?>
                <div class="mb-4">
                    <h3 class="h5 mb-2">تاریخ تحویل:</h3>
                    <div class="d-flex align-items-center">
                        <i class="fi-calendar fs-4 text-primary me-3"></i>
                        <div>
                            <h4 class="h6 mb-0">سال <?= $property[0]->deliveryYear ?? '' ?> - ماه <?= $property[0]->deliveryMonth ?? '' ?></h4>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Property details-->
                <div class="card border-0 bg-secondary mb-4">
                    <div class="card-body">
                        <h5 class="mb-0 pb-3">مشخصات پروژه</h5>
                        <ul class="list-unstyled mt-n2 mb-0">
                            <table class="table">
                                <tbody>
                                    <tr><td>نوع</td><td><b>{{getCat($property[0]->category)}}</b></td></tr>
                                    <tr><td>متراژ کل (مترمربع)</td><td><b>{{number_format($property[0]->area)}} متر</b></td></tr>
                                    <tr><td>قیمت کل</td><td><b>{{number_format($property[0]->price)}} تومان</b></td></tr>
                                    <?php if(isset($property[0]->propertyCondition) && !empty($property[0]->propertyCondition)): ?><tr><td>وضعیت ملک</td><td><b>{{$property[0]->propertyCondition}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->projectType) && !empty($property[0]->projectType)): ?><tr><td>نوع پروژه</td><td><b>{{$property[0]->projectType}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->propertyLocation) && !empty($property[0]->propertyLocation)): ?><tr><td>موقعیت</td><td><b>{{$property[0]->propertyLocation}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->roomCount) && !empty($property[0]->roomCount)): ?><tr><td>تعداد اتاق</td><td><b>{{$property[0]->roomCount}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->documentStatus) && !empty($property[0]->documentStatus)): ?><tr><td>وضعیت سند</td><td><b>{{$property[0]->documentStatus}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->participationPercent) && !empty($property[0]->participationPercent)): ?><tr><td>درصد مشارکت</td><td><b>{{$property[0]->participationPercent}}%</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->totalFloors) && !empty($property[0]->totalFloors)): ?><tr><td>تعداد طبقات</td><td><b>{{$property[0]->totalFloors}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->initialPayment) && !empty($property[0]->initialPayment)): ?><tr><td>پیش پرداخت</td><td><b>{{$property[0]->initialPayment}}%</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->deliveryPayment) && !empty($property[0]->deliveryPayment)): ?><tr><td>پرداخت تحویل</td><td><b>{{$property[0]->deliveryPayment}}%</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->projectStatus) && !empty($property[0]->projectStatus)): ?><tr><td>وضعیت ساخت</td><td><b>{{$property[0]->projectStatus}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->deliveryYear) && !empty($property[0]->deliveryYear)): ?><tr><td>سال تحویل</td><td><b>{{$property[0]->deliveryYear}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->deliveryMonth) && !empty($property[0]->deliveryMonth)): ?><tr><td>ماه تحویل</td><td><b>{{$property[0]->deliveryMonth}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->physicalProgress) && !empty($property[0]->physicalProgress)): ?><tr><td>پیشرفت فیزیکی</td><td><b>{{$property[0]->physicalProgress}}%</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->unitsPerFloor) && !empty($property[0]->unitsPerFloor)): ?><tr><td>واحد در طبقه</td><td><b>{{$property[0]->unitsPerFloor}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->minUnitArea) && !empty($property[0]->minUnitArea)): ?><tr><td>حداقل متراژ واحد</td><td><b>{{$property[0]->minUnitArea}} متر</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->builderName) && !empty($property[0]->builderName)): ?><tr><td>نام سازنده</td><td><b>{{$property[0]->builderName}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->constructionPermit) && !empty($property[0]->constructionPermit)): ?><tr><td>پروانه ساخت</td><td><b>{{$property[0]->constructionPermit}}</b></td></tr><?php endif; ?>
                                    <?php if(isset($property[0]->exchange) && $property[0]->exchange === 'on'): ?><tr><td>قابل معاوضه</td><td><b>دارد</b></td></tr><?php endif; ?>
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
                </ul>
            </div>
        </aside>
    </div>
</section>

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
    
    .progress {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .progress-bar {
        font-weight: bold;
    }
</style>

@include('partials.home.footer')