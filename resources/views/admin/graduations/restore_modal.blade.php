<div class="modal fade" id="restore_student{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-info">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                    <i class="fa fa-undo"></i> {{ __('main.restore_student') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.graduations.restore', $student->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="text-center">
                        <h4 class="text-info font-weight-bold">{{ __('main.are_you_sure') }}</h4>
                        <p>
                            {{ __('main.confirm_restore_student') }}: <br>
                            <strong class="text-primary">{{ $student->user?->name ?? 'N/A' }}</strong>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                    <button type="submit" class="btn btn-info shadow">{{ __('main.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
