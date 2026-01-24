@csrf
<div class="row">


    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="propertyCondition">وضعیت فعلی ملک*</label>
        <select class="form-control" id="propertyCondition" name="propertyCondition" required>
            <option disabled value="">انتخاب کنید</option>
            <option value="ساختمان قدیمی">ساختمان قدیمی</option>
            <option value="زمین خالی">زمین خالی</option>
            <option value="در حال ساخت">در حال ساخت</option>
            <option value="ساختمان نوساز">ساختمان نوساز</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ*</label>
        <input type="number" class="form-control" id="area" name="area" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="projectType">نوع پروژه*</label>
        <select class="form-control" id="projectType" name="projectType" required>
            <option disabled value="">انتخاب کنید</option>
            <option value="پیش‌ فروش">پیش‌ فروش</option>
            <option value="مشارکت در ساخت">مشارکت در ساخت</option>
        </select>
    </div>


    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="propertyLocation">موقعیت ملک*</label>
        <select class="form-control" id="propertyLocation" name="propertyLocation" required>
            <option disabled value="">انتخاب</option>
            <option value="دو نبش">دو نبش</option>
            <option value="سه نبش">سه نبش</option>
            <option value="بر خیابان اصلی">بر خیابان اصلی</option>
            <option value="بر خیابان فرعی">بر خیابان فرعی</option>
            <option value="ته پلاک">ته پلاک</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="roomCount">تعداد اتاق*</label>
        <input type="number" class="form-control" id="roomCount" name="roomCount" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="documentStatus">وضعیت سند*</label>
        <select class="form-control" id="documentStatus" name="documentStatus" required>
            <option disabled value="">انتخاب</option>
            <option value="سند تک‌برگ">سند تک‌برگ</option>
            <option value="سند منگوله‌دار">سند منگوله‌دار</option>
            <option value="قولنامه">قولنامه</option>
            <option value="اوقافی">اوقافی</option>
            <option value="مشاع">مشاع</option>
            <option value="در دست اقدام">در دست اقدام</option>
            <option value="آماده انتقال">آماده انتقال</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="participationPercent">درصد مشارکت</label>
        <input type="number" class="form-control" id="participationPercent" name="participationPercent" min="0" max="100" step="0.01">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="totalFloors">تعداد کل طبقات*</label>
        <input type="number" class="form-control" id="totalFloors" name="totalFloors" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="pricePerSqMeter">قیمت پایه هر متر مربع (تومان)*</label>
        <input type="text" inputmode="numeric" class="form-control price-input" id="price" name="price" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="initialPayment">پیش پرداخت اولیه (درصد)*</label>
        <input type="number" class="form-control" id="initialPayment" name="initialPayment" min="0" max="100" step="0.01" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="deliveryPayment">پرداخت موقع تحویل (درصد)*</label>
        <input type="number" class="form-control" id="deliveryPayment" name="deliveryPayment" min="0" max="100" step="0.01" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="projectStatus">وضعیت فعلی پروژه*</label>
        <select class="form-control" id="projectStatus" name="projectStatus" required>
            <option value="">انتخاب</option>
            <option value="اخذ مجوز و آماده‌سازی زمین">اخذ مجوز و آماده‌سازی زمین</option>
            <option value="گودبرداری">گودبرداری</option>
            <option value="فونداسیون">فونداسیون</option>
            <option value="اسکلت">اسکلت</option>
            <option value="سقف‌ها">سقف‌ها</option>
            <option value="دیوارچینی">دیوارچینی</option>
            <option value="تأسیسات مکانیکی و برقی زیرکار">تأسیسات مکانیکی و برقی زیرکار</option>
            <option value="گچ‌کاری و نازک‌کاری داخلی">گچ‌کاری و نازک‌کاری داخلی</option>
            <option value="نما">نما</option>
            <option value="کاشی‌کاری و کف‌سازی">کاشی‌کاری و کف‌سازی</option>
            <option value="نقاشی و تزئینات داخلی">نقاشی و تزئینات داخلی</option>
            <option value="نصب در و پنجره">نصب در و پنجره</option>
            <option value="نصب تجهیزات نهایی تأسیسات">نصب تجهیزات نهایی تأسیسات</option>
            <option value="محوطه‌سازی و تکمیل فضای بیرونی">محوطه‌سازی و تکمیل فضای بیرونی</option>
            <option value="اخذ پایان کار">اخذ پایان کار</option>
            <option value="تحویل نهایی پروژه">تحویل نهایی پروژه</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="deliveryYear">سال تحویل*</label>
        <select class="form-control" id="deliveryYear" name="deliveryYear" required>
            <option value="">انتخاب</option>
            <option value="1420">1420</option>
            <option value="1419">1419</option>
            <option value="1418">1418</option>
            <option value="1417">1417</option>
            <option value="1416">1416</option>
            <option value="1415">1415</option>
            <option value="1414">1414</option>
            <option value="1413">1413</option>
            <option value="1412">1412</option>
            <option value="1411">1411</option>
            <option value="1410">1410</option>
            <option value="1409">1409</option>
            <option value="1408">1408</option>
            <option value="1407">1407</option>
            <option value="1406">1406</option>
            <option value="1405">1405</option>
            <option value="1404">1404</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="deliveryMonth">ماه تحویل*</label>
        <select class="form-control" id="deliveryMonth" name="deliveryMonth" required>
            <option value="">انتخاب</option>
            <option value="فروردین">فروردین</option>
            <option value="اردیبهشت">اردیبهشت</option>
            <option value="خرداد">خرداد</option>
            <option value="تیر">تیر</option>
            <option value="مرداد">مرداد</option>
            <option value="شهریور">شهریور</option>
            <option value="مهر">مهر</option>
            <option value="آبان">آبان</option>
            <option value="آذر">آذر</option>
            <option value="دی">دی</option>
            <option value="بهمن">بهمن</option>
            <option value="اسفند">اسفند</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="physicalProgress">درصد پیشرفت فیزیکی پروژه*</label>
        <input type="number" class="form-control" id="physicalProgress" name="physicalProgress" min="0" max="100" step="0.01" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="unitsPerFloor">تعداد واحد در طبقه*</label>
        <input type="number" class="form-control" id="unitsPerFloor" name="unitsPerFloor" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="minUnitArea">حداقل متراژ واحدها (متر مربع)*</label>
        <input type="number" class="form-control" id="minUnitArea" name="minUnitArea" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="builderName">نام سازنده/شرکت*</label>
        <input type="text" class="form-control" id="builderName" name="builderName" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="constructionPermit">شماره جواز ساخت*</label>
        <input type="text" class="form-control" id="constructionPermit" name="constructionPermit" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="exchange">امکان معاوضه</label>
        <input type="checkbox" id="exchange" name="exchange" class="form-check-input">
    </div>
</div>