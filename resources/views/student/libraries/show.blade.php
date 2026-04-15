@extends('layouts.master')
@section('title', $library->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.libraries.index') }}">{{ __('main.library') }}</a></li>
    <li class="breadcrumb-item active">{{ $library->title }}</li>
@endsection

@section('content')
<div class="row">
    {{-- Book Details --}}
    <div class="col-lg-5 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-book-open mr-1 text-success"></i>
                    {{ __('main.library_details') }}
                </h5>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-muted" style="width:40%"><i class="fa fa-heading mr-1"></i>{{ __('main.title') }}</td>
                            <td class="font-weight-bold">{{ $library->title }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-book mr-1"></i>{{ __('main.subject') }}</td>
                            <td>{{ $library->subject?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-layer-group mr-1"></i>{{ __('main.grade') }}</td>
                            <td>{{ $library->grade?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-door-open mr-1"></i>{{ __('main.classroom') }}</td>
                            <td>{{ $library->classroom?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-list mr-1"></i>{{ __('main.section') }}</td>
                            <td>{{ $library->section?->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="fa fa-user mr-1"></i>{{ __('main.uploaded_by') }}</td>
                            <td>{{ $library->user?->name ?? '—' }}</td>
                        </tr>
                        @if($library->description)
                        <tr>
                            <td class="text-muted"><i class="fa fa-align-left mr-1"></i>{{ __('main.description') }}</td>
                            <td><small class="text-muted">{{ $library->description }}</small></td>
                        </tr>
                        @endif
                        <tr>
                            <td class="text-muted"><i class="fa fa-calendar mr-1"></i>{{ __('main.created_at') }}</td>
                            <td><small>{{ $library->created_at?->format('d M Y') ?? '—' }}</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Attachments --}}
    <div class="col-lg-7 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-paperclip mr-1 text-primary"></i>
                    {{ __('main.attachments') }}
                    <span class="badge badge-secondary ml-1">{{ $library->attachments->count() }}</span>
                </h5>

                @forelse($library->attachments as $attachment)
                    <div class="d-flex align-items-center justify-content-between border rounded p-3 mb-2">
                        <div class="d-flex align-items-center">
                            @php
                                $ext = strtolower(pathinfo($attachment->file_name, PATHINFO_EXTENSION));
                                $icon = match(true) {
                                    in_array($ext, ['pdf'])                        => 'fa-file-pdf text-danger',
                                    in_array($ext, ['doc','docx'])                 => 'fa-file-word text-primary',
                                    in_array($ext, ['xls','xlsx'])                 => 'fa-file-excel text-success',
                                    in_array($ext, ['ppt','pptx'])                 => 'fa-file-powerpoint text-warning',
                                    in_array($ext, ['jpg','jpeg','png','gif','svg'])=> 'fa-file-image text-info',
                                    in_array($ext, ['zip','rar'])                  => 'fa-file-archive text-secondary',
                                    default                                        => 'fa-file text-muted',
                                };
                            @endphp
                            <i class="fa {{ $icon }} fa-lg mr-3"></i>
                            <div>
                                <div class="font-weight-bold">{{ $attachment->file_name }}</div>
                                <small class="text-muted">{{ strtoupper($ext) }}</small>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-download mr-1"></i>{{ __('main.view') }}
                        </a>
                    </div>
                @empty
                    <p class="text-muted text-center mt-4">
                        <i class="fa fa-paperclip fa-2x mb-2 d-block"></i>
                        {{ __('main.no_data') }}
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-30">
        <a href="{{ route('student.libraries.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-1"></i>{{ __('main.back_to_list') }}
        </a>
    </div>
</div>
@endsection
