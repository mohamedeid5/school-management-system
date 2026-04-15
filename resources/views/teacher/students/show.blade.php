@extends('layouts.master')
@section('title', $student->user->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher.students.index') }}">{{ __('main.students') }}</a></li>
    <li class="breadcrumb-item active">{{ $student->user->name }}</li>
@endsection

@section('content')
<div class="row">
    {{-- Sidebar: quick profile --}}
    <div class="col-md-3">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle shadow"
                         src="{{ asset('assets/img/student_default.png') }}" alt="{{ $student->user->name }}">
                </div>
                <h3 class="profile-username text-center font-weight-bold">{{ $student->user->name }}</h3>
                <p class="text-muted text-center">{{ $student->student_code }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{ __('main.grade') }}</b>
                        <span class="float-right text-primary font-weight-bold">{{ $student->grade->name }}</span>
                    </li>
                    <li class="list-group-item">
                        <b>{{ __('main.classroom') }}</b>
                        <span class="float-right text-primary font-weight-bold">{{ $student->classroom->name }}</span>
                    </li>
                    <li class="list-group-item">
                        <b>{{ __('main.section') }}</b>
                        <span class="float-right text-primary font-weight-bold">{{ $student->section->name }}</span>
                    </li>
                </ul>

                <a href="{{ route('teacher.students.index') }}" class="btn btn-secondary btn-block">
                    <i class="fa fa-arrow-left"></i> {{ __('main.back') }}
                </a>
            </div>
        </div>
    </div>

    {{-- Main column: tabs --}}
    <div class="col-md-9">
        <div class="card shadow-sm">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#personal" data-toggle="tab">
                            <i class="fa fa-user mr-1"></i> {{ __('main.personal_information') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#academic" data-toggle="tab">
                            <i class="fa fa-graduation-cap mr-1"></i> {{ __('main.academic_information') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="personal">
                        <table class="table table-striped table-sm">
                            <tr><th width="30%">{{ __('main.email') }}</th><td>{{ $student->user->email }}</td></tr>
                            <tr><th>{{ __('main.gender') }}</th><td>{{ $student->gender->value == 'male' ? __('main.male') : __('main.female') }}</td></tr>
                            <tr><th>{{ __('main.nationality') }}</th><td>{{ $student->nationality->name }}</td></tr>
                            <tr><th>{{ __('main.blood_type') }}</th><td><span class="badge badge-danger">{{ $student->bloodType->name }}</span></td></tr>
                            <tr><th>{{ __('main.date_of_birth') }}</th><td>{{ $student->date_of_birth->format('Y-m-d') }}</td></tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="academic">
                        <table class="table table-striped table-sm">
                            <tr><th width="30%">{{ __('main.academic_year') }}</th><td>{{ $student->academic_year }}</td></tr>
                            <tr><th>{{ __('main.grade') }}</th><td>{{ $student->grade->name }}</td></tr>
                            <tr><th>{{ __('main.classroom') }}</th><td>{{ $student->classroom->name }}</td></tr>
                            <tr><th>{{ __('main.section') }}</th><td>{{ $student->section->name }}</td></tr>
                            <tr><th>{{ __('main.joining_date') }}</th><td>{{ $student->joining_date->format('Y-m-d') }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
