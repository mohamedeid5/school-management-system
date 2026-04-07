@extends('layouts.master')
@section('title', __('main.add_subject'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('subjects.index') }}">{{ __('main.subjects') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.add_subject') }}</li>
@endsection

@section('content')
<div class="card card-success card-outline shadow">
    <div class="card-header">
        <h3 class="card-title text-success font-weight-bold">
            <i class="fa fa-plus"></i> {{ __('main.add_subject') }}
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('main.subject_name_ar') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name[ar]" value="{{ old('name.ar') }}"
                           class="form-control @error('name.ar') is-invalid @enderror">
                    @error('name.ar')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('main.subject_name_en') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name[en]" value="{{ old('name.en') }}"
                           class="form-control @error('name.en') is-invalid @enderror">
                    @error('name.en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ __('main.code') }} <small class="text-muted">({{ __('main.choose') }})</small></label>
                    <input type="text" name="code" value="{{ old('code') }}"
                           class="form-control @error('code') is-invalid @enderror" placeholder="MATH-101">
                    @error('code')
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
                    <label>{{ __('main.teacher') }} <span class="text-danger">*</span></label>
                    <select name="teacher_id" class="form-control select2 @error('teacher_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-lg px-5 shadow">{{ __('main.save') }}</button>
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-lg px-4">{{ __('main.back') }}</a>
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
