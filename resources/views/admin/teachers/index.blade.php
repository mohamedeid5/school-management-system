@extends('layouts.master')

@section('title', __('main.teachers_list'))

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">{{ __('main.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('main.teachers') }}
    </li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('main.teachers_data') }}</h3>

        <a href="{{ route('admin.teachers.create') }}" class="btn btn-success float-end">
            {{ __('main.add_teacher') }}
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('main.name') }}</th>
                    <th>{{ __('main.specialization') }}</th>
                    <th>{{ __('main.gender') }}</th>
                    <th>{{ __('main.sections') }}</th>
                    <th>{{ __('main.joining_date') }}</th>
                    <th>{{ __('main.actions') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $teacher->user->name }}</td>
                    <td>{{ $teacher->specialization->name }}</td>
                    <td>{{ $teacher->gender->label() }}</td>

                    <td>
                        @foreach($teacher->sections as $section)
                            <span class="badge bg-info text-dark">
                                {{ $section->name }} - {{ $section->classroom->name }}
                            </span>
                        @endforeach
                    </td>

                    <td>{{ $teacher->joining_date }}</td>

                    <td>
                        <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                           class="btn btn-info btn-sm"
                           title="{{ __('main.view') }}">
                            <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                           class="btn btn-sm btn-primary">
                            {{ __('main.edit') }}
                        </a>

                        <form action="{{ route('admin.teachers.destroy', $teacher->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger delete-teacher">
                                {{ __('main.delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.delete-teacher').on('click', function(e) {
            e.preventDefault();

            if (confirm("{{ __('main.confirm_delete_teacher') }}")) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
@endsection
