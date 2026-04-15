@extends('layouts.master')
@section('title', __('main.library_details'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.libraries.index') }}">{{ __('main.libraries') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.library_details') }}</li>
@endsection

@section('content')
<div class="card card-primary card-outline shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title text-primary font-weight-bold">
            <i class="fa fa-book"></i> {{ $library->title }}
        </h3>
        <div>
            <a href="{{ route('admin.libraries.edit', $library->id) }}" class="btn btn-info btn-sm">
                <i class="fa fa-edit"></i> {{ __('main.edit') }}
            </a>
            <a href="{{ route('admin.libraries.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> {{ __('main.back') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th>{{ __('main.title') }}</th>
                        <td>{{ $library->title }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('main.grade') }}</th>
                        <td>{{ $library->grade->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('main.classroom') }}</th>
                        <td>{{ $library->classroom->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('main.section') }}</th>
                        <td>{{ $library->section->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('main.subject') }}</th>
                        <td>{{ $library->subject->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('main.uploaded_by') }}</th>
                        <td>{{ $library->user->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('main.description') }}</th>
                        <td>{{ $library->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('main.file') }}</th>
                        <td>
                            @forelse($library->attachments as $attachment)
                                <a href="{{ $attachment->url }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i> {{ $attachment->file_name }}
                                </a>
                            @empty
                                <span class="text-muted">-</span>
                            @endforelse
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
