@extends('layouts.master')
@section('title', __('main.edit_online_class'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.online-classes.index') }}">{{ __('main.online_classes') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_online_class') }}</li>
@endsection

@section('content')
<div class="card card-info card-outline shadow">
    <div class="card-header">
        <h3 class="card-title text-info font-weight-bold">
            <i class="fa fa-edit"></i> {{ __('main.edit_online_class') }}
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.online-classes.update', $onlineClass->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('main.online_class_title_ar') }} <span class="text-danger">*</span></label>
                    <input type="text" name="title[ar]" value="{{ old('title.ar', $onlineClass->getTranslation('title', 'ar')) }}"
                           class="form-control @error('title.ar') is-invalid @enderror">
                    @error('title.ar')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ __('main.online_class_title_en') }} <span class="text-danger">*</span></label>
                    <input type="text" name="title[en]" value="{{ old('title.en', $onlineClass->getTranslation('title', 'en')) }}"
                           class="form-control @error('title.en') is-invalid @enderror">
                    @error('title.en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.grade') }} <span class="text-danger">*</span></label>
                    <select name="grade_id" id="grade_id" class="form-control select2 @error('grade_id') is-invalid @enderror">
                        <option value="" disabled>{{ __('main.choose') }}</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id', $onlineClass->grade_id) == $grade->id ? 'selected' : '' }}>
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
                        <option value="" disabled>{{ __('main.choose') }}</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ old('classroom_id', $onlineClass->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.subject') }}</label>
                    <select name="subject_id" class="form-control select2 @error('subject_id') is-invalid @enderror">
                        <option value="">{{ __('main.choose') }}</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $onlineClass->subject_id) == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Meeting Type --}}
            <div class="form-group">
                <label>{{ __('main.meeting_type') }} <span class="text-danger">*</span></label>
                <div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="type_zoom" name="type" value="zoom" class="custom-control-input"
                               {{ old('type', $onlineClass->type ?? 'zoom') === 'zoom' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="type_zoom">
                            <i class="fa fa-video text-primary"></i> {{ __('main.zoom_meeting') }}
                        </label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="type_manual" name="type" value="manual" class="custom-control-input"
                               {{ old('type', $onlineClass->type ?? 'zoom') === 'manual' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="type_manual">
                            <i class="fa fa-link text-success"></i> {{ __('main.manual_meeting') }}
                        </label>
                    </div>
                </div>
                @error('type')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div id="manual_join_url_wrapper" class="form-group"
                 style="{{ old('type', $onlineClass->type ?? 'zoom') === 'manual' ? '' : 'display:none;' }}">
                <label>{{ __('main.manual_join_url') }} <span class="text-danger">*</span></label>
                <input type="url" name="join_url" value="{{ old('join_url', $onlineClass->join_url) }}"
                       placeholder="https://meet.google.com/..."
                       class="form-control @error('join_url') is-invalid @enderror">
                @error('join_url')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.teacher') }} <span class="text-danger">*</span></label>
                    <select name="teacher_id" class="form-control select2 @error('teacher_id') is-invalid @enderror">
                        <option value="" disabled>{{ __('main.choose') }}</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $onlineClass->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->full_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.start_at') }} <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="start_at"
                           value="{{ old('start_at', $onlineClass->start_at->format('Y-m-d\TH:i')) }}"
                           class="form-control @error('start_at') is-invalid @enderror">
                    @error('start_at')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ __('main.duration') }} ({{ __('main.minutes') }}) <span class="text-danger">*</span></label>
                    <input type="number" name="duration" value="{{ old('duration', $onlineClass->duration) }}" min="15" max="480"
                           class="form-control @error('duration') is-invalid @enderror">
                    @error('duration')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ __('main.status') }} <span class="text-danger">*</span></label>
                    <select name="status" class="form-control select2 @error('status') is-invalid @enderror">
                        <option value="scheduled" {{ old('status', $onlineClass->status) == 'scheduled' ? 'selected' : '' }}>{{ __('main.online_class_status_scheduled') }}</option>
                        <option value="ongoing" {{ old('status', $onlineClass->status) == 'ongoing' ? 'selected' : '' }}>{{ __('main.online_class_status_ongoing') }}</option>
                        <option value="ended" {{ old('status', $onlineClass->status) == 'ended' ? 'selected' : '' }}>{{ __('main.online_class_status_ended') }}</option>
                    </select>
                    @error('status')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>{{ __('main.description') }}</label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $onlineClass->description) }}</textarea>
                @error('description')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-info btn-lg px-5 shadow">{{ __('main.update') }}</button>
            <a href="{{ route('admin.online-classes.index') }}" class="btn btn-secondary btn-lg px-4">{{ __('main.back') }}</a>
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
                        $('#classroom_id').trigger('change');
                    },
                });
            }
        });

        $('input[name="type"]').on('change', function() {
            if ($(this).val() === 'manual') {
                $('#manual_join_url_wrapper').show();
            } else {
                $('#manual_join_url_wrapper').hide();
            }
        });
    });
</script>
@endsection
