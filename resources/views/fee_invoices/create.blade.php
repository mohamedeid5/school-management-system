@extends('layouts.master')
@section('title', 'إصدار فاتورة رسوم')

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-primary font-weight-bold">
                <i class="fa fa-file-invoice-dollar"></i> إضافة فاتورة جديدة لـ:
                <span class="text-dark">{{ $student->user->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('fee_invoices.store') }}" method="POST">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>نوع الرسوم <span class="text-danger">*</span></label>
                            <select name="fee_id" class="form-control @error('fee_id') is-invalid @enderror select2">
                                <option value="" selected disabled>-- اختر من الرسوم المتاحة --</option>
                                @foreach($fees as $fee)
                                    <option value="{{ $fee->id }}">
                                        {{ $fee->getTranslation('name', app()->getLocale()) }} - ({{ number_format($fee->amount, 2) }} ج.م)
                                    </option>
                                @endforeach
                            </select>
                             @error('fee_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>البيان / الملاحظات</label>
                            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="مثلاً: قسط أول لعام 2026">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-lg shadow">
                        <i class="fa fa-save"></i> حفظ الفاتورة
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
