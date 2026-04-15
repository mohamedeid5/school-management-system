@extends('layouts.master')
@section('title', __('main.sections'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.sections') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="ti-layout-tab"></i> {{ __('main.sections_list') }}
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('main.name') }}</th>
                            <th>{{ __('main.grade') }}</th>
                            <th>{{ __('main.classroom') }}</th>
                            <th>{{ __('main.students_count') }}</th>
                            <th>{{ __('main.status') }}</th>
                            <th>{{ __('main.processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sections as $section)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->grade->name }}</td>
                            <td>{{ $section->classroom->name }}</td>
                            <td><span class="badge badge-info">{{ $section->students_count }}</span></td>
                            <td>
                                @if($section->status === 1)
                                    <span class="badge badge-success">{{ __('main.active') }}</span>
                                @else
                                    <span class="badge badge-danger">{{ __('main.inactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('teacher.sections.show', $section->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">{{ __('main.no_data') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
