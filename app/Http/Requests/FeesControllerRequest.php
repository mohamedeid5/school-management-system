<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeesControllerRequest extends FormRequest
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
                'max:255',
                Rule::unique('fees', 'name->ar')
                ->where('grade_id', $this->grade_id)
                ->where('classroom_id', $this->classroom_id)
                ->ignore($this->route('fee'))
            ],
            'name.en' => [
                'required',
                'max:255',
                Rule::unique('fees', 'name->en')
                ->where('grade_id', $this->grade_id)
                ->where('classroom_id', $this->classroom_id)
                ->ignore($this->route('fee'))
            ],
            'amount' => 'required|numeric|min:1|max:999999',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'academic_year' => 'required',
            'description' => 'nullable'

        ];
    }
}
