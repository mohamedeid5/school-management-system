<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $userId = $this->student->user_id ?? null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => $this->isMethod('post') ? 'required|string|min:8' : 'nullable|string|min:8',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'required|exists:my_parents,id',
            'date_of_birth' => 'required|date',
            'joining_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'nationality_id' => 'required|exists:nationalities,id',
            'blood_type_id' => 'required|exists:blood_types,id',
            'academic_year' => 'required|string|max:255',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ];
    }
}
