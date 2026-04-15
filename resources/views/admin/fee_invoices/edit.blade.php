@extends('layouts.master')
@section('title', __('main.edit_fee_invoice'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.fee-invoices.index') }}">{{ __('main.fee_invoices_list') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.edit_fee_invoice') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-info card-outline shadow"> {{-- غيرنا اللون للأزرق السماوي لتمييز التعديل --}}
        <div class="card-header">
            <h3 class="card-title text-info font-weight-bold">
                <i class="fa fa-edit"></i> {{ __('main.edit_student_invoice') }}:
                <span class="text-dark">{{ $feeInvoice->student->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.fee-invoices.update', $feeInvoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="student_id" value="{{ $feeInvoice->student_id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('main.fee_type') }} <span class="text-danger">*</span></label>
                            <select name="fee_id" class="form-control @error('fee_id') is-invalid @enderror select2">
                                <option value="" disabled>-- {{ __('main.choose_available_fees') }} --</option>
                                @foreach($fees as $fee)
                                    <option value="{{ $fee->id }}"
                                        @selected(old('fee_id', $feeInvoice->fee_id) == $fee->id)>
                                        {{ $fee->name }} - ({{ number_format($fee->amount, 2) }} ج.م)
                                    </option>
                                @endforeach
                            </select>
                             @error('fee_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('main.statement') }} / {{ __('main.notes') }}</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $feeInvoice->description) }}"
                                   placeholder="مثلاً: تعديل قسط أول لعام 2026">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-info btn-lg shadow">
                        <i class="fa fa-sync-alt"></i> {{ __('main.update_invoice_data') }}
                    </button>
                    <a href="{{ route('admin.fee-invoices.index') }}" class="btn btn-secondary btn-lg shadow">{{ __('main.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
