<div class="modal fade" id="delete_receipt{{ $receipt->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-exclamation-triangle"></i> {{ __('main.warning_delete_receipt') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('receipt-students.destroy', $receipt->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <div class="text-center">
                        <p class="h5 mb-3">{{ __('main.delete_receipt_warning') }}</p>
                        <div class="alert alert-warning border-left-danger shadow-sm">
                            <strong>{{ __('main.student') }}:</strong> {{ $receipt->student->name }} <br>
                            <strong>{{ __('main.collected_amount') }}:</strong> <span class="text-danger font-weight-bold">{{ number_format($receipt->amount, 2) }} {{ __('main.currency_egp') }}</span>
                        </div>
                        <p class="text-muted small">{{ __('main.receipt_deleted_account_note') }}</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.cancel') }}</button>
                        <button type="submit" class="btn btn-danger shadow-sm">{{ __('main.confirm_permanent_delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
