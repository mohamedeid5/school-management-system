<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
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
        ];
    }

    public function attributes()
    {
        return [
            'name.ar' => __('main.classroom_name_ar'),
            'name.en' => __('main.classroom_name_en'),
            'grade_id' => __('main.grades')
        ];

    }
}
