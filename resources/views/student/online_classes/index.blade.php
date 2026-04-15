@extends('layouts.master')
@section('title', __('main.online_classes'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.online_classes') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-30">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">
                        <i class="fa fa-video mr-1 text-warning"></i>
                        {{ __('main.my_online_classes') }}
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('main.online_class') }}</th>
                                <th>{{ __('main.subject') }}</th>
                                <th>{{ __('main.teacher') }}</th>
                                <th>{{ __('main.start_at') }}</th>
                                <th>{{ __('main.duration') }}</th>
                                <th class="text-center">{{ __('main.status') }}</th>
                                <th class="text-center">{{ __('main.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($onlineClasses as $class)
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
                                    <td class="text-center">
                                        <a href="{{ route('student.online-classes.show', $class) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-eye mr-1"></i>{{ __('main.show') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
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
@endsection
