@extends('layouts.master')
@section('title', __('main.online_classes_list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.online_classes') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-video"></i> {{ __('main.online_classes_list') }}
            </h3>
            <a href="{{ route('admin.online-classes.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fa fa-plus"></i> {{ __('main.add_online_class') }}
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover text-center">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('main.title') }}</th>
                        <th>{{ __('main.teacher') }}</th>
                        <th>{{ __('main.grade') }}</th>
                        <th>{{ __('main.classroom') }}</th>
                        <th>{{ __('main.subject') }}</th>
                        <th>{{ __('main.start_at') }}</th>
                        <th>{{ __('main.duration') }}</th>
                        <th>{{ __('main.processes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($onlineClasses as $class)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $class->title }}</td>
                        <td>{{ $class->user->name }}</td>
                        <td>{{ $class->grade->name }}</td>
                        <td>{{ $class->classroom->name }}</td>
                        <td>{{ $class->subject->name ?? '-' }}</td>
                        <td>{{ $class->start_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $class->duration }} {{ __('main.minutes') }}</td>
                        <td>
                            @if($class->join_url)
                            <a href="{{ $class->join_url }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fa fa-video"></i> {{ __('main.join_meeting') }}
                            </a>
                            @endif
                            @if($class->start_url)
                            <a href="{{ $class->start_url }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fa fa-play"></i> {{ __('main.start_meeting') }}
                            </a>
                            @endif
                            <a href="{{ route('admin.online-classes.show', $class->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('update', $class)
                            <a href="{{ route('admin.online-classes.edit', $class->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endif
                            @can('delete', $class)
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_online_class{{ $class->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @include('admin.online_classes.delete_modal')
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">{{ __('main.no_data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
