        @csrf
        <div class="row">

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="area">متراژ:</label>
                <input class="form-control" type="text" id="area" name="area" required>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="usage_type">نوع کاربری:</label>
                <select class="form-control" id="usage_type" name="usage_type" required>
                    <option value="">انتخاب</option>
                    <option value="مسکونی">مسکونی</option>
                    <option value="تجاری">تجاری</option>
                    <option value="اداری">اداری</option>
                    <option value="کشاورزی">کشاورزی</option>
                    <option value="صنعتی">صنعتی</option>
                    <option value="باغ">باغ</option>
                    <option value="آموزشی">آموزشی</option>
                    <option value="درمانی">درمانی</option>
                    <option value="مختلط">مختلط</option>
                    <option value="فاقد کاربری">فاقد کاربری</option>
                    <option value="مذهبی">مذهبی</option>
                    <option value="ورزشی">ورزشی</option>
                    <option value="فرهنگی">فرهنگی</option>
                    <option value="حمل و نقل">حمل و نقل</option>
                    <option value="فضای سبز">فضای سبز</option>
                    <option value="خدماتی">خدماتی</option>
                    <option value="معدنی">معدنی</option>
                    <option value="پارکینگ">پارکینگ</option>
                    <option value="تفریحی و توریستی">تفریحی و توریستی</option>
                    <option value="حریم">حریم</option>
                    <option value="سایر">سایر</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="price">قیمت (تومان):</label>
                <input class="form-control price-input" inputmode="numeric" type="text" id="price" name="price" required>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="document_status">وضعیت سند:</label>
                <select class="form-control" id="document_status" name="document_status" required>
                    <option value="">انتخاب</option>
                    <option value="سند تک‌برگ">سند تک‌برگ</option>
                    <option value="سند منگوله‌دار">سند منگوله‌دار</option>
                    <option value="قولنامه">قولنامه</option>
                    <option value="اوقافی">اوقافی</option>
                    <option value="مشاع">مشاع</option>
                    <option value="در دست اقدام">در دست اقدام</option>
                    <option value="آماده انتقال">آماده انتقال</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="property_location">موقعیت ملک:</label>
                <select class="form-control" id="property_location" name="property_location" required>
                    <option value="">انتخاب</option>
                    <option value="دو نبش">دو نبش</option>
                    <option value="سه نبش">سه نبش</option>
                    <option value="بر خیابان اصلی">بر خیابان اصلی</option>
                    <option value="بر خیابان فرعی">بر خیابان فرعی</option>
                    <option value="ته پلاک">ته پلاک</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="building_permit">مجوز ساخت:</label>
                <select class="form-control" id="building_permit" name="building_permit" required>
                    <option value="">انتخاب</option>
                    <option value="پروانه ساختمانی">پروانه ساختمانی</option>
                    <option value="پروانه تخریب و بازسازی">پروانه تخریب و بازسازی</option>
                    <option value="پروانه اضافه اشکوب">پروانه اضافه اشکوب</option>
                    <option value="پروانه تبدیل">پروانه تبدیل</option>
                    <option value="پروانه تغییرات تعمیرات">پروانه تغییرات تعمیرات</option>
                    <option value="پروانه تمدید">پروانه تمدید</option>
                    <option value="پروانه تغییر نقشه">پروانه تغییر نقشه</option>
                    <option value="پروانه ابطال">پروانه ابطال</option>
                    <option value="پروانه تعویض مهندس ناظر یا مجری">پروانه تعویض مهندس ناظر یا مجری</option>
                </select>
            </div>




            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="has_old_building">دارای بنای کلنگی:</label>
                <div>
                    <label class="form-check">
                        <input type="checkbox" name="has_old_building" value="بله" class="form-check-input">
                        بله
                    </label>
                </div>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="exchangeable">قابل معاوضه:</label>
                <div>
                    <label class="form-check">
                        <input type="checkbox" name="exchangeable" value="بله" class="form-check-input">
                        بله
                    </label>
                </div>
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