@include('admin.parts.header')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">ویرایش پکیج: {{ $package->name }}</h4>
        <a href="{{ route('admin.upgrade-packages.index') }}" class="btn btn-outline-secondary">
            <i class="ri-arrow-right-line me-1"></i>بازگشت
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.upgrade-packages.update', $package->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">نام پکیج</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $package->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">قیمت (تومان)</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $package->price) }}" required min="0">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">مدت اعتبار (روز)</label>
                        <input type="number" class="form-control @error('duration_days') is-invalid @enderror" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" required min="1">
                        @error('duration_days')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">ضریب افزایش بازدید</label>
                        <input type="number" class="form-control @error('view_multiplier') is-invalid @enderror" name="view_multiplier" value="{{ old('view_multiplier', $package->view_multiplier) }}" required min="1">
                        <small class="text-muted">مثال: 3 یعنی ۳ برابر بازدید</small>
                        @error('view_multiplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">ترتیب نمایش</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', $package->order) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_top_listed" id="is_top_listed" {{ old('is_top_listed', $package->is_top_listed) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_top_listed">آپدیت آگهی به لیست اول</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_special_badge" id="is_special_badge" {{ old('is_special_badge', $package->is_special_badge) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_special_badge">نشان ویژه در نتایج</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">فعال</label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.upgrade-packages.index') }}" class="btn btn-outline-secondary">انصراف</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-save-line me-1"></i>بروزرسانی پکیج
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.parts.footer')
