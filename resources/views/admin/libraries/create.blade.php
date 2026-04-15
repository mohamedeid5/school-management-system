@extends('layouts.master')
@section('title', __('main.add_library'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.libraries.index') }}">{{ __('main.libraries') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.add_library') }}</li>
@endsection

@section('content')
<div class="card card-success card-outline shadow">
    <div class="card-header">
        <h3 class="card-title text-success font-weight-bold">
            <i class="fa fa-plus"></i> {{ __('main.add_library') }}
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.libraries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('main.title') }} <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ __('main.file') }} <span class="text-danger">*</span></label>
                    <input type="file" name="file_path"
                           class="form-control @error('file_path') is-invalid @enderror">
                    @error('file_path')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
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

                <div class="col-md-3 form-group">
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

                <div class="col-md-3 form-group">
                    <label>{{ __('main.section') }} <span class="text-danger">*</span></label>
                    <select name="section_id" id="section_id" class="form-control select2 @error('section_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @if($errors->any())
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('section_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 form-group">
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
            <a href="{{ route('admin.libraries.index') }}" class="btn btn-secondary btn-lg px-4">{{ __('main.back') }}</a>
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
                        $('#section_id').empty().append('<option selected disabled>{{ __('main.choose') }}</option>');
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
                        $('#section_id').empty().append('<option selected disabled>{{ __('main.choose') }}</option>');
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
