@extends('layouts.master')
@section('title', $subject->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.subjects.index') }}">{{ __('main.subjects') }}</a></li>
    <li class="breadcrumb-item active">{{ $subject->name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-book mr-1 text-primary"></i>
                    {{ __('main.subject') }}
                </h5>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-muted" style="width:40%"><i class="fa fa-hashtag mr-1"></i>{{ __('main.code') }}</td>
                            <td><span class="badge badge-info">{{ $subject->code ?? '—' }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-book mr-1"></i>{{ __('main.name') }}</td>
                            <td class="font-weight-bold">{{ $subject->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-layer-group mr-1"></i>{{ __('main.grade') }}</td>
                            <td>{{ $subject->grade?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-door-open mr-1"></i>{{ __('main.classroom') }}</td>
                            <td>{{ $subject->classroom?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-align-left mr-1"></i>{{ __('main.description') }}</td>
                            <td><small class="text-muted">{{ $subject->description ?? '—' }}</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-chalkboard-teacher mr-1 text-success"></i>
                    {{ __('main.teacher') }}
                </h5>
                @if($subject->teacher?->user)
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width:40%"><i class="fa fa-user mr-1"></i>{{ __('main.teacher_name') }}</td>
                                <td class="font-weight-bold">{{ $subject->teacher->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="fa fa-envelope mr-1"></i>{{ __('main.email') }}</td>
                                <td>{{ $subject->teacher->user->email ?? '—' }}</td>
                            </tr>
                            @if($subject->teacher->specialization)
                            <tr>
                                <td class="text-muted"><i class="fa fa-graduation-cap mr-1"></i>{{ __('main.specialization') }}</td>
                                <td>{{ $subject->teacher->specialization->name ?? '—' }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                @else
                    <p class="text-muted text-center mt-4">
                        <i class="fa fa-info-circle mr-1"></i>{{ __('main.no_data') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-30">
        <a href="{{ route('student.subjects.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-1"></i>{{ __('main.back_to_list') }}
        </a>
    </div>
</div>
@endsection
