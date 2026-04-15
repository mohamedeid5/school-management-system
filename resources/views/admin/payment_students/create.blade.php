@extends('layouts.master')
@section('title', __('main.add_payment'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.payment-students.index') }}">{{ __('main.payment_students') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.add_payment') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-success card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-success font-weight-bold">
                <i class="fas fa-money-check-alt"></i> {{ __('main.new_payment_for_student') }}:
                <span class="text-dark">{{ $student->user->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="small-box bg-warning shadow-sm">
                        <div class="inner">
                            <h3>{{ number_format($student->current_balance, 2) }} <small>ج.م</small></h3>
                            <p>إجمالي المديونية الحالية</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.payment-students.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">

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
                                       placeholder="أدخل قيمة الدفعة..." required>
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>البيان / السبب</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   placeholder="مثلاً: دفعة نقدية جزئية">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-success btn-lg shadow">
                        <i class="fa fa-save"></i> {{ __('main.save_payment') }}
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-light btn-lg shadow border">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
