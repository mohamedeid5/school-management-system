<div class="modal fade" id="delete_payment{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="deletePaymentLabel{{ $payment->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deletePaymentLabel{{ $payment->id }}">
                    <i class="fa fa-exclamation-triangle mr-1"></i> حذف دفعة
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('payment-students.destroy', $payment->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p class="mb-2">هل أنت متأكد من حذف هذه الدفعة؟</p>
                    <ul class="list-unstyled mb-0">
                        <li><strong>الطالب:</strong> {{ $payment->student->user->name }}</li>
                        <li><strong>المبلغ:</strong> {{ number_format($payment->amount, 2) }} ج.م</li>
                        <li><strong>التاريخ:</strong> {{ $payment->date }}</li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> تأكيد الحذف
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
