<div class="modal fade" id="rollback_single{{ $promotion->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-outline-danger">
                <h5 class="modal-title text-danger" id="exampleModalLabel font-weight-bold">
                    <i class="fas fa-user-edit"></i> تراجع عن ترقية طالب
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
                        هل أنت متأكد من التراجع عن ترقية الطالب: <br>
                        <strong class="text-primary">{{ $promotion->student->user->name }}</strong>؟
                    </p>
                    <div class="alert alert-warning text-center small">
                        سيعود الطالب من
                        <strong>
                            {{ $promotion->toGrade->name }} - {{ $promotion->toClassroom->name }}
                        </strong> إلى
                        <strong>
                            {{ $promotion->fromGrade->name }} - {{ $promotion->fromClassroom->name }}
                        </strong>.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">إغاء</button>
                    <button type="submit" class="btn btn-sm btn-danger">تأكيد الإرجاع</button>
                </div>
            </form>
        </div>
    </div>
</div>
