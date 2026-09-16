@include('partials.home.header')


<!-- Demo switcher (offcanvas)-->

<!-- Page loading spinner-->
<div class="page-loading active">
  <div class="page-loading-inner">
    <div class="page-spinner"></div><span>لطفا منتظر باشید</span>
  </div>
</div>
<main class="page-wrapper">
  <!-- Sign In Modal-->
  <div class="modal fade" id="signin-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered p-2 my-0 mx-auto" style="max-width: 950px;">
      <div class="modal-content">
        <div class="row mx-0 align-items-center">
          <div class="col-md-6 border-end-md p-4 p-sm-5">
            <h2 class="h3 mb-4 mb-sm-5">سلام!<br>به سایت ما خوش آمدید.</h2><img class="d-block mx-auto rotate-img" src="{{ url('') }}/img/signin-modal/signin.svg" width="344" alt="Illustartion">
            <!-- <div class="mt-4 mt-sm-5">هنوز ثبت نام نکرده اید؟ <a href="signup-light.html">ثبت نام</a></div> -->
          </div>
          <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
            <!-- <a class="btn btn-outline-info w-100 mb-3" href="signin-light.html#"><i class="fi-google fs-lg me-1"></i>ورود با اکانت گوگل</a><a class="btn btn-outline-info w-100 mb-3" href="signin-light.html#"><i class="fi-facebook fs-lg me-1"></i>ورود با اکانت فیسبوک</a>
                  <div class="d-flex align-items-center py-3 mb-3">
                    <hr class="w-100">
                    <div class="px-3">یـا</div>
                    <hr class="w-100">
                  </div> -->
            <form class="needs-validation" novalidate action="{{ url('auth/check') }}" method="post" autocomplete="on">
              @csrf
              <div class="mb-4">
                <label class="form-label mb-2" for="signin-email">شماره موبایل</label>
                <input class="form-control" type="tel" id="signin-email" name="tel" placeholder="09123456789" required pattern="[0-9]{11}">
              </div>

              <button class="btn btn-primary btn-lg w-100" type="submit">ارسال کد</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar-->



  @include('partials.home.menu')

