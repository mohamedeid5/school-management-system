@extends('layouts.master')
@section('title', 'تعديل خصم مالي')

@section('content')
<div class="container-fluid">
    <div class="card card-warning card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-warning font-weight-bold">
                <i class="fas fa-edit"></i> تعديل خصم للطالب:
                <span class="text-dark">{{ $processingFee->student->user->name }}</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="small-box bg-info shadow-sm">
                        <div class="inner">
                            <h3>{{ number_format($processingFee->student->current_balance, 2) }} <small>ج.م</small></h3>
                            <p>الرصيد الحالي للطالب</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.processing-fees.update', $processingFee->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                <input type="hidden" name="student_id" value="{{ $processingFee->student_id }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>قيمة الخصم الجديدة <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="number" name="amount" step="0.01"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{ old('amount', $processingFee->amount) }}" required>
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>البيان / السبب</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $processingFee->description) }}">
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-warning shadow text-white">
                        <i class="fa fa-sync-alt"></i> تحديث بيانات الخصم
                    </button>
                    <a href="{{ route('admin.processing-fees.index') }}" class="btn btn-secondary shadow">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
