@extends('layouts.master')
@section('title', 'قائمة سندات القبض')

@section('content')
<div class="container-fluid">
    <div class="card card-success card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-success font-weight-bold">
                <i class="fas fa-receipt"></i> سجل تحصيلات الطلاب (سندات القبض)
            </h3>
        </div>
        <div class="card-body">
             <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th>#</th>
                            <th>اسم الطالب</th>
                            <th>المبلغ المحصل</th>
                            <th>تاريخ السند</th>
                            <th>البيان</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($receipts as $receipt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold">{{ $receipt->student->user->name }}</td>
                            <td class="text-success font-weight-bold">{{ number_format($receipt->amount, 2) }} ج.م</td>
                            <td>{{ $receipt->date }}</td>
                            <td>{{ Str::limit($receipt->description, 30) }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('receipt-students.edit', $receipt->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_receipt{{ $receipt->id }}" title="حذف">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <a href="#" class="btn btn-secondary btn-sm" title="طباعة إيصال">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @include('receipt_students.delete_modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
