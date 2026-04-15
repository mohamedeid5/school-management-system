@extends('layouts.master')
@section('title', __('main.receipt_students_list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.receipt_students_list') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-success card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-success font-weight-bold">
                <i class="fas fa-receipt"></i> {{ __('main.receipt_students_records') }}
            </h3>
        </div>
        <div class="card-body">
             <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th>#</th>
                            <th>{{ __('main.student_name') }}</th>
                            <th>{{ __('main.collected_amount') }}</th>
                            <th>{{ __('main.receipt_date') }}</th>
                            <th>{{ __('main.statement') }}</th>
                            <th>{{ __('main.processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($receipts as $receipt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold">{{ $receipt->student->user->name }}</td>
                            <td class="text-success font-weight-bold">{{ number_format($receipt->amount, 2) }} {{ __('main.currency_egp') }}</td>
                            <td>{{ $receipt->date }}</td>
                            <td>{{ Str::limit($receipt->description, 30) }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.receipt-students.edit', $receipt->id) }}" class="btn btn-warning btn-sm" title="{{ __('main.edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_receipt{{ $receipt->id }}" title="{{ __('main.delete') }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a href="#" class="btn btn-secondary btn-sm" title="{{ __('main.print_receipt') }}">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @include('admin.receipt_students.delete_modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
