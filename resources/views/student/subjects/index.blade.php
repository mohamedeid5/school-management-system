@extends('layouts.master')
@section('title', __('main.subjects'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.subjects') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-30">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">
                        <i class="fa fa-book mr-1 text-primary"></i>
                        {{ __('main.my_subjects') }}
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('main.code') }}</th>
                                <th>{{ __('main.name') }}</th>
                                <th>{{ __('main.grade') }}</th>
                                <th>{{ __('main.classroom') }}</th>
                                <th>{{ __('main.teacher') }}</th>
                                <th>{{ __('main.description') }}</th>
                                <th class="text-center">{{ __('main.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subjects as $subject)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-info">{{ $subject->code ?? '—' }}</span></td>
                                    <td class="font-weight-bold">{{ $subject->name }}</td>
                                    <td>{{ $subject->grade?->name ?? '—' }}</td>
                                    <td>{{ $subject->classroom?->name ?? '—' }}</td>
                                    <td>
                                        @if($subject->teacher?->user)
                                            <i class="fa fa-chalkboard-teacher mr-1 text-muted"></i>
                                            {{ $subject->teacher->user->name }}
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td><small class="text-muted">{{ $subject->description ?? '—' }}</small></td>
                                    <td class="text-center">
                                        <a href="{{ route('student.subjects.show', $subject) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-eye mr-1"></i>{{ __('main.show') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
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
