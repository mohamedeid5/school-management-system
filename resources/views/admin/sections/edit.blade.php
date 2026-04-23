<div class="modal fade"
        id="edit{{ $section->id }}"
        tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{ trans('main.edit_section') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.sections.update', $section->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="hidden" name="section_id" value="{{ $section->id }}">

                    <div class="row">
                        <div class="col">
                            <input type="text" name="name[ar]" class="form-control @error('name.ar') is-invalid @enderror"
                                value="{{ old('section_id') == $section->id ? old('name.ar') : $section->getTranslation('name', 'ar') }}">
                            @error('name.ar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <input type="text" name="name[en]" class="form-control @error('name.en') is-invalid @enderror"
                                value="{{ old('section_id') == $section->id ? old('name.en') : $section->getTranslation('name', 'en') }}">
                            @error('name.en')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="col">
                        <label class="control-label">{{ trans('main.grade') }}</label>
                        <select name="grade_id" class="custom-select grade-select @error('grade_id') is-invalid @enderror">
                            <option value="" disabled>اختر المرحلة</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}"
                                    @selected(old('grade_id', $section->grade_id) == $grade->id)>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('grade_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="col">
                        <label class="control-label">{{ trans('main.classroom') }}</label>
                        <select name="classroom_id" class="custom-select classroom-select @error('classroom_id') is-invalid @enderror">
                            <option value="{{ $section->id }}">{{ $section->classroom->name }}</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}"
                                    @selected(old('classroom_id', $section->classroom_id) == $classroom->id)
                                >
                                    {{ $classroom->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('classroom_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="col">
                        <div class="form-check">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" class="form-check-input" name="status" value="1" id="statusCheck{{ $section->id }}"
                                {{ (old('section_id') == $section->id ? old('status') : $section->status) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusCheck{{ $section->id }}">{{ trans('main.status') }}</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('main.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
