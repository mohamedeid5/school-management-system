@extends('layouts.master')
@section('title', __('main.edit_fees'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title text-info font-weight-bold">
                        <i class="fa fa-edit"></i> {{ __('main.edit_fees') }}: {{ $fee->getTranslation('name', app()->getLocale()) }}
                    </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('fees.update', $fee->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>{{ __('main.title_ar') }}</label>
                                <input type="text" name="name[ar]" class="form-control @error('name.ar') is-invalid @enderror"
                                       value="{{ old('name.ar', $fee->getTranslation('name', 'ar')) }}">
                                @error('name.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('main.title_en') }}</label>
                                <input type="text" name="name[en]" class="form-control @error('name.en') is-invalid @enderror"
                                       value="{{ old('name.en', $fee->getTranslation('name', 'en')) }}">
                                @error('name.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>{{ __('main.fee_type') }}</label>
                                <select class="form-control @error('fee_type') is-invalid @enderror" name="fee_type">
                                    <option value="" disabled>{{ __('main.choose') }}...</option>
                                    @foreach(\App\Enums\FeeType::cases() as $type)
                                        <option value="{{ $type->value }}" @selected(old('fee_type', $fee->fee_type->value) == $type->value)>
                                            {{ $type->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fee_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label>{{ __('main.amount') }}</label>
                                <input type="number" step="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror"
                                       value="{{ old('amount', $fee->amount) }}">
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label>{{ __('main.academic_year') }}</label>
                                <select class="form-control @error('academic_year') is-invalid @enderror" name="academic_year">
                                    <option value="" disabled>{{ __('main.choose') }}...</option>
                                    @php $current_year = date("Y"); @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ; $year++)
                                        <option value="{{ $year }}" @selected(old('academic_year', $fee->academic_year) == $year)>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('academic_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- الصف الثالث: المرحلة والفصل --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>{{ __('main.grade') }}</label>
                                <select class="form-control @error('grade_id') is-invalid @enderror" name="grade_id" id="grade_id">
                                    <option value="" disabled>{{ __('main.choose') }}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" @selected(old('grade_id', $fee->grade_id) == $grade->id)>
                                            {{ $grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('grade_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('main.classroom') }}</label>
                                <select class="form-control @error('classroom_id') is-invalid @enderror" name="classroom_id" id="classroom_id">
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}" @selected(old('classroom_id', $fee->classroom_id) == $classroom->id)>
                                                {{ $classroom->name }}
                                            </option>
                                        @endforeach
                                </select>
                                @error('classroom_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('main.description') }}</label>
                            <textarea class="form-control" name="description" rows="3">{{ old('description', $fee->description) }}</textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info btn-lg shadow">
                                <i class="fa fa-sync"></i> {{ __('main.update_data') }}
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
                    url: "{{ URL::to('get-classrooms') }}/" + grade_id,
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
    });
</script>
@endsection
