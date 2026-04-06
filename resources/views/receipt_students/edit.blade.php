@extends('layouts.master')
@section('title', __('main.edit_receipt'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('receipt-students.index') }}">{{ __('main.receipt_students_list') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_receipt') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-warning card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-warning font-weight-bold">
                <i class="fa fa-edit"></i> {{ __('main.edit_receipt_for_student') }}:
                <span class="text-dark">{{ $receipt_student->student->user->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon bg-info"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('main.current_balance_before_edit') }}</span>
                            <span class="info-box-number h4">{{ number_format($receipt_student->student->current_balance, 2) }} {{ __('main.currency_egp') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('receipt-students.update', $receipt_student->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                <input type="hidden" name="student_id" value="{{ $receipt_student->student_id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('main.paid_amount') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                </div>
                                <input type="number" name="amount" step="0.01"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{ old('amount', $receipt_student->amount) }}" required>
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('main.description_notes') }}</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $receipt_student->description) }}">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-warning btn-lg shadow">
                        <i class="fa fa-sync-alt"></i> {{ __('main.update_receipt') }}
                    </button>
                    <a href="{{ route('receipt-students.index') }}" class="btn btn-secondary btn-lg shadow">{{ __('main.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
