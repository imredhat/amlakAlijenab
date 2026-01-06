    @csrf
    <div class="row">

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="area">متراژ <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="area" name="area" placeholder="متراژ را وارد کنید" required>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="capacity">ظرفیت</label>
            <input type="number" class="form-control" id="capacity" name="capacity" placeholder="ظرفیت را وارد کنید">
        </div>

        
        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="rooms">تعداد اتاق <span class="text-danger">*</span></label>
            <select class="form-control" id="rooms" name="rooms" required>
                <option value="">انتخاب کنید</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5+</option>
            </select>
        </div>


        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="standard_capacity">ظرفیت استاندارد <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="standard_capacity" name="standard_capacity" placeholder="ظرفیت استاندارد را وارد کنید" required>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="extra_capacity">ظرفیت اضافه <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="extra_capacity" name="extra_capacity" placeholder="ظرفیت اضافه را وارد کنید" required>
        </div>

     

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="daily_rent">اجاره روزانه (تومان)</label>
            <input type="number" class="form-control price-input" inputmode="numeric" id="daily_rent" name="daily_rent" placeholder="اجاره روزانه را وارد کنید">
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="regular_days">روزهای عادی (شنبه تا سه‌شنبه) (تومان/شب) <span class="text-danger">*</span></label>
            <input type="number" class="form-control price-input" inputmode="numeric" id="regular_days" name="regular_days" placeholder="قیمت روزهای عادی را وارد کنید" required>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="weekend">آخر هفته (چهارشنبه تا جمعه) (تومان) <span class="text-danger">*</span></label>
            <input type="number" class="form-control price-input" inputmode="numeric" id="weekend" name="weekend" placeholder="قیمت آخر هفته را وارد کنید" required>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="special_days">روزهای خاص (تعطیلات و مناسبت‌ها) (تومان) <span class="text-danger">*</span></label>
            <input type="number" class="form-control price-input" inputmode="numeric" id="special_days" name="special_days" placeholder="قیمت روزهای خاص را وارد کنید" required>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="extra_person_cost">هزینهٔ هر نفر اضافه (تومان / شب) <span class="text-danger">*</span></label>
            <input type="number" class="form-control price-input" inputmode="numeric" id="extra_person_cost" name="extra_person_cost" placeholder="هزینه هر نفر اضافه را وارد کنید" required>
        </div>


        <hr/>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="floor">طبقه</label>
            <select class="form-control" id="floor" name="floor">
            <option value="">انتخاب کنید</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5+</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="elevator">آسانسور</label>
            <select class="form-control" id="elevator" name="elevator">
            <option value="">انتخاب کنید</option>
            <option value="yes">بله</option>
            <option value="no">خیر</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="pets_allowed">حیوان خانگی مجاز</label>
            <select class="form-control" id="pets_allowed" name="pets_allowed">
            <option value="">انتخاب کنید</option>
            <option value="yes">بله</option>
            <option value="no">خیر</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="parking">پارکینگ</label>
            <select class="form-control" id="parking" name="parking">
            <option value="">انتخاب کنید</option>
            <option value="yes">بله</option>
            <option value="no">خیر</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="rental_period">دوره اجاره</label>
            <select class="form-control" id="rental_period" name="rental_period">
            <option value="">انتخاب کنید</option>
            <option value="daily">روزانه</option>
            <option value="weekly">هفتگی</option>
            <option value="monthly">ماهانه</option>
            </select>
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="heating_cooling_system">سیستم گرمایش/سرمایش</label>
            <select class="form-control" id="heating_cooling_system" name="heating_cooling_system">
            <option value="">انتخاب کنید</option>
            <option value="yes">بله</option>
            <option value="no">خیر</option>
            </select>
        </div>

   

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="check_in_time">ساعت ورود</label>
            <input type="time" class="form-control" id="check_in_time" name="check_in_time">
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="minimum_stay">حداقل مدت اقامت (روز)</label>
            <input type="number" class="form-control" id="minimum_stay" name="minimum_stay" placeholder="حداقل مدت اقامت را وارد کنید">
        </div>

        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="check_out_time">ساعت خروج</label>
            <input type="time" class="form-control" id="check_out_time" name="check_out_time">
        </div>


        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
            <label for="fully_furnished">مبله است</label>
            <select class="form-control" id="fully_furnished" name="fully_furnished">
            <option value="">انتخاب کنید</option>
            <option value="yes">بله</option>
            <option value="no">خیر</option>
            </select>
        </div>

        <hr/>


        <div class="col-sm-12 pb-3 pe-3 pt-3 ps-3">
            <label class="form-label d-block fw-bold mb-2 pb-1">امکانات رفاهی</label>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="wifi" name="amenities[]" value="wifi">
                        <label class="form-check-label" for="wifi">وای فای</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="air-condition" name="amenities[]" value="air_condition">
                        <label class="form-check-label" for="air-condition">تهویه هوا</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="balcony" name="amenities[]" value="balcony">
                        <label class="form-check-label" for="balcony">بالکن</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="garage" name="amenities[]" value="garage">
                        <label class="form-check-label" for="garage">گاراژ</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gym" name="amenities[]" value="gym">
                        <label class="form-check-label" for="gym">باشگاه بدنسازی</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="free-parking" name="amenities[]" value="free_parking">
                        <label class="form-check-label" for="free-parking">پارکینگ رایگان</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pets-friendly" name="amenities[]" value="pets_friendly">
                        <label class="form-check-label" for="pets-friendly">نگهداری حیوانات خانگی</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pool" name="amenities[]" value="pool">
                        <label class="form-check-label" for="pool">استخر</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="metro" name="amenities[]" value="metro_access">
                        <label class="form-check-label" for="metro">دسترسی به مترو</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="tv" name="amenities[]" value="tv">
                        <label class="form-check-label" for="tv">تلویزیون</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terrace" name="amenities[]" value="terrace">
                        <label class="form-check-label" for="terrace">تراس</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="heating" name="amenities[]" value="heating">
                        <label class="form-check-label" for="heating">سیستم گرمایشی</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="washer" name="amenities[]" value="washer">
                        <label class="form-check-label" for="washer">ماشین لباسشویی</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="stove" name="amenities[]" value="stove">
                        <label class="form-check-label" for="stove">گاز رومیزی</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="elevator" name="amenities[]" value="elevator">
                        <label class="form-check-label" for="elevator">آسانسور</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="kitchen" name="amenities[]" value="kitchen">
                        <label class="form-check-label" for="kitchen">آشپزخانه</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="breakfast" name="amenities[]" value="breakfast">
                        <label class="form-check-label" for="breakfast">صبحانه</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="security-cameras" name="amenities[]" value="security_cameras">
                        <label class="form-check-label" for="security-cameras">دوربین مداربسته</label>
                    </div>
                </div>
            </div>
        </div>

    </div>