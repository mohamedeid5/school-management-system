<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ExamType;
use Illuminate\Validation\Rules\Enum;

class ExamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name.ar'       => 'required|string|max:255',
            'name.en'       => 'required|string|max:255',
            'type'          => ['required', 'string', new Enum(ExamType::class)],
            'subject_id'    => 'required|exists:subjects,id',
            'grade_id'      => 'required|exists:grades,id',
            'classroom_id'  => 'required|exists:classrooms,id',
            'academic_year' => 'required|string|max:20',
            'term'          => 'required|integer|min:1|max:3',
            'exam_date'     => 'required|date',
            'max_score'     => 'required|numeric|min:1|max:9999',
            'teacher_id'    => $this->user()->hasRole('admin') ? 'required|exists:teachers,id' : 'nullable',
        ];
    }
}
