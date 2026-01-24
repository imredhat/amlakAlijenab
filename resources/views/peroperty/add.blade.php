@include('partials.header')
@include('partials.home.menu')





<!-- Page container-->
<div class="container mt-5 mb-md-4 py-5">
  <div class="row">
    <!-- Page content-->
    <div class="col-lg-12 add-property">
      <!-- Breadcrumb-->
      <nav class="mb-3 pt-md-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="real-estate-home-v1.html">خانه</a></li>
          <li class="breadcrumb-item active" aria-current="page">ثبت ملک</li>
        </ol>
      </nav>
      <!-- Title-->

      <!-- Basic info-->
      <form enctype="multipart/form-data" action="{{url('')}}/property/save" method="post">


        <section class="card card-body border-0 shadow-sm p-4 mb-4" id="basic-info">
          <h2 class="h5 mb-4"><i class="fi-info-circle text-primary fs-5 mt-n1 me-2"></i>اطلاعات پایه</h2>

          <div class="row">

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="category">دسته بندی <span class="text-danger">*</span></label>
              <select class="form-select" id="category" required name="category">

                <option value="">انتخاب کنید</option>
                <option value="villa-sale">خرید و فروش ویلا</option>
                <option value="apartment-rent">رهن و اجاره خانه و آپارتمان</option>
                <option value="apartment-sale">خرید و فروش خانه و آپارتمان</option>
                <option value="villa-short-rent">اجاره کوتاه مدت ویلا، سوئیت</option>
                <option value="commercial-rent">رهن و اجاره اداری، تجاری و صنعتی</option>
                <option value="commercial-sale">خرید و فروش اداری، تجاری و صنعتی</option>
                <option value="land">زمین و باغ</option>
                <option value="pre-sale">پیش فروش و مشارکت در ساخت</option>
                <option value="other">سایر املاک</option>

              </select>
            </div>




            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="title">عنوان <span class="text-danger">*</span></label>
              <input class="form-control" type="text" id="title" placeholder="نام ملک" value="" required name="title">
            </div>


            <div class="pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="description">توضیحات <span class="text-danger">*</span></label>
              <textarea style="min-height: 200px;" class="form-control" id="description" placeholder="توضیحات مناسبی برای آگهی تان وارد کنید." required name="description"></textarea>
            </div>

            <div class="row">
              <div class="col-sm-12" id="category_holder"></div>
            </div>

            <script>
              document.getElementById('category').addEventListener('change', function() {
                const category = this.value;
                const categoryHolder = document.getElementById('category_holder');

                if (category) {
                  fetch(`/property/getCategory/${category}`)
                    .then(response => response.text())
                    .then(html => {
                      categoryHolder.innerHTML = html;
                    })
                    .catch(error => console.error('Error:', error));
                } else {
                  categoryHolder.innerHTML = '';
                }
              });
            </script>







        </section>
        <!-- Location-->
        <section class="card card-body border-0 shadow-sm p-4 mb-4" id="location">
          <h2 class="h5 mb-4"><i class="fi-mpin text-primary fs-5 mt-n1 me-2"></i>موقعیت مکانی</h2>
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label class="form-label" for="province"> استان <span class="text-danger">*</span></label>
              <select class="form-select" id="province" required name="province">
                <option value="" disabled>انتخاب استان</option>
                <option value="تهران">تهران</option>
                <option value="مشهد">مشهد</option>
                <option value="اصفهان">اصفهان</option>
                <option value="خوزستان">خوزستان</option>
                <option value="گیلان">گیلان</option>
                <option value="فارس">فارس</option>
                <option value="لرستان">لرستان</option>

                <option value="مازندران" selected>مازندران</option>
              </select>
            </div>
            <div class="col-sm-6 mb-3">
              <label class="form-label" for="city">شهر <span class="text-danger">*</span></label>
              <select class="form-select" id="city" required name="city">
                <option value="" disabled>انتخاب شهر</option>
                <option value="بابل">بابل</option>
                <option value="آمل">آمل</option>
                <option value="ساری">ساری</option>
                <option value="محمود آباد">محمود آباد</option>
                <option value="بهشهر">بهشهر</option>
                <option value="جویبار">جویبار</option>
                <option value="بابلسر">بابلسر</option>
                <option value="چالوس">چالوس</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label" for="address">آدرس <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="address" value="" required name="address" placeholder="آدرس کامل ملک را وارد کنید">

            <!-- <div class="form-label fw-bold pt-3 pb-2">نمایش روی نقشه</div>
            <div class="interactive-map rounded-3" data-map-options="{&quot;mapLayer&quot;: &quot;https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key=5vRQzd34MMsINEyeKPIs&quot;, &quot;coordinates&quot;: [40.7447, -73.9485], &quot;zoom&quot;: 13, &quot;scrollWheelZoom&quot;: false, &quot;markers&quot;: [{&quot;coordinates&quot;: [40.7447, -73.9485], &quot;className&quot;: &quot;custom-marker-dot&quot;, &quot;popup&quot;: &quot;&lt;div class='p-3'&gt;&lt;h6 class='fs-base'&gt;Pine Apartments&lt;/h6&gt;&lt;p class='fs-xs text-muted pt-1 mt-n3 mb-0'&gt;28 Jackson Ave Long Island City, NY&lt;/p&gt;&lt;/div&gt;&quot;}]}" style="height: 250px;"></div> -->

          </div>
        </section>
        <!-- Property details-->


        <!-- Photos / video-->
        <section class="card card-body border-0 shadow-sm p-4 mb-4 my-4 py-4" id="photos">
          <h2 class="h5 mb-4"><i class="fi-image text-primary fs-5 mt-n1 me-2"></i>عکس / ویدئو</h2>
          <div class="alert alert-info mb-4 " role="alert">
            <div class="d-flex my-4 py-4"><i class="fi-alert-circle me-2 me-sm-3"></i>
              <p class="fs-sm mb-1">حداکثر حجم عکس 8 مگابایت است. فرمت ها: jpeg ، jpg ، png. ابتدا تصویر اصلی را قرار دهید.<br>حداکثر حجم فیلم 10 مگابایت است. فرمت ها: mp4 ، mov.</p>
            </div>
          </div>
          <input name="media[]" class="file-uploader file-uploader-grid" type="file" multiple accept="image/png, image/jpeg, video/mp4, video/mov" data-label-idle="&lt;div class=&quot;btn btn-primary mb-3&quot;&gt; آپلود عکس / ویدئو &lt;i class=&quot;fi-cloud-upload ms-1&quot;&gt;&lt;/i&gt;&lt;/div&gt;&lt;br&gt;یا آن را به این قسمت بکشید">

        </section>
        <!-- Contacts-->
        <section class="card card-body border-0 shadow-sm p-4 mb-4" id="contacts">
          <h2 class="h5 mb-4"><i class="fi-phone text-primary fs-5 mt-n1 me-2"></i>اطلاعات تماس</h2>
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label class="form-label" for="fn">نام <span class="text-danger">*</span></label>
              <input class="form-control" type="text" id="fn" value="" name="name" placeholder="نام خود را وارد کنید" required>
            </div>
            <div class="col-sm-6 mb-3">
              <label class="form-label" for="sn">نام خانوادگی <span class="text-danger">*</span></label>
              <input class="form-control" type="text" id="sn" value="" name="last_name" placeholder="نام خانوادگی خود را وارد کنید" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 mb-3">
              <label class="form-label" for="email">پست الکترونیکی<span class="text-danger">*</span></label>
              <input class="form-control" type="text" id="email" name="email" value="" placeholder="ایمیل">
            </div>
            <div class="col-sm-6 mb-3">
              <label class="form-label" for="phone">شماره تماس <span class="text-danger">*</span></label>
              <input class="form-control" name="tel" type="tel" id="phone"  placeholder="0000-000-000">
            </div>
          </div>
          <label class="form-label" for="company-name">نام شرکت</label>
          <input class="form-control" type="text" id="company-name" name="company" placeholder="نام شرکت را وارد کنید">
        </section>
        <!-- Action buttons -->
        <section class="d-sm-flex justify-content-between pt-2">
          <button type="submit" id="add_property" class="btn btn-primary btn-lg d-block mb-2">ثبت</button>
        </section>
    </div>
    </form>



  </div>
</div>


<script>
  // Ensure FilePond keeps original files for standard form submission
  document.addEventListener('DOMContentLoaded', function () {
    if (window.FilePond) {
      FilePond.setOptions({
        storeAsFile: true // let PHP receive files via $_FILES
      });
    }

    // قیمت: جداسازی سه‌رقمی در لحظه تایپ
    const formatPrice = (value) => {
      const digits = (value || '').toString().replace(/\D/g, '');
      return digits.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    };

    document.addEventListener('input', (e) => {
      if (e.target.classList && e.target.classList.contains('price-input')) {
        const formatted = formatPrice(e.target.value);
        e.target.value = formatted;
      }
    });
  });
</script>


@include('partials.footer')