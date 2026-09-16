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
         <li class="breadcrumb-item"><a href="real-estate-home-v1.html">خانه</a></li>
         <li class="breadcrumb-item"><a href="real-estate-account-info.html">حساب کاربری</a></li>
         <li class="breadcrumb-item active" aria-current="page">املاک من</li>
       </ol>
     </nav>
     <!-- Page content-->
     <div class="row">





       @include('user.side')




       <!-- Content-->
       <div class="col-lg-8 col-md-7 mb-5">

         <p class="pt-1 mb-4">در اینجا می توانید پیشنهادات ملک خود را مشاهده کرده و به راحتی آنها را ویرایش کنید.</p>
         <!-- Nav tabs-->
         <!-- <ul class="nav nav-tabs border-bottom mb-4" role="tablist">
           <li class="nav-item mb-3"><a class="nav-link active" href="real-estate-account-properties.html#" role="tab" aria-selected="true"><i class="fi-file fs-base me-2"></i>منتشر شده</a></li>
           <li class="nav-item mb-3"><a class="nav-link" href="real-estate-account-properties.html#" role="tab" aria-selected="false"><i class="fi-file-clean fs-base me-2"></i>پیش نویس</a></li>
           <li class="nav-item mb-3"><a class="nav-link" href="real-estate-account-properties.html#" role="tab" aria-selected="false"><i class="fi-archive fs-base me-2"></i>آرشیو</a></li>
         </ul> -->



         @if(isset($properties))
         @foreach($properties as $p)

         <?php
          $media = [""];
          $cat = $p->category;
          $decodedMedia = isset($p->media) ? json_decode($p->media) : null;
          if (is_array($decodedMedia) && count($decodedMedia) > 0) {
            $media = $decodedMedia;
          }

          ?>

         @include("peroperty.profile-property-list.".$cat)

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

         <!-- salam -->
         @endif


       </div>
     </div>
   </div>
 </main>

 @include('partials.home.footer')
