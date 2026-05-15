<div class="pb-4 mb-2">
    <h3 class="h6">موقعیت مکانی</h3>
     <select class="form-select mb-2" id="city" required name="city">
                <option value="" disabled selected>انتخاب شهر</option>
                @foreach($cities as $city)
                <option value="{{ $city->name }}" data-city-name="{{ $city->name }}">
                  {{ $city->name }}
                </option>
                @endforeach
              </select>

              <select class="form-select mb-2" id="neighborhood" required name="neighborhood">
                <option value="" disabled selected>ابتدا شهر را انتخاب کنید</option>
              </select>
          

</div>

<div class="pb-4 mb-2">
    <h3 class="h6">نوع ملک</h3>
    <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false" data-simplebar-direction="rtl" style="height: 11rem;">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="category[]" value="apartment" id="apartment" {{ in_array('apartment', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="apartment">آپارتمان</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="category[]" value="villa" id="villa" {{ in_array('villa', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="villa">ویلا</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="category[]" value="commercial" id="commercial" {{ in_array('commercial', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="commercial">تجاری</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="category[]" value="land" id="land" {{ in_array('land', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="land">زمین</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="category[]" value="pre-sale" id="pre-sale" {{ in_array('pre-sale', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="pre-sale">پیش فروش</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="category[]" value="daily" id="daily" {{ in_array('daily', (array)request('category')) ? 'checked' : '' }}>
            <label class="form-check-label fs-sm" for="daily">ویلا روزانه</label>
        </div>
    </div>
</div>

<div class="pb-4 mb-2">
    <h3 class="h6">قیمت {{ request('type') === 'rent' ? 'اجاره' : 'خرید' }}</h3>
    <div class="range-slider" data-min="0" data-max="50000000" data-step="100000">
        <div class="range-slider-ui"></div>
        <div class="d-flex align-items-center mt-3">
            <div class="w-50 pe-2">
                <div class="input-group flex-row-reverse">
                    <span class="input-group-text">ت</span>
                    <input type="text" class="form-control range-slider-value-min" name="price_min" value="{{ request('price_min') }}">
                </div>
            </div>
            <div class="text-muted">—</div>
            <div class="w-50 ps-2">
                <div class="input-group flex-row-reverse">
                    <span class="input-group-text">ت</span>
                    <input type="text" class="form-control range-slider-value-max" name="price_max" value="{{ request('price_max') }}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pb-4 mb-2">
    <h3 class="h6 pt-1">متراژ (مترمربع)</h3>
    <div class="d-flex align-items-center">
        <input type="number" name="area_min" class="form-control" placeholder="حداقل" value="{{ request('area_min') }}">
        <div class="mx-2">—</div>
        <input type="number" name="area_max" class="form-control" placeholder="حداکثر" value="{{ request('area_max') }}">
    </div>
</div>

<div class="border-top py-4">
    <button type="button" class="btn btn-outline-primary w-100" id="reset-filters">
        <i class="fi-rotate-right me-2"></i>حذف همه فیلترها
    </button>
</div>





<script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // وقتی شهر تغییر می‌کند
    $('#city').on('change', function() {
        var cityId = $(this).val();
        var cityName = $(this).find('option:selected').data('city-name');
        var neighborhoodSelect = $('#neighborhood');
        
        // غیرفعال کردن سلکت محله تا زمان بارگذاری
        neighborhoodSelect.prop('disabled', true);
        neighborhoodSelect.html('<option value="" disabled selected>در حال بارگذاری...</option>');
        
        // اگر شهری انتخاب شده
        if (cityId) {
            // ارسال درخواست AJAX
            $.ajax({
                url: '{{ route("get.neighborhoods") }}',
                type: 'GET',
                data: {
                    city_id: cityId,
                    city_name: cityName
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.neighborhoods.length > 0) {
                        // پر کردن سلکت محله
                        var options = '<option value="" disabled selected>انتخاب محله</option>';
                        $.each(response.neighborhoods, function(key, neighborhood) {
                            options += '<option value="' + neighborhood.id + '">' + neighborhood.name + '</option>';
                        });
                        neighborhoodSelect.html(options);
                        neighborhoodSelect.prop('disabled', false);
                    } else {
                        // اگر محله‌ای وجود نداشت
                        neighborhoodSelect.html('<option value="" disabled selected>هیچ محله‌ای یافت نشد</option>');
                        neighborhoodSelect.prop('disabled', true);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('خطا در دریافت محله‌ها:', error);
                    neighborhoodSelect.html('<option value="" disabled selected>خطا در بارگذاری</option>');
                    neighborhoodSelect.prop('disabled', true);
                }
            });
        } else {
            // اگر شهری انتخاب نشده
            neighborhoodSelect.html('<option value="" disabled selected>ابتدا شهر را انتخاب کنید</option>');
            neighborhoodSelect.prop('disabled', true);
        }
    });
});
</script>
