@extends('layouts.master')
@section('title', __('main.fee_invoice'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('student.fee-invoices.index') }}">{{ __('main.fee_invoices') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.fee_invoice') }} #{{ $feeInvoice->id }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-7 mb-30 mx-auto">
        <div class="card card-statistics">
            <div class="card-body">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start mb-4 pb-3 border-bottom">
                    <div>
                        <h5 class="mb-1">
                            <i class="fa fa-file-invoice-dollar mr-1 text-info"></i>
                            {{ __('main.fee_invoice') }}
                        </h5>
                        <small class="text-muted">#{{ $feeInvoice->id }}</small>
                    </div>
                    <div class="text-right">
                        <p class="mb-0 text-muted small">{{ __('main.invoice_date') }}</p>
                        <strong>
                            {{ $feeInvoice->invoice_date ? \Carbon\Carbon::parse($feeInvoice->invoice_date)->format('d M Y') : '—' }}
                        </strong>
                    </div>
                </div>

                {{-- Student Info --}}
                <div class="mb-4">
                    <h6 class="text-muted mb-2"><i class="fa fa-user-graduate mr-1"></i>{{ __('main.student') }}</h6>
                    <p class="font-weight-bold mb-0">{{ $feeInvoice->student?->user?->name ?? '—' }}</p>
                    @if($feeInvoice->student?->student_code)
                        <small class="text-muted">{{ __('main.student_code') }}: {{ $feeInvoice->student->student_code }}</small>
                    @endif
                </div>

                {{-- Invoice Details --}}
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('main.fee') }}</th>
                            <th class="text-right">{{ __('main.amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>{{ $feeInvoice->fee?->name ?? '—' }}</strong>
                                @if($feeInvoice->description)
                                    <br><small class="text-muted">{{ $feeInvoice->description }}</small>
                                @endif
                            </td>
                            <td class="text-right font-weight-bold text-danger">
                                {{ number_format($feeInvoice->amount, 2) }}
                                <small class="text-muted">{{ __('main.currency_egp') }}</small>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="thead-light">
                        <tr>
                            <td class="text-right font-weight-bold">{{ __('main.amount') }}</td>
                            <td class="text-right font-weight-bold text-danger">
                                {{ number_format($feeInvoice->amount, 2) }}
                                <small class="text-muted">{{ __('main.currency_egp') }}</small>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('student.fee-invoices.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left mr-1"></i>{{ __('main.back_to_list') }}
                    </a>
                    <button class="btn btn-outline-secondary" onclick="window.print()">
                        <i class="fa fa-print mr-1"></i>{{ __('main.print_invoice') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
