@extends('admin.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Test Top Agents</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Top Agents</h5>
                </div>
                <div class="card-body">
                    @if($topAgents->count() > 0)
                        @foreach($topAgents as $topAgent)
                        <div class="mb-3">
                            <h6>{{ $topAgent->user->name ?? 'Unknown' }} {{ $topAgent->user->lname ?? '' }}</h6>
                            <p>{{ $topAgent->custom_text ?? 'No text' }}</p>
                            <p>Order: {{ $topAgent->order ?? 0 }}</p>
                        </div>
                        @endforeach
                    @else
                        <p>No top agents found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection