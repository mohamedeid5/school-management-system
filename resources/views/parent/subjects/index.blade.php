@extends('layouts.master')
@section('title', __('main.subjects'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.subjects') }}</li>
@endsection

@section('content')

@forelse($children as $child)
    <div class="row mb-30">
        <div class="col-12">
            <div class="card card-statistics shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                        <i class="fa fa-user-graduate mr-2 text-primary"></i>
                        <strong>{{ $child->user?->name ?? __('main.no_data') }}</strong>
                        <span class="badge badge-secondary ml-2">{{ $child->student_code }}</span>
                    </h5>
                    <span class="badge badge-primary">
                        {{ $child->subjects->count() }} {{ __('main.subjects') }}
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.code') }}</th>
                                    <th>{{ __('main.name') }}</th>
                                    <th>{{ __('main.grade') }}</th>
                                    <th>{{ __('main.classroom') }}</th>
                                    <th>{{ __('main.teacher') }}</th>
                                    <th>{{ __('main.description') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($child->subjects as $subject)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="badge badge-info">{{ $subject->code ?? '—' }}</span></td>
                                        <td class="font-weight-bold">{{ $subject->name }}</td>
                                        <td>{{ $subject->grade?->name ?? '—' }}</td>
                                        <td>{{ $subject->classroom?->name ?? '—' }}</td>
                                        <td>
                                            @if($subject->teacher?->user)
                                                <i class="fa fa-chalkboard-teacher mr-1 text-muted"></i>
                                                {{ $subject->teacher->user->name }}
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td><small class="text-muted">{{ $subject->description ?? '—' }}</small></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                                            {{ __('main.no_data') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
