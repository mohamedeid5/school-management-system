@extends('layouts.master')
@section('title', __('main.attendances'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.my_attendance') }}</li>
@endsection

@section('content')

{{-- Summary Cards --}}
<div class="row">
    <div class="col-xl-3 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <span class="text-success"><i class="fa fa-check-circle highlight-icon"></i></span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">{{ __('main.total_present') }}</p>
                        <h4>{{ $totalPresent }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <span class="text-danger"><i class="fa fa-times-circle highlight-icon"></i></span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">{{ __('main.total_absent') }}</p>
                        <h4>{{ $totalAbsent }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <span class="text-warning"><i class="fa fa-clock highlight-icon"></i></span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">{{ __('main.total_late') }}</p>
                        <h4>{{ $totalLate }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <span class="text-info"><i class="fa fa-info-circle highlight-icon"></i></span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">{{ __('main.total_excused') }}</p>
                        <h4>{{ $totalExcused }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Attendance Records --}}
<div class="row">
    <div class="col-12 mb-30">
        <div class="card card-statistics">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-calendar-check mr-1 text-primary"></i>
                    {{ __('main.attendance_history') }}
                </h5>

                @php
                    $total = $totalPresent + $totalAbsent + $totalLate + $totalExcused;
                    $presentPct = $total > 0 ? round(($totalPresent / $total) * 100) : 0;
                @endphp

                @if($total > 0)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-success"><i class="fa fa-user-check mr-1"></i>{{ __('main.total_present') }}</span>
                            <span class="font-weight-bold">{{ $presentPct }}%</span>
                        </div>
                        <div class="progress" style="height:10px; border-radius:5px;">
                            <div class="progress-bar bg-success" style="width:{{ $presentPct }}%"></div>
                        </div>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('main.date') }}</th>
                                <th class="text-center">{{ __('main.status') }}</th>
                                <th>{{ __('main.notes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $att)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($att->attendance_date)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $att->attendance_status->color() }}">
                                            {{ $att->attendance_status->label() }}
                                        </span>
                                    </td>
                                    <td><small class="text-muted">{{ $att->notes ?? '—' }}</small></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                                        {{ __('main.no_data') }}
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
