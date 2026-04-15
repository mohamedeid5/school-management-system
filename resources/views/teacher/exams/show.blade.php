@extends('layouts.master')
@section('title', __('main.show_exam'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher.exams.index') }}">{{ __('main.exams') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.show_exam') }}</li>
@endsection

@section('content')
<div class="container-fluid">

    {{-- Exam Info Card --}}
    <div class="card card-primary card-outline shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-file-alt"></i> {{ $exam->name }}
            </h3>
            <div>
                <a href="{{ route('teacher.questions.create') }}" class="btn btn-success btn-sm shadow-sm">
                    <i class="fa fa-plus"></i> {{ __('main.add_question') }}
                </a>
                <a href="{{ route('teacher.exams.edit', $exam) }}" class="btn btn-info btn-sm shadow-sm">
                    <i class="fa fa-edit"></i> {{ __('main.edit_exam') }}
                </a>
                <a href="{{ route('teacher.exams.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                    <i class="fa fa-arrow-left"></i> {{ __('main.back') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-2">
                    <span class="text-muted small">{{ __('main.exam_type') }}</span>
                    <div class="font-weight-bold">
                        @php
                            $typeColors = ['quiz' => 'primary', 'midterm' => 'warning', 'final' => 'danger', 'assignment' => 'success'];
                            $color = $typeColors[$exam->type->value] ?? 'secondary';
                        @endphp
                        <span class="badge badge-{{ $color }}">{{ __('main.exam_type_' . $exam->type->value) }}</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <span class="text-muted small">{{ __('main.subject') }}</span>
                    <div class="font-weight-bold">{{ $exam->subject->name ?? '-' }}</div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <span class="text-muted small">{{ __('main.grade') }} / {{ __('main.classroom') }}</span>
                    <div class="font-weight-bold">{{ $exam->grade->name ?? '-' }} / {{ $exam->classroom->name ?? '-' }}</div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <span class="text-muted small">{{ __('main.academic_year') }}</span>
                    <div class="font-weight-bold">{{ $exam->academic_year }}</div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <span class="text-muted small">{{ __('main.term') }}</span>
                    <div class="font-weight-bold">{{ __('main.term_' . $exam->term) }}</div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <span class="text-muted small">{{ __('main.exam_date') }}</span>
                    <div class="font-weight-bold">{{ $exam->exam_date }}</div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <span class="text-muted small">{{ __('main.max_score') }}</span>
                    <div class="font-weight-bold">
                        <span class="badge badge-success">{{ $exam->max_score }}</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-2">
                    <span class="text-muted small">{{ __('main.questions') }}</span>
                    <div class="font-weight-bold">
                        <span class="badge badge-dark">{{ $exam->questions->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Questions Card --}}
    <div class="card card-primary card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-question-circle"></i> {{ __('main.exam_questions') }}
            </h3>
        </div>
        <div class="card-body p-0">
            @forelse($exam->questions as $question)
            <div class="p-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex align-items-start">
                        <span class="badge badge-dark mr-2 mt-1">{{ $loop->iteration }}</span>
                        <div>
                            <span class="font-weight-bold">{{ $question->question }}</span>
                            <div class="mt-1">
                                @php
                                    $typeColors = ['multiple_choice' => 'primary', 'true_false' => 'warning', 'short_answer' => 'info'];
                                    $color = $typeColors[$question->type] ?? 'secondary';
                                @endphp
                                <span class="badge badge-{{ $color }} mr-1">{{ __('main.question_type_' . $question->type) }}</span>
                                <span class="badge badge-success">{{ __('main.marks') }}: {{ $question->marks }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <a href="{{ route('teacher.questions.edit', $question->id) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete_question{{ $question->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>

                @if($question->type === 'multiple_choice')
                <div class="row mt-2 ml-3">
                    @foreach(['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d] as $key => $option)
                    @if($option)
                    <div class="col-md-6 mb-1">
                        <span class="badge badge-{{ $question->correct_answer === $key ? 'success' : 'light border' }} mr-1">
                            {{ strtoupper($key) }}
                        </span>
                        <span class="{{ $question->correct_answer === $key ? 'text-success font-weight-bold' : '' }}">
                            {{ $option }}
                        </span>
                        @if($question->correct_answer === $key)
                            <i class="fa fa-check text-success ml-1"></i>
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>
                @elseif($question->type === 'true_false')
                <div class="mt-2 ml-3">
                    <span class="text-muted small">{{ __('main.correct_answer') }}: </span>
                    <span class="badge badge-{{ $question->correct_answer === 'true' ? 'success' : 'danger' }}">
                        {{ $question->correct_answer === 'true' ? __('main.true') : __('main.false') }}
                    </span>
                </div>
                @else
                <div class="mt-2 ml-3">
                    <span class="text-muted small">{{ __('main.correct_answer') }}: </span>
                    <span class="text-dark">{{ $question->correct_answer }}</span>
                </div>
                @endif
            </div>

            {{-- Delete Modal --}}
            <div class="modal fade" id="delete_question{{ $question->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">{{ __('main.delete_question') }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('teacher.questions.destroy', $question->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <div class="modal-body">
                                <h5 class="text-center">{{ __('main.warning_question') }}</h5>
                                <p class="text-center text-danger font-weight-bold">{{ Str::limit($question->question, 80) }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                                <button type="submit" class="btn btn-danger">{{ __('main.confirm_delete') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @empty
            <div class="text-center text-muted py-5">
                <i class="fa fa-question-circle fa-3x mb-3"></i>
                <p>{{ __('main.no_questions') }}</p>
                <a href="{{ route('teacher.questions.create') }}" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> {{ __('main.add_question') }}
                </a>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
