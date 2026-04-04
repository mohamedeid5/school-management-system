@extends('layouts.master')
@section('title', 'قائمة فواتير الرسوم')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold text-primary">
                        <i class="fa fa-file-invoice-dollar"></i> قائمة فواتير الرسوم الدراسية
                    </h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                     <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th>#</th>
                                    <th>اسم الطالب</th>
                                    <th>نوع الرسوم</th>
                                    <th>المبلغ</th>
                                    <th>المرحلة الدراسية</th>
                                    <th>الصف الدراسي</th>
                                    <th>تاريخ الفاتورة</th>
                                    <th>البيان</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feeInvoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="font-weight-bold">{{ $invoice->student->user->name }}</td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $invoice->fee->name }}
                                        </span>
                                    </td>
                                    <td class="text-success font-weight-bold">{{ number_format($invoice->amount, 2) }} ج.م</td>
                                    <td>{{ $invoice->student->grade->name }}</td>
                                    <td>{{ $invoice->student->classroom->name }}</td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ Str::limit($invoice->description, 25) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('fee_invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_invoice{{ $invoice->id }}" title="حذف">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <a href="#" class="btn btn-secondary btn-sm" title="طباعة الفاتورة">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @include('fee_invoices.delete_modal', ['invoice' => $invoice])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
