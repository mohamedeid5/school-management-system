<div class="modal fade" id="createSectionModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                    id="exampleModalLabel">
                    {{ trans('main.add_section') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.sections.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="form_type" value="create">
                    <div class="row">
                        <div class="col">
                            <input
                                type="text"
                                name="name[ar]"
                                value="{{ old('name.ar') }}"
                                class="form-control @error('name.ar') is-invalid @enderror"
                                placeholder="{{ trans('main.section_name_ar') }}"
                                >
                                @error('name.ar')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="col">
                            <input
                                type="text"
                                name="name[en]"
                                value="{{ old('name.en') }}"
                                class="form-control @error('name.en') is-invalid @enderror"
                                placeholder="{{ trans('main.section_name_en') }}"
                                >
                                 @error('name.en')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                    </div>
                    <br>


                    <div class="col">
                        <label for="inputName"
                                class="control-label">{{ trans('main.grade') }}</label>
                        <select
                            name="grade_id"
                            class="custom-select grade-select @error('grade_id') is-invalid @enderror"
                            onchange="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="" selected disabled>
                                {{ trans('main.grades') }}
                            </option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" @selected($grade->id == old('grade_id'))>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                         @error('grade_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName"class="control-label">
                                {{ trans('main.classroom') }}
                            </label>
                        <select name="classroom_id" class="custom-select classroom-select @error('classroom_id') is-invalid @enderror">
                             <option value="" selected disabled>
                                {{ trans('main.classrooms') }}
                            </option>
                            @if($errors->any())
                                @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}" @selected($classroom->id == old('classroom_id'))>
                                        {{ $classroom->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                         @error('classroom_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col mt-3">
                    <div class="form-check">
                        <input type="hidden" name="status" value="0">

                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            id="statusCheck"
                            class="form-check-input @error('status') is-invalid @enderror"
                            @checked(old('status', 1) == 1)
                        >

                        <label for="statusCheck" class="form-check-label">
                            {{ trans('main.status') ?? 'نشط' }}
                        </label>

                        @error('status')
                            <div class="text-danger mt-1" style="font-size: 0.875em;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary "
                    data-dismiss="modal"
                >
                    {{ trans('main.close') }}
                </button>
                 @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit"
                        class="btn btn-primary">{{ trans('main.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')

<script>
    $(document).ready(function () {

            @if(old('grade_id'))
                $('#heading-grade-{{ old("grade_id") }}').click();
            @endif

            @if($errors->any())
                @if(old('section_id'))
                    $('#edit{{ old("section_id") }}').modal('show');
                @else
                    $('#createSectionModal').modal('show');
                @endif
            @endif

        $('.grade-select').on('change', function(){
            var grade_id = $(this).val();
            var classroom_select = $(this).closest('.modal-body').find('.classroom-select');

            if(grade_id) {

                $.ajax({
                    url: "{{ url(app()->getLocale() . '/get-classrooms') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        classroom_select.empty();
                        classroom_select.append('<option value="" selected disabled>اختر الفصل...</option>');

                        $.each(data, function(key, value) {
                            classroom_select.append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function() {
                        console.log('حصلت مشكلة في جلب الفصول');
                    }
                })
            } else {
                classroom_select.empty();
            }

        });
    });


</script>

@endsection
