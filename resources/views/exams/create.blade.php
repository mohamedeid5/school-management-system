@extends('layouts.master')
@section('title', __('main.add_exam'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('exams.index') }}">{{ __('main.exams') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.add_exam') }}</li>
@endsection

@section('content')
<div class="card card-success card-outline shadow">
    <div class="card-header">
        <h3 class="card-title text-success font-weight-bold">
            <i class="fa fa-plus"></i> {{ __('main.add_exam') }}
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('exams.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('main.exam_name_ar') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name[ar]" value="{{ old('name.ar') }}"
                           class="form-control @error('name.ar') is-invalid @enderror">
                    @error('name.ar')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ __('main.exam_name_en') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name[en]" value="{{ old('name.en') }}"
                           class="form-control @error('name.en') is-invalid @enderror">
                    @error('name.en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.exam_type') }} <span class="text-danger">*</span></label>
                    <select name="type" class="form-control select2 @error('type') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        <option value="quiz" {{ old('type') == 'quiz' ? 'selected' : '' }}>{{ __('main.exam_type_quiz') }}</option>
                        <option value="midterm" {{ old('type') == 'midterm' ? 'selected' : '' }}>{{ __('main.exam_type_midterm') }}</option>
                        <option value="final" {{ old('type') == 'final' ? 'selected' : '' }}>{{ __('main.exam_type_final') }}</option>
                        <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>{{ __('main.exam_type_other') }}</option>
                    </select>
                    @error('type')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.exam_date') }} <span class="text-danger">*</span></label>
                    <input type="date" name="exam_date" value="{{ old('exam_date') }}"
                           class="form-control @error('exam_date') is-invalid @enderror">
                    @error('exam_date')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.max_score') }} <span class="text-danger">*</span></label>
                    <input type="number" name="max_score" value="{{ old('max_score', 100) }}" min="1" max="9999" step="0.01"
                           class="form-control @error('max_score') is-invalid @enderror">
                    @error('max_score')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.grade') }} <span class="text-danger">*</span></label>
                    <select name="grade_id" id="grade_id" class="form-control select2 @error('grade_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('grade_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.classroom') }} <span class="text-danger">*</span></label>
                    <select name="classroom_id" id="classroom_id" class="form-control select2 @error('classroom_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @if($errors->any())
                            @foreach($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                    {{ $classroom->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('classroom_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.subject') }} <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-control select2 @error('subject_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>{{ __('main.description') }}</label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-success btn-lg px-5 shadow">{{ __('main.save') }}</button>
            <a href="{{ route('exams.index') }}" class="btn btn-secondary btn-lg px-4">{{ __('main.back') }}</a>
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
                        $('#classroom_id').empty().append('<option selected disabled>{{ __('main.choose') }}</option>');
                        $.each(data, function(key, value) {
                            $('#classroom_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#classroom_id').trigger('change');
                    },
                });
            }
        });
    });
</script>
@endsection
