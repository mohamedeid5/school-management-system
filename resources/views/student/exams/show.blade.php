@extends('layouts.master')
@section('title', $exam->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.exams.index') }}">{{ __('main.exams') }}</a></li>
    <li class="breadcrumb-item active">{{ $exam->name }}</li>
@endsection

@section('content')
<div class="row">
    {{-- Exam Info --}}
    <div class="col-lg-5 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-file-alt mr-1 text-danger"></i>
                    {{ __('main.show_exam') }}
                </h5>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-muted" style="width:40%"><i class="fa fa-heading mr-1"></i>{{ __('main.name') }}</td>
                            <td class="font-weight-bold">{{ $exam->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-book mr-1"></i>{{ __('main.subject') }}</td>
                            <td>{{ $exam->subject?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-tag mr-1"></i>{{ __('main.exam_type') }}</td>
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
                                <span class="badge {{ $typeClass }}">{{ $exam->type?->label() ?? '—' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-list-ol mr-1"></i>{{ __('main.term') }}</td>
                            <td>{{ $exam->term ? __('main.term_' . $exam->term) : '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-calendar mr-1"></i>{{ __('main.exam_date') }}</td>
                            <td class="text-primary font-weight-bold">
                                {{ $exam->exam_date ? \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') : '—' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-star mr-1"></i>{{ __('main.max_score') }}</td>
                            <td><span class="badge badge-primary">{{ $exam->max_score ?? '—' }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-layer-group mr-1"></i>{{ __('main.grade') }}</td>
                            <td>{{ $exam->grade?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-door-open mr-1"></i>{{ __('main.classroom') }}</td>
                            <td>{{ $exam->classroom?->name ?? '—' }}</td>
                        </tr>
                        @if($exam->teacher?->user)
                        <tr>
                            <td class="text-muted"><i class="fa fa-chalkboard-teacher mr-1"></i>{{ __('main.teacher') }}</td>
                            <td>{{ $exam->teacher->user->name }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Questions --}}
    <div class="col-lg-7 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-question-circle mr-1 text-primary"></i>
                    {{ __('main.exam_questions') }}
                    <span class="badge badge-secondary ml-1">{{ $exam->questions->count() }}</span>
                </h5>

                @forelse($exam->questions as $index => $question)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <strong>{{ $index + 1 }}. {{ $question->question }}</strong>
                            <span class="badge badge-info ml-2">{{ $question->marks }} {{ __('main.marks') }}</span>
                        </div>

                        @if($question->type === 'multiple_choice')
                            <div class="row mt-2">
                                @foreach(['a','b','c','d'] as $opt)
                                    @if($question->{'option_' . $opt})
                                        <div class="col-6 mb-1">
                                            <span class="text-muted">{{ strtoupper($opt) }}.</span>
                                            {{ $question->{'option_' . $opt} }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @elseif($question->type === 'true_false')
                            <div class="mt-2">
                                <span class="badge badge-light mr-2">{{ __('main.true') }}</span>
                                <span class="badge badge-light">{{ __('main.false') }}</span>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-muted text-center mt-4">
                        <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                        {{ __('main.no_questions') }}
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-30">
        <a href="{{ route('student.exams.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-1"></i>{{ __('main.back_to_list') }}
        </a>
    </div>
</div>
@endsection
