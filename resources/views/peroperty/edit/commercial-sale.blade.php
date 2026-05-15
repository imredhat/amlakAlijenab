@csrf
<div class="row">

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor">طبقه ملک</label>
        <select name="floor" id="floor" class="form-control">
            <option value="">انتخاب کنید</option>
            <option value="basement" {{ (old('floor', $property->floor ?? '') == 'basement') ? 'selected' : '' }}>زیر همکف</option>
            <option value="ground" {{ (old('floor', $property->floor ?? '') == 'ground') ? 'selected' : '' }}>همکف</option>
            @for($i = 1; $i <= 30; $i++)
                <option value="{{ $i }}" {{ (old('floor', $property->floor ?? '') == $i) ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
            <option value="30_plus" {{ (old('floor', $property->floor ?? '') == '30_plus') ? 'selected' : '' }}>۳۰ به بالا</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="type">نوع ملک *</label>
        <select name="type" id="type" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="administrative" {{ (old('type', $property->type ?? '') == 'administrative') ? 'selected' : '' }}>اداری</option>
            <option value="commercial" {{ (old('type', $property->type ?? '') == 'commercial') ? 'selected' : '' }}>تجاری و مغازه</option>
            <option value="industrial" {{ (old('type', $property->type ?? '') == 'industrial') ? 'selected' : '' }}>صنعتی (سوله، انبار، کارگاه)</option>
            <option value="agricultural" {{ (old('type', $property->type ?? '') == 'agricultural') ? 'selected' : '' }}>دامداری و کشاورزی</option>
        </select>
    </div>

    <hr/>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ *</label>
        <input type="number" name="area" id="area" class="form-control" value="{{ old('area', $property->area ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="price">قیمت (تومان):</label>
        <input class="form-control price-input" inputmode="numeric" type="text" id="price" name="price" value="{{ old('price', number_format($property->price ?? 0)) }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="document_status">وضعیت سند *</label>
        <select name="document_status" id="document_status" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="full_property" {{ (old('document_status', $property->document_status ?? '') == 'full_property') ? 'selected' : '' }}>شش دانگ</option>
            <option value="contract" {{ (old('document_status', $property->document_status ?? '') == 'contract') ? 'selected' : '' }}>قولنامه‌ای</option>
            <option value="power_of_attorney" {{ (old('document_status', $property->document_status ?? '') == 'power_of_attorney') ? 'selected' : '' }}>وکالتی</option>
            <option value="waqf" {{ (old('document_status', $property->document_status ?? '') == 'waqf') ? 'selected' : '' }}>اوقافی</option>
            <option value="participatory" {{ (old('document_status', $property->document_status ?? '') == 'participatory') ? 'selected' : '' }}>مشارکتی</option>
            <option value="land_and_building" {{ (old('document_status', $property->document_status ?? '') == 'land_and_building') ? 'selected' : '' }}>عرصه و اعیان</option>
            <option value="other" {{ (old('document_status', $property->document_status ?? '') == 'other') ? 'selected' : '' }}>سایر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rooms">تعداد اتاق *</label>
        <select name="rooms" id="rooms" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="1" {{ (old('rooms', $property->rooms ?? '') == '1') ? 'selected' : '' }}>۱</option>
            <option value="2" {{ (old('rooms', $property->rooms ?? '') == '2') ? 'selected' : '' }}>۲</option>
            <option value="3" {{ (old('rooms', $property->rooms ?? '') == '3') ? 'selected' : '' }}>۳</option>
            <option value="4" {{ (old('rooms', $property->rooms ?? '') == '4') ? 'selected' : '' }}>۴</option>
            <option value="5" {{ (old('rooms', $property->rooms ?? '') == '5') ? 'selected' : '' }}>۵</option>
            <option value="6_plus" {{ (old('rooms', $property->rooms ?? '') == '6_plus') ? 'selected' : '' }}>۶ به بالا</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="year_built">سال ساخت *</label>
        <input type="number" name="year_built" id="year_built" class="form-control" value="{{ old('year_built', $property->year_built ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="elevator">آسانسور *</label>
        <select name="elevator" id="elevator" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('elevator', $property->elevator ?? '') == 'دارد') ? 'selected' : '' }}>دارد</option>
            <option value="ندارد" {{ (old('elevator', $property->elevator ?? '') == 'ندارد') ? 'selected' : '' }}>ندارد</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="parking">پارکینگ *</label>
        <select name="parking" id="parking" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('parking', $property->parking ?? '') == 'دارد') ? 'selected' : '' }}>دارد</option>
            <option value="ندارد" {{ (old('parking', $property->parking ?? '') == 'ندارد') ? 'selected' : '' }}>ندارد</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="storage">انباری *</label>
        <select name="storage" id="storage" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('storage', $property->storage ?? '') == 'دارد') ? 'selected' : '' }}>دارد</option>
            <option value="ندارد" {{ (old('storage', $property->storage ?? '') == 'ندارد') ? 'selected' : '' }}>ندارد</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="current_status">وضعیت فعلی *</label>
        <select name="current_status" id="current_status" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="vacant" {{ (old('current_status', $property->current_status ?? '') == 'vacant') ? 'selected' : '' }}>تخلیه</option>
            <option value="active" {{ (old('current_status', $property->current_status ?? '') == 'active') ? 'selected' : '' }}>فعال</option>
            <option value="under_renovation" {{ (old('current_status', $property->current_status ?? '') == 'under_renovation') ? 'selected' : '' }}>در حال بازسازی</option>
            <option value="other" {{ (old('current_status', $property->current_status ?? '') == 'other') ? 'selected' : '' }}>سایر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="usage_type">نوع کاربری *</label>
        <select name="usage_type" id="usage_type" class="form-control" required>
            <option disabled value="">انتخاب کنید</option>
            <option value="صنعتی" {{ (old('usage_type', $property->usage_type ?? '') == 'صنعتی') ? 'selected' : '' }}>صنعتی</option>
            <option value="تجاری" {{ (old('usage_type', $property->usage_type ?? '') == 'تجاری') ? 'selected' : '' }}>تجاری</option>
            <option value="اداری" {{ (old('usage_type', $property->usage_type ?? '') == 'اداری') ? 'selected' : '' }}>اداری</option>
            <option value="کشاورزی" {{ (old('usage_type', $property->usage_type ?? '') == 'کشاورزی') ? 'selected' : '' }}>کشاورزی</option>
            <option value="مسکونی" {{ (old('usage_type', $property->usage_type ?? '') == 'مسکونی') ? 'selected' : '' }}>مسکونی</option>
            <option value="آموزشی" {{ (old('usage_type', $property->usage_type ?? '') == 'آموزشی') ? 'selected' : '' }}>آموزشی</option>
            <option value="خدماتی" {{ (old('usage_type', $property->usage_type ?? '') == 'خدماتی') ? 'selected' : '' }}>خدماتی</option>
        </select>
    </div>

    <hr/>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label class="form-label d-block fw-bold mb-2 pb-1">امکانات *</label>
        @php
            $utilities = is_string($property->utilities ?? '') ? json_decode($property->utilities, true) : ($property->utilities ?? []);
        @endphp
        <div class="row">
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="آب" id="water" {{ (is_array($utilities) && in_array('آب', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="water">آب</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="برق" id="electricity" {{ (is_array($utilities) && in_array('برق', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="electricity">برق</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="گاز" id="gas" {{ (is_array($utilities) && in_array('گاز', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="gas">گاز</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="تلفن" id="phone" {{ (is_array($utilities) && in_array('تلفن', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="phone">تلفن</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="اتاق مدیریت" id="management_room" {{ (is_array($utilities) && in_array('اتاق مدیریت', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="management_room">اتاق مدیریت</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="اتاق کنفرانس" id="conference_room" {{ (is_array($utilities) && in_array('اتاق کنفرانس', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="conference_room">اتاق کنفرانس</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="فضای پذیرش/منشی" id="reception_area" {{ (is_array($utilities) && in_array('فضای پذیرش/منشی', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="reception_area">فضای پذیرش/منشی</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="آبدارخانه/آشپزخانه کوچک" id="pantry" {{ (is_array($utilities) && in_array('آبدارخانه/آشپزخانه کوچک', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="pantry">آبدارخانه/آشپزخانه کوچک</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="تابلوخور" id="signage" {{ (is_array($utilities) && in_array('تابلوخور', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="signage">تابلوخور</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="ورودی مجزا" id="separate_entry" {{ (is_array($utilities) && in_array('ورودی مجزا', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="separate_entry">ورودی مجزا</label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="utilities[]" value="نگهبانی/لابی من" id="security" {{ (is_array($utilities) && in_array('نگهبانی/لابی من', $utilities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="security">نگهبانی/لابی من</label>
                </div>
            </div>
        </div>
    </div>

</div>