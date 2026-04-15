@extends('layouts.master')
@section('title', __('main.edit_teacher'))

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">{{ __('main.teachers') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_teacher') }}</li>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-body">
        <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('main.name') }}</label>
                    <input type="text" name="name" value="{{ old('name', $teacher->user->name) }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label>{{ __('main.email') }}</label>
                    <input type="email" name="email" value="{{ old('email', $teacher->user->email) }}"
                           class="form-control @error('email') is-invalid @enderror">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>{{ __('main.password') }}</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    <small class="text-info">{{ __('main.password_hint') }}</small>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label>{{ __('main.specialization') }}</label>
                    <select name="specialization_id" class="form-control @error('specialization_id') is-invalid @enderror">
                        <option value="" selected disabled>{{ __('main.choose') }}...</option>
                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization->id }}" @selected(old('specialization_id', $teacher->specialization_id) == $specialization->id)>
                                {{ $specialization->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('specialization_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>{{ __('main.gender') }}</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="male" @selected(old('gender', $teacher->gender) == 'male')>{{ __('main.male') }}</option>
                        <option value="female" @selected(old('gender', $teacher->gender) == 'female')>{{ __('main.female') }}</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>{{ __('main.joining_date') }}</label>
                    <input type="date" name="joining_date" value="{{ old('joining_date', $teacher->joining_date) }}"
                           class="form-control @error('joining_date') is-invalid @enderror">
                </div>
            </div>

            <div class="form-group mt-3">
                <label>{{ __('main.sections') }}</label>
                <select class="form-control select2-multiple @error('section_ids') is-invalid @enderror"
                        name="section_ids[]" multiple="multiple">
                    @php $selected_sections = old('section_ids', $teacher->sections->pluck('id')->toArray()); @endphp
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" @selected(in_array($section->id, $selected_sections))>
                            {{ $section->name }} - {{ $section->classroom->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label>{{ __('main.address') }}</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address', $teacher->address) }}</textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">{{ __('main.save') }}</button>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">{{ __('main.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
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
