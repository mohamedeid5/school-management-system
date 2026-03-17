<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            'list_classrooms' => 'required|array',
            'list_classrooms.*.name' => 'required|string',
            'list_classrooms.*.name_en' => 'required|string',
            'list_classrooms.*.grade_id' => 'required|exists:grades,id',
        ];
    }

    public function messages(): array
    {
        return [
            'list_classrooms.required' => __('validation.required', ['attribute' => __('main.classrooms')]),
            'list_classrooms.array' => __('validation.array', ['attribute' => __('main.classrooms')]),

            'list_classrooms.*.name.required' => __('validation.required', ['attribute' => __('main.classroom_name_ar')]),
            'list_classrooms.*.name.string' => __('validation.string', ['attribute' => __('main.classroom_name_ar')]),

            'list_classrooms.*.name_en.required' => __('validation.required', ['attribute' => __('main.classroom_name_en')]),
            'list_classrooms.*.name_en.string' => __('validation.string', ['attribute' => __('main.classroom_name_en')]),

            'list_classrooms.*.grade_id.required' => __('validation.required', ['attribute' => __('main.grades')]),
            'list_classrooms.*.grade_id.exists' => __('validation.exists', ['attribute' => __('main.grades')]),
        ];
    }

    public function attributes(): array
    {
        return [
            'list_classrooms' => __('main.classrooms'),
            'list_classrooms.*.name' => __('main.classroom_name_ar'),
            'list_classrooms.*.name_en' => __('main.classroom_name_en'),
            'list_classrooms.*.grade_id' => __('main.grades'),
        ];
    }
}
