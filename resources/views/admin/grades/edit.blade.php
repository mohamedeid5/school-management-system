@if($errors->any() && old('grade_id'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // سيقوم بفتح المودال الخاص بالمرحلة التي كان يتم تعديلها فقط
            $('#edit{{ old('grade_id') }}').modal('show');
        });
    </script>
@endif

<!-- edit modal -->
<div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('main.edit_grade') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.grades.update', $grade->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>{{ __('main.stage_name_ar') }}</label>
                            <input type="text"
                                name="name[ar]"
                                class="form-control @error('name.ar') is-invalid @enderror"
                                value="{{ old('name.ar', $grade->getTranslation('name', 'ar')) }}"
                                >
                                @error('name.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ __('main.stage_name_en') }}</label>
                            <input type="text"
                                name="name[en]"
                                class="form-control @error('name.en') is-invalid @enderror"
                                value="{{ old('name.en', $grade->getTranslation('name', 'en')) }}"
                                >
                                @error('name.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label>{{ __('main.notes') }}</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $grade->notes) }}</textarea>
                    </div>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        {{ __('main.close') }}
                    </button>
                    <button type="submit" class="btn btn-success btn-sm">
                        {{ __('main.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
