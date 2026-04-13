@extends('layouts.master')
@section('title', __('main.student_dashboard'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
@endsection

@section('content')

    {{-- Welcome Banner --}}
    <div class="row mb-30">
        <div class="col-12">
            <div class="card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border:none;">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-white">
                            <h4 class="mb-1">
                                <i class="fa fa-user-graduate mr-2"></i>
                                {{ __('main.welcome_student') }}, {{ auth()->user()->name }}
                            </h4>
                            <p class="mb-0" style="opacity:.85;">
                                @if($student->grade)
                                    <i class="fa fa-layer-group mr-1"></i>{{ $student->grade->name }}
                                @endif
                                @if($student->classroom)
                                    &nbsp;&bull;&nbsp;<i class="fa fa-door-open mr-1"></i>{{ $student->classroom->name }}
                                @endif
                                @if($student->section)
                                    &nbsp;&bull;&nbsp;<i class="fa fa-list mr-1"></i>{{ $student->section->name }}
                                @endif
                                &nbsp;&bull;&nbsp;<i class="fa fa-calendar mr-1"></i>{{ now()->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                        <div class="text-white text-right d-none d-md-block">
                            <i class="fa fa-graduation-cap" style="font-size: 4rem; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 1: Stats Cards --}}
    <div class="row">
        {{-- Subjects --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                <i class="fa fa-book highlight-icon"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.my_subjects') }}</p>
                            <h4>{{ number_format($subjects->count()) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1"></i>
                        <a href="{{ route('subjects.index') }}" class="text-muted">{{ __('main.subjects') }}</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Upcoming Exams --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-danger">
                                <i class="fa fa-file-alt highlight-icon"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.upcoming_exams') }}</p>
                            <h4>{{ number_format($upcomingExams->count()) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1"></i>
                        <a href="{{ route('exams.index') }}" class="text-muted">{{ __('main.exams_list') }}</a>
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
                                <i class="fa fa-video highlight-icon"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.my_online_classes') }}</p>
                            <h4>{{ number_format($onlineClasses->count()) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1"></i>
                        <a href="{{ route('online-classes.index') }}" class="text-muted">{{ __('main.online_classes_list') }}</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Attendance --}}
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fa fa-calendar-check highlight-icon"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.my_attendance') }}</p>
                            <h4>{{ number_format($totalPresent + $totalAbsent + $totalLate + $totalExcused) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-check-circle mr-1 text-success"></i>
                        <span class="text-success">{{ $totalPresent }}</span>
                        &nbsp;/&nbsp;
                        <i class="fa fa-times-circle mr-1 text-danger"></i>
                        <span class="text-danger">{{ $totalAbsent }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 2: Attendance Summary + Student Info --}}
    <div class="row">
        {{-- Attendance Summary --}}
        <div class="col-xl-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa fa-chart-bar mr-1 text-primary"></i>
                        {{ __('main.my_attendance') }}
                    </h5>
                    @php
                        $total      = $totalPresent + $totalAbsent + $totalLate + $totalExcused;
                        $presentPct = $total > 0 ? round(($totalPresent / $total) * 100) : 0;
                        $absentPct  = $total > 0 ? round(($totalAbsent  / $total) * 100) : 0;
                        $latePct    = $total > 0 ? round(($totalLate    / $total) * 100) : 0;
                        $excusedPct = $total > 0 ? round(($totalExcused / $total) * 100) : 0;
                    @endphp

                    <div class="row text-center mb-3">
                        <div class="col-6 col-md-3 mb-2">
                            <div class="p-3 rounded" style="background:#e8f5e9;">
                                <h3 class="text-success mb-0">{{ $totalPresent }}</h3>
                                <small class="text-muted">{{ __('main.total_present') }}</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-2">
                            <div class="p-3 rounded" style="background:#fce4ec;">
                                <h3 class="text-danger mb-0">{{ $totalAbsent }}</h3>
                                <small class="text-muted">{{ __('main.total_absent') }}</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-2">
                            <div class="p-3 rounded" style="background:#fff8e1;">
                                <h3 class="text-warning mb-0">{{ $totalLate }}</h3>
                                <small class="text-muted">{{ __('main.total_late') }}</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-2">
                            <div class="p-3 rounded" style="background:#e3f2fd;">
                                <h3 class="text-info mb-0">{{ $totalExcused }}</h3>
                                <small class="text-muted">{{ __('main.total_excused') }}</small>
                            </div>
                        </div>
                    </div>

                    @if($total > 0)
                        <div class="mb-2">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-success"><i class="fa fa-user-check mr-1"></i>{{ __('main.present_today') }}</span>
                                <span class="font-weight-bold">{{ $presentPct }}%</span>
                            </div>
                            <div class="progress" style="height:8px; border-radius:5px;">
                                <div class="progress-bar bg-success" style="width:{{ $presentPct }}%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-danger"><i class="fa fa-user-times mr-1"></i>{{ __('main.absent_today') }}</span>
                                <span class="font-weight-bold">{{ $absentPct }}%</span>
                            </div>
                            <div class="progress" style="height:8px; border-radius:5px;">
                                <div class="progress-bar bg-danger" style="width:{{ $absentPct }}%"></div>
                            </div>
                        </div>
                    @else
                        <p class="text-muted text-center mt-3">
                            <i class="fa fa-info-circle mr-1"></i>{{ __('main.no_data') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Student Info --}}
        <div class="col-xl-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa fa-id-card mr-1 text-primary"></i>
                        {{ __('main.student_info') }}
                    </h5>
                    <table class="table table-sm table-borderless mt-2">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width:40%"><i class="fa fa-hashtag mr-1"></i>{{ __('main.student_code') }}</td>
                                <td><span class="badge badge-secondary">{{ $student->student_code ?? '—' }}</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="fa fa-layer-group mr-1"></i>{{ __('main.grade') }}</td>
                                <td class="font-weight-bold">{{ $student->grade?->name ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="fa fa-door-open mr-1"></i>{{ __('main.classroom') }}</td>
                                <td class="font-weight-bold">{{ $student->classroom?->name ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="fa fa-list mr-1"></i>{{ __('main.section') }}</td>
                                <td class="font-weight-bold">{{ $student->section?->name ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="fa fa-calendar mr-1"></i>{{ __('main.joining_date') }}</td>
                                <td>{{ $student->joining_date?->format('d M Y') ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="fa fa-birthday-cake mr-1"></i>{{ __('main.date_of_birth') }}</td>
                                <td>{{ $student->date_of_birth?->format('d M Y') ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="fa fa-venus-mars mr-1"></i>{{ __('main.gender') }}</td>
                                <td>{{ $student->gender?->label() ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><i class="fa fa-flag mr-1"></i>{{ __('main.nationality') }}</td>
                                <td>{{ $student->nationality?->name ?? '—' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 3: My Subjects --}}
    <div class="row">
        <div class="col-12 mb-30">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">
                            <i class="fa fa-book mr-1 text-primary"></i>
                            {{ __('main.my_subjects') }}
                        </h5>
                        <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-outline-primary">
                            {{ __('main.subjects') }}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.code') }}</th>
                                    <th>{{ __('main.name') }}</th>
                                    <th>{{ __('main.teacher') }}</th>
                                    <th>{{ __('main.description') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $subject)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="badge badge-info">{{ $subject->code ?? '—' }}</span></td>
                                        <td class="font-weight-bold">{{ $subject->name }}</td>
                                        <td>
                                            @if($subject->teacher?->user)
                                                <i class="fa fa-chalkboard-teacher mr-1 text-muted"></i>
                                                {{ $subject->teacher->user->name }}
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td><small class="text-muted">{{ $subject->description ?? '—' }}</small></td>
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
    </div>

    {{-- Row 4: Upcoming Exams + Recent Attendance --}}
    <div class="row">
        {{-- Upcoming Exams --}}
        <div class="col-xl-7 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">
                            <i class="fa fa-file-alt mr-1 text-danger"></i>
                            {{ __('main.upcoming_exams') }}
                        </h5>
                        <a href="{{ route('exams.index') }}" class="btn btn-sm btn-outline-danger">
                            {{ __('main.exams_list') }}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.name') }}</th>
                                    <th>{{ __('main.subjects') }}</th>
                                    <th>{{ __('main.exam_date') }}</th>
                                    <th class="text-center">{{ __('main.max_score') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($upcomingExams as $exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $exam->name }}</td>
                                        <td>{{ $exam->subject?->name ?? '—' }}</td>
                                        <td>
                                            <span class="text-primary font-weight-bold">
                                                {{ $exam->exam_date ? \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') : '—' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-primary">{{ $exam->max_score ?? '—' }}</span>
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

        {{-- Recent Attendance --}}
        <div class="col-xl-5 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fa fa-calendar-check mr-1 text-success"></i>
                        {{ __('main.attendance_history') }}
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('main.date') }}</th>
                                    <th class="text-center">{{ __('main.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAttendances as $att)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($att->attendance_date)->format('d M Y') }}</td>
                                        <td class="text-center">
                                            @php
                                                $attVal = $att->attendance_status->value;
                                                $statusClass = match($attVal) {
                                                    'present'  => 'badge-success',
                                                    'absent'   => 'badge-danger',
                                                    'late'     => 'badge-warning',
                                                    'excused'  => 'badge-info',
                                                    default    => 'badge-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $att->attendance_status->color() }}">
                                                {{ $att->attendance_status->label() }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-3">
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

    {{-- Row 5: Online Classes --}}
    <div class="row">
        <div class="col-xl-7 mb-30">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">
                            <i class="fa fa-video mr-1 text-warning"></i>
                            {{ __('main.my_online_classes') }}
                        </h5>
                        <a href="{{ route('online-classes.index') }}" class="btn btn-sm btn-outline-warning">
                            {{ __('main.online_classes_list') }}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.online_class') }}</th>
                                    <th>{{ __('main.subjects') }}</th>
                                    <th>{{ __('main.start_at') ?? 'Start At' }}</th>
                                    <th class="text-center">{{ __('main.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($onlineClasses as $class)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $class->title }}</td>
                                        <td>{{ $class->subject?->name ?? '—' }}</td>
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

        {{-- Fee Invoices --}}
        <div class="col-xl-5 mb-30">
            <div class="card card-statistics">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fa fa-file-invoice-dollar mr-1 text-info"></i>
                        {{ __('main.my_fee_invoices') }}
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('main.fee') }}</th>
                                    <th class="text-right">{{ __('main.amount') }}</th>
                                    <th>{{ __('main.date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($feeInvoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->fee?->name ?? '—' }}</td>
                                        <td class="text-right font-weight-bold text-danger">
                                            {{ number_format($invoice->amount, 2) }}
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $invoice->invoice_date ? \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') : '—' }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">
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
