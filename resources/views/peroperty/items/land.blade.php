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
            return "رهن و اجاره تجاری";
            break;
        case 'commercial-sale':
            return "خرید و فروش تجاری";
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

$media = url('/') . "/img/blank.png";
$cat = $property[0]->category;
if (isset($property[0]->media) && count(json_decode($property[0]->media)) > 0) {
    $media = json_decode($property[0]->media);
} 

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
                        <div class="tns-carousel-inner equal-height-cover"data-carousel-options='{"navAsThumbnails": true, "navContainer": "#thumbnails", "gutter": 12, "responsive": {"0":{"controls": false},"500":{"controls": true}}}'> 
                        <?php if(is_array($media)): foreach($media as $m):?>
                        <div><img class="rounded-3" src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Image"></div>
                        <?php endforeach; else:?>
                        <div><img width="100%" class="rounded-3" src="{{$media}}" alt="Image"></div>
                        <?php endif;?>
                        </div>
                    </div>
                    <!-- Thumbnails nav-->
                    <ul class="tns-thumbnails mb-4" id="thumbnails">
                        <?php if(is_array($media)): foreach($media as $m):?>
                        <li class="tns-thumbnail"><img src="{{url('/')}}/upload/property/{{$id}}/{{$m}}" alt="Thumbnail"></li>
                        <?php endforeach; endif;?>
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
            <h2 class="h5">توضیحات</h2>
            <p class="mb-4 pb-2"><?php echo nl2br($property[0]->description) ?></p>

            <!-- امکانات زمین -->
            <div class="mb-sm-3 mt-4">
                <h3 class="h5 mb-3">ویژگی‌های زمین</h3>
                
                <ul class="list-unstyled row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-1 mb-1 text-nowrap">
                    <!-- امکانات عمومی (utilities) -->
                    <?php if (isset($property[0]->utilities) && is_array($property[0]->utilities)): ?>
                        <?php if (in_array('آب', $property[0]->utilities)): ?><li class="col"><i class="fi-droplet mt-n1 me-2 fs-lg align-middle"></i>آب</li><?php endif; ?>
                        <?php if (in_array('برق', $property[0]->utilities)): ?><li class="col"><i class="fi-zap mt-n1 me-2 fs-lg align-middle"></i>برق</li><?php endif; ?>
                        <?php if (in_array('گاز', $property[0]->utilities)): ?><li class="col"><i class="fi-flame mt-n1 me-2 fs-lg align-middle"></i>گاز</li><?php endif; ?>
                        <?php if (in_array('تلفن', $property[0]->utilities)): ?><li class="col"><i class="fi-phone mt-n1 me-2 fs-lg align-middle"></i>تلفن</li><?php endif; ?>
                    <?php endif; ?>
                    
                    <!-- ویژگی‌های زمین -->
                    <?php if (isset($property[0]->has_old_building) && $property[0]->has_old_building === 'بله'): ?><li class="col"><i class="fi-home mt-n1 me-2 fs-lg align-middle"></i>ساختمان قدیمی</li><?php endif; ?>
                    <?php if (isset($property[0]->exchangeable) && $property[0]->exchangeable === 'بله'): ?><li class="col"><i class="fi-refresh mt-n1 me-2 fs-lg align-middle"></i>قابل معاوضه</li><?php endif; ?>
                    <?php if (isset($property[0]->building_permit) && !empty($property[0]->building_permit)): ?><li class="col"><i class="fi-file mt-n1 me-2 fs-lg align-middle"></i>پروانه ساخت</li><?php endif; ?>
                        <!-- موقعیت زمین -->
                        <?php if (isset($property[0]->property_location) && !empty($property[0]->property_location)): ?><li class="col"><i class="fi-map-pin mt-n1 me-2 fs-lg align-middle"></i>موقعیت: <?php echo $property[0]->property_location; ?></li><?php endif; ?>
                        
                        <!-- نوع کاربری -->
                        <?php if (isset($property[0]->usage_type) && !empty($property[0]->usage_type)): ?><li class="col"><i class="fi-layers mt-n1 me-2 fs-lg align-middle"></i>کاربری: <?php echo $property[0]->usage_type; ?></li><?php endif; ?>
                        
                        <!-- وضعیت سند -->
                        <?php if (isset($property[0]->document_status) && !empty($property[0]->document_status)): ?><li class="col"><i class="fi-file-text mt-n1 me-2 fs-lg align-middle"></i>سند: <?php echo $property[0]->document_status; ?></li><?php endif; ?>
                        
                        <!-- پروانه ساخت -->
                        <?php if (isset($property[0]->building_permit) && !empty($property[0]->building_permit)): ?><li class="col"><i class="fi-check-circle mt-n1 me-2 fs-lg align-middle"></i><?php echo $property[0]->building_permit; ?></li><?php endif; ?>
                
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

                <!-- نمایش قیمت -->
                <h3 class="h5 mb-2">قیمت:</h3>
                <h2 class="h3 mb-4 pb-2">{{number_format($property[0]->price)}} تومان</h2>

                <!-- Property details-->
                <div class="card border-0 bg-secondary mb-4">
                    <div class="card-body">
                        <h5 class="mb-0 pb-3">مشخصات زمین</h5>
                        <ul class="list-unstyled mt-n2 mb-0">
                            <table class="table">
                                <tbody>
                                    <tr><td>نوع</td><td><b>{{getCat($property[0]->category)}}</b></td></tr>
                                    <tr><td>فروشنده/نماینده</td><td><b>{{$property[0]->name.' '.$property[0]->last_name}} ({{$property[0]->company}})</b></td></tr>
                                    <tr><td>استان</td><td><b>{{$property[0]->province}}</b></td></tr>
                                    <tr><td>شهر</td><td><b>{{$property[0]->city}}</b></td></tr>
                                    <tr><td>متراژ (مترمربع)</td><td><b>{{number_format($property[0]->area)}} متر</b></td></tr>
                                    <tr><td>قیمت</td><td><b>{{number_format($property[0]->price)}} تومان</b></td></tr>
                                    <tr><td>نوع کاربری</td><td><b>{{$property[0]->usage_type ?? ''}}</b></td></tr>
                                    <tr><td>موقعیت زمین</td><td><b>{{$property[0]->property_location ?? ''}}</b></td></tr>
                                    <tr><td>وضعیت سند</td><td><b>{{$property[0]->document_status ?? ''}}</b></td></tr>
                                    <tr><td>پروانه ساخت</td><td><b>{{$property[0]->building_permit ?? ''}}</b></td></tr>
                                    <tr><td>ساختمان قدیمی</td><td><b><?php echo ($property[0]->has_old_building ?? '') === 'بله' ? 'دارد' : 'ندارد'; ?></b></td></tr>
                                    <tr><td>قابل معاوضه</td><td><b><?php echo ($property[0]->exchangeable ?? '') === 'بله' ? 'دارد' : 'ندارد'; ?></b></td></tr>
                                    
                                    <!-- امکانات عمومی -->
                                    <?php if(isset($property[0]->utilities) && is_array($property[0]->utilities) && !empty($property[0]->utilities)): ?>
                                        <tr>
                                            <td>امکانات</td>
                                            <td>
                                                <?php foreach ($property[0]->utilities as $utility): ?>
                                                    <span class="badge bg-light text-dark me-1 mb-1"><?php echo $utility; ?></span>
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
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
    
    .badge.bg-light.text-dark {
        font-size: 0.75rem;
        font-weight: normal;
    }
</style>

@include('partials.home.footer')