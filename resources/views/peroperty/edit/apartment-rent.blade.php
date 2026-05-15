@csrf
<div class="row">

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="build_year">سال ساخت بنا *</label>
        <select name="build_year" id="build_year" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="1404" {{ (old('build_year', $property->build_year ?? '') == '1404') ? 'selected' : '' }}>1404</option>
            <option value="1403" {{ (old('build_year', $property->build_year ?? '') == '1403') ? 'selected' : '' }}>1403</option>
            <option value="1402" {{ (old('build_year', $property->build_year ?? '') == '1402') ? 'selected' : '' }}>1402</option>
            <option value="1401" {{ (old('build_year', $property->build_year ?? '') == '1401') ? 'selected' : '' }}>1401</option>
            <option value="1400" {{ (old('build_year', $property->build_year ?? '') == '1400') ? 'selected' : '' }}>1400</option>
            <option value="1399" {{ (old('build_year', $property->build_year ?? '') == '1399') ? 'selected' : '' }}>1399</option>
            <option value="1398" {{ (old('build_year', $property->build_year ?? '') == '1398') ? 'selected' : '' }}>1398</option>
            <option value="1397" {{ (old('build_year', $property->build_year ?? '') == '1397') ? 'selected' : '' }}>1397</option>
            <option value="1396" {{ (old('build_year', $property->build_year ?? '') == '1396') ? 'selected' : '' }}>1396</option>
            <option value="1395" {{ (old('build_year', $property->build_year ?? '') == '1395') ? 'selected' : '' }}>1395</option>
            <option value="1394" {{ (old('build_year', $property->build_year ?? '') == '1394') ? 'selected' : '' }}>1394</option>
            <option value="1393" {{ (old('build_year', $property->build_year ?? '') == '1393') ? 'selected' : '' }}>1393</option>
            <option value="1392" {{ (old('build_year', $property->build_year ?? '') == '1392') ? 'selected' : '' }}>1392</option>
            <option value="1391" {{ (old('build_year', $property->build_year ?? '') == '1391') ? 'selected' : '' }}>1391</option>
            <option value="1390" {{ (old('build_year', $property->build_year ?? '') == '1390') ? 'selected' : '' }}>1390</option>
            <option value="1389" {{ (old('build_year', $property->build_year ?? '') == '1389') ? 'selected' : '' }}>1389</option>
            <option value="1388" {{ (old('build_year', $property->build_year ?? '') == '1388') ? 'selected' : '' }}>1388</option>
            <option value="1387" {{ (old('build_year', $property->build_year ?? '') == '1387') ? 'selected' : '' }}>1387</option>
            <option value="1386" {{ (old('build_year', $property->build_year ?? '') == '1386') ? 'selected' : '' }}>1386</option>
            <option value="1385" {{ (old('build_year', $property->build_year ?? '') == '1385') ? 'selected' : '' }}>1385</option>
            <option value="1384" {{ (old('build_year', $property->build_year ?? '') == '1384') ? 'selected' : '' }}>1384</option>
            <option value="1383" {{ (old('build_year', $property->build_year ?? '') == '1383') ? 'selected' : '' }}>1383</option>
            <option value="1382" {{ (old('build_year', $property->build_year ?? '') == '1382') ? 'selected' : '' }}>1382</option>
            <option value="1381" {{ (old('build_year', $property->build_year ?? '') == '1381') ? 'selected' : '' }}>1381</option>
            <option value="1380" {{ (old('build_year', $property->build_year ?? '') == '1380') ? 'selected' : '' }}>1380</option>
            <option value="1379" {{ (old('build_year', $property->build_year ?? '') == '1379') ? 'selected' : '' }}>1379</option>
            <option value="1378" {{ (old('build_year', $property->build_year ?? '') == '1378') ? 'selected' : '' }}>1378</option>
            <option value="1377" {{ (old('build_year', $property->build_year ?? '') == '1377') ? 'selected' : '' }}>1377</option>
            <option value="1376" {{ (old('build_year', $property->build_year ?? '') == '1376') ? 'selected' : '' }}>1376</option>
            <option value="1375" {{ (old('build_year', $property->build_year ?? '') == '1375') ? 'selected' : '' }}>1375</option>
            <option value="1374" {{ (old('build_year', $property->build_year ?? '') == '1374') ? 'selected' : '' }}>1374</option>
            <option value="1373" {{ (old('build_year', $property->build_year ?? '') == '1373') ? 'selected' : '' }}>1373</option>
            <option value="1372" {{ (old('build_year', $property->build_year ?? '') == '1372') ? 'selected' : '' }}>1372</option>
            <option value="1371" {{ (old('build_year', $property->build_year ?? '') == '1371') ? 'selected' : '' }}>1371</option>
            <option value="1370" {{ (old('build_year', $property->build_year ?? '') == '1370') ? 'selected' : '' }}>1370</option>
            <option value="1369" {{ (old('build_year', $property->build_year ?? '') == '1369') ? 'selected' : '' }}>1369</option>
            <option value="before_1370" {{ (old('build_year', $property->build_year ?? '') == 'before_1370') ? 'selected' : '' }}>قبل از 1370</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ *</label>
        <input type="number" name="area" id="area" class="form-control" value="{{ old('area', $property->area ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="property_type">نوع ملک *</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="نوع ملک">
            <input class="btn-check" type="radio" id="property-apartment" name="property_type" value="آپارتمان" {{ (old('property_type', $property->property_type ?? '') == 'آپارتمان') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="property-apartment">آپارتمان</label>
            <input class="btn-check" type="radio" id="property-house" name="property_type" value="خانه" {{ (old('property_type', $property->property_type ?? '') == 'خانه') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="property-house">خانه</label>
            <input class="btn-check" type="radio" id="property-villa" name="property_type" value="ویلا" {{ (old('property_type', $property->property_type ?? '') == 'ویلا') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="property-villa">ویلا</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="parking">پارکینگ *</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="پارکینگ">
            <input class="btn-check" type="radio" id="parking-yes" name="parking" value="دارد" {{ (old('parking', $property->parking ?? '') == 'دارد') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="parking-yes">دارد</label>
            <input class="btn-check" type="radio" id="parking-no" name="parking" value="ندارد" {{ (old('parking', $property->parking ?? '') == 'ندارد') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="parking-no">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="storage">انباری *</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="انباری">
            <input class="btn-check" type="radio" id="storage-yes" name="storage" value="دارد" {{ (old('storage', $property->storage ?? '') == 'دارد') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="storage-yes">دارد</label>
            <input class="btn-check" type="radio" id="storage-no" name="storage" value="ندارد" {{ (old('storage', $property->storage ?? '') == 'ندارد') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="storage-no">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="elevator">آسانسور *</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="آسانسور">
            <input class="btn-check" type="radio" id="elevator-yes" name="elevator" value="دارد" {{ (old('elevator', $property->elevator ?? '') == 'دارد') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="elevator-yes">دارد</label>
            <input class="btn-check" type="radio" id="elevator-no" name="elevator" value="ندارد" {{ (old('elevator', $property->elevator ?? '') == 'ندارد') ? 'checked' : '' }} required>
            <label class="btn btn-outline-secondary fw-normal" for="elevator-no">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="mortgage">رهن (تومان)</label>
        <input type="text" name="mortgage" id="mortgage" class="form-control price-input" inputmode="numeric" autocomplete="off" value="{{ old('mortgage', number_format($property->mortgage ?? 0)) }}">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rent">اجاره (تومان)</label>
        <input type="text" name="rent" id="rent" class="form-control price-input" inputmode="numeric" autocomplete="off" value="{{ old('rent', number_format($property->rent ?? 0)) }}">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="convertible">
            <input type="checkbox" name="convertible" id="convertible" class="form-check-input" value="1" {{ (old('convertible', $property->convertible ?? '') == '1') ? 'checked' : '' }}>
            قابلیت تبدیل مبلغ رهن و اجاره
        </label>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="unit_per_floor">تعداد واحد در طبقه</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="تعداد واحد در طبقه">
            <input class="btn-check" type="radio" id="unit-1" name="unit_per_floor" value="1" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '1') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="unit-1">1</label>
            <input class="btn-check" type="radio" id="unit-2" name="unit_per_floor" value="2" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '2') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="unit-2">2</label>
            <input class="btn-check" type="radio" id="unit-3" name="unit_per_floor" value="3" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '3') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="unit-3">3</label>
            <input class="btn-check" type="radio" id="unit-4" name="unit_per_floor" value="4" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '4') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="unit-4">4</label>
            <input class="btn-check" type="radio" id="unit-5" name="unit_per_floor" value="5" {{ (old('unit_per_floor', $property->unit_per_floor ?? '') == '5') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="unit-5">5+</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floors_count">تعداد کل طبقات ساختمان</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="تعداد طبقات">
            <input class="btn-check" type="radio" id="floors-1" name="floors_count" value="1" {{ (old('floors_count', $property->floors_count ?? '') == '1') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floors-1">1</label>
            <input class="btn-check" type="radio" id="floors-2" name="floors_count" value="2" {{ (old('floors_count', $property->floors_count ?? '') == '2') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floors-2">2</label>
            <input class="btn-check" type="radio" id="floors-3" name="floors_count" value="3" {{ (old('floors_count', $property->floors_count ?? '') == '3') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floors-3">3</label>
            <input class="btn-check" type="radio" id="floors-5" name="floors_count" value="5" {{ (old('floors_count', $property->floors_count ?? '') == '5') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floors-5">5</label>
            <input class="btn-check" type="radio" id="floors-10" name="floors_count" value="10" {{ (old('floors_count', $property->floors_count ?? '') == '10') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floors-10">10</label>
            <input class="btn-check" type="radio" id="floors-20" name="floors_count" value="20+" {{ (old('floors_count', $property->floors_count ?? '') == '20+') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floors-20">20+</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="building_direction">جهت ساختمان</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="جهت ساختمان">
            <input class="btn-check" type="radio" id="direction-north" name="building_direction" value="شمال" {{ (old('building_direction', $property->building_direction ?? '') == 'شمال') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="direction-north">شمال</label>
            <input class="btn-check" type="radio" id="direction-south" name="building_direction" value="جنوب" {{ (old('building_direction', $property->building_direction ?? '') == 'جنوب') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="direction-south">جنوب</label>
            <input class="btn-check" type="radio" id="direction-east" name="building_direction" value="شرق" {{ (old('building_direction', $property->building_direction ?? '') == 'شرق') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="direction-east">شرق</label>
            <input class="btn-check" type="radio" id="direction-west" name="building_direction" value="غرب" {{ (old('building_direction', $property->building_direction ?? '') == 'غرب') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="direction-west">غرب</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor_type">جنس کف</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="جنس کف">
            <input class="btn-check" type="radio" id="floor-ceramic" name="floor_type" value="سرامیک" {{ (old('floor_type', $property->floor_type ?? '') == 'سرامیک') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floor-ceramic">سرامیک</label>
            <input class="btn-check" type="radio" id="floor-parquet" name="floor_type" value="پارکت" {{ (old('floor_type', $property->floor_type ?? '') == 'پارکت') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floor-parquet">پارکت</label>
            <input class="btn-check" type="radio" id="floor-stone" name="floor_type" value="سنگ" {{ (old('floor_type', $property->floor_type ?? '') == 'سنگ') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floor-stone">سنگ</label>
            <input class="btn-check" type="radio" id="floor-concrete" name="floor_type" value="بتن" {{ (old('floor_type', $property->floor_type ?? '') == 'بتن') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="floor-concrete">بتن</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="toilet">سرویس بهداشتی</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="سرویس بهداشتی">
            <input class="btn-check" type="radio" id="toilet-1" name="toilet" value="1" {{ (old('toilet', $property->toilet ?? '') == '1') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="toilet-1">1</label>
            <input class="btn-check" type="radio" id="toilet-2" name="toilet" value="2" {{ (old('toilet', $property->toilet ?? '') == '2') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="toilet-2">2</label>
            <input class="btn-check" type="radio" id="toilet-3" name="toilet" value="3" {{ (old('toilet', $property->toilet ?? '') == '3') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="toilet-3">3+</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="balcony">بالکن</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="بالکن">
            <input class="btn-check" type="radio" id="balcony-yes" name="balcony" value="دارد" {{ (old('balcony', $property->balcony ?? '') == 'دارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="balcony-yes">دارد</label>
            <input class="btn-check" type="radio" id="balcony-no" name="balcony" value="ندارد" {{ (old('balcony', $property->balcony ?? '') == 'ندارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="balcony-no">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="cooling_system">سرمایش</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="سیستم سرمایش">
            <input class="btn-check" type="radio" id="cooling-ac" name="cooling_system" value="کولر گازی" {{ (old('cooling_system', $property->cooling_system ?? '') == 'کولر گازی') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="cooling-ac">کولر گازی</label>
            <input class="btn-check" type="radio" id="cooling-gas_heater" name="cooling_system" value="بخاری گازی" {{ (old('cooling_system', $property->cooling_system ?? '') == 'بخاری گازی') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="cooling-gas_heater">بخاری گازی</label>
            <input class="btn-check" type="radio" id="cooling-none" name="cooling_system" value="ندارد" {{ (old('cooling_system', $property->cooling_system ?? '') == 'ندارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="cooling-none">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="heating_system">گرمایش</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="سیستم گرمایش">
            <input class="btn-check" type="radio" id="heating-radiator" name="heating_system" value="رادیاتور" {{ (old('heating_system', $property->heating_system ?? '') == 'رادیاتور') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="heating-radiator">رادیاتور</label>
            <input class="btn-check" type="radio" id="heating-floor" name="heating_system" value="کف گرم" {{ (old('heating_system', $property->heating_system ?? '') == 'کف گرم') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="heating-floor">کف گرم</label>
            <input class="btn-check" type="radio" id="heating-none" name="heating_system" value="ندارد" {{ (old('heating_system', $property->heating_system ?? '') == 'ندارد') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="heating-none">ندارد</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="pets_allowed">حیوان خانگی مجاز</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="حیوان خانگی مجاز">
            <input class="btn-check" type="radio" id="pets-yes" name="pets_allowed" value="مجاز است" {{ (old('pets_allowed', $property->pets_allowed ?? '') == 'مجاز است') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="pets-yes">مجاز است</label>
            <input class="btn-check" type="radio" id="pets-no" name="pets_allowed" value="مجاز نیست" {{ (old('pets_allowed', $property->pets_allowed ?? '') == 'مجاز نیست') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="pets-no">مجاز نیست</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="kitchen_type">نوع آشپزخانه</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="نوع آشپزخانه">
            <input class="btn-check" type="radio" id="kitchen-closed" name="kitchen_type" value="بسته" {{ (old('kitchen_type', $property->kitchen_type ?? '') == 'بسته') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="kitchen-closed">بسته</label>
            <input class="btn-check" type="radio" id="kitchen-open" name="kitchen_type" value="باز" {{ (old('kitchen_type', $property->kitchen_type ?? '') == 'باز') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="kitchen-open">باز</label>
            <input class="btn-check" type="radio" id="kitchen-semi_open" name="kitchen_type" value="نیمه باز" {{ (old('kitchen_type', $property->kitchen_type ?? '') == 'نیمه باز') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="kitchen-semi_open">نیمه باز</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="cabinet_material">جنس کابینت</label><br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="جنس کابینت">
            <input class="btn-check" type="radio" id="cabinet-wood" name="cabinet_material" value="چوب" {{ (old('cabinet_material', $property->cabinet_material ?? '') == 'چوب') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="cabinet-wood">چوب</label>
            <input class="btn-check" type="radio" id="cabinet-mdf" name="cabinet_material" value="MDF" {{ (old('cabinet_material', $property->cabinet_material ?? '') == 'MDF') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="cabinet-mdf">MDF</label>
            <input class="btn-check" type="radio" id="cabinet-metal" name="cabinet_material" value="فلز" {{ (old('cabinet_material', $property->cabinet_material ?? '') == 'فلز') ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary fw-normal" for="cabinet-metal">فلز</label>
        </div>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rebuilt">
            <input type="checkbox" name="rebuilt" id="rebuilt" class="form-check-input" value="1" {{ (old('rebuilt', $property->rebuilt ?? '') == 'on') ? 'checked' : '' }}>
            بازسازی شده است
        </label>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="pool">
            <input type="checkbox" name="pool" id="pool" class="form-check-input" value="1" {{ (old('pool', $property->pool ?? '') == 'on') ? 'checked' : '' }}>
            استخر
        </label>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="sauna">
            <input type="checkbox" name="sauna" id="sauna" class="form-check-input" value="1" {{ (old('sauna', $property->sauna ?? '') == 'on') ? 'checked' : '' }}>
            سونا
        </label>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="jacuzzi">
            <input type="checkbox" name="jacuzzi" id="jacuzzi" class="form-check-input" value="1" {{ (old('jacuzzi', $property->jacuzzi ?? '') == 'on') ? 'checked' : '' }}>
            جکوزی
        </label>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="furnished">
            <input type="checkbox" name="furnished" id="furnished" class="form-check-input" value="1" {{ (old('furnished', $property->furnished ?? '') == 'on') ? 'checked' : '' }}>
            مبله
        </label>
    </div>

</div>