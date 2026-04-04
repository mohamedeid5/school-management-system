@extends('layouts.master')
@section('title', __('main.fees_list'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('main.fees_list') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary shadow">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fa fa-money-check-alt text-primary"></i> {{ __('main.fees_list') }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('fees.create') }}" class="btn btn-success btn-sm shadow-sm">
                            <i class="fa fa-plus"></i> {{ __('main.add_new_fees') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                                <tr class="bg-light">
                                    <th>#</th>
                                    <th>{{ __('main.title') }}</th>
                                    <th>{{ __('main.amount') }}</th>
                                    <th>{{ __('main.grade') }}</th>
                                    <th>{{ __('main.classroom') }}</th>
                                    <th>{{ __('main.academic_year') }}</th>
                                    <th>{{ __('main.description') }}</th>
                                    <th>{{ __('main.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $fee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- عرض الاسم بناءً على اللغة الحالية --}}
                                    <td>{{ $fee->getTranslation('name', app()->getLocale()) }}</td>
                                    <td class="text-success font-weight-bold">{{ number_format($fee->amount, 2) }} {{ __('main.currency_egp') }}</td>
                                    <td>{{ $fee->grade->name }}</td>
                                    <td>{{ $fee->classroom->name }}</td>
                                    <td>{{ $fee->academic_year }}</td>
                                    <td>{{ Str::limit($fee->description, 30) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-info btn-sm" title="{{ __('main.edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_fee{{ $fee->id }}" title="{{ __('main.delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @include('fees.delete_modal')
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
