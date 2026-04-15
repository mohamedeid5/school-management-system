@if ($errors->any() and old('form_type') == 'create')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#createclassroomModal').modal('show');
        });
    </script>
@endif

    <div class="modal fade" id="createclassroomModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('main.add_classroom') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.classrooms.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="form_type" value="create">
                    <div class="modal-body">
                        <div class="repeater">
                            <div data-repeater-list="list_classrooms">

                                @foreach (old('list_classrooms', [[]]) as $index => $classroom)

                                <div data-repeater-item class="row mb-3 align-items-end border-bottom pb-3">

                                    <div class="col">
                                        <label>{{ __('main.classroom_name_ar') }} :</label>
                                        <input
                                            class="form-control @error('list_classrooms.*.name') is-invalid @enderror"
                                            type="text"
                                            name="name"
                                            value="{{ $classroom['name'] ?? '' }}"
                                        />
                                        @error('list_classrooms.*.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <label>{{ __('main.classroom_name_en') }} :</label>
                                        <input
                                            class="form-control @error('list_classrooms.*.name_en') is-invalid @enderror"
                                            type="text"
                                            name="name_en"
                                            value="{{ $classroom['name_en'] ?? '' }}" />
                                            @error('list_classrooms.*.name_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>

                                    <div class="col">
                                        <label>المرحلة الدراسية :</label>
                                        <select class="form-control @error('list_classrooms.*.grade_id') is-invalid @enderror" name="grade_id">
                                            <option value="" disabled selected>-- اختر المرحلة --</option>
                                            @foreach ($grades as $grade)
                                                <option
                                                    value="{{ $grade->id }}"
                                                    @selected(($classroom['grade_id'] ?? '') == $grade->id)
                                                >
                                                    {{ $grade->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('list_classrooms.*.grade_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <button data-repeater-delete type="button" class="btn btn-danger btn-sm">
                                            حذف
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <button data-repeater-create type="button" class="btn btn-info btn-sm">
                                        + إضافة صف آخر
                                    </button>
                                </div>
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
