@extends('layouts.master')
@section('title', __('main.student_profile'))

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('assets/img/student_default.png') }}"
                         alt="User profile picture">
                </div>
                <h3 class="profile-username text-center font-weight-bold">{{ $student->user->name }}</h3>
                <p class="text-muted text-center">{{ __('main.student') }} | {{ $student->student_code }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{ __('main.grade') }}</b> <a class="float-right text-primary">{{ $student->grade->name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ __('main.classroom') }}</b> <a class="float-right text-primary">{{ $student->classroom->name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ __('main.academic_year') }}</b> <a class="float-right text-success font-weight-bold">{{ $student->academic_year }}</a>
                    </li>
                </ul>
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-block"><b>{{ __('main.edit') }}</b></a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card shadow-sm">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">{{ __('main.personal_information') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#academic" data-toggle="tab">{{ __('main.academic_information') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#parent" data-toggle="tab">{{ __('main.parent_information') }}</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="personal">
                        <table class="table table-striped">
                            <tr>
                                <th width="30%">{{ __('main.email') }}</th>
                                <td>{{ $student->user->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('main.gender') }}</th>
                                <td>{{ $student->gender->label() }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('main.nationality') }}</th>
                                <td>{{ $student->nationality->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('main.blood_type') }}</th>
                                <td><span class="badge badge-danger">{{ $student->bloodType->name }}</span></td>
                            </tr>
                            <tr>
                                <th>{{ __('main.date_of_birth') }}</th>
                                <td>{{ $student->date_of_birth->format('Y-m-d') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="academic">
                        <table class="table table-striped">
                            <tr>
                                <th width="30%">{{ __('main.student_code') }}</th>
                                <td><span class="badge badge-info">{{ $student->student_code }}</span></td>
                            </tr>
                            <tr>
                                <th>{{ __('main.section') }}</th>
                                <td>{{ $student->section->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('main.joining_date') }}</th>
                                <td>{{ $student->joining_date->format('Y-m-d') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="parent">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-primary border-bottom pb-2">{{ __('main.father_information') }}</h5>
                                <p><b>{{ __('main.name') }}:</b> {{ $student->parent->name_father }}</p>
                                <p><b>{{ __('main.phone_father') }}:</b> {{ $student->parent->phone_father }}</p>
                                <p><b>{{ __('main.job_father') }}:</b> {{ $student->parent->job_father }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-primary border-bottom pb-2">{{ __('main.mother_information') }}</h5>
                                <p><b>{{ __('main.name') }}:</b> {{ $student->parent->name_mother }}</p>
                                <p><b>{{ __('main.phone_mother') }}:</b> {{ $student->parent->phone_mother }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
