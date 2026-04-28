 <?php
    $img = url('/') . "/img/blank.png";
    if (isset($media[0]) && !empty($media[0])) {
        $img = url('/') . "/upload/property/" . $p->id . "/" . $media[0];
    }
    ?>

 

 <!-- Item-->
 <div class="col">
     <div class="card shadow-sm card-hover border-0 h-100">
         <div class="card-img-top card-img-hover"><a class="img-overlay" href="{url('/')}}/p/{{$p->id}}/{{str_replace(' ','-',$p->title)}}"></a>
             <!-- <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-success mb-1">تایید</span>
                <span class="d-table badge bg-info">جدید</span>
              </div> -->
             <div class="content-overlay end-0 top-0 pt-3 pe-3">
                 <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="افزودن به علاقه مندی"><i class="fi-heart"></i></button>
             </div>

             <img src="{{ $img }}" alt="{{ $p->title }}">


         </div>
         <div class="card-body position-relative pb-3">
             <h4 class="mb-1 fs-sm fw-normal text-uppercase text-primary">{{getCat($p -> category)}}</h4>
             <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="{{url('/')}}/p/{{$p->id}}/{{str_replace(' ','-',$p->title)}}">{{$p -> title}}</a></h3>

         <div><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>{{number_format($p -> regular_days)}} تومان</div>
         <div><i class="fi-rent mt-n1 me-2 lead align-middle opacity-70"></i>{{number_format($p -> weekend)}} تومان</div>
         </div>

         <div class=" card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap">
             <span class="d-inline-block me-4 fs-sm">{{$p->area}}<i class="fi-home ms-1 mt-n1 fs-lg text-muted"></i></span>
             <span class="d-inline-block me-4 fs-sm">{{$p->standard_capacity}}<i class="fi-user-check ms-1 mt-n1 fs-lg text-muted"></i></span>
             <span class="d-inline-block me-4 fs-sm">{{$p->extra_capacity}}<i class="fi-user-plus ms-1 mt-n1 fs-lg text-muted"></i></span>
             <span class="d-inline-block fs-sm">{{$p->floor}}<i class="fi-layers ms-1 mt-n1 fs-lg text-muted"></i></span>
             <span class="d-inline-block ms-4 fs-sm">{{$p->check_in_time}}<i class="fi-calendar ms-1 mt-n1 fs-lg text-muted"></i></span>
         </div>
     </div>
 </div>