@extends('layouts.master')
@section('title', __('main.exams'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.exams') }}</li>
@endsection

@section('content')

@forelse($children as $child)
    <div class="row mb-30">
        <div class="col-12">
            <div class="card card-statistics shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                        <i class="fa fa-user-graduate mr-2 text-primary"></i>
                        <strong>{{ $child->user?->name ?? __('main.no_data') }}</strong>
                        <span class="badge badge-secondary ml-2">{{ $child->student_code }}</span>
                    </h5>
                    <span class="badge badge-primary">
                        {{ $child->count() }} {{ __('main.exams') }}
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('main.name') }}</th>
                                    <th>{{ __('main.subject') }}</th>
                                    <th>{{ __('main.exam_type') }}</th>
                                    <th>{{ __('main.term') }}</th>
                                    <th>{{ __('main.exam_date') }}</th>
                                    <th class="text-center">{{ __('main.max_score') }}</th>
                                    <th>{{ __('main.teacher') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($child->exams as $exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $exam->name }}</td>
                                        <td>{{ $exam->subject?->name ?? '—' }}</td>
                                        <td>
                                            @php
                                                $typeClass = match($exam->type?->value ?? '') {
                                                    'quiz'       => 'badge-info',
                                                    'midterm'    => 'badge-warning',
                                                    'final'      => 'badge-danger',
                                                    'assignment' => 'badge-secondary',
                                                    default      => 'badge-light',
                                                };
                                            @endphp
                                            <span class="badge {{ $typeClass }}">
                                                {{ $exam->type?->label() ?? '—' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($exam->term)
                                                <span class="badge badge-outline-primary">
                                                    {{ __('main.term_' . $exam->term) }}
                                                </span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-primary font-weight-bold">
                                                {{ $exam->exam_date ? \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') : '—' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-primary">{{ $exam->max_score ?? '—' }}</span>
                                        </td>
                                        <td>
                                            @if($exam->teacher?->user)
                                                <i class="fa fa-chalkboard-teacher mr-1 text-muted"></i>
                                                {{ $exam->teacher->user->name }}
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
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

@empty
    <div class="row">
        <div class="col-12">
            <div class="card card-statistics">
                <div class="card-body text-center py-5">
                    <i class="fa fa-child fa-3x text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">{{ __('main.no_data') }}</h5>
                </div>
            </div>
        </div>
    </div>
@endforelse

@endsection
