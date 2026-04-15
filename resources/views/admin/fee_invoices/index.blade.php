@extends('layouts.master')
@section('title', __('main.fee_invoices_list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.fee_invoices_list') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold text-primary">
                        <i class="fa fa-file-invoice-dollar"></i> {{ __('main.fee_invoices_list') }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                     <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th>#</th>
                                    <th>{{ __('main.student_name') }}</th>
                                    <th>{{ __('main.fee_type') }}</th>
                                    <th>{{ __('main.amount') }}</th>
                                    <th>{{ __('main.grade') }}</th>
                                    <th>{{ __('main.classroom') }}</th>
                                    <th>{{ __('main.invoice_date') }}</th>
                                    <th>{{ __('main.statement') }}</th>
                                    <th>{{ __('main.processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feeInvoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="font-weight-bold">{{ $invoice->student->user->name }}</td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $invoice->fee->name }}
                                        </span>
                                    </td>
                                    <td class="text-success font-weight-bold">{{ number_format($invoice->amount, 2) }} {{ __('main.currency_egp') }}</td>
                                    <td>{{ $invoice->student->grade->name }}</td>
                                    <td>{{ $invoice->student->classroom->name }}</td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ Str::limit($invoice->description, 25) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.fee-invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm" title="{{ __('main.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_invoice{{ $invoice->id }}" title="{{ __('main.delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <a href="#" class="btn btn-secondary btn-sm" title="{{ __('main.print_invoice') }}">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @include('admin.fee_invoices.delete_modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
