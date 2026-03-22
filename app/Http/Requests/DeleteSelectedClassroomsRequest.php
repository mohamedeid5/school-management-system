<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSelectedClassroomsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ids' => ['required', 'array'],
            'ids.*' => ['exists:classrooms,id']
        ];
    }

    public function messages(): array
    {
        return [
            'ids.required' => 'اختر صف واحد على الأقل',
            'ids.array' => 'البيانات المرسلة غير صحيحة',
            'ids.*.exists' => 'أحد الصفوف المحددة غير موجود',
        ];
    }
}
