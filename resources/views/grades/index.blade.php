@extends('layouts.master')
@section('title', __('main.grades'))

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('main.grades') }}
    </li>
@endsection

@section('content')
    <div class="bg-white p-4 rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">

            <a href="#" class="btn btn-primary btn-sm">
                {{ __('main.add_grade') }}
            </a>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">#</th>
                        <th>{{ __('main.name') }}</th>
                        <th>{{ __('main.notes') }}</th>
                        <th style="width: 180px;">{{ __('main.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>المرحلة الابتدائية</td>
                        <td>تشمل الصفوف الأولى الأساسية</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="#" class="btn btn-warning btn-sm">
                                    {{ __('main.edit') }}
                                </a>
                                <button class="btn btn-danger btn-sm">
                                    {{ __('main.delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>المرحلة الإعدادية</td>
                        <td>مرحلة متوسطة قبل الثانوية</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="#" class="btn btn-warning btn-sm">
                                    {{ __('main.edit') }}
                                </a>
                                <button class="btn btn-danger btn-sm">
                                    {{ __('main.delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>المرحلة الثانوية</td>
                        <td>المرحلة النهائية قبل الجامعة</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="#" class="btn btn-warning btn-sm">
                                    {{ __('main.edit') }}
                                </a>
                                <button class="btn btn-danger btn-sm">
                                    {{ __('main.delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
