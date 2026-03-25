{{-- الخطوة الثالثة: مراجعة البيانات + المرفقات الاختيارية مع إمكانية الحذف --}}
<div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
    <div class="col-xs-12">
        <div class="col-md-12">
            <h4 style="font-family: 'Cairo', sans-serif;" class="mb-4 text-center">مراجعة البيانات والمرفقات النهائية</h4>

            {{-- 1. ملخص البيانات (أب وأم) --}}
            <div class="row">
                {{-- بيانات الأب --}}
                <div class="col-md-6">
                    <table class="table table-bordered table-striped shadow-sm">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th colspan="2" class="text-center">بيانات الأب</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">البريد الإلكتروني</td>
                                <td class="text-primary font-weight-bold">{{ $form->email }}</td>
                            </tr>
                            <tr>
                                <td>اسم الأب (عربي/EN)</td>
                                <td>{{ $form->name_father }} / {{ $form->name_father_en }}</td>
                            </tr>
                            <tr>
                                <td>رقم الهوية / الهاتف</td>
                                <td>{{ $form->national_id_father }} / {{ $form->phone_father }}</td>
                            </tr>
                            <tr>
                                <td>الوظيفة</td>
                                <td>{{ $form->job_father }}</td>
                            </tr>
                            <tr>
                                <td>العنوان</td>
                                <td>{{ $form->address_father }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- بيانات الأم --}}
                <div class="col-md-6">
                    <table class="table table-bordered table-striped shadow-sm">
                        <thead class="bg-danger text-white">
                            <tr>
                                <th colspan="2" class="text-center">بيانات الأم</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">اسم الأم (عربي/EN)</td>
                                <td>{{ $form->name_mother }} / {{ $form->name_mother_en }}</td>
                            </tr>
                            <tr>
                                <td>رقم الهوية / الهاتف</td>
                                <td>{{ $form->national_id_mother }} / {{ $form->phone_mother }}</td>
                            </tr>
                            <tr>
                                <td>الوظيفة</td>
                                <td>{{ $form->job_mother }}</td>
                            </tr>
                            <tr>
                                <td>العنوان</td>
                                <td>{{ $form->address_mother }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center text-muted italic small">يرجى التأكد من دقة البيانات قبل الحفظ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr class="my-4">

            {{-- 2. قسم المرفقات الاختيارية --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span><i class="fa fa-paperclip"></i> رفع المرفقات (اختياري)</span>
                    <small>صور البطاقة / شهادات الميلاد</small>
                </div>
                <div class="card-body bg-light">
                    <div class="form-group custom-file">
                        <input type="file" wire:model.live="form.photos" multiple class="form-control-file" id="photos" accept="image/*">

                        <div wire:loading wire:target="form.photos" class="mt-2 text-info animated fadeIn">
                            <i class="fa fa-spinner fa-spin"></i> جاري رفع ومعالجة الملفات...
                        </div>
                    </div>

                    @if ($form->photos)
                        <div class="row mt-4 border-top pt-3">
                            @foreach($form->photos as $index => $photo)
                                <div class="col-md-2 text-center mb-3" style="position: relative;">

                                    <button type="button"
                                            class="btn btn-danger btn-sm shadow-sm"
                                            style="position: absolute; top: -10px; right: 10px; border-radius: 50%; width: 25px; height: 25px; padding: 0; line-height: 22px; z-index: 10;"
                                            wire:click="removePhoto({{ $index }})"
                                            title="إزالة هذه الصورة">
                                        &times;
                                    </button>

                                    {{-- عرض الصورة --}}
                                    <img src="{{ $photo->temporaryUrl() }}"
                                         class="img-thumbnail shadow-sm"
                                         style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #ddd;">

                                    <p class="small text-truncate mt-2 mb-0 text-muted px-1" title="{{ $photo->getClientOriginalName() }}">
                                        {{ $photo->getClientOriginalName() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @error('form.photos.*') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between mb-4">
                <button class="btn btn-secondary btn-lg px-5 shadow-sm" type="button" wire:click="back(2)">
                    <i class="fa fa-arrow-right mr-2"></i> السابق
                </button>

                <button class="btn btn-success btn-lg px-5 shadow-sm"
                        wire:click="submitForm"
                        type="button"
                        wire:loading.attr="disabled"
                        wire:target="submitForm, form.photos">
                    <i class="fa fa-save mr-2"></i> تأكيد وحفظ البيانات النهائية
                </button>
            </div>

        </div>
    </div>
</div>
