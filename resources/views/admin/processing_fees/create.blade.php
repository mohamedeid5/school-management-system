@extends('layouts.master')
@section('title', 'إضافة خصم مالي')

@section('content')
<div class="container-fluid">
    <div class="card card-secondary card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-secondary font-weight-bold">
                <i class="fas fa-percentage"></i> إضافة خصم (إقصاء رسوم) للطالب:
                <span class="text-dark">{{ $student->user->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="small-box bg-warning shadow-sm">
                        <div class="inner">
                            <h3>{{ number_format($student->current_balance, 2) }} <small>ج.م</small></h3>
                            <p>إجمالي المديونية الحالية (المبلغ القابل للخصم)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.processing-fees.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>قيمة الخصم <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="number" name="amount" step="0.01"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       placeholder="أدخل قيمة الخصم هنا..." required>
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <small class="text-muted">تنبيه: يجب ألا يتجاوز الخصم قيمة المديونية الحالية.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>سبب الخصم / البيان</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   placeholder="مثلاً: خصم تفوق رياضي، منحة اجتماعية...">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-secondary btn-lg shadow">
                        <i class="fa fa-save"></i> حفظ الخصم
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-light btn-lg shadow border">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
