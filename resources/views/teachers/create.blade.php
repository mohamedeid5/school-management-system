@extends('layouts.master')

@section('title', __('main.teachers'))

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('main.teachers') }}
    </li>
@endsection

@section('content')
<form action="{{ route('teachers.store') }}" method="POST" autocomplete="off">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <label>{{ __('main.teacher_name') }}</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label>{{ __('main.email') }}</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>{{ __('main.password') }}</label>
            <input type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label>{{ __('main.specialization') }}</label>
            <select name="specialization_id" class="form-control @error('specialization_id') is-invalid @enderror">
                <option value="" selected disabled>
                    {{ __('main.choose_specialization') }}
                </option>
                @foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}"
                        {{ old('specialization_id') == $specialization->id ? 'selected' : '' }}>
                        {{ $specialization->name }}
                    </option>
                @endforeach
            </select>
            @error('specialization_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>{{ __('main.gender') }}</label>
            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                    {{ __('main.male') }}
                </option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                    {{ __('main.female') }}
                </option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label>{{ __('main.joining_date') }}</label>
            <input type="date" name="joining_date" value="{{ old('joining_date') }}"
                   class="form-control @error('joining_date') is-invalid @enderror">
            @error('joining_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group mt-3">
        <label>{{ __('main.sections') }}</label>
        <select class="form-control select2-multiple @error('section_ids') is-invalid @enderror"
                name="section_ids[]" multiple="multiple">
            @foreach($sections as $section)
                <option value="{{ $section->id }}"
                    @selected(is_array(old('section_ids')) && in_array($section->id, old('section_ids')))>
                    {{ $section->name }} - {{ $section->classroom->name }}
                </option>
            @endforeach
        </select>
        @error('section_ids')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <label>{{ __('main.address') }}</label>
            <textarea name="address"
                      class="form-control @error('address') is-invalid @enderror"
                      rows="3">{{ old('address') }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">
        {{ __('main.save') }}
    </button>
</form>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: "ابحث عن الفصول...",
            allowClear: true
        });
    });
</script>
@endsection
