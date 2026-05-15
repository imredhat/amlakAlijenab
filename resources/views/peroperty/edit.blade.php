@include('partials.header')
@include('partials.home.menu')


<?php

function getCat($type)
{
    switch ($type) {
        case 'other':
            return "سایر";
            break;
        case 'pre-sale':
            return "پیش فروش";
            break;
        case 'villa-sale':
            return "خرید و فروش ویلا";
            break;
        case 'apartment-rent':
            return "رهن و اجاره خانه و آپارتمان";
            break;
        case 'apartment-sale':
            return "خرید و فروش خانه و آپارتمان";
            break;
        case 'villa-short-rent':
            return "اجاره کوتاه مدت ویلا، سوئیت";
            break;
        case 'commercial-rent':
            return "رهن و اجاره اداری، تجاری و صنعتی";
            break;
        case 'commercial-sale':
            return "خرید و فروش اداری، تجاری و صنعتی";
            break;
        case 'land':
            return "زمین و باغ";
            break;
        case 'pre-sale':
            return "پیش فروش و مشارکت در ساخت";
            break;

        default:
            break;
    }
}

?>

<!-- Page container-->
<div class="container mt-5 mb-md-4 py-5">
    <div class="row">
        <div class="col-lg-12 add-property">
            <nav class="mb-3 pt-md-3" aria-label="Breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش ملک</li>
                </ol>
            </nav>

            <form enctype="multipart/form-data" action="{{ url('/property/update/' . $property_id) }}" method="post">
                @csrf
                @method('PUT')

                <section class="card card-body border-0 shadow-sm p-4 mb-4" id="basic-info">
                    <h2 class="h5 mb-4"><i class="fi-info-circle text-primary fs-5 mt-n1 me-2"></i>اطلاعات پایه</h2>

                    <div class="row">
                        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                            <label class="form-label" for="category">دسته بندی <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" disabled>
                                <option value="{{ $property->category }}" selected>{{ getCat($property->category) }}</option>
                            </select>
                            <input type="hidden" name="category" value="{{ $property->category }}">
                        </div>

                        <div class="col-sm-6 pb-3 pe-3 pt-3 ps-3">
                            <label class="form-label" for="title">عنوان <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $property->title) }}" required>
                        </div>

                        <div class="pb-3 pe-3 pt-3 ps-3">
                            <label class="form-label" for="description">توضیحات <span class="text-danger">*</span></label>
                            <textarea style="min-height: 200px;" class="form-control" id="description" name="description" required>{{ old('description', $property->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-sm-12" id="category_holder">
                                @include($categoryView, (array)$property)
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Location-->
                <section class="card card-body border-0 shadow-sm p-4 mb-4" id="location">
                    <h2 class="h5 mb-4"><i class="fi-mpin text-primary fs-5 mt-n1 me-2"></i>موقعیت مکانی</h2>
                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <label class="form-label" for="province">استان <span class="text-danger">*</span></label>
                            <select class="form-select" id="province" name="province" required>
                                <option value="مازندران" {{ $property->province == 'مازندران' ? 'selected' : '' }}>مازندران</option>
                                <option value="تهران" {{ $property->province == 'تهران' ? 'selected' : '' }}>تهران</option>
                                <option value="اصفهان" {{ $property->province == 'اصفهان' ? 'selected' : '' }}>اصفهان</option>
                                <option value="گیلان" {{ $property->province == 'گیلان' ? 'selected' : '' }}>گیلان</option>
                                <option value="فارس" {{ $property->province == 'فارس' ? 'selected' : '' }}>فارس</option>
                            </select>
                        </div>

                        <div class="col-sm-4 mb-3">
                            <label class="form-label" for="city">شهر <span class="text-danger">*</span></label>
                            <select class="form-select" id="city" name="city" required>
                                <option value="">انتخاب شهر</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->name }}" {{ $property->city == $city->name ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 mb-3">
                            <label class="form-label" for="neighborhood">محله <span class="text-danger">*</span></label>
                            <select class="form-select" id="neighborhood" name="neighborhood" required>
                                <option value="">انتخاب محله</option>

                                    @if(isset($neighborhoods) && count($neighborhoods) > 0)
                                    @foreach($neighborhoods as $neighborhood)
                                    <option value="{{ $neighborhood->name }}"  {{ ($property->neighborhood == $neighborhood->name) ? 'selected' : '' }}>
                                        {{ $neighborhood->name }}
                                    </option>
                                    @endforeach
                                    @endif

                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address">آدرس <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="address" name="address" value="{{ old('address', $property->address) }}" required>
                    </div>
                </section>

                <!-- Photos / video-->
                <section class="card card-body border-0 shadow-sm p-4 mb-4" id="photos">
                    <h2 class="h5 mb-4"><i class="fi-image text-primary fs-5 mt-n1 me-2"></i>عکس / ویدئو</h2>

                    <div class="alert alert-info mb-4" role="alert">
                        <div class="d-flex my-4 py-4">
                            <i class="fi-alert-circle me-2 me-sm-3"></i>
                            <p class="fs-sm mb-1">حداکثر حجم عکس 8 مگابایت است. فرمت ها: jpeg ، jpg ، png.<br>حداکثر حجم فیلم 10 مگابایت است. فرمت ها: mp4 ، mov.</p>
                        </div>
                    </div>

                    {{-- تصاویر موجود --}}
                    @if(!empty($mediaFiles))
                    <div class="mb-4">
                        <label class="form-label fw-bold">تصاویر فعلی</label>
                        <div class="row" id="existing-images">
                            @foreach($mediaFiles as $image)
                            <div class="col-md-3 mb-3" data-image="{{ $image }}">
                                <div class="position-relative">
                                    <img src="{{ url('/upload/property/' . $property_id . '/' . $image) }}"
                                        alt="Image" class="img-fluid rounded border" style="height: 150px; width: 100%; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle"
                                        onclick="markForDelete(this, '{{ $image }}')" style="width: 30px; height: 30px; padding: 0;">
                                        <i class="fi-x"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="deleted_images" id="deleted_images" value="">
                    </div>
                    @endif

                    {{-- آپلود تصاویر جدید --}}
                    <div>
                        <label class="form-label fw-bold">افزودن تصاویر جدید</label>
                        <input name="media[]" class="file-uploader file-uploader-grid" type="file" multiple
                            accept="image/png, image/jpeg, video/mp4, video/mov"
                            data-label-idle='<div class="btn btn-primary mb-3"> آپلود عکس / ویدئو <i class="fi-cloud-upload ms-1"></i></div><br>یا آن را به این قسمت بکشید'>
                    </div>
                </section>

                <!-- Contacts-->
                <section class="card card-body border-0 shadow-sm p-4 mb-4" id="contacts">
                    <h2 class="h5 mb-4"><i class="fi-phone text-primary fs-5 mt-n1 me-2"></i>اطلاعات تماس</h2>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="fn">نام <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="fn" name="name" value="{{ old('name', $property->name) }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="sn">نام خانوادگی <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="sn" name="last_name" value="{{ old('last_name', $property->last_name) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="email">پست الکترونیکی</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $property->email) }}">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="phone">شماره تماس <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="tel" name="tel" value="{{ old('tel', $property->tel) }}" required>
                        </div>
                    </div>
                    <label class="form-label" for="company-name">نام شرکت</label>
                    <input class="form-control" type="text" id="company-name" name="company" value="{{ old('company', $property->company) }}">
                </section>

                <section class="d-sm-flex justify-content-between pt-2">
                    <button type="submit" class="btn btn-primary btn-lg d-block mb-2">به‌روزرسانی</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg d-block mb-2">انصراف</a>
                </section>
            </form>
        </div>
    </div>
