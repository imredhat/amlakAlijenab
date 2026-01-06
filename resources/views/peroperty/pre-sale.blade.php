@csrf
<div class="row">

    
    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="propertyCondition">وضعیت فعلی ملک*</label>
        <select class="form-control" id="propertyCondition" name="propertyCondition" required>
            <option value="">انتخاب کنید</option>
            <option value="Old-Building">ساختمان قدیمی</option>
            <option value="Empty-Land">زمین خالی</option>
            <option value="Under-Construction">در حال ساخت</option>
            <option value="New-Building">ساختمان نوساز</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ*</label>
        <input type="number" class="form-control" id="area" name="area" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="projectType">نوع پروژه*</label>
        <select class="form-control" id="projectType" name="projectType" required>
            <option value="">انتخاب کنید</option>
            <option value="Pre-Sale">پیش‌ فروش</option>
            <option value="Construction-Participation">مشارکت در ساخت</option>
        </select>
    </div>


    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="propertyLocation">موقعیت ملک*</label>
        <select class="form-control" id="propertyLocation" name="propertyLocation" required>
            <option value="">انتخاب</option>
            <option value="Two-Corners">دو نبش</option>
            <option value="Three-Corners">سه نبش</option>
            <option value="Main-Street">بر خیابان اصلی</option>
            <option value="Side-Street">بر خیابان فرعی</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="roomCount">تعداد اتاق*</label>
        <input type="number" class="form-control" id="roomCount" name="roomCount" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="documentStatus">وضعیت سند*</label>
        <select class="form-control" id="documentStatus" name="documentStatus" required>
            <option value="">انتخاب</option>
            <option value="Single-Page">سند تک‌برگ</option>
            <option value="Attached">سند منگوله‌دار</option>
            <option value="Promise-Contract">قولنامه</option>
            <option value="Endowment">اوقافی</option>
            <option value="In-Process">در دست اقدام</option>
            <option value="Ready-Transfer">آماده انتقال</option>
            <option value="None">ندارد</option>
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
            <option value="Land-Preparation">اخذ مجوز و آماده‌سازی زمین</option>
            <option value="Excavation">گودبرداری</option>
            <option value="Foundation">فونداسیون</option>
            <option value="Structure">اسکلت</option>
            <option value="Roof">سقف‌ها</option>
            <option value="Masonry">دیوارچینی</option>
            <option value="MEP-Rough">تأسیسات مکانیکی و برقی زیرکار</option>
            <option value="Plastering">گچ‌کاری و نازک‌کاری داخلی</option>
            <option value="Facade">نما</option>
            <option value="Flooring">کاشی‌کاری و کف‌سازی</option>
            <option value="Painting">نقاشی و تزئینات داخلی</option>
            <option value="Doors-Windows">نصب در و پنجره</option>
            <option value="MEP-Final">نصب تجهیزات نهایی تأسیسات</option>
            <option value="Landscaping">محوطه‌سازی و تکمیل فضای بیرونی</option>
            <option value="Final-Permit">اخذ پایان کار</option>
            <option value="Handover">تحویل نهایی پروژه</option>
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
            <option value="Farvardin">فروردین</option>
            <option value="Ordibehesht">اردیبهشت</option>
            <option value="Khordad">خرداد</option>
            <option value="Tir">تیر</option>
            <option value="Mordad">مرداد</option>
            <option value="Shahrivar">شهریور</option>
            <option value="Mehr">مهر</option>
            <option value="Aban">آبان</option>
            <option value="Azar">آذر</option>
            <option value="Dey">دی</option>
            <option value="Bahman">بهمن</option>
            <option value="Esfand">اسفند</option>
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
        <input type="checkbox" id="exchange" name="exchange"  class="form-check-input">
    </div>
</div>