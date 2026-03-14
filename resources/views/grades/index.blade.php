@extends('layouts.master')
@section('title', __('main.grades'))

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('main.grades') }}
    </li>
@endsection

@section('content')
    <div class="bg-white p-4 rounded shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createGradeModal">
                {{ __('main.add_grade') }}
            </button>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">#</th>
                        <th>{{ __('main.name') }}</th>
                        <th>{{ __('main.notes') }}</th>
                        <th style="width: 180px;">{{ __('main.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grades as $grade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grade->name }}</td>
                            <td>{{ $grade->notes }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button"
                                        class="btn btn-warning btn-sm"
                                        data-toggle="modal"
                                        data-target="#edit{{ $grade->id }}"
                                        title="{{ __('main.edit') }}">
                                        {{ __('main.edit') }}
                                    </button>

                                    <button type="button"
                                        class="btn btn-danger btn-sm"
                                        data-toggle="modal"
                                        data-target="#delete{{ $grade->id }}"
                                        title="{{ __('main.delete') }}">
                                        {{ __('main.delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>

                        @if($errors->any() && old('grade_id'))
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // سيقوم بفتح المودال الخاص بالمرحلة التي كان يتم تعديلها فقط
                                    $('#edit{{ old('grade_id') }}').modal('show');
                                });
                            </script>
                        @endif

                        <!-- edit modal -->
                        <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('main.edit_grade') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>{{ __('main.stage_name_ar') }}</label>
                                                    <input type="text"
                                                        name="name[ar]"
                                                        class="form-control @error('name.ar') is-invalid @enderror"
                                                        value="{{ old('name.ar', $grade->getTranslation('name', 'ar')) }}"
                                                        >
                                                        @error('name.ar')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>{{ __('main.stage_name_en') }}</label>
                                                    <input type="text"
                                                        name="name[en]"
                                                        class="form-control @error('name.en') is-invalid @enderror"
                                                        value="{{ old('name.en', $grade->getTranslation('name', 'en')) }}"
                                                        >
                                                        @error('name.en')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mb-0">
                                                <label>{{ __('main.notes') }}</label>
                                                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $grade->notes) }}</textarea>
                                            </div>
                                            @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                {{ __('main.close') }}
                                            </button>
                                            <button type="submit" class="btn btn-success btn-sm">
                                                {{ __('main.submit') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- delete modal -->
                        <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('main.delete_grade') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{ route('grades.destroy', $grade->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-body">
                                            <p class="mb-0">{{ __('main.warning_grade') }}</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                {{ __('main.close') }}
                                            </button>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                {{ __('main.submit') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4">{{ __('main.no_data') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- create modal -->

    <div class="modal fade" id="createGradeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('main.add_grade') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>{{ __('main.stage_name_ar') }}</label>
                                <input type="text" name="name[ar]" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>{{ __('main.stage_name_en') }}</label>
                                <input type="text" name="name[en]" class="form-control">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label>{{ __('main.notes') }}</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                            {{ __('main.close') }}
                        </button>
                        <button type="submit" class="btn btn-success btn-sm">
                            {{ __('main.submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
