@csrf
<div class="row">

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ *</label>
        <input type="number" name="area" id="area" class="form-control" value="{{ old('area', $property->area ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="construction_year">سال ساخت بنا *</label>
        <input type="number" name="construction_year" id="construction_year" class="form-control" value="{{ old('construction_year', $property->construction_year ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="price">قیمت *</label>
        <input type="text" inputmode="numeric" name="price" id="price" class="form-control price-input" value="{{ old('price', number_format($property->price ?? 0)) }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor">طبقه *</label>
        <input type="number" name="floor" id="floor" class="form-control" value="{{ old('floor', $property->floor ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="property_type">نوع ملک *</label><br />
        <div class="btn-group btn-group-sm" role="group" aria-label="نوع ملک">
            <input class="btn-check" type="radio" id="property-apartment" name="property_type" value="آپارتمان" {{ (old('property_type', $property->property_type ?? '') == 'آپارتمان') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="property-apartment">آپارتمان</label>
            <input class="btn-check" type="radio" id="property-house" name="property_type" value="خانه و کلنگی" {{ (old('property_type', $property->property_type ?? '') == 'خانه و کلنگی') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="property-house">خانه و کلنگی</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="parking">پارکینگ *</label><br />
        <div class="btn-group btn-group-sm" role="group" aria-label="پارکینگ">
            <input class="btn-check" type="radio" id="parking-yes" name="parking" value="دارد" {{ (old('parking', $property->parking ?? '') == 'دارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="parking-yes">دارد</label>
            <input class="btn-check" type="radio" id="parking-no" name="parking" value="ندارد" {{ (old('parking', $property->parking ?? '') == 'ندارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="parking-no">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="storage">انباری *</label><br />
        <div class="btn-group btn-group-sm" role="group" aria-label="انباری">
            <input class="btn-check" type="radio" id="storage-yes" name="storage" value="دارد" {{ (old('storage', $property->storage ?? '') == 'دارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="storage-yes">دارد</label>
            <input class="btn-check" type="radio" id="storage-no" name="storage" value="ندارد" {{ (old('storage', $property->storage ?? '') == 'ندارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="storage-no">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="elevator">آسانسور *</label><br />
        <div class="btn-group btn-group-sm" role="group" aria-label="آسانسور">
            <input class="btn-check" type="radio" id="elevator-yes" name="elevator" value="دارد" {{ (old('elevator', $property->elevator ?? '') == 'دارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="elevator-yes">دارد</label>
            <input class="btn-check" type="radio" id="elevator-no" name="elevator" value="ندارد" {{ (old('elevator', $property->elevator ?? '') == 'ندارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="elevator-no">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rooms">تعداد اتاق *</label><br />
        <div class="btn-group btn-group-sm" role="group" aria-label="تعداد اتاق">
            <input class="btn-check" type="radio" id="rooms-1" name="rooms" value="1" {{ (old('rooms', $property->rooms ?? '') == '1') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="rooms-1">1</label>
            <input class="btn-check" type="radio" id="rooms-2" name="rooms" value="2" {{ (old('rooms', $property->rooms ?? '') == '2') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="rooms-2">2</label>
            <input class="btn-check" type="radio" id="rooms-3" name="rooms" value="3" {{ (old('rooms', $property->rooms ?? '') == '3') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="rooms-3">3</label>
            <input class="btn-check" type="radio" id="rooms-4" name="rooms" value="4" {{ (old('rooms', $property->rooms ?? '') == '4') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="rooms-4">4</label>
            <input class="btn-check" type="radio" id="rooms-5" name="rooms" value="5" {{ (old('rooms', $property->rooms ?? '') == '5') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="rooms-5">5+</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="cabinet_type">جنس کابینت</label>
        <select name="cabinet_type" id="cabinet_type" class="form-control">
            <option value="">انتخاب</option>
            <option value="MDF" {{ (old('cabinet_type', $property->cabinet_type ?? '') == 'MDF') ? 'selected' : '' }}>MDF</option>
            <option value="های گلاس" {{ (old('cabinet_type', $property->cabinet_type ?? '') == 'های گلاس') ? 'selected' : '' }}>های گلاس</option>
            <option value="ممبران" {{ (old('cabinet_type', $property->cabinet_type ?? '') == 'ممبران') ? 'selected' : '' }}>ممبران</option>
            <option value="فلزی" {{ (old('cabinet_type', $property->cabinet_type ?? '') == 'فلزی') ? 'selected' : '' }}>فلزی</option>
            <option value="چوب" {{ (old('cabinet_type', $property->cabinet_type ?? '') == 'چوب') ? 'selected' : '' }}>چوب</option>
            <option value="سایر" {{ (old('cabinet_type', $property->cabinet_type ?? '') == 'سایر') ? 'selected' : '' }}>سایر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="unit_per_floor">تعداد واحد در طبقه</label>
        <select name="unit_per_floor" id="unit_per_floor" class="form-control" required>
            <option value="">انتخاب</option>
            <option value="1" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '1') ? 'selected' : '' }}>1</option>
            <option value="2" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '2') ? 'selected' : '' }}>2</option>
            <option value="3" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '3') ? 'selected' : '' }}>3</option>
            <option value="4" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '4') ? 'selected' : '' }}>4</option>
            <option value="5" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '5') ? 'selected' : '' }}>5+</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floors_count">تعداد کل طبقات ساختمان</label>
        <input type="number" name="floors_count" id="floors_count" class="form-control" value="{{ old('floors_count', $property->floors_count ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="building_direction">جهت ساختمان</label>
        <select name="building_direction" id="building_direction" class="form-control" required>
            <option value="">انتخاب</option>
            <option value="شمال" {{ (old('building_direction', $property->building_direction ?? '') == 'شمال') ? 'selected' : '' }}>شمال</option>
            <option value="جنوب" {{ (old('building_direction', $property->building_direction ?? '') == 'جنوب') ? 'selected' : '' }}>جنوب</option>
            <option value="شرق" {{ (old('building_direction', $property->building_direction ?? '') == 'شرق') ? 'selected' : '' }}>شرق</option>
            <option value="غرب" {{ (old('building_direction', $property->building_direction ?? '') == 'غرب') ? 'selected' : '' }}>غرب</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="balcony">بالکن *</label><br />
        <div class="btn-group btn-group-sm" role="group" aria-label="بالکن">
            <input class="btn-check" type="radio" id="balcony-yes" name="balcony" value="دارد" {{ (old('balcony', $property->balcony ?? '') == 'دارد') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="balcony-yes">دارد</label>
            <input class="btn-check" type="radio" id="balcony-no" name="balcony" value="ندارد" {{ (old('balcony', $property->balcony ?? '') == 'ندارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="balcony-no">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor_type">جنس کف</label>
        <select name="floor_type" id="floor_type" class="form-control" required>
            <option value="">انتخاب</option>
            <option value="سرامیک" {{ (old('floor_type', $property->floor_type ?? '') == 'سرامیک') ? 'selected' : '' }}>سرامیک</option>
            <option value="پارکت" {{ (old('floor_type', $property->floor_type ?? '') == 'پارکت') ? 'selected' : '' }}>پارکت</option>
            <option value="فرش" {{ (old('floor_type', $property->floor_type ?? '') == 'فرش') ? 'selected' : '' }}>فرش</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="number_of_toilets">تعداد سرویس بهداشتی</label>
        <input type="number" name="number_of_toilets" id="number_of_toilets" class="form-control" value="{{ old('number_of_toilets', $property->number_of_toilets ?? '') }}">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="cooling_system">سرمایش</label>
        <select name="cooling_system" id="cooling_system" class="form-control">
            <option disabled value="">انتخاب</option>
            <option value="کولر" {{ (old('cooling_system', $property->cooling_system ?? '') == 'کولر') ? 'selected' : '' }}>کولر</option>
            <option value="تهویه مرکزی" {{ (old('cooling_system', $property->cooling_system ?? '') == 'تهویه مرکزی') ? 'selected' : '' }}>تهویه مرکزی</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="heating_system">گرمایش</label>
        <select name="heating_system" id="heating_system" class="form-control">
            <option disabled value="">انتخاب</option>
            <option value="رادیاتور" {{ (old('heating_system', $property->heating_system ?? '') == 'رادیاتور') ? 'selected' : '' }}>رادیاتور</option>
            <option value="مرکزی" {{ (old('heating_system', $property->heating_system ?? '') == 'مرکزی') ? 'selected' : '' }}>مرکزی</option>
            <option value="کف گرم" {{ (old('heating_system', $property->heating_system ?? '') == 'کف گرم') ? 'selected' : '' }}>کف گرم</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="kitchen_type">نوع آشپزخانه</label>
        <select name="kitchen_type" id="kitchen_type" class="form-control">
            <option disabled value="">انتخاب</option>
            <option value="اپن" {{ (old('kitchen_type', $property->kitchen_type ?? '') == 'اپن') ? 'selected' : '' }}>اپن</option>
            <option value="جزیره" {{ (old('kitchen_type', $property->kitchen_type ?? '') == 'جزیره') ? 'selected' : '' }}>جزیره</option>
            <option value="بسته" {{ (old('kitchen_type', $property->kitchen_type ?? '') == 'بسته') ? 'selected' : '' }}>بسته</option>
            <option value="نیمه اپن" {{ (old('kitchen_type', $property->kitchen_type ?? '') == 'نیمه اپن') ? 'selected' : '' }}>نیمه اپن</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="building_facade">نمای ساختمان</label>
        <select name="building_facade" id="building_facade" class="form-control">
            <option disabled value="">انتخاب</option>
            <option value="آجر" {{ (old('building_facade', $property->building_facade ?? '') == 'آجر') ? 'selected' : '' }}>آجر</option>
            <option value="سنگ" {{ (old('building_facade', $property->building_facade ?? '') == 'سنگ') ? 'selected' : '' }}>سنگ</option>
            <option value="سیمان" {{ (old('building_facade', $property->building_facade ?? '') == 'سیمان') ? 'selected' : '' }}>سیمان</option>
            <option value="شیشه" {{ (old('building_facade', $property->building_facade ?? '') == 'شیشه') ? 'selected' : '' }}>شیشه</option>
            <option value="ترکیبی" {{ (old('building_facade', $property->building_facade ?? '') == 'ترکیبی') ? 'selected' : '' }}>ترکیبی</option>
            <option value="سایر" {{ (old('building_facade', $property->building_facade ?? '') == 'سایر') ? 'selected' : '' }}>سایر</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label>
            <input type="checkbox" name="rebuilt" value="1" {{ (old('rebuilt', $property->rebuilt ?? '') == '1') ? 'checked' : '' }}> بازسازی شده است
        </label>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label>
            <input type="checkbox" name="has_loan" value="1" {{ (old('has_loan', $property->has_loan ?? '') == '1') ? 'checked' : '' }}> وام دارد
        </label>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label>
            <input type="checkbox" name="exchangeable" value="1" {{ (old('exchangeable', $property->exchangeable ?? '') == '1') ? 'checked' : '' }}> قابل معاوضه
        </label>
    </div>

</div>