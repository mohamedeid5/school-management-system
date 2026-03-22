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

            <div class="d-flex">
                <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#createclassroomModal">
                    {{ __('main.add_classroom') }}
                </button>

                <button type="submit" id="bulk-delete-btn" class="btn btn-danger btn-sm">
                    delete selected
                </button>
            </div>

            <form action="{{ route('classrooms.index') }}" method="GET" class="mb-4">
                    <div class="col-md-3 p-0">
                        <select name="grade_id" class="form-select" dir="rtl" onchange="this.form.submit()">
                            <option value="">-- عرض كل المراحل --</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->getTranslation('name', 'ar') }}
                                </option>
                            @endforeach
                        </select>

                </div>
            </form>
        </div>


         <form action="{{ route('classrooms.destroySelected') }}" method="POST" id="bulk-delete-form" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="checkbox" id="select_all">
                        </th>
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
                            <td>
                                <input type="checkbox" name="ids[]" value="{{ $classroom->id }}" class="row-checkbox">
                            </td>
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


        $(function(){
            $('#select_all').on('change', function(){
                $('.row-checkbox').prop('checked', $(this).prop('checked'));
            });

            $('.row-checkbox').on('change', function () {
                $('#select_all').prop(
                    'checked',
                    $('.row-checkbox:checked').length === $('.row-checkbox').length
                );
            });

            $('#bulk-delete-btn').on('click', function(){
                let checked = $('.row-checkbox:checked');

                if(checked.length == 0) {
                    alert('اختر صف واحد على الأقل');
                    return;
                }

                if(!confirm('are you sure?')) {
                    return;
                }

                let form = $('#bulk-delete-form');

                checked.each((function() {
                    form.append(
                        $('<input>', {
                            type: 'hidden',
                            name: 'ids[]',
                            value: $(this).val()
                        })
                    );
                }));

                form.submit();

            });

        });

    </script>
@endsection
