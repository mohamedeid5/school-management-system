@extends('layouts.master')
@section('title', __('main.add_receipt'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.receipt-students.index') }}">{{ __('main.receipt_students_list') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.add_receipt') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-success card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-success font-weight-bold">
                <i class="fas fa-money-bill-wave"></i> {{ __('main.new_receipt_for_student') }}:
                <span class="text-dark">{{ $student->user->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="small-box bg-info shadow-sm">
                        <div class="inner">
                            <h3>{{ number_format($student->currentBalance, 2) }} <small>{{ __('main.currency_egp') }}</small></h3>
                            <p>{{ __('main.total_current_debt') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.receipt-students.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('main.paid_amount') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" name="amount" step="0.01"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       placeholder="{{ __('main.paid_amount') }}..." required>
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('main.description_notes') }}</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   placeholder="{{ __('main.description_notes') }}">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-success btn-lg shadow">
                        <i class="fa fa-save"></i> {{ __('main.save_receipt') }}
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-lg shadow">{{ __('main.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
