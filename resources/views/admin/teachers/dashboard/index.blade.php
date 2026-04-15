@extends('layouts.master')
@section('title', __('main.teacher_dashboard'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
@endsection

@section('content')

    {{-- Welcome Banner --}}
    <div class="row mb-30">
        <div class="col-12">
            <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border:none;">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-white">
                            <h4 class="mb-1">
                                <i class="fa fa-chalkboard-teacher mr-2"></i>
                                {{ __('main.welcome_teacher') }}, {{ auth()->user()->name }}
                            </h4>
                            <p class="mb-0 opacity-75">
                                @if($teacher && $teacher->specialization)
                                    <i class="fa fa-graduation-cap mr-1"></i>
                                    {{ $teacher->specialization->name ?? '' }}
                                    &nbsp;&bull;&nbsp;
                                @endif
                                <i class="fa fa-calendar mr-1"></i>
                                {{ now()->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                        <div class="text-white text-right d-none d-md-block">
                            <i class="fa fa-school" style="font-size: 4rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 1: Main Stats --}}
    <div class="row">
        {{-- My Sections --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                <i class="fa fa-layer-group highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.my_sections') }}</p>
                            <h4>{{ number_format($sectionsCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.sections.index') }}" class="text-muted">{{ __('main.sections_list') }}</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- My Students --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fa fa-user-graduate highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.my_students') }}</p>
                            <h4>{{ number_format($studentsCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.students.index') }}" class="text-muted">{{ __('main.students_list') }}</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Online Classes --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                                <i class="fa fa-video highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.my_online_classes') }}</p>
                            <h4>{{ number_format($onlineClassCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.online-classes.create') }}" class="text-muted">{{ __('main.add_online_class') }}</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Exams --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-danger">
                                <i class="fa fa-file-alt highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.my_exams') }}</p>
                            <h4>{{ number_format($examsCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.exams.index') }}" class="text-muted">{{ __('main.exams_list') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 2: Attendance Today --}}
    <div class="row">
        {{-- Attendance Numbers --}}
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa fa-calendar-check mr-1 text-primary"></i>
                        {{ __('main.attendance_today') }} — {{ now()->format('d M Y') }}
                    </h5>
                    <div class="row text-center mt-3">
                        <div class="col-6 mb-3">
                            <div class="p-3 rounded" style="background:#e8f5e9;">
                                <h3 class="text-success mb-0">{{ $todayPresent }}</h3>
                                <small class="text-muted">{{ __('main.present_today') }}</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-3 rounded" style="background:#fce4ec;">
                                <h3 class="text-danger mb-0">{{ $todayAbsent }}</h3>
                                <small class="text-muted">{{ __('main.absent_today') }}</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background:#fff8e1;">
                                <h3 class="text-warning mb-0">{{ $todayLate }}</h3>
                                <small class="text-muted">{{ __('main.late_today') }}</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background:#e3f2fd;">
                                <h3 class="text-info mb-0">{{ $todayExcused }}</h3>
                                <small class="text-muted">{{ __('main.excused_today') }}</small>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{ route('admin.attendances.create') }}" class="text-muted">
                            <i class="fa fa-plus mr-1"></i>{{ __('main.attendances') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Attendance Progress Bars --}}
        <div class="col-xl-8 col-lg-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa fa-chart-bar mr-1 text-primary"></i>
                        {{ __('main.students_in_sections') }}
                    </h5>
                    @php
                        $todayTotal  = $todayPresent + $todayAbsent + $todayLate + $todayExcused;
                        $presentPct  = $todayTotal > 0 ? round(($todayPresent / $todayTotal) * 100) : 0;
                        $absentPct   = $todayTotal > 0 ? round(($todayAbsent  / $todayTotal) * 100) : 0;
                        $latePct     = $todayTotal > 0 ? round(($todayLate    / $todayTotal) * 100) : 0;
                        $excusedPct  = $todayTotal > 0 ? round(($todayExcused / $todayTotal) * 100) : 0;
                    @endphp

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-success"><i class="fa fa-user-check mr-1"></i>{{ __('main.present_today') }}</span>
                            <span class="font-weight-bold">{{ $todayPresent }} ({{ $presentPct }}%)</span>
                        </div>
                        <div class="progress" style="height:10px; border-radius:5px;">
                            <div class="progress-bar bg-success" style="width:{{ $presentPct }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-danger"><i class="fa fa-user-times mr-1"></i>{{ __('main.absent_today') }}</span>
                            <span class="font-weight-bold">{{ $todayAbsent }} ({{ $absentPct }}%)</span>
                        </div>
                        <div class="progress" style="height:10px; border-radius:5px;">
                            <div class="progress-bar bg-danger" style="width:{{ $absentPct }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-warning"><i class="fa fa-clock mr-1"></i>{{ __('main.late_today') }}</span>
                            <span class="font-weight-bold">{{ $todayLate }} ({{ $latePct }}%)</span>
                        </div>
                        <div class="progress" style="height:10px; border-radius:5px;">
                            <div class="progress-bar bg-warning" style="width:{{ $latePct }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-info"><i class="fa fa-user-shield mr-1"></i>{{ __('main.excused_today') }}</span>
                            <span class="font-weight-bold">{{ $todayExcused }} ({{ $excusedPct }}%)</span>
                        </div>
                        <div class="progress" style="height:10px; border-radius:5px;">
                            <div class="progress-bar bg-info" style="width:{{ $excusedPct }}%"></div>
                        </div>
                    </div>

                    @if($todayTotal === 0)
                        <p class="text-muted text-center mt-3">
                            <i class="fa fa-info-circle mr-1"></i>{{ __('main.no_data') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Row 3: My Sections + Recent Students --}}
    <div class="row">
        {{-- My Sections Table --}}
        <div class="col-xl-5 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">
                            <i class="fa fa-layer-group mr-1 text-primary"></i>
                            {{ __('main.my_sections') }}
                        </h5>
                        <span class="badge badge-primary">{{ $sectionsCount }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.section') }}</th>
                                    <th>{{ __('main.classroom') }}</th>
                                    <th>{{ __('main.grade') }}</th>
                                    <th class="text-center">{{ __('main.students_count') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mySections as $section)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="font-weight-bold">{{ $section->name }}</span></td>
                                        <td>{{ $section->classroom?->name ?? '—' }}</td>
                                        <td>{{ $section->grade?->name ?? '—' }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-success">{{ $section->students_count }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">
                                            <i class="fa fa-inbox mr-1"></i>{{ __('main.no_data') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Students --}}
        <div class="col-xl-7 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">
                            <i class="fa fa-user-graduate mr-1 text-success"></i>
                            {{ __('main.my_students') }}
                        </h5>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-outline-success">
                            {{ __('main.students_list') }}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.student_name') }}</th>
                                    <th>{{ __('main.grade') }}</th>
                                    <th>{{ __('main.classroom') }}</th>
                                    <th>{{ __('main.section') }}</th>
                                    <th>{{ __('main.student_code') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentStudents as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('admin.students.show', $student) }}" class="text-dark font-weight-bold">
                                                {{ $student->user?->name ?? '—' }}
                                            </a>
                                        </td>
                                        <td>{{ $student->grade?->name ?? '—' }}</td>
                                        <td>{{ $student->classroom?->name ?? '—' }}</td>
                                        <td>{{ $student->section?->name ?? '—' }}</td>
                                        <td><span class="badge badge-secondary">{{ $student->student_code }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">
                                            <i class="fa fa-inbox mr-1"></i>{{ __('main.no_data') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 4: My Online Classes --}}
    <div class="row">
        <div class="col-12 mb-30">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">
                            <i class="fa fa-video mr-1 text-warning"></i>
                            {{ __('main.my_online_classes') }}
                        </h5>
                        <div>
                            <a href="{{ route('admin.online-classes.create') }}" class="btn btn-sm btn-warning mr-2">
                                <i class="fa fa-plus mr-1"></i>{{ __('main.add_online_class') }}
                            </a>
                            <a href="{{ route('admin.online-classes.index') }}" class="btn btn-sm btn-outline-warning">
                                {{ __('main.online_classes_list') }}
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.online_class') }}</th>
                                    <th>{{ __('main.subjects') }}</th>
                                    <th>{{ __('main.grade') }}</th>
                                    <th>{{ __('main.classroom') }}</th>
                                    <th>{{ __('main.start_at') ?? 'Start At' }}</th>
                                    <th class="text-center">{{ __('main.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOnlineClasses as $class)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $class->title }}</td>
                                        <td>{{ $class->subject?->name ?? '—' }}</td>
                                        <td>{{ $class->grade?->name ?? '—' }}</td>
                                        <td>{{ $class->classroom?->name ?? '—' }}</td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $class->start_at ? $class->start_at->format('d M Y, H:i') : '—' }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = match($class->status) {
                                                    'ongoing'   => 'badge-success',
                                                    'scheduled' => 'badge-primary',
                                                    'ended'     => 'badge-secondary',
                                                    default     => 'badge-light',
                                                };
                                                $statusLabel = match($class->status) {
                                                    'ongoing'   => __('main.online_class_status_ongoing'),
                                                    'scheduled' => __('main.online_class_status_scheduled'),
                                                    'ended'     => __('main.online_class_status_ended'),
                                                    default     => $class->status,
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">
                                            <i class="fa fa-inbox mr-1"></i>{{ __('main.no_data') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
