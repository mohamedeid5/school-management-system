@extends('layouts.master')
@section('title', __('main.edit_question'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">{{ __('main.questions') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_question') }}</li>
@endsection

@section('content')
<div class="card card-primary card-outline shadow">
    <div class="card-header">
        <h3 class="card-title text-primary font-weight-bold">
            <i class="fa fa-edit"></i> {{ __('main.edit_question') }}
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.questions.update', $question) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('main.question_ar') }} <span class="text-danger">*</span></label>
                    <textarea name="question[ar]" rows="3"
                              class="form-control @error('question.ar') is-invalid @enderror">{{ old('question.ar', $question->getTranslation('question', 'ar')) }}</textarea>
                    @error('question.ar')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ __('main.question_en') }} <span class="text-danger">*</span></label>
                    <textarea name="question[en]" rows="3"
                              class="form-control @error('question.en') is-invalid @enderror">{{ old('question.en', $question->getTranslation('question', 'en')) }}</textarea>
                    @error('question.en')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.exam') }} <span class="text-danger">*</span></label>
                    <select name="exam_id" class="form-control select2 @error('exam_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}" @selected(old('exam_id', $question->exam_id) == $exam->id)>
                                {{ $exam->name }} — {{ $exam->grade->name }} / {{ $exam->classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('exam_id')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.question_type') }} <span class="text-danger">*</span></label>
                    <select name="type" id="question_type" class="form-control select2 @error('type') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        <option value="multiple_choice" @selected(old('type', $question->type) == 'multiple_choice')>{{ __('main.question_type_multiple_choice') }}</option>
                        <option value="true_false" @selected(old('type', $question->type) == 'true_false')>{{ __('main.question_type_true_false') }}</option>
                        <option value="short_answer" @selected(old('type', $question->type) == 'short_answer')>{{ __('main.question_type_short_answer') }}</option>
                    </select>
                    @error('type')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.marks') }} <span class="text-danger">*</span></label>
                    <input type="number" name="marks" value="{{ old('marks', $question->marks) }}" min="0.5" max="9999" step="0.5"
                           class="form-control @error('marks') is-invalid @enderror">
                    @error('marks')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Multiple Choice Options --}}
            <div id="options_section" style="display:none;">
                <hr>
                <h6 class="font-weight-bold text-primary">{{ __('main.answer_options') }}</h6>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{ __('main.option_a') }} <span class="text-danger">*</span></label>
                        <input type="text" name="option_a" value="{{ old('option_a', $question->option_a) }}"
                               class="form-control @error('option_a') is-invalid @enderror">
                        @error('option_a')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('main.option_b') }} <span class="text-danger">*</span></label>
                        <input type="text" name="option_b" value="{{ old('option_b', $question->option_b) }}"
                               class="form-control @error('option_b') is-invalid @enderror">
                        @error('option_b')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('main.option_c') }}</label>
                        <input type="text" name="option_c" value="{{ old('option_c', $question->option_c) }}"
                               class="form-control @error('option_c') is-invalid @enderror">
                        @error('option_c')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('main.option_d') }}</label>
                        <input type="text" name="option_d" value="{{ old('option_d', $question->option_d) }}"
                               class="form-control @error('option_d') is-invalid @enderror">
                        @error('option_d')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{ __('main.correct_answer') }} <span class="text-danger">*</span></label>
                        <select name="correct_answer" id="mc_correct_answer" class="form-control @error('correct_answer') is-invalid @enderror">
                            <option value="" selected disabled>{{ __('main.choose') }}</option>
                            <option value="a" @selected(old('correct_answer', $question->correct_answer) == 'a')>{{ __('main.option_a') }}</option>
                            <option value="b" @selected(old('correct_answer', $question->correct_answer) == 'b')>{{ __('main.option_b') }}</option>
                            <option value="c" @selected(old('correct_answer', $question->correct_answer) == 'c')>{{ __('main.option_c') }}</option>
                            <option value="d" @selected(old('correct_answer', $question->correct_answer) == 'd')>{{ __('main.option_d') }}</option>
                        </select>
                        @error('correct_answer')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- True / False --}}
            <div id="tf_section" style="display:none;">
                <hr>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>{{ __('main.correct_answer') }} <span class="text-danger">*</span></label>
                        <select name="correct_answer" id="tf_correct_answer" class="form-control @error('correct_answer') is-invalid @enderror">
                            <option value="" selected disabled>{{ __('main.choose') }}</option>
                            <option value="true" @selected(old('correct_answer', $question->correct_answer) == 'true')>{{ __('main.true') }}</option>
                            <option value="false" @selected(old('correct_answer', $question->correct_answer) == 'false')>{{ __('main.false') }}</option>
                        </select>
                        @error('correct_answer')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Short Answer --}}
            <div id="sa_section" style="display:none;">
                <hr>
                <div class="form-group">
                    <label>{{ __('main.correct_answer') }}</label>
                    <input type="text" name="correct_answer" id="sa_correct_answer" value="{{ old('correct_answer', $question->correct_answer) }}"
                           class="form-control @error('correct_answer') is-invalid @enderror">
                    @error('correct_answer')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary btn-lg px-5 shadow">{{ __('main.update') }}</button>
            <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary btn-lg px-4">{{ __('main.back') }}</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var initialType = '{{ old('type', $question->type) }}';
        if (initialType) toggleSections(initialType);

        $('#question_type').on('change', function () {
            toggleSections($(this).val());
        });

        function toggleSections(type) {
            $('#options_section, #tf_section, #sa_section').hide();
            $('#mc_correct_answer, #tf_correct_answer, #sa_correct_answer').prop('disabled', true);

            if (type === 'multiple_choice') {
                $('#options_section').show();
                $('#mc_correct_answer').prop('disabled', false);
            } else if (type === 'true_false') {
                $('#tf_section').show();
                $('#tf_correct_answer').prop('disabled', false);
            } else if (type === 'short_answer') {
                $('#sa_section').show();
                $('#sa_correct_answer').prop('disabled', false);
            }
        }
    });
</script>
@endsection
