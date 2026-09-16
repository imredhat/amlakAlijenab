<div class="pb-4 mb-2">
    <h3 class="h6">موقعیت مکانی</h3>
     <select class="form-select mb-2 filter-auto" id="city" required name="city">
                <option value="" selected>همه شهرها</option>
                @foreach($cities as $city)
                <option value="{{ $city->name }}" {{ request('city') === $city->name ? 'selected' : '' }}>
                  {{ $city->name }}
                </option>
                @endforeach
              </select>

              <select class="form-select mb-2 filter-auto" id="neighborhood" required name="neighborhood">
                <option value="" selected>انتخاب محله</option>
              </select>

</div>

<div class="pb-4 mb-2">
    <h3 class="h6">نوع ملک</h3>
    <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false" data-simplebar-direction="rtl" style="height: 11rem;">
        <div class="form-check">
            <input class="form-check-input filter-auto" type="checkbox" name="category[]" value="apartment" id="apartment" {{ in_array('apartment', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="apartment">آپارتمان</label>
        </div>
        <div class="form-check">
            <input class="form-check-input filter-auto" type="checkbox" name="category[]" value="villa" id="villa" {{ in_array('villa', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="villa">ویلا</label>
        </div>
        <div class="form-check">
            <input class="form-check-input filter-auto" type="checkbox" name="category[]" value="commercial" id="commercial" {{ in_array('commercial', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="commercial">تجاری</label>
        </div>
        <div class="form-check">
            <input class="form-check-input filter-auto" type="checkbox" name="category[]" value="land" id="land" {{ in_array('land', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="land">زمین</label>
        </div>
        <div class="form-check">
            <input class="form-check-input filter-auto" type="checkbox" name="category[]" value="pre-sale" id="pre-sale" {{ in_array('pre-sale', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="pre-sale">پیش فروش</label>
        </div>
        <div class="form-check">
            <input class="form-check-input filter-auto" type="checkbox" name="category[]" value="daily" id="daily" {{ in_array('daily', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="daily">ویلا روزانه</label>
        </div>
    </div>
</div>

<div class="pb-4 mb-2">
    <h3 class="h6">قیمت {{ request('type') === 'rent' ? 'اجاره' : 'خرید' }}</h3>
    <div class="d-flex align-items-center">
        <div class="w-50 pe-2">
            <div class="input-group flex-row-reverse">
                <span class="input-group-text">ت</span>
                <input type="text" class="form-control price-input filter-auto" name="price_min" id="price_min" placeholder="حداقل" value="{{ request('price_min') }}">
            </div>
        </div>
        <div class="text-muted">—</div>
        <div class="w-50 ps-2">
            <div class="input-group flex-row-reverse">
                <span class="input-group-text">ت</span>
                <input type="text" class="form-control price-input filter-auto" name="price_max" id="price_max" placeholder="حداکثر" value="{{ request('price_max') }}">
            </div>
        </div>
    </div>
</div>

<div class="pb-4 mb-2">
    <h3 class="h6 pt-1">متراژ (مترمربع)</h3>
    <div class="d-flex align-items-center">
        <input type="number" name="area_min" id="area_min" class="form-control filter-auto" placeholder="حداقل" value="{{ request('area_min') }}">
        <div class="mx-2">—</div>
        <input type="number" name="area_max" id="area_max" class="form-control filter-auto" placeholder="حداکثر" value="{{ request('area_max') }}">
    </div>
</div>

<div class="border-top py-4">
    <button type="button" class="btn btn-outline-primary w-100" id="reset-filters">
        <i class="fi-rotate-right me-2"></i>حذف همه فیلترها
    </button>
</div>
