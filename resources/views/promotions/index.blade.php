@extends('layouts.master')
@section('title', __('main.students_promotion'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow-sm">
                <div class="card-header">
                    <h3 class="card-title text-primary font-weight-bold">
                        <i class="fa fa-graduation-cap"></i> {{ __('main.students_promotion') }}
                    </h3>
                </div>
                <div class="card-body">
                    {{-- عرض الأخطاء إن وجدت --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('promotions.store') }}">
                        @csrf
                        {{-- الجزء الأول: من أين (الحالي) --}}
                        <h5 class="text-danger font-weight-bold mb-3 border-bottom pb-2">{{ __('main.old_grade') }}</h5>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>{{ __('main.grade') }}</label>
                                <select class="form-control" name="from_grade_id" id="from_grade">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" @selected(old('from_grade_id') == $grade->id)>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ __('main.classroom') }}</label>
                                <select class="form-control" name="from_classroom_id" id="from_classroom">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @if($errors->any())
                                        @foreach ($from_classrooms as $classroom)
                                            <option value="{{ $classroom->id }}" @selected(old('from_classroom_id') == $classroom->id)>{{ $classroom->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ __('main.section') }}</label>
                                <select class="form-control" name="from_section_id" id="from_section">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @if($errors->any())
                                        @foreach ($from_sections as $section)
                                            <option value="{{ $section->id }}" @selected(old('from_section_id') == $section->id)>{{ $section->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ __('main.academic_year') }}</label>
                                <select class="form-control" name="academic_year">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @php $current_year = date("Y"); @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <br>

                        <h5 class="text-success font-weight-bold mb-3 border-bottom pb-2">{{ __('main.new_grade') }}</h5>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>{{ __('main.grade') }}</label>
                                <select class="form-control" name="to_grade_id" id="to_grade">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" @selected(old('to_grade_id') == $grade->id)>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ __('main.classroom') }}</label>
                                <select class="form-control" name="to_classroom_id" id="to_classroom">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @if($errors->any())
                                        @foreach ($to_classrooms as $classroom)
                                            <option value="{{ $classroom->id }}" @selected(old('to_classroom_id') == $classroom->id)>{{ $classroom->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ __('main.section') }}</label>
                                <select class="form-control" name="to_section_id" id="to_section">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @if($errors->any())
                                        @foreach ($to_sections as $section)
                                            <option value="{{ $section->id }}" @selected(old('to_section_id') == $section->id)>{{ $section->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{ __('main.academic_year') }}</label>
                                <select class="form-control" name="academic_year_new">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @php $current_year = date("Y"); @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fa fa-paper-plane mr-1"></i> {{ __('main.submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- كود الـ jQuery لهندلة السليكتات الديناميكية (AJAX) --}}
<script>
    $(document).ready(function() {
        // تكرار الميثود لكل سليكت (من وإلى)
        handleGradeChange('from_grade', 'from_classroom', 'from_section');
        handleGradeChange('to_grade', 'to_classroom', 'to_section');

        function handleGradeChange(gradeId, classroomId, sectionId) {
            $(`#${gradeId}`).on('change', function() {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('get-classrooms') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $(`#${classroomId}`).empty();
                            $(`#${classroomId}`).append('<option selected disabled >{{ __("main.choose") }}...</option>');
                            $.each(data, function(key, value) {
                                $(`#${classroomId}`).append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
            });

            $(`#${classroomId}`).on('change', function() {
                var classroom_id = $(this).val();
                if (classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('get-sections') }}/" + classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $(`#${sectionId}`).empty();
                            $.each(data, function(key, value) {
                                $(`#${sectionId}`).append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
            });
        }
    });
</script>
@endsection
