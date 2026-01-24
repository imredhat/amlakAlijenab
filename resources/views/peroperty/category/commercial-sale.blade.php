@csrf
<div class="row">

    <!-- طبقه ملک -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor">طبقه ملک</label>
        <select name="floor" id="floor" class="form-control">
            <option value="">انتخاب کنید</option>
            <option value="basement">زیر همکف</option>
            <option value="ground">همکف</option>
            @for($i = 1; $i <= 30; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
                <option value="30_plus">۳۰ به بالا</option>
        </select>
    </div>

    <!-- نوع ملک -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="type">نوع ملک *</label>
        <select name="type" id="type" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="administrative">اداری</option>
            <option value="commercial">تجاری و مغازه</option>
            <option value="industrial">صنعتی (سوله، انبار، کارگاه)</option>
            <option value="agricultural">دامداری و کشاورزی</option>
        </select>
    </div>

    
  



    <hr/>

    <!-- متراژ -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ *</label>
        <input type="number" name="area" id="area" class="form-control" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="price">قیمت (تومان):</label>
                <input class="form-control price-input" inputmode="numeric" type="text" id="price" name="price" required>
            </div>



    <!-- وضعیت سند -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="document_status">وضعیت سند *</label>
        <select name="document_status" id="document_status" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="full_property">شش دانگ</option>
            <option value="contract">قولنامه‌ای</option>
            <option value="power_of_attorney">وکالتی</option>
            <option value="waqf">اوقافی</option>
            <option value="participatory">مشارکتی</option>
            <option value="land_and_building">عرصه و اعیان</option>
            <option value="other">سایر</option>
        </select>
    </div>
    <!-- تعداد اتاق -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rooms">تعداد اتاق *</label>
        <select name="rooms" id="rooms" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="1">۱</option>
            <option value="2">۲</option>
            <option value="3">۳</option>
            <option value="4">۴</option>
            <option value="5">۵</option>
            <option value="6_plus">۶ به بالا</option>
        </select>
    </div>

    <!-- سال ساخت -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="year_built">سال ساخت *</label>
        <input type="number" name="year_built" id="year_built" class="form-control" required>
    </div>

    <!-- آسانسور -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="elevator">آسانسور *</label>
        <select name="elevator" id="elevator" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option  value="دارد">دارد</option>
            <option  value="ندارد">ندارد</option>
        </select>
    </div>

    <!-- پارکینگ -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="parking">پارکینگ *</label>
        <select name="parking" id="parking" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option  value="دارد">دارد</option>
            <option  value="ندارد">ندارد</option>
        </select>
    </div>

    <!-- انباری -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="storage">انباری *</label>
        <select name="storage" id="storage" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option  value="دارد">دارد</option>
            <option  value="ندارد">ندارد</option>
        </select>
    </div>

    <!-- انشعابات -->
    
    <!-- وضعیت فعلی -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="current_status">وضعیت فعلی *</label>
        <select name="current_status" id="current_status" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="vacant">تخلیه</option>
            <option value="active">فعال</option>
            <option value="under_renovation">در حال بازسازی</option>
            <option value="other">سایر</option>
        </select>
    </div>

    <!-- نوع کاربری -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="usage_type">نوع کاربری *</label>
        <select name="usage_type" id="usage_type" class="form-control" required>
            <option disabled value="">انتخاب کنید</option>
            <option value="صنعتی">صنعتی</option>
            <option value="تجاری">تجاری</option>
            <option value="اداری">اداری</option>
            <option value="کشاورزی">کشاورزی</option>
            <option value="مسکونی">مسکونی</option>
            <option value="آموزشی">آموزشی</option>
            <option value="خدماتی">خدماتی</option>
        </select>
    </div>

    <hr/>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label class="form-label d-block fw-bold mb-2 pb-1">امکانات *</label>
        <div class="row">
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="آب" id="water">
                <label class="form-check-label" for="water">آب</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="برق" id="electricity">
                <label class="form-check-label" for="electricity">برق</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="گاز" id="gas">
                <label class="form-check-label" for="gas">گاز</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="تلفن" id="phone">
                <label class="form-check-label" for="phone">تلفن</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="اتاق مدیریت" id="management_room">
                <label class="form-check-label" for="management_room">اتاق مدیریت</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="اتاق کنفرانس" id="conference_room">
                <label class="form-check-label" for="conference_room">اتاق کنفرانس</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="فضای پذیرش/منشی" id="reception_area">
                <label class="form-check-label" for="reception_area">فضای پذیرش/منشی</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="آبدارخانه/آشپزخانه کوچک" id="pantry">
                <label class="form-check-label" for="pantry">آبدارخانه/آشپزخانه کوچک</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="تابلوخور" id="signage">
                <label class="form-check-label" for="signage">تابلوخور</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="ورودی مجزا" id="separate_entry">
                <label class="form-check-label" for="separate_entry">ورودی مجزا</label>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="utilities[]" value="نگهبانی/لابی من" id="security">
                <label class="form-check-label" for="security">نگهبانی/لابی من</label>
            </div>
            </div>
        </div>
    </div>


</div>