@extends('layouts.master')
@section('title', __('main.dashboard'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
@endsection

@section('content')

    {{-- Row 1: Main Stats --}}
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                <i class="fa fa-user-graduate highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.students') }}</p>
                            <h4>{{ number_format($studentsCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-calendar mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.students.index') }}" class="text-muted">{{ __('main.students_list') }}</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fa fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.teachers') }}</p>
                            <h4>{{ number_format($teachersCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.teachers.index') }}" class="text-muted">{{ __('main.teachers_list') }}</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                                <i class="fa fa-school highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.classrooms') }}</p>
                            <h4>{{ number_format($classroomsCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.classrooms.index') }}" class="text-muted">{{ __('main.classrooms_list') }}</a>
                    </p>
                </div>
            </div>
        </div>

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
                            <p class="card-text text-dark">{{ __('main.exams') }}</p>
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

    {{-- Row 2: Secondary Stats --}}
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fa fa-user-check highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.present_today') ?? 'Present Today' }}</p>
                            <h4>{{ number_format($todayPresent) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-calendar-day mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.attendances.index') }}" class="text-muted">{{ __('main.attendances') }}</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-danger">
                                <i class="fa fa-user-times highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.absent_today') ?? 'Absent Today' }}</p>
                            <h4>{{ number_format($todayAbsent) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-calendar-day mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.attendances.index') }}" class="text-muted">{{ __('main.attendances') }}</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-info">
                                <i class="fa fa-book highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.library') }}</p>
                            <h4>{{ number_format($libraryCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.libraries.index') }}" class="text-muted">{{ __('main.libraries_list') }}</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                <i class="fa fa-video highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('main.online_classes') }}</p>
                            <h4>{{ number_format($onlineClassCount) }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-list mr-1" aria-hidden="true"></i>
                        <a href="{{ route('admin.online-classes.index') }}" class="text-muted">{{ __('main.online_classes_list') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 3: Finance Summary + Today's Attendance Breakdown --}}
    <div class="row">
        {{-- Finance Cards --}}
        <div class="col-xl-4 col-lg-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ __('main.fees') ?? 'Fees' }}</h5>
                    <div class="row mt-3">
                        <div class="col-6 text-center border-right">
                            <p class="text-muted mb-1">{{ __('main.fee_invoices') ?? 'Total Invoiced' }}</p>
                            <h4 class="text-warning">{{ number_format($totalInvoices, 2) }}</h4>
                        </div>
                        <div class="col-6 text-center">
                            <p class="text-muted mb-1">{{ __('main.payment_students') ?? 'Total Collected' }}</p>
                            <h4 class="text-success">{{ number_format($totalPayments, 2) }}</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <p class="text-muted mb-1">{{ __('main.balance') ?? 'Outstanding Balance' }}</p>
                        <h4 class="text-danger">{{ number_format($totalInvoices - $totalPayments, 2) }}</h4>
                    </div>
                    <p class="text-muted pt-2 mb-0 mt-2 border-top">
                        <a href="{{ route('admin.fee-invoices.index') }}" class="text-muted">
                            <i class="fa fa-list mr-1"></i>{{ __('main.fee_invoices') ?? 'View Invoices' }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Today's Attendance Breakdown --}}
        <div class="col-xl-8 col-lg-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ __('main.attendances') }} — {{ now()->format('d M Y') }}</h5>
                    @php
                        $todayTotal = $todayPresent + $todayAbsent + $todayLate + $todayExcused;
                        $presentPct = $todayTotal > 0 ? round(($todayPresent / $todayTotal) * 100) : 0;
                        $absentPct  = $todayTotal > 0 ? round(($todayAbsent  / $todayTotal) * 100) : 0;
                        $latePct    = $todayTotal > 0 ? round(($todayLate    / $todayTotal) * 100) : 0;
                        $excusedPct = $todayTotal > 0 ? round(($todayExcused / $todayTotal) * 100) : 0;
                    @endphp
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <h4 class="text-success">{{ $todayPresent }}</h4>
                            <small class="text-muted">Present</small>
                        </div>
                        <div class="col-3">
                            <h4 class="text-danger">{{ $todayAbsent }}</h4>
                            <small class="text-muted">Absent</small>
                        </div>
                        <div class="col-3">
                            <h4 class="text-warning">{{ $todayLate }}</h4>
                            <small class="text-muted">Late</small>
                        </div>
                        <div class="col-3">
                            <h4 class="text-info">{{ $todayExcused }}</h4>
                            <small class="text-muted">Excused</small>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Present</small><small>{{ $presentPct }}%</small>
                        </div>
                        <div class="progress" style="height:8px">
                            <div class="progress-bar bg-success" style="width:{{ $presentPct }}%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Absent</small><small>{{ $absentPct }}%</small>
                        </div>
                        <div class="progress" style="height:8px">
                            <div class="progress-bar bg-danger" style="width:{{ $absentPct }}%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Late</small><small>{{ $latePct }}%</small>
                        </div>
                        <div class="progress" style="height:8px">
                            <div class="progress-bar bg-warning" style="width:{{ $latePct }}%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Excused</small><small>{{ $excusedPct }}%</small>
                        </div>
                        <div class="progress" style="height:8px">
                            <div class="progress-bar bg-info" style="width:{{ $excusedPct }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 4: Recent Students + Recent Invoices --}}
    <div class="row">
        {{-- Recent Students --}}
        <div class="col-xl-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">{{ __('main.students') }} — {{ __('main.add_new') ?? 'Recent' }}</h5>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-outline-primary">{{ __('main.students_list') }}</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.student_name') }}</th>
                                    <th>{{ __('main.grade') }}</th>
                                    <th>{{ __('main.classroom') }}</th>
                                    <th>{{ __('main.student_code') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentStudents as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->user?->name ?? '—' }}</td>
                                        <td>{{ $student->grade?->name ?? '—' }}</td>
                                        <td>{{ $student->classroom?->name ?? '—' }}</td>
                                        <td><span class="badge badge-secondary">{{ $student->student_code }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">{{ __('main.no_data') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Fee Invoices --}}
        <div class="col-xl-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">{{ __('main.fee_invoices') ?? 'Recent Invoices' }}</h5>
                        <a href="{{ route('admin.fee-invoices.index') }}" class="btn btn-sm btn-outline-warning">{{ __('main.view') ?? 'View All' }}</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.student_name') }}</th>
                                    <th>{{ __('main.fees') ?? 'Fee' }}</th>
                                    <th>{{ __('main.amount') ?? 'Amount' }}</th>
                                    <th>{{ __('main.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentInvoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->student?->user?->name ?? '—' }}</td>
                                        <td>{{ $invoice->fee?->name ?? '—' }}</td>
                                        <td><span class="text-success font-weight-bold">{{ number_format($invoice->amount, 2) }}</span></td>
                                        <td><small class="text-muted">{{ $invoice->created_at->format('d M Y') }}</small></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">{{ __('main.no_data') }}</td>
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
