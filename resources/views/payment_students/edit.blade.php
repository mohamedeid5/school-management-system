@extends('layouts.master')
@section('title', __('main.edit_payment'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('payment-students.index') }}">{{ __('main.payment_students') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_payment') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-warning card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-warning font-weight-bold">
                <i class="fas fa-edit"></i> {{ __('main.edit_payment_for_student') }}:
                <span class="text-dark">{{ $payment_student->student->user->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="small-box bg-info shadow-sm">
                        <div class="inner">
                            <h3>{{ number_format($payment_student->student->current_balance, 2) }} <small>ج.م</small></h3>
                            <p>الرصيد الحالي للطالب</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('payment-students.update', $payment_student->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                <input type="hidden" name="student_id" value="{{ $payment_student->student_id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>المبلغ <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="number" name="amount" step="0.01"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{ old('amount', $payment_student->amount) }}" required>
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>البيان / السبب</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $payment_student->description) }}">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-warning shadow text-white">
                        <i class="fa fa-sync-alt"></i> {{ __('main.update_payment') }}
                    </button>
                    <a href="{{ route('payment-students.index') }}" class="btn btn-secondary shadow">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
