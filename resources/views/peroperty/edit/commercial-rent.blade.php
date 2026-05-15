@csrf
<div class="row">

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor">طبقه ملک</label>
        <select name="floor" id="floor" class="form-control">
            <option disabled value="">انتخاب کنید</option>
            <option value="زیر همکف" {{ (old('floor', $property->floor ?? '') == 'زیر همکف') ? 'selected' : '' }}>زیر همکف</option>
            <option value="همکف" {{ (old('floor', $property->floor ?? '') == 'همکف') ? 'selected' : '' }}>همکف</option>
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
            <option value="اداری" {{ (old('type', $property->type ?? '') == 'اداری') ? 'selected' : '' }}>اداری</option>
            <option value="تجاری و مغازه" {{ (old('type', $property->type ?? '') == 'تجاری و مغازه') ? 'selected' : '' }}>تجاری و مغازه</option>
            <option value="صنعتی (سوله، انبار، کارگاه)" {{ (old('type', $property->type ?? '') == 'صنعتی (سوله، انبار، کارگاه)') ? 'selected' : '' }}>صنعتی (سوله، انبار، کارگاه)</option>
            <option value="دامداری و کشاورزی" {{ (old('type', $property->type ?? '') == 'دامداری و کشاورزی') ? 'selected' : '' }}>دامداری و کشاورزی</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="mortgage">رهن (تومان)</label>
        <input type="text" name="mortgage" id="mortgage" class="form-control price-input" value="{{ old('mortgage', number_format($property->mortgage ?? 0)) }}">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rent">اجاره (تومان) *</label>
        <input type="text" name="rent" id="rent" class="form-control price-input" value="{{ old('rent', number_format($property->rent ?? 0)) }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label>
            <input type="checkbox" name="convertible" value="1" class="form-check-input" {{ (old('convertible', $property->convertible ?? '') == '1') ? 'checked' : '' }}>
            قابلیت تبدیل مبلغ رهن و اجاره
        </label>
    </div>

    <hr/>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ *</label>
        <input type="number" name="area" id="area" class="form-control" value="{{ old('area', $property->area ?? '') }}" required>
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
        <label for="toilet">سرویس بهداشتی *</label>
        <select name="toilet" id="toilet" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('toilet', $property->toilet ?? '') == 'دارد') ? 'selected' : '' }}>دارد</option>
            <option value="ندارد" {{ (old('toilet', $property->toilet ?? '') == 'ندارد') ? 'selected' : '' }}>ندارد</option>
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
        <label for="usage_type">نوع کاربری *</label>
        <select name="usage_type" id="usage_type" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="صنعتی" {{ (old('usage_type', $property->usage_type ?? '') == 'صنعتی') ? 'selected' : '' }}>صنعتی</option>
            <option value="تجاری" {{ (old('usage_type', $property->usage_type ?? '') == 'تجاری') ? 'selected' : '' }}>تجاری</option>
            <option value="اداری" {{ (old('usage_type', $property->usage_type ?? '') == 'اداری') ? 'selected' : '' }}>اداری</option>
            <option value="کشاورزی" {{ (old('usage_type', $property->usage_type ?? '') == 'کشاورزی') ? 'selected' : '' }}>کشاورزی</option>
            <option value="مسکونی" {{ (old('usage_type', $property->usage_type ?? '') == 'مسکونی') ? 'selected' : '' }}>مسکونی</option>
            <option value="آموزشی" {{ (old('usage_type', $property->usage_type ?? '') == 'آموزشی') ? 'selected' : '' }}>آموزشی</option>
            <option value="خدماتی" {{ (old('usage_type', $property->usage_type ?? '') == 'خدماتی') ? 'selected' : '' }}>خدماتی</option>
        </select>
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