@extends('layouts.master')
@section('title', __('main.exams_list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.exams') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-file-alt"></i> {{ __('main.exams_list') }}
            </h3>
            <a href="{{ route('teacher.exams.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fa fa-plus"></i> {{ __('main.add_exam') }}
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('main.name') }}</th>
                            <th>{{ __('main.exam_type') }}</th>
                            <th>{{ __('main.subject') }}</th>
                            <th>{{ __('main.grade') }}</th>
                            <th>{{ __('main.classroom') }}</th>
                            <th>{{ __('main.academic_year') }}</th>
                            <th>{{ __('main.term') }}</th>
                            <th>{{ __('main.exam_date') }}</th>
                            <th>{{ __('main.max_score') }}</th>
                            <th>{{ __('main.processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($exams as $exam)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $exam->name }}</td>
                            <td>
                                @php
                                    $typeColors = ['quiz' => 'info', 'midterm' => 'warning', 'final' => 'danger', 'assignment' => 'success'];
                                    $color = $typeColors[$exam->type->value] ?? 'secondary';
                                @endphp
                                <span class="badge badge-{{ $color }}">{{ __('main.exam_type_' . $exam->type->value) }}</span>
                            </td>
                            <td>{{ $exam->subject->name }}</td>
                            <td>{{ $exam->grade->name }}</td>
                            <td>{{ $exam->classroom->name }}</td>
                            <td>{{ $exam->academic_year }}</td>
                            <td><span class="badge badge-secondary">{{ __('main.term_' . $exam->term) }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('Y-m-d') }}</td>
                            <td><span class="badge badge-primary">{{ $exam->max_score }}</span></td>
                            <td>
                                <a href="{{ route('teacher.exams.show', $exam->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('teacher.exams.edit', $exam->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete_exam{{ $exam->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Delete Modal --}}
                        <div class="modal fade" id="delete_exam{{ $exam->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">{{ __('main.delete_exam') }}</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('teacher.exams.destroy', $exam->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <div class="modal-body">
                                            <h5 class="text-center">{{ __('main.warning_exam') }}</h5>
                                            <p class="text-center text-danger font-weight-bold">{{ $exam->name }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                                            <button type="submit" class="btn btn-danger">{{ __('main.confirm_delete') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">{{ __('main.no_data') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
