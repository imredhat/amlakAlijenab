@csrf
<div class="row">

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ:</label>
        <input class="form-control" type="text" id="area" name="area" value="{{ old('area', $property->area ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="usage_type">نوع کاربری:</label>
        <select class="form-control" id="usage_type" name="usage_type" required>
            <option value="">انتخاب</option>
            <option value="مسکونی" {{ (old('usage_type', $property->usage_type ?? '') == 'مسکونی') ? 'selected' : '' }}>مسکونی</option>
            <option value="تجاری" {{ (old('usage_type', $property->usage_type ?? '') == 'تجاری') ? 'selected' : '' }}>تجاری</option>
            <option value="اداری" {{ (old('usage_type', $property->usage_type ?? '') == 'اداری') ? 'selected' : '' }}>اداری</option>
            <option value="کشاورزی" {{ (old('usage_type', $property->usage_type ?? '') == 'کشاورزی') ? 'selected' : '' }}>کشاورزی</option>
            <option value="صنعتی" {{ (old('usage_type', $property->usage_type ?? '') == 'صنعتی') ? 'selected' : '' }}>صنعتی</option>
            <option value="باغ" {{ (old('usage_type', $property->usage_type ?? '') == 'باغ') ? 'selected' : '' }}>باغ</option>
            <option value="آموزشی" {{ (old('usage_type', $property->usage_type ?? '') == 'آموزشی') ? 'selected' : '' }}>آموزشی</option>
            <option value="درمانی" {{ (old('usage_type', $property->usage_type ?? '') == 'درمانی') ? 'selected' : '' }}>درمانی</option>
            <option value="مختلط" {{ (old('usage_type', $property->usage_type ?? '') == 'مختلط') ? 'selected' : '' }}>مختلط</option>
            <option value="فاقد کاربری" {{ (old('usage_type', $property->usage_type ?? '') == 'فاقد کاربری') ? 'selected' : '' }}>فاقد کاربری</option>
            <option value="مذهبی" {{ (old('usage_type', $property->usage_type ?? '') == 'مذهبی') ? 'selected' : '' }}>مذهبی</option>
            <option value="ورزشی" {{ (old('usage_type', $property->usage_type ?? '') == 'ورزشی') ? 'selected' : '' }}>ورزشی</option>
            <option value="فرهنگی" {{ (old('usage_type', $property->usage_type ?? '') == 'فرهنگی') ? 'selected' : '' }}>فرهنگی</option>
            <option value="حمل و نقل" {{ (old('usage_type', $property->usage_type ?? '') == 'حمل و نقل') ? 'selected' : '' }}>حمل و نقل</option>
            <option value="فضای سبز" {{ (old('usage_type', $property->usage_type ?? '') == 'فضای سبز') ? 'selected' : '' }}>فضای سبز</option>
            <option value="خدماتی" {{ (old('usage_type', $property->usage_type ?? '') == 'خدماتی') ? 'selected' : '' }}>خدماتی</option>
            <option value="معدنی" {{ (old('usage_type', $property->usage_type ?? '') == 'معدنی') ? 'selected' : '' }}>معدنی</option>
            <option value="پارکینگ" {{ (old('usage_type', $property->usage_type ?? '') == 'پارکینگ') ? 'selected' : '' }}>پارکینگ</option>
            <option value="تفریحی و توریستی" {{ (old('usage_type', $property->usage_type ?? '') == 'تفریحی و توریستی') ? 'selected' : '' }}>تفریحی و توریستی</option>
            <option value="حریم" {{ (old('usage_type', $property->usage_type ?? '') == 'حریم') ? 'selected' : '' }}>حریم</option>
            <option value="سایر" {{ (old('usage_type', $property->usage_type ?? '') == 'سایر') ? 'selected' : '' }}>سایر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="price">قیمت (تومان):</label>
        <input class="form-control price-input" inputmode="numeric" type="text" id="price" name="price" value="{{ old('price', number_format($property->price ?? 0)) }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="document_status">وضعیت سند:</label>
        <select class="form-control" id="document_status" name="document_status" required>
            <option value="">انتخاب</option>
            <option value="سند تک‌برگ" {{ (old('document_status', $property->document_status ?? '') == 'سند تک‌برگ') ? 'selected' : '' }}>سند تک‌برگ</option>
            <option value="سند منگوله‌دار" {{ (old('document_status', $property->document_status ?? '') == 'سند منگوله‌دار') ? 'selected' : '' }}>سند منگوله‌دار</option>
            <option value="قولنامه" {{ (old('document_status', $property->document_status ?? '') == 'قولنامه') ? 'selected' : '' }}>قولنامه</option>
            <option value="اوقافی" {{ (old('document_status', $property->document_status ?? '') == 'اوقافی') ? 'selected' : '' }}>اوقافی</option>
            <option value="مشاع" {{ (old('document_status', $property->document_status ?? '') == 'مشاع') ? 'selected' : '' }}>مشاع</option>
            <option value="در دست اقدام" {{ (old('document_status', $property->document_status ?? '') == 'در دست اقدام') ? 'selected' : '' }}>در دست اقدام</option>
            <option value="آماده انتقال" {{ (old('document_status', $property->document_status ?? '') == 'آماده انتقال') ? 'selected' : '' }}>آماده انتقال</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="property_location">موقعیت ملک:</label>
        <select class="form-control" id="property_location" name="property_location" required>
            <option value="">انتخاب</option>
            <option value="دو نبش" {{ (old('property_location', $property->property_location ?? '') == 'دو نبش') ? 'selected' : '' }}>دو نبش</option>
            <option value="سه نبش" {{ (old('property_location', $property->property_location ?? '') == 'سه نبش') ? 'selected' : '' }}>سه نبش</option>
            <option value="بر خیابان اصلی" {{ (old('property_location', $property->property_location ?? '') == 'بر خیابان اصلی') ? 'selected' : '' }}>بر خیابان اصلی</option>
            <option value="بر خیابان فرعی" {{ (old('property_location', $property->property_location ?? '') == 'بر خیابان فرعی') ? 'selected' : '' }}>بر خیابان فرعی</option>
            <option value="ته پلاک" {{ (old('property_location', $property->property_location ?? '') == 'ته پلاک') ? 'selected' : '' }}>ته پلاک</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="building_permit">مجوز ساخت:</label>
        <select class="form-control" id="building_permit" name="building_permit" required>
            <option value="">انتخاب</option>
            <option value="پروانه ساختمانی" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه ساختمانی') ? 'selected' : '' }}>پروانه ساختمانی</option>
            <option value="پروانه تخریب و بازسازی" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه تخریب و بازسازی') ? 'selected' : '' }}>پروانه تخریب و بازسازی</option>
            <option value="پروانه اضافه اشکوب" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه اضافه اشکوب') ? 'selected' : '' }}>پروانه اضافه اشکوب</option>
            <option value="پروانه تبدیل" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه تبدیل') ? 'selected' : '' }}>پروانه تبدیل</option>
            <option value="پروانه تغییرات تعمیرات" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه تغییرات تعمیرات') ? 'selected' : '' }}>پروانه تغییرات تعمیرات</option>
            <option value="پروانه تمدید" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه تمدید') ? 'selected' : '' }}>پروانه تمدید</option>
            <option value="پروانه تغییر نقشه" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه تغییر نقشه') ? 'selected' : '' }}>پروانه تغییر نقشه</option>
            <option value="پروانه ابطال" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه ابطال') ? 'selected' : '' }}>پروانه ابطال</option>
            <option value="پروانه تعویض مهندس ناظر یا مجری" {{ (old('building_permit', $property->building_permit ?? '') == 'پروانه تعویض مهندس ناظر یا مجری') ? 'selected' : '' }}>پروانه تعویض مهندس ناظر یا مجری</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="has_old_building">دارای بنای کلنگی:</label>
        <div>
            <label class="form-check">
                <input type="checkbox" name="has_old_building" value="بله" class="form-check-input" {{ (old('has_old_building', $property->has_old_building ?? '') == 'بله') ? 'checked' : '' }}>
                بله
            </label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="exchangeable">قابل معاوضه:</label>
        <div>
            <label class="form-check">
                <input type="checkbox" name="exchangeable" value="بله" class="form-check-input" {{ (old('exchangeable', $property->exchangeable ?? '') == 'بله') ? 'checked' : '' }}>
                بله
            </label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="utilities">انشعابات *</label>
        @php
            $utilities = is_string($property->utilities ?? '') ? json_decode($property->utilities, true) : ($property->utilities ?? []);
        @endphp
        <div>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="آب" class="form-check-input" {{ (is_array($utilities) && in_array('آب', $utilities)) ? 'checked' : '' }}>
                آب
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="برق" class="form-check-input" {{ (is_array($utilities) && in_array('برق', $utilities)) ? 'checked' : '' }}>
                برق
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="گاز" class="form-check-input" {{ (is_array($utilities) && in_array('گاز', $utilities)) ? 'checked' : '' }}>
                گاز
            </label>
            <label class="form-check">
                <input type="checkbox" name="utilities[]" value="تلفن" class="form-check-input" {{ (is_array($utilities) && in_array('تلفن', $utilities)) ? 'checked' : '' }}>
                تلفن
            </label>
        </div>
    </div>

</div>