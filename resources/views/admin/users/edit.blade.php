@include('admin.parts.header')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">ویرایش کاربر: {{ $user->name }} {{ $user->lname ?? '' }}</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="name">نام</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="lname">نام خانوادگی</label>
                            <input type="text" class="form-control" id="lname" name="lname" value="{{ $user->lname }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="tel">شماره موبایل</label>
                            <input type="text" class="form-control" id="tel" name="tel" value="{{ $user->tel }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="agency_name">نام آژانس</label>
                            <input type="text" class="form-control" id="agency_name" name="agency_name" value="{{ $user->agency_name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="bio">بیوگرافی</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3">{{ $user->bio }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">لغو</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.parts.footer')