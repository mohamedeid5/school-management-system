<div class="modal fade" id="delete_fee{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-exclamation-triangle"></i> {{ __('main.delete_fee') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('fees.destroy', $fee->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $fee->id }}">

                    <div class="text-center">
                        <p class="text-gray-600 mb-2">{{ __('main.delete_fee_warning') }}</p>
                        <h5 class="text-danger font-weight-bold">
                            {{ $fee->getTranslation('name', app()->getLocale()) }}
                        </h5>
                        <p class="badge badge-warning">{{ __('main.amount') }}: {{ number_format($fee->amount, 2) }}</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.close') }}</button>
                    <button type="submit" class="btn btn-danger shadow">{{ __('main.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
