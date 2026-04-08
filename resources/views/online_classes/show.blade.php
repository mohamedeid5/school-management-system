@extends('layouts.master')
@section('title', __('main.online_class_details'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('online-classes.index') }}">{{ __('main.online_classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.online_class_details') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-video"></i> {{ $onlineClass->title }}
            </h3>
            <div>
                <a href="{{ route('online-classes.edit', $onlineClass->id) }}" class="btn btn-info btn-sm">
                    <i class="fa fa-edit"></i> {{ __('main.edit') }}
                </a>
                <a href="{{ route('online-classes.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> {{ __('main.back') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light w-40">{{ __('main.title') }}</th>
                            <td>{{ $onlineClass->title }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('main.teacher') }}</th>
                            <td>{{ $onlineClass->teacher->full_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('main.grade') }}</th>
                            <td>{{ $onlineClass->grade->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('main.classroom') }}</th>
                            <td>{{ $onlineClass->classroom->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('main.subject') }}</th>
                            <td>{{ $onlineClass->subject->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('main.start_at') }}</th>
                            <td>{{ $onlineClass->start_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('main.duration') }}</th>
                            <td>{{ $onlineClass->duration }} {{ __('main.minutes') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('main.status') }}</th>
                            <td>
                                @php
                                    $statusColors = ['scheduled' => 'warning', 'ongoing' => 'success', 'ended' => 'secondary'];
                                    $color = $statusColors[$onlineClass->status] ?? 'secondary';
                                @endphp
                                <span class="badge badge-{{ $color }}">{{ __('main.online_class_status_' . $onlineClass->status) }}</span>
                            </td>
                        </tr>
                        @if($onlineClass->description)
                        <tr>
                            <th class="bg-light">{{ __('main.description') }}</th>
                            <td>{{ $onlineClass->description }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                @if($onlineClass->join_url || $onlineClass->start_url)
                <div class="col-md-6">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h5 class="card-title text-success">
                                <i class="fa fa-video"></i>
                                {{ ($onlineClass->type ?? 'zoom') === 'manual' ? __('main.meeting_link') : __('main.zoom_meeting_info') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($onlineClass->zoom_meeting_id)
                            <p><strong>{{ __('main.zoom_meeting_id') }}:</strong> {{ $onlineClass->zoom_meeting_id }}</p>
                            @endif
                            @if($onlineClass->join_url)
                            <div class="mb-3">
                                <label class="font-weight-bold">{{ __('main.join_url') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $onlineClass->join_url }}" readonly id="join_url">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" onclick="copyToClipboard('join_url')" type="button">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                                <a href="{{ $onlineClass->join_url }}" target="_blank" class="btn btn-success btn-sm mt-2">
                                    <i class="fa fa-video"></i> {{ __('main.join_meeting') }}
                                </a>
                            </div>
                            @endif
                            @if($onlineClass->start_url)
                            <div class="mb-3">
                                <label class="font-weight-bold">{{ __('main.start_url') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $onlineClass->start_url }}" readonly id="start_url">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" onclick="copyToClipboard('start_url')" type="button">
                                            <i class="fa fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                                <a href="{{ $onlineClass->start_url }}" target="_blank" class="btn btn-primary btn-sm mt-2">
                                    <i class="fa fa-play"></i> {{ __('main.start_meeting') }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function copyToClipboard(id) {
        var input = document.getElementById(id);
        input.select();
        document.execCommand('copy');
    }
</script>
@endsection
