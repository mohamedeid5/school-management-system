<div class="table-responsive">

    <div class="mb-3">
        <button wire:click="showCreateForm" class="btn btn-success shadow-sm">
            <i class="fa fa-plus-circle"></i> {{ __('main.add_parent') }}
        </button>
    </div>

    <button wire:click="toggleTrashed" class="btn {{ $showTrashed ? 'btn-success' : 'btn-secondary' }}">
        {{ $showTrashed ? __('main.show_active') : __('main.show_archive') }}
    </button>

    <table id="datatable" class="table table-bordered table-hover align-middle text-center mb-0">
        <thead class="table-light">
            <tr>
                <th style="width: 70px;">#</th>
                <th>{{ __('main.name') }}</th>
                <th>{{ __('main.email') }}</th>
                <th>{{ __('main.job') }}</th>
                <th>{{ __('main.national_id') }}</th>
                <th>{{ __('main.phone_father') }}</th>
                <th style="width: 180px;">{{ __('main.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($parents as $parent)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $parent->user->name }}</td>
                    <td>{{ $parent->user->email }}</td>
                    <td>{{ $parent->job_father }}</td>
                    <td>{{ $parent->national_id_father }}</td>
                    <td>{{ $parent->phone_father }}</td>
                    <td>
                        @if($showTrashed)
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button"
                                    wire:click="restore({{ $parent->id }})"
                                    class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#edit{{ $parent->id }}"
                                    title="{{ __('main.restore') }}">
                                    {{ __('main.restore') }}
                                </button>

                                <button type="button"
                                    wire:click="forceDelete({{ $parent->id }})"
                                    class="btn btn-danger btn-sm"
                                    data-toggle="modal"
                                    data-target="#delete{{ $parent->id }}"
                                    title="{{ __('main.force_delete') }}">
                                    {{ __('main.force_delete') }}
                                </button>
                            </div>
                        @else
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button"
                                    wire:click="edit({{ $parent->id }})"
                                    class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#edit{{ $parent->id }}"
                                    title="{{ __('main.edit') }}">
                                    {{ __('main.edit') }}
                                </button>

                                <button type="button"
                                    wire:click="delete({{ $parent->id }})"
                                    class="btn btn-danger btn-sm"
                                    data-toggle="modal"
                                    data-target="#delete{{ $parent->id }}"
                                    title="{{ __('main.delete') }}">
                                    {{ __('main.delete') }}
                                </button>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __('main.no_data') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
