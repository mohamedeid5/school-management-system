@extends('layouts.master')
@section('title', __('main.edit_library'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teacher.libraries.index') }}">{{ __('main.libraries') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_library') }}</li>
@endsection

@section('content')
<div class="card card-info card-outline shadow">
    <div class="card-header">
        <h3 class="card-title text-info font-weight-bold">
            <i class="fa fa-edit"></i> {{ __('main.edit_library') }}
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('teacher.libraries.update', $library->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('main.title') }} <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $library->title) }}"
                           class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ __('main.file') }}</label>
                    <input type="file" name="file_path"
                           class="form-control @error('file_path') is-invalid @enderror">
                    @if($library->attachments->isNotEmpty())
                        <small class="text-muted">{{ __('main.current_file') }}: <a href="{{ $library->attachments->first()->url }}" target="_blank">{{ $library->attachments->first()->file_name }}</a></small>
                    @endif
                    @error('file_path')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    <label>{{ __('main.grade') }} <span class="text-danger">*</span></label>
                    <select name="grade_id" id="grade_id" class="form-control select2 @error('grade_id') is-invalid @enderror">
                        <option value="" disabled>{{ __('main.choose') }}</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id', $library->grade_id) == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('grade_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label>{{ __('main.classroom') }} <span class="text-danger">*</span></label>
                    <select name="classroom_id" id="classroom_id" class="form-control select2 @error('classroom_id') is-invalid @enderror">
                        <option value="" disabled>{{ __('main.choose') }}</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ old('classroom_id', $library->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label>{{ __('main.section') }} <span class="text-danger">*</span></label>
                    <select name="section_id" id="section_id" class="form-control select2 @error('section_id') is-invalid @enderror">
                        <option value="" disabled>{{ __('main.choose') }}</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ old('section_id', $library->section_id) == $section->id ? 'selected' : '' }}>
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('section_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label>{{ __('main.subject') }} <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-control select2 @error('subject_id') is-invalid @enderror">
                        <option value="" disabled>{{ __('main.choose') }}</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $library->subject_id) == $subject->id ? 'selected' : '' }}>
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
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $library->description) }}</textarea>
                @error('description')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-info btn-lg px-5 shadow">{{ __('main.update') }}</button>
            <a href="{{ route('teacher.libraries.index') }}" class="btn btn-secondary btn-lg px-4">{{ __('main.back') }}</a>
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
                        $('#classroom_id').empty().append('<option disabled>{{ __('main.choose') }}</option>');
                        $.each(data, function(key, value) {
                            $('#classroom_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#section_id').empty().append('<option disabled>{{ __('main.choose') }}</option>');
                    },
                });
            }
        });

        $('#classroom_id').on('change', function() {
            var classroom_id = $(this).val();
            if (classroom_id) {
                $.ajax({
                    url: "{{ url(app()->getLocale() . '/get-sections') }}/" + classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#section_id').empty().append('<option disabled>{{ __('main.choose') }}</option>');
                        $.each(data, function(key, value) {
                            $('#section_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
        });
    });
</script>
@endsection
