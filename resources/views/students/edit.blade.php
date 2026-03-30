@extends('layouts.master')
@section('title', __('main.edit_student'))

@section('css')
{{-- مكتبة Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* تحسين شكل Select2 ليناسب قالب AdminLTE أو Bootstrap */
    .select2-container .select2-selection--single { height: 38px !important; border: 1px solid #ced4da !important; }
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 36px !important; }
    .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 35px !important; padding-right: 12px; }
</style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">{{ __('main.students') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_student') }}</li>
@endsection

@section('content')
<div class="card card-success shadow-sm">
    <div class="card-header">
        <h3 class="card-title">{{ __('main.personal_information') }}</h3>
    </div>

    <form action="{{ route('students.update', $student->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label>{{ __('main.student_name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $student->user->name) }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label>{{ __('main.email') }} <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $student->user->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label>{{ __('main.password') }}</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{ __('main.leave_blank_to_keep_current') }}">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label>{{ __('main.gender') }}</label>
                    <select name="gender" class="form-control select2">
                        <option value="male" @selected(old('gender', $student->gender->value) == 'male')>{{ __('main.male') }}</option>
                        <option value="female" @selected(old('gender', $student->gender->value) == 'female')>{{ __('main.female') }}</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>{{ __('main.nationality') }} <span class="text-danger">*</span></label>
                    <select name="nationality_id" class="form-control select2 @error('nationality_id') is-invalid @enderror">
                        @foreach($nationalities as $nationality)
                            <option value="{{ $nationality->id }}" @selected(old('nationality_id', $student->nationality_id) == $nationality->id)>
                                {{ $nationality->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('nationality_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label>{{ __('main.blood_type') }} <span class="text-danger">*</span></label>
                    <select name="blood_type_id" class="form-control select2 @error('blood_type_id') is-invalid @enderror">
                        @foreach($bloodTypes as $blood_type)
                            <option value="{{ $blood_type->id }}" @selected(old('blood_type_id', $student->blood_type_id) == $blood_type->id)>
                                {{ $blood_type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('blood_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label>{{ __('main.date_of_birth') }}</label>
                    <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                           value="{{ old('date_of_birth', $student->date_of_birth->format('Y-m-d')) }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label>{{ __('main.parent') }} <span class="text-danger">*</span></label>
                    <select name="parent_id" class="form-control select2 @error('parent_id') is-invalid @enderror">
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" @selected(old('parent_id', $student->parent_id) == $parent->id)>
                                {{ $parent->name_father }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <hr class="mt-4 mb-4">
            <h3 class="text-primary mb-3">{{ __('main.academic_information') }}</h3>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label>{{ __('main.grade') }}</label>
                    <select name="grade_id" class="form-control select2 @error('grade_id') is-invalid @enderror" id="grade_select">
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}"
                                @selected(session()->hasOldInput() ? old('grade_id') == $grade->id : $student->grade_id == $grade->id) >
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('grade_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label>{{ __('main.classroom') }}</label>
                    <select name="classroom_id" class="form-control select2 @error('classroom_id') is-invalid @enderror" id="classroom_select">
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}"
                                @selected(old('classroom_id') == $student->classroom_id) >
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('classroom_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label>{{ __('main.section') }}</label>
                    <select name="section_id" class="form-control select2 @error('section_id') is-invalid @enderror" id="section_select">
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}"
                                @selected(old('section_id') == $student->section_id) >
                                {{ $section->name }} - {{ $section->classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('section_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>{{ __('main.academic_year') }} <span class="text-danger">*</span></label>
                    <select name="academic_year" class="form-control select2 @error('academic_year') is-invalid @enderror">
                        @php $current_year = date('Y'); @endphp
                        @for($year=$current_year - 1; $year<=$current_year + 1; $year++)
                            @php $year_val = $year . '/' . ($year + 1); @endphp
                            <option value="{{ $year_val }}" @selected(old('academic_year', $student->academic_year) == $year_val)>
                                {{ $year_val }}
                            </option>
                        @endfor
                    </select>
                    @error('academic_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label>{{ __('main.joining_date') }}</label>
                    <input type="date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror"
                           value="{{ old('joining_date', $student->joining_date->format('Y-m-d')) }}">
                    @error('joining_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success">{{ __('main.update') }}</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">{{ __('main.cancel') }}</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            dir: "rtl",
            width: '100%',
            placeholder: "اختر...",
            allowClear: true
        });

        $('#grade_select').on('change', function() {
            var grade_id = $(this).val();
            $('#classroom_select').val(null).trigger('change');
            $('#section_select').val(null).trigger('change');

            if (grade_id) {
                $.ajax({
                    url: "{{ url(app()->getLocale() . '/get-classrooms') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#classroom_select').empty().append('<option value="">اختر الصف...</option>');
                        $.each(data, function(key, value) {
                            $('#classroom_select').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#classroom_select').trigger('change');
                    },
                });
            }
        });

        $('#classroom_select').on('change', function() {
            var classroom_id = $(this).val();
            $('#section_select').empty().append('<option value="">اختر القسم...</option>');
            $('#section_select').trigger('change');

            if (classroom_id) {
                $.ajax({
                    url: "{{ url(app()->getLocale() . '/get-sections') }}/" + classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#section_select').empty().append('<option value="" selected disabled>اختر القسم...</option>');
                        $.each(data, function(key, value) {
                            $('#section_select').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('#section_select').trigger('change');
                    },
                });
            }
        });
    });
</script>
@endsection
