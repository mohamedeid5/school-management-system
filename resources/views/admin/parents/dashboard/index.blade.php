@extends('layouts.master')
@section('title', __('main.parent_dashboard'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">{{ __('main.dashboard') }}</a></li>
@endsection

@section('content')

    {{-- Welcome Banner --}}
    <div class="row mb-30">
        <div class="col-12">
            <div class="card" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border:none;">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-white">
                            <h4 class="mb-1">
                                <i class="fa fa-users mr-2"></i>
                                {{ __('main.welcome') }}, {{ auth()->user()->name }}
                            </h4>
                            <p class="mb-0" style="opacity:.8;">
                                <i class="fa fa-child mr-1"></i>
                                {{ $children->count() }} {{ __('main.children') }}
                                &nbsp;&bull;&nbsp;
                                <i class="fa fa-calendar mr-1"></i>
                                {{ now()->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                        <div class="text-white text-right d-none d-md-block">
                            <i class="fa fa-school" style="font-size: 4rem; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @forelse($children as $child)
        <div class="row mb-30">
            <div class="col-12">
                <div class="card card-statistics shadow-sm">

                    {{-- Child Header --}}
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">
                            <i class="fa fa-user-graduate mr-2 text-primary"></i>
                            <strong>{{ $child->user?->name ?? __('main.no_data') }}</strong>
                            <span class="badge badge-secondary ml-2">{{ $child->student_code }}</span>
                        </h5>
                        <div>
                            @if($child->grade)
                                <span class="badge badge-primary mr-1">
                                    <i class="fa fa-layer-group mr-1"></i>{{ $child->grade->name }}
                                </span>
                            @endif
                            @if($child->classroom)
                                <span class="badge badge-info mr-1">
                                    <i class="fa fa-door-open mr-1"></i>{{ $child->classroom->name }}
                                </span>
                            @endif
                            @if($child->section)
                                <span class="badge badge-success">
                                    <i class="fa fa-list mr-1"></i>{{ $child->section->name }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Subjects Table --}}
                    <div class="card-body p-0">
                        @if($child->subjects->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="width:50px;">#</th>
                                            <th>{{ __('main.code') }}</th>
                                            <th>{{ __('main.name') }}</th>
                                            <th>{{ __('main.teacher') }}</th>
                                            <th>{{ __('main.description') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($child->subjects as $subject)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="badge badge-info">{{ $subject->code ?? '—' }}</span>
                                                </td>
                                                <td class="font-weight-bold">{{ $subject->name }}</td>
                                                <td>
                                                    @if($subject->teacher?->user)
                                                        <i class="fa fa-chalkboard-teacher mr-1 text-muted"></i>
                                                        {{ $subject->teacher->user->name }}
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $subject->description ?? '—' }}</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted py-4">
                                <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                                {{ __('main.no_data') }}
                            </div>
                        @endif
                    </div>

                    {{-- Footer: total subjects --}}
                    <div class="card-footer text-muted py-2">
                        <small>
                            <i class="fa fa-book mr-1"></i>
                            {{ $child->subjects->count() }} {{ __('main.subjects') }}
                        </small>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <div class="row">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-body text-center py-5">
                        <i class="fa fa-child fa-3x text-muted mb-3 d-block"></i>
                        <h5 class="text-muted">{{ __('main.no_data') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    @endforelse

@endsection
