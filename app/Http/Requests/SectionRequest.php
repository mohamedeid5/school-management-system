<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'name.ar' => 'required|string',
            'name.en' => 'required|string',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'status' => 'required|boolean'
        ];
    }

    public function attributes()
    {
        return [
            'name.ar' => 'الاسم بالعربي',
            'name.en' => 'الاسم بالانجليزي',
            'grade_id' => 'المرحلة الدراسية',
            'classroom_id' => 'الصف الدراسي',
            'status' => 'الحالة'
        ];
    }
}
