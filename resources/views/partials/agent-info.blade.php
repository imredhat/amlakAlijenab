@php
    $agent = \App\Models\User::where('tel', $tel)->first();
@endphp
@if($agent && $agent->is_agent)
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body text-center">
        <img class="d-block rounded-circle mx-auto mb-3 shadow-sm"
             src="{{ !empty($agent->avatar) ? asset('upload/user/' . $agent->id . '/' . $agent->avatar) : asset('img/avatars/default-agent.svg') }}"
             width="80" height="80" alt="{{ $agent->name }}">
        <h5 class="mb-1">{{ $agent->name }} {{ $agent->lname ?? '' }}</h5>
        <p class="text-muted mb-3">{{ $agent->agency_name ?? 'مشاور املاک' }}</p>
        <div class="d-flex justify-content-center mb-3">
            <span class="star-rating">
                @for($i = 1; $i <= 5; $i++)
                    <i class="star-rating-icon fi-star-filled active"></i>
                @endfor
            </span>
        </div>
        <a href="{{ url('/agent/' . $agent->tel) }}" class="btn btn-outline-primary btn-sm">
            <i class="fi-user me-2"></i>مشاهده پروفایل مشاور
        </a>
    </div>
</div>
@endif