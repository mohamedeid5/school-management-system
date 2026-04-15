@extends('layouts.master')
@section('title', __('main.questions_list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.questions') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-question-circle"></i> {{ __('main.questions_list') }}
            </h3>
            <a href="{{ route('admin.questions.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fa fa-plus"></i> {{ __('main.add_question') }}
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered text-center">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('main.question') }}</th>
                        <th>{{ __('main.exam') }}</th>
                        <th>{{ __('main.question_type') }}</th>
                        <th>{{ __('main.marks') }}</th>
                        <th>{{ __('main.correct_answer') }}</th>
                        <th>{{ __('main.processes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $question)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit($question->question, 60) }}</td>
                        <td>{{ $question->exam->name }}</td>
                        <td>
                            @php
                                $typeColors = ['multiple_choice' => 'primary', 'true_false' => 'warning', 'short_answer' => 'info'];
                                $color = $typeColors[$question->type] ?? 'secondary';
                            @endphp
                            <span class="badge badge-{{ $color }}">{{ __('main.question_type_' . $question->type) }}</span>
                        </td>
                        <td><span class="badge badge-success">{{ $question->marks }}</span></td>
                        <td>
                            @if($question->type === 'multiple_choice')
                                <span class="badge badge-dark">{{ strtoupper($question->correct_answer) }}</span>
                            @elseif($question->type === 'true_false')
                                <span class="badge badge-{{ $question->correct_answer === 'true' ? 'success' : 'danger' }}">
                                    {{ $question->correct_answer === 'true' ? __('main.true') : __('main.false') }}
                                </span>
                            @else
                                <span class="text-muted small">{{ Str::limit($question->correct_answer, 30) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_question{{ $question->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @include('admin.questions.delete_modal')
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">{{ __('main.no_data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
