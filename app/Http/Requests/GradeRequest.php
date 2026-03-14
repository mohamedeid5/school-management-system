<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GradeRequest extends FormRequest
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
            'name.ar' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('grades', 'name->ar')->ignore($this->grade),
            ],
            'name.en' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('grades', 'name->en')->ignore($this->grade),
            ],
            'notes' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('main.name')]),
            'name.max' => __('validation.max.string', ['attribute' => __('main.name'), 'max' => 255]),
            'name.unique' => __('validation.unique', ['attribute' => __('main.name')]),
            'notes.string' => __('validation.string', ['attribute' => __('main.notes')]),
        ];
    }
}
