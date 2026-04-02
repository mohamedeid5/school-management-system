<div class="modal fade" id="rollback_single{{ $promotion->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-outline-danger">
                <h5 class="modal-title text-danger font-weight-bold" id="exampleModalLabel">
                    <i class="fas fa-user-edit"></i> {{ __('main.rollback_student') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('promotions.destroy', $promotion->id) }}" method="post">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="{{ $promotion->id }}">
                <input type="hidden" name="page_id" value="single">

                <div class="modal-body">
                    <p class="text-center">
                        {{ __('main.rollback_student_confirm') }}: <br>
                        <strong class="text-primary">{{ $promotion->student->user->name }}</strong>؟
                    </p>
                    <div class="alert alert-warning text-center small">
                        {{ __('main.student_will_return_from') }}
                        <strong>
                            {{ $promotion->toGrade->name }} - {{ $promotion->toClassroom->name }}
                        </strong>
                        {{ __('main.to') }}
                        <strong>
                            {{ $promotion->fromGrade->name }} - {{ $promotion->fromClassroom->name }}
                        </strong>.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                    <button type="submit" class="btn btn-sm btn-danger">{{ __('main.confirm_rollback') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
