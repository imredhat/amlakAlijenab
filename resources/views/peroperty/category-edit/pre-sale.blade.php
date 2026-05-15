@csrf
<div class="row">

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="propertyCondition">وضعیت فعلی ملک*</label>
        <select class="form-control" id="propertyCondition" name="propertyCondition" required>
            <option disabled value="">انتخاب کنید</option>
            <option value="ساختمان قدیمی" {{ (old('propertyCondition', $property->propertyCondition ?? '') == 'ساختمان قدیمی') ? 'selected' : '' }}>ساختمان قدیمی</option>
            <option value="زمین خالی" {{ (old('propertyCondition', $property->propertyCondition ?? '') == 'زمین خالی') ? 'selected' : '' }}>زمین خالی</option>
            <option value="در حال ساخت" {{ (old('propertyCondition', $property->propertyCondition ?? '') == 'در حال ساخت') ? 'selected' : '' }}>در حال ساخت</option>
            <option value="ساختمان نوساز" {{ (old('propertyCondition', $property->propertyCondition ?? '') == 'ساختمان نوساز') ? 'selected' : '' }}>ساختمان نوساز</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="area">متراژ*</label>
        <input type="number" class="form-control" id="area" name="area" value="{{ old('area', $property->area ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="projectType">نوع پروژه*</label>
        <select class="form-control" id="projectType" name="projectType" required>
            <option disabled value="">انتخاب کنید</option>
            <option value="پیش‌ فروش" {{ (old('projectType', $property->projectType ?? '') == 'پیش‌ فروش') ? 'selected' : '' }}>پیش‌ فروش</option>
            <option value="مشارکت در ساخت" {{ (old('projectType', $property->projectType ?? '') == 'مشارکت در ساخت') ? 'selected' : '' }}>مشارکت در ساخت</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="propertyLocation">موقعیت ملک*</label>
        <select class="form-control" id="propertyLocation" name="propertyLocation" required>
            <option disabled value="">انتخاب</option>
            <option value="دو نبش" {{ (old('propertyLocation', $property->propertyLocation ?? '') == 'دو نبش') ? 'selected' : '' }}>دو نبش</option>
            <option value="سه نبش" {{ (old('propertyLocation', $property->propertyLocation ?? '') == 'سه نبش') ? 'selected' : '' }}>سه نبش</option>
            <option value="بر خیابان اصلی" {{ (old('propertyLocation', $property->propertyLocation ?? '') == 'بر خیابان اصلی') ? 'selected' : '' }}>بر خیابان اصلی</option>
            <option value="بر خیابان فرعی" {{ (old('propertyLocation', $property->propertyLocation ?? '') == 'بر خیابان فرعی') ? 'selected' : '' }}>بر خیابان فرعی</option>
            <option value="ته پلاک" {{ (old('propertyLocation', $property->propertyLocation ?? '') == 'ته پلاک') ? 'selected' : '' }}>ته پلاک</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="roomCount">تعداد اتاق*</label>
        <input type="number" class="form-control" id="roomCount" name="roomCount" value="{{ old('roomCount', $property->roomCount ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="documentStatus">وضعیت سند*</label>
        <select class="form-control" id="documentStatus" name="documentStatus" required>
            <option disabled value="">انتخاب</option>
            <option value="سند تک‌برگ" {{ (old('documentStatus', $property->documentStatus ?? '') == 'سند تک‌برگ') ? 'selected' : '' }}>سند تک‌برگ</option>
            <option value="سند منگوله‌دار" {{ (old('documentStatus', $property->documentStatus ?? '') == 'سند منگوله‌دار') ? 'selected' : '' }}>سند منگوله‌دار</option>
            <option value="قولنامه" {{ (old('documentStatus', $property->documentStatus ?? '') == 'قولنامه') ? 'selected' : '' }}>قولنامه</option>
            <option value="اوقافی" {{ (old('documentStatus', $property->documentStatus ?? '') == 'اوقافی') ? 'selected' : '' }}>اوقافی</option>
            <option value="مشاع" {{ (old('documentStatus', $property->documentStatus ?? '') == 'مشاع') ? 'selected' : '' }}>مشاع</option>
            <option value="در دست اقدام" {{ (old('documentStatus', $property->documentStatus ?? '') == 'در دست اقدام') ? 'selected' : '' }}>در دست اقدام</option>
            <option value="آماده انتقال" {{ (old('documentStatus', $property->documentStatus ?? '') == 'آماده انتقال') ? 'selected' : '' }}>آماده انتقال</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="participationPercent">درصد مشارکت</label>
        <input type="number" class="form-control" id="participationPercent" name="participationPercent" min="0" max="100" step="0.01" value="{{ old('participationPercent', $property->participationPercent ?? '') }}">
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="totalFloors">تعداد کل طبقات*</label>
        <input type="number" class="form-control" id="totalFloors" name="totalFloors" value="{{ old('totalFloors', $property->totalFloors ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="price">قیمت پایه هر متر مربع (تومان)*</label>
        <input type="text" inputmode="numeric" class="form-control price-input" id="price" name="price" value="{{ old('price', number_format($property->price ?? 0)) }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="initialPayment">پیش پرداخت اولیه (درصد)*</label>
        <input type="number" class="form-control" id="initialPayment" name="initialPayment" min="0" max="100" step="0.01" value="{{ old('initialPayment', $property->initialPayment ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="deliveryPayment">پرداخت موقع تحویل (درصد)*</label>
        <input type="number" class="form-control" id="deliveryPayment" name="deliveryPayment" min="0" max="100" step="0.01" value="{{ old('deliveryPayment', $property->deliveryPayment ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="projectStatus">وضعیت فعلی پروژه*</label>
        <select class="form-control" id="projectStatus" name="projectStatus" required>
            <option value="">انتخاب</option>
            <option value="اخذ مجوز و آماده‌سازی زمین" {{ (old('projectStatus', $property->projectStatus ?? '') == 'اخذ مجوز و آماده‌سازی زمین') ? 'selected' : '' }}>اخذ مجوز و آماده‌سازی زمین</option>
            <option value="گودبرداری" {{ (old('projectStatus', $property->projectStatus ?? '') == 'گودبرداری') ? 'selected' : '' }}>گودبرداری</option>
            <option value="فونداسیون" {{ (old('projectStatus', $property->projectStatus ?? '') == 'فونداسیون') ? 'selected' : '' }}>فونداسیون</option>
            <option value="اسکلت" {{ (old('projectStatus', $property->projectStatus ?? '') == 'اسکلت') ? 'selected' : '' }}>اسکلت</option>
            <option value="سقف‌ها" {{ (old('projectStatus', $property->projectStatus ?? '') == 'سقف‌ها') ? 'selected' : '' }}>سقف‌ها</option>
            <option value="دیوارچینی" {{ (old('projectStatus', $property->projectStatus ?? '') == 'دیوارچینی') ? 'selected' : '' }}>دیوارچینی</option>
            <option value="تأسیسات مکانیکی و برقی زیرکار" {{ (old('projectStatus', $property->projectStatus ?? '') == 'تأسیسات مکانیکی و برقی زیرکار') ? 'selected' : '' }}>تأسیسات مکانیکی و برقی زیرکار</option>
            <option value="گچ‌کاری و نازک‌کاری داخلی" {{ (old('projectStatus', $property->projectStatus ?? '') == 'گچ‌کاری و نازک‌کاری داخلی') ? 'selected' : '' }}>گچ‌کاری و نازک‌کاری داخلی</option>
            <option value="نما" {{ (old('projectStatus', $property->projectStatus ?? '') == 'نما') ? 'selected' : '' }}>نما</option>
            <option value="کاشی‌کاری و کف‌سازی" {{ (old('projectStatus', $property->projectStatus ?? '') == 'کاشی‌کاری و کف‌سازی') ? 'selected' : '' }}>کاشی‌کاری و کف‌سازی</option>
            <option value="نقاشی و تزئینات داخلی" {{ (old('projectStatus', $property->projectStatus ?? '') == 'نقاشی و تزئینات داخلی') ? 'selected' : '' }}>نقاشی و تزئینات داخلی</option>
            <option value="نصب در و پنجره" {{ (old('projectStatus', $property->projectStatus ?? '') == 'نصب در و پنجره') ? 'selected' : '' }}>نصب در و پنجره</option>
            <option value="نصب تجهیزات نهایی تأسیسات" {{ (old('projectStatus', $property->projectStatus ?? '') == 'نصب تجهیزات نهایی تأسیسات') ? 'selected' : '' }}>نصب تجهیزات نهایی تأسیسات</option>
            <option value="محوطه‌سازی و تکمیل فضای بیرونی" {{ (old('projectStatus', $property->projectStatus ?? '') == 'محوطه‌سازی و تکمیل فضای بیرونی') ? 'selected' : '' }}>محوطه‌سازی و تکمیل فضای بیرونی</option>
            <option value="اخذ پایان کار" {{ (old('projectStatus', $property->projectStatus ?? '') == 'اخذ پایان کار') ? 'selected' : '' }}>اخذ پایان کار</option>
            <option value="تحویل نهایی پروژه" {{ (old('projectStatus', $property->projectStatus ?? '') == 'تحویل نهایی پروژه') ? 'selected' : '' }}>تحویل نهایی پروژه</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="deliveryYear">سال تحویل*</label>
        <select class="form-control" id="deliveryYear" name="deliveryYear" required>
            <option value="">انتخاب</option>
            <option value="1420" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1420') ? 'selected' : '' }}>1420</option>
            <option value="1419" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1419') ? 'selected' : '' }}>1419</option>
            <option value="1418" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1418') ? 'selected' : '' }}>1418</option>
            <option value="1417" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1417') ? 'selected' : '' }}>1417</option>
            <option value="1416" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1416') ? 'selected' : '' }}>1416</option>
            <option value="1415" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1415') ? 'selected' : '' }}>1415</option>
            <option value="1414" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1414') ? 'selected' : '' }}>1414</option>
            <option value="1413" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1413') ? 'selected' : '' }}>1413</option>
            <option value="1412" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1412') ? 'selected' : '' }}>1412</option>
            <option value="1411" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1411') ? 'selected' : '' }}>1411</option>
            <option value="1410" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1410') ? 'selected' : '' }}>1410</option>
            <option value="1409" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1409') ? 'selected' : '' }}>1409</option>
            <option value="1408" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1408') ? 'selected' : '' }}>1408</option>
            <option value="1407" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1407') ? 'selected' : '' }}>1407</option>
            <option value="1406" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1406') ? 'selected' : '' }}>1406</option>
            <option value="1405" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1405') ? 'selected' : '' }}>1405</option>
            <option value="1404" {{ (old('deliveryYear', $property->deliveryYear ?? '') == '1404') ? 'selected' : '' }}>1404</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="deliveryMonth">ماه تحویل*</label>
        <select class="form-control" id="deliveryMonth" name="deliveryMonth" required>
            <option value="">انتخاب</option>
            <option value="فروردین" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'فروردین') ? 'selected' : '' }}>فروردین</option>
            <option value="اردیبهشت" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'اردیبهشت') ? 'selected' : '' }}>اردیبهشت</option>
            <option value="خرداد" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'خرداد') ? 'selected' : '' }}>خرداد</option>
            <option value="تیر" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'تیر') ? 'selected' : '' }}>تیر</option>
            <option value="مرداد" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'مرداد') ? 'selected' : '' }}>مرداد</option>
            <option value="شهریور" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'شهریور') ? 'selected' : '' }}>شهریور</option>
            <option value="مهر" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'مهر') ? 'selected' : '' }}>مهر</option>
            <option value="آبان" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'آبان') ? 'selected' : '' }}>آبان</option>
            <option value="آذر" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'آذر') ? 'selected' : '' }}>آذر</option>
            <option value="دی" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'دی') ? 'selected' : '' }}>دی</option>
            <option value="بهمن" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'بهمن') ? 'selected' : '' }}>بهمن</option>
            <option value="اسفند" {{ (old('deliveryMonth', $property->deliveryMonth ?? '') == 'اسفند') ? 'selected' : '' }}>اسفند</option>
        </select>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="physicalProgress">درصد پیشرفت فیزیکی پروژه*</label>
        <input type="number" class="form-control" id="physicalProgress" name="physicalProgress" min="0" max="100" step="0.01" value="{{ old('physicalProgress', $property->physicalProgress ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="unitsPerFloor">تعداد واحد در طبقه*</label>
        <input type="number" class="form-control" id="unitsPerFloor" name="unitsPerFloor" value="{{ old('unitsPerFloor', $property->unitsPerFloor ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="minUnitArea">حداقل متراژ واحدها (متر مربع)*</label>
        <input type="number" class="form-control" id="minUnitArea" name="minUnitArea" value="{{ old('minUnitArea', $property->minUnitArea ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="builderName">نام سازنده/شرکت*</label>
        <input type="text" class="form-control" id="builderName" name="builderName" value="{{ old('builderName', $property->builderName ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="constructionPermit">شماره جواز ساخت*</label>
        <input type="text" class="form-control" id="constructionPermit" name="constructionPermit" value="{{ old('constructionPermit', $property->constructionPermit ?? '') }}" required>
    </div>

    <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
        <label for="exchange">امکان معاوضه</label>
        <input type="checkbox" id="exchange" name="exchange" class="form-check-input" value="1" {{ (old('exchange', $property->exchange ?? '') == '1') ? 'checked' : '' }}>
    </div>

</div>