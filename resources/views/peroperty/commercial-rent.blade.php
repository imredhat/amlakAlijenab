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

    
  

    <!-- رهن -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="mortgage">رهن (تومان)</label>
        <input type="number" name="mortgage" id="mortgage" class="form-control price-input">
    </div>

    <!-- اجاره -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rent">اجاره (تومان) *</label>
        <input type="number" name="rent" id="rent" class="form-control price-input" required>
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
            <option value="yes">دارد</option>
            <option value="no">ندارد</option>
        </select>
    </div>

    <!-- پارکینگ -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="parking">پارکینگ *</label>
        <select name="parking" id="parking" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="yes">دارد</option>
            <option value="no">ندارد</option>
        </select>
    </div>

    <!-- انباری -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="storage">انباری *</label>
        <select name="storage" id="storage" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="yes">دارد</option>
            <option value="no">ندارد</option>
        </select>
    </div>

    <!-- انشعابات -->
    


    <!-- نوع کاربری -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="usage_type">نوع کاربری *</label>
        <select name="usage_type" id="usage_type" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="industrial">صنعتی</option>
            <option value="commercial">تجاری</option>
            <option value="administrative">اداری</option>
            <option value="agricultural">کشاورزی</option>
            <option value="residential">مسکونی</option>
            <option value="educational">آموزشی</option>
            <option value="service">خدماتی</option>
        </select>
    </div>


    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="utilities">انشعابات *</label>
        <div>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="water" class="form-check-input">
                آب
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="electricity" class="form-check-input">
                برق
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="gas" class="form-check-input">
                گاز
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="phone" class="form-check-input">
                تلفن
            </label>
        </div>
    </div>


</div>