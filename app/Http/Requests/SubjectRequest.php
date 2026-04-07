<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name.ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subjects', 'name->ar')->where(function ($query) {
                    $query->where('classroom_id', request()->classroom_id);
                })->ignore($this->route('subject')),
            ],
            'name.en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subjects', 'name->en')->where(function ($query) {
                    $query->where('classroom_id', request()->classroom_id);
                })->ignore($this->route('subject')),
            ],
            'code' => 'nullable|string|max:50|unique:subjects,code,' . $this->route('subject'),
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'teacher_id' => 'required|exists:teachers,id',];
    }
}

