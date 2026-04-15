@extends('layouts.master')
@section('title', 'قائمة الخصومات المالية')

@section('content')
<div class="container-fluid">
    <div class="card card-secondary card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-secondary font-weight-bold">
                <i class="fas fa-percentage"></i> سجل الخصومات وإقصاء الرسوم
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th>#</th>
                            <th>اسم الطالب</th>
                            <th>قيمة الخصم</th>
                            <th>التاريخ</th>
                            <th>البيان / السبب</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($processing_fees as $fee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold">{{ $fee->student->user->name }}</td>
                            <td class="text-secondary font-weight-bold">{{ number_format($fee->amount, 2) }} ج.م</td>
                            <td>{{ $fee->date }}</td>
                            <td>{{ Str::limit($fee->description, 40) }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.processing-fees.edit', $fee->id) }}" class="btn btn-warning btn-sm shadow-sm" title="تعديل">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm shadow-sm" data-toggle="modal" data-target="#delete_fee{{ $fee->id }}" title="حذف">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('admin.processing_fees.delete_modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
