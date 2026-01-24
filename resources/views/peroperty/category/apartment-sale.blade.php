        @csrf
        <div class="row">


            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="area">متراژ *</label>
                <input type="number" name="area" id="area" class="form-control" required>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="construction_year">سال ساخت بنا *</label>
                <input type="number" name="construction_year" id="construction_year" class="form-control" required>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="price">قیمت *</label>
                <input type="text" inputmode="numeric" name="price" id="price" class="form-control price-input" required>
            </div>
            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="floor">طبقه *</label>
                <input type="number" name="floor" id="floor" class="form-control" required>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="property_type">نوع ملک *</label></br />
                <div class="btn-group btn-group-sm" role="group" aria-label="نوع ملک">
                    <input class="btn-check" type="radio" id="property-apartment" name="property_type" value="آپارتمان" checked>
                    <label class="btn btn-outline-secondary fw-normal" for="property-apartment">آپارتمان</label>
                    <input class="btn-check" type="radio" id="property-house" name="property_type" value="خانه و کلنگی">
                    <label class="btn btn-outline-secondary fw-normal" for="property-house">خانه و کلنگی</label>
                </div>
            </div>


            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="parking">پارکینگ *</label></br />
                <div class="btn-group btn-group-sm" role="group" aria-label="پارکینگ">
                    <input class="btn-check" type="radio" id="parking-yes" name="parking" value="دارد">
                    <label class="btn btn-outline-secondary fw-normal" for="parking-yes">دارد</label>
                    <input class="btn-check" type="radio" id="parking-no" name="parking" value="ندارد">
                    <label class="btn btn-outline-secondary fw-normal" for="parking-no">ندارد</label>
                </div>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="storage">انباری *</label></br />
                <div class="btn-group btn-group-sm" role="group" aria-label="انباری">
                    <input class="btn-check" type="radio" id="storage-yes" name="storage" value="دارد">
                    <label class="btn btn-outline-secondary fw-normal" for="storage-yes">دارد</label>
                    <input class="btn-check" type="radio" id="storage-no" name="storage" value="ندارد">
                    <label class="btn btn-outline-secondary fw-normal" for="storage-no">ندارد</label>
                </div>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="elevator">آسانسور *</label></br />
                <div class="btn-group btn-group-sm" role="group" aria-label="آسانسور">
                    <input class="btn-check" type="radio" id="elevator-yes" name="elevator" value="دارد">
                    <label class="btn btn-outline-secondary fw-normal" for="elevator-yes">دارد</label>
                    <input class="btn-check" type="radio" id="elevator-no" name="elevator" value="ندارد">
                    <label class="btn btn-outline-secondary fw-normal" for="elevator-no">ندارد</label>
                </div>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="rooms">تعداد اتاق *</label></br />
                <div class="btn-group btn-group-sm" role="group" aria-label="تعداد اتاق">
                    <input class="btn-check" type="radio" id="rooms-1" name="rooms" value="1">
                    <label class="btn btn-outline-secondary fw-normal" for="rooms-1">1</label>
                    <input class="btn-check" type="radio" id="rooms-2" name="rooms" value="2">
                    <label class="btn btn-outline-secondary fw-normal" for="rooms-2">2</label>
                    <input class="btn-check" type="radio" id="rooms-3" name="rooms" value="3">
                    <label class="btn btn-outline-secondary fw-normal" for="rooms-3">3</label>
                    <input class="btn-check" type="radio" id="rooms-4" name="rooms" value="4">
                    <label class="btn btn-outline-secondary fw-normal" for="rooms-4">4</label>
                    <input class="btn-check" type="radio" id="rooms-5" name="rooms" value="5">
                    <label class="btn btn-outline-secondary fw-normal" for="rooms-5">5+</label>
                </div>
            </div>



            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="cabinet_type">جنس کابینت</label>
                <select name="cabinet_type" id="cabinet_type" class="form-control">
                    <option value="">انتخاب</option>
                    <option value="MDF">MDF</option>
                    <option value="های گلاس">های گلاس</option>
                    <option value="ممبران">ممبران</option>
                    <option value="فلزی">فلزی</option>
                    <option value="چوب">چوب</option>
                    <option value="سایر">سایر</option>
                </select>
            </div>


            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="unit_per_floor">تعداد واحد در طبقه</label>
                <select name="unit_per_floor" id="unit_per_floor" class="form-control" required>
                    <option value="">انتخاب</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5+</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="floors_count">تعداد کل طبقات ساختمان</label>
                <input type="number" name="floors_count" id="floors_count" class="form-control" required>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="building_direction">جهت ساختمان</label>
                <select name="building_direction" id="building_direction" class="form-control" required>
                    <option value="">انتخاب</option>
                    <option value="شمال">شمال</option>
                    <option value="جنوب">جنوب</option>
                    <option value="شرق">شرق</option>
                    <option value="غرب">غرب</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="balcony">بالکن *</label></br />
                <div class="btn-group btn-group-sm" role="group" aria-label="بالکن">
                    <input class="btn-check" type="radio" id="balcony-yes" name="balcony" value="دارد" required>
                    <label class="btn btn-outline-secondary fw-normal" for="balcony-yes">دارد</label>
                    <input class="btn-check" type="radio" id="balcony-no" name="balcony" value="ندارد">
                    <label class="btn btn-outline-secondary fw-normal" for="balcony-no">ندارد</label>
                </div>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="floor_type">جنس کف</label>
                <select name="floor_type" id="floor_type" class="form-control" required>
                    <option value="">انتخاب</option>
                    <option value="سرامیک">سرامیک</option>
                    <option value="پارکت">پارکت</option>
                    <option value="فرش">فرش</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="number_of_toilets">تعداد سرویس بهداشتی</label>
                <input type="number" name="number_of_toilets" id="number_of_toilets" class="form-control">
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="cooling_system">سرمایش</label>
                <select name="cooling_system" id="cooling_system" class="form-control">
                    <option disabled value="">انتخاب</option>
                    <option value="کولر">کولر</option>
                    <option value="تهویه مرکزی">تهویه مرکزی</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="heating_system">گرمایش</label>
                <select name="heating_system" id="heating_system" class="form-control">
                    <option disabled value="">انتخاب</option>
                    <option value="رادیاتور">رادیاتور</option>
                    <option value="مرکزی">مرکزی</option>
                    <option value="کف گرم">کف گرم</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="kitchen_type">نوع آشپزخانه</label>
                <select name="kitchen_type" id="kitchen_type" class="form-control">
                    <option disabled selected value="">انتخاب</option>
                    <option value="اپن">اپن</option>
                    <option value="جزیره">جزیره</option>
                    <option value="بسته">بسته</option>
                    <option value="نیمه اپن">نیمه اپن</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="building_facade">نمای ساختمان</label>
                <select name="building_facade" id="building_facade" class="form-control">
                    <option disabled value="">انتخاب</option>
                    <option value="آجر">آجر</option>
                    <option value="سنگ">سنگ</option>
                    <option value="سیمان">سیمان</option>
                    <option value="شیشه">شیشه</option>
                    <option value="ترکیبی">ترکیبی</option>
                    <option value="سایر">سایر</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label>
                    <input type="checkbox" name="rebuilt" value="1"> بازسازی شده است
                </label>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label>
                    <input type="checkbox" name="has_loan" value="1"> وام دارد
                </label>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label>
                    <input type="checkbox" name="exchangeable" value="1"> قابل معاوضه
                </label>
            </div>

        </div>