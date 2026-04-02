<div class="modal fade" id="rollback_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-exclamation-triangle"></i> تراجع عن جميع الترقيات
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('promotions.destroy', 'test') }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="page_id" value="all">
                <div class="modal-body">
                    <div class="text-center">
                        <h4 class="text-danger font-weight-bold">هل أنت متأكد؟</h4>
                        <p class="text-muted">هذا الإجراء سيعيد جميع الطلاب إلى صفوفهم القديمة وسيحذف سجلات الترقية بالكامل.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger shadow">تأكيد التراجع الشامل</button>
                </div>
            </form>
        </div>
    </div>
</div>
