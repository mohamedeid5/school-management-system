<div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <div class="form-row">
                <div class="col">
                    <label>اسم الأم بالعربي</label>
                    <input type="text" wire:model.live="form.name_mother" class="form-control">
                    @error('form.name_mother') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>اسم الأم بالإنجليزي</label>
                    <input type="text" wire:model.live="form.name_mother_en" class="form-control">
                    @error('form.name_mother_en') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <label>الوظيفة (عربي)</label>
                    <input type="text" wire:model.live="form.job_mother" class="form-control">
                    @error('form.job_mother') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                    <label>الوظيفة (إنجليزي)</label>
                    <input type="text" wire:model.live="form.job_mother_en" class="form-control">
                    @error('form.job_mother_en') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>رقم الهوية</label>
                    <input type="text" wire:model.live="form.national_id_mother" class="form-control">
                    @error('form.national_id_mother') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>جواز السفر</label>
                    <input type="text" wire:model.live="form.passport_id_mother" class="form-control">
                    @error('form.passport_id_mother') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>الهاتف</label>
                    <input type="text" wire:model.live="form.phone_mother" class="form-control">
                    @error('form.phone_mother') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label>الجنسية</label>
                    <select class="custom-select" wire:model.live="form.nationality_mother_id">
                        <option selected>اختيار...</option>
                        @foreach($nationalities as $n) <option value="{{$n->id}}">{{$n->name}}</option> @endforeach
                    </select>
                    @error('form.nationality_mother_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col">
                    <label>الفصيلة</label>
                    <select class="custom-select" wire:model.live="form.blood_type_mother_id">
                        <option selected>اختيار...</option>
                        @foreach($type_bloods as $t) <option value="{{$t->id}}">{{$t->name}}</option> @endforeach
                    </select>
                    @error('form.blood_type_mother_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col">
                    <label>الديانة</label>
                    <select class="custom-select" wire:model.live="form.religion_mother_id">
                        <option selected>اختيار...</option>
                        @foreach($religions as $r) <option value="{{$r->id}}">{{$r->name}}</option> @endforeach
                    </select>
                    @error('form.religion_mother_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>العنوان</label>
                <textarea class="form-control" wire:model.live="form.address_mother" rows="3"></textarea>
                @error('form.address_mother') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">السابق</button>
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">التالي</button>
        </div>
    </div>
</div>
