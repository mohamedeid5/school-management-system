@extends('layouts.master')
@section('title', __('main.graduated_students'))

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between">
            <h5 class="mb-0"><i class="fa fa-user-graduate"></i> {{ __('main.graduated_students_list') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('main.student_name') }}</th>
                            <th>{{ __('main.grade') }}</th>
                            <th>{{ __('main.classroom') }}</th>
                            <th>{{ __('main.section') }}</th>
                            <th>{{ __('main.processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->user->name }}</td>
                            <td>{{ $student->grade->name }}</td>
                            <td>{{ $student->classroom->name }}</td>
                            <td>{{ $student->section->name }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#restore_student{{ $student->id }}">
                                    <i class="fa fa-undo"></i> {{ __('main.restore_student') }}
                                </button>

                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#force_delete{{ $student->id }}">
                                    <i class="fa fa-trash"></i> {{ __('main.permanent_delete') }}
                                </button>
                            </td>
                        </tr>
                        @include('graduations.restore_modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
