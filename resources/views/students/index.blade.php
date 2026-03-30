@extends('layouts.master')
@section('title', __('main.students'))

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">{{ __('main.students_list') }}</h3>
        <div class="card-tools">
            <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> {{ __('main.add_student') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('main.student_code') }}</th>
                        <th>{{ __('main.name') }}</th>
                        <th>{{ __('main.email') }}</th>
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
                        <td><span class="badge badge-info">{{ $student->student_code }}</span></td>
                        <td>{{ $student->user->name }}</td>
                        <td>{{ $student->user->email }}</td>
                        <td>{{ $student->grade->name }}</td>
                        <td>{{ $student->classroom->name }}</td>
                        <td>{{ $student->section->name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-info btn-sm" title="{{ __('main.edit') }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                               <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                     <button type="button" class="btn btn-danger btn-sm delete-student" data-toggle="modal" data-target="#delete{{ $student->id }}" title="{{ __('main.delete') }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                </form>
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-warning btn-sm" title="{{ __('main.show') }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('.delete-student').on('click', function(e) {
            e.preventDefault();
            if (confirm("{{ __('main.confirm_delete_teacher') }}")) {
                $(this).closest('form').submit();
            }
        });
    })
</script>
@endsection
