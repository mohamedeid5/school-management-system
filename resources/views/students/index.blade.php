@extends('layouts.master')
@section('title', __('main.students'))

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.students') }}</li>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold text-primary">
                <i class="fa fa-user-graduate mr-1"></i> {{ __('main.students_list') }}
            </h3>
            <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fa fa-plus-circle"></i> {{ __('main.add_student') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('main.student_code') }}</th>
                        <th>{{ __('main.name') }}</th>
                        <th>{{ __('main.gender') }}</th>
                        <th>{{ __('main.nationality') }}</th>
                        <th>{{ __('main.academic_info') }}</th>
                        <th>{{ __('main.academic_year') }}</th>
                        <th>{{ __('main.processes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge badge-secondary px-2 py-1">{{ $student->student_code }}</span></td>
                        <td class="text-left">
                            <div class="font-weight-bold">{{ $student->user->name }}</div>
                            <small class="text-muted">{{ $student->user->email }}</small>
                        </td>
                        <td>
                            <i class="fa fa-male text-primary" title="{{ $student->gender->label() }}"></i>
                        </td>
                        <td>{{ $student->nationality->name }}</td>
                        <td>
                            <div class="small">{{ $student->grade->name }}</div>
                            <div class="badge badge-light border">{{ $student->classroom->name }}</div>
                        </td>
                        <td><span class="text-primary font-weight-bold">{{ $student->academic_year }}</span></td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline-warning btn-sm" title="{{ __('main.show') }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-outline-info btn-sm" title="{{ __('main.edit') }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                               <a href="{{ route('fee-invoices.show', $student->id) }}" class="btn btn-info btn-sm" title="إصدار فاتورة">
                                    <i class="fa fa-file-invoice-dollar"></i>
                                    <span class="d-none d-md-inline ml-1">إصدار فاتورة</span>
                                </a>
                                <a href="{{ route('receipt-students.show', $student->id) }}"
                                    class="btn btn-outline-success btn-sm rounded-pill shadow-sm ml-1 action-btn"
                                    title="إصدار سند قبض (تحصيل مالي)">
                                        <i class="fas fa-money-bill-wave text-success icon-default"></i>
                                        <span class="d-none d-md-inline ml-1">إصدار سند قبض</span>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm confirm-delete" title="{{ __('main.delete') }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
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

    $(document).ready(function() {
        $('.confirm-delete').on('click', function(e) {
            var form = $(this).closest('form');
            if (confirm("{{ __('main.confirm_delete') }}")) {
                form.submit();
            }
        });
    });
</script>
@endsection
