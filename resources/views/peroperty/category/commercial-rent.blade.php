@csrf
<div class="row">

    <!-- طبقه ملک -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor">طبقه ملک</label>
        <select name="floor" id="floor" class="form-control">
            <option disabled value="">انتخاب کنید</option>
            <option value="زیر همکف">زیر همکف</option>
            <option value="همکف">همکف</option>
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
            <option value="اداری">اداری</option>
            <option value="تجاری و مغازه">تجاری و مغازه</option>
            <option value="صنعتی (سوله، انبار، کارگاه)">صنعتی (سوله، انبار، کارگاه)</option>
            <option value="دامداری و کشاورزی">دامداری و کشاورزی</option>
        </select>
    </div>

    
  

    <!-- رهن -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="mortgage">رهن (تومان)</label>
        <input type="text" name="mortgage" id="mortgage" class="form-control price-input">
    </div>

    <!-- اجاره -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rent">اجاره (تومان) *</label>
        <input type="text" name="rent" id="rent" class="form-control price-input" required>
    </div>

    <!-- قابلیت تبدیل -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label>
            <input type="checkbox" name="convertible" value="1"  class="form-check-input">
            قابلیت تبدیل مبلغ رهن و اجاره
        </label>
    </div>


    <hr/>

    <!-- متراژ -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ *</label>
        <input type="number" name="area" id="area" class="form-control" required>
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

     <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="parking">سرویس بهداشتی *</label>
        <select name="toilet" id="toilet" class="form-control" required>
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
    


    <!-- نوع کاربری -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="usage_type">نوع کاربری *</label>
        <select name="usage_type" id="usage_type" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="صنعتی">صنعتی</option>
            <option value="تجاری">تجاری</option>
            <option value="اداری">اداری</option>
            <option value="کشاورزی">کشاورزی</option>
            <option value="مسکونی">مسکونی</option>
            <option value="آموزشی">آموزشی</option>
            <option value="خدماتی">خدماتی</option>
        </select>
    </div>


    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="utilities">انشعابات *</label>
        <div>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="آب" class="form-check-input">
                آب
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="برق" class="form-check-input">
                برق
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="گاز" class="form-check-input">
                گاز
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="تلفن" class="form-check-input">
                تلفن
            </label>
        </div>
    </div>


</div>