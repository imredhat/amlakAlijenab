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
            <label for="property_type">نوع ملک *</label></br/>
            <div class="btn-group btn-group-sm" role="group" aria-label="نوع ملک">
                <input class="btn-check" type="radio" id="property-apartment" name="property_type" value="apartment" checked>
                <label class="btn btn-outline-secondary fw-normal" for="property-apartment">آپارتمان</label>
                <input class="btn-check" type="radio" id="property-house" name="property_type" value="house">
                <label class="btn btn-outline-secondary fw-normal" for="property-house">خانه و کلنگی</label>
            </div>
        </div>


        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="parking">پارکینگ *</label></br/>
            <div class="btn-group btn-group-sm" role="group" aria-label="پارکینگ">
                <input class="btn-check" type="radio" id="parking-yes" name="parking" value="yes">
                <label class="btn btn-outline-secondary fw-normal" for="parking-yes">دارد</label>
                <input class="btn-check" type="radio" id="parking-no" name="parking" value="no">
                <label class="btn btn-outline-secondary fw-normal" for="parking-no">ندارد</label>
            </div>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="storage">انباری *</label></br/>
            <div class="btn-group btn-group-sm" role="group" aria-label="انباری">
                <input class="btn-check" type="radio" id="storage-yes" name="storage" value="yes">
                <label class="btn btn-outline-secondary fw-normal" for="storage-yes">دارد</label>
                <input class="btn-check" type="radio" id="storage-no" name="storage" value="no">
                <label class="btn btn-outline-secondary fw-normal" for="storage-no">ندارد</label>
            </div>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="elevator">آسانسور *</label></br/>
            <div class="btn-group btn-group-sm" role="group" aria-label="آسانسور">
                <input class="btn-check" type="radio" id="elevator-yes" name="elevator" value="yes">
                <label class="btn btn-outline-secondary fw-normal" for="elevator-yes">دارد</label>
                <input class="btn-check" type="radio" id="elevator-no" name="elevator" value="no">
                <label class="btn btn-outline-secondary fw-normal" for="elevator-no">ندارد</label>
            </div>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="rooms">تعداد اتاق *</label></br/>
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
                <option value="mdf">MDF</option>
                <option value="glass">های گلاس</option>
                <option value="membrane">ممبران</option>
                <option value="metal">فلزی</option>
                <option value="wood">چوب</option>
                <option value="other">سایر</option>
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
                <option value="north">شمال</option>
                <option value="south">جنوب</option>
                <option value="east">شرق</option>
                <option value="west">غرب</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="balcony">بالکن *</label></br/>
                        <div class="btn-group btn-group-sm" role="group" aria-label="بالکن">
                            <input class="btn-check" type="radio" id="balcony-yes" name="balcony" value="yes" required>
                            <label class="btn btn-outline-secondary fw-normal" for="balcony-yes">دارد</label>
                            <input class="btn-check" type="radio" id="balcony-no" name="balcony" value="no">
                            <label class="btn btn-outline-secondary fw-normal" for="balcony-no">ندارد</label>
                        </div>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="floor_type">جنس کف</label>
            <select name="floor_type" id="floor_type" class="form-control" required>
                <option value="">انتخاب</option>
                <option value="tile">سرامیک</option>
                <option value="parquet">پارکت</option>
                <option value="carpet">فرش</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="number_of_toilets">تعداد سرویس بهداشتی</label>
            <input type="number" name="number_of_toilets" id="number_of_toilets" class="form-control">
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="cooling_system">سرمایش</label>
            <select name="cooling_system" id="cooling_system" class="form-control">
                <option value="">انتخاب</option>
                <option value="ac">کولر</option>
                <option value="central">تهویه مرکزی</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="heating_system">گرمایش</label>
            <select name="heating_system" id="heating_system" class="form-control">
                <option value="">انتخاب</option>
                <option value="radiator">رادیاتور</option>
                <option value="central">مرکزی</option>
                <option value="underfloor">کف گرم</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="kitchen_type">نوع آشپزخانه</label>
            <select name="kitchen_type" id="kitchen_type" class="form-control">
                <option disabled selected value="">انتخاب</option>
                <option value="open">اپن</option>
                <option value="island">جزیره</option>
                <option value="closed">بسته</option>
                <option value="semi_open">نیمه اپن</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="building_facade">نمای ساختمان</label>
            <select name="building_facade" id="building_facade" class="form-control">
                <option value="">انتخاب</option>
                <option value="brick">آجر</option>
                <option value="stone">سنگ</option>
                <option value="cement">سیمان</option>
                <option value="glass">شیشه</option>
                <option value="combined">ترکیبی</option>
                <option value="other">سایر</option>       
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

 