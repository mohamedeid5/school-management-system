@extends('layouts.master')
@section('title', __('main.add_graduation'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <div class="card-header">
                    <h3 class="card-title text-success font-weight-bold">
                        <i class="fa fa-user-graduate"></i> {{ __('main.add_new_graduation') }}
                    </h3>
                </div>
                <div class="card-body">
                    @if (session('error_graduations'))
                        <div class="alert alert-danger shadow-sm">
                            <i class="fa fa-exclamation-circle"></i> {{ session('error_graduations') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('graduations.store') }}">
                        @csrf
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label>{{ __('main.grade') }}</label>
                                <select class="form-control @error('grade_id') is-invalid @enderror" name="grade_id" id="grade_id">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" @selected(old('grade_id') == $grade->id)>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>


                            <div class="form-group col-md-4">
                                <label>{{ __('main.classroom') }}</label>
                                <select class="form-control @error('classroom_id') is-invalid @enderror" name="classroom_id" id="classroom_id">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @if($errors->any())
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}" @selected(old('classroom_id') == $classroom->id)>{{ $classroom->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('classroom_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label>{{ __('main.section') }}</label>
                                <select class="form-control @error('section_id') is-invalid @enderror" name="section_id" id="section_id">
                                    <option value="" selected disabled>{{ __('main.choose') }}...</option>
                                    @if($errors->any())
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}" @selected(old('section_id') == $section->id)>{{ $section->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('section_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-success btn-lg shadow">
                                <i class="fa fa-graduation-cap mr-1"></i> {{ __('main.confirm_graduation') }}
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
<script>
    $(document).ready(function() {
        $('#grade_id').on('change', function() {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ url(app()->getLocale() . '/get-classrooms') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#classroom_id').empty().append('<option selected disabled>{{ __("main.choose") }}...</option>');
                        $.each(data, function(key, value) {
                            $('#classroom_id').append('<option value="' + key + '">' + value + '</option>');
                        });
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
                        $('#section_id').empty().append('<option selected disabled>{{ __("main.choose") }}...</option>');
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
