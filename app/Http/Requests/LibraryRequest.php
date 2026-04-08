<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibraryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'file_path'    => ($this->isMethod('POST') ? 'required' : 'nullable') . '|file',
            'grade_id'     => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id'   => 'required|exists:sections,id',
            'subject_id'   => 'required|exists:subjects,id',
            'description'  => 'nullable|string|max:2000',
        ];
    }
}
