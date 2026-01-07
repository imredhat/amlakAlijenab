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
            <ul class="nav nav-tabs border-bottom mb-4" role="tablist">
              <li class="nav-item mb-3"><a class="nav-link active" href="real-estate-account-properties.html#" role="tab" aria-selected="true"><i class="fi-file fs-base me-2"></i>منتشر شده</a></li>
              <li class="nav-item mb-3"><a class="nav-link" href="real-estate-account-properties.html#" role="tab" aria-selected="false"><i class="fi-file-clean fs-base me-2"></i>پیش نویس</a></li>
              <li class="nav-item mb-3"><a class="nav-link" href="real-estate-account-properties.html#" role="tab" aria-selected="false"><i class="fi-archive fs-base me-2"></i>آرشیو</a></li>
            </ul>
            <!-- Item-->
            <div class="card card-hover card-horizontal border-0 shadow-sm mb-4"><a class="card-img-top" href="real-estate-single-v1.html" style="background-image: url({{url('')}}/img/real-estate/catalog/08.jpg);">
                <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-info">جدید</span></div></a>
              <div class="card-body position-relative pb-3">
                <div class="dropdown position-absolute zindex-5 top-0 end-0 mt-3 me-3">
                  <button class="btn btn-icon btn-light btn-xs rounded-circle shadow-sm" type="button" id="contextMenu1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-dots-vertical"></i></button>
                  <ul class="dropdown-menu my-1" aria-labelledby="contextMenu1">
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-edit opacity-60 me-2"></i>ویرایش</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-flame opacity-60 me-2"></i>نردبان</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-power opacity-60 me-2"></i>غیرفعال</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-trash opacity-60 me-2"></i>حذف</button>
                    </li>
                  </ul>
                </div>
                <h4 class="mb-1 fs-sm fw-normal text-uppercase text-primary">اجاره</h4>
                <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">آپارتمان 2 خواب | 85 متر مربع</a></h3>
                <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                <div><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>شروع قیمت از 1550000 ت</div>
                <div class="d-flex align-items-center justify-content-center justify-content-sm-start border-top pt-3 pb-2 mt-3 text-nowrap"><span class="d-inline-block me-4 fs-sm">5<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block me-4 fs-sm">3<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block fs-sm">2<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
              </div>
            </div>
            <!-- Item-->
            <div class="card card-hover card-horizontal border-0 shadow-sm mb-4"><a class="card-img-top" href="real-estate-single-v1.html" style="background-image: url({{url('')}}/img/real-estate/catalog/10.jpg);">
                <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-success">تایید</span></div></a>
              <div class="card-body position-relative pb-3">
                <div class="dropdown position-absolute zindex-5 top-0 end-0 mt-3 me-3">
                  <button class="btn btn-icon btn-light btn-xs rounded-circle shadow-sm" type="button" id="contextMenu2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-dots-vertical"></i></button>
                  <ul class="dropdown-menu my-1" aria-labelledby="contextMenu2">
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-edit opacity-60 me-2"></i>ویرایش</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-flame opacity-60 me-2"></i>نردبان</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-power opacity-60 me-2"></i>غیرفعال</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-trash opacity-60 me-2"></i>حذف</button>
                    </li>
                  </ul>
                </div>
                <h4 class="mb-1 fs-sm fw-normal text-uppercase text-primary">اجاره</h4>
                <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">ویلا بلوک آبشار | 140 متر مربع</a></h3>
                <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                <div><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>شروع قیمت از 1260000 ت</div>
                <div class="d-flex align-items-center justify-content-center justify-content-sm-start border-top pt-3 pb-2 mt-3 text-nowrap"><span class="d-inline-block me-4 fs-sm">5<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block me-4 fs-sm">2<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block fs-sm">2<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
              </div>
            </div>
            <!-- Item-->
            <div class="card card-hover card-horizontal border-0 shadow-sm"><a class="card-img-top" href="real-estate-single-v1.html" style="background-image: url({{url('')}}/img/real-estate/catalog/22.jpg);">
                <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-success">تایید</span></div></a>
              <div class="card-body position-relative pb-3">
                <div class="dropdown position-absolute zindex-5 top-0 end-0 mt-3 me-3">
                  <button class="btn btn-icon btn-light btn-xs rounded-circle shadow-sm" type="button" id="contextMenu3" data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-dots-vertical"></i></button>
                  <ul class="dropdown-menu my-1" aria-labelledby="contextMenu3">
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-edit opacity-60 me-2"></i>ویرایش</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-flame opacity-60 me-2"></i>نردبان</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-power opacity-60 me-2"></i>غیرفعال</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button"><i class="fi-trash opacity-60 me-2"></i>حذف</button>
                    </li>
                  </ul>
                </div>
                <h4 class="mb-1 fs-sm fw-normal text-uppercase text-primary">فروش</h4>
                <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link" href="real-estate-single-v1.html">اقامتگاه ویلایی | 200 متر مربع</a></h3>
                <p class="mb-2 fs-sm text-muted">ایران، تهران ، خیابان آزادی</p>
                <div><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>شروع قیمت از 1260000 ت</div>
                <div class="d-flex align-items-center justify-content-center justify-content-sm-start border-top pt-3 pb-2 mt-3 text-nowrap"><span class="d-inline-block me-4 fs-sm">3<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block me-4 fs-sm">2<i class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block fs-sm">2<i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    @include('partials.home.footer')