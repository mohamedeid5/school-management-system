@extends('layouts.master')
@section('title', __('main.libraries'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.library') }}</li>
@endsection

@section('content')

@forelse($children as $child)

    <div class="row mb-2">
        <div class="col-12">
            <h5 class="text-primary">
                <i class="fa fa-user-graduate mr-2"></i>
                {{ $child->user?->name ?? __('main.no_data') }}
                <span class="badge badge-secondary ml-2">{{ $child->student_code }}</span>
            </h5>
        </div>
    </div>

    <div class="row mb-30">
        @forelse($child->libraries as $library)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-30">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <i class="fa fa-book fa-2x text-primary"></i>
                        </div>
                        <h6 class="font-weight-bold mb-1">{{ $library->title }}</h6>
                        <p class="text-muted small mb-1">
                            <i class="fa fa-book mr-1"></i>{{ $library->subject?->name ?? '—' }}
                        </p>
                        <p class="text-muted small mb-1">
                            <i class="fa fa-user mr-1"></i>{{ $library->user?->name ?? '—' }}
                        </p>
                        @if($library->description)
                            <p class="text-muted small flex-grow-1">{{ Str::limit($library->description, 80) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4 mb-30">
                <div class="card card-statistics">
                    <div class="card-body py-4">
                        <i class="fa fa-book-open fa-2x mb-2 d-block"></i>
                        {{ __('main.no_data') }}
                    </div>
                </div>
            </div>
        @endforelse
    </div>

@empty
    <div class="row">
        <div class="col-12">
            <div class="card card-statistics">
                <div class="card-body text-center py-5">
                    <i class="fa fa-child fa-3x text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">{{ __('main.no_data') }}</h5>
                </div>
            </div>
        </div>
    </div>
@endforelse

@endsection
