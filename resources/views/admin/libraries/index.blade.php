@extends('layouts.master')
@section('title', __('main.libraries_list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.libraries') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-book"></i> {{ __('main.libraries_list') }}
            </h3>
            <a href="{{ route('admin.libraries.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fa fa-plus"></i> {{ __('main.add_library') }}
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('main.title') }}</th>
                            <th>{{ __('main.grade') }}</th>
                            <th>{{ __('main.classroom') }}</th>
                            <th>{{ __('main.section') }}</th>
                            <th>{{ __('main.subject') }}</th>
                            <th>{{ __('main.uploaded_by') }}</th>
                            <th>{{ __('main.processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($libraries as $library)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $library->title }}</td>
                            <td>{{ $library->grade->name }}</td>
                            <td>{{ $library->classroom->name }}</td>
                            <td>{{ $library->section->name }}</td>
                            <td>{{ $library->subject->name }}</td>
                            <td>{{ $library->user->name }}</td>
                            <td>
                                <a href="{{ route('admin.libraries.show', $library->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @can('update', $library)
                                    <a href="{{ route('admin.libraries.edit', $library->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endcan
                                @can('delete', $library)
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_library{{ $library->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                        @include('admin.libraries.delete_modal')
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">{{ __('main.no_data') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
