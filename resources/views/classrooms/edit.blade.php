<!-- edit modal -->
 @if($errors->any() && old('classroom_id'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#edit{{ old('classroom_id') }}').modal('show');
        });
    </script>
@endif
<div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('main.edit_classroom') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" value="{{ $classroom->id }}" name="classroom_id">
                <div class="modal-body">
                    <div class="row mb-3 align-items-end border-bottom pb-3">

                        <div class="col">
                            <label>{{ __('main.classroom_name_ar') }} :</label>
                            <input
                                class="form-control @error('name') is-invalid @enderror"
                                type="text"
                                name="name[ar]"
                                value="{{ old('name.ar', $classroom->getTranslation('name', 'ar')) }}"
                            />
                            @error('name.ar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{ __('main.classroom_name_en') }} :</label>
                            <input
                                class="form-control @error('name_en') is-invalid @enderror"
                                type="text"
                                name="name[en]"
                                value="{{ old('name.en', $classroom->getTranslation('name', 'en')) }}"
                            />
                            @error('name.en')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{ __('main.grades') }} :</label>
                            <select class="form-control @error('grade_id') is-invalid @enderror" name="grade_id">
                                <option value="" disabled>-- اختر المرحلة --</option>
                                @foreach ($grades as $grade)
                                    <option
                                        value="{{ $grade->id }}"
                                        @selected($classroom->grade_id == $grade->id)
                                    >
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grade_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
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
