@extends('layouts.master')
@section('title', __('main.subjects_list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.subjects') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-book"></i> {{ __('main.subjects_list') }}
            </h3>
            <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fa fa-plus"></i> {{ __('main.add_subject') }}
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered text-center">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('main.code') }}</th>
                        <th>{{ __('main.name') }}</th>
                        <th>{{ __('main.grade') }}</th>
                        <th>{{ __('main.classroom') }}</th>
                        <th>{{ __('main.teacher') }}</th>
                        <th>{{ __('main.processes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge badge-info">{{ $subject->code ?? __('main.no_data') }}</span></td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->grade->name }}</td>
                        <td>{{ $subject->classroom->name }}</td>
                        <td>{{ $subject->teacher->user->name }}</td>
                        <td>
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_subject{{ $subject->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @include('subjects.delete_modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
