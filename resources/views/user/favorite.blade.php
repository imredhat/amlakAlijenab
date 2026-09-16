 @include('partials.home.header')

 <style>
      ul.pagination {
      direction: ltr !important;
    }
    </style>
 <main class="page-wrapper">

   @include('partials.home.menu')


   <!-- Page content-->
   <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
     <!-- Breadcrumb-->
     <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
         <li class="breadcrumb-item"><a href="{{url('/')}}/user/profile">حساب کاربری</a></li>
         <li class="breadcrumb-item active" aria-current="page">موردعلاقه ها</li>
       </ol>
     </nav>
     <!-- Page content-->
     <div class="row">

       @include('user.side')

       <!-- Content-->
       <div class="col-lg-8 col-md-7 mb-5">

         <p class="pt-1 mb-4">آگهی های موردعلاقه شما</p>

         @if(isset($properties) && count($properties) > 0)
         @foreach($properties as $p)

         <?php
          $media = [""];
          $cat = $p->category;
          if (isset($p->media) && count(json_decode($p->media)) > 0) {
            $media = json_decode($p->media);
          }

          ?>

         @include("peroperty.favorite-property-list.".$cat)

         @endforeach

         @if($properties->hasPages())
         <div class="border-top pt-4 mt-3">
             <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                 <div class="text-muted small">
                     نمایش {{ $properties->firstItem() }} تا {{ $properties->lastItem() }} از {{ $properties->total() }} نتیجه
                 </div>
                 <div>
                     {{ $properties->appends(request()->query())->links('pagination::persian') }}
                 </div>
             </div>
         </div>
         @endif

         @else
         <div class="text-center py-5">
             <i class="fi-heart fs-1 text-muted"></i>
             <p class="text-muted fs-5 mt-3">هنوز آگهی‌ای به علاقه‌مندی‌ها اضافه نکرده‌اید.</p>
             <a href="{{url('/')}}" class="btn btn-primary mt-2">مشاهده آگهی‌ها</a>
         </div>
         @endif


       </div>
     </div>
   </div>
 </main>

 @include('partials.home.footer')
