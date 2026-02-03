      @csrf
      <div class="row">



          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="land-area">متراژ زمین <span class="text-danger">*</span></label>
              <input class="form-control" type="number" id="land-area" placeholder="متراژ زمین" required>
          </div>
          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="building-area">متراژ بنا <span class="text-danger">*</span></label>
              <input class="form-control" type="number" id="building-area" placeholder="متراژ بنا" required>
          </div>

          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="ap-year-built">سال ساخت بنا <span class="text-danger">*</span></label>
              <input class="form-control" type="number" id="ap-year-built" placeholder="سال ساخت" required>
          </div>



          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="floor-count">تعداد طبقات بنا <span class="text-danger">*</span></label>
              <input class="form-control" type="number" id="floor-count" name="floor_count" placeholder="تعداد طبقات" min="1" required>
          </div>



          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="price">قیمت ملک (تومان) <span class="text-danger">*</span></label>
              <input class="form-control price-input" inputmode="numeric" type="text" id="price" name="price" placeholder="قیمت" required>
          </div>



          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="building-type">نوع بنا <span class="text-danger">*</span></label>
              <select class="form-control" id="building-type" name="building_type" required>
                  <option disabled value="">انتخاب کنید</option>
                  <option value="ویلایی مستقل">ویلایی مستقل</option>
                  <option value="دوبلکس">دوبلکس</option>
                  <option value="تریبلکس">تریبلکس</option>
                  <option value="شهرکی">شهرکی</option>
                  <option value="آپارتمانی">آپارتمانی</option>
              </select>
          </div>


          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="ap-parking">پارکینگ <span class="text-danger">*</span></label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="پارکینگ">
                  <input class="btn-check" type="radio" id="parking-yes" name="parking"  value="دارد" required>
                  <label class="btn btn-outline-secondary fw-normal" for="parking-yes">دارد</label>
                  <input class="btn-check" type="radio" id="parking-no" name="parking"  value="ندارد" required>
                  <label class="btn btn-outline-secondary fw-normal" for="parking-no">ندارد</label>
              </div>
          </div>
          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="ap-storage">انباری <span class="text-danger">*</span></label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="انباری">
                  <input class="btn-check" type="radio" id="storage-yes" name="storage"  value="دارد" required>
                  <label class="btn btn-outline-secondary fw-normal" for="storage-yes">دارد</label>
                  <input class="btn-check" type="radio" id="storage-no" name="storage"  value="ندارد" required>
                  <label class="btn btn-outline-secondary fw-normal" for="storage-no">ندارد</label>
              </div>
          </div>
          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="ap-balcony">بالکن</label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="بالکن">
                  <input class="btn-check" type="radio" id="balcony-yes" name="balcony"  value="دارد" required>
                  <label class="btn btn-outline-secondary fw-normal" for="balcony-yes">دارد</label>
                  <input class="btn-check" type="radio" id="balcony-no" name="balcony"  value="ندارد" required>
                  <label class="btn btn-outline-secondary fw-normal" for="balcony-no">ندارد</label>
              </div>
          </div>
          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label class="form-label" for="ap-rooms">تعداد اتاق</label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="تعداد اتاق">
                  <input class="btn-check" type="radio" id="rooms-1" name="rooms" value="1" required>
                  <label class="btn btn-outline-secondary fw-normal" for="rooms-1">1</label>
                  <input class="btn-check" type="radio" id="rooms-2" name="rooms" value="2" required>
                  <label class="btn btn-outline-secondary fw-normal" for="rooms-2">2</label>
                  <input class="btn-check" type="radio" id="rooms-3" name="rooms" value="3" required>
                  <label class="btn btn-outline-secondary fw-normal" for="rooms-3">3</label>
                  <input class="btn-check" type="radio" id="rooms-4" name="rooms" value="4" required>
                  <label class="btn btn-outline-secondary fw-normal" for="rooms-4">4</label>
                  <input class="btn-check" type="radio" id="rooms-5" name="rooms" value="5" required>
                  <label class="btn btn-outline-secondary fw-normal" for="rooms-5">5+</label>
              </div>
          </div>









          <hr />



          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="building-direction">جهت ساختمان <span class="text-danger">*</span></label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="جهت ساختمان">
                  <input class="btn-check" type="radio" id="building-direction-north" name="building_direction" value="شمال" required>
                  <label class="btn btn-outline-secondary fw-normal" for="building-direction-north">شمال</label>
                  <input class="btn-check" type="radio" id="building-direction-south" name="building_direction" value="جنوب" required>
                  <label class="btn btn-outline-secondary fw-normal" for="building-direction-south">جنوب</label>
                  <input class="btn-check" type="radio" id="building-direction-east" name="building_direction" value="شرق" required>
                  <label class="btn btn-outline-secondary fw-normal" for="building-direction-east">شرق</label>
                  <input class="btn-check" type="radio" id="building-direction-west" name="building_direction" value="غرب" required>
                  <label class="btn btn-outline-secondary fw-normal" for="building-direction-west">غرب</label>
              </div>
          </div>
          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="floor-type">جنس کف <span class="text-danger">*</span></label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="جنس کف">
                  <input class="btn-check" type="radio" id="floor-type-ceramic" name="floor_type" value="سرامیک" required>
                  <label class="btn btn-outline-secondary fw-normal" for="floor-type-ceramic">سرامیک</label>
                  <input class="btn-check" type="radio" id="floor-type-parquet" name="floor_type" value="پارکت" required>
                  <label class="btn btn-outline-secondary fw-normal" for="floor-type-parquet">پارکت</label>
                  <input class="btn-check" type="radio" id="floor-type-stone" name="floor_type" value="سنگ" required>
                  <label class="btn btn-outline-secondary fw-normal" for="floor-type-stone">سنگ</label>
                  <input class="btn-check" type="radio" id="floor-type-marble" name="floor_type" value="مرمر" required>
                  <label class="btn btn-outline-secondary fw-normal" for="floor-type-marble">مرمر</label>
              </div>
          </div>
          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="toilet-count">سرویس بهداشتی <span class="text-danger">*</span></label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="تعداد سرویس بهداشتی">
                  <input class="btn-check" type="radio" id="toilet-1" name="toilet" value="1" required>
                  <label class="btn btn-outline-secondary fw-normal" for="toilet-1">1</label>
                  <input class="btn-check" type="radio" id="toilet-2" name="toilet" value="2" required>
                  <label class="btn btn-outline-secondary fw-normal" for="toilet-2">2</label>
                  <input class="btn-check" type="radio" id="toilet-3" name="toilet" value="3" required>
                  <label class="btn btn-outline-secondary fw-normal" for="toilet-3">3</label>
                  <input class="btn-check" type="radio" id="toilet-5" name="toilet" value="5" required>
              </div>
          </div>
          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="cooling-system">سرمایش <span class="text-danger">*</span></label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="سرمایش">
                  <input class="btn-check" type="radio" id="cooling-ac" name="cooling_system" value="کولر گازی" required>
                  <label class="btn btn-outline-secondary fw-normal" for="cooling-ac">کولر گازی</label>
                  <input class="btn-check" type="radio" id="cooling-split" name="cooling_system" value="اسپلیت" required>
                  <label class="btn btn-outline-secondary fw-normal" for="cooling-split">اسپلیت</label>
                  <input class="btn-check" type="radio" id="cooling-central" name="cooling_system" value="مرکزی" required>
                  <label class="btn btn-outline-secondary fw-normal" for="cooling-central">مرکزی</label>
              </div>
          </div>


          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="document-type">سند <span class="text-danger">*</span></label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="سند">
                  <input class="btn-check" type="radio" id="document-single-page" name="document_type" value="تک‌برگ" required>
                  <label class="btn btn-outline-secondary fw-normal" for="document-single-page">تک‌برگ</label>
                  <input class="btn-check" type="radio" id="document-tasseled" name="document_type" value="منگوله‌دار" required>
                  <label class="btn btn-outline-secondary fw-normal" for="document-tasseled">منگوله‌دار</label>
                  <input class="btn-check" type="radio" id="document-promissory" name="document_type" value="قول‌نامه‌ای" required>
                  <label class="btn btn-outline-secondary fw-normal" for="document-promissory">قول‌نامه‌ای</label>
                  <input class="btn-check" type="radio" id="document-other" name="document_type" value="سایر" required>
                  <label class="btn btn-outline-secondary fw-normal" for="document-other">سایر</label>
              </div>
          </div>




          <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
              <label for="pool-type">نوع استخر <span class="text-danger">*</span></label></br />
              <div class="btn-group btn-group-sm" role="group" aria-label="نوع استخر">
                  <input class="btn-check" type="radio" id="pool-none" name="pool_type" value="ندارد" required>
                  <label class="btn btn-outline-secondary fw-normal" for="pool-none">ندارد</label>
                  <input class="btn-check" type="radio" id="pool-open" name="pool_type" value="روباز" required>
                  <label class="btn btn-outline-secondary fw-normal" for="pool-open">روباز</label>
                  <input class="btn-check" type="radio" id="pool-covered" name="pool_type" value="سرپوشیده" required>
                  <label class="btn btn-outline-secondary fw-normal" for="pool-covered">سرپوشیده</label>
              </div>
          </div>

      </div>