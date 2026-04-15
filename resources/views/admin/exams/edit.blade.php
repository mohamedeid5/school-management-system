@extends('layouts.master')
@section('title', __('main.edit_exam'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.exams.index') }}">{{ __('main.exams') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_exam') }}</li>
@endsection

@section('content')
<div class="card card-primary card-outline shadow">
    <div class="card-header">
        <h3 class="card-title text-primary font-weight-bold">
            <i class="fa fa-edit"></i> {{ __('main.edit_exam') }}
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.exams.update', $exam) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('main.exam_name_ar') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name[ar]" value="{{ old('name.ar', $exam->getTranslation('name', 'ar')) }}"
                           class="form-control @error('name.ar') is-invalid @enderror">
                    @error('name.ar')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ __('main.exam_name_en') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name[en]" value="{{ old('name.en', $exam->getTranslation('name', 'en')) }}"
                           class="form-control @error('name.en') is-invalid @enderror">
                    @error('name.en')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.exam_type') }} <span class="text-danger">*</span></label>
                    <select name="type" class="form-control select2 @error('type') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        <option value="quiz" @selected(old('type', $exam->type) == 'quiz')>{{ __('main.exam_type_quiz') }}</option>
                        <option value="midterm" @selected(old('type', $exam->type) == 'midterm')>{{ __('main.exam_type_midterm') }}</option>
                        <option value="final" @selected(old('type', $exam->type) == 'final')>{{ __('main.exam_type_final') }}</option>
                        <option value="assignment" @selected(old('type', $exam->type) == 'assignment')>{{ __('main.exam_type_assignment') }}</option>
                    </select>
                    @error('type')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.exam_date') }} <span class="text-danger">*</span></label>
                    <input type="date" name="exam_date" value="{{ old('exam_date', $exam->exam_date) }}"
                           class="form-control @error('exam_date') is-invalid @enderror">
                    @error('exam_date')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.max_score') }} <span class="text-danger">*</span></label>
                    <input type="number" name="max_score" value="{{ old('max_score', $exam->max_score) }}" min="1" max="9999" step="0.01"
                           class="form-control @error('max_score') is-invalid @enderror">
                    @error('max_score')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.academic_year') }} <span class="text-danger">*</span></label>
                    <input type="text" name="academic_year" value="{{ old('academic_year', $exam->academic_year) }}" placeholder="2025-2026"
                           class="form-control @error('academic_year') is-invalid @enderror">
                    @error('academic_year')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.term') }} <span class="text-danger">*</span></label>
                    <select name="term" class="form-control select2 @error('term') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        <option value="1" @selected(old('term', $exam->term) == 1)>{{ __('main.term_1') }}</option>
                        <option value="2" @selected(old('term', $exam->term) == 2)>{{ __('main.term_2') }}</option>
                        <option value="3" @selected(old('term', $exam->term) == 3)>{{ __('main.term_3') }}</option>
                    </select>
                    @error('term')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.grade') }} <span class="text-danger">*</span></label>
                    <select name="grade_id" id="grade_id" class="form-control select2 @error('grade_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" @selected(old('grade_id', $exam->grade_id) == $grade->id)>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('grade_id')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.classroom') }} <span class="text-danger">*</span></label>
                    <select name="classroom_id" id="classroom_id" class="form-control select2 @error('classroom_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" @selected(old('classroom_id', $exam->classroom_id) == $classroom->id)>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('classroom_id')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.subject') }} <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-control select2 @error('subject_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" @selected(old('subject_id', $exam->subject_id) == $subject->id)>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary btn-lg px-5 shadow">{{ __('main.update') }}</button>
            <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary btn-lg px-4">{{ __('main.back') }}</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#grade_id').on('change', function() {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ url(app()->getLocale() . '/get-classrooms') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var selected = "{{ old('classroom_id', $exam->classroom_id) }}";
                        $('#classroom_id').empty().append('<option selected disabled>{{ __('main.choose') }}</option>');
                        $.each(data, function(key, value) {
                            var opt = '<option value="' + key + '"' + (key == selected ? ' selected' : '') + '>' + value + '</option>';
                            $('#classroom_id').append(opt);
                        });
                        $('#classroom_id').trigger('change');
                    },
                });
            }
        });
    });
</script>
@endsection
