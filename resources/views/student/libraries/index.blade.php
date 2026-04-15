@extends('layouts.master')
@section('title', __('main.libraries'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.library') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-30">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">
                        <i class="fa fa-book-open mr-1 text-success"></i>
                        {{ __('main.library') }}
                    </h5>
                </div>

                <div class="row">
                    @forelse($libraries as $library)
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
                                    <div class="mt-auto pt-2">
                                        <a href="{{ route('student.libraries.show', $library) }}" class="btn btn-sm btn-outline-primary btn-block">
                                            <i class="fa fa-eye mr-1"></i>{{ __('main.show') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5">
                            <i class="fa fa-book-open fa-3x mb-3 d-block"></i>
                            {{ __('main.no_data') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
