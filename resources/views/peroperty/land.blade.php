        @csrf
        <div class="row">

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="area">متراژ:</label>
                <input class="form-control" type="text" id="area" name="area" required>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="usage_type">نوع کاربری:</label>
                <select class="form-control" id="usage_type" name="usage_type" required>
                    <option value="">انتخاب</option>
                    <option value="Residential">مسکونی</option>
                    <option value="Commercial">تجاری</option>
                    <option value="Administrative">اداری</option>
                    <option value="Agricultural">کشاورزی</option>
                    <option value="Industrial">صنعتی</option>
                    <option value="Garden">باغ</option>
                    <option value="Educational">آموزشی</option>
                    <option value="Medical">درمانی</option>
                    <option value="Mixed">مختلط</option>
                    <option value="No Usage">فاقد کاربری</option>
                    <option value="Religious">مذهبی</option>
                    <option value="Sports">ورزشی</option>
                    <option value="Cultural">فرهنگی</option>
                    <option value="Transportation">حمل و نقل</option>
                    <option value="Green Space">فضای سبز</option>
                    <option value="Service">خدماتی</option>
                    <option value="Mining">معدنی</option>
                    <option value="Parking">پارکینگ</option>
                    <option value="Recreation and Tourism">تفریحی و توریستی</option>
                    <option value="Buffer Zone">حریم</option>
                    <option value="Other">سایر</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="price">قیمت (تومان):</label>
                <input class="form-control price-input" inputmode="numeric" type="text" id="price" name="price" required>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="document_status">وضعیت سند:</label>
                <select class="form-control" id="document_status" name="document_status" required>
                    <option value="">انتخاب</option>
                    <option value="Single Page Document">سند تک‌برگ</option>
                    <option value="Bound Document">سند منگوله‌دار</option>
                    <option value="Promise">قولنامه</option>
                    <option value="Waqf">اوقافی</option>
                    <option value="Undivided Share">مشاع</option>
                    <option value="In Progress">در دست اقدام</option>
                    <option value="Ready for Transfer">آماده انتقال</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="property_location">موقعیت ملک:</label>
                <select class="form-control" id="property_location" name="property_location" required>
                    <option value="">انتخاب</option>
                    <option value="Double Frontage">Double Frontage</option>
                    <option value="Corner Lot">Corner Lot</option>
                    <option value="Triple Frontage">Triple Frontage</option>
                </select>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="building_permit">مجوز ساخت:</label>
                <select class="form-control" id="building_permit" name="building_permit" required>
                    <option value="">انتخاب</option>
                    <option value="Building Permit">پروانه ساختمانی</option>
                    <option value="Demolition and Reconstruction">پروانه تخریب و بازسازی</option>
                    <option value="Additional Basement">پروانه اضافه اشکوب</option>
                    <option value="Conversion">پروانه تبدیل</option>
                    <option value="Modification Changes">پروانه تغییرات تعمیرات</option>
                    <option value="Extension">پروانه تمدید</option>
                    <option value="Plan Change">پروانه تغییر نقشه</option>
                    <option value="Cancellation">پروانه ابطال</option>
                    <option value="Engineer Change">پروانه تعویض مهندس ناظر یا مجری</option>
                </select>
            </div>


         

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="has_old_building">دارای بنای کلنگی:</label>
                <div>
                    <label class="form-check">
                        <input type="checkbox" name="has_old_building" value="1" class="form-check-input">
                        بله
                    </label>
                </div>
            </div>

            <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="exchangeable">قابل معاوضه:</label>
                <div>
                    <label class="form-check">
                        <input type="checkbox" name="exchangeable" value="1" class="form-check-input">
                        بله
                    </label>
                </div>
            </div>

               <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                <label for="utilities">انشعابات *</label>
                <div>
                    <label class="form-check">
                        <input type="checkbox" name="utilities[]" value="water" class="form-check-input">
                        آب
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="utilities[]" value="electricity" class="form-check-input">
                        برق
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="utilities[]" value="gas" class="form-check-input">
                        گاز
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="utilities[]" value="phone" class="form-check-input">
                        تلفن
                    </label>
                </div>
            </div>
        </div>