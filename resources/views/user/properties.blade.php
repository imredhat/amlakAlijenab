 @include('partials.home.header')

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
          ?>


         @if(isset($properties))
         @foreach($properties as $p)

          <?php $media = json_decode($p->media); $cat = $p->category ?>

         @include("peroperty.view.".$cat)

         @endforeach

         @else

         salam
         @endif


       </div>
     </div>
   </div>
 </main>

 @include('partials.home.footer')