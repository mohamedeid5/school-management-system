@extends('layouts.master')
@section('title', __('main.payment_students'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.payment_students') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-success card-outline shadow">
        <div class="card-header">
            <h3 class="card-title text-success font-weight-bold">
                <i class="fas fa-money-check-alt"></i> {{ __('main.payment_students_records') }}
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th>#</th>
                            <th>اسم الطالب</th>
                            <th>المبلغ</th>
                            <th>التاريخ</th>
                            <th>البيان</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold">{{ $payment->student->user->name }}</td>
                            <td class="text-success font-weight-bold">{{ number_format($payment->amount, 2) }} ج.م</td>
                            <td>{{ $payment->date }}</td>
                            <td>{{ Str::limit($payment->description, 40) }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('payment-students.edit', $payment->id) }}" class="btn btn-warning btn-sm shadow-sm" title="تعديل">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm shadow-sm" data-toggle="modal" data-target="#delete_payment{{ $payment->id }}" title="حذف">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('payment_students.delete_modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
