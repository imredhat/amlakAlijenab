@csrf
<div class="row">

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="area" name="area" value="{{ old('area', $property->area ?? '') }}" placeholder="متراژ را وارد کنید" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="capacity">ظرفیت</label>
        <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $property->capacity ?? '') }}" placeholder="ظرفیت را وارد کنید">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rooms">تعداد اتاق <span class="text-danger">*</span></label>
        <select class="form-control" id="rooms" name="rooms" required>
            <option value="">انتخاب کنید</option>
            <option value="1" {{ (old('rooms', $property->rooms ?? '') == '1') ? 'selected' : '' }}>1</option>
            <option value="2" {{ (old('rooms', $property->rooms ?? '') == '2') ? 'selected' : '' }}>2</option>
            <option value="3" {{ (old('rooms', $property->rooms ?? '') == '3') ? 'selected' : '' }}>3</option>
            <option value="4" {{ (old('rooms', $property->rooms ?? '') == '4') ? 'selected' : '' }}>4</option>
            <option value="5" {{ (old('rooms', $property->rooms ?? '') == '5') ? 'selected' : '' }}>5+</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="standard_capacity">ظرفیت استاندارد <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="standard_capacity" name="standard_capacity" value="{{ old('standard_capacity', $property->standard_capacity ?? '') }}" placeholder="ظرفیت استاندارد را وارد کنید" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="extra_capacity">ظرفیت اضافه <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="extra_capacity" name="extra_capacity" value="{{ old('extra_capacity', $property->extra_capacity ?? '') }}" placeholder="ظرفیت اضافه را وارد کنید" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="daily_rent">اجاره روزانه (تومان)</label>
        <input type="text" class="form-control price-input" inputmode="numeric" id="daily_rent" name="daily_rent" value="{{ old('daily_rent', number_format($property->daily_rent ?? 0)) }}" placeholder="اجاره روزانه را وارد کنید">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="regular_days">روزهای عادی (شنبه تا سه‌شنبه) (تومان/شب) <span class="text-danger">*</span></label>
        <input type="text" class="form-control price-input" inputmode="numeric" id="regular_days" name="regular_days" value="{{ old('regular_days', number_format($property->regular_days ?? 0)) }}" placeholder="قیمت روزهای عادی را وارد کنید" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="weekend">آخر هفته (چهارشنبه تا جمعه) (تومان) <span class="text-danger">*</span></label>
        <input type="text" class="form-control price-input" inputmode="numeric" id="weekend" name="weekend" value="{{ old('weekend', number_format($property->weekend ?? 0)) }}" placeholder="قیمت آخر هفته را وارد کنید" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="special_days">روزهای خاص (تعطیلات و مناسبت‌ها) (تومان) <span class="text-danger">*</span></label>
        <input type="text" class="form-control price-input" inputmode="numeric" id="special_days" name="special_days" value="{{ old('special_days', number_format($property->special_days ?? 0)) }}" placeholder="قیمت روزهای خاص را وارد کنید" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="extra_person_cost">هزینهٔ هر نفر اضافه (تومان / شب) <span class="text-danger">*</span></label>
        <input type="text" class="form-control price-input" inputmode="numeric" id="extra_person_cost" name="extra_person_cost" value="{{ old('extra_person_cost', number_format($property->extra_person_cost ?? 0)) }}" placeholder="هزینه هر نفر اضافه را وارد کنید" required>
    </div>

    <hr/>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor">طبقه</label>
        <select class="form-control" id="floor" name="floor">
            <option disabled value="">انتخاب کنید</option>
            <option value="1" {{ (old('floor', $property->floor ?? '') == '1') ? 'selected' : '' }}>1</option>
            <option value="2" {{ (old('floor', $property->floor ?? '') == '2') ? 'selected' : '' }}>2</option>
            <option value="3" {{ (old('floor', $property->floor ?? '') == '3') ? 'selected' : '' }}>3</option>
            <option value="4" {{ (old('floor', $property->floor ?? '') == '4') ? 'selected' : '' }}>4</option>
            <option value="5" {{ (old('floor', $property->floor ?? '') == '5') ? 'selected' : '' }}>5+</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="elevator">آسانسور</label>
        <select class="form-control" id="elevator" name="elevator">
            <option disabled value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('elevator', $property->elevator ?? '') == 'دارد') ? 'selected' : '' }}>بله</option>
            <option value="ندارد" {{ (old('elevator', $property->elevator ?? '') == 'ندارد') ? 'selected' : '' }}>خیر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="pets_allowed">حیوان خانگی مجاز</label>
        <select class="form-control" id="pets_allowed" name="pets_allowed">
            <option disabled value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('pets_allowed', $property->pets_allowed ?? '') == 'دارد') ? 'selected' : '' }}>بله</option>
            <option value="ندارد" {{ (old('pets_allowed', $property->pets_allowed ?? '') == 'ندارد') ? 'selected' : '' }}>خیر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="parking">پارکینگ</label>
        <select class="form-control" id="parking" name="parking">
            <option disabled value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('parking', $property->parking ?? '') == 'دارد') ? 'selected' : '' }}>بله</option>
            <option value="ندارد" {{ (old('parking', $property->parking ?? '') == 'ندارد') ? 'selected' : '' }}>خیر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rental_period">دوره اجاره</label>
        <select class="form-control" id="rental_period" name="rental_period">
            <option disabled value="">انتخاب کنید</option>
            <option value="روزانه" {{ (old('rental_period', $property->rental_period ?? '') == 'روزانه') ? 'selected' : '' }}>روزانه</option>
            <option value="هفتگی" {{ (old('rental_period', $property->rental_period ?? '') == 'هفتگی') ? 'selected' : '' }}>هفتگی</option>
            <option value="ماهانه" {{ (old('rental_period', $property->rental_period ?? '') == 'ماهانه') ? 'selected' : '' }}>ماهانه</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="heating_cooling_system">سیستم گرمایش/سرمایش</label>
        <select class="form-control" id="heating_cooling_system" name="heating_cooling_system">
            <option disabled value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('heating_cooling_system', $property->heating_cooling_system ?? '') == 'دارد') ? 'selected' : '' }}>بله</option>
            <option value="ندارد" {{ (old('heating_cooling_system', $property->heating_cooling_system ?? '') == 'ندارد') ? 'selected' : '' }}>خیر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="check_in_time">ساعت ورود</label>
        <input type="time" class="form-control" id="check_in_time" name="check_in_time" value="{{ old('check_in_time', $property->check_in_time ?? '') }}">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="minimum_stay">حداقل مدت اقامت (روز)</label>
        <input type="number" class="form-control" id="minimum_stay" name="minimum_stay" value="{{ old('minimum_stay', $property->minimum_stay ?? '') }}" placeholder="حداقل مدت اقامت را وارد کنید">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="check_out_time">ساعت خروج</label>
        <input type="time" class="form-control" id="check_out_time" name="check_out_time" value="{{ old('check_out_time', $property->check_out_time ?? '') }}">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="fully_furnished">مبله است</label>
        <select class="form-control" id="fully_furnished" name="fully_furnished">
            <option disabled value="">انتخاب کنید</option>
            <option value="دارد" {{ (old('fully_furnished', $property->fully_furnished ?? '') == 'دارد') ? 'selected' : '' }}>بله</option>
            <option value="ندارد" {{ (old('fully_furnished', $property->fully_furnished ?? '') == 'ندارد') ? 'selected' : '' }}>خیر</option>
        </select>
    </div>

    <hr/>

    <div class="col-sm-12 pb-3 pe-3 pt-3 ps-3">
        <label class="form-label d-block fw-bold mb-2 pb-1">امکانات رفاهی</label>
        @php
            $amenities = is_string($property->amenities ?? '') ? json_decode($property->amenities, true) : ($property->amenities ?? []);
        @endphp
        <div class="row">
            <div class="col-sm-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="wifi" name="amenities[]" value="وای فای" {{ (is_array($amenities) && in_array('وای فای', $amenities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="wifi">وای فای</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="air-condition" name="amenities[]" value="تهویه هوا" {{ (is_array($amenities) && in_array('تهویه هوا', $amenities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="air-condition">تهویه هوا</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="balcony" name="amenities[]" value="بالکن" {{ (is_array($amenities) && in_array('بالکن', $amenities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="balcony">بالکن</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="garage" name="amenities[]" value="گاراژ" {{ (is_array($amenities) && in_array('گاراژ', $amenities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="garage">گاراژ</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gym" name="amenities[]" value="باشگاه بدنسازی" {{ (is_array($amenities) && in_array('باشگاه بدنسازی', $amenities)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="gym">باشگاه بدنسازی</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="free-parking" name="amenities[]" value="پارکینگ رایگان" {{ (is_array($amenities) && in_array('پارکینگ رایگان', $amenities)) ? 'checked' : '' }}>
                   