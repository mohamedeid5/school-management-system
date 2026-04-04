@extends('layouts.master')
@section('title', 'إصدار سند قبض')

@section('content')
<div class="container-fluid">
    <div class="card card-success card-outline shadow"> {{-- اللون الأخضر بيدل على دخول فلوس الخزنة --}}
        <div class="card-header">
            <h3 class="card-title text-success font-weight-bold">
                <i class="fas fa-money-bill-wave"></i> سند قبض جديد للطالب:
                <span class="text-dark">{{ $student->user->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="small-box bg-info shadow-sm">
                        <div class="inner">
                            <h3>{{ number_format($student->currentBalance, 2) }} <small>ج.م</small></h3>
                            <p>إجمالي المديونية الحالية</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('receipt-students.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <div class="row">
                    {{-- مبلغ القبض --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>المبلغ المدفوع <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="number" name="amount" step="0.01"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       placeholder="أدخل المبلغ هنا..." required>
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- البيان --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>البيان / الملاحظات</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   placeholder="مثلاً: دفعة من المصاريف الدراسية">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-success btn-lg shadow">
                        <i class="fa fa-save"></i> حفظ سند القبض
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-lg shadow">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
