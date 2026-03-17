@extends('layouts.master')
@section('title', __('main.classrooms'))

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">{{ __('main.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('main.classrooms') }}
    </li>
@endsection

@section('content')
<div class="bg-white p-4 rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createclassroomModal">
            {{ __('main.add_classroom') }}
        </button>
    </div>

    <div class="table-responsive">
        <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">#</th>
                    <th>{{ __('main.name') }}</th>
                    <th>{{ __('main.notes') }}</th>
                    <th>{{ __('main.grade') }}</th>
                    <th style="width: 180px;">{{ __('main.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classrooms as $classroom)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $classroom->name }}</td>
                        <td>{{ $classroom->notes }}</td>
                        <td>{{ $classroom->grade->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button"
                                    class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#edit{{ $classroom->id }}"
                                    title="{{ __('main.edit') }}">
                                    {{ __('main.edit') }}
                                </button>

                                <button type="button"
                                    class="btn btn-danger btn-sm"
                                    data-toggle="modal"
                                    data-target="#delete{{ $classroom->id }}"
                                    title="{{ __('main.delete') }}">
                                    {{ __('main.delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>

                    @include('classrooms.edit')

                    @include('classrooms.delete')
                @empty
                    <tr>
                        <td colspan="4">{{ __('main.no_data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('classrooms.create')


@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('repeater-container');
            const addBtn = document.getElementById('add-row');

            addBtn.addEventListener('click', function () {
                const firstRow = container.querySelector('.classroom-row');
                const newRow = firstRow.cloneNode(true);

                newRow.querySelectorAll('input').forEach(input => input.value = '');
                newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

                const removeBtn = newRow.querySelector('.remove-row');
                removeBtn.disabled = false;

                removeBtn.addEventListener('click', function () {
                    newRow.remove();
                });

                container.appendChild(newRow);
            });
        });
    </script>
@endsection
