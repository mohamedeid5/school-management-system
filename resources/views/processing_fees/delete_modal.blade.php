<div class="modal fade" id="delete_fee{{ $fee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-1"></i> حذف حركة خصم مالي
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('processing-fees.destroy', $fee->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <div class="text-center">
                        <p class="h5 mb-3">هل أنت متأكد من إلغاء هذا الخصم؟</p>
                        <div class="alert alert-warning border-left-danger shadow-sm">
                            <strong>اسم الطالب:</strong> {{ $fee->student->user->name }} <br>
                            <strong>قيمة الخصم:</strong> <span class="text-danger font-weight-bold">{{ number_format($fee->amount, 2) }} ج.م</span>
                        </div>
                        <p class="text-muted small">
                            <i class="fas fa-info-circle"></i> تنبيه: عند الحذف، سيتم إلغاء الإعفاء وستعود المديونية على حساب الطالب فوراً.
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                        <button type="submit" class="btn btn-danger shadow">تأكيد الحذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
