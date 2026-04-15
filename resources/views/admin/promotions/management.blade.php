@extends('layouts.master')
@section('title', __('main.students_promotion_management'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.promotions.index') }}">{{ __('main.students_promotion') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.students_promotion_management') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="color: white;">
                <i class="fa fa-list mr-2"></i> {{ __('main.students_promotion_records') }}
            </h5>

            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rollback_all">
                <i class="fa fa-undo-alt"></i> {{ __('main.rollback_all') }}
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>{{ __('main.student_name') }}</th>
                            <th class="text-danger">{{ __('main.old_grade') }}</th>
                            <th>{{ __('main.academic_year') }}</th>
                            <th class="text-success">{{ __('main.new_grade') }}</th>
                            <th>{{ __('main.new_academic_year') }}</th>
                            <th>{{ __('main.processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $batchId => $group)
                        <tr class="table-info">
                            <td colspan="6" class="text-right font-weight-bold">
                                {{ __('main.batch_number') }}:
                                <span class="badge badge-dark">{{ substr($batchId, 0, 8) }}...</span>
                                ({{ __('main.students_count') }}: {{ $group->count() }})
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rollback_batch{{ $batchId }}">
                                    <i class="fa fa-undo"></i> {{ __('main.rollback_batch') }}
                                </button>
                            </td>
                        </tr>
                            @foreach($group as $promotion)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $promotion->student->user->name }}</td>
                                <td>{{ $promotion->fromGrade->name }} - {{ $promotion->fromClassroom->name }}</td>
                                <td>{{ $promotion->academic_year }}</td>
                                <td>{{ $promotion->toGrade->name }} - {{ $promotion->toClassroom->name }}</td>
                                <td>{{ $promotion->academic_year_new }}</td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#rollback_single{{ $promotion->id }}">
                                        <i class="fa fa-redo"></i> {{ __('main.rollback_student') }}
                                    </button>
                                </td>
                            </tr>
                            @include('admin.promotions.rollback_single')

                            @endforeach
                            @include('admin.promotions.rollback_batch', ['batchId' => $batchId, 'count' => $group->count()])
                        @endforeach
                        @include('admin.promotions.rollback_all')

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
