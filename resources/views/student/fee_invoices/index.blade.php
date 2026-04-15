@extends('layouts.master')
@section('title', __('main.fee_invoices'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.fee_invoices') }}</li>
@endsection

@section('content')

{{-- Summary --}}
@php
    $totalAmount = $feeInvoices->sum('amount');
@endphp
<div class="row">
    <div class="col-xl-4 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <span class="text-info"><i class="fa fa-file-invoice-dollar highlight-icon"></i></span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">{{ __('main.fee_invoices') }}</p>
                        <h4>{{ $feeInvoices->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <span class="text-danger"><i class="fa fa-money-bill-wave highlight-icon"></i></span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">{{ __('main.amount') }}</p>
                        <h4>{{ number_format($totalAmount, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Invoices Table --}}
<div class="row">
    <div class="col-12 mb-30">
        <div class="card card-statistics">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fa fa-file-invoice-dollar mr-1 text-info"></i>
                    {{ __('main.my_fee_invoices') }}
                </h5>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('main.fee') }}</th>
                                <th>{{ __('main.invoice_date') }}</th>
                                <th class="text-right">{{ __('main.amount') }}</th>
                                <th>{{ __('main.description') }}</th>
                                <th class="text-center">{{ __('main.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($feeInvoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="font-weight-bold">{{ $invoice->fee?->name ?? '—' }}</td>
                                    <td>
                                        {{ $invoice->invoice_date ? \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') : '—' }}
                                    </td>
                                    <td class="text-right">
                                        <span class="font-weight-bold text-danger">
                                            {{ number_format($invoice->amount, 2) }}
                                            <small class="text-muted">{{ __('main.currency_egp') }}</small>
                                        </span>
                                    </td>
                                    <td><small class="text-muted">{{ $invoice->description ?? '—' }}</small></td>
                                    <td class="text-center">
                                        <a href="{{ route('student.fee-invoices.show', $invoice) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-eye mr-1"></i>{{ __('main.show') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                                        {{ __('main.no_data') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($feeInvoices->count() > 0)
                        <tfoot class="thead-light">
                            <tr>
                                <td colspan="3" class="text-right font-weight-bold">{{ __('main.amount') }}</td>
                                <td class="text-right font-weight-bold text-danger">
                                    {{ number_format($totalAmount, 2) }}
                                    <small class="text-muted">{{ __('main.currency_egp') }}</small>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
