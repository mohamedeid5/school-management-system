@extends('layouts.master')
@section('title', __('main.online_classes'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.online_classes') }}</li>
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
                    <span class="badge badge-warning">
                        {{ $child->onlineClasses->count() }} {{ __('main.online_classes') }}
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.online_class') }}</th>
                                    <th>{{ __('main.subject') }}</th>
                                    <th>{{ __('main.teacher') }}</th>
                                    <th>{{ __('main.start_at') }}</th>
                                    <th>{{ __('main.duration') }}</th>
                                    <th class="text-center">{{ __('main.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($child->onlineClasses as $class)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $class->title }}</td>
                                        <td>{{ $class->subject?->name ?? '—' }}</td>
                                        <td>
                                            @if($class->user)
                                                <i class="fa fa-chalkboard-teacher mr-1 text-muted"></i>
                                                {{ $class->user->name }}
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $class->start_at ? $class->start_at->format('d M Y, H:i') : '—' }}</small>
                                        </td>
                                        <td>
                                            @if($class->duration)
                                                {{ $class->duration }} {{ __('main.minutes') }}
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = match($class->status) {
                                                    'ongoing'   => 'badge-success',
                                                    'scheduled' => 'badge-primary',
                                                    'ended'     => 'badge-secondary',
                                                    default     => 'badge-light',
                                                };
                                                $statusLabel = match($class->status) {
                                                    'ongoing'   => __('main.online_class_status_ongoing'),
                                                    'scheduled' => __('main.online_class_status_scheduled'),
                                                    'ended'     => __('main.online_class_status_ended'),
                                                    default     => $class->status,
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                        </td>
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
