@extends('layouts.master')
@section('title', __('main.sections'))

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('main.sections') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#createSectionModal">
                        {{ trans('main.add_section') }}
                    </a>
                </div>

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($grades as $grade)
                                <div class="acd-group">
                                    <a href="#" class="acd-heading" id="heading-grade-{{ $grade->id }}">{{ $grade->name }}</a>
                                    <div class="acd-des">
                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th>#</th>
                                                                        <th>{{ trans('main.name') }}</th>
                                                                        <th>{{ trans('main.classroom') }}</th>
                                                                        <th>{{ trans('main.status') }}</th>
                                                                        <th>{{ trans('main.actions') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($grade->sections as $section)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ $section->name }}</td>
                                                                            <td>{{ $section->classroom->name }}</td>
                                                                            <td>
                                                                                @if ($section->status === 1)
                                                                                    <label class="badge badge-success">{{ trans('main.active') }}</label>
                                                                                @else
                                                                                    <label class="badge badge-danger">{{ trans('main.inactive') }}</label>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#edit{{ $section->id }}">{{ trans('main.edit') }}</a>
                                                                                <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $section->id }}">{{ trans('main.delete') }}</a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.sections.create')

    @foreach ($grades as $grade)
        @foreach ($grade->sections as $section)
            @include('admin.sections.edit')
            @include('admin.sections.delete')
        @endforeach
    @endforeach

@endsection
