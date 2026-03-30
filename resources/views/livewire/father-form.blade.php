<div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <div class="form-row">
                <div class="col">
                    <label>{{ __('main.email') }}</label>
                    <input type="email" wire:model.live="form.email" class="form-control">
                    @error('form.email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>{{ __('main.password') }}</label>
                    <input type="password" wire:model.live="form.password" class="form-control">
                    @error('form.password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label>{{ __('main.name_father_ar') }}</label>
                    <input type="text" wire:model.live="form.name_father" class="form-control">
                    @error('form.name_father') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>{{ __('main.name_father_en') }}</label>
                    <input type="text" wire:model.live="form.name_father_en" class="form-control">
                    @error('form.name_father_en') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <label>{{ __('main.job_father_ar') }}</label>
                    <input type="text" wire:model.live="form.job_father" class="form-control">
                    @error('form.job_father') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                    <label>{{ __('main.job_father_en') }}</label>
                    <input type="text" wire:model.live="form.job_father_en" class="form-control">
                    @error('form.job_father_en') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>{{ __('main.national_id_father') }}</label>
                    <input type="text" wire:model.live="form.national_id_father" class="form-control">
                    @error('form.national_id_father') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>{{ __('main.passport_id_father') }}</label>
                    <input type="text" wire:model.live="form.passport_id_father" class="form-control">
                    @error('form.passport_id_father') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>{{ __('main.phone_father') }}</label>
                    <input type="text" wire:model.live="form.phone_father" class="form-control">
                    @error('form.phone_father') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label>{{ __('main.nationality_father') }}</label>
                    <select class="custom-select" wire:model.live="form.nationality_father_id">
                        <option value="">{{ __('main.choose') }}</option>
                        @foreach($nationalities as $n)
                            <option value="{{ $n->id }}">{{ $n->name }}</option>
                        @endforeach
                    </select>
                    @error('form.nationality_father_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col">
                    <label>{{ __('main.blood_type_father') }}</label>
                    <select class="custom-select" wire:model.live="form.blood_type_father_id">
                        <option value="">{{ __('main.choose') }}</option>
                        @foreach($type_bloods as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                    @error('form.blood_type_father_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col">
                    <label>{{ __('main.religion_father') }}</label>
                    <select class="custom-select" wire:model.live="form.religion_father_id">
                        <option value="">{{ __('main.choose') }}</option>
                        @foreach($religions as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                    @error('form.religion_father_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>{{ __('main.address_father') }}</label>
                <textarea class="form-control" wire:model.live="form.address_father" rows="3"></textarea>
                @error('form.address_father') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">
                {{ __('main.next') }}
            </button>
        </div>
    </div>
</div>
