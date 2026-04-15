<!-- delete modal -->
<div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('main.delete_classroom') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.classrooms.destroy', $classroom->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p class="mb-0">{{ __('main.warning_classroom') }}</p>
                    <input type="text" disabled class="form-control mt-2" value="{{ $classroom->name }}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        {{ __('main.close') }}
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">
                        {{ __('main.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