</div>

<script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>

<script>
    let deletedImages = [];

    function markForDelete(btn, imageName) {
        const imageDiv = $(btn).closest('.col-md-3');
        imageDiv.fadeOut(300, function() {
            $(this).remove();
        });
        deletedImages.push(imageName);
        $('#deleted_images').val(JSON.stringify(deletedImages));
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (window.FilePond) {
            FilePond.setOptions({
                storeAsFile: true
            });
        }

        const formatPrice = (value) => {
            const digits = (value || '').toString().replace(/\D/g, '');
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        };

        document.addEventListener('input', (e) => {
            if (e.target.classList && e.target.classList.contains('price-input')) {
                const formatted = formatPrice(e.target.value);
                e.target.value = formatted;
            }
        });
    });

    // AJAX برای بارگذاری محله‌ها
    $(document).ready(function() {
        $('#city').on('change', function() {
            var cityName = $(this).val();

            var neighborhoodSelect = $('#neighborhood');

            neighborhoodSelect.prop('disabled', true);
            neighborhoodSelect.html('<option value="" disabled selected>در حال بارگذاری...</option>');

            if (cityName) {
                $.ajax({
                    url: '{{ route("get.neighborhoods") }}',
                    type: 'GET',
                    data: {
                        city_name: cityName
                    },
                    success: function(response) {
                        if (response.success && response.neighborhoods.length > 0) {
                            var options = '<option value="" disabled>انتخاب محله</option>';
                            $.each(response.neighborhoods, function(key, neighborhood) {
                                let selected = (neighborhood.name == '{{ $property->neighborhood }}') ? 'selected' : '';
                                options += '<option value="' + neighborhood.name + '" ' + selected + '>' + neighborhood.name + '</option>';
                            });
                            neighborhoodSelect.html(options);
                            neighborhoodSelect.prop('disabled', false);
                        } else {
                            neighborhoodSelect.html('<option value="" disabled selected>هیچ محله‌ای یافت نشد</option>');
                            neighborhoodSelect.prop('disabled', true);
                        }
                    },
                    error: function() {
                        neighborhoodSelect.html('<option value="" disabled selected>خطا در بارگذاری</option>');
                        neighborhoodSelect.prop('disabled', true);
                    }
                });
            }
        });
        // تابع برای بارگذاری محله‌ها
        function loadNeighborhoods(cityName, selectedNeighborhood = null) {
            var neighborhoodSelect = $('#neighborhood');

            if (!cityName) {
                neighborhoodSelect.html('<option value="">ابتدا شهر را انتخاب کنید</option>');
                neighborhoodSelect.prop('disabled', true);
                return;
            }

            neighborhoodSelect.prop('disabled', true);
            neighborhoodSelect.html('<option value="">در حال بارگذاری...</option>');

            $.ajax({
                url: '{{ route("get.neighborhoods") }}',
                type: 'GET',
                data: {
                    city_name: cityName
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.neighborhoods.length > 0) {
                        var options = '<option value="">انتخاب محله</option>';
                        $.each(response.neighborhoods, function(key, neighborhood) {
                            var selected = (selectedNeighborhood && neighborhood.id == selectedNeighborhood) ? 'selected' : '';
                            options += '<option value="' + neighborhood.name + '" ' + selected + '>' + neighborhood.name + '</option>';
                        });
                        neighborhoodSelect.html(options);
                        neighborhoodSelect.prop('disabled', false);

                    } else {
                        neighborhoodSelect.html('<option value="">هیچ محله‌ای یافت نشد</option>');
                        neighborhoodSelect.prop('disabled', true);
                    }
                },
                error: function() {
                    neighborhoodSelect.html('<option value="">خطا در بارگذاری</option>');
                    neighborhoodSelect.prop('disabled', true);
                }
            });
        }

        // وقتی شهر تغییر می‌کند
        $('#city').on('change', function() {
            var cityName = $(this).val();
            loadNeighborhoods(cityName, null);
        });

        // بارگذاری اولیه محله‌ها بر اساس شهر فعلی
        // var initialCity = $('#city').val();
        // var initialNeighborhood = '{{ $property->neighborhood }}';
        // if (initialCity) {
        //     loadNeighborhoods(initialCity, initialNeighborhood);
        // }


    });
</script>

<style>
    .image-preview-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        border: 1px solid #ccc;
        margin-top: 10px;
        background-color: #f8f8f8;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .image-preview-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>

@include('partials.footer')