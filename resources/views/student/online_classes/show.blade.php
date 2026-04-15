@extends('layouts.master')
@section('title', $onlineClass->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.online-classes.index') }}">{{ __('main.online_classes') }}</a></li>
    <li class="breadcrumb-item active">{{ $onlineClass->title }}</li>
@endsection

@section('content')
<div class="row">
    {{-- Class Details --}}
    <div class="col-lg-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-video mr-1 text-warning"></i>
                    {{ __('main.online_class_details') }}
                </h5>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-muted" style="width:40%"><i class="fa fa-heading mr-1"></i>{{ __('main.title') }}</td>
                            <td class="font-weight-bold">{{ $onlineClass->title }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-book mr-1"></i>{{ __('main.subject') }}</td>
                            <td>{{ $onlineClass->subject?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-layer-group mr-1"></i>{{ __('main.grade') }}</td>
                            <td>{{ $onlineClass->grade?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-door-open mr-1"></i>{{ __('main.classroom') }}</td>
                            <td>{{ $onlineClass->classroom?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-chalkboard-teacher mr-1"></i>{{ __('main.teacher') }}</td>
                            <td>{{ $onlineClass->user?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-calendar mr-1"></i>{{ __('main.start_at') }}</td>
                            <td class="font-weight-bold text-primary">
                                {{ $onlineClass->start_at ? $onlineClass->start_at->format('d M Y, H:i') : '—' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-clock mr-1"></i>{{ __('main.duration') }}</td>
                            <td>
                                @if($onlineClass->duration)
                                    {{ $onlineClass->duration }} {{ __('main.minutes') }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-circle mr-1"></i>{{ __('main.status') }}</td>
                            <td>
                                @php
                                    $statusClass = match($onlineClass->status) {
                                        'ongoing'   => 'badge-success',
                                        'scheduled' => 'badge-primary',
                                        'ended'     => 'badge-secondary',
                                        default     => 'badge-light',
                                    };
                                    $statusLabel = match($onlineClass->status) {
                                        'ongoing'   => __('main.online_class_status_ongoing'),
                                        'scheduled' => __('main.online_class_status_scheduled'),
                                        'ended'     => __('main.online_class_status_ended'),
                                        default     => $onlineClass->status,
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                            </td>
                        </tr>
                        @if($onlineClass->description)
                        <tr>
                            <td class="text-muted"><i class="fa fa-align-left mr-1"></i>{{ __('main.description') }}</td>
                            <td><small class="text-muted">{{ $onlineClass->description }}</small></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Meeting Info --}}
    <div class="col-lg-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-link mr-1 text-success"></i>
                    {{ __('main.meeting_link') }}
                </h5>

                @if($onlineClass->join_url)
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle mr-1"></i>
                        {{ __('main.meeting_type') }}:
                        <strong>{{ $onlineClass->type === 'zoom' ? __('main.zoom_meeting') : __('main.manual_meeting') }}</strong>
                    </div>

                    @if($onlineClass->zoom_meeting_id)
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width:40%"><i class="fa fa-hashtag mr-1"></i>{{ __('main.zoom_meeting_id') }}</td>
                                <td><code>{{ $onlineClass->zoom_meeting_id }}</code></td>
                            </tr>
                        </tbody>
                    </table>
                    @endif

                    <div class="mt-3">
                        <a href="{{ $onlineClass->join_url }}" target="_blank" class="btn btn-success btn-block">
                            <i class="fa fa-video mr-2"></i>{{ __('main.join_meeting') }}
                        </a>
                    </div>
                @else
                    <p class="text-muted text-center mt-4">
                        <i class="fa fa-link fa-2x mb-2 d-block"></i>
                        {{ __('main.no_data') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-30">
        <a href="{{ route('student.online-classes.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-1"></i>{{ __('main.back_to_list') }}
        </a>
    </div>
</div>
@endsection
