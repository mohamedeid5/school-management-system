<div class="modal fade" id="force_delete{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                    <i class="fa fa-trash-alt"></i> {{ __('main.permanent_delete') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.graduations.destroy', $student->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fa fa-exclamation-triangle text-danger fa-4x animate__animated animate__pulse animate__infinite"></i>
                        </div>
                        <h4 class="text-danger font-weight-bold">{{ __('main.are_you_sure') }}</h4>
                        <p class="text-muted">
                            {{ __('main.permanent_delete_warning_text') }}: <br>
                            <strong class="text-dark">{{ $student->user?->name ?? 'N/A' }}</strong>
                        </p>
                        <div class="alert alert-danger py-2">
                            <small><i class="fa fa-info-circle"></i> {{ __('main.no_undo_action') }}</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                    <button type="submit" class="btn btn-danger shadow-sm">{{ __('main.confirm_permanent_delete') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
