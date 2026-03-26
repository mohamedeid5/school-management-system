<div>

    @if($showForm)
        <div class="mb-3">
            <button wire:click="hideForm" class="btn btn-secondary shadow-sm">
                <i class="fa fa-arrow-right"></i> {{ __('main.back_to_table') }}
            </button>
        </div>
        @include('livewire.stepwizard')

        @include('livewire.father-form')

        @include('livewire.mother-form')

        @include('livewire.confirmation-form')
    @else

        @include('livewire.parent-table')

    @endif

</div>
