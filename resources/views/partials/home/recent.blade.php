
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


<section class="container mb-5 pb-md-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="h3 mb-0 ">خانه های ویژه ما</h2><a class="btn btn-link fw-normal p-0" href="real-estate-catalog-rent.html">مشاهده همه <i class="fi-arrow-long-left ms-2"></i></a>
    </div>
    <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2" dir="ltr">
      <div class="tns-carousel-inner row gx-4 mx-0 pt-3 pb-4" data-carousel-options="{&quot;items&quot;: 4, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;992&quot;:{&quot;items&quot;:4}}}">



         @if(isset($recent))
         @foreach($recent as $p)

         <?php
          $media = [""];
          $cat = $p->category;
          if (isset($p->media) && count(json_decode($p->media)) > 0) {
            $media = json_decode($p->media);
          }

          ?>

         @include("partials.properties.".$cat)

         @endforeach

         @else

         <!-- salam -->
         @endif

        

      </div>
    </div>
  </section>