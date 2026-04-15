<div class="modal fade" id="rollback_batch{{ $batchId }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="fa fa-exclamation-circle"></i> تراجع عن دفعة محددة</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.promotions.destroy', 'test') }}" method="post">
                @csrf
                @method('DELETE')

                <input type="hidden" name="batch_id" value="{{ $batchId }}">
                <input type="hidden" name="page_id" value="batch">

                <div class="modal-body text-center">
                    <h5>أنت على وشك التراجع عن ترقية <span class="badge badge-danger">{{ $count }}</span> طلاب</h5>
                    <p>هذا الإجراء سيعيد هؤلاء الطلاب فقط إلى صفوفهم السابقة.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-warning">تأكيد التراجع عن الدفعة</button>
                </div>
            </form>
        </div>
    </div>
</div>
