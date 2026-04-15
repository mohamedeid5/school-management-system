@extends('layouts.master')
@section('title', __('main.students'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.students') }}</li>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold text-primary">
                <i class="fa fa-user-graduate mr-1"></i> {{ __('main.students_list') }}
            </h3>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('main.student_code') }}</th>
                        <th>{{ __('main.name') }}</th>
                        <th>{{ __('main.gender') }}</th>
                        <th>{{ __('main.grade') }}</th>
                        <th>{{ __('main.classroom') }}</th>
                        <th>{{ __('main.section') }}</th>
                        <th>{{ __('main.academic_year') }}</th>
                        <th>{{ __('main.processes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge badge-secondary px-2 py-1">{{ $student->student_code }}</span></td>
                        <td class="text-left">
                            <div class="font-weight-bold">{{ $student->user->name }}</div>
                            <small class="text-muted">{{ $student->user->email }}</small>
                        </td>
                        <td>{{ $student->gender->value == 'male' ? __('main.male') : __('main.female') }}</td>
                        <td>{{ $student->grade->name }}</td>
                        <td>{{ $student->classroom->name }}</td>
                        <td>{{ $student->section->name }}</td>
                        <td><span class="text-primary font-weight-bold">{{ $student->academic_year }}</span></td>
                        <td>
                            <a href="{{ route('teacher.students.show', $student->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">{{ __('main.no_data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
