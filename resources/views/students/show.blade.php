@extends('layouts.master')
@section('title', $student->user->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">{{ __('main.students') }}</a></li>
    <li class="breadcrumb-item active">{{ $student->user->name }}</li>
@endsection

@section('content')
<div class="row">
    {{-- العمود الجانبي: الملف الشخصي السريع --}}
    <div class="col-md-3">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle shadow"
                         src="{{ asset('assets/img/student_default.png') }}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center font-weight-bold">{{ $student->user->name }}</h3>
                <p class="text-muted text-center">{{ $student->student_code }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{ __('main.grade') }}</b> <a class="float-right text-primary font-weight-bold">{{ $student->grade->name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{ __('main.classroom') }}</b> <a class="float-right text-primary font-weight-bold">{{ $student->classroom->name }}</a>
                    </li>
                    {{-- إضافة الرصيد السريع في الجنب --}}
                    <li class="list-group-item border-bottom-0">
                        <b>الرصيد الحالي</b>
                        <a class="float-right font-weight-bold {{ $student->current_balance > 0 ? 'text-danger' : 'text-success' }}">
                            {{ number_format($student->current_balance, 2) }} ج.م
                        </a>
                    </li>
                </ul>
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-block"><b>{{ __('main.edit') }}</b></a>
            </div>
        </div>
    </div>

    {{-- العمود الرئيسي: التبويبات --}}
    <div class="col-md-9">
        <div class="card shadow-sm">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab"><i class="fa fa-user mr-1"></i> {{ __('main.personal_information') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#academic" data-toggle="tab"><i class="fa fa-graduation-cap mr-1"></i> {{ __('main.academic_information') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#financial" data-toggle="tab"><i class="fa fa-file-invoice-dollar mr-1"></i> السجل المالي</a></li>
                    <li class="nav-item"><a class="nav-link" href="#attachments" data-toggle="tab"><i class="fa fa-paperclip mr-1"></i> {{ __('main.attachments') }}</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="active tab-pane" id="personal">
                        <table class="table table-striped table-sm">
                            <tr><th width="30%">{{ __('main.email') }}</th><td>{{ $student->user->email }}</td></tr>
                            <tr><th>{{ __('main.gender') }}</th><td>{{ $student->gender->value == 'male' ? __('main.male') : __('main.female') }}</td></tr>
                            <tr><th>{{ __('main.nationality') }}</th><td>{{ $student->nationality->name }}</td></tr>
                            <tr><th>{{ __('main.blood_type') }}</th><td><span class="badge badge-danger">{{ $student->bloodType->name }}</span></td></tr>
                            <tr><th>{{ __('main.date_of_birth') }}</th><td>{{ $student->date_of_birth->format('Y-m-d') }}</td></tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="academic">
                        <table class="table table-striped table-sm">
                            <tr><th width="30%">{{ __('main.academic_year') }}</th><td>{{ $student->academic_year }}</td></tr>
                            <tr><th>{{ __('main.section') }}</th><td>{{ $student->section->name }}</td></tr>
                            <tr><th>{{ __('main.joining_date') }}</th><td>{{ $student->joining_date->format('Y-m-d') }}</td></tr>
                        </table>
                    </div>

                    <div class="tab-pane" id="financial">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-primary font-weight-bold m-0"><i class="fa fa-history mr-1"></i> تفاصيل الحركات المالية</h5>
                            <a href="#" class="btn btn-outline-secondary shadow-sm">
                                <i class="fa fa-print mr-1"></i> طباعة كشف حساب
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-center table-sm">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>#</th>
                                                <th>التاريخ</th>
                                                <th>نوع الحركة</th>
                                                <th>البيان</th>
                                                <th>مدين (+)</th>
                                                <th>دائن (-)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($student->studentAccounts as $account)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $account->date }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $account->debit > 0 ? 'info' : 'success' }}">
                                                        {{ $account->type }}
                                                    </span>
                                                </td>
                                                <td class="text-left small">{{ $account->description }}</td>
                                                <td class="text-danger font-weight-bold">
                                                    {{ $account->debit != 0 ? number_format($account->debit, 2) : '-' }}
                                                </td>
                                                <td class="text-success font-weight-bold">
                                                    {{ $account->credit != 0 ? number_format($account->credit, 2) : '-' }}
                                                </td>
                                            </tr>
                                            @empty
                                            <tr><td colspan="6" class="text-muted">لا توجد حركات مالية مسجلة لهذا الطالب</td></tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-light font-weight-bold">
                                                <td colspan="4" class="text-right">الرصيد الإجمالي:</td>
                                                <td colspan="2" class="{{ $student->current_balance > 0 ? 'text-danger' : 'text-success' }}">
                                                    {{ number_format($student->current_balance, 2) }} ج.م
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 4. المرفقات --}}
                    <div class="tab-pane" id="attachments">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('main.file_name') }}</th>
                                        <th>{{ __('main.created_at') }}</th>
                                        <th>{{ __('main.processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($student->attachments as $attachment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attachment->file_name }}</td>
                                        <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('students.download_attachment', $attachment->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-download"></i>
                                                </a>

                                                <form action="{{ route('students.delete_attachment', $attachment->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $attachment->id }}">
                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                    <button type="button" class="btn btn-danger btn-sm confirm-delete-attachment">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4">{{ __('main.no_data_found') }}</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.confirm-delete-attachment', function(e) {
            if (confirm("{{ __('main.are_you_sure') }}")) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
@endsection
