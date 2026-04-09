@extends('layouts.master') {{-- أو حسب اسم ملف الليأوت عندك --}}

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">إعدادات المدرسة</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>اسم المدرسة <span class="text-danger">*</span></label>
                            <input type="text" name="school_name" class="form-control @error('school_name') is-invalid @enderror"
                                   value="{{ old('school_name', $settings['school_name'] ?? '') }}">
                            @error('school_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>البريد الإلكتروني</label>
                            <input type="email" name="school_email" class="form-control @error('school_email') is-invalid @enderror"
                                   value="{{ old('school_email', $settings['school_email'] ?? '') }}">
                            @error('school_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="text" name="school_phone" class="form-control @error('school_phone') is-invalid @enderror"
                                   value="{{ old('school_phone', $settings['school_phone'] ?? '') }}">
                            @error('school_phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>العام الدراسي الحالي</label>
                            <input type="text" name="current_session" class="form-control @error('current_session') is-invalid @enderror"
                                   value="{{ old('current_session', $settings['current_session'] ?? '') }}" placeholder="مثلاً: 2025/2026">
                            @error('current_session')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>عنوان المدرسة</label>
                            <textarea name="school_address" class="form-control @error('school_address') is-invalid @enderror" rows="3">{{ old('school_address', $settings['school_address'] ?? '') }}</textarea>
                            @error('school_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>لوجو المدرسة</label>
                            <input type="file" name="school_logo" class="form-control-file @error('school_logo') is-invalid @enderror">
                            @error('school_logo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @if(isset($attachments['school_logo']))
                                <div class="mt-2">
                                    <img src="{{ $attachments['school_logo']->getAttachmentUrl() }}"
                                         alt="Logo" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer mt-4">
                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
