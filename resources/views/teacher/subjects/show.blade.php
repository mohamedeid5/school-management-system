@extends('layouts.master')
@section('title', $subject->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher.subjects.index') }}">{{ __('main.subjects') }}</a></li>
    <li class="breadcrumb-item active">{{ $subject->name }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="ti-book"></i> {{ $subject->name }}
            </h3>
            <a href="{{ route('teacher.subjects.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> {{ __('main.back') }}
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-3">
                    <span class="text-muted small">{{ __('main.code') }}</span>
                    <div class="font-weight-bold">
                        <span class="badge badge-info">{{ $subject->code ?? __('main.no_data') }}</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <span class="text-muted small">{{ __('main.grade') }}</span>
                    <div class="font-weight-bold">{{ $subject->grade->name }}</div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <span class="text-muted small">{{ __('main.classroom') }}</span>
                    <div class="font-weight-bold">{{ $subject->classroom->name }}</div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <span class="text-muted small">{{ __('main.teacher') }}</span>
                    <div class="font-weight-bold">{{ $subject->teacher->user->name ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
