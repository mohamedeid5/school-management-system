@extends('layouts.master')
@section('title', __('main.teacher_details'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">{{ __('main.teachers') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.teacher_details') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        {{-- تريكة سريعة: ممكن تعمل صورة افتراضية حسب النوع --}}
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ asset('assets/images/' . ($teacher->gender->value == 'male' ? 'teacher_male.png' : 'teacher_female.png')) }}"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $teacher->user->name }}</h3>
                    <p class="text-muted text-center">{{ $teacher->specialization->name }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>{{ __('main.email') }}</b> <a class="float-right">{{ $teacher->user->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ __('main.joining_date') }}</b> <a class="float-right">{{ $teacher->joining_date }}</a>
                        </li>
                    </ul>
                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i> <b>{{ __('main.edit') }}</b>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="details-tab" data-toggle="pill" href="#details" role="tab">{{ __('main.additional_info') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="details">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> {{ __('main.address') }}</strong>
                            <p class="text-muted">{{ $teacher->address ?? __('main.no_address') }}</p>
                            <hr>

                            <strong><i class="fas fa-venus-mars mr-1"></i> {{ __('main.gender') }}</strong>
                            <p class="text-muted">{{ $teacher->gender->label() }}</p>
                            <hr>

                            <strong><i class="fas fa-book mr-1"></i> {{ __('main.sections') }}</strong>
                            <p>
                                @forelse($teacher->sections as $section)
                                    <span class="badge badge-info p-2">{{ $section->name }}</span>
                                @empty
                                    <span class="text-danger">{{ __('main.no_sections_assigned') }}</span>
                                @endforelse
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i> {{ __('main.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
