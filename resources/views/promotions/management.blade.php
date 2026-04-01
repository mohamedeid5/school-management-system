@extends('layouts.master')
@section('title', 'إدارة ترقيات الطلاب')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="color: white;"><i class="fa fa-list mr-2"></i> سجلات ترقيات الطلاب</h5>

            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rollback_all">
                <i class="fa fa-undo-alt"></i> تراجع عن الكل
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>اسم الطالب</th>
                            <th class="text-danger">المرحلة السابقة</th>
                            <th>السنة الدراسية</th>
                            <th class="text-success">المرحلة الحالية</th>
                            <th>السنة الحالية</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $promotion->student->user->name }}</td>
                            <td>{{ $promotion->fromGrade->name }} - {{ $promotion->fromClassroom->name }}</td>
                            <td>{{ $promotion->academic_year }}</td>
                            <td>{{ $promotion->toGrade->name }} - {{ $promotion->toClassroom->name }}</td>
                            <td>{{ $promotion->academic_year_new }}</td>
                            <td>
                                <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#rollback_single{{ $promotion->id }}">
                                    <i class="fa fa-redo"></i> إرجاع الطالب
                                </button>
                            </td>
                        </tr>
                        @include('promotions.rollback_single')

                        @endforeach
                        @include('promotions.rollback_all')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
