<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromtionControllerRequest extends FormRequest
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
            'from_grade_id' => 'required|exists:grades,id',
            'from_classroom_id' => 'required|exists:classrooms,id',
            'from_section_id' => 'required|exists:sections,id',
            'to_grade_id' => 'required|exists:grades,id',
            'to_classroom_id' => 'required|exists:classrooms,id',
            'to_section_id' => 'required|exists:sections,id',
            'academic_year' => 'required',
            'academic_year_new' => 'required',
        ];
    }
}
