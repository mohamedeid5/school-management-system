<!-- create modal -->
    @if($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#createGradeModal').modal('show');
        });
    </script>
@endif

<div class="modal fade" id="createGradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('main.add_grade') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('grades.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>{{ __('main.stage_name_ar') }}</label>
                            <input
                                type="text"
                                name="name[ar]"
                                value="{{ old('name.ar') }}"
                                class="form-control @error('name.ar') is-invalid @enderror">
                            @error('name.ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ __('main.stage_name_en') }}</label>
                            <input
                                type="text"
                                name="name[en]"
                                value="{{ old('name.en') }}"
                                class="form-control form-control @error('name.en') is-invalid @enderror"
                                >
                            @error('name.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label>{{ __('main.notes') }}</label>
                        <textarea
                                name="notes"
                                class="form-control @error('name.notes') is-invalid @enderror"
                                rows="3"
                                >{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
