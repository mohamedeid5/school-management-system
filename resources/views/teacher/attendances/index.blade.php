@extends('layouts.master')
@section('title', __('main.attendances'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.attendances') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-chalkboard-teacher"></i> {{ __('main.attendances') }}
            </h3>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionGrades">
                @forelse($grades as $grade)
                    <div class="card mb-2 shadow-sm">
                        <div class="card-header bg-light" id="heading{{ $grade->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-right font-weight-bold text-dark"
                                        type="button" data-toggle="collapse"
                                        data-target="#collapse{{ $grade->id }}">
                                    <i class="fa fa-graduation-cap ml-2"></i> {{ $grade->name }}
                                </button>
                            </h2>
                        </div>
                        <div id="collapse{{ $grade->id }}" class="collapse" data-parent="#accordionGrades">
                            <div class="card-body">
                                <table class="table table-hover table-sm text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('main.section') }}</th>
                                            <th>{{ __('main.classroom') }}</th>
                                            <th>{{ __('main.processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grade->sections as $section)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $section->name }}</td>
                                            <td>{{ $section->classroom->name }}</td>
                                            <td>
                                                <a href="{{ route('teacher.attendances.show', $section->id) }}"
                                                   class="btn btn-success btn-sm shadow-sm">
                                                    <i class="fa fa-check-square"></i> {{ __('main.record_attendance') }}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">{{ __('main.no_data') }}</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
