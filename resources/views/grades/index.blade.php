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

                        @include('grades.edit')
                       @include('grades.delete')
                    @empty
                        <tr>
                            <td colspan="4">{{ __('main.no_data') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('grades.create')
@endsection
