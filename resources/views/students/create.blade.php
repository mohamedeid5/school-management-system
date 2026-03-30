@extends('layouts.master')
@section('title', __('main.add_student'))

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single { height: 38px !important; border: 1px solid #ced4da !important; }
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 36px !important; }
    .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 35px !important; }
</style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">{{ __('main.students') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.add_student') }}</li>
@endsection

@section('content')
<div class="card card-primary shadow-sm">
    <div class="card-header">
        <h3 class="card-title">{{ __('main.personal_information') }}</h3>
    </div>
    <form action="{{ route('students.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            {{-- الصف الأول: الحساب --}}
            <div class="row">
                <div class="col-md-4">
                    <label>{{ __('main.student_name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label>{{ __('main.email') }} <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label>{{ __('main.password') }} <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- الصف الثاني: البيانات الشخصية --}}
            <div class="row mt-3">
                <div class="col-md-3">
                    <label>{{ __('main.gender') }}</label>
                    <select name="gender" class="form-control select2">
                        <option value="male" @selected(old('gender') == 'male')>{{ __('main.male') }}</option>
                        <option value="female" @selected(old('gender') == 'female')>{{ __('main.female') }}</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>{{ __('main.nationality') }} <span class="text-danger">*</span></label>
                    <select name="nationality_id" class="form-control select2 @error('nationality_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}...</option>
                        @foreach($nationalities as $nationality)
                            <option value="{{ $nationality->id }}" @selected(old('nationality_id') == $nationality->id)>{{ $nationality->name }}</option>
                        @endforeach
                    </select>
                    @error('nationality_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label>{{ __('main.blood_type') }} <span class="text-danger">*</span></label>
                    <select name="blood_type_id" class="form-control select2 @error('blood_type_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}...</option>
                        @foreach($bloodTypes as $type)
                            <option value="{{ $type->id }}" @selected(old('blood_type_id') == $type->id)>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('blood_type_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label>{{ __('main.date_of_birth') }}</label>
                    <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <label>{{ __('main.parent') }} <span class="text-danger">*</span></label>
                    <select name="parent_id" class="form-control select2">
                        <option value="" selected disabled>{{ __('main.choose') }}...</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" @selected(old('parent_id') == $parent->id)>{{ $parent->name_father }}</option>
                        @endforeach
                    </select>
                    @error('parent_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            <hr class="mt-4 mb-4">
            <h3 class="text-primary mb-3">{{ __('main.academic_information') }}</h3>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label>{{ __('main.grade') }} <span class="text-danger">*</span></label>
                    <select name="grade_id" class="form-control select2 @error('grade_id') is-invalid @enderror" id="grade_select">
                        <option value="" selected disabled>{{ __('main.choose') }}...</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" @selected(old('grade_id') == $grade->id)>{{ $grade->name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label>{{ __('main.classroom') }} <span class="text-danger">*</span></label>
                    <select name="classroom_id" class="form-control select2 @error('classroom_id') is-invalid @enderror" id="classroom_select">
                        <option value="" selected disabled>{{ __('main.choose') }}...</option>
                        @if($errors->any())
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" @selected(old('classroom_id') == $classroom->id)>{{ $classroom->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('classroom_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label>{{ __('main.section') }} <span class="text-danger">*</span></label>
                    <select name="section_id" class="form-control select2 @error('section_id') is-invalid @enderror" id="section_select">
                        <option value="" selected disabled>{{ __('main.choose') }}...</option>
                        @if($errors->any())
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}" @selected(old('section_id') == $section->id)>{{ $section->name }} - {{ $section->classroom->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('section_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>{{ __('main.academic_year') }} <span class="text-danger">*</span></label>
                    <select name="academic_year" class="form-control select2 @error('academic_year') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}...</option>
                        @php $current_year = date('Y'); @endphp
                        @for($year=$current_year; $year<=$current_year +1; $year++)
                            <option value="{{ $year }}" @selected(old('academic_year') == $year)>{{ $year }}</option>
                        @endfor
                    </select>
                    @error('academic_year') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label>{{ __('main.joining_date') }}</label>
                    <input type="date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" value="{{ old('joining_date', date('Y-m-d')) }}">
                    @error('joining_date') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ __('main.save') }}</button>
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
            if (grade_id) {
                $.ajax({
                    url: "{{ url(app()->getLocale() . '/get-classrooms') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#classroom_select').empty().append('<option selected disabled>اختر الصف...</option>');
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
            if (classroom_id) {
                $.ajax({
                    url: "{{ url(app()->getLocale() . '/get-sections') }}/" + classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#section_select').empty().append('<option selected disabled>اختر القسم...</option>');
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
