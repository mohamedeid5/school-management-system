@extends('layouts.master')
@section('title', __('main.record_attendance'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('attendances.index') }}">{{ __('main.attendances') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.record_attendance') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <h5 class="text-secondary font-weight-bold mb-3">
        <i class="fas fa-calendar-alt"></i> تاريخ اليوم: <span class="text-danger">{{ date('Y-m-d') }}</span>
    </h5>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <h5><i class="icon fas fa-ban"></i> فيه مشكلة يا هندسة!</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <input type="hidden" name="attendance_date" value="{{ date('Y-m-d') }}">
        <div class="card card-success card-outline shadow">
            <div class="card-header">
                <h3 class="card-title text-success font-weight-bold">كشف حضور الطلاب</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr class="bg-light">
                                <th>#</th>
                                <th>اسم الطالب</th>
                                <th>الصف الدراسي</th>
                                <th>المرحلة الدراسية</th>
                                <th>الفصل</th>
                                <th>الحالة (حاضر / غائب)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-weight-bold">{{ $student->user->name }}</td>
                                <td>{{ $student->grade->name }}</td>
                                <td>{{ $student->classroom->name }}</td>
                                <td>{{ $student->section->name }}</td>
                                <td>
                                    @php
                                        $attendance = $student->attendances->first();
                                    @endphp
                                    <div class="d-flex justify-content-center">
                                        <label class="mr-2 text-success">
                                            <input type="radio" name="attendance_status[{{ $student->id }}]" value="present"
                                              @checked($attendance ? $attendance->attendance_status->value == 'present' : true)> حاضر
                                        </label>
                                        <label class="mr-2 text-danger">
                                            <input type="radio" name="attendance_status[{{ $student->id }}]" value="absent"
                                             @if($attendance)
                                                @checked($attendance && $attendance->attendance_status->value == 'absent')
                                            @endif
                                            > غائب
                                        </label>
                                        <label class="mr-2 text-warning">
                                            <input type="radio" name="attendance_status[{{ $student->id }}]" value="late"
                                              @checked($attendance && $attendance->attendance_status->value == 'late')> متأخر
                                        </label>
                                    </div>

                                    <input type="hidden" name="student_ids[]" value="{{ $student->id }}">
                                    <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                    <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                                    <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-right mt-3">
                    <button class="btn btn-success btn-lg shadow" type="submit">
                        <i class="fa fa-save"></i> حفظ كشف الحضور
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
