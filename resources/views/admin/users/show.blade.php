@include('admin.parts.header')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">مشاهده کاربر: {{ $user->name }} {{ $user->lname ?? '' }}</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ !empty($user->avatar) ? asset('upload/user/' . $user->id . '/' . $user->avatar) : asset('img/avatars/default-user.svg') }}"
                         class="rounded-circle mb-3" width="100" height="100" alt="{{ $user->name }}">
                    <h5>{{ $user->name }} {{ $user->lname ?? '' }}</h5>
                    <p class="text-muted">{{ $user->tel }}</p>

                    <div class="d-flex justify-content-center mb-3">
                        <span class="badge {{ $user->is_agent ? 'bg-success' : 'bg-secondary' }} px-3 py-2">
                            {{ $user->is_agent ? 'مشاور' : 'کاربر عادی' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>اطلاعات کاربر</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">نام آژانس:</label>
                        <p>{{ $user->agency_name ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">بیوگرافی:</label>
                        <p>{{ $user->bio ?? '-' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تاریخ ثبت نام:</label>
                        <p>{{ verta($user->created_at)->format('Y/m/d H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.parts.footer')