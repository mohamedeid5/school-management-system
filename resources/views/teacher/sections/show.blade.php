@extends('layouts.master')
@section('title', $section->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher.sections.index') }}">{{ __('main.sections') }}</a></li>
    <li class="breadcrumb-item active">{{ $section->name }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="ti-layout-tab"></i> {{ $section->name }}
            </h3>
            <a href="{{ route('teacher.sections.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> {{ __('main.back') }}
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <span class="text-muted small">{{ __('main.grade') }}</span>
                    <div class="font-weight-bold">{{ $section->grade->name }}</div>
                </div>
                <div class="col-md-4 mb-2">
                    <span class="text-muted small">{{ __('main.classroom') }}</span>
                    <div class="font-weight-bold">{{ $section->classroom->name }}</div>
                </div>
                <div class="col-md-4 mb-2">
                    <span class="text-muted small">{{ __('main.status') }}</span>
                    <div>
                        @if($section->status === 1)
                            <span class="badge badge-success">{{ __('main.active') }}</span>
                        @else
                            <span class="badge badge-danger">{{ __('main.inactive') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-users"></i> {{ __('main.students_list') }}
                <span class="badge badge-primary ml-2">{{ $section->students->count() }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('main.student_code') }}</th>
                            <th>{{ __('main.name') }}</th>
                            <th>{{ __('main.processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($section->students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge badge-secondary">{{ $student->student_code }}</span></td>
                            <td>{{ $student->user->name }}</td>
                            <td>
                                <a href="{{ route('teacher.students.show', $student->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">{{ __('main.no_data') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
