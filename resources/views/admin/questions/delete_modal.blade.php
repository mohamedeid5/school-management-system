<div class="modal fade" id="delete_question{{ $question->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">{{ __('main.delete_question') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.questions.destroy', $question->id) }}" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">{{ __('main.warning_question') }}</h5>
                    <p class="text-center text-danger font-weight-bold">{{ Str::limit($question->question, 80) }}</p>
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i>
                        <b>{{ __('main.no_undo_action') }}:</b> {{ __('main.warning_question') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('main.confirm_delete') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