<main class="page-wrapper">

    <div class="container-fluid mt-5 pt-5 p-0">
        <div class="row g-0 mt-n3">

            <!-- Sidebar فیلترها -->
            <aside class="col-lg-4 col-xl-3 border-top-lg border-end-lg shadow-sm px-3 px-xl-4 px-xxl-5 pt-lg-2">
                <div class="offcanvas-lg offcanvas-end" id="filters-sidebar">
                    <div class="offcanvas-header d-flex d-lg-none align-items-center">
                        <h2 class="h5 mb-0">فیلتر جستجو</h2>
                        <button class="btn-close" type="button" data-bs-dismiss="offcanvas" data-bs-target="#filters-sidebar"></button>
                    </div>

                    <div class="offcanvas-body py-lg-4">

                        <!-- جستجوی متنی -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">جستجو</h3>
                            <div class="input-group">
                                <input type="text" class="form-control" id="q" name="q" placeholder="عنوان، آدرس..." value="{{ request('q') }}">
                            </div>
                        </div>

                        <!-- نوع ملک -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">نوع ملک</h3>
                            <select class="form-select mb-2" id="category" name="category">
                                <option value="">همه انواع</option>
                                <option value="apartment-rent" {{ request('category') === 'apartment-rent' ? 'selected' : '' }}>رهن و اجاره آپارتمان</option>
                                <option value="apartment-sale" {{ request('category') === 'apartment-sale' ? 'selected' : '' }}>خرید و فروش آپارتمان</option>
                                <option value="villa-sale" {{ request('category') === 'villa-sale' ? 'selected' : '' }}>خرید و فروش ویلا</option>
                                <option value="villa-short-rent" {{ request('category') === 'villa-short-rent' ? 'selected' : '' }}>اجاره کوتاه مدت ویلا</option>
                                <option value="commercial-rent" {{ request('category') === 'commercial-rent' ? 'selected' : '' }}>رهن و اجاره تجاری</option>
                                <option value="commercial-sale" {{ request('category') === 'commercial-sale' ? 'selected' : '' }}>خرید و فروش تجاری</option>
                                <option value="land" {{ request('category') === 'land' ? 'selected' : '' }}>زمین و باغ</option>
                                <option value="pre-sale" {{ request('category') === 'pre-sale' ? 'selected' : '' }}>پیش فروش</option>
                                <option value="other" {{ request('category') === 'other' ? 'selected' : '' }}>سایر</option>
                            </select>
                        </div>

                        <!-- موقعیت مکانی -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">موقعیت مکانی</h3>
                            <select class="form-select mb-2" id="city" name="city">
                                <option value="">همه شهرها</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->name }}" data-city-name="{{ $city->name }}" {{ request('city') === $city->name ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                                @endforeach
                            </select>
                            <select class="form-select mb-2" id="neighborhood" name="neighborhood">
                                <option value="">همه محله‌ها</option>
                            </select>
                        </div>

                        <!-- قیمت -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">قیمت</h3>
                            <div class="d-flex align-items-center mb-2">
                                <input type="text" class="form-control price-input" name="price_min" id="price_min" placeholder="حداقل" value="{{ request('price_min') }}">
                                <div class="mx-2">—</div>
                                <input type="text" class="form-control price-input" name="price_max" id="price_max" placeholder="حداکثر" value="{{ request('price_max') }}">
                            </div>
                        </div>

                        <!-- اجاره -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">اجاره ماهانه</h3>
                            <div class="d-flex align-items-center mb-2">
                                <input type="text" class="form-control price-input" name="rent_min" id="rent_min" placeholder="حداقل" value="{{ request('rent_min') }}">
                                <div class="mx-2">—</div>
                                <input type="text" class="form-control price-input" name="rent_max" id="rent_max" placeholder="حداکثر" value="{{ request('rent_max') }}">
                            </div>
                        </div>

                        <!-- متراژ -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">متراژ (مترمربع)</h3>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control" name="area_min" id="area_min" placeholder="حداقل" value="{{ request('area_min') }}">
                                <div class="mx-2">—</div>
                                <input type="number" class="form-control" name="area_max" id="area_max" placeholder="حداکثر" value="{{ request('area_max') }}">
                            </div>
                        </div>

                        <!-- تعداد اتاق -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">تعداد اتاق</h3>
                            <select class="form-select" id="rooms" name="rooms">
                                <option value="">هر تعداد</option>
                                @for($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ request('rooms') > 0  && request('rooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- طبقه -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">طبقه</h3>
                            <select class="form-select" id="floor" name="floor">
                                <option selected value="">هر طبقه</option>
                                @for($i = -2; $i <= 30; $i++)
                                <option value="{{ $i }}" {{ request('floor') > 0 && request('floor') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- سال ساخت -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">سال ساخت</h3>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control" name="build_year_min" id="build_year_min" placeholder="از" value="{{ request('build_year_min') }}">
                                <div class="mx-2">—</div>
                                <input type="number" class="form-control" name="build_year_max" id="build_year_max" placeholder="تا" value="{{ request('build_year_max') }}">
                            </div>
                        </div>

                        <!-- چشم‌انداز -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">چشم‌انداز</h3>
                            <select class="form-select" id="property_view" name="property_view">
                                <option value="">همه</option>
                                <option value="دریا" {{ request('property_view') === 'دریا' ? 'selected' : '' }}>دریا</option>
                                <option value="جنگل" {{ request('property_view') === 'جنگل' ? 'selected' : '' }}>جنگل</option>
                                <option value="کوه" {{ request('property_view') === 'کوه' ? 'selected' : '' }}>کوه</option>
                                <option value="شهر" {{ request('property_view') === 'شهر' ? 'selected' : '' }}>شهر</option>
                            </select>
                        </div>

                        <!-- امکانات -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">امکانات</h3>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parking" id="parking" value="1" {{ request('parking') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="parking">پارکینگ</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="storage" id="storage" value="1" {{ request('storage') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="storage">انباری</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="elevator" id="elevator" value="1" {{ request('elevator') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="elevator">آسانسور</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="balcony" id="balcony" value="1" {{ request('balcony') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="balcony">بالکن</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pool" id="pool" value="1" {{ request('pool') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="pool">استخر</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sauna" id="sauna" value="1" {{ request('sauna') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="sauna">سونا</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jacuzzi" id="jacuzzi" value="1" {{ request('jacuzzi') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="jacuzzi">جکوزی</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="furnished" id="furnished" value="1" {{ request('furnished') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="furnished">مبله</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="rebuilt" id="rebuilt" value="1" {{ request('rebuilt') ? 'checked' : '' }}>
                                        <label class="form-check-label fs-sm" for="rebuilt">بازسازی شده</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- نوع ساختمان -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">نوع ساختمان</h3>
                            <select class="form-select" id="building_type" name="building_type">
                                <option value="">همه</option>
                                <option value="آپارتمان" {{ request('building_type') === 'آپارتمان' ? 'selected' : '' }}>آپارتمان</option>
                                <option value="ویلایی" {{ request('building_type') === 'ویلایی' ? 'selected' : '' }}>ویلایی</option>
                                <option value="اداری" {{ request('building_type') === 'اداری' ? 'selected' : '' }}>اداری</option>
                                <option value="تجاری" {{ request('building_type') === 'تجاری' ? 'selected' : '' }}>تجاری</option>
                                <option value="صنعتی" {{ request('building_type') === 'صنعتی' ? 'selected' : '' }}>صنعتی</option>
                            </select>
                        </div>

                        <!-- جهت ساختمان -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">جهت ساختمان</h3>
                            <select class="form-select" id="building_direction" name="building_direction">
                                <option value="">همه</option>
                                <option value="شمالی" {{ request('building_direction') === 'شمالی' ? 'selected' : '' }}>شمالی</option>
                                <option value="جنوبی" {{ request('building_direction') === 'جنوبی' ? 'selected' : '' }}>جنوبی</option>
                                <option value="شرقی" {{ request('building_direction') === 'شرقی' ? 'selected' : '' }}>شرقی</option>
                                <option value="غربی" {{ request('building_direction') === 'غربی' ? 'selected' : '' }}>غربی</option>
                            </select>
                        </div>

                        <!-- نوع سند -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">نوع سند</h3>
                            <select class="form-select" id="document_type" name="document_type">
                                <option value="">همه</option>
                                <option value="ششدانگ" {{ request('document_type') === 'ششدانگ' ? 'selected' : '' }}>ششدانگ</option>
                                <option value="سه‌دانگ" {{ request('document_type') === 'سه‌دانگ' ? 'selected' : '' }}>سه‌دانگ</option>
                                <option value="تک برگ" {{ request('document_type') === 'تک برگ' ? 'selected' : '' }}>تک برگ</option>
                                <option value="قولنامه‌ای" {{ request('document_type') === 'قولنامه‌ای' ? 'selected' : '' }}>قولنامه‌ای</option>
                            </select>
                        </div>

                        <!-- سیستم سرمایش -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">سیستم سرمایش</h3>
                            <select class="form-select" id="cooling_system" name="cooling_system">
                                <option value="">همه</option>
                                <option value="کولرگازی" {{ request('cooling_system') === 'کولرگازی' ? 'selected' : '' }}>کولرگازی</option>
                                <option value="اسپیلت" {{ request('cooling_system') === 'اسپیلت' ? 'selected' : '' }}>اسپیلت</option>
                                <option value="فن‌کویل" {{ request('cooling_system') === 'فن‌کویل' ? 'selected' : '' }}>فن‌کویل</option>
                            </select>
                        </div>

                        <!-- سیستم گرمایش -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">سیستم گرمایش</h3>
                            <select class="form-select" id="heating_system" name="heating_system">
                                <option value="">همه</option>
                                <option value="پکیج" {{ request('heating_system') === 'پکیج' ? 'selected' : '' }}>پکیج</option>
                                <option value="شوفاژ" {{ request('heating_system') === 'شوفاژ' ? 'selected' : '' }}>شوفاژ</option>
                                <option value="کف‌خواب" {{ request('heating_system') === 'کف‌خواب' ? 'selected' : '' }}>کف‌خواب</option>
                            </select>
                        </div>

                        <!-- ظرفیت (اجاره کوتاه مدت) -->
                        <div class="pb-4 mb-2 border-bottom">
                            <h3 class="h6">حداقل ظرفیت نفرات</h3>
                            <select class="form-select" id="capacity_min" name="capacity_min">
                                <option value="">ندارد</option>
                                @for($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ request('capacity_min') == $i ? 'selected' : '' }}>{{ $i }} نفر</option>
                                @endfor
                            </select>
                        </div>

                        <!-- دکمه پاک کردن -->
                        <div class="border-top py-4">
                            <button type="button" class="btn btn-outline-secondary w-100" id="reset-filters">
                                <i class="fi-rotate-right me-2"></i>پاک کردن فیلترها
                            </button>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- محتوای اصلی -->
            <div class="col-lg-8 col-xl-9 position-relative overflow-hidden pb-5 pt-4 px-3 px-xl-4 px-xxl-5">

                <!-- Breadcrumb -->
                <nav class="mb-3 pt-md-2" aria-label="Breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                        <li class="breadcrumb-item active" aria-current="page">جستجو</li>
                    </ol>
                </nav>

                <!-- عنوان -->
                <div class="d-flex align-items-center justify-content-between pb-3 pb-sm-4">
                    <h1 class="h4 mb-sm-0">جستجوی املاک</h1>
                    <button class="btn btn-primary d-lg-none" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#filters-sidebar">
                        <i class="fi-filter me-1"></i> فیلترها
                    </button>
                </div>

                <!-- مرتب‌سازی + تعداد نتایج -->
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch my-2">
                    <div class="d-flex align-items-center flex-shrink-0">
                        <label class="fs-sm me-2 pe-1 text-nowrap" for="sortby">
                            <i class="fi-arrows-sort text-muted mt-n1 me-2"></i>مرتب سازی:
                        </label>
                        <select class="form-select form-select-sm" id="sortby">
                            <option value="newest" {{ (request('sort') ?? 'newest') === 'newest' ? 'selected' : '' }}>جدیدترین</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                            <option value="area_desc" {{ request('sort') === 'area_desc' ? 'selected' : '' }}>بزرگ‌ترین متراژ</option>
                            <option value="most_viewed" {{ request('sort') === 'most_viewed' ? 'selected' : '' }}>پربازدیدترین</option>
                        </select>
                    </div>
                    <hr class="d-none d-sm-block w-100 mx-4">
                    <div class="d-none d-sm-flex align-items-center flex-shrink-0 text-muted">
                        <i class="fi-check-circle me-2"></i>
                        <span class="fs-sm mt-n1" id="results-count">{{ $properties->total() }} نتیجه یافت شد</span>
                    </div>
                </div>

                <!-- لیست املاک -->
                <div id="properties-container" class="row g-4 py-4">
                    @if(isset($properties) && $properties->count() > 0)
                        @foreach($properties as $p)
                            <?php
                            $media = [""];
                            $cat = $p->category;
                            if (isset($p->media) && count(json_decode($p->media)) > 0) {
                                $media = json_decode($p->media);
                            }
                            ?>
                            @include("peroperty.vendor.".$cat)
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <i class="fi-search fs-1 text-muted"></i>
                            <p class="text-muted fs-5 mt-3">آگهی‌ای یافت نشد. فیلترها را تغییر دهید.</p>
                        </div>
                    @endif
                </div>

                <!-- صفحه‌بندی -->
                <div id="pagination-container">
                @if($properties->hasPages())
                <nav class="border-top pb-md-4 pt-4 mt-2" aria-label="Pagination">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="text-muted small">
                            نمایش {{ $properties->firstItem() }} تا {{ $properties->lastItem() }} از {{ $properties->total() }} نتیجه
                        </div>
                        <div>
                            {{ $properties->appends(request()->query())->links('pagination::persian') }}
                        </div>
                    </div>
                </nav>
                @endif
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            let searchTimer = null;
            let lastUrl = '';

            function collectFilters() {
                let params = {};

                let q = $('#q').val();
                if (q) params.q = q;

                let category = $('#category').val();
                if (category) params.category = category;

                let city = $('#city').val();
                if (city) params.city = city;

                let neighborhood = $('#neighborhood').val();
                if (neighborhood) params.neighborhood = neighborhood;

                let priceMin = $('#price_min').val().replace(/,/g, '');
                if (priceMin) params.price_min = priceMin;

                let priceMax = $('#price_max').val().replace(/,/g, '');
                if (priceMax) params.price_max = priceMax;

                let rentMin = $('#rent_min').val().replace(/,/g, '');
                if (rentMin) params.rent_min = rentMin;

                let rentMax = $('#rent_max').val().replace(/,/g, '');
                if (rentMax) params.rent_max = rentMax;

                let areaMin = $('#area_min').val();
                if (areaMin) params.area_min = areaMin;

                let areaMax = $('#area_max').val();
                if (areaMax) params.area_max = areaMax;

                let rooms = $('#rooms').val();
                if (rooms && rooms !== '0') params.rooms = rooms;

                let floor = $('#floor').val();
                if (floor !== '' && floor !== '0') params.floor = floor;

                let buildYearMin = $('#build_year_min').val();
                if (buildYearMin) params.build_year_min = buildYearMin;

                let buildYearMax = $('#build_year_max').val();
                if (buildYearMax) params.build_year_max = buildYearMax;

                let propertyView = $('#property_view').val();
                if (propertyView) params.property_view = propertyView;

                let buildingType = $('#building_type').val();
                if (buildingType) params.building_type = buildingType;

                let buildingDirection = $('#building_direction').val();
                if (buildingDirection) params.building_direction = buildingDirection;

                let documentType = $('#document_type').val();
                if (documentType) params.document_type = documentType;

                let coolingSystem = $('#cooling_system').val();
                if (coolingSystem) params.cooling_system = coolingSystem;

                let heatingSystem = $('#heating_system').val();
                if (heatingSystem) params.heating_system = heatingSystem;

                let capacityMin = $('#capacity_min').val();
                if (capacityMin) params.capacity_min = capacityMin;

                if ($('#parking').is(':checked')) params.parking = 1;
                if ($('#storage').is(':checked')) params.storage = 1;
                if ($('#elevator').is(':checked')) params.elevator = 1;
                if ($('#balcony').is(':checked')) params.balcony = 1;
                if ($('#pool').is(':checked')) params.pool = 1;
                if ($('#sauna').is(':checked')) params.sauna = 1;
                if ($('#jacuzzi').is(':checked')) params.jacuzzi = 1;
                if ($('#furnished').is(':checked')) params.furnished = 1;
                if ($('#rebuilt').is(':checked')) params.rebuilt = 1;

                let sort = $('#sortby').val();
                if (sort) params.sort = sort;

                return params;
            }

            function doSearch() {
                let params = collectFilters();
                let queryString = $.param(params);
                let url = '/search' + (queryString ? '?' + queryString : '');

                if (url === lastUrl) return;
                lastUrl = url;

                $('#properties-container').html(`
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-3 text-muted">در حال جستجو...</p>
                    </div>
                `);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#properties-container').html(response.html);
                        $('#pagination-container').html(response.pagination);
                        $('#results-count').text(response.total + ' نتیجه یافت شد');
                        window.history.pushState({}, '', url);
                    },
                    error: function() {
                        $('#properties-container').html(`
                            <div class="col-12 alert alert-danger text-center">
                                خطا در جستجو.
                            </div>
                        `);
                    }
                });
            }

            // debounce for text inputs
            function debouncedSearch() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(doSearch, 400);
            }

            // ── Text inputs: debounce on keyup ──
            $('#q').on('keyup', debouncedSearch);

            // ── Price/area inputs: format + debounce ──
            $('.price-input').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                debouncedSearch();
            });

            // ── Number inputs: debounce ──
            $('#area_min, #area_max, #build_year_min, #build_year_max').on('keyup', debouncedSearch);

            // ── City change: load neighborhoods ──
            $('#city').on('change', function() {
                var cityId = $(this).val();
                var cityName = $(this).find('option:selected').data('city-name');
                var neighborhoodSelect = $('#neighborhood');

                neighborhoodSelect.prop('disabled', true);
                neighborhoodSelect.html('<option value="" disabled selected>در حال بارگذاری...</option>');

                if (cityId) {
                    $.ajax({
                        url: '{{ route("get.neighborhoods") }}',
                        type: 'GET',
                        data: { city_id: cityId, city_name: cityName },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success && response.neighborhoods.length > 0) {
                                var options = '<option value="" selected>همه محله‌ها</option>';
                                $.each(response.neighborhoods, function(key, neighborhood) {
                                    var selected = '{{ request("neighborhood") }}' === neighborhood.name ? 'selected' : '';
                                    options += '<option value="' + neighborhood.name + '" ' + selected + '>' + neighborhood.name + '</option>';
                                });
                                neighborhoodSelect.html(options);
                                neighborhoodSelect.prop('disabled', false);
                            } else {
                                neighborhoodSelect.html('<option value="" selected>همه محله‌ها</option>');
                                neighborhoodSelect.prop('disabled', false);
                            }
                        },
                        error: function() {
                            neighborhoodSelect.html('<option value="" selected>همه محله‌ها</option>');
                            neighborhoodSelect.prop('disabled', false);
                        }
                    });
                } else {
                    neighborhoodSelect.html('<option value="" selected>همه محله‌ها</option>');
                    neighborhoodSelect.prop('disabled', false);
                }

                lastUrl = '';
                doSearch();
            });

            // ── Load neighborhoods on page load if city is selected ──
            if ($('#city').val()) {
                $('#city').trigger('change');
            }

            // ── Neighborhood change: search ──
            $('#neighborhood').on('change', function() {
                lastUrl = '';
                doSearch();
            });

            // ── Selects: immediate search ──
            $('#category, #floor, #property_view, #rooms').on('change', function() {
                lastUrl = '';
                doSearch();
            });

            // ── Sort: immediate search ──
            $('#sortby').on('change', function() {
                lastUrl = '';
                doSearch();
            });

            // ── Building selects: immediate search ──
            $('#building_type, #building_direction, #document_type, #cooling_system, #heating_system, #capacity_min').on('change', function() {
                lastUrl = '';
                doSearch();
            });

            // ── Checkboxes: immediate search ──
            $('input[type="checkbox"]').on('change', function() {
                lastUrl = '';
                doSearch();
            });

            // ── Reset ──
            $('#reset-filters').on('click', function() {
                window.location.href = '/search';
            });

            // ── Pagination AJAX ──
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if (!url) return;

                $('#properties-container').html(`
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                `);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#properties-container').html(response.html);
                        $('#pagination-container').html(response.pagination);
                        window.history.pushState({}, '', url);
                        $('html, body').animate({ scrollTop: 0 }, 300);
                    }
                });
            });

            // ── Browser back/forward ──
            $(window).on('popstate', function() {
                lastUrl = '';
                doSearch();
            });
        });
    </script>

    <style>
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important; }
    </style>

@include('partials.home.footer')
</main>
