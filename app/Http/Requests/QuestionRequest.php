<?php

namespace App\Http\Requests;

use App\Enums\QuestionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'exam_id'        => 'required|exists:exams,id',
            'question.ar'    => 'required|string|max:1000',
            'question.en'    => 'required|string|max:1000',
            'type'           => ['required', 'string', new Enum(QuestionType::class)],
            'marks'          => 'required|numeric|min:0.5|max:9999',
            'option_a'       => 'nullable|string|max:500',
            'option_b'       => 'nullable|string|max:500',
            'option_c'       => 'nullable|string|max:500',
            'option_d'       => 'nullable|string|max:500',
            'correct_answer' => 'nullable|string|max:500',
        ];
    }
}
