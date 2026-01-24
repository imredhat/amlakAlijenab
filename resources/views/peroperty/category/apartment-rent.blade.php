    @csrf

    <div class="row">
    

       <!-- سال ساخت -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="build_year">سال ساخت بنا *</label>
        <select name="build_year" id="build_year" class="form-control" required>
            <option value="">انتخاب کنید</option>
            <option value="1404">1404</option>
            <option value="1403">1403</option>
            <option value="1402">1402</option>
            <option value="1401">1401</option>
            <option value="1400">1400</option>
            <option value="1399">1399</option>
            <option value="1398">1398</option>
            <option value="1397">1397</option>
            <option value="1396">1396</option>
            <option value="1395">1395</option>
            <option value="1394">1394</option>
            <option value="1393">1393</option>
            <option value="1392">1392</option>
            <option value="1391">1391</option>
            <option value="1390">1390</option>
            <option value="1389">1389</option>
            <option value="1388">1388</option>
            <option value="1387">1387</option>
            <option value="1386">1386</option>
            <option value="1385">1385</option>
            <option value="1384">1384</option>
            <option value="1383">1383</option>
            <option value="1382">1382</option>
            <option value="1381">1381</option>
            <option value="1380">1380</option>
            <option value="1379">1379</option>
            <option value="1378">1378</option>
            <option value="1377">1377</option>
            <option value="1376">1376</option>
            <option value="1375">1375</option>
            <option value="1374">1374</option>
            <option value="1373">1373</option>
            <option value="1372">1372</option>
            <option value="1371">1371</option>
            <option value="1370">1370</option>
            <option value="1369">1369</option>
            <option value="before_1370">قبل از 1370</option>
        </select>
    </div>


    <!-- متراژ -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ *</label>
        <input type="number" name="area" id="area" class="form-control" required>
    </div>




    <!-- نوع ملک -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="property_type">نوع ملک *</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="نوع ملک">
            <input class="btn-check" type="radio" id="property-apartment" name="property_type" value="آپارتمان" required>
            <label class="btn btn-outline-secondary fw-normal" for="property-apartment">آپارتمان</label>
            <input class="btn-check" type="radio" id="property-house" name="property_type" value="خانه" required>
            <label class="btn btn-outline-secondary fw-normal" for="property-house">خانه</label>
            <input class="btn-check" type="radio" id="property-villa" name="property_type" value="ویلا" required>
            <label class="btn btn-outline-secondary fw-normal" for="property-villa">ویلا</label>
        </div>
    </div>

 

    <!-- پارکینگ -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="parking">پارکینگ *</label></br/>
            <div class="btn-group btn-group-sm" role="group" aria-label="پارکینگ">
                <input class="btn-check" type="radio" id="parking-yes" name="parking" value="دارد" required>
                <label class="btn btn-outline-secondary fw-normal" for="parking-yes">دارد</label>
                <input class="btn-check" type="radio" id="parking-no" name="parking" value="ندارد" required>
                <label class="btn btn-outline-secondary fw-normal" for="parking-no">ندارد</label>
            </div>
    </div>

    <!-- انباری -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="storage">انباری *</label></br/>
            <div class="btn-group btn-group-sm" role="group" aria-label="انباری">
                <input class="btn-check" type="radio" id="storage-yes" name="storage" value="دارد" required>
                <label class="btn btn-outline-secondary fw-normal" for="storage-yes">دارد</label>
                <input class="btn-check" type="radio" id="storage-no" name="storage" value="ندارد" required>
                <label class="btn btn-outline-secondary fw-normal" for="storage-no">ندارد</label>
            </div>
    </div>

    <!-- آسانسور -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="elevator">آسانسور *</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="آسانسور">
            <input class="btn-check" type="radio" id="elevator-yes" name="elevator" value="دارد" required>
            <label class="btn btn-outline-secondary fw-normal" for="elevator-yes">دارد</label>
            <input class="btn-check" type="radio" id="elevator-no" name="elevator" value="ندارد" required>
            <label class="btn btn-outline-secondary fw-normal" for="elevator-no">ندارد</label>
        </div>
    </div>


    
    <!-- رهن -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="mortgage">رهن (تومان)</label>
        <input type="text" name="mortgage" id="mortgage" class="form-control price-input"  inputmode="numeric" autocomplete="off">
    </div>

    <!-- اجاره -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rent">اجاره (تومان)</label>
        <input type="text" name="rent" id="rent" class="form-control price-input" inputmode="numeric" autocomplete="off">
    </div>


    

    <!-- قابلیت تبدیل -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="convertible">
            <input type="checkbox" name="convertible" id="convertible" class="form-check-input">
            قابلیت تبدیل مبلغ رهن و اجاره
        </label>
    </div>


    

       <!-- تعداد واحد در طبقه -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="unit_per_floor">تعداد واحد در طبقه</label></br/>
            <div class="btn-group btn-group-sm" role="group" aria-label="تعداد واحد در طبقه">
                <input class="btn-check" type="radio" id="unit-1" name="unit_per_floor" value="1">
                <label class="btn btn-outline-secondary fw-normal" for="unit-1">1</label>
                <input class="btn-check" type="radio" id="unit-2" name="unit_per_floor" value="2">
                <label class="btn btn-outline-secondary fw-normal" for="unit-2">2</label>
                <input class="btn-check" type="radio" id="unit-3" name="unit_per_floor" value="3">
                <label class="btn btn-outline-secondary fw-normal" for="unit-3">3</label>
                <input class="btn-check" type="radio" id="unit-4" name="unit_per_floor" value="4">
                <label class="btn btn-outline-secondary fw-normal" for="unit-4">4</label>
                <input class="btn-check" type="radio" id="unit-5" name="unit_per_floor" value="5">
                <label class="btn btn-outline-secondary fw-normal" for="unit-5">5+</label>
            </div>
    </div>

    <!-- تعداد کل طبقات ساختمان -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floors_count">تعداد کل طبقات ساختمان</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="تعداد طبقات">
            <input class="btn-check" type="radio" id="floors-1" name="floors_count" value="1">
            <label class="btn btn-outline-secondary fw-normal" for="floors-1">1</label>
            <input class="btn-check" type="radio" id="floors-2" name="floors_count" value="2">
            <label class="btn btn-outline-secondary fw-normal" for="floors-2">2</label>
            <input class="btn-check" type="radio" id="floors-3" name="floors_count" value="3">
            <label class="btn btn-outline-secondary fw-normal" for="floors-3">3</label>
            <input class="btn-check" type="radio" id="floors-5" name="floors_count" value="5">
            <label class="btn btn-outline-secondary fw-normal" for="floors-5">5</label>
            <input class="btn-check" type="radio" id="floors-10" name="floors_count" value="10">
            <label class="btn btn-outline-secondary fw-normal" for="floors-10">10</label>
            <input class="btn-check" type="radio" id="floors-20" name="floors_count" value="20+">
            <label class="btn btn-outline-secondary fw-normal" for="floors-20">20+</label>
        </div>
    </div>

    <!-- جهت ساختمان -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="building_direction">جهت ساختمان</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="جهت ساختمان">
            <input class="btn-check" type="radio" id="direction-north" name="building_direction" value="شمال">
            <label class="btn btn-outline-secondary fw-normal" for="direction-north">شمال</label>
            <input class="btn-check" type="radio" id="direction-south" name="building_direction" value="جنوب">
            <label class="btn btn-outline-secondary fw-normal" for="direction-south">جنوب</label>
            <input class="btn-check" type="radio" id="direction-east" name="building_direction" value="شرق">
            <label class="btn btn-outline-secondary fw-normal" for="direction-east">شرق</label>
            <input class="btn-check" type="radio" id="direction-west" name="building_direction" value="غرب">
            <label class="btn btn-outline-secondary fw-normal" for="direction-west">غرب</label>
        </div>
    </div>

    <!-- جنس کف -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="floor_type">جنس کف</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="جنس کف">
            <input class="btn-check" type="radio" id="floor-ceramic" name="floor_type" value="سرامیک">
            <label class="btn btn-outline-secondary fw-normal" for="floor-ceramic">سرامیک</label>
            <input class="btn-check" type="radio" id="floor-parquet" name="floor_type" value="پارکت">
            <label class="btn btn-outline-secondary fw-normal" for="floor-parquet">پارکت</label>
            <input class="btn-check" type="radio" id="floor-stone" name="floor_type" value="سنگ">
            <label class="btn btn-outline-secondary fw-normal" for="floor-stone">سنگ</label>
            <input class="btn-check" type="radio" id="floor-concrete" name="floor_type" value="بتن">
            <label class="btn btn-outline-secondary fw-normal" for="floor-concrete">بتن</label>
        </div>
    </div>

    <!-- سرویس بهداشتی -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="toilet">سرویس بهداشتی</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="سرویس بهداشتی">
            <input class="btn-check" type="radio" id="toilet-1" name="toilet" value="1">
            <label class="btn btn-outline-secondary fw-normal" for="toilet-1">1</label>
            <input class="btn-check" type="radio" id="toilet-2" name="toilet" value="2">
            <label class="btn btn-outline-secondary fw-normal" for="toilet-2">2</label>
            <input class="btn-check" type="radio" id="toilet-3" name="toilet" value="3">
            <label class="btn btn-outline-secondary fw-normal" for="toilet-3">3+</label>
        </div>
    </div>

    <!-- بالکن -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="balcony">بالکن</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="بالکن">
            <input class="btn-check" type="radio" id="balcony-yes" name="balcony" value="دارد">
            <label class="btn btn-outline-secondary fw-normal" for="balcony-yes">دارد</label>
            <input class="btn-check" type="radio" id="balcony-no" name="balcony" value="ندارد">
            <label class="btn btn-outline-secondary fw-normal" for="balcony-no">ندارد</label>
        </div>
    </div>

    <!-- سرمایش -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="cooling_system">سرمایش</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="سیستم سرمایش">
            <input class="btn-check" type="radio" id="cooling-ac" name="cooling_system" value="کولر گازی">
            <label class="btn btn-outline-secondary fw-normal" for="cooling-ac">کولر گازی</label>
            <input class="btn-check" type="radio" id="cooling-gas_heater" name="cooling_system" value="بخاری گازی">
            <label class="btn btn-outline-secondary fw-normal" for="cooling-gas_heater">بخاری گازی</label>
            <input class="btn-check" type="radio" id="cooling-none" name="cooling_system" value="ندارد">
            <label class="btn btn-outline-secondary fw-normal" for="cooling-none">ندارد</label>
        </div>
    </div>

    <!-- گرمایش -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="heating_system">گرمایش</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="سیستم گرمایش">
            <input class="btn-check" type="radio" id="heating-radiator" name="heating_system" value="رادیاتور">
            <label class="btn btn-outline-secondary fw-normal" for="heating-radiator">رادیاتور</label>
            <input class="btn-check" type="radio" id="heating-floor" name="heating_system" value="کف گرم">
            <label class="btn btn-outline-secondary fw-normal" for="heating-floor">کف گرم</label>
            <input class="btn-check" type="radio" id="heating-none" name="heating_system" value="ندارد">
            <label class="btn btn-outline-secondary fw-normal" for="heating-none">ندارد</label>
        </div>
    </div>

 

    <!-- حیوان خانگی مجاز -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="pets_allowed">حیوان خانگی مجاز</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="حیوان خانگی مجاز">
            <input class="btn-check" type="radio" id="pets-yes" name="pets_allowed" value="مجاز است">
            <label class="btn btn-outline-secondary fw-normal" for="pets-yes">مجاز است</label>
            <input class="btn-check" type="radio" id="pets-no" name="pets_allowed" value="مجاز نیست">
            <label class="btn btn-outline-secondary fw-normal" for="pets-no">مجاز نیست</label>
        </div>
    </div>

    <!-- نوع آشپزخانه -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="kitchen_type">نوع آشپزخانه</label></br/>
        <div class="btn-group btn-group-sm" role="group" aria-label="نوع آشپزخانه">
            <input class="btn-check" type="radio" id="kitchen-closed" name="kitchen_type" value="بسته">
            <label class="btn btn-outline-secondary fw-normal" for="kitchen-closed">بسته</label>
            <input class="btn-check" type="radio" id="kitchen-open" name="kitchen_type" value="باز">
            <label class="btn btn-outline-secondary fw-normal" for="kitchen-open">باز</label>
            <input class="btn-check" type="radio" id="kitchen-semi_open" name="kitchen_type" value="نیمه باز">
            <label class="btn btn-outline-secondary fw-normal" for="kitchen-semi_open">نیمه باز</label>
        </div>
    </div>


    <!-- جنس کابینت -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="cabinet_material">جنس کابینت</label></br/>
            <div class="btn-group btn-group-sm" role="group" aria-label="جنس کابینت">
                <input class="btn-check" type="radio" id="cabinet-wood" name="cabinet_material" value="چوب">
                <label class="btn btn-outline-secondary fw-normal" for="cabinet-wood">چوب</label>
                <input class="btn-check" type="radio" id="cabinet-mdf" name="cabinet_material" value="MDF">
                <label class="btn btn-outline-secondary fw-normal" for="cabinet-mdf">MDF</label>
                <input class="btn-check" type="radio" id="cabinet-metal" name="cabinet_material" value="فلز">
                <label class="btn btn-outline-secondary fw-normal" for="cabinet-metal">فلز</label>
            </div>
    </div>

    <!-- بازسازی شده است -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="rebuilt">
            <input type="checkbox" name="rebuilt" id="rebuilt" class="form-check-input">
            بازسازی شده است
        </label>
    </div>

    <!-- استخر -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="pool">
            <input type="checkbox" name="pool" id="pool" class="form-check-input">
            استخر
        </label>
    </div>

    <!-- سونا -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="sauna">
            <input type="checkbox" name="sauna" id="sauna" class="form-check-input">
            سونا
        </label>
    </div>

    <!-- جکوزی -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="jacuzzi">
            <input type="checkbox" name="jacuzzi" id="jacuzzi" class="form-check-input">
            جکوزی
        </label>
    </div>

    <!-- مبله -->
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="furnished">
            <input type="checkbox" name="furnished" id="furnished" class="form-check-input">
            مبله
        </label>
    </div>

 
    </div>