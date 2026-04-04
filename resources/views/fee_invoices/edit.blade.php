@extends('layouts.master')
@section('title', 'تعديل فاتورة رسوم')

@section('content')
<div class="container-fluid">
    <div class="card card-info card-outline shadow"> {{-- غيرنا اللون للأزرق السماوي لتمييز التعديل --}}
        <div class="card-header">
            <h3 class="card-title text-info font-weight-bold">
                <i class="fa fa-edit"></i> تعديل فاتورة الطالب:
                <span class="text-dark">{{ $feeInvoice->student->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('fee_invoices.update', $feeInvoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="student_id" value="{{ $feeInvoice->student_id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>نوع الرسوم <span class="text-danger">*</span></label>
                            <select name="fee_id" class="form-control @error('fee_id') is-invalid @enderror select2">
                                <option value="" disabled>-- اختر من الرسوم المتاحة --</option>
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
                            <label>البيان / الملاحظات</label>
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
                        <i class="fa fa-sync-alt"></i> تحديث بيانات الفاتورة
                    </button>
                    <a href="{{ route('fee_invoices.index') }}" class="btn btn-secondary btn-lg shadow">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
